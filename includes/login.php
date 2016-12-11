
<?php
if(strcmp($_SESSION['type'],'invite') == 0) { ?>
	<aside  class="connexion">
		<form  action="connexion.php" method="post">
			<label for="login">Identifiant : </label>
			<input type="text" name="login" /> <br />
			<label for="mdp">Mot de passe : </label>
			<input type="password" name="mdp" /><br />
			<input type="submit" value="Se connecter" />
		</form>
	</aside>
<?php }
else { ?>
	<aside  class="connexion">
		<?php echo $_SESSION['prenom'] . ' ' . $_SESSION['nom'] .'<br />';?>
		<a href="deconnexion.php">Deconnexion</a>
	</aside>
<?php } ?>
