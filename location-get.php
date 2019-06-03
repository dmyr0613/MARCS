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

  $sql=$pdo->prepare('select * from location order by update_datetime');
  $sql->execute();

  $json_array = array();

  foreach ($sql as $row) {
    //JSON形式にする
    // $json_array = array(
    //     'device_name' => $row['device_name'],
    //     'beacon_name' => $row['beacon_name'],
    //     'uuid' => $row['uuid'],
    //     'lat' => $row['lat'],
    //     'lon' => $row['lon'],
    //     'prox' => $row['prox'],
    //     'update_datetime' => $row['update_datetime'],
    // );

    $row_array['device_name'] = $row['device_name'];
    $row_array['beacon_name'] = $row['beacon_name'];
    $row_array['uuid'] = $row['uuid'];
    $row_array['lat'] = $row['lat'];
    $row_array['lon'] = $row['lon'];
    $row_array['prox'] = $row['proximity'];
    $row_array['update_datetime'] = $row['update_datetime'];

    array_push($json_array,$row_array);
    error_log(print_r($json_array, true));

  }

  //半分おまじない。JSONで送りますよという合図
  header("Content-Type: text/javascript; charset=utf-8");
  //JSON 形式にエンコードしてechoでPOST送信
  echo json_encode($json_array);

?>
