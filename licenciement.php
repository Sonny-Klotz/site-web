<!DOCTYPE html>
<html>
	<head>
		<title>Licenciement</title>
		<!-- redirection automatique -->
		<meta charset="utf-8" http-equiv="refresh" content="2;rh.php"/>
	</head>
	<body>
<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=site-web;charset=utf8', 'root', 'user');
$bdd->exec('DELETE FROM Employe WHERE IDEmploye LIKE "'. $_POST['code'] . '"');
echo 'Licenciement effectué, redirection ...';
?>
	</body>
</html>
