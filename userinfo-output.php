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
				  $dsn = 'pgsql:dbname=d13p6kmhdcirvm host=ec2-174-129-208-118.compute-1.amazonaws.com port=5432';
				  $user = 'gkijtxlavebgol';
				  $password = 'ecff643bfa3612a94627c9d668f867a06ce4b86e4a69f8a42d981af26c50a505';
				  $pdo = new PDO($dsn, $user, $password);

/*
					if (isset($_SESSION['kanja'])) {

					} else {
						// 同じKANJA_IDがいるかチェック
						$sql=$pdo->prepare('select * from kanja where kanja_id=?');
						$sql->execute([$_REQUEST['kanja_id']]);
					}

					if (empty($sql->fetchAll())) {
*/
						if (isset($_SESSION['kanja'])) {

							// ログイン中であれば、KANJAテーブルをUPDATE。
							$sql=$pdo->prepare('update kanja set name=?, password=?, line_id=?, line_name=? where kanja_id=?');
							$sql->execute([
								$_REQUEST['name'],
								$_REQUEST['password'],
								$_REQUEST['line_id'],
								$_REQUEST['line_name'],
								$_SESSION['kanja']['kanja_id']]);

							$_SESSION['kanja']=[
								'kanja_id'=>$_SESSION['kanja']['kanja_id'],
								'name'=>$_REQUEST['name'],
								'password'=>$_REQUEST['password'],
								'line_id'=>$_REQUEST['line_id'],
								'line_name'=>$_REQUEST['line_name']];

							echo '<p>ユーザ情報を更新しました。</p>';
							echo '<ul class="actions">';
							echo '<li><a href="userinfo.php" class="button big">戻る</a></li>';
							echo '</ul>';

						} else {
							// 新規ユーザ登録
							// $sql=$pdo->prepare('insert into kanja values(null, ?, ?, ?, ?, ?, null, null)');
							$sql=$pdo->prepare('insert into kanja values(9, ?, ?, ?, ?, ?, null, null)');
							$sql->execute([
								$_REQUEST['kanja_id'],
								$_REQUEST['name'],
								$_REQUEST['password'],
								$_REQUEST['line_id'],
								$_REQUEST['line_name']]);

							echo 'ユーザ情報を登録しました。';
						}

					/*
					} else {
						echo '診察券番号がすでに使用されています。';
					}
				*/
					?>
				</section>

			</div>
		</div>

<?php require 'menu.php'; ?>
<?php require 'footer.php'; ?>
