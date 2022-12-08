<?php

    include("connect.php");

    if(!isset($_SESSION["uid"]))
    {
        header("location:admin.php?msg=Sorry your session expired");
    }

    $adminId = $_REQUEST["admin_id"];
    $p1 = "SET @p0='".$adminId."'";
    mysqli_query($cn,$p1);
    $res = mysqli_query($cn,"CALL getAdminDetails (@p0)");
    $row = mysqli_fetch_array($res);
    include("adminnav.php");
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Admin</title>
    <?php include 'head.php';?>
</head>
<body>
    <br>

    <div class="container" style="margin: 0 auto;margin-top: 1em;max-width: 60%">
        <div class="jumbotron" style="background-color: #44a08d;">
            <form name="frm3" action="processAdminUpdate.php" enctype="multipart/form-data" method="post">
                <div class="form-row">
                    <div class="col-md-6">
                        <input type="hidden" name="adminId" value="<?php echo $row[0]?>"/>
                        <label for="validationServer01" style="color: white;">Enter Name</label>
                        <input type="text" class="form-control " id="validationServer01" name="ntxt" value="<?php echo $row[1] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="validationServer01" style="color: white;">Enter ID</label>
                        <input type="text" class="form-control " id="validationServer01" name="itxt" value="<?php echo $row[2] ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="validationServer01" style="color: white;">Enter Password</label>
                        <input type="text" class="form-control " id="validationServer01" name="ptxt" value="<?php echo $row[3] ?>">
                    </div>
                    <div class="col-md-6">
                        <label style="color: white;">Select Type</label>
                        <select class="custom-select" name="tptxt">
                            <?php
                            if("SA" == $row[4])
                            {
                                ?>

                                <option value="SA" selected>Super Admin</option>
                                <option value="A"> Admin</option>

                                <?php
                            }
                            else
                            {
                                ?>

                                <option value="SA">Super Admin</option>
                                <option value="A" selected> Admin</option>

                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div> <br>
                <button class="btn btn-primary btn-outline-dark" type="submit" value="Add" name="submit" style="width: 100%;">Update</button>
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