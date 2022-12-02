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

	include("adminnav.php");

	?>
	<?php

	include("connect.php");
	$addr_type = "";
	$addr = "";
	$user_id = "";
	$status = "";
	$oid = $_REQUEST["oid"];
	$qr = "select p1.pid,pname,qty,p1.price,od1.oid,adrtype,paytype,od1.st from ordr o1 ,orderdetails od1 ,product p1 where od1.o_id=".$oid." and o1.o_id=".$oid." and od1.pid=p1.pid";
	$res = mysqli_query($cn,$qr);

	if($row2 = mysqli_fetch_array($res))
	{
		
		$addr_type = $row2[5];
	}
	$res = mysqli_query($cn,$qr);

	$qr2 = "select o1.user_id from ordr o1 where o1.o_id = '".$oid."'";
	$res2 = mysqli_query($cn,$qr2);

	if($row = mysqli_fetch_array($res2))
	{
		
		$user_id = $row[0];
	}

	

	$qr3 = "select addr from useradr where uemail = '".$user_id."' and adrtype = '".$addr_type."'";
	$res3 = mysqli_query($cn,$qr3);
	if($row3 = mysqli_fetch_array($res3))
	{
		
		$addr = $row3[0];
	}
	?>
	<br>
	<center><h2 style="color : white;">ORDER DETAILS</h2></center>
	<div class="container table-responsive">
		<table class="table table-striped table-dark">
			<thead>
				<tr>
					<th>Product Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Address</th>
					<th>Payment Method</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php

				while($row = mysqli_fetch_array($res))
				{
					if($row[7]=='pending')
					{
						?>	        
						<tr>
							<td><?php echo $row[1] ?></td>
							<td><?php echo $row[2] ?></td>
							<td><?php echo $row[3] ?></td>
							<td><?php echo $addr ?></td>
							<td><?php echo $row[6] ?></td>
							<td><?php echo $row[7] ?></td>
						</tr>

						<?php
					}
					else
					{
						?>
						<tr>
							<td><?php echo $row[1] ?></td>
							<td><?php echo $row[2] ?></td>
							<td><?php echo $row[3] ?></td>
							<td><?php echo $addr ?></td>
							<td><?php echo $row[6] ?></td>
							<td><?php echo $row[7] ?></td>
						</tr>

						<?php
					}
					$status = $row[7];
				}
				?>
			</tbody>
		</table>
		<?php
		if ($status == 'Cancelled' || $status =='' || $status == 'Delivered') { ?>
			<a href="admin_orderUpdate.php?oid=<?php echo $oid ?>" class = "btn" style = "float: right; pointer-events: none;">Cancel</a>
			<a href="admin_orderUpdate.php?oid=<?php echo $oid ?>" class = "btn" style = "float: right; pointer-events: none;margin-right: 2px;">Processing</a>
			<a href="admin_orderUpdate.php?oid=<?php echo $oid ?>" class = "btn" style = "float: right; pointer-events: none;margin-right: 2px;">Dispatched</a>
			<a href="admin_orderUpdate.php?oid=<?php echo $oid ?>&st=Delivered" class = "btn" style = "float: right; pointer-events: none;margin-right: 2px;">Delivered</a>
		<?php } else { ?>
			<a href="admin_orderUpdate.php?oid=<?php echo $oid ?>&st=Cancelled" class = "btn" style = "float: right;">Cancel</a>
			<a href="admin_orderUpdate.php?oid=<?php echo $oid ?>&st=Processing" class = "btn" style = "float: right;margin-right: 2px;">Processing</a>
			<a href="admin_orderUpdate.php?oid=<?php echo $oid ?>&st=Dispatched" class = "btn" style = "float: right;margin-right: 2px;">Dispatched</a>
			<a href="admin_orderUpdate.php?oid=<?php echo $oid ?>&st=Delivered" class = "btn" style = "float: right;margin-right: 2px;">Delivered</a>
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