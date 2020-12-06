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

    'GET v1/post/feed' => 'v1/post/all-post',
    'GET v1/post/my-post' => 'v1/post/my-post',
    'GET v1/post/approved-post' => 'v1/post/approved-post',
    'GET v1/post/pending-post' => 'v1/post/pending-post',

];