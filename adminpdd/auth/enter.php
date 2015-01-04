<?php
session_start();
include_once '../model/admin_model.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/pdd/config.php';
if(isset($_SESSION['auth']['admin'])) {
	if($_SESSION['auth']['admin']) {
		header("Location: ".PATH."adminpdd/");
		exit();
	}
}
$mysqli = new mysqli(HOST, USER, PASS, DB);
if($_POST) {
	try {
		$login_pdd = trim($mysqli->real_escape_string(strip_tags($_POST['login_pdd'])));
		$pass_pdd = trim($_POST['pass_pdd']);
		$query = "SELECT name_pdd, login_pdd, pass_pdd FROM pdd_users WHERE login_pdd = ? AND admin_pdd = 1 LIMIT 1";
		$stmt = $mysqli->stmt_init();
		if(!$stmt->prepare($query)) throw new Exception("Error Prepare Login");
		else {
			$stmt->bind_param('s', $login_pdd);
			$stmt->execute();
			$res = $stmt->get_result();
			$row = $res->fetch_array(MYSQLI_ASSOC);
			if($row['pass_pdd'] == md5($pass_pdd)) {
				$_SESSION['auth']['admin'] = htmlspecialchars($row['name_pdd']);
				$_SESSION['auth']['id_user'] = $row['id_user'];
				header("Location: ../");
				exit();
			} else {
				$_SESSION['res'] = '<div class="error">Логин или пароль не совпадает!</div>';
				header("Location: {$_SERVER['PHP_SELF']}");
				exit();
			}
			$stmt->close();
		}
	} catch(Exception $e) {
		print 'Ошибка: '.$e->getMessage();
	}
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Вход в админку</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="main">
	<div class="form_login">
	<h2>Administration Panel PDD-INFO</h2>
	<p><?php
	if(isset($_SESSION['res'])) {
		echo $_SESSION['res'];
		unset($_SESSION['res']);}?></p>
		<form action="" method="post" autocomplete="off" id="login">
			<p><input type="text" name="login_pdd" placeholder="Username"></p>
			<p><input type="password" name="pass_pdd" placeholder="Password"></p>
			<p><input id="subm" type="submit" value="Login"></p>
		</form>
	</div>
</div>
</body>
</html>