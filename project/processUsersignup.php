<?php

include("connect.php");

$uname = $_REQUEST["ntxt"];
$uemail = $_REQUEST["idtxt"];
$upass = $_REQUEST["p1txt"];
$gen = $_REQUEST["g"];
$addr = $_REQUEST["adtxt"];

$p11 = "SET @p0='".$uemail."'";

mysqli_query($cn,$p11);
$res = mysqli_query($cn, "SELECT checkUserWithEmailExists (@p0)");
$row=mysqli_fetch_array($res);
mysqli_next_result($cn);

if ($row[0] > 0) {
	header("location:usersignup.php?msg=User with given email id already exists. Please use different email id or login using the email id.");
} else {
	$p1 = "SET @p0='".$uname."'";
	$p2 = "SET @p1='".$uemail."'";
	$p3 = "SET @p2='".$upass."'";
	$p4 = "SET @p3='".$gen."'";
	$p5 = "SET @p4='".$addr."'";
	
	mysqli_query($cn,$p1);
	mysqli_query($cn,$p2);
	mysqli_query($cn,$p3);
	mysqli_query($cn,$p4);
	mysqli_query($cn,$p5);



	mysqli_query($cn, "CALL addUser (@p0, @p1, @p2, @p3, @p4)");
	header("location:index.php?msg=User signed up successfully! Please Login to continue.");
}


?>