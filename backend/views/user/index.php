<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-model-index">


    <p>
        <?= Html::a('Create User Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'remember_token',
            'name',
            'created_at',
            //'updated_at',
            'is_admin',
            //'wallet_balance',
            //'verification_status',
            //'name',
            //'email:email',
            //'email_verified_at:email',
            //'phone_number',
            //'password',
            //'twitter_id',
            //'username',
            //'image_path',
            //'auth_key',
            //'phone',
            //'status',
            //'token:ntext',
            //'affliliate_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
