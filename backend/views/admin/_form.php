<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php //= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'status')->dropDownList(['10' => 'Active', '0' => 'Inactive',], ['prompt' => '']) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>


    <div class="form-group">

        <?php

        function image($image)
        {
            if (empty($image)) {
                return '@web/img/user-icon.png';
            } else {
                return '@web/img/admin/' . $image;
            }
        }

        echo $form->field($model, 'image')->widget(FileInput::classname(), [
            'name' => 'image',
            'pluginOptions' => [
                'initialPreview' => [
                    Html::img(image($model->image), ['class' => 'file-preview-image', 'alt' => $model->username, 'title' => $model->image, 'width' => 150]),
                ],
                'initialCaption' => $model->image,
                'overwriteInitial' => true,
            ],

            'options' => [
                'accept' => 'image/*',
                'multiple' => false,

            ],

        ]);

        ?>
    </div>

    <?php
    if (Yii::$app->user->identity->level == 'super') {
        echo $form->field($model, 'level')->dropDownList(['super' => 'Super', 'admin' => 'Admin', 'content' => 'Content',], ['prompt' => '']);
    } ?>

    <?php //= $form->field($model, 'created_at')->textInput() ?>

    <?php //= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
