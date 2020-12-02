<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PostsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'media') ?>

    <?php // echo $form->field($model, 'platforms') ?>

    <?php // echo $form->field($model, 'is_approved') ?>

    <?php // echo $form->field($model, 'is_promoted') ?>

    <?php // echo $form->field($model, 'comment_count') ?>

    <?php // echo $form->field($model, 'like_count') ?>

    <?php // echo $form->field($model, 'boost_amount') ?>

    <?php // echo $form->field($model, 'tweet_id') ?>

    <?php // echo $form->field($model, 'retweet_post_id') ?>

    <?php // echo $form->field($model, 'is_posted_to_twitter') ?>

    <?php // echo $form->field($model, 'raw') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
