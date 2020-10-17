<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\password\PasswordInput;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList(['10' => 'Active', '0' => 'Inactive',], ['prompt' => '']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'level')->dropDownList(['super' => 'Super', 'admin' => 'Admin', 'content' => 'Content',], ['prompt' => '']) ?>
        </div>
    </div>
    <?php if ($model->isNewRecord) { ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => 30]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => 30]) ?>
            </div>
        </div>
    <?php } ?>

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
                'initialPreview' => !$model->isNewRecord ? [
                    Html::img(image($model->image),
                        ['class' => 'file-preview-image', 'alt' => $model->username, 'title' => $model->image, 'width' => 150]),
                ] : [],
                'showCaption' => false,
                'showRemove' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-primary btn-block',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' => 'Select Photo',
                'allowedFileExtensions' => ['jpg', 'gif', 'png']
            ],
            'options' => ['accept' => 'image/*']
        ]);
        ?>
    </div>


    <?php //= $form->field($model, 'created_at')->textInput()
    ?>

    <?php //= $form->field($model, 'updated_at')->textInput() 
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>