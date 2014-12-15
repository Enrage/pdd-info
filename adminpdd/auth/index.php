<?php
if(!isset($_SESSION)) session_start();
if(!$_SESSION['auth']['admin']) {
	header("Location: ".PATH."adminpdd/auth/enter.php");
	exit();
} else {
	header("Location: ".PATH."adminpdd/");
	exit();
}
?>