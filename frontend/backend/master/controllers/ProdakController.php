<?php

namespace frontend\backend\master\controllers;

use Yii;
use frontend\backend\master\models\Prodak;
use frontend\backend\master\models\ProdakSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProdakController implements the CRUD actions for Prodak model.
 */
class ProdakController extends Controller
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
		$modulIndentify=6; //prodak
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
     * Lists all Prodak models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProdakSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Prodak model.
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
     * Creates a new Prodak model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateProduk()
    {
        $model = new Prodak();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->ID]);
        } else {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Prodak model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->ID]);
        } else {
            return $this->renderAjax('view', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Prodak model.
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
     * Finds the Prodak model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Prodak the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prodak::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
