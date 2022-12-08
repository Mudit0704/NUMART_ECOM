<?php

	include("connect.php");
	$oid = $_REQUEST["oid"];
	$st = $_REQUEST["st"];
	$p1 = "SET @p1='".$st."'";
	$p2 = "SET @p0='".$oid."'";
	
	mysqli_query($cn,$p2);
	mysqli_query($cn,$p1);

	mysqli_query($cn,"CALL updateOrderStatus (@p0, @p1)");
	
	header("location:admin_orderDetails.php?oid=".$oid."&msg=Order updated Successfully!");

?>