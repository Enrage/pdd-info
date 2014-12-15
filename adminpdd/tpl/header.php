<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
	<script type="text/javascript" src="js/jquery-2.1.1.js"></script>
	<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
	<title>Admin Panel</title>
</head>
<body>
<div id="wrapper">
	<header>
		<p class="name_admin">Админ: &nbsp;<span><?=$_SESSION['auth']['admin']?></span></p>
		<h1>Admin Panel PDD-INFO</h1>
		<p class="exit"><a href="?option=logout">Выйти</a></p>
	</header>
	<div id="main">
		<div id="content">
			<div class="container">