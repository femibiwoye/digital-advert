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


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'user.name',
            'amount',
            'method',
            'approval.name',
            ['attribute'=>'approval_status','value' => function($model){
        return $model->approval_status == 1?'Approved':'Not approved';
            }],
            'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
        ],
    ]); ?>


</div>
