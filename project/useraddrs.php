<!DOCTYPE html>
<html>
<head>
    <title>Add New Address</title>
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
    <div class="container" style="margin: 0 auto;margin-top: 1em;max-width: 60%">
        <div class="jumbotron" style="background-color: #44a08d;">
            <form name="frm2" action="processUseraddrs.php" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="validationServer01" style="color: white;">Address Type</label>
                        <input type="text" class="form-control " name="adrtype">
                    </div>
                    <div class="col-md-6">
                        <label for="validationServer01" style="color: white;">Suitable Delivery Timing</label>
                        <input type="text" class="form-control " nname="tm">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="validationServerUsername" style="color: white;">Enter Addresss</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="adtxt" rows="5" cols="50"></textarea>
                    </div>
                </div>
                <button class="btn btn-primary btn-outline-dark" type="submit" value="Submit" name="submit" style="width: 100%;">Add</button>
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