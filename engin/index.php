<?php
/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */
require 'collection/create.php';


// Or, an option that also works before PHP 5.3

// ------------------ create anything ---------------------
$message = '';
if(isset($_POST['table'])){
    $create = new create($_POST['select'], $_POST['table']);
}
//-------------------------end ------------------------------
require_once "master/creatorDesign/create.html";