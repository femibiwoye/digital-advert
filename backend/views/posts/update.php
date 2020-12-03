<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */

$this->title = 'Update Posts: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="posts-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
