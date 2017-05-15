<?php

namespace frontend\backend\master\controllers;

use Yii;
use frontend\backend\master\models\Pekerja;
use frontend\backend\master\models\PekerjaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PekerjaController implements the CRUD actions for Pekerja model.
 */
class PekerjaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
	public function beforeAction($action){
		$modulIndentify=8; //Data Pekerja
		// Check only when the user is logged in.
		// Author piter Novian [ptr.nov@gmail.com].
		if (!Yii::$app->user->isGuest){
			if (Yii::$app->session['userSessionTimeout']< time() ) {
				// timeout
				Yii::$app->user->logout();
				return $this->goHome(); 
			} else {	
				//add Session.
				Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
				//check validation [access/url].
				$checkAccess=Yii::$app->getUserOpt->UserMenuPermission($modulIndentify);
				if($checkAccess['modulMenu']['MODUL_STS']==0 OR $checkAccess['ModulPermission']['STATUS']==0){				
					$this->redirect(array('/site/alert'));
				}else{
					if($checkAccess['PageViewUrl']==true){						
						return true;
					}else{
						$this->redirect(array('/site/alert'));
					}					
				}			 
			}
		}else{
			Yii::$app->user->logout();
			return $this->goHome(); 
		}
	}
	
    /**
     * Lists all Pekerja models.
     * @return mixed
     */
    public function actionIndex()
    {
		$paramCari=Yii::$app->getRequest()->getQueryParam('id');
		$paramSrc=Yii::$app->getRequest()->getQueryParam('idsrc');
		if($paramCari){
			$searchModel = new PekerjaSearch(['ID_PEKERJA'=>$paramSrc]);
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			$modelViewKayawan = $this->findModel($paramCari!=''?$paramCari:$paramSrc);
			
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'modelViewKayawan'=>$modelViewKayawan
			]);
		}else{
			$searchModel = new PekerjaSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			$modelViewKayawan = $this->findModel('RT0001');
		
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'modelViewKayawan'=>$modelViewKayawan
			]);
		}      
    }

    /**
     * Displays a single Pekerja model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pekerja model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		
		// print_r($digitRslt);
		// die();
		
        $model = new Pekerja();
		
        if ($model->load(Yii::$app->request->post())) {
			//GET PRIMARY KEY GENDRATE.
			$modelCode = Pekerja::find()->where('ID_PEKERJA<>""')->max('ID_PEKERJA');
			$ambilNumber=substr($modelCode, 2, 4)+1;
			$digitRslt=str_pad($ambilNumber,4,"0",STR_PAD_LEFT);
			
			$model->ID_PEKERJA='RT'.$digitRslt;
			$model->CREATE_BY=Yii::$app->getUserOpt->user()['username'];
			$model->CREATE_AT=date("Y-m-d H:i:s");
			$model->save();
            return $this->redirect(['index', 'idsrc' => $model->ID_PEKERJA]);
        } else {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pekerja model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {			
			$model->UPDATE_BY=Yii::$app->getUserOpt->user()['username'];
			$model->save();
            return $this->redirect(['index', 'idsrc' =>$id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pekerja model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pekerja model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Pekerja the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pekerja::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
