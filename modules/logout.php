<?php
/**
 * simple creation project
 * @copyright Copyright (c) mohamed amr
 * @license https://github.com/science-handout/simple-project/blob/master/LICENSE (MIT License)
 */

require_once '../App/bootstrap/start.php';
session::start();
permission::start('admin','permission','logout');


    header('Location: login.php');


?>
