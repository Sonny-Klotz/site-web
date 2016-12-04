<header>
		<h1>En-tête de page</h1>
	<?php
	if($_SESSION['type'] == 'invite')
	{ // aucun employe connecté, session "invité"
	?>	
	<aside  class="connexion">
		<form  action="connexion.php" method="post">
			<input type="text" name="code" />
			<input type="submit" value="Connexion" />
		</form>
	</aside>
	<?php
	}
	else
	{
		//faire une fct pour retrouver le nom a partir de l'id et la table employe
		//echo 'employe : ' . $_SESSION['id'];
		//echo 'droits : ' . $_SESSION['type'];
	?>
	<aside  class="connexion">
		<a href="deconnexion.php">Deconnexion</a>
	</aside>
	<?php
	}
	?>
</header>
