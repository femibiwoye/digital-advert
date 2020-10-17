<?php

use yii\helpers\Url; ?>


<!-- Footer section -->
<div class="footer-section">
    <div class="container">

        <div class="copyright-area">
            <div class="row align-items-center">
                <div class="col-sm-6  text-sm-left text-center mb-2 mb-sm-0">
                    <p class="copyright-text">&copy; <?=date('Y')?> moreRave, All Rights Reserved &nbsp;&nbsp; |&nbsp;&nbsp; <a
                                href="<?=Url::to(['/site/privacy'])?>">Privacy Policy</a>&nbsp;&nbsp; |&nbsp;&nbsp; <a
                                href="<?=Url::to(['/site/terms'])?>">Terms & Condition </a></p>
                </div>
                <div class="col-sm-6 text-sm-right text-center">
                    <ul class="social-icons">
                        <li><a href=""><i class="icon icon-logo-twitter"></i></a></li>
                        <li><a href=""><i class="icon icon-logo-fb-simple"></i></a></li>
                        <!--s<li><a href=""><i class="icon icon-google"></i></a></li>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


