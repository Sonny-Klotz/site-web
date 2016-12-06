<!DOCTYPE html>
<html>
    <head>
        <title>Nos boutiques</title>
        <link rel="stylesheet" href="style.css" />
        <meta charset="utf-8" />
    </head>
    
    <body>
		<?php
		session_start();
		include("includes/menu.php");
		include("includes/header.php");
		include("includes/footer.php");
		
		$bdd = new PDO('mysql:host=localhost;dbname=site-web;charset=utf8', 'root', 'user');
		$contacts = $bdd->query('SELECT E.nom, E.prenom, E.IDEmploye, B.IDBoutique, B.adresse, B.telephone FROM Employe E, Boutique B WHERE E.IDEmploye = B.IDResponsable');
		
		while ($contact = $contacts->fetch())
		{
		?>
		<p>
			<strong>Boutique</strong> : <?php echo $contact['IDBoutique']; ?><br />
			Le responsable de cette boutique est <?php echo $contact['prenom'] . ' ' . $contact['nom']; ?><hr />
			<em>Contacter</em> : <br />
			Adresse : <?php echo $contact['adresse']; ?><br />
			Telephone : <?php echo $contact['telephone']; ?><br />
			Mail : <?php echo $contact['IDEmploye']; ?>
		</p>
		<?php
		}

		$contacts->closeCursor();
		?>
		
    </body>
</html>
