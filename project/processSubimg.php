<?php

	include("connect.php");
	
	$pid = $_REQUEST["pid"];
	
	$image_nm = $_FILES["fl"]["name"];
	$type = $_FILES["fl"]["type"];
	$sz = $_FILES["fl"]["size"];
	$path = $_FILES["fl"]["tmp_name"];
	
	$image_view = $_REQUEST["vtxt"];
	$addedby = $_REQUEST["atxt"];
	$dt = $_REQUEST["dtxt"];
	
	if(file_exists("sub_uploads//".$image_nm))
	{
		echo "Sorry file already exists";
	}
	else
	{
		$qr="insert into subimg values ('',".$pid.",'".$image_nm."','".$image_view."','".$addedby."','".$dt."')";
		mysql_query($qr,$cn);
		move_uploaded_file($path,"sub_uploads//".$image_nm);
		//header("location:productgrid.php?msg=Product Details uploaded Successfully!");
		echo "<br/>Register successful!";
	}

?>