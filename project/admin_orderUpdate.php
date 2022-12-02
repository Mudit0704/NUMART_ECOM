<?php

	include("connect.php");
	$oid = $_REQUEST["oid"];
	$st = $_REQUEST["st"];
	
	$qr1="update orderdetails set st='".$st."' where o_id=".$oid;
	mysqli_query($cn,$qr1);

	$qr2="update ordr set st='".$st."' where o_id=".$oid;
	mysqli_query($cn,$qr2);
	
	$qr3="select o_id from orderdetails where o_id=".$oid;
	$res2 = mysqli_query($cn,$qr3);
	$row2 = mysqli_fetch_array($res2);
	
	header("location:admin_orderDetails.php?oid=".$row2[0]."&msg=Order updated Successfully!");

?>