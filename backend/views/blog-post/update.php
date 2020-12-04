<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BlogPost */

$this->title = 'Update Blog Post: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Blog Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="blog-post-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
