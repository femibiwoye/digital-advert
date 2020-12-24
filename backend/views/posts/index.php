<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <p>
        <?= Html::a('Create Posts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user.name',
            //'updated_at',
            'user.name',
            'content:ntext',
            //'media:ntext',
            //'platforms:ntext',
            'is_approved',

            ['label' => 'Payment Status', 'value' => function ($model) {
                return isset($model->checkout) && !empty($model->checkout->payment_id) ? 'Paid' : 'Not paid';
            }],
            'is_posted_to_twitter',
            'created_at',
            //'is_promoted',
            //'comment_count',
            //'like_count',
            //'boost_amount',
            //'tweet_id',
            //'retweet_post_id',
            //'raw:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
