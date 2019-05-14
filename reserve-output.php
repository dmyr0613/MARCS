<?php session_start(); ?>
<?php require 'header.php'; ?>

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
				  // $dsn = 'pgsql:dbname=d13p6kmhdcirvm host=ec2-174-129-208-118.compute-1.amazonaws.com port=5432';
				  // $user = 'gkijtxlavebgol';
				  // $password = 'ecff643bfa3612a94627c9d668f867a06ce4b86e4a69f8a42d981af26c50a505';
				  // $pdo = new PDO($dsn, $user, $password);

					if (isset($_SESSION['kanja'])) {

						// ログイン中であれば、KANJAテーブルに予約時間をUPDATE。
						$sql=$pdo->prepare('update kanja set facility_code=?, yoyaku_datetime=? where kanja_id=?');
						$sql->execute([
							$_REQUEST['facility_code'],
							$_REQUEST['time'],
							$_SESSION['kanja']['kanja_id']]);

						$reserveNo = 81;
						echo '<h2>受付番号：', $reserveNo, '</h2><br>';
						echo '<p>', $_REQUEST['time'], ' の予約を取得しました。<br>';
						echo '続けて問診情報の入力をされる場合は、問診票入力を押して下さい。</p>';
						echo '<ul class="actions">';
						echo '<li><a href="symptom.php" class="button big primary">問診票入力</a></li>';
						echo '<li><a href="main.php" class="button big">TOPPAGE</a></li>';
						echo '</ul>';
					} else {
						echo '<p>ログインして下さい。</p>';
						echo '<ul class="actions">';
						echo '<li><a href="login-input.php" class="button big">LOGIN</a></li>';
						echo '</ul>';
					}
					?>
				</section>

			</div>
		</div>

<?php require 'menu.php'; ?>
<?php require 'footer.php'; ?>
