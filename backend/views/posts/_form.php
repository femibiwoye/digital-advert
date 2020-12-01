<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\UserModel;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */
/* @var $form yii\widgets\ActiveForm */

$users = ArrayHelper::map(UserModel::find()->all(), 'id', function ($model) {
    return $model->firstname . ' ' . $model->middlename . ' ' . $model->lastname;
});
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'owner_id')->dropDownList($users) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'content')->textarea(['rows' => 3]) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'platform')->dropDownList(['twitter' => 'Twitter', 'instagram' => 'Instagram',], ['prompt' => '']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'approved')->dropDownList([1 => 'Active', 0 => 'Disapprove',], ['prompt' => '']) ?>
        </div>
    </div>


    <?php
    echo $form->field($model, 'file')->widget(FileInput::classname(), [
        'name' => 'image',
        'pluginOptions' => [
            'initialPreview' => [
                !empty($model->file) ? Html::img($model->file, ['class' => 'file-preview-image', 'alt' => $model->title, 'title' => $model->title, 'width' => 150]) : null,
            ],
            'initialCaption' => $model->title,
            'overwriteInitial' => true,
        ],

        'options' => [
            'accept' => 'image/*',
            'multiple' => false,

        ],

    ]);
    ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'paid_post')->textInput([1 => 'Paid', 0 => 'Free']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'approved')->dropDownList([1 => 'Active', 0 => 'Disapprove',], ['prompt' => '']) ?>
        </div>
    </div>

    <?= $form->field($model, 'multiple_file')->hiddenInput(['value' => 0])->label(false) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'advert_amount')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'payment_status')->dropDownList([1 => 'Paid', 0 => 'Unpaid'], ['prompt' => '']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
