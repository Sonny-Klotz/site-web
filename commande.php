<?php
	function nom($modeleprix) {
		//modeleprix = le POST : nomModele&prix (tout sauf le dernier elt est le nom du modele)
		$array = explode("&", $modeleprix);
		$str = "";
		for($i = 0 ; $i < count($array) - 1 ; $i++) {
			$str .= $array[$i];
		}
		
		return $str;
	}
	
	function prix($modeleprix) {
		//modeleprix = le POST : nomModele&prix (le dernier element du tableau est le prix)
		$array = explode("&", $modeleprix);
		//prix de vente egal à 3 fois le prix fournisseur
		return 3 * intval($array[count($array) - 1]);
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Commande</title>
		<!-- redirection automatique -->
		<meta charset="utf-8" http-equiv="refresh" content="2;stock.php"/>
	</head>
	<body>
<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=site-web;charset=utf8', 'root', 'user');
//On ajoute la commande
$bdd->exec('INSERT INTO Commander (refBoutique, modele, dateCommande, quantite) VALUES ("'  . $_SESSION['boutique'] . '", "' . nom($_POST['modele']) . '", "' .  $_POST['date'] . '", ' . $_POST['quantite'] . ' )');

//On ajoute les articles dans la boutique
$i = 0;
for($i = 0 ; $i < $_POST['quantite'] ; $i++) {
	$bdd->exec('INSERT INTO Article (modele, prixVente, dateVente, refBoutique) VALUES("' . nom($_POST['modele']) . '", ' . prix($_POST['modele']) . ', NULL, "' . $_SESSION['boutique'] . '")');
}
echo 'Commande effectuée, redirection ...';
?>
	</body>
</html>
