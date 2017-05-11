<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\RatingImg */

$this->title = 'Create Rating Img';
$this->params['breadcrumbs'][] = ['label' => 'Rating Imgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rating-img-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
