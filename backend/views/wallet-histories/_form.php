<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WalletHistories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wallet-histories-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'debit' => 'Debit', 'credit' => 'Credit', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'old_balance')->textInput() ?>

    <?= $form->field($model, 'new_balance')->textInput() ?>

    <?= $form->field($model, 'operation')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
