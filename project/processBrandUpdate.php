<?php

	include("connect.php");
	
	$bid = $_REQUEST["prtxt"];
	$nam = $_REQUEST["btxt"];
	
	$qr="update brand set brand_name='".$nam."' where brand_id=".$bid;
	
	mysqli_query($cn,$qr);
	header("location:brandgrid.php?msg=Record updated from brand_id=".$bid);
	


?>