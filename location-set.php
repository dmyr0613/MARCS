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

		// // $device_name = base64_encode($_GET['device_name']);
		// $device_name = $_GET['device_name'];
		//
		// //10秒前の時間をセット
		// $datetime2 = date("Y/m/d His",strtotime("-60 second"));
		// error_log("DateTime2：" . $datetime2);
		//
		// //10秒前に同じステータスで書かれていたら、抜ける
		// $sql=$pdo->prepare('select * from location where device_name=? and status=? and update_datetime>=?');
		// $sql->execute([
		// 	$device_name,
		// 	$_GET['status'],
		// 	$datetime2]);
		// $count = $sql->rowCount();
		// error_log($count);

		//最新のlocationデータを取得する
    $sqlText  = 'SELECT * ';
    $sqlText .= '  FROM location AS A';
    $sqlText .= ' WHERE update_datetime = (';
    $sqlText .= '     SELECT MAX(update_datetime)';
    $sqlText .= '     FROM location AS B';
    $sqlText .= '     WHERE A.device_name = B.device_name';
    $sqlText .= '       AND B.device_name = ?';
    $sqlText .= '     )';
    $sqlText .= '   AND A.device_name     = ?';

	  $sql=$pdo->prepare($sqlText);
	  $sql->execute([$_GET['device_name'],$_GET['device_name']]);

		//最新のStatusを取得する
	  foreach ($sql as $row) {
			$preStatus = $row['status'];
			$preUUID = $row['uuid'];
		}

		$isInsert = false;
		if ($_GET['status'] == 'OUT') {
			//OUT書き込み時、同じUUIDで直前がINの場合のみ書き込み
			if ($preStatus == 'IN' and $preUUID == $_GET['uuid']) {
				$isInsert = true;
			}
		} else {
			//IN書き込み時は、直前がOUTの場合のみ書き込み
			if ($preStatus == 'OUT') {
				$isInsert = true;
			}
		}

		error_log($preUUID);
		error_log($preStatus);
		error_log($isInsert);

		if ($isInsert) {
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
