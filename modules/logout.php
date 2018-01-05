<?php
/**
 * DB SYSTEM
 *
 * @author mohamed amr
 */
require_once "../req.php";
$session->Start();


if(!$session->Get('admin')){

    exit('you are not login');
}

$session->Stop();

?>
