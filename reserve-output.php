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
					$pdo=new PDO('mysql:host=localhost;dbname=marcs;charset=utf8', 'sbs', 'sbs_toro');
					if (isset($_SESSION['kanja'])) {

						// ログイン中であれば、KANJAテーブルに予約時間をUPDATE。
						$sql=$pdo->prepare('update kanja set facility_code=?, yoyaku_datetime=? where kanja_id=?');
						$sql->execute([
							$_REQUEST['facility_code'],
							$_REQUEST['time'],
							$_SESSION['kanja']['kanja_id']]);

						echo $_REQUEST['time'], ' の予約を取得しました。';
					} else {
						echo '<ul class="actions">';
						echo '<li>ログインして下さい。</li><br>';
						echo '<li><a href="login-input.php" class="button big">LOGIN</a></li>';
						echo '</ul>';
					}
					?>
				</section>

			</div>
		</div>

<?php require 'menu.php'; ?>
<?php require 'footer.php'; ?>
