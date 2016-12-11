<!DOCTYPE html>
<html>
    <head>
        <title>Recherche</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
        <meta charset="utf-8" />
    </head>
    
    <body>
		<?php
		include("includes/session.php");
		include("includes/header.php");
		include("includes/menu.php");
		include("includes/login.php");
		?>
		<div class="contenu">
			<h1>Recherche d'articles</h1>
			
		<form  action="articles.php" method="post" id="recherche">
			<fieldset>
				<legend>Modèles existants</legend>
					<ul>
				<?php
				$articles = $bdd->query('SELECT modele FROM Fournisseur');
				while ($article = $articles->fetch()) {
					echo '<li><input type="checkbox" name="' . str_replace(' ', '', $article['modele']) . '"/>';
					echo '<label for="' . str_replace(' ', '', $article['modele']) . '">' . $article['modele'] . '</label></li>';
				}
				$articles->closeCursor();
				?>
					</ul>
				<br />
				<input type="submit" value="Rechercher" />
			</fieldset>
		</form>
		</div>
		<?php include("includes/footer.php");?>
    </body>
</html>
