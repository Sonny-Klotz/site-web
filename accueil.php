<?php
session_start();
if(!isset($_SESSION['type']))
{
	$_SESSION['type'] = 'invite';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mini-projet site web</title>
        <link rel="stylesheet" href="style.css" />
        <meta charset="utf-8" />
    </head>
    
    <body>
		<?php
		include("includes/menu.php");
		include("includes/header.php");
		include("includes/footer.php");
		?>
		
		<h1>Corps du site</h1>
		
        <div id="corps">
			<p>
				Cette partie peut être utilisée pour décrire l'entreprise, 
				ce qu'elle offre ou afficher des actualités. <br />
				On l'utilisera à la place pour décrire comment utiliser le site.
			</p>
        </div>
        
    </body>
</html>
