<?php

	include "00_conn.php";

	$no = $_GET['no'];

	echo "넘어오는 번호 확인: ".$no." ";

	$sql = "SELECT * FROM inboard WHERE no='$no' ";
	$result = MYSQLI_QUERY($conn, $sql);

	$row = MYSQLI_FETCH_ARRAY($result);

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
        form textarea{width:45rem; height:400px; padding-left: 10px;}
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
				<form action="04_modify_control.php?no=<?=$row['no']?>" method="POST">
					<p>
						<label for="title">제목</label>
						<input id="title" type="text" value="<?=$row['title']?>"  name="title" placeholder="제목을 입력해주세요" required/>
					</p>
					<p>
						<label for="name">이름</label>
						<input id="name" type="text" value="<?=$row['name']?>"  name="name" placeholder="이름을 입력해주세요" required/>
					</p>
					<p>
						<label for="email">이메일</label>
						<input id="email" type="email" value="<?=$row['email']?>"  name="email" placeholder="이메일을 입력해주세요" required/>
					</p>
					<p>
						<label for="pass">비밀번호</label>
						<input id="pass" type="password" value="<?=$row['pass']?>" name="pass" autocomplete="off" required/>
					</p>
					<p class="content">
						<label for="content">내용</label>
<textarea id="content" name="content">

    <?=$row['content']?>    

</textarea>
					</p>
					<p class="btnArea">
						<input class="button" type="submit" value="저장" title="저장"/>
						<input class="button" type="reset" value="다시쓰기" title="다시쓰기"/>
						<a href="01_list.php" title="목록"><input class="button" type="button" value="목록"/></a>
					</p>
				</form>
			</div>
		</div>
	</div>
</body>
</html>