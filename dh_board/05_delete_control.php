<?php

    include "00_conn.php";

    $no = $_GET['no'];
    $pass = $_POST['pass'];

	$sql = "SELECT * FROM inboard WHERE no='$no' ";
	$result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);

    if($row['pass'] == $pass){
		$delSql = "DELETE FROM inboard WHERE no='$no' ";
		mysqli_query($conn, $delSql);

		echo "<p style='text-align:center; color:blue;'>삭제되었습니다.</p>";
		echo "<meta http-equiv='Refresh' content='2; url=01_list.php'/>";
	}
	else{
		echo "<script>alert('비밀번호를 확인해 주세요'); history.go(-1);</script>";
	}

?>
