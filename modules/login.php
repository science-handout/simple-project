<?php
/**
 * simple creation project
 * @copyright Copyright (c) mohamed amr
 * @license https://github.com/science-handout/simple-project/blob/master/LICENSE (MIT License)
 */
require_once '../App/bootstrap/start.php';
session::start();
permission::start('admin','permission','','login','');



if(isset($_POST['password'])){

    ($_POST['username']) ? $username = $_POST['username'] : $username = $_POST['email'];
    $password = $_POST['password'];

    $data = user::select("WHERE `username` = '$username' && `password` = '$password'");

    if(!empty($data)){
        session::Set('admin',$data);
        if (file_exists('home.php')) {
            header('Location: home.php');
        }
    }
}

?>
