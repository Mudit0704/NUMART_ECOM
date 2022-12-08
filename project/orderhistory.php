<?php

    include("connect.php");

    if(!isset($_SESSION["uid"]))
    {
        header("location:index.php?msg=Sorry your session expired");
    }


    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Orders</title>
    <?php include 'head.php';?>
</head>
<body>

    <?php include("usernav.php"); ?>
    <br>

    <center><h2 style="color : white;">YOUR ORDERS</h2></center><br/>
        <form>
        <?php
        
            include("connect.php"); 
            $uid = $_SESSION["uemail"];
            $p1 = "SET @p0='".$uid."'";
    
            mysqli_query($cn,$p1);
            $res = mysqli_query($cn,"CALL getUserOrders (@p0)");
            
        ?>
        <div class="container table-responsive">
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Payment Method</th>
                        <th>Address</th>
                        <th>Total Amount</th>
                        <th>Status</th>
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
                            <td><?php echo $row[4] ?></td>
                            <td><?php echo $row[5] ?></td>
                            <td><?php echo $row[6] ?></td>
                            <td><?php echo $row[7] ?></td>
                            <td><a href="vieworderdetails.php?oid=<?php echo $row[0] ?>">View Details</a></td>
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