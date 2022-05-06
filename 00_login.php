<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login</title>
</head>
<body>
    <h2>LOGIN</h2>
    <div class="link">
        <span>*</span><a href="#none" title="home">HOME</a>
		<span>*</span><a href="#none" title="login">LOGIN</a>
		<span>*</span><a href="00_join_form.php" title="join">JOIN</a>
    </div>
    
    <form action="00_login_control.php" method="POST">
        <legend>회원로그인</legend>
        <p>
            <label for="userid">아이디</label>
            <input type="text" name="userid" id="userid" />
        </p>
        <p>
            <label for="userpw">비밀번호</label>
            <input type="text" name="userpw" id="userpw" />
        </p>
        <p class="button">
            <input type="submit" value="로그인" title="로그인" />
        </p>
    </form>
</body>
</html>