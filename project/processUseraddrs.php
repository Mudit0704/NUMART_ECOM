<?php

	include("connect.php");
	
	$uemail = $_SESSION["uemail"];
	$uid = $_SESSION["uid"];

	$adrtype = $_REQUEST["adrtype"];
	$tm = $_REQUEST["tm"];
	$addr = $_REQUEST["adtxt"];
	
	$qr = "insert into useradr values ('',".$uid.",'".$uemail."','".$adrtype."','".$tm."','".$addr."')";
	
	mysqli_query($cn,$qr);
	header("location:checkout.php");	
?>