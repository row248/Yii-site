<?php

return array(
    'name' => 'My site',

    'import' => array(
        'application.models.*',
        'application.components.*',
    ),

    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '12345'
        ),
    ),

    'components' => array(

        'request' => array(
            'enableCsrfValidation' => true
        ),

        'authManager' => array(
            'class' => 'PhpAuthManager',
            'defaultRoles' => array('user'),
        ),

        'user' => array(
            'class' => 'WebUser',
            'allowAutoLogin' => true,
        ),

        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=site',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
    ),

    'params' => require dirname(__FILE__) . '/params.php',

);