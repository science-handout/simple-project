<?php
/**
 * simple creation project
 * @copyright Copyright (c) mohamed amr
 * @license https://github.com/science-handout/simple-project/blob/master/LICENSE (MIT License)
 */
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
require_once "App/config.php";
//=================================
//============== core file ========
//=================================
function __autoload($class_name)
{
    if (file_exists( APP.'/'. $class_name . '.php')) {
        require_once APP.'/'.$class_name . '.php';
    } elseif(file_exists(db.'/'. $class_name . '.php')) {
        require_once db.'/'. $class_name . '.php';
    }elseif (file_exists(session.'/'. $class_name . '.php')){
        require_once session .'/'. $class_name . '.php';
    }elseif (file_exists(helper.'/'. $class_name . '.php')){
        require_once helper.'/'. $class_name . '.php';
    }elseif (file_exists(validation.'/'. $class_name . '.php')){
        require_once validation.'/'. $class_name . '.php';
    }elseif (file_exists(upload.'/'. $class_name . '.php')){
        require_once upload.'/'. $class_name . '.php';
    }elseif (file_exists(permission.'/'. $class_name . '.php')){
        require_once permission.'/'. $class_name . '.php';
    }elseif (file_exists(db.'/DBcore/'. $class_name . '.php')){
        require_once db.'/DBcore/'. $class_name . '.php';
    }elseif (file_exists(validation.'/translate/'. $class_name . '.php')){
        require_once validation.'/translate/'. $class_name . '.php';
    }elseif (file_exists('../database/'.$class_name.'.php')){
        require_once '../database/'.$class_name.'.php';
    }
}
//******************** init database type ****************
helper::DataBaseType();
//****************database file **************************
