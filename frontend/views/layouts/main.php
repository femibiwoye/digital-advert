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
    <link rel="shortcut icon" href="<?= Url::to('@web/') ?>img/favicon.png" type="image/x-icon">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php
$action = Yii::$app->controller->action->id;
$controller = Yii::$app->controller->id;
$module = Yii::$app->controller->module->id;

if ($action == 'about')
    $extraClass = 'about-page landing-1';
elseif ($action == 'terms' || $action == 'privacy')
    $extraClass = 'terms-page landing-1';
elseif ($controller == 'affiliates' && $action == 'index')
    $extraClass = 'landing-6';
else
    $extraClass = 'terms-page landing-1';
?>


<div id="loading">
    <div class="load-circle"><span class="one"></span></div>
</div>
<div class="site-wrapper overflow-hidden">
    <div class="<?= $extraClass ?>">
        <?= $this->render('header') ?>
        <?= \frontend\components\Alert::widget() ?>
        <?= $content ?>
        <?php
        if ($action != 'error')
            echo $this->render('footer');
        ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
