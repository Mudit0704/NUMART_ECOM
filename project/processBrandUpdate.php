<?php

	include("connect.php");
	
	$bid = $_REQUEST["prtxt"];
	$nam = $_REQUEST["btxt"];

	$p1 = "SET @p0='".$bid."'";
	$p2 = "SET @p1='".$nam."'";
	
	mysqli_query($cn,$p1);
	mysqli_query($cn,$p2);
	
	mysqli_query($cn,"CALL updateBrand (@p0, @p1)");
	header("location:brandgrid.php?msg=Record updated from brand_id=".$bid);
	


?>