<?php

namespace api\modules\login\controllers;

use yii;
use yii\helpers\Json;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;
use api\modules\login\models\UserToken;
use api\modules\login\models\UserTokenSearch;

/**
  * logintest AND CHECK TOKEN USER.
  * auth_key		: Token Primary.
  * access_token 	: Token Access, after logintest for Access Api data POST,GET,PUT.
  * @author ptrnov  <piter@lukison.com>
  * @since 1.2
  * CMD : curl -u username:password http://api.kontrolgampang.int/logintest/user-tokens?username=trial1
  * CMD : curl -u trial1:semangat2016 http://api.kontrolgampang.int/logintest/user-tokens?username=trial1
 */
class UserTokenController extends ActiveController
{	
	/**
	  * Source Database declaration.
	  *
	 */
    //public $modelClass = 'common\models\User';
    public $modelClass = 'api\modules\login\models\UserTokenSearch';
	// public $serializer = [
		// 'class' => 'yii\rest\Serializer',
		//'collectionEnvelope' => 'User',
		//'linksEnvelope'=> false,
	// ];	
	
	/**
     * Behaviors
	 * Mengunakan Auth HttpBasicAuth.
	 * Chacking kontrolgampang\login.
     */
    public function behaviors()    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => 
            [
                'class' => CompositeAuth::className(),
				'authMethods' => 
                [
                    #Hapus Tanda Komentar Untuk Autentifikasi Dengan Token               
                   // ['class' => HttpBearerAuth::className()],
                   // ['class' => QueryParamAuth::className(), 'tokenParam' => 'access-token'],
                ],
                'except' => ['options']
            ],
			'bootstrap'=> 
            [
				'class' => ContentNegotiator::className(),
				'formats' => 
                [
					'application/json' => Response::FORMAT_JSON,"JSON_PRETTY_PRINT"
				],
				
			],
			'corsFilter' => [
				'class' => \yii\filters\Cors::className(),
				'cors' => [
					// restrict access to
					'Origin' => ['*','http://localhost:810'],
					'Access-Control-Request-Method' => ['POST', 'PUT','GET'],
					// Allow only POST and PUT methods
					'Access-Control-Request-Headers' => ['X-Wsse'],
					// Allow only headers 'X-Wsse'
					'Access-Control-Allow-Credentials' => true,
					// Allow OPTIONS caching
					'Access-Control-Max-Age' => 3600,
					// Allow the X-Pagination-Current-Page header to be exposed to the browser.
					'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
				]		
			],
			/* 'corsFilter' => [
				'class' => \yii\filters\Cors::className(),
				'cors' => [
					'Origin' => ['*'],
					'Access-Control-Allow-Headers' => ['X-Requested-With','Content-Type'],
					'Access-Control-Request-Method' => ['POST', 'GET', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
					//'Access-Control-Request-Headers' => ['*'],					
					'Access-Control-Allow-Credentials' => true,
					'Access-Control-Max-Age' => 3600,
					'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page']
					]		 
			], */
        ]);		
    }

	/**
     * Model Search Data.
     */
	public function actions()
    {		
        return [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => function () {					
					$param=["UserTokenSearch"=>Yii::$app->request->queryParams];
					//return $param;
                    $searchModel = new UserTokenSearch();
					
                    if($searchModel){
						$searchModel->scenario = 'createuserapi';
						return $searchModel->search($param);
					}else{
						$nodata=[
							"status"=> 404,
							'message'=> 'no-data',
						];
						return $nodata;
					}					
                },
            ],
        ];
    }	

	/**
	* CREATE Validation scnario ['username','email','new_pass'];
	* Auto generate =auth_key.
	* Auto generate =password_hash.
	*/
	public function actionCreate()
    {
		$params     = $_REQUEST; 
		$modelCheck = UserToken::find()->where(['username'=>$params['username'],'email'=>$params['email']])->one();
		if($modelCheck){
			return array('errors'=>'user already exist');
		}else{
			$model = new UserToken();
			$model->scenario = 'createuserapi';			       
			$model->attributes=$params;
			$model->auth_key = Yii::$app->security->generateRandomString();
			$model->password_hash = Yii::$app->security->generatePasswordHash($model->new_pass);
			$model->create_at = date('Y-m-d H:i:s');//'2017-12-12 00:00';
			$model->ACCESS_LEVEL = 'client';
			$datetomecode=str_replace(':','',date('Y:m:d H:i:s'));
			$model->ACCESS_UNIX = str_replace(' ','',$datetomecode);
			if ($model->save()) 
			{
				return $model->attributes;
			} 
			else
			{
				return array('errors'=>$model->errors);
			} 			
		}
    }
	
	public function actionUpdate()
    {
        $params     = $_REQUEST; 
		$modelCheck = UserToken::find()->where(['username'=>$params['username'],'email'=>$params['email']])->one();
		if($modelCheck){
			$model = UserToken::find()->where(['username'=>$params['username'],'email'=>$params['email']])->one();;
			$model->scenario = 'createuserapi';			       
			$model->password_hash = Yii::$app->security->generatePasswordHash($params['new_pass']);
			$model->new_pass = Yii::$app->security->generatePasswordHash($params['new_pass']);
			if ($model->save()) 
			{
				return $model->attributes;
			} 
			else
			{
				return array('errors'=>$model->errors);
			} 	
		}else{
			return array('errors'=>$model->errors);
		}
    }
}


