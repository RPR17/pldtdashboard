<?php
session_start();

$btn_approved = (isset($_POST['btn_destroy'])) ? 'true' : 'false' ;

switch ($btn_approved) {
	case 'true':
		session_destroy();
		header('Location: ../index.php');
		die();
		break;
	
	default:
		header('Location: ../pages/');
		die();
		break;
}
?>