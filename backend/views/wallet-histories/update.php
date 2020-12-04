<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WalletHistories */

$this->title = 'Update Wallet Histories: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Wallet Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wallet-histories-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
