<?php
session_start();

if (!isset($_SESSION['is_logged_in']) && !isset($_SESSION['logged_exp']) && !isset($_SESSION['logged_user'])) {
	header('Location: http://localhost/pldt_dash/');
}
else{
	$exp_at = time();

	if ($_SESSION['is_logged_in'] !== false) {
		if ($exp_at > $_SESSION['logged_exp']) {
		session_destroy();
		echo '<script language="JavaScript">
				alert("Your logged in has expired! ");
				window.location.href = "http://localhost/pldt_dash/";
		 	  </script>';
		}
		else{
			//session_regenerate_id(true);
			//$_SESSION['logged_exp'] = time();
			header('Location: http://localhost/pldt_dash/pages/');

		}
	}
}

?>