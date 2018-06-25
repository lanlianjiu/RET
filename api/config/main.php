<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'app-api',
    'language' => 'zh-CN',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'appapi\controllers',
    'components' => [
         'user' => [ 
                        'identityClass' => 'api\models\userModel',
                        'enableAutoLogin' => true,
                        'enableSession'=>false,
                        'loginUrl' => null,
                    ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'urlManager' => [
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'enableStrictParsing' =>true,
                'rules' => [
                     [
                        'class' => 'yii\rest\UrlRule',
                        'controller' => ['v1/user'],
                        //'pluralize' => false, 
                    ],
                ],
            ]
    ],
    'modules' => [
        'v1' => [
            'class' => 'api\modules\v1\Module',
        ],
    ],
    'params' => $params,
];
