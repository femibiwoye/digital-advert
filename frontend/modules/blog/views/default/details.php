<?php

use yii\helpers\Url; ?>

<div class="page-banner">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-12">
                <div class="banner-content">
                    <h2 class="title">
                        <?= $model->title ?>
                    </h2>
                    <p><a href=""><?= date('M d, Y', strtotime($model->created_at)) ?></a> <span class="bullet"></span>
                        <a href=""><?= $model->category->title ?></a> <span class="bullet"></span> <a
                                href=""> <?= $model->creator->username ?></a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="pb-md-120 pb--10 pt--20">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb--40 mb-md--0">
                <div class="blog-post-details">
                    <div class="post-image mb--40">
                        <img src="<?= $model->image ?>" alt="">
                    </div>
                    <div class="text-block-1"><?= $model->message; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 omega-page-sidebar order-lg-1">
                <div class="single-sidebar">
                    <form action="<?=Url::to(['index'])?>">
                        <div class="sidebar-search">
                            <button><i class="fas fa-search"></i></button>
                            <input type="text" name="s" class="form-control" placeholder="Type to search">
                        </div>
                    </form>
                </div>
                <div class="single-sidebar post-block">
                    <h2 class="sidebar-title">Recent Posts</h2>
                    <?php foreach ($recent as $item) { ?>
                        <div class="sidebar-post-block">
                            <div class="single-post">
                                <h3 class="title"><a href="<?=Url::to(['details','slug'=>$item->slug])?>"><?= $item->title ?></a></h3>
                                <span class="date"><?= date('M d, Y', strtotime($item->created_at)) ?></span>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="single-sidebar post-block">
                    <h2 class="sidebar-title mb--20">Categories</h2>
                    <ul class="category-sidebar-list">
                        <?php foreach ($category as $item) { ?>
                            <li><a href=""><?= $item->title ?> <span>-  <?= $item->countPost ?> Posts</span></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
