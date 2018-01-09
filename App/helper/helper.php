<?php
/**
 * simple creation project
 * @copyright Copyright (c) mohamed amr
 * @license https://github.com/science-handout/simple-project/blob/master/LICENSE (MIT License)
 */

class helper
{
    /**
     * @param $data
     */
    public static function dd($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        die();
    }

    /**
     * @return array
     */
    public static function Url(){
        $urlNow =  $_SERVER['REQUEST_URI'];
        $urlNow = explode('/', $urlNow);
        return $urlNow;
    }



    /**
     * use mysqli
     * System::Set('db',new mysqli());
     * use pdo
     * System::Set('db',new PdoDB());
     */



//    public static function DataBaseType($DB_CLASS){
//        if(!empty(DB_CLASS)){
//            if(DB_CLASS == 'pdo' || DB_CLASS == 'PDO'){
//                System::Set('db',new PdoDB());
//            }elseif(DB_CLASS == 'mysql' || DB_CLASS == 'mysqli' || DB_CLASS == 'Mysql'){
//                System::Set('db',new mysqlDB());
//            }
//        }
//    }




}