<?php

	include("connect.php");
	
	$sid = $_REQUEST["subid"];
	$pid = $_REQUEST["pid"];
	$oftxt = $_REQUEST["oftxt"];
	
	$fnm = $_FILES["fl"]["name"];
	$type = $_FILES["fl"]["type"];
	$sz = $_FILES["fl"]["size"];
	$path = $_FILES["fl"]["tmp_name"];
	
	$image_view = $_REQUEST["vtxt"];
	$dt = $_REQUEST["dtxt"];
	$addedby = $_REQUEST["atxt"];

	/*if(file_exists("sub_uploads//".$fnm))
	{
		echo "Sorry file already exists";
	}*/
	if($fnm<>"")
	{
		$qr="update subimg set pid=".$pid.",image_nm='".$fnm."',image_view='".$image_view."',addedby='".$addedby."',dt='".$dt."'where sub_id=".$sid;
		mysql_query($qr,$cn);
		unlink("sub_uploads//".$oftxt);
		move_uploaded_file($path,"sub_uploads//".$fnm);
		//header("location:productgrid.php?msg=Product Details uploaded Successfully!");
	}
	else
	{
		$qr="update subimg set pid=".$pid.",image_view='".$image_view."',addedby='".$addedby."',dt='".$dt."'where sub_id=".$sid;
		mysql_query($qr,$cn);
		//move_uploaded_file($path,"sub_uploads//".$image_nm);
		//header("location:productgrid.php?msg=Product Details uploaded Successfully!");
	}
	
	header("location:product_update.php?pid=".$pid);

?>