<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\Rating */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rating-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'JADWAL_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ACCESS_UNIX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ID_PEKERJA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NILAI')->textInput() ?>

    <?= $form->field($model, 'NILAI_KETERANGAN')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'TGL')->textInput() ?>

    <?= $form->field($model, 'JAM_MASUK')->textInput() ?>

    <?= $form->field($model, 'JAM_KELUAR')->textInput() ?>

    <?= $form->field($model, 'STATUS')->textInput() ?>

    <?= $form->field($model, 'CREATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
