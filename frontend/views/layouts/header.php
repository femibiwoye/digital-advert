<?php

use yii\helpers\Url;
$module = Yii::$app->controller->module->id;
?>


<!-- Header Area -->
<header class="site-header bg--conflower-blue <?=$module != 'blog'?'sticky-header':null?> ">
    <div class="container-fluid pr-lg--30 pl-lg--30">
        <nav class="navbar site-navbar offcanvas-active navbar-expand-lg navbar-light">
            <!-- Brand Logo-->
            <div class="brand-logo"><a href="<?= Yii::$app->homeUrl ?>"><img src="<?= Url::to('@web/') ?>img/logo.png" alt=""></a></div>
            <div class="collapse navbar-collapse" id="mobile-menu">
                <div class="navbar-nav ml-lg-auto mr--10">
                    <ul class="navbar-nav main-menu">
                        <li class="nav-item ">
                            <a class="nav-link " id="" href="<?= Yii::$app->homeUrl ?>" aria-expanded="false">Home</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="<?= Url::to(['/site/about']) ?>" aria-haspopup="true"
                               aria-expanded="false">About
                                Us</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="<?= Url::to(['/blog']) ?>" aria-haspopup="true"
                               aria-expanded="false">Blog
                                </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="<?= Url::to(['/affiliates']) ?>" aria-haspopup="true"
                               aria-expanded="false">Affiliate</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="header-btns ml-auto ml-lg-0">
                <?php if(Yii::$app->user->isGuest){?>
                <a class="btn btn--primary btn-header hvr-bounce-to-left myLinkToTop" href="#">Download App</a>
                <?php }else{ ?>
                    <a class="btn btn--primary btn-header hvr-bounce-to-left myLinkToTop" href="<?=Url::to(['/affiliate'])?>">Dashboard</a>
                <?php } ?>
            </div>
            <button class="navbar-toggler btn-close-off-canvas" type="button" data-toggle="collapse"
                    data-target="#mobile-menu" aria-controls="mobile-menu" aria-expanded="false"
                    aria-label="Toggle navigation">
                <i class="icon icon-simple-remove icon-close"></i>
                <i class="icon icon-menu-34 icon-burger"></i>
            </button>
        </nav>
    </div>
</header>
