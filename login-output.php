<?php session_start(); ?>
<?php require 'header.php'; ?>

<!-- Main -->
	<div id="main">
		<div class="inner">

				<!-- Header -->
				<?php require 'header-sub.php'; ?>

				<!-- loginpage -->
				<section id="loginpage">
					<?php
					unset($_SESSION['kanja']);
					$pdo=new PDO('mysql:host=localhost;dbname=marcs;charset=utf8',
						'sbs', 'sbs_toro');
					$sql=$pdo->prepare('select * from kanja where kanja_id=? and password=?');
					$sql->execute([$_REQUEST['kanja_id'], $_REQUEST['password']]);
					foreach ($sql as $row) {
						$_SESSION['kanja']=[
							'no'=>$row['no'],
							'kanja_id'=>$row['kanja_id'],
							'name'=>$row['name'],
							'password'=>$row['password'],
							'line_id'=>$row['line_id'],
							'line_name'=>$row['line_name']];
					}
					if (isset($_SESSION['kanja'])) {
						echo 'ようこそ、', $_SESSION['kanja']['name'], ' さん。';
					} else {
						echo 'ログイン名またはパスワードが違います。';
					}
					?>
				</section>

			</div>
		</div>

<?php require 'menu.php'; ?>
<?php require 'footer.php'; ?>
