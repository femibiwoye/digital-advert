<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="posts-view">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if($model->is_approved == 0) echo Html::a('Approve', ['approve', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'user.name',
            'content:ntext',
            ////'media:json',
            [
                'attribute' => 'image',
                'value' => is_array($model->media) ? implode(',', $model->media):$model->media,
                'format' => ['image', ['height' => '200']],
            ],
            ['attribute' => 'platforms', 'value' => is_array($model->platforms) ? implode(',', $model->platforms):$model->platforms],
            'is_approved',
            'is_promoted',
            ['value'=>isset($model->checkout) && !empty($model->checkout->payment_id) ? 'Paid' : 'Not paid','label'=>'Payment Status'],
            'comment_count',
            'like_count',
            'boost_amount',
            'tweet_id',
            'retweet_post_id',
            'is_posted_to_twitter',
            'raw:ntext',

        ],
    ]) ?>

</div>
