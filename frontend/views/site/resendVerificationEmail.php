<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Resend verification email';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="site-wrapper overflow-hidden">
    <div class="sign-page">
        <div class="site-wrapper contact-wrapper">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-xl-6">
                        <div class="brand text-center pt--40">
                            <a href="<?=Yii::$app->homeUrl?>">
                                <img src="<?= Url::to('@web/') ?>image/custom/moreRave-blue-logo.svg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-xl-6">
                        <div class="main-block text-center">
                            <div class="omega-form">
                                <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>
                                <div class="form-title mb--35">
                                    <h2 class="title"><?= Html::encode($this->title) ?></h2>
                                    <p>Enter your account details below</p>
                                </div>
                                <?= $form->field($model, 'email')->textInput(['placeholder' => 'Username or Email'])->label(false) ?>
                                <div class="form-group button-block">
                                    <?= Html::submitButton('Send', ['class' => 'form-btn', 'name' => 'login-button']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>