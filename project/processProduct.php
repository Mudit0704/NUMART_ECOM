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

	if(file_exists("uploads//".$fnm))
	{
		echo "Sorry file already exists";
	}
	else
	{
		$qr="insert into product values ('','".$pname."',".$bid.",".$tid.",'".$fnm."',".$price.",'".$dt."','".$isAvail."','".$addedby."')";
		mysqli_query($cn,$qr);
		move_uploaded_file($path,"uploads//".$fnm);
		header("location:productgrid.php?msg=Product Details uploaded Successfully!");
	}

?>