<header>
	<?php
	if(session_status() != PHP_SESSION_ACTIVE)
	{ // aucun employe connecté, session "invité"
	?>
	<h2>Titre du site</h2>
			
		<div  id="connexion">
			<form  action="connexion.php" method="post">
				<input type="text" name="Code employe" />
				<input type="submit" value="Connexion" />
			</form>
		</div>
	<?php
	}
	else
	{
		// Nom employé ou responsable, type connexion, Deconnexion
	}
	?>
</header>
