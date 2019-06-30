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
						if (!empty($_REQUEST['device_name'])) {

							$device_name = $_REQUEST['device_name'];
							echo '<p>デバイス名：' . $device_name . ' の詳細情報</p>';

							//locationからデバイス名指定で全データを取得する
						  $sqlText   = 'select COALESCE(c.name,a.uuid) beacon_name,';
						  $sqlText  .= '      a.uuid,a.lat,a.lon,a.proximity,a.status,a.update_datetime';
						  $sqlText  .= ' from location a inner join beacon c';
						  $sqlText  .= '   on a.uuid        = c.uuid';
						  $sqlText  .= "  and a.device_name = '" . $device_name . "'";
						  $sqlText  .= 'order by update_datetime desc';

						  $sql=$pdo->prepare($sqlText);
							$sql->execute();

							echo '<table>';
							echo '<th>ビーコン</th><th>ステータス</th><th>日時</th>';
							foreach ($sql as $row) {
								echo '<tr>';
								echo '<td>', $row['beacon_name'], '</td>';
								echo '<td>', $row['status'], '</td>';
								echo '<td>', $row['update_datetime'], '</td>';
								echo '</tr>';
							}
							echo '</table>';
							echo '<ul class="actions">';
							echo '<li><a href="beafyl-location.php" class="button big">戻る</a></li>';
							echo '</ul>';
						}

					?>
				</section>

			</div>
		</div>

<?php require 'beafyl-menu.php'; ?>
<?php require 'footer.php'; ?>
