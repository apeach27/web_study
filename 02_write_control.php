<?php

    include "00_conn.php";

    $title = $_POST['title'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$content = $_POST['content'];

    // echo "제목 : ".$title." / 이름 : ".$name." / 이메일 : ".$email." / 암호 : ".$pass." / 내용 : ".$content."<br/>";

	if( !empty($title) && !empty($name) && !empty($email) && !empty($pass) && !empty($content) ){
         
    	$sql = "INSERT INTO inboard
		(name, email, pass, title, content, wdate)
		VALUES
		('$name', '$email', '$pass', '$title', '$content', now())";

		// 굳이 db값을 볼 필요가 없으니 $sql문도 echo 찍어보기 (meta tag 주석처리 후)
		// view 값 0 (양수 설정)

        $result = mysqli_query($conn, $sql);
	}
	
	else{
		echo "<script>alert('필수 입력정보입니다.'); history.go(-1);</script>";
	}

	mysqli_close($conn);

	echo "<meta http-equiv='Refresh' content='2; url=01_list.php'/>";
?>