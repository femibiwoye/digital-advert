<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReferrerCodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Referrer Codes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referrer-code-index">

    <p>
        <?= Html::a('Create Referrer Code', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            'code',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>