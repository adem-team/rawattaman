<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\PekerjaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pekerja-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID_PEKERJA') ?>

    <?= $form->field($model, 'NAMA') ?>

    <?= $form->field($model, 'KTP') ?>

    <?= $form->field($model, 'GENDER') ?>

    <?= $form->field($model, 'TGL_LAHIR') ?>

    <?php // echo $form->field($model, 'ALAMAT') ?>

    <?php // echo $form->field($model, 'HP') ?>

    <?php // echo $form->field($model, 'EMAIL') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
