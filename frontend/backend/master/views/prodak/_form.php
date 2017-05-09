<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\Prodak */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prodak-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PRODAK_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KETERANGAN')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'HARGA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DISCOUNT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SHARE_PROFIT')->textInput(['maxlength' => true]) ?>

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
