<?php


$mysql_hostname = 'localhost:3307';

$mysql_username = 'root';

$mysql_password = 'apmsetup';

$mysql_database = 'arduino';

$user_id =  $_GET['user_id'];
$user_name =  $_GET['user_name'];


$today=mktime(); 
echo $now_time = date('YmdHis', $today);


//1. DB ����

$connect = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);

if(!$connect) echo "[�������]<br/>"; else echo "[���Ἲ��]<br/>";

mysql_query(" SET NAMES UTF-8 ");


//2. DB ����

mysql_select_db($mysql_database, $connect);

$sql = " INSERT INTO user_info(ID, USER_NAME, USER_KR_NAME, CREATE_DAY) VALUES('$user_id','$user_id','$user_id', ".$now_time.") ";

$result = mysql_query($sql, $connect);

mysql_close($connect);

?>
