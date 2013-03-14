<?php

define('YII_ENABLE_ERROR_HANDLER', false);
define('YII_ENABLE_EXCEPTION_HANDLER', false);
define('YII_DEBUG', true);

define('PATH_TO_SRT', "userFiles/srt/");
define('PATH_TO_FILES_FROM_DB', "userFiles/db/");
define('PATH_TO_WORDS', "userFiles/fromFiles/");


// include Yii bootstrap file
require_once(dirname(__FILE__).'/../framework/yii.php');
require_once(dirname(__FILE__) . '/protected/components/helper.php');
$config = dirname(__FILE__) . '/protected/config/main.php';

// create a Web application instance and run
Yii::createWebApplication($config)->run();
