<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReferrerCode */

$this->title = 'Update Referrer Code: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Referrer Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="referrer-code-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
