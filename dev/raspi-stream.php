<? include $_SERVER["DOCUMENT_ROOT"]."/dev/common/login_chk.php" ?>
<!DOCTYPE HTML>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="./css/w2ui-1.5.rc1.css"/>
	<script type="text/javascript" src="./js/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="./js/w2ui-1.5.rc1.js"></script>
	</head>

	<body>


	<div class="block">
			<h2>CCTV</h2>
		</div>
								
		<div class="w2ui-field w2ui-span4">
		<div style="position:absolute" id="pop" name="pop" onclick="close_pop()">
		</div>

		<table border="2">
			<tr>
				<td onclick="open_pop()" width="320" height="188">
					<img style ="-webkit-user-select: none;" src ="http://jsupi.iptime.org:801">
				</td>
				<td onclick="open_pop()" width="320" height="188">
					<img style ="-webkit-user-select: none;" src ="http://jsupi.iptime.org:801">
				</td>
				<td onclick="open_pop()" width="320" height="188">
					<img style ="-webkit-user-select: none;" src ="http://jsupi.iptime.org:801">
				</td>

				<td rowspan="3" width="300" valign="top">
					<br>
					<div class="w2ui-field w2ui-span1">
						<div>
							<input id="cam_combo" style="width: 80px;" onchange="cam_combo_change()">
						</div>
						<br>
						<div>
							<label>온도값 : </label>
							<label id="temp"></label>
						</div>
						<div>
							<label>습도값 : </label>
							<label id="humi"></label>
						</div>
						<div>
							<label>가스 : </label>
							<label id="gas"></label>
						</div>
						<div>
							<label>측정시간 : </label>
							<label id="C_DAY"></label>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td onclick="open_pop()" width="320" height="188">
					<img style ="-webkit-user-select: none;" src ="http://jsupi.iptime.org:801">
				</td>
				<td onclick="open_pop()" width="320" height="188">
					<img style ="-webkit-user-select: none;" src ="http://jsupi.iptime.org:801">
				</td>
				<td onclick="open_pop()" width="320" height="188">
					<img style ="-webkit-user-select: none;" src ="http://jsupi.iptime.org:801">
				</td>

			</tr>
			<tr>
				<td onclick="open_pop()" width="320" height="188">
					<img style ="-webkit-user-select: none;" src ="http://jsupi.iptime.org:801">
				</td>
				<td onclick="open_pop()" width="320" height="188">
					<img style ="-webkit-user-select: none;" src ="http://jsupi.iptime.org:801">
				</td>
				<td onclick="open_pop()" width="320" height="188">
					<img style ="-webkit-user-select: none;" src ="http://jsupi.iptime.org:801">
				</td>
			</tr>
		</table>

	</body>
</html>
<script>
//조회
dataReload();
//5초마다 재조회
setInterval(function() { dataReload();}, 5000);

var vRow = [];
for(var i=0; i<9; i++){
	vRow[i] = "카메라 "+(i+1);
}

var Cam_num = vRow;
//문자열 형태가 아니면 안만들어짐..
Cam_num.sort();

$('input[id=cam_combo]').w2field('list', { items: Cam_num, selected: "카메라 1"});


function open_pop(){
	document.all("pop").innerHTML='<img style ="-webkit-user-select: none;" width="980" height="600" src ="http://jsupi.iptime.org:801"> '
}

function close_pop(){
	document.all("pop").innerHTML=''
}


function dataReload(){
	
	$.ajax({		
		url:'./temperature.php',
		dataType: 'json',
		success:function(data){
			document.getElementById("temp").innerHTML = data[0].TEMP;
			document.getElementById("humi").innerHTML = data[0].HUMI;
			document.getElementById("gas").innerHTML = data[0].GAS;
			document.getElementById("C_DAY").innerHTML = data[0].NOW_DAY;
		},
		error: function () {
			// 콜백 함수
		},
		complete: function () {
		
		}
	})
}

function cam_combo_change(){
	document.getElementById("temp").innerHTML = "";
	document.getElementById("humi").innerHTML = "";
	document.getElementById("gas").innerHTML = "";
	document.getElementById("C_DAY").innerHTML = "";
}

</script>