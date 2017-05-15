<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\Pekerja */

$this->title = $model->ID_PEKERJA;
$this->params['breadcrumbs'][] = ['label' => 'Pekerjas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pekerja-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID_PEKERJA], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID_PEKERJA], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID_PEKERJA',
            'NAMA',
            'KTP',
            'GENDER',
            'TGL_LAHIR',
            'ALAMAT:ntext',
            'HP',
            'EMAIL:email',
            'CREATE_BY',
            'CREATE_AT',
            'UPDATE_BY',
            'UPDATE_AT',
        ],
    ]) ?>

</div>
