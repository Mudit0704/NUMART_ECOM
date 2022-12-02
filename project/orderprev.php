<!DOCTYPE html>
<html>
<head>
	<title>Order Placed</title>
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
					<a class="nav-link active" href="userviewcart.php">View Cart<span class="sr-only">(current)</span></a>
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
			$qr = "select * from ordr where c_id=".$cid;
			$res = mysqli_query($cn,$qr);
			
		
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
		
		$qr1 = "update cart set status='complete' where c_id='".$cid."'";
		mysqli_query($cn,$qr1);
		?>
				</tbody>
			</table>
		</div><br/>
        
        <center><h2 style="color : white;">ORDER DETAILS</h2></center>
        
        <?php
		$qr="select * from orderdetails where o_id=".$oid."";
		$res = mysqli_query($cn,$qr);
		
	
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
			$qr2="select pname from product where pid=".$row[2];
			$res2 = mysqli_query($cn,$qr2);
			$pronm = mysqli_fetch_array($res2);
		
		?>
        
        <tr>
            <td><?php echo $row[2] ?></td>
            <td><?php echo $pronm[0] ?></td>
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