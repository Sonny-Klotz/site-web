<?php
session_start();

function condition($bdd) {
	$modeles = $bdd->query('SELECT modele FROM Fournisseur');
	$res = "";
	
	while ($modele = $modeles->fetch()) {
		// si la case du modele existant a été cochée, on l'ajoute a la condition
		if (isset($_POST[$modele['modele']])) {
			$res .= ' modele = "' . $modele['modele'] . '" OR';
		}
	}
	
	//on retire le dernier OR, les deux derniers caractères
	return substr($res, 0, strlen($res) - 3);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Resultats</title>
        <link rel="stylesheet" href="style.css" />
        <meta charset="utf-8" />
    </head>
    
    <body>
		<?php
		include("includes/menu.php");
		include("includes/header.php");
		include("includes/footer.php");
		?>
		
		<h1>Résultats de la recherche</h1>
		
		<?php
		$bdd = new PDO('mysql:host=localhost;dbname=site-web;charset=utf8', 'root', 'user');
		$modeles = $bdd->query('SELECT modele FROM Stock WHERE' . condition($bdd));
		?>
		<table>
				<caption>Produits disponibles</caption>
			<tbody>
		<?php
		while ($modele = $modeles->fetch())
		{
		?>
			<tr>
				<!--ajouter une image de titre le nom du modele -->
				<td><?php echo $modele['modele']; ?></td>
				<td>
			<?php
			$boutiques = $bdd->query('SELECT refBoutique FROM Stock WHERE modele = "' . $modele['modele'] . '"');
			while ($boutique = $boutiques->fetch())
			{
				echo $boutique['refBoutique'] . '';
			?>
				</td>
			</tr>
		<?php
			}
			$boutiques->closeCursor();
		}
		$modeles->closeCursor();
		?>
			</tbody>
		</table>
		
    </body>
</html>
