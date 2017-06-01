<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use kartik\label\LabelInPlace;
use kartik\widgets\Select2;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use kartik\widgets\DatePicker;
use kartik\widgets\TouchSpin;
use yii\web\JsExpression;
use kartik\datetime\DateTimePicker;
use kartik\detail\DetailView;

use frontend\backend\master\models\Pekerja;
use frontend\backend\master\models\Todolist;
use frontend\backend\master\models\UserProfil;

	$aryStt= [
		  ['STATUS' => 0, 'STT_NM' => 'PLAN'],		  
		  ['STATUS' => 1, 'STT_NM' => 'PROGRESS'],
		  ['STATUS' => 2, 'STT_NM' => 'FINISH'],
	];		
	$valStt = ArrayHelper::map($aryStt, 'STATUS', 'STT_NM');
	//echo 'no'.$keyACCESS_UNIX;
	$dataPekerja=ArrayHelper::map(Pekerja::find()->All(),'ID_PEKERJA','NAMA');
	$dataTodolist=ArrayHelper::map(Todolist::find()->All(),'ID','LIST_NAME');
	$modelProfile=UserProfil::find()->where(['ACCESS_UNIX'=>$keyACCESS_UNIX])->one();
	//print_r($modelProfile);
	
	$dvProfileInfo=DetailView::widget([
		'id'=>'dv-profile-info',
		'model' => $modelProfile,
		'attributes'=>[
			[
				'attribute' =>'KTP',
				'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
				'displayOnly'=>true,	
				'format'=>'raw'
			],
			[
				'attribute' =>'NM_DEPAN',
				'labelColOptions' => ['style' => 'text-align:right;width: 40%'],
				'displayOnly'=>true,	
				'format'=>'raw', 
				'value'=>$modelProfile->NM_DEPAN.' '.$modelProfile->NM_TENGAH.' '.$modelProfile->NM_BELAKANG,
			],
			[
				'attribute' =>'LAHIR_GENDER',
				'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
				'displayOnly'=>true,	
				'format'=>'raw'
			],
			[
				'attribute' =>'LAHIR_TEMPAT',
				'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
				'displayOnly'=>true,	
				'format'=>'raw'			
			],
			[
				'attribute' =>'LAHIR_TGL',
				'format'=>'raw',
				'displayOnly'=>true,
				'type'=>DetailView::INPUT_DATE,
				'widgetOptions' => [
					'pluginOptions'=>Yii::$app->gv->gvPliginDate()
				],
				'labelColOptions' => ['style' => 'text-align:right;width: 30%']
			],
			[
				'attribute' =>'HP',
				'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
				'displayOnly'=>true,	
				'format'=>'raw'
			],
			[
				'attribute' =>'EMAIL',
				'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
				'displayOnly'=>true,	
				'format'=>'raw'
			],			
			[
				'attribute' =>'ALAMAT',
				'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
				'displayOnly'=>true,	
				'format'=>'raw', 
				'value'=>'<kbd>'.$modelProfile->ALAMAT.'</kbd>',
			]
		],
		'condensed'=>true,
		'hover'=>true,
		 'panel'=>[
			'heading'=>'<b> CUSTOMER INFO <b>',
			'type'=>DetailView::TYPE_INFO,
		],
		'mode'=>DetailView::MODE_VIEW,
		'buttons1'=>'',
		'buttons2'=>'{view}{save}'
	]);
?>


<?php $form = ActiveForm::begin(); ?>
<div style="height:100%;font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="row" >
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">	
				<?=$form->field($modelJadwal,'ACCESS_UNIX')->textInput(['readonly'=>true,'value'=>$keyACCESS_UNIX])?>				
				<?=$form->field($modelJadwal, 'TGL')->widget(DatePicker::classname(), [
						'options' => ['placeholder' => 'Tanggal Kunjungan ...'],
						'pluginEvents'=>[
						  'show' => "function(e) {show}",
						],
						'pluginOptions' => [
							'format' => 'yyyy-mm-dd',	
							//'format' => 'dd-mm-yyyy hh:mm',			
							'autoclose' => true,
							'todayHighlight' => true,			
							'autoWidget' => true,
						]
					])
				?>
				<?=$form->field($modelJadwal, 'JAM_MASUK')->widget(DateTimePicker::classname(), [
						'name' => 'jam-masuk',
						'options' => ['placeholder' => 'Jam Masuk ...'],
						'pluginEvents'=>[
						  'show' => "function(e) {show}",
						],
						'pluginOptions' => [
							//'format' => 'yyyy-mm-dd',	
							'format' => 'hh:mm:ss',			
							'autoclose' => true,
							'todayHighlight' => true,			
							'autoWidget' => true,
						]
					])
				?>					
				<?=$form->field($modelJadwal, 'JAM_KELUAR')->widget(DateTimePicker::classname(), [
						'name' => 'jam-keluar',
						'options' => ['placeholder' => 'Jam Keluar ...'],
						'pluginEvents'=>[
						  'show' => "function(e) {show}",
						],
						'pluginOptions' => [
							//'format' => 'yyyy-mm-dd',	
							'format' => 'hh:mm:ss',			
							'autoclose' => true,
							'todayHighlight' => true,			
							'autoWidget' => true,
						]
					])
				?>	
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">	
				<?= $form->field($modelJadwal, 'ID_PEKERJA')->widget(Select2::classname(), [
						'name' => 'color_2a',
						'data' =>$dataPekerja,
						'options' => ['placeholder' => 'Pilih Gardener...','multiple' => true],
						// 'pluginOptions' => [
							// 'tags' => true,
							// 'tokenSeparators' => [',', ' '],
							// 'maximumInputLength' => 10
						// ],
					])->label("Pekerja/Gardener");
				?>
				<?= $form->field($modelJadwal, 'TODOLIST')->widget(Select2::classname(), [
						'data' =>$dataTodolist,
						'options' => ['placeholder' => 'Pilih ...','multiple' => true],
						'pluginOptions' => [
							'tags' => true,
							'tokenSeparators' => [',', ' '],
							'maximumInputLength' => 10
						],
					]);
				?>
				<?= $form->field($modelJadwal, 'KETERANGAN')->textarea(['rows' => 3]) ?>
				<?= $form->field($modelJadwal, 'STATUS')->widget(Select2::classname(), [
						'data' =>$valStt,//Yii::$app->gv->gvStatusArray(),						
						'options' => ['placeholder' => 'Pilih Status...'],						
					]);
				?>		
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">	
				<?=$dvProfileInfo?>	
			</div>
		</div>
			
	</div>
	<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
