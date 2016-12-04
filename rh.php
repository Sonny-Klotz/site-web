<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Employes</title>
        <link rel="stylesheet" href="style.css" />
        <meta charset="utf-8" />
    </head>
    
    <body>
		<?php
		include("includes/menu.php");
		include("includes/header.php");
		include("includes/footer.php");
		?>
		<!-- L'utilisateur est forcément responsable sur cette page -->
		<!-- Index (ancres), employes de la boutique du responsable, 2 formulaires embauche/licensiement -->
		
		<nav>
            <ul>
                <li><a href="#employes">Employés</a></li>
                <li><a href="#embauche">Embauche</a></li>
                <li><a href="#licensiement">Licensiement</a></li>
            </ul>
        </nav>
        
<!--
		Requete liste employés de la boutique du responsable
-->
		
		<section id="embauche">
			<form action="embauche.php" method="post">
			</form>
		</section>
		
		<section id="licensiement">
			<form action="licensiement.php" method="post">
			</form>
		</section>
    </body>
</html>
