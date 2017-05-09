<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\Pekerja */

$this->title = 'Create Pekerja';
$this->params['breadcrumbs'][] = ['label' => 'Pekerjas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pekerja-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
