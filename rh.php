<!DOCTYPE html>
<html>
    <head>
        <title>Employes</title>
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
<!-- menu -->
		<nav class="ancres">
            <ul>
                <li><a href="#employes">Employés</a></li>
                <li><a href="#licensiement">Embauche</a></li>
                <li><a href="#embauche">Licenciement</a></li>
            </ul>
        </nav>

<!-- liste employés de la boutique du responsable -->
		<p>
			<strong>Employes</strong> : <br />
		<?php
		$employes = $bdd->query('SELECT nom, prenom, IDEmploye FROM Employe WHERE refBoutique LIKE ' . '"' . $_SESSION['boutique'] . '"');
		while ($employe = $employes->fetch()) {
			echo $employe['prenom'] . ' ' . $employe['nom']; ?> -
			<?php echo $employe['IDEmploye'];
			if($employe['IDEmploye'] == $_SESSION['code'])
				echo ' - <em>Responsable</em>';
			?> <br />
		<?php
		}
		$employes->closeCursor();
		?>
		</p>
		
<!--licensiement d'employés -->
		<section id="licenciement">
			<form action="licenciement.php" method="post">
				<select name="code">
				<?php
				$employes = $bdd->query('SELECT nom, prenom, IDEmploye FROM Employe WHERE refBoutique LIKE ' . '"' . $_SESSION['boutique'] . '" AND IDEmploye NOT IN (SELECT IDResponsable FROM Boutique)');
				while ($employe = $employes->fetch()) {
					echo '<option value=' . '"' . $employe['IDEmploye'] . '"' . '>' . $employe['IDEmploye'] . '</option>';
				}
				$employes->closeCursor();
				?>
				<input type="submit" value="Licencier" />
				</select>
			</form>
		</section>

<!--recrutement d'employés -->
		<section id="embauche">
			<form action="embauche.php" method="post">
				<label for="nom">Nom : </label>
				<input type="text" name="nom" /><br />
				<label for="prenom">Prenom : </label>
				<input type="text" name="prenom" /><br />
				<label for="mail">Mail : </label>
				<input type="text" name="mail" /><br />
				<label for="salaire">Salaire : </label>
				<input type="number" name="salaire" min=0 max=8388607/><br />
				<input type="submit" value="Embaucher" />
			</form>
		</section>
    </body>
</html>
