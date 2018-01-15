<?php
/**
 * simple creation project
 * @copyright Copyright (c) mohamed amr
 * @license https://github.com/science-handout/simple-project/blob/master/LICENSE (MIT License)
 * php file
 */
require_once '../App/bootstrap/start.php';

session::start();
//$d = array('s'=>'s');
//session::Set('admin',$d);

permission::start('admin','permission','home');
if($_GET['action'] == 'add'){
//add



}elseif($_GET['action'] == 'update'){
//update



}elseif($_GET['action'] == 'delete'){
//delete



}else{
//index




}

require_once "../layout/Back/header.html";
require_once "../layout/Back/home.php";
require_once "../layout/Back/footer.html";

?>







