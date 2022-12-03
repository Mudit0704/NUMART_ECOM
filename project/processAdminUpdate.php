<?php

	include("connect.php");
	$admin_id = $_REQUEST["adminId"];
	$admin_name = $_REQUEST["ntxt"];
	$admin_email = $_REQUEST["itxt"];
	$admin_password = $_REQUEST["ptxt"];
	$admin_type = $_REQUEST["tptxt"];
	$nam = $_REQUEST["typetxt"];

	$p1 = "SET @p0='".$admin_id."'";
	$p2 = "SET @p1='".$admin_name."'";
	$p3 = "SET @p2='".$admin_email."'";
	$p4 = "SET @p3='".$admin_password."'";
	$p5 = "SET @p4='".$admin_type."'";

	mysqli_query($cn,$p1);
	mysqli_query($cn,$p2);
	mysqli_query($cn,$p3);
	mysqli_query($cn,$p4);
	mysqli_query($cn,$p5);
	
	mysqli_query($cn,"CALL updateAdmin (@p0,@p1,@p2,@p3,@p4)");
	header("location:admingrid.php?msg=Record updated");
?>