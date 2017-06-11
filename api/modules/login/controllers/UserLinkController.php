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
//use zyx\phpmailer\Mailer;

use api\modules\login\models\UserToken;
use api\modules\login\models\UserTokenSearch;
use api\modules\login\models\UserProfil;

/**
  * UPDATE LINK LOGIN
  * http://rt.kontrolgampang.com/login/user-links
  * metohe   : POST
  * result   : true "jika berhasil"; 
  * result   : wrong-code "jika kode yang dimasukan dari email notify salah"
  * result   : data-empty "jika data post salah"
  * post body: ACCESS_UNIX,ID_FB,ID_LINKEDIN,ID_TWITTER,ID_GOOGLE
  * @author ptrnov  <piter@lukison.com>
  * @since 1.2
 */
class UserLinkController extends ActiveController
{	
	/**
	  * Source Database declaration.
	  *
	 */
    //public $modelClass = 'common\models\User';
    public $modelClass = 'api\modules\login\models\UserToken';
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

	public function actions()
	{
		$actions = parent::actions();
		unset($actions['index'], $actions['update'], $actions['create'], $actions['delete'], $actions['view']);
		//unset($actions['update'], $actions['create'], $actions['delete'], $actions['view']);
		return $actions;
	}
	
	public function actionCreate()
    {        
		$paramsBody 	= Yii::$app->request->bodyParams;		
		//$username		= isset($_REQUEST['username'])!=''?$_REQUEST['username']:'';
		$access_unix	= isset($_REQUEST['ACCESS_UNIX'])!=''?$_REQUEST['ACCESS_UNIX']:'';
		$ID_FB			= isset($_REQUEST['ID_FB'])!=''?$_REQUEST['ID_FB']:'';
		$ID_GOOGLE		= isset($_REQUEST['ID_GOOGLE'])!=''?$_REQUEST['ID_GOOGLE']:'';
		$ID_TWITTER		= isset($_REQUEST['ID_TWITTER'])!=''?$_REQUEST['ID_TWITTER']:'';
		$ID_LINKEDIN	= isset($_REQUEST['ID_LINKEDIN'])!=''?$_REQUEST['ID_LINKEDIN']:'';
		
		//MODEL
		// $modelCnt= UserToken::find()->where(['ACCESS_UNIX'=>$access_unix,'username'=>$username])->count();
		// $model= UserToken::find()->where(['ACCESS_UNIX'=>$access_unix,'username'=>$username])->one();		
		$modelCnt= UserToken::find()->where(['ACCESS_UNIX'=>$access_unix])->count();
		$model= UserToken::find()->where(['ACCESS_UNIX'=>$access_unix])->one();		
		
		if($modelCnt){
			if(isset($paramsBody['ID_FB']) && $paramsBody['ID_FB']!=''){
				$model->ID_FB=$paramsBody['ID_FB'];
			};
			if(isset($paramsBody['ID_GOOGLE']) && $paramsBody['ID_GOOGLE']!=''){
				$model->ID_GOOGLE=$paramsBody['ID_GOOGLE'];
			};
			if(isset($paramsBody['ID_TWITTER']) && $paramsBody['ID_TWITTER']!=''){
				$model->ID_TWITTER=$paramsBody['ID_TWITTER'];
			};
			if(isset($paramsBody['ID_LINKEDIN']) && $paramsBody['ID_LINKEDIN']!=''){
				$model->ID_LINKEDIN=$paramsBody['ID_LINKEDIN'];
			};
			$model->save();
			return array('result'=>'true');			
		}else{
			return array('result'=>'data-empty');
		}
	}
	
}


