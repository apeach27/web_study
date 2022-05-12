<?php
    header("content-type:text/html; charset=utf-8");

    session_start();
    session_unset();
    session_destroy();

    echo "<p>로그아웃 되었습니다.</p>";
    echo "<meta http-equiv='Refresh' content='1; url=01_board_basic.php' />"
    
<<<<<<< HEAD
?>
=======
?>
>>>>>>> bc04e69a9e9c495155ce86693dce2b6f47db39ce
