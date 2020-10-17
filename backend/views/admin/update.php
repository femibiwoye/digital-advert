<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = 'Update Admin: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admin-update">

    <?php $this->beginBlock('content-header'); echo Html::encode($this->title); $this->endBlock(); ?>

    <?= $this->render('_create', [
        'model' => $model,
    ]) ?>

</div>
