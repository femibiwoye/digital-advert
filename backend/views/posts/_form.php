<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?php

function image($image)
{
    if (empty($image)) {
        return '@web/img/user-icon.png';
    } else {
        return '@web/img/media/' . $image;
    }
}

echo $form->field($model, 'media')->widget(FileInput::classname(), [
    'name' => 'media',
    'pluginOptions' => [
        'initialPreview' => [
            Html::img(image($model->media), ['class' => 'file-preview-image', 'alt' => $model->user_id, 'title' => $model->media, 'width' => 150]),
        ],
        'initialCaption' => $model->media,
        'overwriteInitial' => true,
    ],

    'options' => [
        'accept' => 'image/*',
        'multiple' => false,

    ],

]);

?>
    <?= $form->field($model, 'platforms')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'is_approved')->textInput() ?>

    <?= $form->field($model, 'boost_amount')->textInput() ?>

    <?= $form->field($model, 'tweet_id')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'is_posted_to_twitter')->textInput() ?>

    <?= $form->field($model, 'raw')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
