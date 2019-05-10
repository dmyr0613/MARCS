<?php session_start(); ?>
<?php require 'header.php'; ?>

<!-- Main -->
	<div id="main">
		<div class="inner">

				<!-- Header -->
				<?php require 'header-sub.php'; ?>

				<!-- reserveMain -->
				<section id="userinfoMain">
					<?php
					$kanja_id=$name=$password=$line_id=$line_name='';
					if (isset($_SESSION['kanja'])) {
						$kanja_id=$_SESSION['kanja']['kanja_id'];
						$name=$_SESSION['kanja']['name'];
						$password=$_SESSION['kanja']['password'];
						$line_id=$_SESSION['kanja']['line_id'];
						$line_name=$_SESSION['kanja']['line_name'];
					}
					echo '<form action="userinfo-output.php" method="post">';
					echo '<table>';
					echo '<tr><td>診察券番号</td><td>';
					if (empty($kanja_id)) {
						//ReadOnly属性を外す
						echo '<input type="text" name="kanja_id" value="">';
					} else {
						echo '<input type="text" name="kanja_id" value="', $kanja_id, '" readonly="readonly">';
					}
					echo '</td></tr>';
					echo '<tr><td>お名前</td><td>';
					echo '<input type="text" name="name" value="', $name, '">';
					echo '</td></tr>';
					echo '<tr><td>パスワード</td><td>';
					echo '<input type="password" name="password" value="', $password, '">';
					echo '</td></tr>';
					echo '<tr><td>LINE ID ※入力不要</td><td>';

					if (!empty($_REQUEST)) {
						//Reserve.phpからLINE_IDを渡されている場合
						echo '<input type="text" name="line_id" value="', $_REQUEST['line_id'], '" readonly="readonly">';
					} else {
						echo '<input type="text" name="line_id" value="', $line_id, '" readonly="readonly">';
					}

					echo '</td></tr>';
					echo '<tr><td>LINE 名称</td><td>';
					echo '<input type="text" name="line_name" value="', $line_name, '">';
					echo '</td></tr>';
					echo '</table>';
					echo '<input type="submit" value="確定">';
					echo '</form>';
					?>
				</section>

			</div>
		</div>

<?php require 'menu.php'; ?>
<?php require 'footer.php'; ?>
