<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\WalletHistoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wallet Histories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wallet-histories-index">


    <p>
        <?= Html::a('Create Wallet Histories', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'operation',
            //'updated_at',
            'user_id',
            'type',
            'old_balance',
            'new_balance',
            'created_at',
            //'IP',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
