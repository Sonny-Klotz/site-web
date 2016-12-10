<!DOCTYPE html>
<html>
	<head>
		<title>Embauche</title>
		<meta charset="utf-8" http-equiv="refresh" content="2;rh.php"/>
	</head>
	<body>
<?php
include("includes/session.php");

$bdd->exec('INSERT INTO Employe VALUES ("'  . $_POST['identifiant'] . '", "' . $_POST['nom'] . '", "' . $_POST['prenom'] . '", ' .  $_POST['salaire'] . ', "' . $_SESSION['boutique'] . '", "' . $_POST['mdp'] .'" )');
$bdd->exec('CREATE USER "' . $_POST['identifiant'] . '"@"localhost" identified by "' . $_POST['mdp'] . '"');
$bdd->exec('GRANT SELECT ON projet.* TO "' . $_POST['identifiant'] . '"@"localhost"');
$bdd->exec('GRANT INSERT, UPDATE ON projet.Article  TO "' . $_POST['identifiant'] . '"@"localhost"');
$bdd->exec('GRANT INSERT ON projet.Commander TO "' . $_POST['identifiant'] . '"@"localhost"');

echo 'Recrutement effectué, redirection ...';
?>
	</body>
</html>
