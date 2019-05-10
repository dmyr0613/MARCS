<?php session_start(); ?>
<?php require 'admin-header.php'; ?>

<!-- Main -->
	<div id="main">
		<div class="inner">

				<!-- Header -->
				<?php require 'header-sub.php'; ?>

				<!-- loginpage -->
				<section id="loginpage">
					<?php
					unset($_SESSION['facility']);

					//localhost mySql
				  // $pdo=new PDO('mysql:host=localhost;dbname=marcs;charset=utf8', 'sbs', 'sbs_toro');

				  //Heroku PostgresSQL
				  $dsn = 'pgsql:dbname=d13p6kmhdcirvm host=ec2-174-129-208-118.compute-1.amazonaws.com port=5432';
				  $user = 'gkijtxlavebgol';
				  $password = 'ecff643bfa3612a94627c9d668f867a06ce4b86e4a69f8a42d981af26c50a505';
				  $pdo = new PDO($dsn, $user, $password);

					$sql=$pdo->prepare('select * from facility where facility_code=? and password=?');
					$sql->execute([$_REQUEST['facility_code'], $_REQUEST['password']]);
					foreach ($sql as $row) {
						$_SESSION['facility']=[
							'no'=>$row['no'],
							'facility_code'=>$row['facility_code'],
							'name'=>$row['name'],
							'password'=>$row['password']];
					}
					if (isset($_SESSION['facility'])) {
						echo '<p>ようこそ、', $_SESSION['facility']['name'], ' さん。</p>';
						echo '<ul class="actions">';
						echo '<li><a href="admin-list.php" class="button big">予約一覧</a></li>';
						echo '</ul>';
					} else {
						echo '<p>施設番号またはパスワードが違います。</p>';
						echo '<ul class="actions">';
						echo '<li><a href="admin-login.php" class="button big">戻る</a></li>';
						echo '</ul>';
					}
					?>
				</section>

			</div>
		</div>

<?php require 'admin-menu.php'; ?>
<?php require 'footer.php'; ?>
