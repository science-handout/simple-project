<?php
/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);

//----------core file ------------------------------------
require_once 'inc/db/config.php';
require_once 'inc/db/DB.php';
require_once 'inc/db/mysql.php';
require_once 'inc/db/System.php';
require_once 'inc/session/Session.php';
//****************database file **************************
require_once 'database/user.php';
