<?php

    include "00_conn.php";

    $title = $_POST['title'];
	$name = $_POST['name'];
	$content = $_POST['content'];
	$pno = $_POST['pno'];
	$grpno = $_POST['grpno'];
	$grplevel = $_POST['grplevel'];


    // echo "제목 : ".$title." / 이름 : ".$name." / 내용 : ".$content."<br/>";

    
	if( !empty($title) && !empty($name) && !empty($content) ){

		$upsql = "UPDATE inboard set grpno= grpno+1 where pno = $data[pno] and grpno > $data[grpno] ";
    	echo $updateresult = mysqli_query($conn, $upsql);
         
    	echo $sql = "INSERT INTO inboard
		(pno, grpno, grplevel, title, name, content)
		VALUES
		('$pno', '$grpno', '$grplevel', '$title', '$name', '$content' )";

    	echo $commentresult = mysqli_query($conn, $sql);
	}
    else{
		echo "<script>alert('빈칸을 모두 기입해주세요.');  history.go(-1);</script>";
	}

	mysqli_close($conn);

	echo "<meta http-equiv='Refresh' content='1; url=01_list.php?no=$pno'/>";
?>
