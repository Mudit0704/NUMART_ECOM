<!DOCTYPE html>
<html>
<head>
	<title>View Product Details</title>
	<script type="text/javascript">
		
		function calAmt(c1,c2,c3)
		{
			p = c1.value;
			x = c2.value;
			y = c3.value;
			amt = x*y;
			window.location= "prodetails.php?amt="+amt+"&pid="+p+"&qty="+y;
		}

		function checkAvail(c1,msg)
		{
			x = c1.value;
			if(x == "N")
			{
				alert(msg);
				return false;
			}
			return true;
		}
		
		function checkForm(frm)
		{
			with(frm)
			{
				if(!checkAvail(atxt,"Product is out of stock!"))
				{
					return false;
				}
			}
		}
		
	</script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<?php include 'head.php';?>
</head>
<body>

	<?php

	include("connect.php");

	if(!isset($_SESSION["uid"]))
	{
		header("location:index.php?msg=Sorry your session expired");
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
					<a class="nav-link active" href="userprogrid.php">View Products<span class="sr-only">(current)</span></a>
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

	<?php
	include("connect.php");

	$msg="";

	$pid = $_REQUEST["pid"];

	$qr = "select * from product where pid=".$pid;

	$res = mysqli_query($cn, $qr);

	$row = mysqli_fetch_array($res);

	$br = "select image_nm,sub_id from subimg where pid=".$pid;

	$res1 = mysqli_query($cn, $br);

	$cr = "SELECT brand_name,type_name FROM product p1, brand b1, type t1 WHERE p1.bid=b1.brand_id and p1.tid=t1.type_id and p1.pid=".$pid;

	$res2 = mysqli_query($cn, $cr);

	$row2 = mysqli_fetch_array($res2);

	$amt = $_REQUEST["amt"];

	$qty = $_REQUEST["qty"];
	?>

	<div class="container" style="margin: 0 auto;margin-top: 2em;max-width: 60%">
		<div class="jumbotron" style="background-color: #44a08d;">
			<form name="frm1" method="post" action="processProdetails.php" enctype="multipart/form-data">
				<input type="hidden" name="prtxt" value="<?php echo $row[0] ?>"/>
				<div class="form-row">
					<div class="col-md-12">
						<img src="uploads/<?php echo $row[4] ?>" height="200" width="200"/> </br>
						<label for="validationServer01" style="color: white;">Availability</label>
						<input class="form-control " type="hidden" name="atxt" value="<?php echo $row[7] ?>" />
						<?php
						if($row[7]=="Y")
						{
							echo "In Stock";
						}
						else
						{
							echo "Out of Stock";
						}
						?>
					</div>
				</div><br>
				<div class="form-row">
					<div class="col-md-6">
						<label for="validationServer01" style="color: white;">Product Name</label>
						<input type="text" class="form-control " name="ntxt" value="<?php echo $row[1] ?>" readonly />
					</div>
					<div class="col-md-6">
						<label for="validationServer01" style="color: white;">Brand</label>
						<input type="text" class="form-control " name="btxt" value="<?php echo $row2[0] ?>" readonly />
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6">
						<label for="validationServer01" style="color: white;">Type</label>
						<input type="text" class="form-control " name="tytxt" value="<?php echo $row2[1] ?>" readonly />
					</div>
					<div class="col-md-6">
						<label for="validationServer01" style="color: white;">Price</label>
						<input type="text" class="form-control " name="ptxt" value="<?php echo $row[5] ?>" readonly />
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6">
						<label for="validationServer01" style="color: white;">Select Quantity</label>
						<?php
						if($row[7]=="Y") {
								?>	

									<input class="form-control" type="number" name="qtxt" min="1" max="5" onBlur="calAmt(prtxt,ptxt,this)" value="<?php echo $qty ?>" />	

									<?php
								} else { ?>
									<input class="form-control" type="number" name="qtxt" value="0" readonly />
							<?php	} ?>
					</div>
					<div class="col-md-6">
						<label for="validationServer01" style="color: white;">Sub amount</label>
						<input type="text" class="form-control " value="<?php echo $amt ?>" readonly />
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6">
						<label for="validationServer05" style="color: white;">Order Date</label>
						<input class="form-control " type="text" name="dtxt" id="dtxt"/ value="<?php echo date("Y/m/d") ?>" readonly>
					</div>
				</div> <br>
				<?php
						if($row[7]=="Y") {
								?>	

									<button class="btn btn-primary btn-outline-dark" type="submit" nvalue="Add To Cart" name="submit" onClick="return checkForm(frm1)" style="width: 100%;">Add To Cart</button>	

									<?php
								} else { ?>
									<button class="btn btn-primary btn-outline-dark" type="submit" nvalue="Add To Cart" name="submit" style="width: 100%;" disabled>Add To Cart</button>
							<?php	} ?>
				
			</form>
		</div>
	</div>
	<script>
		$( function() {
			$( "#dtxt" ).datepicker({
				dateFormat: "dd/mm/yy"

			});
		} );
	</script>



	<?php
	if(isset($_REQUEST["msg"])<>"")
	{
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
		'.$_REQUEST["msg"].'
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>';
		$_REQUEST["msg"] = "";
	}
	?>     



	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</body>
</html>