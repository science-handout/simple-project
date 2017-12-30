<?php

/**
 * DB SYSTEM
 * name : create file class
 * @author mohamed amr
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
        $this->GenerateFile($fileName, $basicFile);
        if ($type == 'table') {
            $res = $this->GenerateTable($file,$fileName);
            if ($res) {
                $this->includeFile('req.php', 'database',$file);
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
        if($type == 'admin') {
            $file = "Admin/" . $file . ".php";
        }elseif($type == 'page'){
            $file = $file . ".php";
        }elseif($type == 'table'){
            $file = "database/" . $file . ".php";
        }
        return $file;
    }


    /**
     *  return base file
     * @param $type
     * @return string
     */

    function Base($type){
       return "inc/{$type}File.php";
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
            return " the file created";
        }else{
           return ' the file exists';
        }
    }


    /**
     * generate table class
     * @param $fileName
     * @param $fileLocation
     * @return int
     */

    function GenerateTable($fileName,$fileLocation){

        $tableName = '$table';
        $replaceName = $fileName;
        $objectName = '$ob';
        $replaceObject = '$' . $fileName;
        $str = file_get_contents($fileLocation);
        $str = str_replace("$tableName", "$replaceName", $str);
        $str = str_replace("$objectName", "$replaceObject", $str);
        return file_put_contents($fileLocation, $str);
    }


    /**
     * to require table class in req file
     * @param $reqFile
     * @param $location
     * @param $fileName
     */



    function includeFile($reqFile,$location,$fileName){
        $current = file_get_contents($reqFile);
        $current .= "require_once '$location/" . $fileName . ".php';";
        file_put_contents($reqFile, $current . "\n");
    }


//--------------------------end ------------------------------
}


