<?php

	include("connect.php");
	
	$admin_name = $_REQUEST["ntxt"];
	$uid = $_REQUEST["itxt"];
	$password = $_REQUEST["ptxt"];
	$type = $_REQUEST["tptxt"];

	
	$qr = "insert into admin values ('','".$admin_name."','".$uid."','".$password."','".$type."')";
	
	mysqli_query($cn,$qr);
	header("location: superadminhome.php ");

?>