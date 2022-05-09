<!DOCTYPE html>
<html lang="ko">
 <head>
  <title>list</title>
  <meta charset="utf-8"/>
  <style>
	*{margin:0; padding:0;}
	body{margin:0; padding:0; font:12px/1.2em "Malgun Gothic";}
	a:link, a:visited{text-decoration:none; color:#333;}
	a:hover, a:focus{text-decoration:underline; color:#6a028d;}

	#wrap{width:940px; margin:50px auto;}
	#wrap h3{padding-bottom:25px; font-size:20px; color:#6a028d; text-align:center; text-transform:uppercase;}

	#inboard{width:100%; line-height:22px; font-size:14px;}
	#inboard caption{display:none;}
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
			<span>*</span><a href="01_board_basic.php" title="home">HOME</a>
			<span>*</span><a href="00_login.php" title="login">LOGIN</a>
			<span>*</span><a href="00_join_form.php" title="join">JOIN</a>
		</div>
		<table id="inboard" title="게시판 제작">
			<caption>FREE BOARD PRODUCE</caption>
			<colgroup>
				<col width="10%"/>
				<col width="52%"/>
				<col width="13%"/>
				<col width="15%"/>
				<col width="10%"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">제목</th>
					<th scope="col">작성자</th>
					<th scope="col">작성일</th>
					<th scope="col">조회수</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><a href="#" title="no">번호</a></td>
					<td><a href="#" title="title">제목</a></td>
					<td>작성자 출력</td>
					<td>작성일 출력</td>
					<td>조회수 출력</td>
				</tr>
				<tr class="writeClk">
					<td colspan="5">
						<a href="01_board_basic.php" title="HOME">HOME</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
 </body>
</html>
