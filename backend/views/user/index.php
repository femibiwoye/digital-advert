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

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'username',
            'first_name',
            'middle_name',
            'last_name',
            //'phone',
            //'email:email',
            //'image',
            //'type',
            //'wallet',
            //'previous_wallet',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'email_verified:email',
            //'profile_verified',
            //'status',
            //'verification_token',
            //'oauth_provider',
            //'oauth_uid',
            //'token',
            //'token_expires',
            //'last_accessed',
            //'is_boarded',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
