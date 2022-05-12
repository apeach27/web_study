<?php
    include "00_conn.php";
    
    $no = $_GET['no'];
    // echo "넘겨온 번호 확인하기: ".$no." <br/>";
    
	$sql = "SELECT * FROM inboard WHERE no='$no' ";
	
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);

	/* ----------------- 댓글 ---------------- */

	session_cache_expire(30);
    session_start();
	
	$sql = "SELECT * FROM inboard WHERE pno='$no' ";
	
	$commentresult = mysqli_query($conn, $sql);

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
	    .contents{width:57rem; margin:0 auto;}
        .content{padding:0 20px;}
        .tit{border-bottom:1px solid #f1f1f1; text-align: center;}
        .tit h2{padding-bottom:5px; font-size:14px;}
        .tit p{padding-bottom:20px;}

        form{display: flex; flex-wrap: wrap; justify-content: center; font-size:13px; padding-top:50px;}
        form p{display: flex; margin-bottom:20px;}
        form label{width:3rem; text-align:center; height:30px; font-size:12px;}
        form input:not(.button){width:8rem; text-indent:10px; font-size:12px;}
        form textarea{width:45rem; height:400px; padding-left: 10px;}
        form label[for="content"]{line-height:400px;}
        form .btnArea{display: unset; margin: 0 auto;}

		#inboard{display: none; position: relative;}
		#inboard textarea{height: 100px;}
		#inboard .btnArea{position: absolute; right:0; bottom:0;}
		#inboard .btnArea .button{padding:5px 25px;}

		.commentBox{width:100%; border:2px dashed #ccc; padding: 10px; margin-top: 20px; text-align: center;}
		.commentBox .comment_list{text-align:left;}
		.commentBox .comment_list p {padding:10px 0; border-bottom: 1px solid #eee;}
		.commentBox .btnArea{display: block; text-align: right;}


    </style>
	<script type="text/javascript">

		let display = true;

		function reDisplay(){
			let borad = document.getElementById("inboard");
			if(borad.style.display=='block'){
				borad.style.display = 'none';
			}else{
				borad.style.display = 'block';
			}
		}
	</script>
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

<!-- board Area -->
				<form action="#" method="POST">
					<p>
						<label for="title">제목</label>
						<input id="title" type="text" value="<?=$row['title']?>" readonly/>
					</p>
					<p>
						<label for="name">이름</label>
						<input id="name" type="text" value="<?=$row['name']?>" readonly/>
					</p>
					<p>
						<label for="email">이메일</label>
						<input id="email" type="email" value="<?=$row['email']?>" readonly/>
					</p>
					<p>
						<label for="view">조회</label>
						<input id="view" type="text" value="<?=$row['view']?>" readonly/>
					</p>
					<p>
						<label for="wdate">날짜</label>
						<input id="wdate" type="text" value="<?=$row['wdate']?>" readonly/>
					</p>
					<p class="content">
						<label for="main">내용</label>
<textarea id="content" name="content" readonly>

    <?=$row['content']?>

</textarea>
					</p>
					<p class="btnArea">
                        <a href="01_list.php" title="목록"><input class="button" type="button" value="목록"/></a>
						<a href="04_modify.php?no=<?=$row['no']?>" title="수정"><input class="button" type="button" value="수정"/></a>
						<a href="javascript:reDisplay();" title="답글"><input class="button" type="button" value="답글"/></a>
						<a href="05_delete.php?no=<?=$row['no']?>" title="삭제"><input class="button" type="button" value="삭제"/></a>	
					</p>
				</form>

<!-- comment Area -->
<!-- comment Area (write) -->
				<form id="inboard" action="07_comment_control.php" method="POST">
					<input id="pno" type="hidden" name="pno" value="<?=$row['pno']?>"/>
					<!-- 답글 -->
					<p>
						<label for="title">제목</label>
						<input id="title" type="text" name="title" required/>
					</p>
					<p>
						<label for="name">이름</label>
						<input id="name" type="text" name="name" required/>
					</p>
					<p class="content">
						<label for="content">내용</label>
<textarea id="content" name="content" required>

</textarea>
					</p>
					<p class="btnArea">
						<!-- <a href="04_modify.php?no=<?=$row['no']?>" title="등록"><input class="button" type="button" value="등록"/></a> -->
						<input class="button" type="submit" value="등록" title="등록"/>	
					</p>
				</form>
								
<!-- comment Area (read) -->
				<div class="commentBox">
					<h4><strong>[ COMMENT ]</strong></h4>
					<div class="comment_list">
						
<?php

	$num=0;
	while($row = mysqli_fetch_array($commentresult) ){

?>
						<p>
							<strong><?=$row['title']?></strong>
							<span><?=$row['name']?></span><br/>
							<span><?=$row['content']?></span>
							<span class="btnArea">
								<input class="button" type="reset" value="수정" title="수정" />
								<input class="button" type="submit" value="삭제" title="삭제" />
							</span>
						</p>
<?php $num++; } ?>
					</div>
				</div>
			</div>
		</div>
<?php
    $sql = "UPDATE inboard SET view=view+1 WHERE no='$no' ";
	
	mysqli_query($conn, $sql);
	mysqli_close($conn);
?>
	</div>

			</div>
		</div>
	</div>
</body>
</html>
