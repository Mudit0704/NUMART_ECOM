<?php

	include("connect.php");
	
	$uemail = $_REQUEST["idtxt"];
	$upass = $_REQUEST["ptxt"];
	$p1 = "SET @p0='".$uemail."'";
	$p2 = "SET @p1='".$upass."'";
	
	mysqli_query($cn,$p1);
	mysqli_query($cn,$p2);
	
	$res = mysqli_query($cn, "CALL checkUserCredentials (@p0, @p1)");
	
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