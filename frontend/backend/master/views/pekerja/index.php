<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\master\models\PekerjaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pekerjas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pekerja-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pekerja', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID_PEKERJA',
            'NAMA',
            'KTP',
            'GENDER',
            'TGL_LAHIR',
            // 'ALAMAT:ntext',
            // 'HP',
            // 'EMAIL:email',
            // 'CREATE_BY',
            // 'CREATE_AT',
            // 'UPDATE_BY',
            // 'UPDATE_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
