<?php
    include "00_conn.php";

	$replytitle = $_POST['replytitle'];
	$replyname = $_POST['replyname'];
	$replycontent = $_POST['replycontent'];
	$ino = $_POST['ino'];
	// rno ==> reply 자체증가 넘버
	// ino --> 해당 reply에 대한 비교 넘버

    echo "제목 : ".$replytitle." / 이름 : ".$replyname." / 내용 : ".$replycontent."<br/>";

	if( !empty($replytitle) && !empty($replyname) && !empty($replycontent) ){
         
    	echo $sql = "INSERT INTO reply
		(ino, replytitle, replyname, replycontent)
		VALUES
		('$ino', '$replytitle', '$replyname', '$replycontent' )";

        $result = mysqli_query($conn, $sql);
	}
	
	else{
		echo "<script>alert('빈칸을 모두 기입해주세요.');  history.go(-1);</script>";
	}

	mysqli_close($conn);

	echo "<meta http-equiv='Refresh' content='3; url=03_read.php?no=$ino'/>";

?>