<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
           'cookieValidationKey' => 'xTg_TwrOyxn8kl_KosDWEIHk4RjsFfLg',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
    ],
];

if (!YII_ENV_TEST) {

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
