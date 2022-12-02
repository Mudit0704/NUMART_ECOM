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
					<a class="nav-link active" href="orderhistory.php">View Orders<span class="sr-only">(current)</span></a>
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
	$status = "";
	$oid = $_REQUEST["oid"];
	$qr = "select p1.pid,pname,qty,p1.price,od1.oid,adrtype,paytype,od1.st from ordr o1 ,orderdetails od1 ,product p1 where od1.o_id=".$oid." and o1.o_id=".$oid." and od1.pid=p1.pid";
	$res = mysqli_query($cn,$qr);

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