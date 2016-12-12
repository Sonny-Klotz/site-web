<!DOCTYPE html>
<html>
    <head>
        <title>Nos boutiques</title>
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
			<h1>Nos Boutiques</h1>
		<?php
		$contacts = $bdd->query('SELECT E.nom, E.prenom, E.IDEmploye, B.IDBoutique, B.adresse, B.telephone FROM Employe E, Boutique B WHERE E.IDEmploye = B.IDResponsable');
		while ($contact = $contacts->fetch())
		{
		?>
		<p>
			<strong class="titre"><?php echo $contact['IDBoutique']; ?></strong><br />
			Le responsable de cette boutique est <?php echo $contact['prenom'] . ' ' . $contact['nom']; ?><br />
			<em>Adresse</em> : <?php echo $contact['adresse']; ?><br />
			<em>Telephone</em> : <?php echo $contact['telephone']; ?><br />
			<em>Mail</em> : <?php echo $contact['IDEmploye'] . '@ens.uvsq.fr'; ?>
		</p>
			<?php
			if(strcmp($_SESSION['type'], 'responsable') == 0 && strcmp($contact['IDBoutique'], $_SESSION['boutique']) == 0) {
				$comptas = $bdd->query('SELECT * FROM compta1 c1, compta2 c2, compta3 c3 WHERE c1.refBoutique = c2.refBoutique AND c1.refBoutique = c3.refBoutique');
				while(($compta = $comptas->fetch()) && strcmp($compta['refBoutique'], $_SESSION['boutique']) != 0)
					;
			?>
			<p id="compta">
				<strong>Compta de la boutique <?php echo $_SESSION["boutique"];?></strong> : <br />
			<em>Salaires</em> : <?php echo $compta['salaires'] . '€'; ?><br />
			<em>Commandes</em> : <?php echo $compta['commandes'] . '€'; ?><br />
			<em>Ventes</em> : <?php echo $compta['ventes'] . '€';?>
			<?php
			}
			?>
			</p>
		<?php
		}
		$contacts->closeCursor(); ?>
		</div>
		<?php include("includes/footer.php");?>
    </body>
</html>
