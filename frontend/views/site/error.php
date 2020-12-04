<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = $name;
?>
<div class="error-page">
    <main class="error-page-main">
        <div class="container">
            <div class="contents">
                <div class="content-icon">
                    <img src="<?=Url::to('@web/')?>image/png/heart-shape.png" alt="">
                </div>
                <div class="content-text">
                    <h1 class="title"><?= Html::encode($this->title) ?></h1>
                    <p>The page you are looking for is not available or doesn’t<br class="d-none d-md-block"> belong to
                        this website!</p>
                </div>
                <div class="content-btn">
                    <a href="<?= Yii::$app->homeUrl ?>" class="btn btn-primary--outlined">Go back to home</a>
                </div>
            </div>
        </div>
    </main>
</div>