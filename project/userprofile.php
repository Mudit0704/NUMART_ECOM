<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
		
		function checkBlank(c1,msg)
		{
			x = c1.value;
			
			l = x.length;
			
			if(l==0)
			{
				alert(msg);
				c1.focus();
				return false;
			}
			return true;
		}
		
		function checkForm(frm)
		{
			with(frm)
			{
				if(!checkBlank(ntxt,"Name field can't be left blank"))
				{
					return false;
				}
				
				if(!checkBlank(idtxt,"Email field can't be left blank"))
				{
					return false;
				}
				
				if(!checkBlank(p1txt,"Password field can't be left blank"))
				{
					return false;
				}

				if(!checkBlank(adtxt,"Address field can't be left blank"))
				{
					return false;
				}
			}
		}
		
	</script>
	<title>Update Profile</title>
	<?php include 'head.php';
	?>
</head>
<body>
	<?php

    include("connect.php");

    if(!isset($_SESSION["uid"]))
    {
        header("location:index.php?msg=Sorry your session expired");
    }


    ?>
	<?php include("usernav.php"); ?>

	<?php
	include("connect.php");

	$uid = $_SESSION["uid"];
	$p1 = "SET @p0='".$uid."'";
	mysqli_query($cn,$p1);

	$res = mysqli_query($cn,"CALL getUserDetails (@p0)");

	$row = mysqli_fetch_array($res);

	?>

	<div class="container" style="margin: 0 auto;margin-top: 3em;max-width: 60%">
		<div class="jumbotron" style="background-color: #44a08d;">
			<form name="frm2" action="processUserprofile.php" method="post">
				<div class="form-row">
					<div class="col-md-6">
						<label for="validationServer01" style="color: white;">Name</label>
						<input type="text" class="form-control " id="validationServer01" placeholder="Name" name="ntxt" value="<?php echo $row[1] ?>" required>
					</div>
					<div class="col-md-6">
						<label for="validationServerUsername" style="color: white;">Email</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroupPrepend3">@</span>
							</div>
							<input type="email" class="form-control " readonly name="idtxt" value="<?php echo $row[2] ?>">
							<p id="test"></p>
						</div>
					</div>
				</div><br>
				<div class="form-row">
					<div class="col-md-8">
						<label for="validationServer05" style="color: white;">Password</label>
						<input type="text" class="form-control " name="p1txt" value="<?php echo $row[3] ?>" maxlength="255">
					</div>
					<div class="col-md-4">
						<label for="validationServer05" style="color: white;">Gender</label>
						<br>
						<div class="btn-group btn-group-toggle" data-toggle="buttons">
							<?php
							if($row[4]=="M")
							{
								?>

								<label class="btn btn-secondary active">
								<input type="radio" name="g" value="M" id="option1" autocomplete="off" checked> Male
								</label>
								<label class="btn btn-secondary">
								<input type="radio" name="g" value="F" id="option2" autocomplete="off"> Female
								</label>

								<?php
							}
							else if($row[4]=="F")
							{
								?>

								<label class="btn btn-secondary">
								<input type="radio" name="g" value="M" id="option1" autocomplete="off"> Male
								</label>
								<label class="btn btn-secondary active">
								<input type="radio" name="g" value="F" id="option2" autocomplete="off" checked> Female
								</label>

								<?php
							}
							else
							{
								?>
								<label class="btn btn-secondary">
								<input type="radio" name="g" value="M" id="option1" autocomplete="off"> Male
								</label>
								<label class="btn btn-secondary">
								<input type="radio" name="g" value="F" id="option2" autocomplete="off"> Female
								</label>

								<?php
							}
							?>
						</div>
					</div>
				</div> <br>
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="validationServerUsername" style="color: white;">Address</label>
						<textarea class="form-control" name="adtxt" rows="5" cols="50" placeholder="Enter Address" maxlength="5000"><?php echo $row[5] ?></textarea>
					</div>
				</div>
				<button class="btn btn-primary btn-outline-dark" type="submit" name="submit" value="Update" onClick="return checkForm(frm2)" style="width: 100%;">Update</button>
			</form>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>