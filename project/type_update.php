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
	<title>Update Product Type</title>
	<?php include 'head.php';
	?>
</head>
<body>
	
	
	<?php include("adminnav.php"); ?>
	<?php
	include("connect.php");
	
	$type_id = $_REQUEST["type_id"];
	$p1 = "SET @p0='".$type_id."'";
	
	mysqli_query($cn,$p1);
	
	$res = mysqli_query($cn,"CALL getTypeDetails (@p0)");
	
	$row = mysqli_fetch_array($res);
	
	?>

	<div class="container" style="margin: 0 auto;margin-top: 3em;max-width: 60%">
		<div class="jumbotron" style="background-color: #44a08d;">
			<form name="frm1" action="processTypeUpdate.php" method="post">
				<div class="form-row">
					<div class="col-md-12">
						<input type="hidden" name="prtxt" value="<?php echo $row[0] ?>"/>
						<label for="validationServer01" style="color: white;">Enter Product Type</label>
						<input type="text" class="form-control " id="validationServer01"  name="typetxt" value="<?php echo $row[1] ?>" required>
					</div>
				</div>
				<button class="btn btn-primary btn-outline-dark" type="submit" name="submit" value="Update" style="width: 100%;">Update</button>
			</form>
		</div>
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