<?php

	include("connect.php");
	
	$tid = $_REQUEST["prtxt"];
	$nam = $_REQUEST["typetxt"];

	$p1 = "SET @p0='".$tid."'";
	$p2 = "SET @p1='".$nam."'";
	
	mysqli_query($cn,$p1);
	mysqli_query($cn,$p2);
	
	mysqli_query($cn,"CALL updateType (@p0, @p1)");
	header("location:typegrid.php?msg=Record updated from type_id=".$tid);
	


?>