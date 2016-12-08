<!DOCTYPE html>
<html>
    <head>
        <title>Articles</title>
        <link rel="stylesheet" href="style.css" />
        <meta charset="utf-8" />
    </head>
    
    <body>
		<?php
		session_start();
		$bdd = new PDO('mysql:host=localhost;dbname=site-web;charset=utf8', 'root', 'user');
		include("includes/menu.php");
		include("includes/header.php");
		include("includes/footer.php");
		?>
		<!-- L'utilisateur est forcément employe sur cette page -->
		<!-- Index (ancres), articles de la boutique de l'employe, 2 formulaires commande/vente -->
		
		<nav class ="ancres">
            <ul>
                <li><a href="#articles">Stock</a></li>
                <li><a href="#vene">Vente</a></li>
                <li><a href="#commande">Commande</a></li>
            </ul>
        </nav>
        
<!-- liste du stock de la boutique -->
		<p>
			<strong>Articles</strong> : <br />
		<?php
		$articles = $bdd->query('SELECT * FROM Stock WHERE refBoutique LIKE ' . '"' . $_SESSION['boutique'] . '"');
		while ($article = $articles->fetch()) {
			echo $article['modele']?> -
			<?php echo $article['total']; ?> <br />
		<?php
		}
		$articles->closeCursor();
		?>
		</p>
		
<!--vente d'articles -->
		<section id="vente">
			<form action="vente.php" method="post">
				<label for="dateVente">Date : </label>
				<input type="date" name="dateVente" /><br />
				<label for="modele">Modele : </label>
				<select name="modele">
				<?php
				$articles = $bdd->query('SELECT * FROM Stock WHERE refBoutique LIKE ' . '"' . $_SESSION['boutique'] . '"');
				while ($article = $articles->fetch()) {
					echo '<option value=' . '"' . $article['modele'] . '"' . '>' . $article['modele'] . '</option>';
				}
				$articles->closeCursor();
				?>
				<input type="submit" value="Vendre" />
				</select>
			</form>
		</section>

<!--commande d'articles -->
		<section id="commande">
			<form action="commande.php" method="post">
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
				<input type="number" name="quantite" min=0 max=8388607><br />
				<label for="dateCommande">Date : </label>
				<input type="date" name="dateCommande" /><br />
				<input type="submit" value="Commander" />
			</form>
		</section>
		
    </body>
</html>
