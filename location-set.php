<?php

try{

	if (!empty($_GET)) {

		date_default_timezone_set('Asia/Tokyo');
		$datetime = date("Y/m/d His");
		error_log("DateTime：" . $datetime);

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

		// $device_name = base64_encode($_GET['device_name']);
		$device_name = $_GET['device_name'];

		//10秒前の時間をセット
		$datetime2 = date("Y/m/d His",strtotime("-10 minute"));

		//10秒前に同じステータスで書かれていたら、抜ける
		$sql=$pdo->prepare('select * location where device_name=? and proximity=? and update_datetime=?');
		$sql->execute([
			$device_name,
			$_GET['prox'],
			$datetime2]);
		$count = $sql->rowCount();
		error_log($count);

		if ($count == 0) {
			//locationテーブルへINSERT
			$sql=$pdo->prepare('insert into location values(?, ?, ?, ?, ?, ?, ?)');
			$sql->execute([
				$device_name,
				$_GET['uuid'],
				$_GET['lat'],
				$_GET['lon'],
				$_GET['prox'],
				$_GET['status'],
				$datetime]);
			error_log("locationデータ登録");
		}
		//DB接続情報をクリア
		$pdo = null;
	}

}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

?>
