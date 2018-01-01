<?php
/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */
require_once "../req.php";
$session->Start();


if(!$session->Get('admin')){

    exit('you are not login');
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
require_once "AdminDesign/header.html";
?>






<?php require_once "AdminDesign/footer.html"; ?>

