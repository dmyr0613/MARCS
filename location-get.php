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

  // $sqlText  = 'select COALESCE(b.name,a.device_name) device_name,COALESCE(c.name,a.beacon_name) beacon_name,';
  // $sqlText .= '       a.uuid,a.lat,a.lon,a.proximity,a.update_datetime';
  // $sqlText .= '  from (location a left join device b on a.device_name = b.device_name)';
  // $sqlText .= '       left join beacon c on a.uuid = c.uuid ';
  // $sqlText .= ' order by update_datetime';

  //デバイス毎に最新の情報を返す
  $sqlText  = 'select COALESCE(b.name,a.device_name) device_name,COALESCE(c.name,a.beacon_name) beacon_name,';
  $sqlText .= '       a.uuid,a.lat,a.lon,a.proximity,a.update_datetime';
  $sqlText .= '  from (';
  $sqlText .= '       (';
  $sqlText .= '       select aa.*';
  $sqlText .= '         from location aa inner join';
  $sqlText .= '              (select device_name,max(update_datetime) update_datetime from location group by device_name) bb';
  $sqlText .= '           on aa.device_name     = bb.device_name';
  $sqlText .= '          and aa.update_datetime = bb.update_datetime';
  $sqlText .= '       ) a ';
  $sqlText .= '       left join device b on a.device_name = b.device_name';
  $sqlText .= '       )';
  $sqlText .= '       left join beacon c on a.uuid = c.uuid ';
  $sqlText .= ' order by update_datetime';

  // $sql=$pdo->prepare('select * from location order by update_datetime');
  $sql=$pdo->prepare($sqlText);
  $sql->execute();

  $json_array = array();

  foreach ($sql as $row) {
    //JSON形式にする
    $row_array['device_name'] = $row['device_name'];
    $row_array['beacon_name'] = $row['beacon_name'];
    $row_array['uuid'] = $row['uuid'];
    $row_array['lat'] = $row['lat'];
    $row_array['lon'] = $row['lon'];
    $row_array['prox'] = $row['proximity'];
    $row_array['update_datetime'] = $row['update_datetime'];

    array_push($json_array,$row_array);
    // error_log(print_r($json_array, true));
  }

  //半分おまじない。JSONで送りますよという合図
  header("Content-Type: text/javascript; charset=utf-8");
  //JSON 形式にエンコードしてechoでPOST送信
  echo json_encode($json_array);

?>
