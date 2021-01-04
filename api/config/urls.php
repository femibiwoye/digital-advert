<?php

return [
    //Authentications
    'POST v1/login' => 'v1/auth/login',
    'POST v1/signup' => 'v1/auth/signup',
    'POST v1/logout' => 'v1/auth/logout',
    'POST v1/forgot-password' => 'v1/auth/forgot-password',
    'POST v1/reset-password' => 'v1/auth/reset-password',

    'GET v1/token/<video_token:[a-zA-Z0-9/]+>' => 'v1/token',

    'GET v1/twitter-authorization' => 'v1/auth/twitter-authorization',
    'GET v1/twitter_callback' => 'v1/auth/authenticate-twitter-user',
    'GET v1/user' => 'v1/auth/user',
    'GET v1/active-status' => 'v1/auth/active-status',
    'GET v1/referrer-code' => 'v1/auth/referrer-code',

    'GET v1/post/feed' => 'v1/post/all-post',
    'GET v1/post/my-post' => 'v1/post/my-post',
    'GET v1/post/approved-post' => 'v1/post/approved-post',
    'GET v1/post/pending-post' => 'v1/post/pending-post',
    'POST v1/post/likes/<post_id:\d+>' => 'v1/post/like',
    'GET v1/post/likes/<post_id:\d+>' => 'v1/post/likes',
    'GET v1/post/comments/<post_id:\d+>' => 'v1/post/likes',
    'POST v1/post/create-post' => 'v1/post/create-post',
    'POST v1/post/retweet-post' => 'v1/post/retweet-post',
    'PUT v1/post/view-post/<post_id:\d+>' => 'v1/post/view-post',


    'GET v1/general/dashboard-statistics'=>'v1/general/dashboard-statistics',
    'GET v1/general/settings'=>'v1/general/settings',
    'POST v1/general/submit-verification'=>'v1/general/submit-verification',
    'GET v1/general/verification'=>'v1/general/my-verification',
    'DELETE v1/general/verification'=>'v1/general/delete-verification',
    'POST v1/general/profile-image'=>'v1/general/profile-image',
    'GET v1/general/search'=>'v1/general/search',

    'POST v1/payment/create-payment'=>'v1/payment/create-payment',
    'POST v1/payment/create-checkout/<post_id:\d+>'=>'v1/payment/create-checkout',
    'GET v1/payment/get-checkout'=>'v1/payment/get-checkout',
    'GET v1/payment/wallet-history'=>'v1/payment/wallet-history',
    'GET v1/payment/bank'=>'v1/payment/my-bank',
    'POST v1/payment/bank'=>'v1/payment/create-bank',
    'GET v1/payment/bank-list'=>'v1/payment/bank-list',
    'POST v1/payment/withdrawal'=>'v1/payment/create-withdrawal',
    'GET v1/payment/withdrawal'=>'v1/payment/get-withdrawals',


    'GET v1/notification'=>'v1/notification/index',
    'PUT v1/notification'=>'v1/notification/view-status',

    'POST v1/report/<type:[a-zA-Z]+>'=>'v1/general/report-post',
    'DELETE v1/delete-account'=>'v1/general/delete-account',



    'POST v1/tweets/post-tweet/<post_id:\d+>'=>'v1/tweets/post-tweet',
    'POST v1/tweets/post-retweet/<comment_id:\d+>'=>'v1/tweets/post-retweet'
];