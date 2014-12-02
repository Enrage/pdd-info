<?php
if(!isset($_SESSION))
	session_start();
if(!$_SESSION['auth']['admin']) {
	header("Location: http://localhost/pdd-info/adminpdd/auth/enter.php");
	exit();
}
else {
	header("Location: http://localhost/pdd-info/adminpdd/");
	exit();
}
?>