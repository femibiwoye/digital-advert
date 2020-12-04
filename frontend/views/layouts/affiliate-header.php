<?php

use yii\helpers\Url;
use yii\helpers\Html;

$user = Yii::$app->user->identity;

?>

<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="./"><img src="<?= Url::to('@web/') ?>img/logo.png" alt="MoreRave"></a>
            <a class="navbar-brand hidden" href="./"><img src="<?= Url::to('@web/') ?>img/logo.png" alt="MoreRave"></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">

            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    <img class="user-avatar rounded-circle" src="<?=$user->image_path?>" alt="User Avatar">
                </a>

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="<?=Url::to(['/affiliate/profile'])?>"><i class="fa fa- user"></i>My Profile</a>

                    <a class="nav-link" href="<?=Url::to(['/affiliate/notifications'])?>"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                    <a class="nav-link" href="<?=Url::to(['/affiliate/profile/password'])?>"><i class="fa fa -cog"></i>Settings</a>

                    <?=Html::a('<i class="fa fa-power -off"></i>Logout', Url::to(['/site/logout']), ['data-method' => 'POST', 'class' => 'nav-link']) ?>
                </div>
            </div>

        </div>
    </div>
</header>
