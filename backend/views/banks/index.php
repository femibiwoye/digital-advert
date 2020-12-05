<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BanksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banks-index">

    

    <p>
        <?= Html::a('Create Banks', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'user.name',
            'bank_name',
            'account_name',
            'created_at',
            //'updated_at',
            //'account_name',
            //'account_number',
            //'approval_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
