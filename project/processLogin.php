<?php

	include("connect.php");

	$uid = $_REQUEST["utxt"];
	$pass = $_REQUEST["ptxt"];
	
	$qr = "select * from admin where uid='".$uid."' and password='".$pass."'";
	
	$res = mysqli_query($cn,$qr);
	
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
