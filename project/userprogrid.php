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
			header("location:index.php?msg=Sorry your session expired");
		}


		?>

		<?php include("usernav.php"); ?>
		<br>

		<?php
		include("connect.php");

		$msg="";
		$result = mysqli_query($cn, "CALL getAllProductDetails()");
		mysqli_next_result($cn);

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
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>