<?php

	require 'JSON.php'; // JSON.php 추가

     try
    {
        $connection = mysql_connect(V_DB_HOST, V_DB_USER, V_DB_PASSWORD) or die ("Could not connect: " . mysql_error());
        mysql_query("SET NAMES utf8",$connection);
        mysql_select_db(V_DB_NAME, $connection);

		$json = $_GET['result'];
		
		//$data_array = json_decode($json, true);
		$data_array = $json;
		$data_array = str_replace("\\", "", $data_array);
		$data_array = str_replace("[", "", $data_array);
		$data_array = str_replace("]", "", $data_array);
		$data_array = str_replace("},{", "};{", $data_array);
		$data_array = explode(';', $data_array);

		$Count = 0;
		while($Count < count($data_array)) { 
			
				$USER_NAME = "";
				$USER_KR_NAME = "";

				$data_array[$Count] = str_replace("{", "", $data_array[$Count]);
				$data_array[$Count] = str_replace("}", "", $data_array[$Count]);
				$data_array[$Count] = str_replace("'", "", $data_array[$Count]);
				$data_array[$Count] = str_replace('"', "", $data_array[$Count]);

				//echo $data_array[0];
				$data_array_str = explode(',', $data_array[$Count]);

				//ID
				$data_array_str_id = explode(':', $data_array_str[0]);
				$ID = $data_array_str_id[1];

				
				//USER_NAME
				$data_array_str_name = explode(':', $data_array_str[1]);
				if($data_array_str_name[0] == "NAME"){
					$USER_NAME = $data_array_str_name[1];
					$sql = "UPDATE user_info SET USER_NAME =TRIM('".$USER_NAME."') WHERE ID ='".$ID."'";
				}else{
					$USER_KR_NAME = $data_array_str_name[1];
					$sql = "UPDATE user_info SET USER_KR_NAME =TRIM('".$USER_KR_NAME."') WHERE ID ='".$ID."'";
				}

				if(count($data_array_str) == 3){
					//USER_KR_NAME
					$data_array_str_id = explode(':', $data_array_str[2]);
					$USER_KR_NAME = $data_array_str_id[1];
					$sql = "UPDATE user_info SET USER_NAME =TRIM('".$USER_NAME."'), USER_KR_NAME =TRIM('".$USER_KR_NAME."') WHERE ID ='".$ID."'";
				}

				$sth = mysql_query($sql);

			$Count++; 
		} 
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        // Note: Log the error or something
    }
?>

