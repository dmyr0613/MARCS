<!DOCTYPE html>
<html>
<head>
<title>MARCS | 管理者画面</title>
<link rel="shortcut icon" type="image" href="images/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<link rel="stylesheet" href="assets/css/admin-main.css" />
<!-- <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css"> -->
</head>

<BODY>
<SCRIPT language="JavaScript">
<!--
  function msgdsp(msg) {
      // alert("メッセージ");
      document.write(msg);
  }

  function msgDisp(msg){
	// 値を設定
	document.formMain.barcode.value = msg;
  }
  function msgClear(){
  	document.formMain.barcode.value = ""; //クリア
  }
// -->
</SCRIPT>


<!-- Main -->
	<div id="main">
		<div class="inner">

				<!-- reserveMain -->
				<section id="userinfoMain">

          <!-- loginpage -->
  				<section id="loginpage">
  					<form name="formMain" method="post">
  					バーコード<input type="text" name="barcode"><br>
            <!-- <INPUT type="button" name="B1" value="TEST" onclick="msgdsp('テスト')"> -->
            <input type="button" value="設定" onclick="msgDisp('テスト')">
            <input type="button" value="クリア" onclick="msgClear()">
  					</form>
  				</section>

				</section>

			</div>
		</div>

</BODY>
</HTML>
