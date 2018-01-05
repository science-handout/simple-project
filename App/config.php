<?php
/**
 * DB SYSTEM
 * config file
 * @author mohamed amr
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
 * upload path
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