<?php

    include "00_conn.php";

    $no = $_GET['no'];

    $title = $_POST['title'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $content = $_POST['content'];

    // echo "test: ".$title." / ".$name." / ".$email." / ".$pass." / ".$content."<br/>";

    $pwSql = "SELECT pass FROM inboard WHERE no='$no' ";
	$result = mysqli_query($conn, $pwSql);

	$row = mysqli_fetch_array($result);

    if($row['pass'] == $pass){
		$sql = "UPDATE inboard SET title='$title', name='$name', email='$email', content='$content', wdate=now() WHERE no='$no' ";

		$result = mysqli_query($conn, $sql);
		echo "<script>alert('수정이 완료되었습니다.');</script>";
	}
	else{
		echo "<script>alert('비밀번호를 확인해 주세요'); history.go(-1);</script>";
	}

	mysqli_close($conn);

	echo "<meta http-equiv='Refresh' content='5; url=01_list.php'/>";
?>