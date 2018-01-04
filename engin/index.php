<?php
/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */
require 'collection/create.php';
// ------------------ create anything ---------------------
$message = '';
if(isset($_POST['table'])){
    $create = new create($_POST['select'], $_POST['table']);
}
//-------------------------end ------------------------------
require_once "../engin/master/creatorDesign/create.html";