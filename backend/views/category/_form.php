<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'description')->textarea(['rows' => 6,'class'=>'ckeditor']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'meta')->textarea(['rows' => 12]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'position')->textInput(['placeholder' => 'Arrangement position']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList([1 => 'Active', 0 => 'Inactive']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script src="<?= Yii::$app->params['baseUrl'] ?>/ckeditor/ckeditor.js"></script>