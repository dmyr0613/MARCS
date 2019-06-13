<?php

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

  //デバイス名を取得
  $device_name = $_GET['device_name'];

  //locationからデバイス名指定で全データを取得する
  $sqlText   = 'select COALESCE(b.name,a.device_name) disp_name,a.device_name,COALESCE(c.name,a.uuid) beacon_name,';
  $sqlText  .= '       a.uuid,a.lat,a.lon,a.proximity,a.status,a.update_datetime';
  $sqlText  .= '  from location a';
  $sqlText  .= '       inner join device b';
  $sqlText  .= '               on a.device_name = b.device_name';
  $sqlText  .= "              and b.device_name = '" . $device_name . "'";
  $sqlText  .= '        left join beacon c';
  $sqlText  .= '               on a.uuid        = c.uuid';
  $sqlText  .= ' order by update_datetime desc';
  error_log(print_r($sqlText, true));

  $sql=$pdo->prepare($sqlText);
  $sql->execute();

  $json_array = array();

  foreach ($sql as $row) {
    //JSON形式にする
    $row_array['disp_name'] = $row['disp_name'];
    $row_array['device_name'] = $row['device_name'];
    $row_array['beacon_name'] = $row['beacon_name'];
    $row_array['uuid'] = $row['uuid'];
    $row_array['lat'] = $row['lat'];
    $row_array['lon'] = $row['lon'];
    $row_array['prox'] = $row['proximity'];
    $row_array['status'] = $row['status'];
    $row_array['update_datetime'] = $row['update_datetime'];

    array_push($json_array,$row_array);
    // error_log(print_r($json_array, true));
  }

  //半分おまじない。JSONで送りますよという合図
  header("Content-Type: text/javascript; charset=utf-8");
  //JSON 形式にエンコードしてechoでPOST送信
  echo json_encode($json_array);

?>
