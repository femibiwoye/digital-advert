<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/bootstrap-4/css/bootstrap.min.css',
        'fonts/icon-font/css/style.css',
        'fonts/typography-font/typo.css',
        'fonts/fontawesome-5/css/all.css',

        'plugins/aos/aos.min.css',
        'plugins/fancybox/jquery.fancybox.min.css',
        'plugins/nice-select/nice-select.css',
        'plugins/slick/slick.css',
        'css/settings.css',
        'css/main.css',
        'css/custom.css',
    ];
    public $js = [
        'plugins/jquery/jquery.min.js',
        'plugins/jquery/jquery-migrate.min.js',
        'plugins/bootstrap-4/js/bootstrap.bundle.min.js',
        'plugins/fancybox/jquery.fancybox.min.js',
        'plugins/nice-select/jquery.nice-select.min.js',
        'plugins/aos/aos.min.js',
        'plugins/slick/slick.min.js',
        'js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
