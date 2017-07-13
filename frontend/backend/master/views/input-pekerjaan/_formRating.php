<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\detail\DetailView;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\StarRating;

use frontend\backend\master\models\Pekerja;
use frontend\backend\master\models\Todolist;
use frontend\backend\master\models\UserProfil;
	
	$modelProfile=UserProfil::find()->where(['ACCESS_UNIX'=>$keyACCESS_UNIX])->one();
	$dataPekerja=ArrayHelper::map(Pekerja::find()->All(),'ID_PEKERJA','NAMA');
	$dataTodolist=ArrayHelper::map(Todolist::find()->All(),'ID','LIST_NAME');
	$aryStt= [
		  ['STATUS' => 0, 'STT_NM' => 'PLAN'],		  
		  ['STATUS' => 1, 'STT_NM' => 'PROGRESS'],
		  ['STATUS' => 2, 'STT_NM' => 'FINISH'],
	];		
	$valStt = ArrayHelper::map($aryStt, 'STATUS', 'STT_NM');
	// $s=explode(",",$modelJadwal->ID_PEKERJA,1000);
	// print_r($s);
	// die();
	$dvProfileInfo=DetailView::widget([
		'id'=>'dv-profile-info',
		'model' => $modelProfile,
		'attributes'=>[
			[
				'attribute' =>'ACCESS_UNIX',
				'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
				'displayOnly'=>true,	
				'format'=>'raw'
			],
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
				<?= $form->field($modelRating,'ACCESS_UNIX')->hiddenInput(['readonly'=>true,'value'=>$keyACCESS_UNIX])->label(false);?>
				<?=$dvProfileInfo?>	
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<?= $form->field($modelRating, 'JADWAL_ID')->hiddenInput(['value'=>$modelJadwal->ID,'maxlength' => true])->label(false); ?>				
				<?= $form->field($modelRating, 'TGL')->textInput(['readonly'=>true,'value'=>$modelJadwal->TGL,'maxlength' => true]) ?>
				<?= $form->field($modelRating, 'hari')->textInput(['readonly'=>true,'value'=>$modelJadwal->HARI,'maxlength' => true]) ?>
				<?= $form->field($modelRating, 'JAM_MASUK')->textInput(['readonly'=>true,'value'=>$modelJadwal->JAM_MASUK,'maxlength' => true]) ?>
				<?= $form->field($modelRating, 'JAM_KELUAR')->textInput(['readonly'=>true,'value'=>$modelJadwal->JAM_KELUAR,'maxlength' => true]) ?>				
				<?= $form->field($modelRating, 'STATUS')->widget(Select2::classname(), [
						'name' => 'status-pekerja',
						'data' =>$valStt,
						'disabled' => true,
						'options' => [	
							'value'=>$modelJadwal->STATUS,
						]
					]);
				?>		
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="padding-top:15px">
				<?php
					//$modelRating->ID_PEKERJA=['RT0001'];\
					$valPekerja=explode(",",$modelJadwal->ID_PEKERJA,1000);
					echo $form->field($modelRating, 'ID_PEKERJA')->widget(Select2::classname(), [
						'name' => 'data-pekerja',
						//'disabled'=>true,
						'readonly'=>true,	
						'data' =>$dataPekerja,											
						'options' => [
							'value' =>$valPekerja,
							'multiple' => true,							
						],
						'pluginOptions' => [
							'tags' => true,
							'tokenSeparators' => [',', ''],							
						],
						
					])->label("Pekerja/Gardener");
				?>
				<?php
					echo $form->field($modelRating, 'todolist')->widget(Select2::classname(), [
						'name' => 'data-todolist',
						'data' =>$dataTodolist,	
						'disabled' => true,						
						'options' => [
							'value' =>[$modelJadwal->TODOLIST],
							'placeholder' => 'Pilih Todolist...','multiple' => true
						],
						'pluginOptions' => [
							'tags' => true,
							'maximumInputLength' => 10
						],
					])->label("Todolist");
				?>
				<?= $form->field($modelRating, 'NILAI')->widget(StarRating::classname(), ['disabled' => true,]);?>
				<?php //= $form->field($modelRating, 'NILAI_KETERANGAN')->textarea(['rows' => 2]) ?>

					
			</div>	
				
			
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
			<div class="pull-right ">
				<?php
					if($modelJadwal->STATUS==1){
						echo Html::submitButton('Save To Rating', ['class' => 'btn btn-success']);
					}
				?>
			</div>	
		</div>	
	</div>	
	</div>
</div>	

<?php ActiveForm::end(); ?>


