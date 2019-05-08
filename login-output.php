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
					// $pdo=new PDO('mysql:host=localhost;dbname=marcs;charset=utf8', 'sbs', 'sbs_toro');
					$pdo=new PDO('mysql:host=ec2-174-129-208-118.compute-1.amazonaws.com;dbname=d13p6kmhdcirvm;charset=utf8', 'gkijtxlavebgol', 'ecff643bfa3612a94627c9d668f867a06ce4b86e4a69f8a42d981af26c50a505');
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
