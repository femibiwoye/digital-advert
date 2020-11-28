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
                            <li class="active">Edit</li>
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
                    <div class="card-header"><strong>Profile</strong>
                        <small> Edit</small>
                    </div>
                    <div class="card-body card-block">
                        <?php //= $this->render('@frontend/views/general/cropper', ['ref' => 'dashboard']); ?>
                        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                        <?= $form->field($model, 'username') ?>
                        <?= $form->field($model, 'phone') ?>
                        <?= $form->field($model, 'email') ?>
                        <?= $form->field($model, 'image_path')->fileInput(); ?>

<?php // ->widget(FileInput::classname(), [
//                            'options' => ['multiple' => false, 'accept' => 'image/*'],
//                            'pluginOptions' => [
//                                'initialPreview' =>  !$model->isNewRecord ? Yii::$app->params['baseUrl'].'/images/placeholders/' . $model->image_path:'',
//                                'initialPreviewAsData' => true,
//                                //'showPreview' => false,
//                                'showCaption' => true,
//                                'showRemove' => true,
//
//                                'showUpload' => false,
//                                'showCancel' => false
//                            ]
//                        ]) ?>


                        <div class="form-actions form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>