<?php
//ini_set('mbstring.internal_encoding' , 'UTF-8');
//header('Content-Type: text/html; charset=UTF-8');

// Composerでインストールしたライブラリを一括読み込み
require_once __DIR__ . '/vendor/autoload.php';

// アクセストークンを使いCurlHTTPClientをインスタンス化
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
// CurlHTTPClientとシークレットを使いLINEBotをインスタンス化
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('CHANNEL_SECRET')]);

?>
<?php session_start(); ?>
<?php require 'admin-header.php'; ?>

<!-- Main -->
	<div id="main">
		<div class="inner">

				<!-- Header -->
				<?php require 'header-sub.php'; ?>

				<!-- messageSend -->
				<section id="messageSend">
					<?php

					// $obj = $_REQUEST;
					// echo var_dump($_REQUEST);
					// echo '<br>';
					// foreach ($obj as $key => $val){
					// 	// echo $key;
					// 	// echo '<br>';
					// 	if (substr_count($key, 'line_id') == 1) {
					// 		echo 'LINE:' . substr($key, 8);
					// 		echo '<br>';
					// 	} elseif (substr_count($key, 'mail_addr') == 1) {
					// 		//文字列にmail_addrが含まれる場合
					// 		echo 'MAIL:' . substr($key, 10);	//MAILアドレスを抜き取ります。
					// 		echo '<br>';
					// 	}
					// }

					$message = "もうすぐ診察の時間です。";
					$message = $message . "\r\n" . "外出されている場合は、来院して頂きますようお願いします。";

          if (!empty($_REQUEST)) {
            //引数でLINE_IDを取得
						$obj = $_REQUEST;
						foreach ($obj as $key => $val){
							error_log($key);

							if (substr_count($key, 'line_id') == 1) {
								//文字列にline_idが含まれる場合
								$key = substr($key, 8);	//LINE_IDを抜き取ります。
								error_log($key);

								$response = $bot->pushMessage($key, new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message));
		            if (!$response->isSucceeded()) {
		              error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
		            }
							} elseif (substr_count($key, 'mail_addr') == 1) {
								//文字列にmail_addrが含まれる場合
								$key = substr($key, 10);	//MAILアドレスを抜き取ります。
								error_log($key);

// 								$url = "https://api.smslink.jp/api/v1/delivery";
// 								$data = array(
// 								    // 'url_name' => $url_name,
// 								    'phone_number' => "09076114485"
// 								);
// 								$content = http_build_query($data);
// 								$options = array('http' => array(
// 								    'method' => 'POST',
// 								    'content' => $content
// 								));
// 								$contents = file_get_contents($url, false, stream_context_create($options));
//

// -H "Accept: application/json"
// -H "token:YOUR_API_TOKEN"
// -H "Content-Type:application/json"


								// $data1 =array();
								// $data1 = http_build_query($data1, "", "&");
								//
								// $header = array(
								// // "Host: api.smslink.jp",
								// // "Accept: application/json",
								// "Content-Type: application/json;charset=UTF-8",
								// "Authorization: Bearer dbe1aee9-93e5-4d28-b445-f166dea93658",
								// // "WWW-Authenticate: Bearer realm="dbe1aee9-93e5-4d28-b445-f166dea93658"",
								// "Content-Length: ".strlen($data1)
								// );
								// error_log(print_r($header, true));
								//
								// $url = "https://sand-api-smslink.nexlink2.jp/api/v1/delivery";
								//
								// // $json = '{"contacts": [{ "phone_number": "09076114485" }], "text_message": " こんにちは", "reserved_at":"", "click_count": true, "notification_emails": [ "test1@example.com（通知先１）", "test2@example.com（通知先２）"]}';
								// $json = '{"contacts": [{ "phone_number": "09076114485" }], "text_message": " こんにちは" }';
								// $content = json_decode($json);
								//
								// $options = array('http' => array(
								// 		'http' => array('ignore_errors' => true),
								//     'protocol_version' => '1.1',
								//     'method' => 'POST',
								//     'header' => implode("\r\n", $header),
								//     'content' => $content
								// ));
								// $contents = file_get_contents($url, false, stream_context_create($options));
								//
								// preg_match('/HTTP\/1\.[0|1|x] ([0-9]{3})/', $http_response_header[0], $matches);
								// $status_code = $matches[1];
								// // error_log($status_code);
								// error_log(print_r($matches, true));
								//
								// //レスポンスを表示
								// error_log("レスポンス：" . $contents);



								header('Content-type: application/json; charset=utf-8');
								// $options = '{"contacts": [{ "phone_number": "09076114485" }], "text_message": "text message" }';
								$options = '{"contacts":[{"phone_number":"09076114485"}],
"text_message":" こんにちはここhttps://api.smslink.jpをクリックしてください{{配信停止URL}}", "reserved_at":"","click_count":true,"notification_emails":["test1@example.com(通知先1)","test2@example.com(通知先2)"]}';

								$ch = curl_init();
								curl_setopt($ch, CURLOPT_URL, 'https://sand-api-smslink.nexlink2.jp/api/v1/delivery');
								// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer dbe1aee9-93e5-4d28-b445-f166dea93658', 'Content-Type: application/json'));
								curl_setopt($ch, CURLOPT_HTTPHEADER, array('token: dbe1aee9-93e5-4d28-b445-f166dea93658', 'Content-Type: application/json'));
								curl_setopt($ch, CURLOPT_POST, 1);
								curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($options));
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

								$response = curl_exec($ch);
								$header = curl_getinfo( $ch );
								curl_close($ch);

								// error_log($response);
								error_log(print_r($response, true));
								error_log(print_r($header, true));

								// echo $response;

							}

						}

            echo '<p>LINE通知またはメール通知を行いました。</p>';
						echo '<ul class="actions">';
						echo '<li><a href="admin-list.php" class="button big">戻る</a></li>';
						echo '</ul>';
          }

					?>
				</section>

			</div>
		</div>

<?php require 'admin-menu.php'; ?>
<?php require 'footer.php'; ?>
