<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CheckoutsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Checkouts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkouts-index">


    <p>
        <?//= Html::a('Create Checkouts', ['create'], ['class' => 'btn btn-success']) ?>
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
            //'current_balance',
            //'message',
            //'preferred_choice',
            //'approval_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
