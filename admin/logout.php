<?php

  session_start();


?>

<?php
include_once('includes/session/session.php');
include_once('includes/functions/functions.php'); 

$_SESSION['admin_id']=null;
 $_SESSION['username']=null;
 redicrt('../index.php');
 ?>
