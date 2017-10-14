<?php
	
	if(isset($_POST["Token"])){

		$token = $_POST["Token"];

		include_once 'config.php';

		$conn = mysqli_connect(DB_HOST,DB_USER, DB_PASSWORD, DB_NAME);
		
		//if(!$conn) echo "[연결실패]<br/>"; else echo "[연결성공]<br/>";

		$query = "INSERT INTO user_token(Token) Values ('$token') ON DUPLICATE KEY UPDATE Token = '$token'; ";
		
		mysqli_query($conn, $query);

		mysqli_close($conn);
	}
?>
