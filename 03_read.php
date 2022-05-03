<?php
    include "00_conn.php";
    
    $no = $_GET['no'];
    // echo "넘겨온 번호 확인하기: ".$no." <br/>";
    
	$sql = "SELECT * FROM inboard WHERE no='$no' ";
	$result = mysqli_query($conn, $sql);

	$row = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>read</title>
    <style>
        *{margin:0; padding:0;}
	    body{margin:0; padding:0; font:12px/1.2em "Malgun Gothic";}
        #wrap{width:960px; margin:50px auto;}
	    #wrap h3{padding-bottom:25px; font-size:20px; color:#6a028d; text-align:center; text-transform:uppercase;}

        #container{width:100%; padding-bottom:50px;}
	    .contents{width:57rem; margin:0 auto;}
        .tit{border-bottom:1px solid #f1f1f1; text-align: center;}
        .tit h2{padding-bottom:5px; font-size:14px;}
        .tit p{padding-bottom:20px;}

        form{display: flex; flex-wrap: wrap; justify-content: center; font-size:13px; padding-top:50px;}
        form p{display: flex; padding:0 10px; margin-bottom:20px;}
        form label{width:4rem; text-align:center; height:30px;}
        form input:not(.button){width:10rem; text-indent:10px;}
        form textarea{width:45rem; height:400px; padding-left: 10px;}
        form label[for="content"]{line-height:400px;}

        form .btnArea{display: unset; margin: 0 auto;}

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
						<a href="05_delete.php?no=<?=$row['no']?>" title="삭제"><input class="button" type="button" value="삭제"/></a>	
					</p>
				</form>
			</div>
		</div>
<?php
    $upSql = "UPDATE inboard SET view=view+1 WHERE no='$no' ";
	
	mysqli_query($conn, $upSql);
	mysqli_close($conn);
?>
	</div>
</body>
</html>