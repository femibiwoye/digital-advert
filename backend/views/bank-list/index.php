<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BankListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bank Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-list-index">
    <p>
        <?= Html::a('Create Bank', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'slug',
            'name',
            ['attribute' => 'status', 'value' => function ($model) {
                return $model->status == 1 ? 'Active' : 'Inactive';
            }],
            'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
