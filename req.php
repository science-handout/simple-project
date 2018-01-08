<?php
/**
 * simple creation project
 * @copyright Copyright (c) mohamed amr
 * @license https://github.com/science-handout/simple-project/blob/master/LICENSE (MIT License)
 */
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);

//----------core file ------------------------------------
require_once APP.'/config.php';
require_once db.'/DB.php';
require_once db . '/DBcore/mysqlDB.php';
require_once db.'/DBcore/PdoDB.php';
require_once APP.'/System.php';
require_once session.'/Session.php';
require_once helper.'/helper.php';
require_once validation.'/Validation.php';
require_once validation.'/translate/translate.php';
require_once upload.'/upload.php';
//******************** init database type ****************
helper::DataBaseType();
//****************database file **************************
require_once 'database/user.php';
