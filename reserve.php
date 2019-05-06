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

				<!-- reserveMain -->
				<section id="reserveMain">
					<?php
					$name=$address=$login=$password='';
					if (isset($_SESSION['customer'])) {
						$name=$_SESSION['customer']['name'];
						$address=$_SESSION['customer']['address'];
						$login=$_SESSION['customer']['login'];
						$password=$_SESSION['customer']['password'];

						echo '<table>';
						echo '<tr><td>お名前</td><td>';
						echo '<input type="text" name="name" value="', $name, '">';
						echo '</td></tr>';
						echo '<tr><td>ご住所</td><td>';
						echo '<input type="text" name="address" value="', $address, '">';
						echo '</td></tr>';
						echo '<tr><td>ログイン名</td><td>';
						echo '<input type="text" name="login" value="', $login, '">';
						echo '</td></tr>';
						echo '<tr><td>パスワード</td><td>';
						echo '<input type="password" name="password" value="', $password, '">';
						echo '</td></tr>';
						echo '</table>';
					} else {
						echo 'ログインして下さい。';
					}
					?>
				</section>

			</div>
		</div>

<?php require 'menu.php'; ?>
<?php require 'footer.php'; ?>
