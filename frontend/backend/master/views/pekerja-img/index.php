<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\master\models\PekerjaImgSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pekerja Imgs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pekerja-img-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pekerja Img', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID_PEKERJA',
            'IMAGE_64:ntext',
            'STATUS',
            'CREATE_BY',
            'CREATE_AT',
            // 'UPDATE_BY',
            // 'UPDATE_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
