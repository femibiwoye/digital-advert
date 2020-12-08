<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

$this->title = 'Approve: '.$model->user->name;
?>
<div class="verifications-form">

        <?= Html::beginForm(null,'post') ?>

    <img src="<?=$model->verification_media?>" height="200">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="<?=$user->name?>" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" name="message" id="message" placeholder="Message..." rows="3"></textarea>
        </div>
       

        <div class="form-group">
            <?= Html::submitButton('submit', ['class' => 'btn btn-success']) ?>
        </div>
        
        <?= Html::endForm() ?>

</div>

