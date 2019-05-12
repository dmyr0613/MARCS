<?php session_start(); ?>
<?php require 'header.php'; ?>

<!-- Main -->
	<div id="main">
		<div class="inner">

				<!-- Header -->
				<?php require 'header-sub.php'; ?>

				<!-- symptomMain -->
				<section id="symptomMain">
					<?php

					if (isset($_SESSION['kanja'])) {
					?>

						<!-- ログイン中であれば、問診票入力画面を表示する。 -->
						<!-- <header>
							<p>本日はどうされましたか？</p>
						</header> -->
						<form action="symptom-output.php" method="post">

							<!-- message1 -->
							<p>１．本日はどうされましたか？</p>
							<div class="row gtr-uniform">
								<div class="col-4 col-12-small">
									<input type="checkbox" id="chk1" name="chk1" value="chk1">
									<label for="chk1">熱がある</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="checkbox" id="chk2" name="chk2" value="chk2">
									<label for="chk2">咳が出る</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="checkbox" id="chk3" name="chk3" value="chk3">
									<label for="chk3">痰がからむ</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="checkbox" id="chk4" name="chk4" value="chk4">
									<label for="chk4">鼻水が出る</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="checkbox" id="chk5" name="chk5" value="chk5">
									<label for="chk5">頭が痛い</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="checkbox" id="chk6" name="chk6" value="chk6">
									<label for="chk6">喉が痛い</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="checkbox" id="chk7" name="chk7" value="chk7">
									<label for="chk7">寒気がする</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="checkbox" id="chk8" name="chk8" value="chk8">
									<label for="chk8">関節が痛い</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="checkbox" id="chk9" name="chk9" value="chk9">
									<label for="chk9">息苦しい</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="checkbox" id="chk10" name="chk10" value="chk10">
									<label for="chk10">お腹が痛い</label>
								</div>
								<div class="col-4 col-12-xsmall">
									<input type="text" name="text1" id="text1" value="" placeholder="その他" />
								</div>
							</div>
							<br><br>

							<!-- message2 -->
							<div class="col-12">
								<p>２．症状はいつ頃からですか？</p>
								<textarea name="message2" id="message2" placeholder="症状はいつ頃からですか？" rows="3"></textarea>
							</div>
							<br><br>

							<!-- message3 -->
							<p>３．現在治療中の病気、または過去に治療を受けた大きな病気はございますか？</p>
							<div class="row gtr-uniform">
								<div class="col-4 col-12-small">
									<input type="checkbox" id="chk11" name="chk11" value="chk11">
									<label for="chk11">糖尿病</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="checkbox" id="chk12" name="chk12" value="chk12">
									<label for="chk12">高血圧</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="checkbox" id="chk13" name="chk13" value="chk13">
									<label for="chk13">前立腺肥大症</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="checkbox" id="chk14" name="chk14" value="chk14">
									<label for="chk14">心臓疾患</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="checkbox" id="chk15" name="chk15" value="chk15">
									<label for="chk15">喘息</label>
								</div>
								<div class="col-4 col-12-xsmall">
									<input type="text" name="text2" id="demo-text2" value="" placeholder="その他" />
								</div>
							</div>
							<br><br>

							<!-- message3 -->
							<div class="col-12">
								<p>３．服用中のお薬はありますか？</p>
								<textarea name="message3" id="message3" placeholder="服用中のお薬はありますか？" rows="3"></textarea>
							</div>
							<br><br>

							<!-- message4 -->
							<p>４．女性の方：現在妊娠中ですか？</p>
							<div class="row gtr-uniform">
								<div class="col-4 col-12-small">
									<input type="checkbox" id="chk21" name="chk21" value="chk21">
									<label for="chk21">いいえ</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="checkbox" id="chk22" name="chk22" value="chk22">
									<label for="chk22">わからない</label>
								</div>
								<div class="col-4 col-12-small">
									<input type="checkbox" id="chk23" name="chk23" value="chk23">
									<label for="chk23">はい</label>
								</div>
							</div>
							<br><br>

							<!-- message5 -->
							<div class="col-12">
								<p>５．その他、気になることはありますか？</p>
								<textarea name="message5" id="message5" placeholder="その他、気になることはありますか？" rows="3"></textarea>
							</div>
							<br><br>

							<input type="submit" class="button big primary" value="登録">
						</form>

					<?PHP
					} else {

						echo '<p>ログインして下さい。</p>';
						echo '<ul class="actions">';
						echo '<li><a href="login-input.php" class="button big">LOGIN</a></li>';
						echo '</ul>';

					}
					?>
				</section>

			</div>
		</div>

<?php require 'menu.php'; ?>
<?php require 'footer.php'; ?>
