<?php
require __DIR__ . '/../../vendor/autoload.php';

if (file_exists(__DIR__ . '/../../.env')) {
    $dotenv = \Dotenv\Dotenv::create(__DIR__ . '/../../');
    $dotenv->load();
}

defined('YII_DEBUG') or define('YII_DEBUG', (bool)$_ENV['YII_DEBUG']);
defined('YII_ENV') or define('YII_ENV', $_ENV['YII_ENV']);

require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';
require __DIR__ . '/../config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/main.php',
    require __DIR__ . '/../../common/config/main-local.php',
    require __DIR__ . '/../config/main.php',
    require __DIR__ . '/../config/main-local.php'
);

(new yii\web\Application($config))->run();
