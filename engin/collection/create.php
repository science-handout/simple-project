<?php

/**
 * simple creation project
 * @copyright Copyright (c) mohamed amr
 * @license https://github.com/science-handout/simple-project/blob/master/LICENSE (MIT License)
 */

class create{


    /**
     * @param $type
     * @param $file
     */

    function __construct($type,$file)
    {
        $fileName = $this->CheckType($type, $file);
        $basicFile = $this->Base($type);
        $generate_res = $this->GenerateFile($fileName, $basicFile);
        if($generate_res) {
            if ($type == 'Table') {
                $res = $this->GenerateTable($file, $fileName);
//                if ($res) {
//                    $this->includeFile('../start.php', 'database', $file);
//                }
            }elseif($type == 'Back'){
                $this->GenerateNav($file,$type);
            }
        }
    }


    /**
     * check type to return file path
     * @param $type
     * @param $file
     * @return string
     */

    function CheckType($type,$file){
        if($type == 'Back') {
            $file = "../modules/" . $file . ".php";
        }elseif($type == 'Front'){
            $file = '../../'.$file . ".php";
        }elseif($type == 'Table'){
            $file = "../database/" . $file . ".php";
        }
        return $file;
    }


    function GenerateNav($title,$type){

        if($type == 'Back'){
            $current = file_get_contents("../layout/Back/nav.php");
            $current .= "<li class='nav-item'>";
            $current .= "<a class='nav-link' href='{$title}.php'>{$title}</a>";
            $current .= "</li>";
            file_put_contents("../layout/Back/nav.php", $current . "\n");
        }
    }


    /**
     *  return base file
     * @param $type
     * @return string
     */

    function Base($type){
        switch ($type){
            case 'Back' :
                $base = "collection/Back/create{$type}.std";
                break;
            case 'Front':
                $base = "collection/Front/create{$type}.std";
                break;
            case 'Table':
                $base = "collection/Table/create{$type}.std";
                break;
            case 'DB':
                $base = "collection/DB/create{$type}.std";
                break;
        }
        return $base;
    }


    /**
     * generate file and check if file exist
     * @param $file
     * @param $basicFile
     * @return string
     */

    function GenerateFile($file,$basicFile){
        if (!file_exists($file)) {
        copy($basicFile, $file);
            return true;
        }else{
           return false;
        }
    }


    /**
     * generate table class
     * @param $fileName
     * @param $fileLocation
     * @return int
     */

    function GenerateTable($fileName,$fileLocation){

        $tableName = '{{table}}';
        $replaceName = $fileName;
        $str = file_get_contents($fileLocation);
        $str = str_replace("$tableName", "$replaceName", $str);
        return file_put_contents($fileLocation, $str);
    }


    /**
     * to require table class in req file
     * @param $reqFile
     * @param $location
     * @param $fileName
     */


//    function includeFile($reqFile,$location,$fileName){
//        $current = file_get_contents($reqFile);
//        $current .= "require_once '$location/" . $fileName . ".php';";
//        file_put_contents($reqFile, $current . "\n");
//    }

    /**
     * Check connection string 
     * Cheack if Exist DB 
     */
    public function CheckExisDB($host,$uname,$pass){
    
    }
//--------------------------end ------------------------------
}


