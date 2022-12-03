<?php

	include("connect.php");
	
	$uid = $_SESSION["uid"];
	$uname = $_REQUEST["ntxt"];
	$_SESSION["uname"] = $uname;
	$gen = $_REQUEST["g"];
	$addr = $_REQUEST["adtxt"];
	$pass = $_REQUEST["p1txt"];

	$p1 = "SET @p0='".$uid."'";
	$p2 = "SET @p1='".$uname."'";
	$p3 = "SET @p2='".$gen."'";
	$p4 = "SET @p3='".$addr."'";
	$p5 = "SET @p4='".$pass."'";
	mysqli_query($cn,$p1);
	mysqli_query($cn,$p2);
	mysqli_query($cn,$p3);
	mysqli_query($cn,$p4);
	mysqli_query($cn,$p5);
	
	mysqli_query($cn,"CALL updateUserDetails (@p0, @p1, @p2, @p3, @p4)");
	
	header("location:userhomepg.php?msg=Details updated Successfully!");
	
	


?>