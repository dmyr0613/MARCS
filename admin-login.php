<?php require 'admin-header.php'; ?>

<!-- Main -->
	<div id="main">
		<div class="inner">

				<!-- Header -->
				<?php require 'header-sub.php'; ?>

				<!-- loginpage -->
				<section id="loginpage">
					<form action="admin-login-out.php" method="post">
					施設番号<input type="text" name="facility_code"><br>
					パスワード<input type="password" name="password"><br>
					<input type="submit" value="LOGIN">
					</form>
				</section>

			</div>
		</div>

<?php require 'admin-menu.php'; ?>
<?php require 'footer.php'; ?>
