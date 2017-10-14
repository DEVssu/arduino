<?php
	require 'JSON.php'; // JSON.php 추가
	

     try
    {
        $connection = mysql_connect(V_DB_HOST, V_DB_USER, V_DB_PASSWORD) or die ("Could not connect: " . mysql_error());
        mysql_query("SET NAMES utf8",$connection);
        mysql_select_db(V_DB_NAME, $connection);

		$sql = "SELECT USER_KR_NAME CD_NM FROM user_info ORDER BY ID";

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