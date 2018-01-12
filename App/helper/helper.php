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
    public static function dd($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        die();
    }

    /**
     * @return array
     */
    public static function Url()
    {
        $urlNow = $_SERVER['REQUEST_URI'];
        $urlNow = explode('/', $urlNow);
        return $urlNow;
    }


public static function UploadFile($fileName,$type){

    $allow_ext = array("jpg", "gif", "png", "jpeg", "bmp");
    $maxsize = 1024 * 2; //kb
    if($type == "front" || $type == "Front"){
        $uploadFolder = 'layout/Public/Upload';
    }else{
        $uploadFolder = '../layout/Public/Upload';
    }
    $upload = new Upload($allow_ext, 250, 250, $maxsize, $uploadFolder, $thumbsFolder);
    if (isset($_FILES["$fileName"]['name']) AND $_FILES["$fileName"]['name'] != '') {
//get file name
        $file['name'] = addslashes($_FILES["$fileName"]["name"]);
// get file type
        $file['type'] = $_FILES["$fileName"]['type'];
// get filesize in KB
        $file['size'] = $_FILES["$fileName"]['size'] / 1024;
// get file tmp path
        $file['tmp'] = $_FILES["$fileName"]['tmp_name'];
//get file ext [to get max uploades size]
        $file['ext'] = $upload->GetExt($_FILES["$fileName"]["name"]);
//check if guest have selected file or not
        if ($file['name'] != '') {
// Start Uploading File
            $upfile = $upload->Upload_File($file, $maxsize);
//if uploading successfully
            if ($upfile) {
                $temp["$fileName"] = $upfile['newname'];
            } else {
                $error = true;
                $showError[] = $upload->showErrors();
                $top_msg['error'][] = $showError[0][0];
            }
        }
    }
    return $upfile['newname'];

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