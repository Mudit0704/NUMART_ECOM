<?php

	include("connect.php");
	
	$pid = $_REQUEST["prtxt"];
	$user_id = $_SESSION["uemail"];
	$qty = $_REQUEST["qtxt"];
	$price = $_REQUEST["ptxt"];
	$dt = $_REQUEST["dtxt"];
	
	$amt = $qty * $price;
	$flag="0";
	//echo $flag;
	
	$qr = "SELECT count(*) from cart where user_id='".$user_id."' and status='ongoing'";
	$res = mysqli_query($cn, $qr);
	$row = mysqli_fetch_array($res);
	
	if(($row[0]) == '1')
	{
			$cr = "SELECT c_id from cart where user_id='".$user_id."' and status='ongoing'";
			$res1 = mysqli_query($cn, $cr);
			$row1 = mysqli_fetch_array($res1);
			
			$sr = "insert into detail_cart values ('',".$row1[0].",".$pid.",".$qty.",".$amt.")";
			mysqli_query($cn, $sr);
			$flag="1";
			//break;
	}
	
	else
	{
		$cr = "insert into cart values ('','".$user_id."','".$dt."','ongoing')";
		mysqli_query($cn, $cr);
		
		$c1 = "select c_id from cart where user_id='".$user_id."' and status='ongoing'";
		$res = mysqli_query($cn, $c1);
		$cid = mysqli_fetch_array($res);
		
		$sr = "insert into detail_cart values ('',".$cid[0].",".$pid.",".$qty.",".$amt.")";
		mysqli_query($cn, $sr);
				
	}
	
	header("location:userviewcart.php");


?>