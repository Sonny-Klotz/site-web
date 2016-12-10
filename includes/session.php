<?php
session_start();
if(!isset($_SESSION['type'])) {
	$_SESSION['type'] = 'invite';
}

if( strcmp($_SESSION['type'],'invite') == 0 ) {
	$bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'utilisateur', '');
}
else {
	$bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8',  $_SESSION['login'] , $_SESSION['mdp']);
}
?>
