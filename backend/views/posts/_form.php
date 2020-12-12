<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use common\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */
/* @var $form yii\widgets\ActiveForm */
$model->media = is_array($model->media) ? $model->media[0] : $model->media;
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
            return $image;
        }
    }

    echo $form->field($model, 'media')->widget(FileInput::classname(), [
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
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->all(),'id','name')) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'platforms')->dropDownList(['twitter']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'is_approved')->dropDownList([1 => 'Approved', 2 => 'Disapprove']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'boost_amount')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'start_at')->textInput(['type' => 'datetime-local']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'end_at')->textInput(['type' => 'datetime-local']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
