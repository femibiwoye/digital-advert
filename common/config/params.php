<?php
Yii::setAlias('@webfolder', realpath(dirname(__FILE__) .'/../../frontend/web'));
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@morerave.com',
    'senderEmail' => 'noreply@example.com',
    'emailSender' => 'MoreRave',
    'user.passwordResetTokenExpire' => 3600,
    'baseUrl' => DOMAIN,
    'S3FileUpload' => API_DOMAIN.'/aws/upload-file/',
    's3BaseUrl' => 'https://morerave.s3.eu-west-2.amazonaws.com/',
    'email' => EMAIL,


    'AwsS3Key' => AWS_S3_KEY,
    'AwsS3Secret' => AWS_S3_SECRET,
    'apiDomain'=>API_DOMAIN,
    'apiDomainBase'=>API_DOMAIN_BASE,
    'TwitterConsumerKey'=>TWITTER_CONSUMER_KEY,
    'TwitterConsumerSecret'=>TWITTER_CONSUMER_SECRET,
    'TwitterAccessToken'=>TWITTER_ACCESS_TOKEN,
    'TwitterAccessTokenSecret'=>TWITTER_ACCESS_TOKEN_SECRET,
    'androidUrl'=>'https://drive.google.com/file/d/11bHmOaS6M4iKXHE9IXY29Ob8EefNtL01/view?usp=sharing'
    //'s3BaseUrl'=>'https://morerave.s3.eu-west-2.amazonaws.com/'
];
