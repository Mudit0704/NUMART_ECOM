<!DOCTYPE html>
<html>
<head>
	<title>Order Placed</title>
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
	<center><h2 style="color : white;">ORDER PLACED</h2></center>
	<div class="container table-responsive">
			<table class="table table-striped table-dark">
				<thead>
					<tr>
						<th>Order ID</th>
			            <th>Payment Method</th>
			            <th>Address</th>
			            <th>Total Amount</th>
			            <th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
			include("connect.php");
			$cid = $_REQUEST["cid"];
			$p1 = "SET @p0='".$cid."'";
			mysqli_query($cn,$p1);
			$res = mysqli_query($cn,"CALL getCartOrder (@p0)");
			mysqli_next_result($cn);
			
		
		while($row = mysqli_fetch_array($res))
		{
		?>
        
        <tr>
        	<td><?php echo $row[0] ?></td>
            <td><?php echo $row[4] ?></td>
            <td><?php echo $row[5] ?></td>
            <td><?php echo $row[6] ?></td>
            <td><?php echo $row[7] ?></td>
        </tr>
        
        <?php
			$oid = $row[0];
		}
		
		$p1 = "SET @p0='".$cid."'";
		$p2 = "SET @p1=complete";
		mysqli_query($cn,$p1);
		mysqli_query($cn,$p2);

		mysqli_query($cn,"CALL updateCartStatus (@p0, @p1)");
		mysqli_next_result($cn);
		?>
				</tbody>
			</table>
		</div><br/>
        
        <center><h2 style="color : white;">ORDER DETAILS</h2></center>
        
        <?php
        $p1 = "SET @p0='".$oid."'";
		mysqli_query($cn,$p1);

		$res = mysqli_query($cn,"CALL getOrderDetails (@p0)");
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
			            <th>Total Sub Amount</th>
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
		}
		?>
				</tbody>
			</table>
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
</body>
</html>