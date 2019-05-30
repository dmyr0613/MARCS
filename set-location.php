<?php

try{
// https://sbs-marcs.herokuapp.com/set-location.php?uuid=1&lat=10&lon=20

	if (!empty($_GET)) {

		date_default_timezone_set('Asia/Tokyo');
		$datetime = date("Y/m/d His");
		error_log("DateTime：" . $datetime);

		// error_log("UUID：" . $_GET['uuid']);
		// error_log("Lat：" . $_GET['lat']);
		// error_log("Lon：" . $_GET['lon']);

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
		// https://sbs-marcs.herokuapp.com/set-location.php?device_name=abc&beacon_name=aaa&uuid=1&lat=10&lon=20&prox=near

		//locationテーブルへUPDATE
		$sql=$pdo->prepare('update location set beacon_name=?, uuid=?, lat=?, lon=?, proximity=?, update_datetime=? where device_name=?');
		$sql->execute([
			$_GET['beacon_name'],
			$_GET['uuid'],
			$_GET['lat'],
			$_GET['lon'],
			$_GET['prox'],
			$datetime,
			$_GET['device_name']]);
		$count = $sql->rowCount();
		// error_log($sql->);
		error_log($count);

		if ($count == 0){
			//locationテーブルへINSERT
			$sql=$pdo->prepare('insert into location values(?, ?, ?, ?, ?, ?, ?)');
			$sql->execute([
				$_GET['device_name'],
				$_GET['beacon_name'],
				$_GET['uuid'],
				$_GET['lat'],
				$_GET['lon'],
				$_GET['prox'],
				$datetime]);
		}

		//DB接続情報をクリア
		$pdo = null;
	}

}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

?>
