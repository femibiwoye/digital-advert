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
        <?= Html::a('Approve', ['approve', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <button type="button" class="btn btn-danger">
            Wallet Balance <span class="badge badge-light">&#8358;<?=$user_balance->wallet_balance?></span>
        </button>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'user.name',
            'amount',
            'method',
        ],
        
    ]) ?>
    
  
</div>
