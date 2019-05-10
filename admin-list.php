<?php session_start(); ?>
<?php require 'admin-header.php'; ?>

<!-- Main -->
	<div id="main">
		<div class="inner">

				<!-- Header -->
				<?php require 'header-sub.php'; ?>

				<!-- reserveMain -->
				<section id="reserveMain">
					<?php
					//localhost mySql
				  // $pdo=new PDO('mysql:host=localhost;dbname=marcs;charset=utf8', 'sbs', 'sbs_toro');

				  //Heroku PostgresSQL
				  $dsn = 'pgsql:dbname=d13p6kmhdcirvm host=ec2-174-129-208-118.compute-1.amazonaws.com port=5432';
				  $user = 'gkijtxlavebgol';
				  $password = 'ecff643bfa3612a94627c9d668f867a06ce4b86e4a69f8a42d981af26c50a505';
				  $pdo = new PDO($dsn, $user, $password);

						if (isset($_SESSION['facility'])) {

							// ログイン中であれば、予約情報を取得する。
							$sql=$pdo->prepare('select * from kanja where facility_code=? order by yoyaku_datetime');
							$sql->execute([$_SESSION['facility']['facility_code']]);

							echo '<form action="admin-send.php" method="post">';				//送信用のpost
							echo '<table>';
							echo '<th>診察券番号</th><th>患者名</th><th>予約時間</th><th>LINE通知</th><th>メール通知</th>';
							foreach ($sql as $row) {
								echo '<tr>';
								echo '<td>', $row['kanja_id'], '</td>';
								echo '<td>', $row['name'], '</td>';
								echo '<td>', $row['yoyaku_datetime'], '</td>';
								echo '<td>';
								echo '<input type="hidden" name="line_id" value="' . $row['line_id'] . '">';	//送信用の引数
								echo '<input type="submit" class="button primary small" value="Send">';
								echo '</td>';
								echo '<td>';
								echo '<input type="checkbox" id="sendMail' . $row['line_id'] . '" name="sendMail' . $row['line_id'] . '">';
								echo '<label for="sendMail' . $row['line_id'] . '"> </label>';
								echo '</td>';
								echo '</tr>';
							}
							echo '</table>';
							echo '</form>';

						} else {
							echo '<ul class="actions">';
							echo '<li>ログインして下さい。</li><br>';
							echo '<li><a href="admin-login.php" class="button big">LOGIN</a></li>';
							echo '</ul>';
						}
					?>
				</section>

			</div>
		</div>

<?php require 'admin-menu.php'; ?>
<?php require 'footer.php'; ?>
