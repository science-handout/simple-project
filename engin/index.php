<?php
/**
 * simple creation project
 * @copyright Copyright (c) mohamed amr
 * @license https://github.com/science-handout/simple-project/blob/master/LICENSE (MIT License)
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