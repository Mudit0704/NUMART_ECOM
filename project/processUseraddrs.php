<?php

	include("connect.php");
	
	$uemail = $_SESSION["uemail"];
	$uid = $_SESSION["uid"];

	$adrtype = $_REQUEST["adrtype"];
	$tm = $_REQUEST["tm"];
	$addr = $_REQUEST["adtxt"];

	$p1 = "SET @p0='".$uid."'";
	$p2 = "SET @p1='".$uemail."'";
	$p3 = "SET @p2='".$adrtype."'";
	$p4 = "SET @p3='".$tm."'";
	$p5 = "SET @p4='".$addr."'";
	mysqli_query($cn,$p1);
	mysqli_query($cn,$p2);
	mysqli_query($cn,$p3);
	mysqli_query($cn,$p4);
	mysqli_query($cn,$p5);

	mysqli_query($cn, "CALL addUserAddress (@p0, @p1, @p2, @p3, @p4)");
	header("location:checkout.php");	
?>