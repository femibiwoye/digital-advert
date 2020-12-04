<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WithdrawalRequests */

$this->title = 'Update Withdrawal Requests: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Withdrawal Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="withdrawal-requests-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
