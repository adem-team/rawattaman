<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\RatingImg */

$this->title = 'Update Rating Img: ' . $model->RETING_ID;
$this->params['breadcrumbs'][] = ['label' => 'Rating Imgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->RETING_ID, 'url' => ['view', 'id' => $model->RETING_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rating-img-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
