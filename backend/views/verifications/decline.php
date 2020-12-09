<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

$this->title = 'Decline: '.$model->user->name;
?>
<div class="verifications-form">

        <?= Html::beginForm(null,'post') ?>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" name="message" id="message" placeholder="Message..." rows="3"></textarea>
            </div>
        

            <div class="form-group">
                <?= Html::submitButton('submit', ['class' => 'btn btn-success']) ?>
            </div>
            
        <?= Html::endForm() ?>
</div>

