<?php

	include("connect.php");

	if(!isset($_SESSION["uid"]))
	{
		header("location:index.php?msg=Sorry your session expired");
	}


	?>
<!DOCTYPE html>
<html>
<head>
	<title>View Cart</title>
	<?php include 'head.php';?>
	<script type="text/javascript" >
		function del(id)
		{
			if(confirm("Do you want to delete "+id+" data?"))
			{
				window.location="userviewcart.php?del_id="+id;
			}
		}
	</script>
</head>
<body>
	<?php include("usernav.php"); ?>
	<br>

	<?php
	include("connect.php");

	$msg="";
	if($_REQUEST["del_id"]<>"")
	{
		$did = $_REQUEST["del_id"];
		$p1 = "SET @p0='".$did."'";
		mysqli_query($cn,$p1);
		mysqli_query($cn, "CALL deleteFromDetailedCart (@p0)");
		mysqli_next_result($cn);
		$msg = "Data deleted with dc_id ".$did;
	}

	if(isset($_REQUEST["msg"])<>"")
	{
		$msg = $_REQUEST["msg"];
	}

	$uid = $_SESSION["uemail"];
	$p1 = "SET @p0='".$uid."'";
	mysqli_query($cn,$p1);
	$res1 = mysqli_query($cn, "CALL getOngoingUserCart (@p0)");
	mysqli_next_result($cn);

	if(mysqli_num_rows($res1) > 0)
	{
		
		?>
		<center><h2 style="color: white;">CART</h2><br/></center>
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
		$p1 = "SET @p0='".$cid."'";
		mysqli_query($cn,$p1);
		$res = mysqli_query($cn, "CALL getDetailedCart (@p0)");
		mysqli_next_result($cn);

		?>

		<center><br/><h2 style="color : white;">DETAIL CART</h2><br/></center>

		<div class="container table-responsive">
			<table class="table table-striped table-dark">
				<thead>
					<tr>
						<th>Product ID</th>
						<th>Product Name</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Sub Amount</th>
						<th>Action</th>
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
							<td><a href="javascript:del(<?php echo $row[0] ?>)">Delete</a></td>
						</tr>

						<?php

						$totalamt = $totalamt + $row[4];
					}
					
					?>
					<tr style="background-color : white;">
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><h6 style="color: black;">Total Amount: <?php echo $totalamt ?></h6></td>
						<td><a class="btn btn-light" href="checkout.php">Check Out</a></td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php
	}
	else
	{
		?>
		<center><h4 style="color : white;">There are no items in your cart.</h4></center>
		<br/>
		<?php
	}
	?>
	

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