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
  * SET CODE NOTIFY SEND TO EMAIL.
  * http://rt.kontrolgampang.com/login/user-reset-codes
  * metohe   : POST
  * result   : wrong-email "jika email tidak sama"
  * result 	 : data-empty "jika tidak ada data" atau data yang dikirim salah
  * post body: username,ACCESS_UNIX,email
  * @author ptrnov  <piter@lukison.com>
  * @since 1.2
 */
class UserResetCodeController extends ActiveController
{	
	/**
	  * Source Database declaration.
	  *
	 */
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
	
	/**
     * Model Search Data.
     */
	public function actionCreate()
    {		
        $paramsBody 	= Yii::$app->request->bodyParams;		
		$username		= isset($_REQUEST['username'])!=''?$_REQUEST['username']:'';
		$access_unix	= isset($_REQUEST['ACCESS_UNIX'])!=''?$_REQUEST['ACCESS_UNIX']:'';
		$email			= isset($_REQUEST['email'])!=''?$_REQUEST['email']:'';		
		
		$modelCnt= UserToken::find()->where(['ACCESS_UNIX'=>$access_unix,'username'=>$username])->count();
		$model= UserToken::find()->where(['ACCESS_UNIX'=>$access_unix,'username'=>$username])->one();
		//$model->attributes=$params;
		
		//Reset Code.
		$datetomecode=str_replace(':','',date('m:d H:i'));
		$codeReset = str_replace(' ','',$datetomecode);
				
		if($modelCnt){
			if($model->email==$email){
				//Email-Content
				$contentBody= $this->renderPartial('_postmanBody',[
					'model'=>$model,
					'codeReset'=>$codeReset
				]);	
				
				//Email-Send 			
				Yii::$app->mailer->compose()
				->setFrom(['lukisongroup@gmail.com' => 'POSTMAN-RAWATTAMAN'])
				->setTo([$model->email])
				//->setTo(['piter@lukison.com'])
				//->setTo(['yosika@lukison.com','timbul.siregar@lukison.com','piter@lukison.com'])
				//->setTo(['sales_esm@lukison.com','marketing_esm@lukison.com'])
				->setSubject('CUSTOMER RESET PASSWORD')
				->setHtmlBody($contentBody)
				//->attach($filenameAll,[$filename,'xlsx'])
				->send(); 
				$model->attributes=$paramsBody;
				
				//Convert Code to MD5
				//$model->password_reset_token=Yii::$app->security->generatePasswordHash($codeReset);
				$model->setCodeReset($codeReset);
				$model->save();
				return $model->attributes;
			}else{
				return array('result'=>'wrong-email');
			}
		}else{
			return array('result'=>'data-empty');
		} 		
    }	
}


