<!DOCTYPE html>
<html>
	<head>
		<title>Connexion</title>
		<!-- redirection automatique -->
		<meta charset="utf-8" http-equiv="refresh" content="1;index.php"/>
	</head>
	<body>
<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=site-web;charset=utf8', 'root', 'user');
$employes = $bdd->query("SELECT * FROM Employe");
$responsables = $bdd->query("SELECT B.IDResponsable, B.IDBoutique, E.nom, E.prenom FROM Boutique B, Employe E WHERE B.IDResponsable = E.IDEmploye");
$code = $_POST['code'];

// On test d'abord si c'est un responsable
while ($responsable = $responsables->fetch()) {
	if(strcmp($responsable['IDResponsable'], $code) == 0) {
		$_SESSION['type'] = 'responsable';
		$_SESSION['nom'] = $responsable['nom'];
		$_SESSION['prenom'] = $responsable['prenom'];
		$_SESSION['boutique'] = $responsable['IDBoutique'];
		echo 'Connexion réussie, redirection ...';
	}
}

// Sinon il peut etre un employe simple
if(strcmp($_SESSION['type'],'responsable') != 0) {
	while ($employe = $employes->fetch()) {
		if(strcmp($employe['IDEmploye'], $code) == 0) {
			$_SESSION['type'] = 'employe';
			$_SESSION['nom'] = $employe['nom'];
			$_SESSION['prenom'] = $employe['prenom'];
			$_SESSION['boutique'] = $employe['refBoutique'];
			echo 'Connexion réussie, redirection ...';
		}
	}
}

//si code non existant, il rest un invite
if(strcmp($_SESSION['type'],'invite') == 0) {
	echo 'Employe non existant, redirection ...';
}
	
$employes->closeCursor();
$responsables->closeCursor();
?>
	</body>
</html>
