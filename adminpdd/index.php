<?php
define('PDD', true);
session_start();
header("Content-Type:text/html;charset=UTF-8");
include_once '../config.php';
include_once 'model/admin_model.php';
if(!$_SESSION['auth']['admin']) {
	header("Location: auth/enter.php");
}
if(isset($_GET['option'])) {
	if($_GET['option'] == "logout") {
		unset($_SESSION['auth']);
		header("Location: auth/enter.php");
	}
}
function __autoload($c) {
	if(file_exists("controller/".$c.".php")) {
		require_once 'controller/'.$c.'.php';
	} elseif(file_exists("model/".$c.".php")) {
		require_once 'model/'.$c.'.php';
	}
}
if(isset($_GET['option'])) {
	$class = trim(strip_tags($_GET['option']));
} else {
	$class = 'admin';
}
if(class_exists($class)) {
	$obj = new $class;
	$obj->get_body($class);
} else die("<p style='color:#900;font:16px Roboto, Tahoma;'>Access Denied</p>");
?>