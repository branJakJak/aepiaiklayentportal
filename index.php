<?php
// defined('YII_DEBUG') or define('YII_DEBUG',true);
// defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);


// admin
// BE9rm6DO0BpyUfhsSfbD

// client
// ;9;'9=C6)WRz4^KX


// admin
// OZItkig3C3WW1dX

// client
// oco2xgMrS42govb



//
// ROLES
// administrator - required
// client - required
// facilitator - required
// exporter - optional





// change the following paths if necessary
$yii=dirname(__FILE__).'/protected/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
$autoload=dirname(__FILE__).'/protected/vendor/autoload.php';

require_once $autoload;
require_once($yii);
Yii::createWebApplication($config)->run();
