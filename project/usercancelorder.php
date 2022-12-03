<?php

	include("connect.php");
	$oid = $_REQUEST["oid"];
	$st = "Cancelled";
	$p1 = "SET @p0='".$oid."'";
    mysqli_query($cn,$p1);

	mysqli_query($cn, "CALL cancelOrder (@p0)");
	mysqli_next_result($cn);
	
	$p1 = "SET @p0='".$oid."'";
    mysqli_query($cn,$p1);
	$res2 = mysqli_query($cn, "CALL getOrderDetails (@p0)");
	mysqli_next_result($cn);
	$row2 = mysqli_fetch_array($res2);
	
	header("location:vieworderdetails.php?oid=".$row2[1]."&msg=Order cancelled Successfully!");

?>