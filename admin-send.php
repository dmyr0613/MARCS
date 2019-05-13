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
<?php require 'admin-header.php'; error_log($_REQUEST['line_id']); ?>

<!-- Main -->
	<div id="main">
		<div class="inner">

				<!-- Header -->
				<?php require 'header-sub.php'; ?>

				<!-- messageSend -->
				<section id="messageSend">
					<?php

          if (!empty($_REQUEST)) {
            //引数でLINE_IDを取得
            $key = $_REQUEST['line_id'];
            $message = "もうすぐ診察の時間です。";
						$message = $message . "\r\n" . "外出されている場合は、来院して頂きますようお願いします。";

            $response = $bot->pushMessage($key, new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message));
            if (!$response->isSucceeded()) {
              error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
            }

            echo '<p>LINEに呼び出し通知を行いました。</p>';
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
