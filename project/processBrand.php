<?php

	include("connect.php");
	
	$brand_name = $_REQUEST["btxt"];
	$p1 = "SET @p0='".$brand_name."'";
	
	mysqli_query($cn,$p1);
	
	mysqli_query($cn,"CALL addBrand (@p0)");
	
	header("location: brandgrid.php?msg=New brand Added Successfully!");	

?>