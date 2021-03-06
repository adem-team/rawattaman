<?php

namespace api\modules\master\controllers;

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

use api\modules\master\models\Feedback;
use api\modules\master\models\FeedbackSearch;
use api\modules\login\models\UserToken;
/**
  * Data user login by Token.
  *
  * @author ptrnov  <piter@lukison.com>
  * @since 1.1
  * CMD : curl -i http://api.kontrolgampang.int/login/users -H "Authorization: Bearer Yt4kLWLYlQf9OfnFSpZ5IO3128Gvw2gP"
  *   http://api.kontrolgampang.com/master/stores?ACCESS_UNIX=20170404081601
 */
class FeedbackController extends ActiveController
{	
	/**
	  * Source Database declaration 
	 */
    public $modelClass = 'api\modules\master\models\Feedback';
	public $serializer = [
		'class' => 'yii\rest\Serializer',
		'collectionEnvelope' => 'feedback',
	];
	
	/**
     * @inheritdoc
     */
    public function behaviors()    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => CompositeAuth::className(),
                'authMethods' => [
                    //['class' => HttpBearerAuth::className()],
                    // ['class' => QueryParamAuth::className(), 'tokenParam' => 'access-token'],
                ],
                'except' => ['options']
            ],
			'bootstrap'=> [
				'class' => ContentNegotiator::className(),
				'formats' => [
					'application/json' => Response::FORMAT_JSON,
				],
			],
			'corsFilter' => [
				'class' => \yii\filters\Cors::className(),
				'cors' => [
					// restrict access to
					//'Origin' => ['http://lukisongroup.com', 'http://lukisongroup.int','http://localhost','http://103.19.111.1','http://202.53.354.82'],
					'Origin' => ['*'],
					'Access-Control-Request-Method' => ['POST', 'GET', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
					//'Access-Control-Request-Headers' => ['*'],
					'Access-Control-Request-Headers' => ['*'],
					// Allow only headers 'X-Wsse'
					'Access-Control-Allow-Credentials' => false,
					// Allow OPTIONS caching
					'Access-Control-Max-Age' => 3600,
				]		 
			]
        ]);
    }

	public function actions()
    {		
        return [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => function () {					
					$param=["FeedbackSearch"=>Yii::$app->request->queryParams];
					//return $param;
                    $searchModel = new FeedbackSearch();
					return $searchModel->search($param);
                },
            ],
			'options' => [
				'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => function () {					
					$param=["FeedbackSearch"=>Yii::$app->request->queryParams];
					//return $param;
                    $searchModel = new FeedbackSearch();
					return $searchModel->search($param);
                },
            ], 
        ];
    }
	
	public function actionCreate()
    {
		$paramsBody = Yii::$app->request->bodyParams;
        $model = new Feedback();				    
        $model->attributes=$paramsBody;
        $model->CREATE_AT = date('Y:m:d H:i:s');//'2017-12-12 00:00';
        if ($model->save()) 
        {
			//if(isset($paramsBody['ACCESS_UNIX'])){
				$modelUser= UserToken::find()->where(['ACCESS_UNIX'=>$paramsBody['ACCESS_UNIX']])->one();	
			//}
			$contentBody= $this->renderPartial('_postmanBody',[
				'modelUser'=>$modelUser,
				'NOTE'=>$model->NOTE
			]);	
			
			//Email-Send 			
			Yii::$app->mailer->compose()
			->setFrom(['lukisongroup@gmail.com' => 'POSTMAN-RAWATTAMAN'])
			//->setTo([$model->email])
			->setTo(['lukisongroup@gmail.com','rawat.taman@yahoo.com'])
			//->setTo(['rawat.taman@yahoo.com'])
			->setSubject('CUSTOMER FEEDBACK')
			->setHtmlBody($contentBody)
			//->attach($filenameAll,[$filename,'xlsx'])
			->send(); 
            return $model->attributes;
        } 
        else
        {
            return array('errors'=>$model->errors);
        } 
    }

}


