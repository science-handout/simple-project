<?php

/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */

class create{




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








    function Base($type){
       return "inc/{$type}File.php";
    }






    function GenerateFile($file,$basicFile){

        if (!file_exists($file)) {
            copy($basicFile, $file);
            return " the file created";
        }else{
           return ' the file exists';
        }
    }







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







    function includeFile($reqFile,$location,$fileName){
        $current = file_get_contents($reqFile);
        $current .= "require_once '$location/" . $fileName . ".php';";
        file_put_contents($reqFile, $current . "\n");
    }


//--------------------------end ------------------------------
}


