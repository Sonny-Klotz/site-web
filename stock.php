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
                <li><a href="#commande">Commande</a></li>
                <li><a href="#vente">Vente</a></li>
            </ul>
        </nav>
        
<!-- liste du stock de la boutique -->
		<p>
			<strong>Employes</strong> : <br />
		<?php
		$articles = $bdd->query('SELECT * FROM Stock WHERE refBoutique LIKE ' . '"' . $_SESSION['boutique'] . '"');
		while ($article = $articles->fetch()) {
			echo $article['modele']?> -
			<?php echo $article['quantite']; ?> <br />
		<?php
		}
		$articles->closeCursor();
		?>
		</p>
		
<!--licensiement d'employés -->
		<section id="vente">
			<form action="vente.php" method="post">
				<select name="code">
				<?php
				$articles = $bdd->query('SELECT * FROM Stock WHERE refBoutique LIKE ' . '"' . $_SESSION['boutique'] . '"');
				while ($employe = $employes->fetch()) {
					echo '<option value=' . '"' . $article['modele'] . '"' . '>' . $modele['modele'] . '</option>';
				}
				$articles->closeCursor();
				?>
				<input type="submit" value="Vendre" />
				</select>
			</form>
		</section>

<!--recrutement d'employés -->
		<section id="commande">
			<form action="commande.php" method="post">
				<select name="code">
				<?php
				$articles = $bdd->query('SELECT * FROM Stock WHERE refBoutique LIKE ' . '"' . $_SESSION['boutique'] . '"');
				while ($employe = $employes->fetch()) {
					echo '<option value=' . '"' . $article['modele'] . '"' . '>' . $modele['modele'] . '</option>';
				}
				$articles->closeCursor();
				?>
				<input type="submit" value="Vendre" />
				</select>>
				<input type="number" name="quantite" min=0 max=8388607/>
				<input type="date" name="date" />
				<input type="submit" value="Embaucher" />
			</form>
		</section>
		
    </body>
</html>
