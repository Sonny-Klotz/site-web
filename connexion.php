<?php
function initSession($type, $login, $mdp, $nom, $prenom, $boutique) {
	// Variables globales
	$_SESSION['type'] = $type;
	$_SESSION['login'] = $login;
	$_SESSION['mdp'] = $mdp;
	$_SESSION['nom'] = $nom;
	$_SESSION['prenom'] = $prenom;
	$_SESSION['boutique'] = $boutique;
}

function testEmploye($login, $mdp, $bdd) {
	$employes = $bdd->query("SELECT * FROM Employe");
	$trouve = false;
	while ($employe = $employes->fetch()) {
		if(strcmp($employe['IDEmploye'], $login) == 0 && strcmp($employe['mdp'], $mdp) != 0) {
			echo 'Mot de passe invalide, redirection ...';
			$trouve = true;
			break;
		}
		else if(strcmp($employe['IDEmploye'], $login) == 0 && strcmp($employe['mdp'], $mdp) == 0) {
			echo 'Connexion réussie, redirection ...';
			initSession('employe', $login, $mdp, $employe['nom'], $employe['prenom'], $employe['refBoutique']);
			$trouve = true;
			break;
		}
	}
	// Si personne n'est trouvé
	$employes->closeCursor();
	return $trouve;
}

function testResponsable($login, $mdp, $bdd) {
$responsables = $bdd->query("SELECT B.IDResponsable, B.IDBoutique, E.nom, E.prenom, E.mdp FROM Boutique B, Employe E WHERE B.IDResponsable = E.IDEmploye");
	$trouve = false;
	while ($responsable = $responsables->fetch()) {
		if(strcmp($responsable['IDResponsable'], $login) == 0 && strcmp($responsable['mdp'], $mdp) != 0) {
			echo 'Mot de passe invalide, redirection ...';
			$trouve = true;
		}
		else if(strcmp($responsable['IDResponsable'], $login) == 0 && strcmp($responsable['mdp'], $mdp) == 0) {
			echo 'Connexion réussie, redirection ...';
			initSession('responsable', $login, $mdp, $responsable['nom'], $responsable['prenom'], $responsable['IDBoutique']);
			$responsables->closeCursor();
			$trouve = true;
		}
	}
	$responsables->closeCursor();
	return $trouve;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Connexion</title>
		<!-- redirection automatique -->
		<meta charset="utf-8" http-equiv="refresh" content="2;index.php"/>
	</head>
	<body>
<?php
include("includes/session.php");
$login = $_POST['login'];
$mdp = $_POST['mdp'];

if (!testResponsable($login, $mdp, $bdd)) {
	if(!testEmploye($login, $mdp, $bdd)) {
		echo "L'identifiant n'existe pas, redirection ...";
	}
}
?>
	</body>
</html>
