<?php

use yii\widgets\LinkPager;
use yii\widgets\ListView;

?>
<div class="page-banner">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-6">
                <div class="banner-content">
                    <h2 class="title">
                        The MoreRave Blog
                    </h2>
                    <p>Our blog gives you latest updates and tips on making your businesses and brands known.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog-post-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb--50">
                <div class="row">


                    <?= ListView::widget([
                        'summary' => false,
                        'dataProvider' => $dataProvider,
                        'layout' => "<div class='postList row'>{items}</div>",
                        'itemOptions' => ['tag' => null],

                        //'layout' => null,
                        'itemView' => '_post',


                        /*'pager' => [
                            'firstPageLabel' => 'first',
                            'lastPageLabel' => 'last',
                            'nextPageLabel' => 'next',
                            'prevPageLabel' => 'previous',
                            'maxButtonCount' => 3,
                        ],*/
                    ]);
                    ?>

                </div>
                <div class="omega-blog-pagination pt--30">
                    <?= LinkPager::widget([
                        'pagination' => $dataProvider->pagination,
                        'prevPageLabel' => ' <i class="fas fa-chevron-left"></i>',
                        'nextPageLabel' => '<i class="fas fa-chevron-right"></i>',
                        'maxButtonCount' => 4,
                    ]); ?>
                </div>
            </div>
<!--            <div class="col-lg-4 omega-page-sidebar order-lg-1">-->
<!--                <div class="single-sidebar">-->
<!--                    <form action="">-->
<!--                        <div class="sidebar-search">-->
<!--                            <button><i class="fas fa-search"></i></button>-->
<!--                            <input type="text" class="form-control" name="s" placeholder="Type to search">-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
<!--                <div class="single-sidebar post-block">-->
<!--                    <h2 class="sidebar-title">Recent Posts</h2>-->
<!--                    <div class="sidebar-post-block">-->
<!--                        <div class="single-post">-->
<!--                            <h3 class="title"><a href="blog-right-sidebar.html#">How To Blow Through Capital At An Incredible Rate</a></h3>-->
<!--                            <span class="date">Jan 14, 2020</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="sidebar-post-block">-->
<!--                        <div class="single-post">-->
<!--                            <h3 class="title"><a href="blog-right-sidebar.html#">Design Studios That Everyone Should Know About? </a></h3>-->
<!--                            <span class="date">Jan 14, 2020</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="sidebar-post-block">-->
<!--                        <div class="single-post">-->
<!--                            <h3 class="title"><a href="blog-right-sidebar.html#">How did we get 1M+ visitors in 30 days without anything!</a></h3>-->
<!--                            <span class="date">Jan 14, 2020</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="sidebar-post-block">-->
<!--                        <div class="single-post">-->
<!--                            <h3 class="title"><a href="blog-right-sidebar.html#">Figma On Figma: How We Built Our Website Design System</a></h3>-->
<!--                            <span class="date">Jan 14, 2020</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="single-sidebar post-block">-->
<!--                    <h2 class="sidebar-title mb--20">Categories</h2>-->
<!--                    <ul class="category-sidebar-list">-->
<!--                        <li><a href="">Technology <span>-  20 Posts</span></a></li>-->
<!--                        <li><a href="">Freelancing <span> -  07 Posts</span></a></li>-->
<!--                        <li><a href="">Writing <span>-  16 Posts</span></a></li>-->
<!--                        <li><a href="">Marketing <span>-  11 Posts</span></a></li>-->
<!--                        <li><a href="">Business <span>-  35 Posts</span></a></li>-->
<!--                        <li><a href="">Education <span>-  14 Posts</span></a></li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
</div>