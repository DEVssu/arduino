<?php

	require 'JSON.php'; // JSON.php 추가

     try
    {
        $connection = mysql_connect(V_DB_HOST, V_DB_USER, V_DB_PASSWORD) or die ("Could not connect: " . mysql_error());
        mysql_query("SET NAMES utf8",$connection);
        mysql_select_db(V_DB_NAME, $connection);
		
		$month = $_GET['month'];
		$year  = $_GET['year'];
		$user  = $_GET['user'];

		$sql = "SELECT W.*
                     , STR_TO_DATE(CONCAT('20170101',DATE_FORMAT(ee,'%H%i%s')), '%Y%m%d%H%i%s') WORK_TIME
                  FROM (
                        SELECT V.*
                             , TIMEDIFF(V.end, V.start) ee
                          FROM (
                                SELECT STR_TO_DATE(CONCAT('20170101',DATE_FORMAT(CLOCK_IN, '%H%i%s')), '%Y%m%d%H%i%s') start
	                                 , STR_TO_DATE(CONCAT('20170101',DATE_FORMAT(CLOCK_OUT, '%H%i%s')), '%Y%m%d%H%i%s') end
                                     , SUBSTR(CREATE_DAY,7,2) Day
		                          FROM user_record
			                     WHERE SUBSTR(CREATE_DAY,5,2) = '".$month."'
			                       AND SUBSTR(CREATE_DAY,1,4) = '".$year."'
			                       AND USER_NAME = '".$user."'
                                ) V
                        ) W ORDER BY Day";

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

