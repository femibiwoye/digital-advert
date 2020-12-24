<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\WithdrawalRequests */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Withdrawal Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="withdrawal-requests-view">

    <p>
        <?php
        if ($model->approval_status == 1) {
            echo '<div class="alert alert-success">Verified!</div>';
        }else{
            echo Html::a('Approve', ['approve', 'id' => $model->id], ['class' => 'btn btn-success']);
        }
        ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <button type="button" class="btn btn-default">
            Wallet Balance <span class="badge badge-light">&#8358;<?= $model->user->wallet_balance ?></span>
        </button>
    </p>


    <?php
    $attributes = [
        'id',
        'user.name',
        'amount',
        'method',
        ['attribute' => 'approval_status', 'value' => $model->approval_status == 1 ? 'Approved' : 'Not approved'],
        'approval.username',
        'created_at',
        'updated_at',
    ];
    if ($model->method == 'bank') {
        $attributes = array_merge($attributes, [
            'bank.account_name',
            'bank.account_number',
            'bank.bank_name',
        ]);
    } else {
        $attributes = array_merge($attributes, [
            ['attribute' => 'meta', 'label' => 'Phone Number'],
        ]);
    }

    echo DetailView::widget([
        'model' => $model,
        'attributes' => $attributes,

    ]) ?>

</div>
