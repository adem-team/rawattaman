<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\PekerjaImg */

$this->title = 'Create Pekerja Img';
$this->params['breadcrumbs'][] = ['label' => 'Pekerja Imgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pekerja-img-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
