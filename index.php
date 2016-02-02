<?php

// admin
// BE9rm6DO0BpyUfhsSfbD

// client
// ;9;'9=C6)WRz4^KX


// admin
// OZItkig3C3WW1dX

// client
// oco2xgMrS42govb

// // remove the following lines when in production mode
// defined('YII_DEBUG') or define('YII_DEBUG',true);
// // specify how many levels of call stack should be shown in each log message
// defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);



// change the following paths if necessary
$yii=dirname(__FILE__).'/protected/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
$autoload=dirname(__FILE__).'/protected/vendor/autoload.php';

require_once $autoload;
require_once($yii);
Yii::createWebApplication($config)->run();
