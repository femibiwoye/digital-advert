<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
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
                                <img src="<?=Url::to('@web/')?>image/custom/moreRave-blue-logo.svg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-xl-6">
                        <div class="main-block text-center">
                            <div class="omega-form">
                                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                                <div class="form-title mb--35">
                                    <h2 class="title">Sign In</h2>
                                    <p>Enter your account details below</p>
                                </div>
                                <?= $form->field($model, 'username')->textInput(['placeholder' => 'Username or Email'])->label(false) ?>

                                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>

                                <?php /*= $form->field($model, 'rememberMe')->checkbox() */?>

                                <div class="form-group button-block">
                                    <p class="sign-up-text">If you forgot your password you
                                        can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                                        <br>
                                        Need new verification
                                        email? <?= Html::a('Resend', ['site/resend-verification-email']) ?></p>
                                </div>
                                <div class="form-group button-block">
                                    <?= Html::submitButton('Login', ['class' => 'form-btn', 'name' => 'login-button']) ?>
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

