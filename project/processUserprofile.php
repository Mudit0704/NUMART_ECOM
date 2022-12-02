<?php

	include("connect.php");
	
	$uid = $_SESSION["uid"];
	$uname = $_REQUEST["ntxt"];
	$_SESSION["uname"] = $uname;
	$gen = $_REQUEST["g"];
	$addr = $_REQUEST["adtxt"];
	$pass = $_REQUEST["p1txt"];
	
	$qr="update userdetails set uname='".$uname."',gen='".$gen."',addr='".$addr."',upass='".$pass."'where uid=".$uid;
		mysqli_query($cn,$qr);
	
	header("location:userhomepg.php?msg=Details updated Successfully!");
	
	


?>