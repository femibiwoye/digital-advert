<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'created_at')->textInput() ?>

    <?//= $form->field($model, 'updated_at')->textInput() ?>

    <?//= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'media')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'platforms')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_approved')->textInput() ?>

    <?= $form->field($model, 'is_promoted')->textInput() ?>

    <?= $form->field($model, 'comment_count')->textInput() ?>

    <?= $form->field($model, 'like_count')->textInput() ?>

    <?= $form->field($model, 'boost_amount')->textInput() ?>

    <?= $form->field($model, 'tweet_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retweet_post_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_posted_to_twitter')->textInput() ?>

    <?= $form->field($model, 'raw')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
