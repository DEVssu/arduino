<?php
session_start(); 
//echo $_SESSION['USER_NAME'];
//echo $_SESSION['USER_ID'];
if($_SESSION['USER_ID']==NULL) { 
	//echo "test"; ?>
	<meta http-equiv='refresh' content='0;url=login.php'>
<? }else{ 
$USER_ID = @$_SESSION['USER_ID'];
$USER_NAME = @$_SESSION['USER_NAME'];
}

?>