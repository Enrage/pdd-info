<?php
session_start();
header("Content-Type:text/html;charset=UTF-8");
include_once '../config.php';
include_once 'model/admin_model.php';
if(!$_SESSION['auth']['admin']) {
	header("Location: http://localhost/pdd-info/adminpdd/auth/enter.php");
}
if(isset($_GET['do'])) {
	if($_GET['do'] == "logout") {
		unset($_SESSION['auth']);
		header("Location: http://localhost/pdd-info/adminpdd/auth/enter.php");
	}
}
function __autoload($c) {
	if(file_exists("controller/".$c.".php")) {
		require_once 'controller/'.$c.'.php';
	}
	elseif(file_exists("model/".$c.".php")) {
		require_once 'model/'.$c.'.php';
	}
}
if(isset($_GET['option'])) {
	$class = trim(strip_tags($_GET['option']));
}
else {
	$class = 'admin';
}
if(class_exists($class)) {
	$obj = new $class;
	$obj->get_body($class);
}
else {
	die("<p>Неправильные данные для входа</p>");
}
?>