<?php
/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */
$message = '';
// ------------------ create table ---------------------
if(isset($_POST['table'])){
   $table = $_POST['table'];
    define('TABLENAME',"$table");
    require 'inc/create.php';
}
//-------------------------end ------------------------------
require_once "inc/Design/create.html";