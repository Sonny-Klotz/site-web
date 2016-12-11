<header class="layout">
		<h1>Mini-projet site web</h1>
	<?php
	if(strcmp($_SESSION['type'],'invite') == 0) {
	?>
		<div class="infos">Faites une recherche, contactez une boutique ou connectez-vous.</div>
	<?php
	}
	else {
		echo '<div class="infos">Vous travaillez à la boutique ' . $_SESSION['boutique'] . '</div>';
	} ?>
</header>
