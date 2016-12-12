<!DOCTYPE html>
<html>
    <head>
        <title>Employes</title>
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
			<h1>Gestion du personnel</h1>

<!-- liste employés de la boutique du responsable -->
		<ul>
		<?php
		$employes = $bdd->query('SELECT nom, prenom, IDEmploye FROM Employe WHERE refBoutique LIKE ' . '"' . $_SESSION['boutique'] . '"');
		while ($employe = $employes->fetch()) {
			echo '<li>' . $employe['prenom'] . ' ' . $employe['nom']; ?> -
			<?php echo $employe['IDEmploye'] . '@ens.uvsq.fr';
			if(strcmp($employe['IDEmploye'], $_SESSION['login']) == 0)
				echo ' - <em>Responsable</em>';
			?>
			</li>
		<?php
		}
		$employes->closeCursor();
		?>
		</ul>
		
<!--licensiement d'employés -->
		<section id="licenciement">
			<form action="licenciement.php" method="post">
				<fieldset>
				<legend><strong>Licencier</strong></legend>
					<label for="id">Employé : </label>
					<select name="id">
					<?php
					$employes = $bdd->query('SELECT nom, prenom, IDEmploye FROM Employe WHERE refBoutique LIKE ' . '"' . $_SESSION['boutique'] . '" AND IDEmploye NOT IN (SELECT IDResponsable FROM Boutique)');
					while ($employe = $employes->fetch()) {
						echo '<option value=' . '"' . $employe['IDEmploye'] . '"' . '>' . $employe['IDEmploye'] . '</option>';
					}
					$employes->closeCursor();
					?>
					<input type="submit" value="Licencier" />
					</select>
				</fieldset>
			</form>
		</section>

<!--recrutement d'employés -->
		<section id="embauche">
			<form action="embauche.php" method="post">
				<fieldset>
				<legend><strong>Recruter</strong></legend>
					<label for="nom">Nom : </label>
					<input type="text" name="nom"  placeholder="Nom" /><br />
					<label for="prenom">Prenom : </label>
					<input type="text" name="prenom" placeholder='Prenom' /><br />
					<label for="identifiant">Identifiant : </label>
					<input type="text" name="identifiant"  placeholder="16 car. max" /><br />
					<label for="mdp">Mot de passe : </label>
					<input type="password" name="mdp" placeholder="Mot de passe" /><br />
					<label for="salaire">Salaire : </label>
					<input type="number" name="salaire" min=0 max=8388607 placeholder='Nombre' />
					<input type="submit" value="Embaucher" />
				</fieldset>
			</form>
		</section>
		</div>
		<?php include("includes/footer.php");?>
    </body>
</html>
