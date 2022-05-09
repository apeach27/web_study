<?php

	include "00_conn.php";

    session_cache_expire(30);
    session_start();

    $sql = "SELECT * FROM inboard ORDER BY pno DESC, wdate";
    $result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="ko">
 <head>
  <title><?php echo $_GET['id'] ?></title>
  <meta charset="utf-8"/>
  <style>
	*{margin:0; padding:0;}
	body{margin:0; padding:0; font:12px/1.2em "Malgun Gothic";}
	a:link, a:visited{text-decoration:none; color:#333;}
	a:hover, a:focus{text-decoration:underline; color:#6a028d;}

	#wrap{width:940px; margin:50px auto;}
	#wrap h3{padding-bottom:50px; font-size:20px; color:#6a028d; text-align:center; text-transform:uppercase;}

	#inboard{width:100%; line-height:22px; font-size:14px;}
	#inboard caption{display:none;}
	#inboard thead{font-size:12px;}
	#inboard th, #inboard td{padding:10px; border-bottom:1px solid #f1f1f1;}
	#inboard th{background-color:#f5f5f5; border-right:1px solid #fefefe;}
	#inboard td{color:#333; font-size:12px; text-align:center;}
	#inboard .writeClk td{border:none;}
	
	.writeClk{text-align:right;}
	.writeClk a{padding:5px 10px; border:1px solid #ccc; color:#333;}
	.writeClk a:hover, .writeClk a:focus{font-weight:700; background-color:#6a028d; color:#fff; text-decoration:none;}
  </style>
 </head>
 <body>
	<div id="wrap">
		<h3>FREE BOARD PRODUCE</h3>

		<div class="link">
			<span>*</span><a href="#none" title="home">HOME</a>

<? if(empty($_SESSION['userid'])){ ?>
			<span>*</span><a href="00_1_logout.php" title="login">LOGIN</a>

<?php }else{ ?>
			<strong style="color:red;"><?=$_SESSION['userid']?></strong>님 환영합니다.
			<span>*</span><a href="00_1_logout.php" title="logout">LOGOUT</a>
			
<?php } ?>

			<span>*</span><a href="00_join_form.php" title="join">JOIN</a>
		</div>

		<table id="inboard" title="게시판 제작">
			<caption>FREE BOARD PRODUCE</caption>
			<colgroup>
				<col width="5%"/>
				<col width="45%"/>
				<col width="5%"/>
				<col width="13%"/>
				<col width="15%"/>
				<col width="10%"/>
				<col width="5%"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">제목</th>
					<th scope="col">File</th>
					<th scope="col">작성자</th>
					<th scope="col">작성일</th>
					<th scope="col">조회수</th>
					<th scope="col">♣</th>
				</tr>
			</thead>
			<tbody>
<?php

    $num=0;
    // while($row = mysqli_query($conn, $sql) ){
	while($row = mysqli_fetch_array($result) ){

?>
                <tr>
                    <td><a href="03_read.php?no=<?=$row['no']?>" title="no"><?=$num+1?></a></td>
                    <td><a href="03_read.php?no=<?=$row['no']?>" title="title"><?=$row['title']?></a></td>
                    <td><a href="03_read.php?no=<?=$row['no']?>" title="file"><?=$row['myfiles']?>파일</a></td>
                    <td><?=$row['name']?></td>
                    <td><?=$row['wdate']?></td>
                    <td><?=$row['view']?></td>
					<td><a href="07_comment_write.php?no=<?=$row['no']?>" title="답글">답글</a></td>
                </tr>

<?php $num++; } ?>

				<tr class="writeClk">
					<td colspan="5">
                        <a href="01_list.php" title="HOME">HOME</a>
						<a href="02_write.php" title="글쓰기">글쓰기</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
 </body>
</html>
