<?php

	include("connect.php");
	
	$brand_name = $_REQUEST["btxt"];

	
	$qr = "insert into brand values ('','".$brand_name."')";
	
	mysqli_query($cn,$qr);
	
	header("location: brandgrid.php?msg=New brand Added Successfully!");	

?>