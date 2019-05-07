<?php session_start(); ?>
<?php require 'header.php'; ?>

<!-- Main -->
	<div id="main">
		<div class="inner">

				<!-- Header -->
				<?php require 'header-sub.php'; ?>

				<!-- reserveMain -->
				<section id="reserveMain">
					<?php
					if (isset($_SESSION['kanja'])) {
					?>
						<!-- ログイン中であれば、予約取得画面を表示する。 -->
						<header>
							<p>希望する診察時間を選択して下さい。</p>
						</header>
						<form action="reserve-output.php" method="post">
							<!-- 施設リスト -->
							<div class="col-12">
								<select name="facility_code" id="facility_code">
									<option value="1234567890">SBSクリニック</option>
									<option value="0987654321">MARCS診療所</option>
								</select>
							</div>
							<br>
							<!-- 予約時間ラジオボタン -->
							<div class="row gtr-uniform">
								<div class="col-4 col-12-small">
									<input type="radio" id="time0800" name="time" value="08:00" checked>
									<label for="time0800">08:00</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="radio" id="time0830" name="time" value="08:30">
									<label for="time0830">08:30</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="radio" id="time0900" name="time" value="09:00">
									<label for="time0900">09:00</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="radio" id="time0930" name="time" value="09:30">
									<label for="time0930">09:30</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="radio" id="time1000" name="time" value="10:00">
									<label for="time1000">10:00</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="radio" id="time1030" name="time" value="10:30">
									<label for="time1030">10:30</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="radio" id="time1100" name="time" value="11:00">
									<label for="time1100">11:00</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="radio" id="time1130" name="time" value="11:30">
									<label for="time1130">11:30</label>
								</div>
							</div>
							<br>
							<input type="submit" value="予約登録">
						</form>

					<?PHP
					} else {
						echo '<ul class="actions">';
						echo '<li>ログインして下さい。</li><br>';
						echo '<li><a href="login-input.php" class="button big">LOGIN</a></li>';
						echo '</ul>';
					}
					?>
				</section>

			</div>
		</div>

<?php require 'menu.php'; ?>
<?php require 'footer.php'; ?>
