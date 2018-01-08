<?php
/**
 * simple creation project
 * @copyright Copyright (c) mohamed amr
 * @license https://github.com/science-handout/simple-project/blob/master/LICENSE (MIT License)
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







