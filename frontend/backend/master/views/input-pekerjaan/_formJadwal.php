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

	$aryStt= [
			  ['STATUS' => 0, 'STT_NM' => 'Disable'],		  
			  ['STATUS' => 1, 'STT_NM' => 'Enable'],
		];	
	$valStt = ArrayHelper::map($aryStt, 'STATUS', 'STT_NM');
	//echo 'no'.$keyACCESS_UNIX;
?>


<?php $form = ActiveForm::begin(); ?>
<div style="height:100%;font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="row" >
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">			
				<?= $form->field($model,'ACCESS_UNIX')->textInput(['value'=>$keyACCESS_UNIX])?>				 
				<?= $form->field($model, 'ID_PEKERJA')->textInput(['maxlength' => true]) ?>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">		
				<?= $form->field($model, 'TGL')->textInput() ?>
				<?= $form->field($model, 'HARI')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'JAM_MASUK')->textInput() ?>
				<?= $form->field($model, 'JAM_KELUAR')->textInput() ?>				
				<?= $form->field($model, 'STATUS')->widget(Select2::classname(), [
						'data' =>$valStt,//Yii::$app->gv->gvStatusArray(),
						'options' => ['placeholder' => 'Pilih Status...'],
					]);
				?>			
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">	
				<?= $form->field($model, 'TODOLIST')->textarea(['rows' => 6]) ?>
				<?= $form->field($model, 'KETERANGAN')->textarea(['rows' => 6]) ?>
			</div>
						
		</div>
			
	</div>
	<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
