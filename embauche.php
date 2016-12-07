<!DOCTYPE html>
<html>
	<head>
		<title>Embauche</title>
		<!-- redirection automatique -->
		<meta charset="utf-8" http-equiv="refresh" content="2;rh.php"/>
	</head>
	<body>
<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=site-web;charset=utf8', 'root', 'user');
$bdd->exec('INSERT INTO Employe VALUES ("'  . $_POST['mail'] . '", "' . $_POST['nom'] . '", "' . $_POST['prenom'] . '", ' .  $_POST['salaire'] . ', "' . $_SESSION['boutique'] . '" )');
echo 'Recrutement effectué, redirection ...';
?>
	</body>
</html>
