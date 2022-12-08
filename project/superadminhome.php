<?php
        
			include("connect.php");
	
			if(!isset($_SESSION["uid"]))
			{
				header("location:admin.php?msg=Sorry your session expired");
			}
	
			        
        ?>
<!DOCTYPE html>
<html>
<head>
	<title>Super Admin Home</title>
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

	<?php include("adminnav.php"); ?>
	<br>
	<div style="text-align:center;">

		<?php

		echo'<h1 id="title" style="font-size:8vw;margin-top:1.5em;">Welcome Super Admin</h1>';

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