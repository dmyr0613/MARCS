<?php

if (!empty($_GET)) {

	//Heroku PostgresSQL
	$dsn = 'pgsql:dbname=d13p6kmhdcirvm host=ec2-174-129-208-118.compute-1.amazonaws.com port=5432';
	$user = 'gkijtxlavebgol';
	$password = 'ecff643bfa3612a94627c9d668f867a06ce4b86e4a69f8a42d981af26c50a505';
	$pdo = new PDO($dsn, $user, $password);

	//locationテーブルへINSERT
	$sql=$pdo->prepare('insert location kanja values(?, ?, ?)');
	$sql->execute([
		$_GET['uuid'],
		$_GET['lat'],
		$_GET['lon']]);
		
}

?>
