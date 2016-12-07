<nav id="menu">
	<div class="element_menu">
        <h1>Menu</h1>
        <ul>
			<!-- affiché dans tous les cas -->
			<li><a href="index.php">Aller à l'accueil</a></li>
			<li><a href="recherche.php">Rechercher des articles</a></li>
            <li><a href="boutiques.php">Contacter une boutique</a></li>
            <?php
            if($_SESSION['type'] == 'employe' || $_SESSION['type'] == 'responsable')
            {
            ?>
            <!-- affiché si on est employé -->
            <li><a href="stock.php">Gestion des articles</a></li>
				<?php
				if($_SESSION['type'] == 'responsable')
				{
				?>
			<!-- affiché si on est responsable -->
			<li><a href="rh.php">Gestion des employés</a></li>
				<?php
				}
				?>
            <?php
			}
			?>
        </ul>
    </div>
</nav>
