<?php
include 'connect_db.php';
//Roates
    $tpl 	= 'includes/templates/'; // Template Directory
	$func	= 'includes/functions/'; // Functions Directory
	$sess	= 'includes/session/'; // session Directory
	$css 	= 'layout/css/'; // Css Directory
	$js 	= 'layout/js/'; // Js Directory

	// Include The Important Files
	include $sess . 'session.php';
	include $func . 'functions.php';
	include $tpl . 'header.php';

	// Include Navbar On All Pages Expect The One With $noNavbar Vairable

	if (!isset($noNavbar)) { include $tpl . 'navbar.php'; }