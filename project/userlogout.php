<?php

	//include("connect.php");
	
	session_start();
	
	session_destroy();
	
	header("location:index.php?msg=You have logged out successfully!");


?>