<nav id="menu">
			<a href="index.php"><strong>Accueil</strong></a>
			<a href="recherche.php"><strong>Recherche</strong></a>
        <?php
        if(strcmp($_SESSION['type'], 'employe') == 0 || strcmp($_SESSION['type'], 'responsable') == 0) {
			echo '<a href="stock.php"><strong>Articles</strong></a>';
				
			if(strcmp($_SESSION['type'], 'responsable') == 0) {
				echo '<a href="rh.php"><strong>Personnel</strong></a>';
			}
		}
		?>
</nav>
