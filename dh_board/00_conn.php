<?php

	header("content-type:text/html; charset=utf-8");

	$conn = mysqli_connect("localhost","root","root","local","10011");

	if($conn -> connect_error){
			echo $conn -> connect_errorno;
			exit;
	}

	$conn -> set_charset("utf8");

?>
