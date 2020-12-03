<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Referrer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="referrer-form">

    <div class="content">
        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>


            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
    </div>

</div>
