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

];