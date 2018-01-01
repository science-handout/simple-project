<?php
/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */
require_once "../req.php";

$session->Start();

if($session->Get('admin')){

    exit('you are login');
}


if(isset($_POST['password'])){

    ($_POST['username']) ? $username = $_POST['username'] : $username = $_POST['email'];
    $password = $_POST['password'];

    $data = $user->select("WHERE `username` = $username && `password` = $password");
    if(!empty($data)){
        $session->Set('admin',$data);
        if (!file_exists('Admin/home.php')) {
            header('Location: Admin/home.php');
        }
    }
}

require_once "AdminDesign/login.html";
?>
