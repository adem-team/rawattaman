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
use frontend\backend\master\models\Jadwal;
use frontend\backend\master\models\JadwalSearch;
use frontend\backend\master\models\Rating;
use frontend\backend\master\models\RatingSearch;

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

	public function beforeAction($action){
		$modulIndentify=4; //Data Pekerja
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
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {		
		$paramCari=Yii::$app->getRequest()->getQueryParam('id');
		//List Profile.
		$searchModel = new UserProfilSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);			
		//Selected Profile.
		$searchModelProfile = new UserProfilSearch(['ACCESS_UNIX'=>$paramCari]);
		$dataProviderProfile = $searchModelProfile->search(Yii::$app->request->queryParams);
		$modelProfile=$dataProviderProfile->getModels()[0];
		
		//jadwal.
		$searchModelJadwal = new JadwalSearch(['ACCESS_UNIX'=>$paramCari]);
		$dataProviderJadwal = $searchModelJadwal->search(Yii::$app->request->queryParams);
		
		//Rating.
		$searchModelRating = new RatingSearch();
        $dataProviderRating = $searchModelRating->search(Yii::$app->request->queryParams);
		
		return $this->render('index', [
			'getAccessUnix'=>$paramCari,
			'searchModel' => $searchModel!=''?$searchModel:false,
			'dataProvider' => $dataProvider,
			'modelProfile'=>$modelProfile,
			'searchModelJadwal'=>$searchModelJadwal,
			'dataProviderJadwal'=>$dataProviderJadwal,
			'searchModelRating'=>$searchModelRating,
			'dataProviderRating'=>$dataProviderRating
		]);
    }

	public function actionCreateClient()
	{
		$model = new UserProfil();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['index', 'id' => $model->ID]);
			} else {
			return $this->renderAjax('_formProfile', [
				'model' => $model,
			]);
		}
	}
	
	public function actionCreateJadwal($id)
	{
		$paramCari=Yii::$app->getRequest()->getQueryParam('id');
		$modelJadwal = new Jadwal();
		$modelJadwal->scenario = 'input_jadwal';
		if ($modelJadwal->load(Yii::$app->request->post()) ) {
			$dataPost=Yii::$app->request->post();
			$modelJadwal->CREATE_BY=Yii::$app->getUserOpt->user()['username'];
			$modelJadwal->CREATE_AT=date("Y-m-d H:i:s");
			// print_r(self::getDayNmPHP($dataPost['Jadwal']['JAM_MASUK']));
			// die();
			$modelJadwal->ID_PEKERJA=self::toManualArray($dataPost['Jadwal']['ID_PEKERJA']);
			$modelJadwal->TODOLIST=self::toManualArray($dataPost['Jadwal']['TODOLIST']);
			$modelJadwal->HARI=self::getDayNmPHP($dataPost['Jadwal']['JAM_MASUK']);
			$modelJadwal->save();
			return $this->redirect(['index', 'id' => $modelJadwal->ACCESS_UNIX,'#'=>'tab-b']);		
		} else {
			return $this->renderAjax('_formJadwal', [
				'keyACCESS_UNIX'=>$id,
				'modelJadwal' => $modelJadwal,
			]);
		}
	}
	
	private function toManualArray($assArray){
		$rowRslt='';
		if ($assArray!=''){
			foreach($assArray as $rows){
				if ($rowRslt==''){
					$rowRslt=$rows;
				}else{
					$rowRslt=$rowRslt.','.$rows;
				}				
			};
			return $rowRslt;
		}else{
			return '';
		}		
	}
	
	Public function getDayNmPHP($tanggal){		
		$valDate=date_format(date_create($tanggal),'w');
        if ($valDate==0){
            return "Senin";
        }elseif ($valDate==1){
            return "Selasa";
        }elseif ($valDate==2){
            return "Rabu";
        }elseif ($valDate==3){
            return "Kamis";
        }elseif ($valDate==4){
            return "Jumat";
        }elseif ($valDate==5){
            return "Sabtu";
        }elseif ($valDate==6){
            return "Minggu";
        }else{
            return "NotSet";
        }
    }
	
	public function actionCreateRating($id)
	{
		$modelJadwal= $this->findModelJadwal($id);
		// print_r($modelJadwal);
		// die();
		$modelRating = new Rating();
		if ($modelRating->load(Yii::$app->request->post())) {
			$dataPost=Yii::$app->request->post();
			// print_r(self::toManualArray($dataPost['Rating']['ID_PEKERJA']));
			// die();
			
			$modelRating->CREATE_BY=Yii::$app->getUserOpt->user()['username'];
			$modelRating->CREATE_AT=date("Y-m-d H:i:s");
			$modelRating->ID_PEKERJA=self::toManualArray($dataPost['Rating']['ID_PEKERJA']);
			if($modelRating->save()){
				$modelJadwal->STATUS=2;
				$modelJadwal->save();
			};
			return $this->redirect(['index', 'id' => $modelJadwal->ACCESS_UNIX,'#'=>'tab-c']);				
		}
		else{
			return $this->renderAjax('_formRating', [
				'keyACCESS_UNIX'=>$modelJadwal->ACCESS_UNIX,
				'modelRating' => $modelRating,
				'modelJadwal'=>$modelJadwal
			]);
		}
	}
	 
	protected function findModelJadwal($id)
    {
        if (($model = Jadwal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
