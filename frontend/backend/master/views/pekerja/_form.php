<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\Pekerja */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pekerja-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NAMA')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
