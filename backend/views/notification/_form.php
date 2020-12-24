<?php

use Codeception\Command\Shared\Style;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Notification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-form">

    <?php $form = ActiveForm::begin(); ?>
    
    
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

  
    <?= $form->field($model, 'generality')->dropDownList([ 'general' => 'General', 'user' => 'User', 'affiliate' => 'Affiliate', ], ['prompt' => '', 'id' => 'generality',
  
    ])?>

    <div style="display:none" id="user">
    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(User::find()->where(['<>','status',0])->all(),'id','name'),
    'options' => ['multiple' => true,'placeholder' => 'Select user',],

]);?>
    </div>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
     $(function () {
        $("#generality").change(function () {
            if ($(this).val() == "user") {
                $("#user").show();
            } else {
                $("#user").hide();
            }
        });
    });
</script>