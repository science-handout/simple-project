<?php
/**
 * DB SYSTEM
 * helper functions
 * @author mohamed amr
 */


trait helper
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
     * use mysqli
     * System::Set('db',new mysqli());
     * use pdo
     * System::Set('db',new PdoDB());
     */

    public static function DataBaseType(){
        if(!empty(DB_CLASS)){
            if(DB_CLASS == 'pdo' || DB_CLASS == 'PDO'){
                System::Set('db',new PdoDB());
            }else{
                System::Set('db',new mysqlDB());
            }
        }
    }


}