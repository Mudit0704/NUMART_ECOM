<!DOCTYPE html>
<html>
<head>
	<title>Add Product</title>
	<?php include 'head.php';
	?>
</head>
<body>
	<?php

    include("connect.php");

    if(!isset($_SESSION["uid"]))
    {
        header("location:admin.php?msg=Sorry your session expired");
    }

    include("adminnav.php");
    ?>
	<?php
	include("connect.php");

	$msg="";

	$qr = "select * from type";

	$res = mysqli_query($cn,$qr);

	$br = "select * from brand";

	$res1 = mysqli_query($cn,$br);


	?>

	<div class="container" style="margin: 0 auto;margin-top: 3em;max-width: 60%">
		<div class="jumbotron" style="background-color: #44a08d;">
			<form name="frm1" action="processProduct.php" method="post" enctype="multipart/form-data">
				<div class="form-row">
					<div class="col-md-6">
						<label for="validationServer01" style="color: white;">Choose Product Image</label>
						<div class="input-group">
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="f" id="customFile">
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6">
						<label for="validationServer01" style="color: white;">Product Name</label>
						<input type="text" class="form-control " id="validationServer01"  name="ntxt" required>
					</div>
					<div class="col-md-6">
						<label for="validationServer01" style="color: white;">Type</label>
						<select class="custom-select" name="tytxt">
							<option value="-1">Select</option>
							<?php

							while($row3 = mysqli_fetch_array($res))
							{
								?>	

									<option value="<?php echo $row3[0] ?>"><?php echo $row3[1] ?></option>	

									<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6">
						<label for="validationServer01" style="color: white;">Brand</label>
						<select class="custom-select" name="btxt" >
							<option value="-1">Select</option>
							<?php

							while($row3 = mysqli_fetch_array($res1))
							{
								?>	

									<option value="<?php echo $row3[0] ?>"><?php echo $row3[1] ?></option>	

									<?php
							}
							?>
						</select>
					</div>
					<div class="col-md-6">
						<label for="validationServer01" style="color: white;">Price</label>
						<input type="text" class="form-control " id="validationServer01"  name="ptxt"  required>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6">
						<label for="validationServer05" style="color: white;">is Available</label>
						<br>
						<div class="btn-group btn-group-toggle" data-toggle="buttons">
							<label class="btn btn-secondary active">
								<input type="radio" name="a" value="Y" id="option1" autocomplete="off" checked> Yes
							</label>
							<label class="btn btn-secondary">
								<input type="radio" name="a" value="N" id="option2" autocomplete="off"> No
							</label>
						</div>
					</div>
					<div class="col-md-6">
						<label for="validationServer01" style="color: white;">Added By</label>
						<input type="text" class="form-control " id="validationServer01"  name="atxt" required>
					</div>
				</div><br>
				<button class="btn btn-primary btn-outline-dark" type="submit" name="submit" value="Add" style="width: 100%;">Add</button>
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
	<script>
		$(".custom-file-input").on("change", function() {
			var fileName = $(this).val().split("\\").pop();
			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	</script>
</body>
</html>