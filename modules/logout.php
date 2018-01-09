<?php
/**
 * simple creation project
 * @copyright Copyright (c) mohamed amr
 * @license https://github.com/science-handout/simple-project/blob/master/LICENSE (MIT License)
 */

require_once "../App/bootstrap/start.php";
require_once "../App/permission/permission.php";
$session->start();
new permission('admin','permission','','logout','');



?>
