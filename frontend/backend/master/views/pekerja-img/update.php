<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\PekerjaImg */

$this->title = 'Update Pekerja Img: ' . $model->ID_PEKERJA;
$this->params['breadcrumbs'][] = ['label' => 'Pekerja Imgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_PEKERJA, 'url' => ['view', 'id' => $model->ID_PEKERJA]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pekerja-img-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
