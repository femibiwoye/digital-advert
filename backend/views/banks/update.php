<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Banks */

$this->title = 'Update Banks: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="banks-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
