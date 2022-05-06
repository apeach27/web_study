<?php
	
	include "00_conn.php";

	$q = $_REQUEST['q'];

	// echo $q;

	$sql = "SELECT * FROM members WHERE userid='$q' ";
	$result = mysqli_query($conn, $sql);

	$row = mysqli_fetch_array($result);
	
	$row['userid'] = isset($row['userid']) ? $row['userid'] : 'no';

	if($row['userid'] == $q ){
		echo "<strong style='color:red'>사용 불가능. 중복된 아이디입니다.</strong>";
	}
	else{
		echo "<strong style='color:blue'>사용 가능한 아이디입니다.</strong>";
	}
?>