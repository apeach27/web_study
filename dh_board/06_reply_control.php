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
         
    	$sql = "INSERT INTO reply
		(ino, replytitle, replyname, replycontent)
		VALUES
		('$ino', '$replytitle', '$replyname', '$replycontent' )";

		/* --------------------------------------- */
		// (02_write_control.php 참고)
		// 해당 댓글에 대한 대댓글을 작성해야 함
		
		// 원글에 대한 댓글 정렬 ==> (ex. inboard의 no == pno)
		// ㄴ$upSql = "UPDATE inboard SET pno='".$row['last_id']."' WHERE no='".$row['last_id']."' ";
		
		// 원글에 대한 댓글의 댓글 ==> (정렬에 대한 내용을 기준에 맞게 update 해줘야함)
		// ㄴ$upSql = "UPDATE relpy SET ino='".$row['last_id']."' WHERE rno='".$row['last_id']."' ";

        $result = mysqli_query($conn, $sql);
		$sql = 'SELECT last_insert_id() AS last_id';

		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

		$upSql = "UPDATE reply SET ino='".$row['last_id']."' WHERE no='".$row['last_id']."' ";
		$result = mysqli_query($conn, $upSql);
	
	}
	
	else{
		echo "<script>alert('빈칸을 모두 기입해주세요.');  history.go(-1);</script>";
	}

	mysqli_close($conn);

	echo "<meta http-equiv='Refresh' content='3; url=03_read.php?no=$ino'/>";

?>
