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

  //デバイス毎に最新の情報を取得
  $sqlText  = 'select COALESCE(b.name,a.device_name) disp_name,a.device_name,COALESCE(c.name,a.uuid) beacon_name,';
  $sqlText .= '       a.uuid,a.lat,a.lon,a.proximity,a.status,a.update_datetime';
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
  $sqlText .= ' order by update_datetime desc';

  $sql=$pdo->prepare($sqlText);
  $sql->execute();

  $json_array = array();


  $i = 1;
  foreach ($sql as $row) {
    //JSON形式にする
    $row_array['trackId'] = $i;
    $row_array['trackName'] = $row['beacon_name'];
    $row_array['artistName'] = $row['disp_name'];
    $row_array['formattedPrice'] = $row['uuid'];
    $row_array['currency'] = $row['proximity'];

    array_push($json_array,$row_array);
    // error_log(print_r($json_array, true));
    $i++;
  }

  //半分おまじない。JSONで送りますよという合図
  // header("Content-Type: text/javascript; charset=utf-8");
  //JSON 形式にエンコードしてechoでPOST送信
  // echo json_encode($json_array);

  $arr = array(
      "resultCount" => 2,
          "results" => array([
              "trackId" => 1,
              "trackName" => "AAAA",
              "artistName" => "BBBB",
              "formattedPrice" => "2000",
              "currency" => "Yen"
          ],
          [
            "trackId" => 2,
            "trackName" => "CCCC",
            "artistName" => "DDDD",
            "formattedPrice" => "2500",
            "currency" => "Doller"
          ])
  );
  echo json_encode($arr);

?>
