<? include $_SERVER["DOCUMENT_ROOT"]."/dev/common/login_chk.php" ?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./css/w2ui-1.5.rc1.css"/>
		<script type="text/javascript" src="./js/jquery-2.1.0.min.js"></script>
		<script type="text/javascript" src="./js/w2ui-1.5.rc1.js"></script>
		<meta charset="utf-8" />
	</head>

	<body>
		<div class="block">
			<h2>출퇴근 현황</h2>
		</div>
								
		<div class="w2ui-field w2ui-span4">
			<label> 날짜 : </label>
			<div>
				<input id="cal_year" style="width: 80px;">
				<input id="cal_month" style="width: 60px;">
				<input type="button" id="Search" value="조회" onClick="btn_Search()"/>
			</div>
		</div>
		
		<div>
			<p id="grid_cal" style="width:100%;height:500px;"></p>
		</div>
	</body>
	
</html>


<script>

	var today = new Date();
	var chYear = today.getFullYear();
	var chMonth = today.getMonth()+1;
	var Search_count = 0;

	if(chMonth < 10){
		chMonth = "0"+chMonth;
	}

	$.ajax({		
		url:'./calendar_grid.php',
		dataType: 'json',
		data: { month: chMonth, year: chYear},
		success:function(data){
			
			var dayCount = 1;
			var lastDay = ( new Date( chYear, chMonth, 0) ).getDate();
			
			var column_string = "[";

			column_string += "{ field:'NAME', caption: '이름', size:'10%', sortable: true, resizable: true },";
			column_string += "{ field:'GUBUN', caption: '구분', size:'10%', sortable: true, resizable: true },";

			while(dayCount <= lastDay) 
			{ 
				column_string += "{ field: '"+"D"+dayCount+"', caption:"+dayCount+", size:'5%' }";

				if (dayCount > lastDay-1)
				{
					break;
				}
				column_string += ",";
				dayCount++;
			}
			
			column_string += "]";
			var column = eval(column_string);
			
			jQuery("#grid_cal").w2grid({
				  name : "grid"
				, show : {
					lineNumbers:false
				}
				, columns : column
				, records: data
			});

			Search_count++;
		},
		error: function () {
			// 콜백 함수
		},
		complete: function () {
		
		}
	})


	//년도
	var dd = today.getDate();
	var mm = today.getMonth()+1;
	var yyyy = today.getFullYear();

	var yRow = [];
		yRow[0] = (yyyy-1)+"";
		yRow[1] = (yyyy)+"";
		yRow[2] = (yyyy+1)+"";
	//월
	var xRow = [];
	for(var i=1; i<13; i++){
		
		if (i < 10)
		{
			xRow[i-1] = "0"+i;
		}else{
			xRow[i-1] = i+"";
		}
	}

	var cyear = yRow;
	var cmonth = xRow;
	//문자열 형태가 아니면 안만들어짐..
	cyear.sort();
	cmonth.sort();

	$('input[id=cal_year]').w2field('list', { items: cyear, selected: yyyy});
	$('input[id=cal_month]').w2field('list', { items: cmonth, selected: mm});

	$(document).ready(function() { 
		
	});
	

 function btn_Search(){

	if (Search_count > 0)
	{
		$().w2destroy('grid');
	}

	chYear  = cal_year.value;
	chMonth = cal_month.value;

	$.ajax({		
		url:'./calendar_grid.php',
		dataType: 'json',
		data: { month: chMonth, year: chYear},
		success:function(data){
			
			var dayCount = 1;
			var lastDay = ( new Date( chYear, chMonth, 0) ).getDate();
			
			var column_string = "[";

			column_string += "{ field:'NAME', caption: '이름', size:'10%', sortable: true, resizable: true },";
			column_string += "{ field:'GUBUN', caption: '구분', size:'10%', sortable: true, resizable: true },";

			while(dayCount <= lastDay) 
			{ 
				column_string += "{ field: '"+"D"+dayCount+"', caption:"+dayCount+", size:'5%' }";

				if (dayCount > lastDay-1)
				{
					break;
				}
				column_string += ",";
				dayCount++;
			}
			
			column_string += "]";
			var column = eval(column_string);
			
			jQuery("#grid_cal").w2grid({
				  name : "grid"
				, show : {
					lineNumbers:false
				}
				, columns : column
				, records: data
			});

		},
		error: function () {
			// 콜백 함수
		},
		complete: function () {
		
		}
	})

	Search_count++;
}

</script>