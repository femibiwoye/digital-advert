<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\WithdrawalRequestsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Withdrawal Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="withdrawal-requests-index">

    <p>
        <?= Html::a('Create Withdrawal Requests', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'created_at',
            'updated_at',
            'user_id',
            'amount',
            //'method',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
