<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

$path = __DIR__ . '/../';

require $path .'vendor/autoload.php';
require $path .'vendor/yiisoft/yii2/Yii.php';
require $path .'common/config/bootstrap.php';
require $path .'frontend/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require $path .'common/config/main.php',
    require $path .'common/config/main-local.php',
    require $path .'frontend/config/main.php',
    require $path .'frontend/config/main-local.php'
);

(new yii\web\Application($config))->run();
