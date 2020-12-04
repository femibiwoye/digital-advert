<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Category;
$category = Category::find()->all();

/* @var $this yii\web\View */
/* @var $model common\models\BlogPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'subtitle')->textarea(['rows' => 3]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'meta')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <?= $form->field($model, 'message')->textarea(['rows' => 6,'class'=>'ckeditor']) ?>

    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        'options' => ['multiple' => false, 'accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview' =>  !$model->isNewRecord ?  $model->image:'',
            'initialPreviewAsData' => true,
            //'showPreview' => false,
            'showCaption' => true,
            'showRemove' => true,

            'showUpload' => false,
            'showCancel' => false
        ]
    ]) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList([1 => 'Active', 0 => 'Inactive']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($category,'id','title'))->label('Category') ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script src="<?= Yii::$app->params['baseUrl'] ?>/ckeditor/ckeditor.js"></script>