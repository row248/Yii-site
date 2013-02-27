<?php

define('YII_ENABLE_ERROR_HANDLER', false);
define('YII_ENABLE_EXCEPTION_HANDLER', false);


// include Yii bootstrap file
require_once(dirname(__FILE__).'/../framework/yii.php');

$config = dirname(__FILE__) . '/protected/config/main.php';

// create a Web application instance and run
Yii::createWebApplication($config)->run();