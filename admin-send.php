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



								$options = '{"contacts": [{ "phone_number": "09076114485" }], "text_message": "' . $message . '" }';

								$ch = curl_init();
								// sandbox環境
								// curl_setopt($ch, CURLOPT_URL, 'https://sand-api-smslink.nexlink2.jp/api/v1/delivery');
								// curl_setopt($ch, CURLOPT_HTTPHEADER, array('token: dbe1aee9-93e5-4d28-b445-f166dea93658', 'Content-Type: application/json'));

								//本番環境
								curl_setopt($ch, CURLOPT_URL, 'https://api.smslink.jp/api/v1/delivery');
								curl_setopt($ch, CURLOPT_HTTPHEADER, array('token: 4b18f132-7e34-4d15-8837-3df8cde772d6', 'Content-Type: application/json'));
								curl_setopt($ch, CURLOPT_POST, 1);
								// curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($options));
								curl_setopt($ch, CURLOPT_POSTFIELDS, $options);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

								$response = curl_exec($ch);
								curl_close($ch);
								error_log(print_r($response, true));
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
