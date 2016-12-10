<!DOCTYPE html>
<html>
	<head>
		<title>Licenciement</title>
		<meta charset="utf-8" http-equiv="refresh" content="2;rh.php"/>
	</head>
	<body>
<?php
include("includes/session.php");
$bdd->exec('DELETE FROM Employe WHERE IDEmploye LIKE "'. $_POST['id'] . '"');
$bdd->exec('DROP USER "' . $_POST['id'] . '"@"localhost"');
echo 'Licenciement effectué, redirection ...';
?>
	</body>
</html>
