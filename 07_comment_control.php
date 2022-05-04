<?php

    include "00_conn.php";

    $title = $_POST['title'];
	$name = $_POST['name'];
	$content = $_POST['content'];
	$pno = $_POST['pno'];

    echo "제목 : ".$title." / 이름 : ".$name." / 내용 : ".$content."<br/>";

    
	if( !empty($title) && !empty($name) && !empty($content) ){
         
    	echo $sql = "INSERT INTO inboard
		(pno, title, name, content)
		VALUES
		('$pno', '$title', '$name', '$content' )";

        $commentresult = mysqli_query($conn, $sql);
	}
    else{
		echo "<script>alert('빈칸을 모두 기입해주세요.');  history.go(-1);</script>";
	}

	mysqli_close($conn);

	// echo "<meta http-equiv='Refresh' content='2; url=01_list.php?no=$pno'/>";
?>