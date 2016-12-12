<?php
function condition($bdd) {
	$modeles = $bdd->query('SELECT modele FROM Fournisseur');
	$res = "";
	$trouve = false;
	
	while ($modele = $modeles->fetch()) {
		// si la case du modele existant a été cochée, on l'ajoute a la condition
		if (isset($_POST[ str_replace(' ', '', $modele['modele']) ])) {
			$res .= ' modele = "' . $modele['modele'] . '" OR';
			$trouve = true;
		}
	}
	$modeles->closeCursor();
	//on retire le dernier OR, les deux derniers caractères
	if ($trouve) {
		return substr($res, 0, strlen($res) - 3);
	}
	else {
		return $res;
	}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Resultats</title>
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
			<h1>Résultats de la recherche</h1>
		<?php
		$modeles = $bdd->query('SELECT DISTINCT modele FROM Stock WHERE total > 0 AND ' . condition($bdd));
		?>
		<table>
			<thead><tr><th>Modeles</th> <th>Disponible à</th></tr></thead>
			<tfoot><tr><td colspan=2><a href="recherche.php">Faire une autre recherche</a></td></tr></tfoot>
			<tbody>

		<?php
		while ($modele = $modeles->fetch())
		{
		?>
			<tr>
				<!--ajouter une image de titre le nom du modele -->
				<td id="tmodele"><?php echo $modele['modele']; ?></td>
				<td id="tboutique">
					<ul>
			<?php
			$boutiques = $bdd->query('SELECT refBoutique FROM Stock WHERE total > 0 AND modele = "' . $modele['modele'] . '"');
			while ($boutique = $boutiques->fetch())
			{
				echo '<li id="lboutique">' . $boutique['refBoutique'] . '</li>' ;
			}
			$boutiques->closeCursor();
			?>
					</ul>
				</td>
			</tr>
		<?php
		}
		$modeles->closeCursor();
		?>
			</tbody>
		</table>
		</div>
		<?php include("includes/footer.php");?>
    </body>
</html>
