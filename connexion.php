<!DOCTYPE html>
<html>
	<head>
		<title>Connexion</title>
		<!-- redirection automatique -->
		<meta charset="utf-8" http-equiv="refresh" content="1;accueil.php"/>
	</head>
	<body>
<?php
session_start();

$employe = $_POST['code'];

if(strcmp($employe, '0') == 0) //test table employe: id
{
	$_SESSION['type'] = 'employe';
	echo 'Connexion réussie, redirection ...';
}
else if(strcmp($employe, '1') == 0) //test vue responsable: id
{
	$_SESSION['type'] = 'responsable';
	echo 'Connexion réussie, redirection ...';
}
else //sinon code non existant, msg erreur
{
	echo 'Code non existant, redirection ...';
}
?>
	</body>
</html>
