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


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'user.name',
            'code',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
