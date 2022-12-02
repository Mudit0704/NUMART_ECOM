<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<?php include 'head.php'; 
	session_start();?>
	<style>
		#title{
			font-family: 'Monoton', cursive;
			font-size:10rem;
			color: white;
		}
	</style>
	<link href="https://fonts.googleapis.com/css?family=Monoton&display=swap" rel="stylesheet">
</head>
<body>
	<?php

	include("connect.php");
	
	if(!isset($_SESSION["uid"]))
	{
		header("location:userlogin.php?msg=Sorry your session expired");
	}
	

	?>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand" href="./userhomepg.php">NUMart</a>

		<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
			<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="userprogrid.php">View Products<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="userprofile.php">View Profile<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="userviewcart.php">View Cart<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="orderhistory.php">View Orders<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="userlogout.php">Logout</a>
				</li>
			</ul>
		</div>
	</nav>
	<br>
	<div style="text-align:center;">

		<?php

		echo'<h1 id="title" style="font-size:8vw;margin-top:2em;">Welcome '.$_SESSION["uname"].'</h1>';

		?>


	</div>
	
	<?php

	if(isset($_REQUEST["msg"])<>"")
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
	'.$_REQUEST["msg"].'
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
	</button>
	</div>';
	$_REQUEST["msg"] = "";

	?>        



	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>