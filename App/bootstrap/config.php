<?php
/**
 * simple creation project
 * @copyright Copyright (c) mohamed amr
 * @license https://github.com/science-handout/simple-project/blob/master/LICENSE (MIT License)
 */
//=================================
//============== database =========
//=================================

/**
 *  DBTYPE is database type like mysql or sql server
 *  mysql is a default
 */
define('DBTYPE','mysql');

/**
 * DBNAME is database name
 */
define('DBNAME','test');

/**
 *  HOST database server
 */
define('HOST','localhost');

/**
 * USER is database username
 */
define('USER','root');

/**
 * PASS if database has password
 */
define('PASS','');



//=================================
//============== paths ===========
//=================================

/**
 *  CSS_PATH
 */

define('CSS_PATH','../layout/Public/CSS/');

/**
 *  JS PATT
 */

define('JS_PATH','../layout/Public/JS/');

/**
 *  images path
 */

define('IMAG_PATH','../layout/Public/Images/');

/**
 * app path
 */

//=================================
//============== files ============
//=================================
$urlNow =  $_SERVER['REQUEST_URI'];
$urlNow = explode('/', $urlNow);
if($urlNow[2] == "modules"){
    $app = "../App";
    $db = "../database";
}else{
    $app = "App";
    $db = "database";
}
define('APP',"$app");
define('database',"$db");
define('db',APP.'/db');
define('helper',APP.'/helper');
define('session',APP.'/session');
define('system',APP.'/system');
define('upload',APP.'/upload');
define('validation',APP.'/validation');
define('permission',APP.'/permission');



