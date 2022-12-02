<!DOCTYPE html>
<html>
<head>
	<title>Admins</title>
	<?php include 'head.php';?>
	<script type="text/javascript" >
		function del(id)
		{
			if(confirm("Do you want to delete "+id+" data?"))
			{
				window.location="admingrid.php?del_id="+id;
			}
		}
	</script>
</head>
<body>

	<?php
        
			include("connect.php");
	
			if(!isset($_SESSION["uid"]))
			{
				header("location:admin.php?msg=Sorry your session expired");
			}
			include("adminnav.php");
			        
        ?>

	<?php
	include("connect.php");

	$msg="";
	if($_REQUEST["del_id"]<>"")
	{
		$did = $_REQUEST["del_id"];
		$qr = "delete from admin where admin_id=".$did;
		mysqli_query($cn,$qr);
		$msg = "Data deleted with admin_id ".$did;
	}

	if(isset($_REQUEST["msg"])<>"")
	{
		$msg = $_REQUEST["msg"];
	}
	$qr="select * from admin";
	$res = mysqli_query($cn,$qr);


	?><br>

	<center><h2 style="color : white;">ADMINS</h2></center><br/>
	<div class="container table-responsive">
		<table class="table table-striped table-dark">
			<thead>
				<tr>
					<th>Admin ID</th>
					<th>Admin Name</th>
					<th>User ID</th>
					<th>Password</th>
					<th>Admin Type</th>
					<th>Action</th>
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
						<td><a href="updateAdmin.php?admin_id=<?php echo $row[0] ?>">Edit </a> <a href="javascript:del(<?php echo $row[0] ?>)">Delete</a></td>
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