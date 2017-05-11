<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\RatingImgSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rating-img-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'RETING_ID') ?>

    <?= $form->field($model, 'ACCESS_UNIX') ?>

    <?= $form->field($model, 'IMAGE_64') ?>

    <?= $form->field($model, 'STATUS') ?>

    <?= $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
