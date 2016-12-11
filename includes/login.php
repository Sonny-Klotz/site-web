
<?php
if(strcmp($_SESSION['type'],'invite') == 0) { ?>
	<aside  class="connexion">
		<form  action="connexion.php" method="post">
			<input type="text" name="login" placeholder="Identifiant"/> <br />
			<input type="password" name="mdp"placeholder="Mot de passe"/><br />
			<input type="submit" value="Se connecter" />
		</form>
	</aside>
<?php }
else { ?>
	<aside  class="connexion">
			<?php echo '<strong>' . $_SESSION['prenom'] . ' ' . $_SESSION['nom'] .'</strong><br />';?>
			<a href="deconnexion.php"><strong>Deconnexion</strong></a>
	</aside>
<?php } ?>
