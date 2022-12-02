<?php

	include("connect.php");
	
	$cid = $_SESSION["cid"];
	$user_id = $_SESSION["uemail"];
	$addrty = $_REQUEST["st"];
	$paytype = $_REQUEST["p"];
	$totalamt = $_SESSION["totalamt"];
	$stats = 'Ordered';
	
	$qr = "select dt from cart where c_id=".$cid;
	$res = mysqli_query($cn,$qr);
	$row = mysqli_fetch_array($res);
	
	$qr1 = "insert into ordr values ('',".$cid.",'".$user_id."','".$row[0]."','".$paytype."','".$addrty."',".$totalamt.",'".$stats."')";
	mysqli_query($cn,$qr1);
	
	$qr2 = "select pid,qty,price from detail_cart where c_id=".$cid;
	$res2 = mysqli_query($cn,$qr2);
	
	$qr4 = "select o_id from ordr where c_id=".$cid;
	$res4 = mysqli_query($cn,$qr4);
	$row4 = mysqli_fetch_array($res4);
	
	
	while($row2 = mysqli_fetch_array($res2))
	{
		$qr3 = "insert into orderdetails values('',".$row4[0].",".$row2[0].",".$row2[1].",".$row2[2].",'".$stats."')";
		mysqli_query($cn,$qr3);
		
	}
	
	header("location:orderprev.php?cid=".$cid);
	

?>