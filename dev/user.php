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
			<h2>사용자정보</h2>
		</div>
								
		<div class="w2ui-field w2ui-span4">
			<label> 사용자명 : </label>
			<div>
				<input id="user_info" type="user" onkeypress="if (event.keyCode == 13) { btn_Search(); event.returnValue = false }" />
				<input type="button" id="Search" value="조회" onClick="btn_Search()"/>
				<input type="button" id="Save" value="저장" onClick="btn_Save()"/>
			</div>
		</div>

		<div>
			<p id="grid_user" style="width:100%;height:500px;"></p>
		</div>

	</body>
	
</html>


<script>

	var Search_count = 0;
	var chuser = "";
	$.ajax({		
		url:'./user_grid.php',
		dataType: 'json',
		data: { user: chuser},
		success:function(data){
			
			var column_string = "[";

			column_string += "{ field:'ID', caption: 'ID', size:'10%', sortable: true, resizable: true },";
			column_string += "{ field:'NAME', caption: '이니셜', size:'10%', sortable: true, resizable: true , editable: { type: 'text' }},";
			column_string += "{ field:'KR_NAME', caption: '이름', size:'10%', sortable: true, resizable: true , editable: { type: 'text' }}";
			
			column_string += "]";

			var column = eval(column_string);
			
			jQuery("#grid_user").w2grid({
				  name : "grid"
				, show : {
					footer: true,
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

function btn_Search(){

	if (Search_count > 0)
	{
		$().w2destroy('grid');
	}

	var chuser = user_info.value;

	$.ajax({		
		url:'./user_grid.php',
		dataType: 'json',
		data: { user: chuser},
		success:function(data){
			
			var column_string = "[";

			column_string += "{ field:'ID', caption: 'ID', size:'10%', sortable: true, resizable: true },";
			column_string += "{ field:'NAME', caption: '이니셜', size:'10%', sortable: true, resizable: true , editable: { type: 'text' }},";
			column_string += "{ field:'KR_NAME', caption: '이름', size:'10%', sortable: true, resizable: true , editable: { type: 'text' }}";
			
			column_string += "]";

			var column = eval(column_string);
			
			jQuery("#grid_user").w2grid({
				  name : "grid"
				, show : {
					footer: true,
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

}

function btn_Save(){

	var check = confirm("저장하시겠습니까?");

	if(!check){
		return;
	}

	var result = JSON.stringify(w2ui['grid'].getChanges());

	$.ajax({		
		url:'./user_grid_save.php',
		dataType: 'html',
		data: { result: result},
		success:function(data){
			alert("저장되었습니다");
		},
		error: function () {
			// 콜백 함수
		},
		complete: function () {
		
		}
	})
}

</script>