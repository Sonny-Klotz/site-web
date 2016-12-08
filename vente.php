<!DOCTYPE html>
<html>
	<head>
		<title>Vente</title>
		<!-- redirection automatique -->
		<meta charset="utf-8" http-equiv="refresh" content="2;stock.php"/>
	</head>
	<body>
<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=site-web;charset=utf8', 'root', 'user');
$bdd->exec('UPDATE Article SET dateVente="' . $_POST['dateVente'] . '" WHERE IDArticle IN( SELECT MIN(IDArticle) FROM (SELECT * FROM Article) A WHERE A.modele="' . $_POST['modele'] . '" AND A.refBoutique="' . $_SESSION['boutique'] . '" AND dateVente IS NULL)');

echo 'Vente effectuée, redirection ...';
?>
	</body>
</html>
