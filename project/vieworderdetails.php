<!DOCTYPE html>
<html>
<head>
	<title>Order Details</title>
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

	<?php include("usernav.php"); ?>
	<br>
	<?php

	include("connect.php");
	$status = "";
	$oid = $_REQUEST["oid"];
	$p1 = "SET @p0='".$oid."'";
    
    mysqli_query($cn,$p1);
	$res = mysqli_query($cn,"CALL getDetailedOrder (@p0)");
	mysqli_next_result($cn);

	?>
	<center><h2 style="color : white;">ORDER DETAILS</h2></center>
	<div class="container table-responsive">
		<table class="table table-striped table-dark">
			<thead>
				<tr>
					<th>ProductID</th>
					<th>Product Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>OrderID</th>
					<th>Address</th>
					<th>Payment Method</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php

				while($row = mysqli_fetch_array($res))
				{
						?>	        
						<tr>
							<td><?php echo $row[0] ?></td>
							<td><?php echo $row[1] ?></td>
							<td><?php echo $row[2] ?></td>
							<td><?php echo $row[3] ?></td>
							<td><?php echo $row[4] ?></td>
							<td><?php echo $row[5] ?></td>
							<td><?php echo $row[6] ?></td>
							<td><?php echo $row[7] ?></td>
						</tr>

					<?php
					$status = $row[7];
					}
				?>
			</tbody>
		</table>
		<?php
		 if ($status == 'Cancelled' || $status == 'Delivered') { ?>
		 	<a href="usercancelorder.php?oid=<?php echo $oid ?>" class = "btn" style = "float: right; pointer-events: none;">Cancel</a>
		<?php } else { ?>
			<a href="usercancelorder.php?oid=<?php echo $oid ?>" class = "btn" style = "float: right;">Cancel</a>
		<?php } 
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