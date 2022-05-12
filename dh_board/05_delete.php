<?php

    include "00_conn.php";

    $no = $_GET['no'];

    // echo "넘어오는 번호 확인: ".$no." ";

    $sql = "SELECT * FROM inboard WHERE no='$no' ";
    $result = mysqli_query($conn, $sql);
    
    $row = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>write</title>
    <style>
        *{margin:0; padding:0;}
	    body{margin:0; padding:0; font:12px/1.2em "Malgun Gothic";}
        #wrap{width:960px; margin:50px auto;}
	    #wrap h3{padding-bottom:25px; font-size:20px; color:#6a028d; text-align:center; text-transform:uppercase;}

        #container{width:100%; padding-bottom:50px;}
	    .contents{width:960px; margin:0 auto;}
        .tit{border-bottom:1px solid #f1f1f1; text-align: center;}
        .tit h2{padding-bottom:5px; font-size:14px;}
        .tit p{padding-bottom:20px;}

        form{display: flex; flex-wrap: wrap; justify-content: center; font-size:13px; padding-top:50px;}
        form p{display: flex; padding:0 10px; margin-bottom:20px;}
        form label{width:5rem; text-align:center; height:30px;}
        form input:not(.button){width:19rem; text-indent:10px;}
        form label[for="content"]{line-height:400px;}

        form .btnArea{display: unset;}

    </style>
</head>
<body>
    <div id="wrap">
		<h3>FREE BOARD PRODUCE</h3>
		<div id="container">
			<div class="contents">
				<div class="tit">
					<h2>자유게시판</h2>
					<p>도현쓰 게시판입니다!</p>
				</div>
				<form action="05_delete_control.php?no=<?=$row['no']?>" method="POST">
					<p>
						<label for="pass">비밀번호</label>
						<input id="pass" type="password" value="<?=$row['pass']?>" name="pass" autocomplete="off" required/>
					</p>
					<p class="btnArea">
						<input class="button" type="submit" value="삭제" title="삭제"/>
						<input class="button" type="reset" value="다시쓰기" title="다시쓰기"/>
					</p>
				</form>
			</div>
		</div>
	</div>
</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> bc04e69a9e9c495155ce86693dce2b6f47db39ce
