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


    

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'user.name',
            'amount',
            'created_at',
            //'updated_at',
        
            //'current_balance',
            //'message',
            //'preferred_choice',
            //'approval_status',

            ['class' => 'yii\grid\ActionColumn','template' => '{view} {update}'],
        ],
    ]); ?>


</div>
