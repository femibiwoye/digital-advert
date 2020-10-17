<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="<?= Url::to('@web') ?>image/custom/rave-favicon.svg" type="image/x-icon">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php
$action = Yii::$app->controller->action->id;
if ($action == 'about')
    $extraClass = 'about-page';
elseif ($action == 'terms' || $action == 'privacy')
    $extraClass = 'terms-page';
else
    $extraClass = 'terms-page';
?>


<div id="loading">
    <div class="load-circle"><span class="one"></span></div>
</div>
<div class="site-wrapper overflow-hidden">
    <div class="<?=$extraClass?> landing-1">
        <?= $this->render('header') ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        <?= $this->render('footer') ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
