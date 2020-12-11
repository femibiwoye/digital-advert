<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Verifications */

$this->title = 'Create Verifications';
$this->params['breadcrumbs'][] = ['label' => 'Verifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="verifications-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
