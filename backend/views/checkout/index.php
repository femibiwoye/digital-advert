<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CheckoutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Checkouts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-index">

    <!--<p>
        <?php /*= Html::a('Create Checkout', ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            ['attribute'=>'user_id','label' => 'Name'],
            'amount',
            'current_balance',
            'preferred_choice',
            //'approval_status',
            //'approved_by',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
