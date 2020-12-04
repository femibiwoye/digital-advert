<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\UserModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'remember_token')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'created_at')->textInput() ?>

    <?//= $form->field($model, 'updated_at')->textInput() ?>

    <?//= $form->field($model, 'is_admin')->textInput() ?>

    <?//= $form->field($model, 'wallet_balance')->textInput() ?>

    <?//= $form->field($model, 'verification_status')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'email_verified_at')->textInput() ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'twitter_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php

function image($image)
{
    if (empty($image)) {
        return '@web/img/user-icon.png';
    } else {
        return '@web/img/media/' . $image;
    }
}

echo $form->field($model, 'image_path')->widget(FileInput::classname(), [
    'name' => 'media',
    'pluginOptions' => [
        'initialPreview' => [
            Html::img(image($model->image_path), ['class' => 'file-preview-image', 'alt' => $model->id, 'title' => $model->image_path, 'width' => 150]),
        ],
        'initialCaption' => $model->image_path,
        'overwriteInitial' => true,
    ],

    'options' => [
        'accept' => 'image/*',
        'multiple' => false,

    ],

]);

?>
    <?//= $form->field($model, 'image_path')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'type'=>'number']) ?>

    <?//= $form->field($model, 'status')->textInput() ?>

    <?//= $form->field($model, 'token')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
