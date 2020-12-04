<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReferrerCode */

$this->title = 'Create Referrer Code';
$this->params['breadcrumbs'][] = ['label' => 'Referrer Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referrer-code-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
