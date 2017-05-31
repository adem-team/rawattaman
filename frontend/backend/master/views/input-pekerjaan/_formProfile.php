<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="rating-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'ACCESS_UNIX')->textInput(['maxlength' => true]) ?>

    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
