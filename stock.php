<!DOCTYPE html>
<html>
    <head>
        <title>Articles</title>
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
			<h1>Gestion d'articles</h1>
        
<!-- liste du stock de la boutique -->
		<ul id="larticle">
		<?php
		$articles = $bdd->query('SELECT * FROM Stock WHERE total > 0 AND refBoutique LIKE ' . '"' . $_SESSION['boutique'] . '"');
		while ($article = $articles->fetch()) {
			echo '<li>' . $article['modele']?> -
			<?php echo $article['total']; ?> </li>
		<?php
		}
		$articles->closeCursor();
		?>
		</ul>
		
<!--vente d'articles -->
		<section id="vente">
			<form action="vente.php" method="post">
				<fieldset>
				<legend><strong>Vendre</strong></legend>
					<label for="modele">Modele : </label>
					<select name="modele">
					<?php
					$articles = $bdd->query('SELECT * FROM Stock WHERE total > 0 AND refBoutique LIKE ' . '"' . $_SESSION['boutique'] . '"');
					while ($article = $articles->fetch()) {
						echo '<option value=' . '"' . $article['modele'] . '"' . '>' . $article['modele'] . '</option>';
					}
					$articles->closeCursor();
					?>
					<input type="submit" value="Vendre" />
					</select>
				</fieldset>
			</form>
		</section>

<!--commande d'articles -->
		<section id="commande">
			<form action="commande.php" method="post">
				<fieldset>
				<legend><strong>Commander</strong></legend>
					<label for="modele">Modele : </label>
					<select name="modele"> 
					<?php
					$articles = $bdd->query('SELECT * FROM Fournisseur');
					while ($article = $articles->fetch()) {
						// La variable POST va contenir deux données séparées par un '&'.
						echo '<option value=' . '"' . $article['modele'] . '&' . $article['prixFournisseur'] . '"' . '>' . $article['modele'] . ' - ' . $article['prixFournisseur'] . '€</option>';
					}
					$articles->closeCursor();
					?>
					</select><br />
					<label for="quantite">Quantite : </label>
					<input type="number" name="quantite" min=0 max=8388607 placeholder="Nombre"><br />
					<label for="dateCommande">Date : </label>
					<input type="date" name="dateCommande" />
					<input type="submit" value="Commander" />
				</fieldset>
			</form>
		</section>
		</div>
		<?php include("includes/footer.php");?>
    </body>
</html>
