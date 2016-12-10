<nav id="menu">
	<div class="element_menu">
        <h1>Menu</h1>
        <ul>
			<!-- affiché dans tous les cas -->
			<li><a href="index.php">Accueil</a></li>
			<li><a href="recherche.php">Recherche</a></li>
            <?php
            if(strcmp($_SESSION['type'], 'employe') == 0 || strcmp($_SESSION['type'], 'responsable') == 0) {
				echo '<li><a href="stock.php">Articles</a></li>';
				
				if(strcmp($_SESSION['type'], 'responsable') == 0) {
					echo '<li><a href="rh.php">Personnel</a></li>';
				}
			}
			?>
        </ul>
    </div>
</nav>
