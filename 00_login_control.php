<?php
	include "00_conn.php";

	$userid = $_POST['userid'];
	$userpw = $_POST['userpw'];

	echo "넘어오는 정보 확인 ".$userid." / ".$userpw."<br/>";

	$sql = "SELECT * FROM members WHERE userid='$userid' AND userpw='$userpw' ";
	$result = mysqli_query($conn, $sql);
	
    $row = mysqli_fetch_array($result);

	// echo "넘어오는 정보 확인 : ".$row['userid']." / ".$row['userpw']."<br/>";

	if($row['userid'] == $userid && $row['userpw'] == $userpw){

		session_start();
		$_SESSION['userid'] = $userid;

		// echo "<p style='text-align:center; color:blue;'>인증 완료되었습니다.</p>";
		echo "<meta http-equiv='Refresh' content='1; url=01_list.php'/>";

    }
	else{
		echo "<script>alert('아이디 또는 비밀번호가 일치하지 않습니다.'); history.go(-1);</script>";
	}
?>