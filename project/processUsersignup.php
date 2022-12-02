<?php

	include("connect.php");
	
	$uname = $_REQUEST["ntxt"];
	$uemail = $_REQUEST["idtxt"];
	$upass = $_REQUEST["p1txt"];
	$ucpass = $_REQUEST["p2txt"];
	$gen = $_REQUEST["g"];
	$addr = $_REQUEST["adtxt"];
	
	$fnm = $_FILES["f"]["name"];
	$type = $_FILES["f"]["type"];
	$sz = $_FILES["f"]["size"];
	$path = $_FILES["f"]["tmp_name"];
	
	if(isset($fnm)<>"")
	{
		$qr="insert into userdetails values ('','".$uname."','".$uemail."','".$upass."','".$gen."','".$addr."','".$fnm."')";
		mysqli_query($cn, $qr);
		move_uploaded_file($path,"user_uploads//".$fnm);
	}
	else
	{
		$qr="insert into userdetails values ('','".$uname."','".$uemail."','".$upass."','".$gen."','".$addr."','')";
		mysqli_query($cn, $qr);
		//echo $uname.$uemail.$upass.$add.$gen;
	}
	header("location:userlogin.php?msg=User signed up successfully! Please Login to continue.");

?>