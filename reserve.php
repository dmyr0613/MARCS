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
					if (!empty($_GET['line_id'])) {
						//POSTでLINE_IDが渡された場合は、LINE_IDからユーザを取得
						unset($_SESSION['kanja']);

						//localhost mySql
						// $pdo=new PDO('mysql:host=localhost;dbname=marcs;charset=utf8', 'sbs', 'sbs_toro');

						//Heroku PostgresSQL
						// $dsn = 'pgsql:dbname=d13p6kmhdcirvm host=ec2-174-129-208-118.compute-1.amazonaws.com port=5432';
						// $user = 'gkijtxlavebgol';
						// $password = 'ecff643bfa3612a94627c9d668f867a06ce4b86e4a69f8a42d981af26c50a505';
						// $pdo = new PDO($dsn, $user, $password);

						$sql=$pdo->prepare('select * from kanja where line_id=?');
						$sql->execute([$_GET['line_id']]);

						error_log("TEST");

						foreach ($sql as $row) {
							$_SESSION['kanja']=[
								'no'=>$row['no'],
								'kanja_id'=>$row['kanja_id'],
								'name'=>$row['name'],
								'password'=>$row['password'],
								'line_id'=>$row['line_id'],
								'line_name'=>$row['line_name']];
						}
					}

					if (isset($_SESSION['kanja'])) {
					?>

						<!-- ログイン中であれば、予約取得画面を表示する。 -->
						<header>
							<p>希望する診察時間を選択して下さい。</p>
						</header>
						<!-- 日付選択 -->
						<form action="reserve-output.php" method="post">
							<!-- 施設リスト -->
							<div class="col-12">
								<select name="facility_code" id="facility_code">
									<option value="1234567890">SBSクリニック</option>
									<option value="0987654321">MARCS診療所</option>
								</select>
							</div>
							<br>
							<!-- 予約時間ラジオボタン -->
							<div class="row gtr-uniform">
								<div class="col-4 col-12-small">
									<input type="radio" id="time0800" name="time" value="08:00" checked>
									<label for="time0800">08:00</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="radio" id="time0830" name="time" value="08:30">
									<label for="time0830">08:30</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="radio" id="time0900" name="time" value="09:00">
									<label for="time0900">09:00</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="radio" id="time0930" name="time" value="09:30">
									<label for="time0930">09:30</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="radio" id="time1000" name="time" value="10:00">
									<label for="time1000">10:00</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="radio" id="time1030" name="time" value="10:30">
									<label for="time1030">10:30</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="radio" id="time1130" name="time" value="11:30">
									<label for="time1130">11:30</label>
								</div>
							</div>
							<br>
							<input type="submit" class="button big primary" value="予約登録">
						</form>

					<?PHP
					} else {

						if (!empty($_GET['line_id'])) {
							//Line_idが渡されている場合で、ユーザが存在しない場合は、新規ユーザ登録画面へ
							echo '<p>ご利用中のLINE情報からユーザ情報を取得できませんでした。<br>ユーザ情報の新規登録をお願いします。</p>';
							echo '<form action="userinfo.php" method="post">';				//送信用のpost
							echo '<ul class="actions">';
							echo '<input type="hidden" name="line_id" value="' . $_GET['line_id'] . '">';	//送信用の引数
							echo '<input type="submit" class="button big primary" value="ユーザ情報登録">';
							echo '</ul>';
							echo '</form>';
						} else {
							echo '<p>ログインして下さい。</p>';
							echo '<ul class="actions">';
							echo '<li><a href="login-input.php" class="button big">LOGIN</a></li>';
							echo '</ul>';
						}

					}
					?>
				</section>

			</div>
		</div>

<?php require 'menu.php'; ?>
<?php require 'footer.php'; ?>
