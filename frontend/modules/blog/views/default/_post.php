<?php
/**
 * Created by IntelliJ IDEA.
 * User: femiibiwoye
 * Date: 18/04/2020
 * Time: 19:04
 */

use yii\helpers\Url;

?>

<div class="col-lg-4 col-md-4 mb--40">
    <div class="blog-card">
        <div class="blog-card_img">
            <img src="<?=$model->image?>" alt="">
        </div>
        <div class="blog-card_texts">
            <span class="post-date"><?=date('M d, Y', strtotime($model->created_at))?></span>
            <h3 class="post-title">
                <?=$model->title?>
            </h3>
            <p><?=$model->subtitle?> </p>
            <a href="<?=Url::to(['details','slug'=>$model->slug])?>" class="link-to-more">Continue Reading</a>
        </div>
    </div>
</div>


