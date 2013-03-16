<?php

return array(
    'name' => 'My site',

    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',

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

        'components' => array(
            'urlManager' => array(
                'urlFormat' => 'path'
            )
        ),
        
        'clientScript' => array(

            'packages' => array(
                'main' => array(
                    'baseUrl' => 'files/main',
                    'js' => array('js.js'),
                    'css' => array('bootstrap.css', 'style.css'),
                    'depends' => array('jquery')
                ),

                'words' => array(
                    'baseUrl' => 'files/words',
                    'js' => array('js.js', 'bootstrap.js'),
                    'css' => array('bootstrap.css', 'style.css'),
                    'depends' => array('jquery')
                ),
            ),
        ),

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