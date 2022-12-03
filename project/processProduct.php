<?php

	include("connect.php");
	
	$pname = $_REQUEST["ntxt"];
	$bid = $_REQUEST["btxt"];
	$tid = $_REQUEST["tytxt"];
	
	$fnm = $_FILES["f"]["name"];
	$type = $_FILES["f"]["type"];
	$sz = $_FILES["f"]["size"];
	$path = $_FILES["f"]["tmp_name"];
	
	$price = $_REQUEST["ptxt"];
	$dt = date("Y/m/d");
	$isAvail = $_REQUEST["a"];
	$addedby = $_REQUEST["atxt"];

	$p1 = "SET @p0='".$pname."'";
	$p2 = "SET @p1='".$bid."'";
	$p3 = "SET @p2='".$tid."'";
	$p4 = "SET @p3='".$fnm."'";
	$p5 = "SET @p4='".$price."'";
	$p6 = "SET @p5='".$dt."'";
	$p7 = "SET @p6='".$isAvail."'";
	$p8 = "SET @p7='".$addedby."'";
	
	mysqli_query($cn,$p1);
	mysqli_query($cn,$p2);
	mysqli_query($cn,$p3);
	mysqli_query($cn,$p4);
	mysqli_query($cn,$p5);
	mysqli_query($cn,$p6);
	mysqli_query($cn,$p7);
	mysqli_query($cn,$p8);

	if(file_exists("uploads//".$fnm))
	{
		header("location:productgrid.php?msg=Image file with same name already exists");
	}
	else
	{
		mysqli_query($cn,"CALL addProduct (@p0, @p1, @p2, @p3, @p4, @p5, @p6, @p7)");
		move_uploaded_file($path,"uploads//".$fnm);
		header("location:productgrid.php?msg=Product Details uploaded Successfully!");
	}

?>