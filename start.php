<?php
/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */
require 'inc/create.php';
$message = '';
// ------------------ create anything ---------------------
if(isset($_POST['table'])){

   $table = $_POST['table'];
    define('TABLENAME',"$table");
    $create = new create($_POST['select'], TABLENAME);
}
//-------------------------end ------------------------------
require_once "inc/Design/create.html";