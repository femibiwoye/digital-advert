<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Verifications */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="verifications-form">

    <?php $form = ActiveForm::begin(); ?>

    
    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'verification_method')->dropDownList([ 'id' => 'Id', 'bank' => 'Bank', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'verification_media')->textarea(['rows' => 6]) ?>

    
    <?= $form->field($model, 'verified_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
