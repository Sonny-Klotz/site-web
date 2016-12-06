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
                <li><a href="#embauche">Licensiement</a></li>
            </ul>
        </nav>

<!-- liste employés de la boutique du responsable -->
		<p>
			<strong>Employes</strong> : <br />
		<?php
		$employes = $bdd->query('SELECT nom, prenom, IDEmploye FROM Employe WHERE refBoutique LIKE ' . '"' . $_SESSION['boutique'] . '"');
		while ($employe = $employes->fetch()) {
			echo $employe['prenom'] . ' ' . $employe['nom']; ?> -
			<?php echo $employe['IDEmploye']; ?> <br />
		<?php
		}
		$employes->closeCursor();
		?>
		</p>
		
<!--licensiement d'employés -->
		<section id="licensiement">
			<form action="licensiement.php" method="post">
				<select name="code">
				<?php
				$employes = $bdd->query('SELECT nom, prenom, IDEmploye FROM Employe WHERE refBoutique LIKE ' . '"' . $_SESSION['boutique'] . '"');
				while ($employe = $employes->fetch()) {
					echo '<option value=' . '"' . $employe['IDEmploye'] . '"' . '>' . $employe['IDEmploye'] . '</option>';
				}
				$employes->closeCursor();
				?>
				<input type="submit" value="Licensier" />
				</select>
			</form>
		</section>

<!--recrutement d'employés -->
		<section id="embauche">
			<form action="embauche.php" method="post">
				<input type="text" name="nom" />
				<input type="text" name="prenom" />
				<input type="text" name="mail" />
				<input type="number" name="salaire" min=0 max=8388607/>
				<input type="submit" value="Embaucher" />
			</form>
		</section>
    </body>
</html>
