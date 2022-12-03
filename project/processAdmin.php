<?php

	include("connect.php");
	
	$admin_name = $_REQUEST["ntxt"];
	$uid = $_REQUEST["itxt"];
	$password = $_REQUEST["ptxt"];
	$type = $_REQUEST["tptxt"];

	$p2 = "SET @p1='".$admin_name."'";
	$p3 = "SET @p2='".$uid."'";
	$p4 = "SET @p3='".$password."'";
	$p5 = "SET @p4='".$type."'";

	mysqli_query($cn,$p2);
	mysqli_query($cn,$p3);
	mysqli_query($cn,$p4);
	mysqli_query($cn,$p5);
	
	mysqli_query($cn,"CALL addAdmin (@p1,@p2,@p3,@p4)");
	header("location: superadminhome.php ");

?>