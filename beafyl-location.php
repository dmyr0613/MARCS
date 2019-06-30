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

						//デバイス毎に最新の情報を取得
					  $sqlText  = 'select COALESCE(b.name,a.device_name) disp_name,a.device_name,COALESCE(c.name,a.uuid) beacon_name,';
					  $sqlText .= '       a.uuid,a.lat,a.lon,a.proximity,a.status,a.update_datetime';
					  $sqlText .= '  from (';
					  $sqlText .= '       (';
					  $sqlText .= '       select aa.*';
					  $sqlText .= '         from location aa inner join';
					  $sqlText .= '              (select device_name,max(update_datetime) update_datetime from location group by device_name) bb';
					  $sqlText .= '           on aa.device_name     = bb.device_name';
					  $sqlText .= '          and aa.update_datetime = bb.update_datetime';
					  $sqlText .= '       ) a ';
					  $sqlText .= '       left join device b on a.device_name = b.device_name';
					  $sqlText .= '       )';
					  $sqlText .= '       left join beacon c on a.uuid = c.uuid ';
					  $sqlText .= ' order by update_datetime desc';

					  $sql=$pdo->prepare($sqlText);
						$sql->execute();

						echo '<form action="beafyl-location-detail.php" method="post">';				//送信用のpost
						echo '<table>';
						echo '<th>デバイス</th><th>ビーコン</th><th>ステータス</th><th>日時</th><th>詳細</th>';
						foreach ($sql as $row) {
							echo '<tr>';
							echo '<td>', $row['disp_name'], '</td>';
							echo '<td>', $row['beacon_name'], '</td>';
							echo '<td>', $row['status'], '</td>';
							echo '<td>', $row['update_datetime'], '</td>';
							echo '<td>';
							echo '<input type="Detail" class="button primary small" value="Register">';
							echo '</td>';
						}
						echo '</table>';
						echo '</form>';

					?>
				</section>

			</div>
		</div>

<?php require 'beafyl-menu.php'; ?>
<?php require 'footer.php'; ?>
