<?php

	include("connect.php");
	
	$pid = $_REQUEST["prtxt"];
	$user_id = $_SESSION["uemail"];
	$qty = $_REQUEST["qtxt"];
	$price = $_REQUEST["ptxt"];
	$dt = date("Y/m/d");
	
	$amt = $qty * $price;
	$flag="0";

	$p1 = "SET @p0='".$user_id."'";
	mysqli_query($cn,$p1);
	$res = mysqli_query($cn, "CALL getOngoingUserCart (@p0)");
	$row = mysqli_fetch_array($res);
	mysqli_next_result($cn);
	
	if(mysqli_num_rows($res) > 0)
	{
			$p1 = "SET @p0='".$row[0]."'";
			$p2 = "SET @p1='".$pid."'";
			$p3 = "SET @p2='".$qty."'";
			$p4 = "SET @p3='".$amt."'";
			mysqli_query($cn,$p1);
			mysqli_query($cn,$p2);
			mysqli_query($cn,$p3);
			mysqli_query($cn,$p4);

			mysqli_query($cn, "CALL addToDetailCart(@p0, @p1, @p2, @p3)");
			mysqli_next_result($cn);
			$flag="1";
	}
	
	else
	{
		$p2 = "SET @p1='".$dt."'";
		mysqli_query($cn,$p1);
		mysqli_query($cn,$p2);
		mysqli_query($cn, "CALL addCart (@p0, @p1, 'ongoing')");
		mysqli_next_result($cn);

		$p1 = "SET @p0='".$user_id."'";
		mysqli_query($cn,$p1);
		$res2 = mysqli_query($cn, "CALL getOngoingUserCart (@p0)");
		$row = mysqli_fetch_array($res2);
		
		mysqli_next_result($cn);
		
		$p1 = "SET @p0='".$row[0]."'";
		$p2 = "SET @p1='".$pid."'";
		$p3 = "SET @p2='".$qty."'";
		$p4 = "SET @p3='".$amt."'";
		mysqli_query($cn,$p1);
		mysqli_query($cn,$p2);
		mysqli_query($cn,$p3);
		mysqli_query($cn,$p4);

		mysqli_query($cn, "CALL addToDetailCart(@p0, @p1, @p2, @p3)");
		mysqli_next_result($cn);
				
	}
	
	header("location:userviewcart.php");


?>