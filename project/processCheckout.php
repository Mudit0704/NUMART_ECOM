<?php

	include("connect.php");
	
	$cid = $_SESSION["cid"];
	$user_id = $_SESSION["uemail"];
	$addrty = $_REQUEST["st"];
	$paytype = $_REQUEST["p"];
	$totalamt = $_SESSION["totalamt"];
	$stats = 'Ordered';
	
	$p1 = "SET @p0='".$cid."'";
	$p2 = "SET @p1='".$user_id."'";
	$p3 = "SET @p2='".date("Y/m/d")."'";
	$p4 = "SET @p3='".$paytype."'";
	$p5 = "SET @p4='".$addrty."'";
	$p6 = "SET @p5='".$totalamt."'";
	$p7 = "SET @p6='".$stats."'";
	mysqli_query($cn,$p1);
	mysqli_query($cn,$p2);
	mysqli_query($cn,$p3);
	mysqli_query($cn,$p4);
	mysqli_query($cn,$p5);
	mysqli_query($cn,$p6);
	mysqli_query($cn,$p7);

	mysqli_query($cn, "CALL addOrder (@p0, @p1, @p2, @p3, @p4, @p5, @p6)");
	mysqli_next_result($cn);
	
	$p1 = "SET @p0='".$cid."'";
	mysqli_query($cn,$p1);
	$res2 = mysqli_query($cn,"CALL getDetailedCart(@p0)");
	mysqli_next_result($cn);

	$p1 = "SET @p0='".$cid."'";
	mysqli_query($cn,$p1);
	$res4 = mysqli_query($cn,"CALL getCartOrder (@p0)");
	$row4 = mysqli_fetch_array($res4);
	mysqli_next_result($cn);
	
	
	while($row2 = mysqli_fetch_array($res2))
	{
		$p1 = "SET @p0='".$row4[0]."'";
		$p2 = "SET @p1='".$row2[2]."'";
		$p3 = "SET @p2='".$row2[3]."'";
		$p4 = "SET @p3='".$row2[4]."'";
		$p5 = "SET @p4='".$stats."'";
		mysqli_query($cn,$p1);
		mysqli_query($cn,$p2);
		mysqli_query($cn,$p3);
		mysqli_query($cn,$p4);
		mysqli_query($cn,$p5);

		mysqli_query($cn,"CALL addOrderDetails (@p0, @p1, @p2, @p3, @p4)");
		mysqli_next_result($cn);
		
	}
	
	header("location:orderprev.php?cid=".$cid);
	

?>