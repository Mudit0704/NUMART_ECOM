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

	<?php
	include("connect.php");

	$msg="";
	if($_REQUEST["del_id"]<>"")
	{
		$did = $_REQUEST["del_id"];
		$qr = "delete from detail_cart where dc_id=".$did;
		mysqli_query($cn, $qr);
		$msg = "Data deleted with dc_id ".$did;
	}

	if(isset($_REQUEST["msg"])<>"")
	{
		$msg = $_REQUEST["msg"];
	}

	$uid = $_SESSION["uemail"];
	$cr = "select * from cart where user_id='".$uid."'and status='ongoing'";
	$res1 = mysqli_query($cn, $cr);

	$qr3="SELECT count(*) FROM `cart` WHERE user_id='".$uid."' and status='ongoing'";
	$res3 = mysqli_query($cn, $qr3);
	$row3 = mysqli_fetch_array($res3);
	if($row3[0]>0)
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

		$qr="select * from detail_cart where c_id='".$cid."'";
		$res = mysqli_query($cn, $qr);

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
						$qr2="select pname from product where pid=".$row[2];
						$res2 = mysqli_query($cn, $qr2);
						$pronm = mysqli_fetch_array($res2);

						?>

						<tr>
							<td><?php echo $row[2] ?></td>
							<td><?php echo $pronm[0] ?></td>
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
</body>
</html>