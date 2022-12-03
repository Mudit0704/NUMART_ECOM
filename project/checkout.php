<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
	<?php include 'head.php';?>
	<script type="text/javascript">
		
		function printAdd(c1)
		{
			x = c1.value;
			window.location= "checkout.php?typ="+x;
		}
		
	</script>
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
	<br>

	<?php
	include("connect.php");
	$msg="";
	$typ="";

	if(isset($_REQUEST["msg"])<>"")
	{
		$msg = $_REQUEST["msg"];
	}

	$uid = $_SESSION["uemail"];
	$p1 = "SET @p0='".$uid."'";
	mysqli_query($cn,$p1);
	$res1 = mysqli_query($cn, "CALL getOngoingUserCart (@p0)");
	mysqli_next_result($cn);

	$typ = $_REQUEST["typ"];
	$p1 = "SET @p0='".$uid."'";
	$p2 = "SET @p1='".$typ."'";
	mysqli_query($cn,$p1);
	mysqli_query($cn,$p2);

	$res4 = mysqli_query($cn, "CALL getUserSpecificAddress (@p0, @p1)");
	mysqli_next_result($cn);
	$row4 = mysqli_fetch_array($res4);

	?>

	<center><h2 style="color: white;">FINAL ORDER</h2><br/></center>

	<div class="container table-responsive">
		<table class="table table-striped table-dark">
			<thead>
				<tr>
					<th>Cart ID</th>
					<th>Order Date</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php

				while($row1 = mysqli_fetch_array($res1))
				{		
					?>

					<tr>
						<td><?php echo $row1[0] ?></td>
						<td><?php echo $row1[2] ?></td>
						<td><?php echo $row1[3] ?></td>
					</tr>

					<?php
					$cid = $row1[0];
				}
				?>
			</tbody>
		</table>
	</div>	

	<?php

	$_SESSION["cid"] = $cid;
	$p1 = "SET @p0='".$cid."'";
	mysqli_query($cn,$p1);
	$res = mysqli_query($cn, "CALL getDetailedCart (@p0)");
	mysqli_next_result($cn);

	
	?>
	<div class="container table-responsive">
		<table class="table table-striped table-dark">
			<thead>
				<tr>
					<th>Product ID</th>
					<th>Product Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Sub Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$totalamt="";

				while($row = mysqli_fetch_array($res))
				{
					$pri = $row[4]/$row[3];
					$p1 = "SET @p0='".$row[2]."'";
					mysqli_query($cn,$p1);
					$res2 = mysqli_query($cn, "CALL getProduct (@p0)");
					mysqli_next_result($cn);
					$pronm = mysqli_fetch_array($res2);

					?>

					<tr>
						<td><?php echo $row[2] ?></td>
						<td><?php echo $pronm[1] ?></td>
						<td><?php echo $pri ?></td>
						<td><?php echo $row[3] ?></td>
						<td><?php echo $row[4] ?></td>
					</tr>

					<?php

					$totalamt = $totalamt + $row[4];
				}
				$p1 = "SET @p0='".$uid."'";
				mysqli_query($cn,$p1);
				$res3 = mysqli_query($cn, "CALL getUserSavedAddresses (@p0)");
				mysqli_next_result($cn);
				$_SESSION["totalamt"] = $totalamt;
				?>
			</tbody>
		</table>
	</div>

	<div class="container" style="margin: 0 auto;margin-top: 1em;max-width: 60%">
		<div class="jumbotron" style="background-color: #44a08d;">
			<form name="frm2" action="processCheckout.php" enctype="multipart/form-data">
				<div class="form-row">
					<div class="col-md-6">
						<label for="validationServer01" style="color: white;">Total Amount</label>
						<input type="text" class="form-control " id="validationServer01" placeholder="Name" name="ntxt" value="<?php echo $totalamt ?>" readonly>
					</div>
					<div class="col-md-5">
						<label style="color: white;">Select Saved Address</label>
						<select class="custom-select" name="st" onchange="printAdd(this)">
							<option value="-1">Select</option>
							<?php

							while($row3 = mysqli_fetch_array($res3))
							{
								if($typ==$row3[3])
								{

									?>	
									
									<option value="<?php echo $row3[3] ?>" selected ><?php echo $row3[3] ?></option>

									<?php

								}
								else
								{

									?>
									<option value="<?php echo $row3[3] ?>"><?php echo $row3[3] ?></option>

									<?php
								}
							}
							?>
						</select>
					</div>
					<div class="col-md-1">
						<label for="validationServer01" style="color: white;">Add</label>
						</select><a class ="btn form-control" href="useraddrs.php">+</a><br/><br/>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6">
						<label style="color: white;">Delivery Address</label>
						<input type="text" class="form-control " value="<?php echo $row4[0] ?>" readonly>
					</div>
					<div class="col-md-6">
						<label  style="color: white;">Payment Option</label>
						<br>
						<div class="btn-group btn-group-toggle" data-toggle="buttons">
							<label class="btn btn-secondary">
								<input type="radio" name="p" value="COD" id="option1" autocomplete="off"> COD
							</label>
							<label class="btn btn-secondary">
								<input type="radio" name="p" value="CARD" id="option2" autocomplete="off"> CARD
							</label>
						</div>
					</div>
				</div> <br>
				<button class="btn btn-primary btn-outline-dark" type="submit" value="Place Order" name="submit" style="width: 100%;">Place Order</button>
			</form>
		</div>
	</div>

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
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>