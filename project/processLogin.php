<?php

	include("connect.php");

	$uid = $_REQUEST["utxt"];
	$pass = $_REQUEST["ptxt"];
	
	$p1 = "SET @p0='".$uid."'";
	$p2 = "SET @p1='".$pass."'";
	
	mysqli_query($cn,$p1);
	mysqli_query($cn,$p2);
	$res = mysqli_query($cn,"CALL checkAdminCredentials (@p0,@p1)");
	
	if($row = mysqli_fetch_array($res))
	{
		$_SESSION["uid"] = $row[2];
		$_SESSION["type"] = $row[4];
		if($row[4]<>"SA")
		{
			header("location:adminhome.php");
		}
		else
		{
			header("location:superadminhome.php");
		}
	}
	else
	{
		header("location:admin.php?msg=Invalid user id/pass");
	}



?>
