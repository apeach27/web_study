<?php

	header("content-type:text/html; charset=utf-8");

	$conn = mysqli_connect("localhost","root","root","local","10011");

	if($conn -> connect_error){
			echo $conn -> connect_errorno;
			exit;
	}

	$conn -> set_charset("utf8");

<<<<<<< HEAD
?>
=======
?>
>>>>>>> bc04e69a9e9c495155ce86693dce2b6f47db39ce
