<?php

try{
// https://sbs-marcs.herokuapp.com/set-location.php?uuid=1&lat=10&lon=20

	if (!empty($_GET)) {

		error_log("UUID：" . $_GET['uuid']);
		error_log("Lat：" . $_GET['lat']);
		error_log("Lon：" . $_GET['lon']);

		//Heroku PostgresSQL
		$dsn = 'pgsql:dbname=d13p6kmhdcirvm host=ec2-174-129-208-118.compute-1.amazonaws.com port=5432';
		$user = 'gkijtxlavebgol';
		$password = 'ecff643bfa3612a94627c9d668f867a06ce4b86e4a69f8a42d981af26c50a505';
		$pdo = new PDO($dsn, $user, $password);

		if ($pdo == null){
			error_log("接続に失敗しました。");
		}else{
			error_log("接続に成功しました。");
		}

		//locationテーブルへINSERT
		$sql=$pdo->prepare('insert into location values(?, ?, ?)');
		$sql->execute([
			$_GET['uuid'],
			$_GET['lat'],
			$_GET['lon']]);

		//DB接続情報をクリア
		$pdo = null;
	}

}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

?>
