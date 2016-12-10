<header>
		<h1>En-tête de page</h1>
	<?php
	if(strcmp($_SESSION['type'],'invite') == 0) { // aucun employe connecté, session "invité"
	?>	
	<aside  class="connexion">
		<form  action="connexion.php" method="post">
			<label for="login">Identifiant : </label>
			<input type="text" name="login" />
			<label for="mdp">Mot de passe : </label>
			<input type="password" name="mdp" />
			<input type="submit" value="Se connecter" />
		</form>
	</aside>
	<?php
	}
	else { // employe connecte, session employe/responsable
	?>
	<div id="infos">
		<?php echo 'Bienvenue ' . $_SESSION['prenom'] . ' ' . $_SESSION['nom'] .'<br />';
		echo 'Vous travaillez à la boutique ' . $_SESSION['boutique'] . '<br />';?>
	</div>
	
	<aside  class="connexion">
		<a href="deconnexion.php">Deconnexion</a>
	</aside>
	<hr />
	<?php
	}
	?>
</header>
