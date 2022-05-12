<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JOIN_MEMBER</title>
</head>
<script>

    function idChkBtn(){
        // alert();

        let userid = document.getElementById("userid");
        let idChkDesc = document.getElementById("idChkDesc");

        if(userid.value==""){
            alert("아이디 입력!!");
            userid.focus();

            idChkDesc.innerHTML="<strong style='color:red;'>아이디 필수 입력</strong>";

        } else{
            xmlhttp = new XMLHttpRequest(); 
			xmlhttp.open("GET","00_idDouble.php?q="+userid.value,true);

			xmlhttp.onreadystatechange = function(){
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200 ){
					idChkDesc.innerHTML = xmlhttp.responseText;
				}
			}

			xmlhttp.send();
		}

    }

</script>
<body>
    <form action="00_join_control.php" method="POST">
        <legend>회원가입</legend>
        <p>
			<label for="username">이름</label>
			<input id="username" type="text" name="username" required/>
		</p>
        <p>
			<label for="userid">아이디</label>
            <input type="userid" name="userid" id="userid" maxlength="10" placeholder="10자까지 입력" required />
			<span id="idChkDesc">※ 아이디 중복체크</span>
            <input id="idChk" type="button" value="중복체크" onclick="idChkBtn();"/>
        </p>
        <p>
			<label for="userpw">비밀번호</label>
			<input id="userpw" type="password" name="userpw" maxlength="8" placeholder="8자까지 입력 가능" required/>
		</p>
        <p id="button">
			<input type="submit" value="가입하기" title="가입하기"/>
			<input type="reset" value="다시쓰기" title="다시쓰기"/>
		</p>
    </form>
</body>
</html>
