<!DOCTYPE html>
<html>
	<head>
		<title>Deonnexion</title>
		<!-- redirection automatique -->
		<meta charset="utf-8" http-equiv="refresh" content="1;index.php"/>
	</head>
	<body>
<?php
session_start();
echo 'Deconnexion réussie, redirection ...';
session_destroy();
?>
	</body>
</html>
