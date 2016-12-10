<!DOCTYPE html>
<html>
    <head>
        <title>Recherche</title>
        <link rel="stylesheet" href="style.css" />
        <meta charset="utf-8" />
    </head>
    
    <body>
		<?php
		include("includes/session.php");
		include("includes/menu.php");
		include("includes/header.php");
		include("includes/footer.php");
		?>
		
			<h1>Recherche d'articles</h1>
			
		<form  action="articles.php" method="post">
			<fieldset>
				<legend>Modèles existants</legend>
				<?php
				$articles = $bdd->query('SELECT modele FROM Fournisseur');
				while ($article = $articles->fetch()) {
					echo '<input type="checkbox" name="' . str_replace(' ', '', $article['modele']) . '"/>';
					echo '<label for="' . str_replace(' ', '', $article['modele']) . '">' . $article['modele'] . '</label><br />';
				}
				$articles->closeCursor();
				?>
			</fieldset>
			<input type="submit" value="Rechercher" />
		</form>
    </body>
</html>
