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
	
	if($fnm<>"")
	{
		$qr="update product set pname='".$pname."',bid=".$bid.",tid=".$tid.",img='".$fnm."',price=".$price.",dt='".$dt."',isAvail='".$isAvail."',addedby='".$addedby."'where pid=".$pid;
		mysqli_query($cn,$qr);
		unlink("uploads//".$oftxt);
		move_uploaded_file($path,"uploads//".$fnm);
	}
	else
	{
		$qr="update product set pname='".$pname."',bid=".$bid.",tid=".$tid.",price=".$price.",dt='".$dt."',isAvail='".$isAvail."',addedby='".$addedby."'where pid=".$pid;
		mysqli_query($cn,$qr);
	}
	
	header("location:productgrid.php?msg=Product Details uploaded Successfully!");
	


?>