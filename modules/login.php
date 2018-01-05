<?php
/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */
require_once "../req.php";

$session->Start();

if($session->Get('admin')){

    $message = 'you are login';
}


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
if (!empty($message)){
    require_once "../layout/Back/Errors/permission.html";
    exit();
}else{
    require_once "../layout/Back/login.html";
}

?>
