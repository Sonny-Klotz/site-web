<!DOCTYPE html>
<html>
    <head>
        <title>Nos boutiques</title>
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
			<h1>Nos Boutiques</h1>
		<?php
		$contacts = $bdd->query('SELECT E.nom, E.prenom, E.IDEmploye, B.IDBoutique, B.adresse, B.telephone FROM Employe E, Boutique B WHERE E.IDEmploye = B.IDResponsable');
		while ($contact = $contacts->fetch())
		{
		?>
		<p>
			<strong>Boutique</strong> : <?php echo $contact['IDBoutique']; ?><br />
			Le responsable de cette boutique est <?php echo $contact['prenom'] . ' ' . $contact['nom']; ?><br />
			<em>Contacter</em> : <br />
			Adresse : <?php echo $contact['adresse']; ?><br />
			Telephone : <?php echo $contact['telephone']; ?><br />
			Mail : <?php echo $contact['IDEmploye'] . '@ens.uvsq.fr'; ?>
			<?php
			if(strcmp($_SESSION['type'], 'responsable') == 0 && strcmp($contact['IDBoutique'], $_SESSION['boutique']) == 0) {
				$comptas = $bdd->query('SELECT * FROM compta1 c1, compta2 c2, compta3 c3 WHERE c1.refBoutique = c2.refBoutique AND c1.refBoutique = c3.refBoutique');
				while(($compta = $comptas->fetch()) && strcmp($compta['refBoutique'], $_SESSION['boutique']) != 0)
					;
			?>
				<br /><em>Chiffres</em> : <br />
			Salaires : <?php echo $compta['salaires'] . '€'; ?><br />
			Commandes : <?php echo $compta['commandes'] . '€'; ?><br />
			Ventes : <?php echo $compta['ventes'] . '€';
			}?>
		</p>
		<?php
		}

		$contacts->closeCursor();
		?>
		
    </body>
</html>
