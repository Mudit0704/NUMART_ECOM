<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
		
		function check_id(c,c1)
		{
			y= c.value;
			x= c1.value;
			
			window.location= "usersignup.php?uid="+x+"&name="+y;
		}
		
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
	<title>SignUp</title>
	<?php include 'head.php';
	?>
</head>
<body>
	<?php
	include("connect.php");
	$msg="";
	$nm="";
	if($_REQUEST["uid"]<>"")
	{
		$uid = $_REQUEST["uid"];
		$nm = $_REQUEST["name"];
		
		$qr="SELECT count(*) FROM `userdetails` WHERE  uemail='".$uid."'";
		
		$res = mysqli_query($cn, $qr);
		
		$row=mysqli_fetch_array($res);
		
		if($row[0]>0)
		{
			$uid="";
			
			$msg="ID already exists!";	
		}
		
	}
	
	
	?>
	<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand" href="./index.php">NUMart</a>

		<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
			<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="./index.php">Login</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="#">Sign Up<span class="sr-only">(current)</span></a>
				</li>
			</ul>
		</div>
	</nav>


	<div class="container" style="margin: 0 auto;margin-top: 8em;max-width: 60%">
		<div class="jumbotron" style="background-color: #44a08d;">
			<form name="frm2" action="processUsersignup.php" method="post">
				<div class="form-row">
					<div class="col-md-6">
						<label for="validationServer01" style="color: white;">Name</label>
						<input type="text" class="form-control " id="validationServer01" placeholder="Name" name="ntxt" value="<?php echo $nm ?>" required>
					</div>
					<div class="col-md-6">
						<label for="validationServerUsername" style="color: white;">Email</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroupPrepend3">@</span>
							</div>
							<input type="email" name="idtxt"  class="form-control " id="email" placeholder="Email" aria-describedby="inputGroupPrepend3" required>
							<p id="test"></p>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6">
						<label for="validationServer05" style="color: white;">Password</label>
						<input type="Password" class="form-control " id="pass" name="p1txt" placeholder="Password" required>
					</div>
					<div class="col-md-6">
						<label for="validationServer05" style="color: white;">Gender</label>
						<br>
						<div class="btn-group btn-group-toggle" data-toggle="buttons">
							<label class="btn btn-secondary active">
								<input type="radio" name="g" value="M" id="option1" autocomplete="off"> Male
							</label>
							<label class="btn btn-secondary">
								<input type="radio" name="g" value="F" id="option2" autocomplete="off"> Female
							</label>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="validationServerUsername" style="color: white;">Address</label>
						<textarea class="form-control" id="exampleFormControlTextarea1" name="adtxt" rows="5" cols="50"></textarea>
					</div>
				</div>
				<button class="btn btn-primary btn-outline-dark" type="submit" name="submit" value="Sign Up" onClick="return checkForm(frm2)" style="width: 100%;">SignUp</button>
			</form>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>