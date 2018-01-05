<?php
/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */
require_once "../req.php";
$session->Start();


if(!$session->Get('admin')){

    $message ='you are not login';
}



if (!empty($message)){
    require_once "../layout/Back/Errors/permission.html";
    exit();
}else{
    $session->Stop();
}
?>
