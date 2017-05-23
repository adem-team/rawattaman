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
use yii\web\NotFoundHttpException;

use api\modules\master\models\Rating;
use api\modules\master\models\RatingSearch;

/**
  * Data user login by Token.
  *
  * @author ptrnov  <piter@lukison.com>
  * @since 1.1
  * CMD : curl -i http://api.kontrolgampang.int/login/users -H "Authorization: Bearer Yt4kLWLYlQf9OfnFSpZ5IO3128Gvw2gP"
  *   http://api.kontrolgampang.com/master/stores?ACCESS_UNIX=20170404081601
 */
class RatingController extends ActiveController
{	
	/**
	  * Source Database declaration 
	 */
    public $modelClass = 'api\modules\master\models\Rating';
	public $serializer = [
		'class' => 'yii\rest\Serializer',
		'collectionEnvelope' => 'rating',
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
					$param=["RatingSearch"=>Yii::$app->request->queryParams];
					//return $param;
                    $searchModel = new RatingSearch();
					return $searchModel->search($param);
                },
            ],
			'options' => [
				'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => function () {					
					$param=["RatingSearch"=>Yii::$app->request->queryParams];
					//return $param;
                    $searchModel = new RatingSearch();
					return $searchModel->search($param);
                },
            ], 
        ];
    }
	public function actionView($id)
    {
		$model= $this->findModel($id);
		// if ($model){
			return $model->attributes;
		// } 
		// else
		// {
			// return array('errors'=>$model->errors);
		// }
	}
	public function actionUpdate($id)
    {
        //$params     		= $_REQUEST; 
		// $JADWAL_ID			= isset($_REQUEST['JADWAL_ID'])!=''?$_REQUEST['JADWAL_ID']:''; 
		// $NILAI				= isset($_REQUEST['NILAI'])!=''?$_REQUEST['NILAI']:'';
		// $NILAI_KETERANGAN	= isset($_REQUEST['NILAI_KETERANGAN'])!=''?$_REQUEST['NILAI_KETERANGAN']:'';
		//$model= Rating::find()->where(['JADWAL_ID'=>$JADWAL_ID])->one();	
		
		//$request = Yii::$app->request;
		//$queryParams = Yii::$app->request->queryParams;
		$params = Yii::$app->request->bodyParams;		
		$model= $this->findModel($id);
		$model->attributes=$params;
		//if (isset($request)) {
			// $model->ACCESS_UNIX=$request->getBodyParam('ACCESS_UNIX');		
			// $model->JADWAL_ID=$request->getBodyParam('JADWAL_ID');		
			// $model->ID_PEKERJA=$request->getBodyParam('ID_PEKERJA');		
			// $model->NILAI=$request->getBodyParam('NILAI');		
			// $model->NILAI_KETERANGAN=$request->getBodyParam('NILAI_KETERANGAN');		
			// $model->TGL=$request->getBodyParam('TGL');		
			// $model->JAM_MASUK=$request->getBodyParam('JAM_MASUK');		
			// $model->JAM_KELUAR=$request->getBodyParam('JAM_KELUAR');		
			// $model->UPDATE_BY=$request->getBodyParam('ACCESS_UNIX');	
			
			if ($model->save()) 
			{
				return $model->attributes;
			} 
			else
			{
				return array('errors'=>$model->errors);
			}
		// }else {
			// throw new \yii\web\MethodNotAllowedHttpException('You are not allowed to update data');
		// }
    }
	
	protected function findModel($id)
    {
        if (($model = Rating::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}


