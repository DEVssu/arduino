
<?php

$today=mktime(); 

echo "#".$now_time = date('Y.m.d H:i:s', $today);

$now_day = date('Ymd', $today);

$CLOCK_IN = date('YmdHis', $today);

$mysql_hostname = 'localhost:3307';

$mysql_username = 'root';

$mysql_password = 'apmsetup';

$mysql_database = 'arduino';

$user_id =  $_GET['user_id'];

//1. DB 연결

$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);

//if(!$connect) echo "[연결실패]<br/>"; else echo "[연결성공]<br/>";

mysql_query(" SET NAMES UTF-8 ");

//2. DB 선택

mysql_select_db($mysql_database, $connect);

$sql = " SELECT ID, USER_NAME, CREATE_DAY FROM user_info where id = '$user_id' ";
//$sql = " INSERT INTO user_record (ID, USER_NAME, CLOCK_IN,) VALUES('$user_id','$user_id',".$now_time.") ";

//INSERT INTO students (NAME, email) VALUES ('apple', 'apple@naver.com') 
// ON DUPLICATE KEY UPDATE name='apple', email='apple@nhnent.com';
$result = mysql_query($sql, $connect);


while($row = mysql_fetch_array($result)){
	echo " #Name:".$row[USER_NAME].
		", #Time:".$row[CREATE_DAY]. 
		", #ID:".$row[ID];
	$user_name = $row[USER_NAME];
}	
	echo "#&";

$sql = " SELECT CLOCK_IN FROM user_record where id = '$user_id' AND CREATE_DAY = ".$now_day." ";
$result = mysql_query($sql, $connect);

while($row = mysql_fetch_array($result)){
	 $temp = $row[CLOCK_IN];
}	
if($temp == null){
	$sql = " INSERT INTO user_record (ID, USER_NAME, CLOCK_IN, CREATE_DAY) VALUES('$user_id','$user_name', ".$CLOCK_IN.", ".$now_day.") ON DUPLICATE KEY UPDATE CLOCK_IN=".$CLOCK_IN." ";
	$result = mysql_query($sql, $connect);
}
mysql_close($connect);
?>
