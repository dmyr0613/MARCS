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
					$pdo=new PDO('mysql:host=localhost;dbname=marcs;charset=utf8',
						'sbs', 'sbs_toro');
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

							echo 'ユーザ情報を更新しました。';
						} else {
							// 新規ユーザ登録
							$sql=$pdo->prepare('insert into kanja values(null, ?, ?, ?, ?, ?, null, null)');
							$sql->execute([
								$_SESSION['kanja']['kanja_id'],
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
