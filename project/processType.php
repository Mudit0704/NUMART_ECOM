<?php

	include("connect.php");
	
	$type_name = $_REQUEST["typetxt"];
	$p1 = "SET @p0='".$type_name."'";
	
	mysqli_query($cn,$p1);
	mysqli_query($cn,"CALL addType (@p0)");
	
	header("location: typegrid.php?msg= Type Added Successfully!");

?>