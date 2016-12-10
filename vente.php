<!DOCTYPE html>
<html>
	<head>
		<title>Vente</title>
		<!-- redirection automatique -->
		<meta charset="utf-8" http-equiv="refresh" content="2;stock.php"/>
	</head>
	<body>
<?php
include("includes/session.php");
$bdd->exec('UPDATE Article SET estVendu=1 WHERE IDArticle IN( SELECT MIN(IDArticle) FROM (SELECT * FROM Article) A WHERE A.modele="' . $_POST['modele'] . '" AND A.refBoutique="' . $_SESSION['boutique'] . '" AND estVendu=0)');
echo 'Vente effectuée, redirection ...';
?>
	</body>
</html>
