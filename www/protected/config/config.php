<?php
/*
 * Copyright (C) 2007-2013 Alibaba Group Holding Limited
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2 as
 * published by the Free Software Foundation.
 */
 
return array(
    // base path
    'basePath' => dirname(dirname(__FILE__)),
    // site name
    'name' => 'Toast',
    // log
    'preload' => array('log'),
    // ui language
    'language' => 'zh_cn',
    // theme
    'theme' => 'classic',
    // time zone
    'timeZone' => 'Asia/Shanghai',
    // imports frameworks' models&components
    'import' => array(
        'application.models.*',
        'application.models.report.*',
        'application.models.moniter.*',
        'application.components.*',
        'application.utilities.*',
        'application.parsers.*'
    ),
    // modules
    'modules' => array(
        'admin' => array(
            'defaultController' => 'product'
    )),
    // define default controller
    'defaultController' => 'site',
    // components
    'components' => array(
        // define user component
        'user' => array(
            'allowAutoLogin' => true,
            'loginUrl' => array('/site/login'),
            'class' => 'WebUser'
        ),
        // define url manager component
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '<action:(index|login|logout|about|signup)>' => 'site/<action>',
            ),
        ),
        // define database configurations
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=toast',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => '',
        ),
        // define error handler
        'errorHandler' => array(
            'errorAction' => 'site/error'
        ),
        // define log configurations
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'info, error, warning',
                )
            )
        ),
        'cache' => array(
            'class' => 'CDbCache',
            'connectionID' => 'db',
        ),
        'session' => array(
            'class' => 'CDbHttpSession',
            'connectionID' => 'db',
        ),
    ),
    
    // parameters
    'params' => array(
        'runFilePath' => '/tmp/toast',
        'parserPath' => dirname(__FILE__) . '/../parsers/',
        'stageLockFile' => dirname(__FILE__) . '/../runtime/stage.lock.',
        'runOutputPath' => '/tmp/toast_output/',
        'uploadPath' => dirname(__FILE__) . '/../../upload/attachments/',
        'ciConfigSample' => dirname(__FILE__) . '/../data/ci_run.conf.sample',
        'winAgentLink' => '/upload/public/toastagent.msi',
        'rraPath' => '/tmp/rra/',
        'caseRun' => '/home/ads/runcase/run_case', 
        'pageSize' => 5,
        'dateFormat' => 'Y-m-d H:i:s',
        'diffPattern' => 'https://code.google.com/p/toast-test/source/diff?r=$re&format=side&path=$file',

        'smtp' => array(
            'host' => '127.0.0.1',
            'FromName' => 'Toast',
            'From' => 'toast-noreply@toast'
        ),
    )
);
?>
