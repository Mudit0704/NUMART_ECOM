<?php

	include("connect.php");
	$admin_id = $_REQUEST["adminId"];
	$admin_name = $_REQUEST["ntxt"];
	$admin_email = $_REQUEST["itxt"];
	$admin_password = $_REQUEST["ptxt"];
	$admin_type = $_REQUEST["tptxt"];
	$nam = $_REQUEST["typetxt"];
	
	$qr="update admin set admin_name='".$admin_name."', uid='".$admin_email."', password='".$admin_password."', type='".$admin_type."' where admin_id=".$admin_id;
	
	mysqli_query($cn,$qr);
	header("location:admingrid.php?msg=Record updated");
?>