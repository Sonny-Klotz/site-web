<header class="layout">
		<h1>Mini-projet site web</h1>
	<?php
	if(strcmp($_SESSION['type'],'invite') == 0) {
	?>
		<div class="infos">Mode invité : Faites une recherche ou connectez-vous.</div>
	<?php
	}
	else {
		echo '<div class="infos">Mode ' . $_SESSION['type'] . ' : Vous travaillez à la boutique ' . $_SESSION['boutique'] . '</div>';
	} ?>
</header>
