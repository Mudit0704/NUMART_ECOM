<?php

	include("connect.php");
	$pid = $_REQUEST["prtxt"];
	$pname = $_REQUEST["ntxt"];
	$bid = $_REQUEST["btxt"];
	$tid = $_REQUEST["tytxt"];
	$oftxt = $_REQUEST["oftxt"];
	
	$fnm = $_FILES["f"]["name"];
	$type = $_FILES["f"]["type"];
	$sz = $_FILES["f"]["size"];
	$path = $_FILES["f"]["tmp_name"];
	
	$price = $_REQUEST["ptxt"];
	$dt = date("Y/m/d");
	$isAvail = $_REQUEST["g"];
	$addedby = $_REQUEST["atxt"];
	
	$p0 = "SET @p0='".$pid."'";
	$p1 = "SET @p1='".$pname."'";
	$p2 = "SET @p2='".$bid."'";
	$p3 = "SET @p3='".$tid."'";
	$p5 = "SET @p5='".$price."'";
	$p6 = "SET @p6='".$dt."'";
	$p7 = "SET @p7='".$isAvail."'";
	$p8 = "SET @p8='".$addedby."'";
	
	mysqli_query($cn,$p0);
	mysqli_query($cn,$p1);
	mysqli_query($cn,$p2);
	mysqli_query($cn,$p3);
	mysqli_query($cn,$p5);
	mysqli_query($cn,$p6);
	mysqli_query($cn,$p7);
	mysqli_query($cn,$p8);

	if($fnm<>"")
	{
		$p4 = "SET @p4='".$fnm."'";
		unlink("uploads//".$oftxt);
		move_uploaded_file($path,"uploads//".$fnm);
	}
	else
	{
		$p4 = "SET @p4='".$oftxt."'";
		
	}

	mysqli_query($cn,$p4);
	mysqli_query($cn,"CALL updateProduct (@p0, @p1, @p2, @p3, @p4, @p5, @p6, @p7, @p8)");
	
	header("location:productgrid.php?msg=Product Details uploaded Successfully!");
	


?>