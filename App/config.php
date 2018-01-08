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
define('DBNAME','');

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

define('APP',dirname(__FILE__));

/**
 * db path
 */

define('db',APP.'/db');


/**
 * helper path
 */
define('helper',APP.'/helper');

/**
 * session path
 */
define('session',APP.'/session');

/**
 * Upload path
 */
define('upload',APP.'/upload');

/**
 * validation path
 */
define('validation',APP.'/validation');

//=================================
//============== DBclass =========
//=================================

define('DB_CLASS','pdo');

//function Config($configName){
//    if(isset($configName)){
//        return $configName;
//    }else{
//        return APP;
//    }
//}
//
//function LoadConfig($configName,$path = ''){
//    if(isset($configName) && isset($path)){
//        $configName = include ("$path");
//    }
//    return $configName;
//}

