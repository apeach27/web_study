<?php

    include "00_conn.php";

    $username = $_POST['username'];
	$userid = $_POST['userid'];
	$userpw = $_POST['userpw'];

    echo "넘어오는 정보 확인 : ".$username." / ".$userid." / ".$userpw." <br/>";

    if(!empty($username) && !empty($userid) && !empty($userpw)){

		$sql = "INSERT INTO members
		(username, userid, userpw)
		VALUES
		('$username', '$userid', '$userpw')";

		$result = mysqli_query($conn, $sql);
	}

    if($result){
		echo "<p style='text-align:center; color:blue;'>회원가입에 성공했습니다.</p>";
		
		echo "<meta http-equiv='Refresh' content='1; url=00_login.php'/>";
	}
	else{
		echo "<p style='text-align:center; color:red;'>회원가입에 실패했습니다.</p>";
	}

?>