<?php

	include("connect.php");
	
	$tid = $_REQUEST["prtxt"];
	$nam = $_REQUEST["typetxt"];
	
	$qr="update type set type_name='".$nam."' where type_id=".$tid;
	
	mysqli_query($cn,$qr);
	header("location:typegrid.php?msg=Record updated from type_id=".$tid);
	


?>