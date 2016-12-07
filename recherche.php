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
		$bdd = new PDO('mysql:host=localhost;dbname=site-web;charset=utf8', 'root', 'user');
		include("includes/menu.php");
		include("includes/header.php");
		include("includes/footer.php");
		?>
		
			<h1>Recherche d'articles</h1>
			
		<form  action="articles.php" method="post">
			<fieldset>
				<legend>Modèles existants</legend>
				<?php
				$articles = $bdd->query('SELECT DISTINCT modele FROM Stock');
				while ($article = $articles->fetch()) {
					echo '<input type="checkbox" name=' . '"' . $article['modele'] . '"' . '/>';
					echo '<label for=' . '"' . $article['modele'] . '"' . '>' . $article['modele'] . '</label>';
				}
				$articles->closeCursor();
				?>
			</fieldset>
			<input type="submit" value="Rechercher" />
		</form>
    </body>
</html>
