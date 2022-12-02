<?php

	include("connect.php");
	
	$uemail = $_REQUEST["idtxt"];
	$upass = $_REQUEST["ptxt"];
	
	$qr = "select * from userdetails where uemail='".$uemail."'and upass='".$upass."'";
	
	$res = mysqli_query($cn, $qr);
	
	if($row = mysqli_fetch_array($res))
	{
		
		$_SESSION["uid"] = $row[0];
		$_SESSION["uname"] = $row[1];
		$_SESSION["uemail"] = $row[2];
		header("location:userhomepg.php");
	}
	else
	{
		header("location:index.php?msg=Invalid user id/password");
	}

?>