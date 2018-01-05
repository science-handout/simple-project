<?php
/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */
require_once "../req.php";
require_once "../App/permission/permission.php";

$session->Start();

new permission('admin','permission','','login','');


if(isset($_POST['password'])){

    ($_POST['username']) ? $username = $_POST['username'] : $username = $_POST['email'];
    $password = $_POST['password'];

    $data = $user->select("WHERE `username` = $username && `password` = $password");
    if(!empty($data)){
        $session->Set('admin',$data);
        if (!file_exists('modules/home.php')) {
            header('Location: modules/home.php');
        }
    }
}

?>
