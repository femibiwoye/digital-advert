<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Checkout */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="checkout-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'current_balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preferred_choice')->dropDownList([ 'bank' => 'Bank', 'airtime' => 'Airtime', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'approval_status')->textInput() ?>

    <?= $form->field($model, 'approved_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
