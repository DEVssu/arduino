<?php

	require 'JSON.php'; // JSON.php 추가

     try
    {
        $connection = mysql_connect(V_DB_HOST, V_DB_USER, V_DB_PASSWORD) or die ("Could not connect: " . mysql_error());
        mysql_query("SET NAMES utf8",$connection);
        mysql_select_db(V_DB_NAME, $connection);
		
		$month = $_GET['month'];
		$year  = $_GET['year'];
		$dayCount = 1;
		$getLastDay = date("t", strtotime($year . '-' . $month . '-01'));
		$YYYYMM  = $year.$month;


		while($dayCount <= $getLastDay) { 
				$P_STRING = $year.$month.'00'+$dayCount;
				$sql = "INSERT INTO user_record (ID, USER_NAME, CREATE_DAY) SELECT ID, USER_KR_NAME, '".$P_STRING."' FROM user_info ORDER BY ID asc";
				$sth = mysql_query($sql);
			$dayCount++; 
		} 

		$sql = "SELECT @ROWNUM := @ROWNUM + 1 recid
                     , V.*
				  FROM (
				SELECT ID
					 , USER_KR_NAME NAME
					 , '출근' GUBUN
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '01' AND A.ID = B.ID) D1
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '02' AND A.ID = B.ID) D2
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '03' AND A.ID = B.ID) D3
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '04' AND A.ID = B.ID) D4
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '05' AND A.ID = B.ID) D5
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '06' AND A.ID = B.ID) D6
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '07' AND A.ID = B.ID) D7
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '08' AND A.ID = B.ID) D8
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '09' AND A.ID = B.ID) D9
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '10' AND A.ID = B.ID) D10
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '11' AND A.ID = B.ID) D11
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '12' AND A.ID = B.ID) D12
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '13' AND A.ID = B.ID) D13
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '14' AND A.ID = B.ID) D14
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '15' AND A.ID = B.ID) D15
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '16' AND A.ID = B.ID) D16
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '17' AND A.ID = B.ID) D17
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '18' AND A.ID = B.ID) D18
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '19' AND A.ID = B.ID) D19
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '20' AND A.ID = B.ID) D20
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '21' AND A.ID = B.ID) D21
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '22' AND A.ID = B.ID) D22
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '23' AND A.ID = B.ID) D23
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '24' AND A.ID = B.ID) D24
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '25' AND A.ID = B.ID) D25
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '26' AND A.ID = B.ID) D26
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '27' AND A.ID = B.ID) D27
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '28' AND A.ID = B.ID) D28
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '29' AND A.ID = B.ID) D29
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '30' AND A.ID = B.ID) D30
					 , (SELECT SUBSTR(B.CLOCK_IN,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '31' AND A.ID = B.ID) D31
					 
				  FROM user_info A
				  
				  UNION ALL
				  
				  SELECT ID
					 , '' NAME
					 , '퇴근' GUBUN
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '01' AND A.ID = B.ID) D1
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '02' AND A.ID = B.ID) D2
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '03' AND A.ID = B.ID) D3
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '04' AND A.ID = B.ID) D4
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '05' AND A.ID = B.ID) D5
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '06' AND A.ID = B.ID) D6
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '07' AND A.ID = B.ID) D7
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '08' AND A.ID = B.ID) D8
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '09' AND A.ID = B.ID) D9
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '10' AND A.ID = B.ID) D10
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '11' AND A.ID = B.ID) D11
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '12' AND A.ID = B.ID) D12
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '13' AND A.ID = B.ID) D13
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '14' AND A.ID = B.ID) D14
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '15' AND A.ID = B.ID) D15
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '16' AND A.ID = B.ID) D16
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '17' AND A.ID = B.ID) D17
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '18' AND A.ID = B.ID) D18
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '19' AND A.ID = B.ID) D19
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '20' AND A.ID = B.ID) D20
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '21' AND A.ID = B.ID) D21
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '22' AND A.ID = B.ID) D22
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '23' AND A.ID = B.ID) D23
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '24' AND A.ID = B.ID) D24
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '25' AND A.ID = B.ID) D25
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '26' AND A.ID = B.ID) D26
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '27' AND A.ID = B.ID) D27
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '28' AND A.ID = B.ID) D28
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '29' AND A.ID = B.ID) D29
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '30' AND A.ID = B.ID) D30
					 , (SELECT SUBSTR(B.CLOCK_OUT,12,5) FROM user_record B WHERE DATE_FORMAT(B.CREATE_DAY, '%Y%m') = '".$YYYYMM."' AND DATE_FORMAT(B.CREATE_DAY, '%d') = '31' AND A.ID = B.ID) D31
				  FROM user_info A
				  ) V, (SELECT @ROWNUM := 0) R
				  ORDER BY V.ID, V.GUBUN";

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

