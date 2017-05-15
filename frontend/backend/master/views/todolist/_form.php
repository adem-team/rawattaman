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
?>

<div class="todolist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'LIST_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KETERANGAN')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'STATUS')->widget(Select2::classname(), [
			'data' =>$valStt,//Yii::$app->gv->gvStatusArray(),
			'options' => ['placeholder' => 'Pilih Status...'],
		]);
	?>

  
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
