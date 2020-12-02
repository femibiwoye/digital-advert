<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserModelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'remember_token') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'is_admin') ?>

    <?php // echo $form->field($model, 'wallet_balance') ?>

    <?php // echo $form->field($model, 'verification_status') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'email_verified_at') ?>

    <?php // echo $form->field($model, 'phone_number') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'twitter_id') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'image_path') ?>

    <?php // echo $form->field($model, 'auth_key') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'token') ?>

    <?php // echo $form->field($model, 'affliliate_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
