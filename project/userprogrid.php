<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
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

		$qr="SELECT * FROM `product` p1 ,brand b1, type t1 WHERE b1.brand_id= p1.bid and p1.tid = t1.type_id ";
		$result = mysqli_query($cn, $qr);

		?>
		<div class="container table-responsive">
			<table class="table table-striped table-dark">
				<thead>
					<tr>
						<th>ProductID</th>
						<th>Product Name</th>
						<th>Brand</th>
						<th>Type</th>
						<th>Picture</th>
						<th>Price</th>
						<th>isAvailable</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					while($row = mysqli_fetch_array($result))
					{

						?>
						<tr>
							<td><?php echo $row[0] ?></td>
							<td><?php echo $row[1] ?></td>
							<td><?php echo $row[10] ?></td>
							<td><?php echo $row[12] ?></td>
							<td><img src="uploads/<?php echo $row[4] ?>" height="100" width="100"></td>
							<td><?php echo $row[5] ?></td>
							<td><?php echo $row[7] ?></td>
							<td><a href="prodetails.php?pid=<?php echo $row[0] ?>">View Details </a></td>
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