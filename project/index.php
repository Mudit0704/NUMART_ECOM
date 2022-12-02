<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Page</title>
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="./web.css">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="./index.php">NUMart</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="#">Login<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./usersignup.php">Sign Up</a>
      </li>
    </ul>
   </div>
</nav>

<div class="container" style="margin: 0 auto;margin-top: 8em;max-width: 60%;">
	<div class="jumbotron" style="background-color: #44a08d;">
			<form name="frm1" action="processUserlogin.php" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1" style="color: white;">Email address</label>
    <input type="email" class="form-control" id="email" name="idtxt" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1" style="color: white;">Password</label>
    <input type="password" class="form-control"  id="pass" name="ptxt" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary btn-outline-dark" onclick="validate()" style="width: 100%;">Log In</button>
</form>
	</div>
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