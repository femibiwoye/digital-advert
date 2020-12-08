<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Verifications */

$this->title = 'Update Verifications: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Verifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="verifications-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
