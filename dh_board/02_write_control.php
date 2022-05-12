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

		/* --------------------------------------- */
		// 1) 새로고침 시 NULL값이 발생
		//		원글 작성 시 inboard의 no와 pno를 같게 만들어 주는 과정은 배열 활용하면 유용

        $result = mysqli_query($conn, $sql);
		$sql = 'SELECT last_insert_id() AS last_id';
		// 2) 배열 이름을 간단한 last_id로 만들어줌
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		// print_r($last_id );

		$upSql = "UPDATE inboard SET pno='".$row['last_id']."' WHERE no='".$row['last_id']."' ";
        $result = mysqli_query($conn, $upSql);
		// 3) UPDATE) inboard의 pno를 no로 UPDATE 함.
		// 같은 테이블이므로 $result 네임 동일해도 괜찮음 

		/* --------------------------------------- */
		
		$upfile = Trim($_FILES['fileup']['name']);

		if(isset($_FILES['fileup']) && $_FILES['fileup']['name'] != "") {

			$file = $_FILES['fileup'];
			$upload_directory = 'data/';
			$ext_str = "hwp,xls,doc,xlsx,docx,pdf,jpg,gif,png,txt,ppt,pptx";
		
			$allowed_extensions = explode(',', $ext_str);
		
			$max_file_size = 5242880;
			$ext = substr($file['name'], strrpos($file['name'], '.') + 1);
		
			// 확장자 체크
			if(!in_array($ext, $allowed_extensions)) {
				echo "업로드할 수 없는 확장자 입니다.";
			}
	
			// 파일 크기 체크
			if($file['size'] >= $max_file_size) {
				echo "5MB 까지만 업로드 가능합니다.";
			}
	
			$path = md5(microtime()) . '.' . $ext;
	
			if(move_uploaded_file($file['tmp_name'], $upload_directory.$path)) {
		
				echo $query = "INSERT INTO fileup (fno, file_id, name_orig, name_save,reg_time) VALUES(?,?,?,?,now())";
		
				$file_id = md5(uniqid(rand(), true));
				$name_orig = $file['name']; 
				$name_save = $path;
		
				$stmt = mysqli_prepare($conn, $query);
				$bind = mysqli_stmt_bind_param( $stmt,'ssss', $row['last_id'], $file_id, $name_orig, $name_save);
				$exec = mysqli_stmt_execute($stmt);
		
				mysqli_stmt_close($stmt);
		
				echo"<h3>파일 업로드 성공</h3>";
				//echo "<meta http-equiv='Refresh' content='1; url=01_list.php'/>";
	
			}
	
		}

	}
	
	else{
		echo "<script>alert('필수 입력정보입니다.'); history.go(-1);</script>";
	}

	mysqli_close($conn);

	echo "<meta http-equiv='Refresh' content='2; url=01_list.php'/>";
?>
