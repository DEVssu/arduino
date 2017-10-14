
<?php
require 'JSON.php'; // JSON.php 추가

$mysql_hostname = V_DB_HOST;

$mysql_username = V_DB_USER;

$mysql_password = V_DB_PASSWORD;

$mysql_database = V_DB_NAME;

$user_id =  $_GET['user_id'];

$ID = $_GET['ID'];
$USER_NAME = $_GET['USER_NAME'];
$USER_KR_NAME = $_GET['USER_KR_NAME'];
//1. DB 연결

$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);

//if(!$connect) echo "[연결실패]<br/>"; else echo "[연결성공]<br/>";

//mysql_query(" SET NAMES UTF-8 ");

mysql_query("set session character_set_connection=utf8;");

mysql_query("set session character_set_results=utf8;");

mysql_query("set session character_set_client=utf8;");

//2. DB 선택

mysql_select_db($mysql_database, $connect);

$sql = " UPDATE user_info SET USER_NAME =TRIM('$USER_NAME'), USER_KR_NAME =TRIM('$USER_KR_NAME') WHERE ID ='$ID' ";
$result = mysql_query($sql, $connect);

mysql_close($connect);
?>