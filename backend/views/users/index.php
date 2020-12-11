<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'remember_token',
            'created_at',
            'updated_at',
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
            //'affiliate_id',
            //'state',
            //'country',
            //'about:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
