<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//echo 'no'.$keyACCESS_UNIX;
?>

<?php $form = ActiveForm::begin(); ?>
<div style="height:100%;font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="row" >
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">	
				<?= $form->field($model, 'JADWAL_ID')->textInput(['maxlength' => true]) ?>

				<?= $form->field($model, 'ACCESS_UNIX')->textInput(['maxlength' => true]) ?>

				<?= $form->field($model, 'ID_PEKERJA')->textInput(['maxlength' => true]) ?>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">	
				<?= $form->field($model, 'NILAI')->textInput() ?>

				<?= $form->field($model, 'NILAI_KETERANGAN')->textarea(['rows' => 6]) ?>

				<?= $form->field($model, 'TGL')->textInput() ?>

				<?= $form->field($model, 'JAM_MASUK')->textInput() ?>

				<?= $form->field($model, 'JAM_KELUAR')->textInput() ?>

				<?= $form->field($model, 'STATUS')->textInput() ?>			
			</div>	
		</div>	
	</div>	
	<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>	

<?php ActiveForm::end(); ?>


