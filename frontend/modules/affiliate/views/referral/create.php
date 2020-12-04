<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Referrer */

$this->title = Yii::t('app', 'Create Your Referral  Code');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Referral Codes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referrer-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
