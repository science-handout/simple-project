<?php
/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */
require_once "../req.php";
require_once "../App/permission/permission.php";
$session->Start();

new permission('admin','permission','header','','footer');


if($_GET['action'] == 'add'){
//add



}elseif($_GET['action'] == 'update'){
//update



}elseif($_GET['action'] == 'delete'){
//delete



}else{
//index


}

?>







