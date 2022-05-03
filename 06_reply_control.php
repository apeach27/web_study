<?php
    include "00_conn.php";

	$replytitle = $_POST['replytitle'];
	$replyname = $_POST['replyname'];
	$replycontent = $_POST['replycontent'];

    echo "제목 : ".$replytitle." / 이름 : ".$replyname." / 내용 : ".$replycontent."<br/>";

	
	if( !empty($replytitle) && !empty($replyname) && !empty($replycontent) ){
         
    	$sql = "INSERT INTO reply
		(replytitle, replyname, replycontent)
		VALUES
		('$replytitle', '$replyname', '$replycontent' )";

		// 굳이 db값을 볼 필요가 없으니 $sql문도 echo 찍어보기 (meta tag 주석처리 후)
		// view 값 0 (양수 설정)

        $result = mysqli_query($conn, $sql);
	}
	
?>