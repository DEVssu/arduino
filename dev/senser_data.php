<?php

	require 'JSON.php'; // JSON.php 추가

     try
    {
        $connection = mysql_connect(V_DB_HOST, V_DB_USER, V_DB_PASSWORD) or die ("Could not connect: " . mysql_error());
        mysql_query("SET NAMES utf8",$connection);
        mysql_select_db(V_DB_NAME, $connection);
		

	$now_time = $_GET['now_time'];

	$sql = "SELECT TEMPERATURE 
	             , HUMIDITY
				 , GAS
				 , (SELECT MAX(TEMPERATURE) FROM temperature WHERE DATE_FORMAT(CREATE_DAY, '%Y%m%d') = ".$now_time.") MAX_TEMPERATURE
				 , (SELECT MIN(TEMPERATURE) FROM temperature WHERE DATE_FORMAT(CREATE_DAY, '%Y%m%d') = ".$now_time.") MIN_TEMPERATURE
				 , (SELECT MAX(HUMIDITY) FROM temperature WHERE DATE_FORMAT(CREATE_DAY, '%Y%m%d') = ".$now_time.") MAX_HUMIDITY
				 , (SELECT MAX(GAS) FROM temperature WHERE DATE_FORMAT(CREATE_DAY, '%Y%m%d') = ".$now_time.") MAX_GAS
				 , CREATE_DAY Day
		      FROM temperature
			 WHERE DATE_FORMAT(CREATE_DAY, '%Y%m%d') = ".$now_time."
			 ORDER BY CREATE_DAY";

    $sth = mysql_query($sql) or die ("Query error: " . mysql_error());
        
    // JSON 객체 생성
	$json = new Services_JSON();
        
    $rows = array();
	while($r = mysql_fetch_assoc($sth)) {
	    $rows[] = $r;
	}	

	//결과값을 JSON형식으로 변환
	$output = json_encode($rows);

	//변수 내용 출력
	echo $output."\n";


    mysql_close($connection);
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        // Note: Log the error or something
    }
?>

