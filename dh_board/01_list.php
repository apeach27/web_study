<?php

	include "00_conn.php";

    session_cache_expire(30);
    session_start();

	// ------------- 페이징 START
	$per_page = 5;

	$page = (empty($_GET['page']))? 1 : $_GET['page'];
	// == if문
	// page 페이지

		// ------------- 검색 start
	$category = isset($_GET['cate'])? $_GET['cate'] : 'title';
	$search = isset($_GET['search'])? $_GET['search'] : '';

	$offset = ($page-1) * $per_page;
	// 시작페이지 1 --> 0페이지 부터 시작 (-1)

	$where = '';
	if( $search ){
		$where = ' WHERE '.$category.  ' LIKE "%'.$search.'%"';
	}

    $query = "SELECT count(*) AS cnt FROM inboard " . $where;
	$total_result = mysqli_query($conn, $query);
	$total = mysqli_fetch_array($total_result,MYSQLI_ASSOC);

    $total_page = ceil($total['cnt']/$per_page);
	// 전체 덩어리(블럭) = 전체 페이지 / 덩어리 당 페이지
	// ceil : 올림

    $sql = "SELECT * FROM inboard ".$where." ORDER BY pno DESC, wdate LIMIT $offset, $per_page";
	// LIMIT : 몇 번부터, 몇 번
	// ex) 게시글 15개 : 0~5 / 5~10 / 10~15

    $result = mysqli_query($conn, $sql);

	// ------------- 테이블 넘버링 START
	$num = $total['cnt'] - ( ($page-1) * $per_page );
	// 페이지 넘길때 마다 +1

	$list = $per_page;
	$block_cnt = $list;

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
	#inboard .page{padding: 0;}
	#inboard th{background-color:#f5f5f5; border-right:1px solid #fefefe;}
	#inboard td{color:#333; font-size:12px; text-align:center;}
	#inboard .writeClk td{border:none;}
	
	.writeClk{text-align:right;}
	.writeClk a{padding:5px 10px; border:1px solid #ccc; color:#333;}
	.writeClk a:hover, .writeClk a:focus{font-weight:700; background-color:#6a028d; color:#fff; text-decoration:none;}

	.page{padding-top: 30px; text-align: center;}
	.page a{display: inline-block; width: 40px;}


  </style>
 </head>
 <body>
	<div id="wrap">
		<h3>FREE BOARD PRODUCE</h3>

		<div class="link">
			<span>*</span><a href="#none" title="home">HOME</a>

<? if(empty($_SESSION['userid'])){ ?>
			<span>*</span><a href="00_login.php" title="login">LOGIN</a>

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

    // $num=0;
    // while($row = mysqli_query($conn, $sql) ){
	$kk = 0;
	while($row = mysqli_fetch_array($result) ){

?>
                <tr>
                    <td>
						<a href="03_read.php?no=<?=$row['no']?>" title="no"><?=$num?></a>
					</td>
                    <td>
						<a href="03_read.php?no=<?=$row['no']?>" title="title"><?=$row['title']?></a>
					</td>
                    <td><a href="03_read.php?no=<?=$row['no']?>" title="file"><?=$row['myfiles']?>파일</a></td>
                    <td><?=$row['name']?></td>
                    <td><?=$row['wdate']?></td>
                    <td><?=$row['view']?></td>
					<td><a href="07_comment_write.php?no=<?=$row['no']?>" title="답글">답글</a></td>
                </tr>
<?php $num--;
	$kk++;
} // endwhile
if( $kk==0){ ?>
	<tr>
		<td colspan="7">글없음</td>
	</tr>
<?php
} 
?>
				<tr>
					<td></td>
				</tr>

				<tr class="writeClk">
					<td colspan="7">
                        <a href="01_list.php" title="HOME">HOME</a>
<?php if(!empty($_SESSION['userid'])){ ?>
						<a href="02_write.php" title="글쓰기">글쓰기</a>
<?php }?>
					</td>
				</tr>
			</tbody>
		</table>

<!-- 검색 -->
		<div class="searchBox">	
			<form action="<?=$_SERVER[ "PHP_SELF" ]?>" method="get">
				<select name="cate">
					<option value="title">제 목</option>
					<option value="name">작성자</option>
					<option value="content">내 용</option>
				</select>
				<input type="text" name="search" id="search" style="text-indent: 5px;" /> <button class="btn">검색</button>
			</form>
		</div>

<!-- 페이지 구분하기 -->
		<div class="page">
			<p>
	<!-- 이전 -->
<?php
	if($page <= 1){
?>
				<a href="01_list.php?page=1">처음</a>
<?php } else{ ?>
				<a href="01_list.php?page=<?php echo ($page-1) ?>">이전</a>
<?php }?>

	<!-- 페이지번호 출력 -->
<?php
	for($print_page = 1; $print_page <= $total_page; $print_page++){
		// 페이지는 1부터 시작, 마지막 페이지는 전체 페이지까지 출력~

		if($page == $print_page){
			echo "<b><a>$print_page</a></b>";
		}else{
			echo '<a href="01_list.php?page='.$print_page.'&search='.$search.'">'.$print_page.'</a>';
		}
		// 현재 페이지 굵게
?>
<?php }



?>

	<!-- 다음 -->
<?php
	if($page >= $total_page){
?>
				<a href="01_list.php?page=<?php echo $total_page ?>">마지막</a>
<?php } else{ ?>
				<a href="01_list.php?page=<?php echo ($page+1) ?>">다음</a>
<?php } ?>
			</p>
		</div>
	</div>
 </body>
</html>
