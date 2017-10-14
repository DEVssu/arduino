<meta charset="utf-8" />
<?php
session_start();

//echo $_POST['USER_ID'];
//echo $_POST['PASSWORD'];

if($_POST['USER_ID']==NULL){ ?>
	<meta http-equiv='refresh' content='0; url=./login.php'>
	<script language="JavaScript">
				 alert("ID가 입력되지 않았습니다.");
	</script>

	
<?}
else if($_POST['PASSWORD']==NULL){?>
	<meta http-equiv='refresh' content='0; url=./login.php'>
	<script language="JavaScript">
				alert("패스워드가 입력되지 않았습니다.");
	</script>
	

<?}

else if(isset($_POST['USER_ID']) && isset($_POST['PASSWORD'])){ 

	//사용자 로그인을 하려고할때
	$USER_ID = $_POST['USER_ID'];
	$PASSWORD = $_POST['PASSWORD'];

	$connect = mysql_connect('localhost:3307', 'root', 'apmsetup');

	mysql_select_db('arduino', $connect);

	mysql_query("set session character_set_connection=utf8;");

	mysql_query("set session character_set_results=utf8;");

	mysql_query("set session character_set_client=utf8;");

	$sql = " SELECT * FROM user_login WHERE ID = '$USER_ID' AND PASSWORD ='$PASSWORD' "; 

	$result = mysql_query($sql, $connect);

	$row = mysql_fetch_array($result);
	
	//echo $row[NAME];
	//echo $row[ID];
	//echo $row[PASSWORD];
	if($row[ID]!=null){
		
		$_SESSION['USER_ID'] = $USER_ID;
		$_SESSION['USER_NAME'] = $row[NAME]; 

		//echo $_SESSION['USER_ID'];
		//echo $_SESSION['USER_NAME'];
		
		?><script language="JavaScript">
				location.replace('./index.php');
			</script><?
	}
	else{
		?><meta http-equiv='refresh' content='0; url=./login.php'>
			<script language="JavaScript">
				alert("정보가 일치하지 않습니다.");
			</script><?
	}
	mysql_close($connect);
}

?>
