<?php

return [

    ['class' => 'yii\rest\UrlRule', 'controller' => ['v1/aws'], 'extraPatterns' => [
        'GET lists' => 'list-bucket', //
        'POST add-bucket/<name:[a-z]+>' => 'create-bucket', //
        'POST upload-file/<folder:[a-z/-]+>' => 'upload-file', //
        'GET verify-file' => 'verify-file', //
        'DELETE delete-file' => 'delete-file', //
        'GET file-detail' => 'file-detail', //

    ]],

];