<?php

	include("connect.php");
	
	$type_name = $_REQUEST["typetxt"];

	
	$qr = "insert into type values ('','".$type_name."')";
	
	mysqli_query($cn,$qr);
	
	header("location: typegrid.php?msg= Type Added Successfully!");

?>