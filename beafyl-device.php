<?php session_start(); ?>
<?php require 'beafyl-header.php'; ?>

<!-- Main -->
	<div id="main">
		<div class="inner">

				<!-- Header -->
				<?php require 'beafyl-header-sub.php'; ?>

				<!-- reserveMain -->
				<section id="reserveMain">
					<?php

						// デバイス情報を取得する。
						$sql=$pdo->prepare('select * from device order by device_name');
						$sql->execute();

						echo '<form action="beafyl-device.php" method="post">';				//送信用のpost
						echo '<table>';
						echo '<th>UUID</th><th>名前</th>';
						foreach ($sql as $row) {
							echo '<tr>';
							echo '<td>', $row['device_name'], '</td>';
							echo '<td>', $row['name'], '</td>';
						}
						echo '</table>';
						echo '<input type="submit" class="button primary small" value="Register">';
						echo '</form>';

					?>
				</section>

			</div>
		</div>

<?php require 'beafyl-menu.php'; ?>
<?php require 'footer.php'; ?>
