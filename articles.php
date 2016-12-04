<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Resultats</title>
        <link rel="stylesheet" href="style.css" />
        <meta charset="utf-8" />
    </head>
    
    <body>
		<?php
		include("includes/menu.php");
		include("includes/header.php");
		include("includes/footer.php");
		?>
		
		<!-- Resultat requete en fonction formulaire de recherche et requete-->
<!--
		Le formulaire (checkbox doit changer le WHERE de la requete :
		modele = nom1 OR modele = nom2 etc  ... passer par une fonction renvoyant une chaine
		la concaténer avec la requete
		Afficher le retour de la requete
-->
    </body>
</html>
