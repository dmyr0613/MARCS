<?php session_start(); ?>
<?php require 'header.php'; ?>

<!-- Main -->
	<div id="main">
		<div class="inner">

			<!-- Header -->
				<header id="header">
					<a href="index.php" class="logo"><strong>MARCS</strong> MedicAl Record Control System</a>
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-medium"><span class="label">Medium</span></a></li>
					</ul>
				</header>

				<!-- loginpage -->
				<section id="loginpage">
					<?php
					unset($_SESSION['customer']);
					$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8',
						'staff', 'password');
					$sql=$pdo->prepare('select * from customer where login=? and password=?');
					$sql->execute([$_REQUEST['login'], $_REQUEST['password']]);
					foreach ($sql as $row) {
						$_SESSION['customer']=[
							'id'=>$row['id'], 'name'=>$row['name'],
							'address'=>$row['address'], 'login'=>$row['login'],
							'password'=>$row['password']];
					}
					if (isset($_SESSION['customer'])) {
						echo 'ようこそ、', $_SESSION['customer']['name'], ' さん。';
					} else {
						echo 'ログイン名またはパスワードが違います。';
					}
					?>
				</section>

			</div>
		</div>

<?php require 'menu.php'; ?>
<?php require 'footer.php'; ?>
