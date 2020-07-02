<?php

  session_start();


?>

<?php
include_once('inc/session/session.php');
include_once('inc/function/function.php'); 

$_SESSION['admin_id']=null;
$_SESSION['username']=null;
$_SESSION['task_id']=null;
$_SESSION['college']=null;
 redicrt('index.php');
 ?>
