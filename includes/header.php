<header>
		<h1>En-tête de page</h1>
	<?php
	if($_SESSION['type'] == 'invite') { // aucun employe connecté, session "invité"
	?>	
	<aside  class="connexion">
		<form  action="connexion.php" method="post">
			<label for="code">Code connexion : </label>
			<input type="text" name="code" />
			<input type="submit" value="Se connecter" />
		</form>
	</aside>
	<?php
	}
	else { // employe connecte, session employe/responsable
	?>
	<div id="accueil">
		<?php
		echo 'Bienvenue ' . $_SESSION['prenom'] . ' ' . $_SESSION['nom'] .'<br />';
		echo 'Vous travaillez à la boutique ' . $_SESSION['boutique'];?>
	</div>
	
	<aside  class="connexion">
		<a href="deconnexion.php">Deconnexion</a>
	</aside>
	<?php
	}
	?>
</header>
