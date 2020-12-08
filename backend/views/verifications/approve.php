<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
?>
<div class="verifications-form">

        <?= Html::beginForm(['approve'],'post') ?>
        
        <div class="form-group">
            <label for="name">Name</label>
            <input type="name" class="form-control" name="name" id="name" placeholder="Enter name">
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

