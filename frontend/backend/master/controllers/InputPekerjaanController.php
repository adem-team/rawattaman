<?php

namespace frontend\backend\master\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\helpers\view;

use frontend\backend\master\models\UserProfil;
use frontend\backend\master\models\UserProfilSearch;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class InputPekerjaanController extends Controller
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

    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {		
		$paramCari=Yii::$app->getRequest()->getQueryParam('id');
			$searchModel = new UserProfilSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);			
	
			return $this->render('index', [
				'searchModel' => $searchModel!=''?$searchModel:false,
				'dataProvider' => $dataProvider,
			]);
    }

    /**
     * Displays a single Item model.
     * @param string $id
     * @return mixed
     */
    // public function actionView($id)
    // {
        // return $this->render('view', [
            // 'model' => $this->findModel($id),
        // ]);
    // }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreateHarga()
    // {
        // $model = new Item();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id' => $model->ID]);
        // } else {
            // return $this->renderAjax('_formHarga', [
                // 'model' => $model,
            // ]);
        // }
    // }
	
	// public function actionCreateDiscount()
    // {
        // $model = new ItemFdiscount();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id' => $model->ID]);
        // } else {
            // return $this->renderAjax('_formDiscount', [
                // 'model' => $model,
            // ]);
        // }
    // }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    // public function actionUpdate($id)
    // {
        // $model = $this->findModel($id);

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id' => $model->ID]);
        // } else {
            // return $this->render('update', [
                // 'model' => $model,
            // ]);
        // }
    // }

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    // public function actionDelete($id)
    // {
        // $this->findModel($id)->delete();

        // return $this->redirect(['index']);
    // }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    // protected function findModel($id)
    // {
        // if (($model = Item::findOne($id)) !== null) {
            // return $model;
        // } else {
            // throw new NotFoundHttpException('The requested page does not exist.');
        // }
    // }


}
