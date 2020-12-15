<?php

use kartik\file\FileInput;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?= Url::to(['/affiliate']) ?>">Dashboard</a></li>
                            <li><a href="<?= Url::to(['index']) ?>">Profile</a></li>
                            <li class="active">Change Password</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">


        <div class="row">
            <div class="col-lg-offset-1 col-lg-10">
                <div class="card">
                    <div class="card-header"><strong>Change Password</strong>
                       
                    </div>
                    <div class="card-body card-block">
                        <?php $form = ActiveForm::begin(); ?>
                        <?= $form->field($model, 'new_password')->passwordInput() ?>
                        <?= $form->field($model, 'password_repeat')->passwordInput() ?>


                        <div class="form-actions form-group">
                            <button type="submit" class="btn btn-primary">Change password</button>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>