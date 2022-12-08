<?php
	
	include("connect.php");
	
	if(!isset($_SESSION["uid"]))
	{
		header("location:admin.php?msg=Sorry your session expired");
	}
	
	  
	?>
<!DOCTYPE html>
<html>
<head>
	<title>Brands</title>
	<?php include 'head.php';?>
	<script type="text/javascript" >
		function del(id)
		{
			if(confirm("Do you want to delete "+id+" data?"))
			{
				window.location="brandgrid.php?del_id="+id;
			}
		}
	</script>
</head>
<body>

	<?php include("adminnav.php"); ?>
	<br>
	<?php
	include("connect.php");
	
	$msg="";
	if($_REQUEST["del_id"]<>"")
	{
		$did = $_REQUEST["del_id"];
		$p1 = "SET @p0='".$did."'";
		mysqli_query($cn,$p1);
		mysqli_query($cn,"CALL deleteBrand (@p0)");
		$msg = "Data deleted with brand_id ".$did;
	}
	
	if(isset($_REQUEST["msg"])<>"")
	{
		$msg = $_REQUEST["msg"];
	}

	$res = mysqli_query($cn,"CALL getAllBrands()");
	
	
	?>
	
	<center><h2 style="color : white;">BRANDS</h2></center><br/>
	<div class="container table-responsive">
		<table class="table table-striped table-dark">
			<thead>
				<tr>
					<th>Brand ID</th>
					<th>Brand Name</th>
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
						<td><a href="brand_update.php?brand_id=<?php echo $row[0] ?>">Edit </a> <a href="javascript:del(<?php echo $row[0] ?>)">Delete</a></td>
					</tr>
					
					<?php
				}
				?>
			</tbody>
		</table>
		<a class="btn" href="brand.php" style="float : right;">Add Brand</a>
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