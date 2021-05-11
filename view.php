<?php
// Include config file
require_once "config.php";
 
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);

        $sql = "SELECT * FROM employees where id = " . $id;
        $result = mysqli_query($link, $sql);
         
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $fname = $row['first_name'];
                $lname = $row['last_name'];
                $address = $row['address'];
                $birthdate = $row['birthdate'];
                $age = $row['age'];
                $cstatus = $row['civil_status'];
                $status = $row['status'];
            }
        }
        else{
            $fname = $lname = $address = $birthdate = $age = $cstatus = $status = "";
            echo '<div class="alert alert-danger"><em>No record found.</em></div>';
        }        
        
    }

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        input:read-only,textarea:read-only{
            background-color:  white!important
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">View Record</h2>
                    <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo strtoupper($fname . ' ' . $lname); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control" readonly><?php echo strtoupper($address); ?></textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Birthdate</label>
                                <input type="text" name="birthdate" class="form-control" value="<?php echo $birthdate; ?>" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Age</label>
                                <input type="text" name="age" class="form-control" value="<?php echo $age; ?>" readonly>
                            </div>
                        </div>
                        
                        <div class='row'>
                            
                            <div class="form-group col-6">
                                <label>Civil Status</label>
                                <input type="text" name="cstatus" class="form-control" value="<?php echo strtoupper($cstatus); ?>" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label >Status</label>
                                <input type="text" name="status" class="form-control" value="<?php echo $status==1 ? 'ACTIVE' : 'INACTIVE' ;?>" readonly>
                            </div>
                        </div>
                        <a href="page.php" class="btn btn-secondary">Back</a>
                        <a href="update.php?id=<?php echo $id?>" class="btn btn-info ml-2">Update</a>
                        <a href="page.php" class="btn btn-danger ml-2">Delete</a>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>