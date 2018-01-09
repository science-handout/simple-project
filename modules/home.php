<?php
/**
 * simple creation project
 * @copyright Copyright (c) mohamed amr
 * @license https://github.com/science-handout/simple-project/blob/master/LICENSE (MIT License)
 */
require_once '../start.php';
session::start();

//$data = array('user'=>'ahmed','pass'=>'123');
//session::set('admin',$data);

permission::start('admin','permission','','','');


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







