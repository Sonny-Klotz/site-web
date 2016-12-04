<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Recherche</title>
        <link rel="stylesheet" href="style.css" />
        <meta charset="utf-8" />
    </head>
    
    <body>
		<?php
		include("includes/menu.php");
		include("includes/header.php");
		include("includes/footer.php");
		?>
		
			<h1>Recherche d'articles</h1>
		<!-- formulaire de recherche pour un modele (boutique et prix optionnel)-->
		<form  action="articles.php" method="post">
			<fieldset>
				<legend>Modèles existants</legend>
<!--Generer un item pour chaque boutique et chaque modele en fonction d'une requete-->
<!--
				<input type="checkbox" name="nomModele" />
				<label for="nomModele">Nom modele</label>
-->
			</fieldset>
			<input type="submit" value="Rechercher" />
		</form>
    </body>
</html>
