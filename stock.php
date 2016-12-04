<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Articles</title>
        <link rel="stylesheet" href="style.css" />
        <meta charset="utf-8" />
    </head>
    
    <body>
		<?php
		include("includes/menu.php");
		include("includes/header.php");
		include("includes/footer.php");
		?>
		<!-- L'utilisateur est forcément employe sur cette page -->
		<!-- Index (ancres), articles de la boutique de l'employe, 2 formulaires commande/vente -->
		
		<nav>
            <ul>
                <li><a href="#articles">Stock</a></li>
                <li><a href="#commande">Commande</a></li>
                <li><a href="#vente">Vente</a></li>
            </ul>
        </nav>
        
<!--
        Requete récupérer liste des modeles de la boutique de l'employé
-->
        
		<section id="commande">
			<form action="commande.php" method="post">
			</form>
		</section>
		
		<section id="vente">
			<form action="vente.php" method="post">
			</form>
		</section>
		
    </body>
</html>
