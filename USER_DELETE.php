<?php


$mysql_hostname = 'localhost:3307';

$mysql_username = 'root';

$mysql_password = 'apmsetup';

$mysql_database = 'arduino';

$user_id =  $_GET['user_id'];


$today=mktime(); 
echo $now_time = date('YmdHis', $today);


//1. DB 연결

$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);

if(!$connect) echo "[연결실패]<br/>"; else echo "[연결성공]<br/>";

mysql_query(" SET NAMES UTF-8 ");


//2. DB 선택

mysql_select_db($mysql_database, $connect);

$sql = " DELETE FROM user_info WHERE ID = '$user_id' ";

$result = mysql_query($sql, $connect);

mysql_close($connect);

?>
