<?php
/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */
require_once "../req.php";
$session->Start();

if(!$session->Get('admin')){

    $message = 'you are not login';
}

if($_GET['action'] == 'add'){
//add



}elseif($_GET['action'] == 'update'){
//update



}elseif($_GET['action'] == 'delete'){
//delete



}else{
//index


}
if (!empty($message)){
    require_once "../layout/Back/Errors/permission.html";
    exit();
}else{
    require_once "../layout/Back/header.html";

    require_once "../layout/Back/footer.html";
}

?>






