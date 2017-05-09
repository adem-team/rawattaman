<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\Prodak */

$this->title = 'Update Prodak: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Prodaks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prodak-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
