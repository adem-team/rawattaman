<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\Prodak */

$this->title = 'Create Prodak';
$this->params['breadcrumbs'][] = ['label' => 'Prodaks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prodak-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
