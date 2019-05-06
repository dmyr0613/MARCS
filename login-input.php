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
					<form action="login-output.php" method="post">
					ログイン名<input type="text" name="login"><br>
					パスワード<input type="password" name="password"><br>
					<input type="submit" value="ログイン">
					</form>
				</section>

			</div>
		</div>

<?php require 'menu.php'; ?>
<?php require 'footer.php'; ?>
