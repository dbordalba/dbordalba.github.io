<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$fname = $lname = $address = $birthdate = $age = $cstatus = $status = "";
$fname_err = $lname_err = $address_err = $birthdate_err = $age_err = $cstatus_err = $status_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate first name
    $input_fname = trim($_POST["first_name"]);
    if(empty($input_fname)){
        $fname_err = "Please enter first name.";
    } elseif(!filter_var($input_fname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $fname_err = "Please enter a valid name.";
    } else{
        $fname = $input_fname;
    }
    // Validate last name

    $input_lname = trim($_POST["last_name"]);
    if(empty($input_lname)){
        $lname_err = "Please enter last name.";
    } elseif(!filter_var($input_lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $lname_err = "Please enter a valid name.";
    } else{
        $lname = $input_lname;
    }
    
    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    
    // Validate birthdate
    $input_bd = trim($_POST["birthdate"]);
    if(empty($input_bd)){
        $birthdate_err = "Please enter birthdate.";     
    } else{
        $birtdate = $input_bd;
    }

    // Validate age

    $input_age = trim($_POST["age"]);
    if(empty($input_age)){
        $age_err = "Please enter age.";
    } elseif(!filter_var($input_age, FILTER_VALIDATE_INT)){
        $age_err = "Please enter valid age.";
    } else{
        $age = $input_age;
    }

    $cstatus = trim($_POST["cstatus"]);
    $status = trim($_POST["status"]);

    
    // Check input errors before inserting in database
    if(empty($fname_err) && empty($lname_err) && empty($address_err) && 
    empty($birthdate_err) && empty($age_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO employees (first_name, last_name, address, birthdate, age,civil_status,status) 
        VALUES ('$fname', '$lname', '$address', '$birtdate', $age, '$cstatus', $status)";
         
        if (mysqli_query($link, $sql) === TRUE) {
            header("location: page.php");
            exit();
          } else {
              echo json_encode(mysqli_query($link, $sql));
            echo "Oops! Something went wrong. Please try again later.";
          }

       
    }
    
    // Close connection
    mysqli_close($link);
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
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control <?php echo (!empty($fname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fname; ?>">
                            <span class="invalid-feedback"><?php echo $fname_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control <?php echo (!empty($lname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lname; ?>">
                            <span class="invalid-feedback"><?php echo $lname_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Birthdate</label>
                                <input type="date" name="birthdate" min='1970-01-01' max='2020-12-31' class="form-control <?php echo (!empty($birthdate_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $birthdate; ?>">
                                <span class="invalid-feedback"><?php echo $birthdate_err;?></span>
                            </div>
                            <div class="form-group col-6">
                                <label>Age</label>
                                <input type="text" name="age" class="form-control <?php echo (!empty($age_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $age; ?>">
                                <span class="invalid-feedback"><?php echo $age_err;?></span>
                            </div>
                        </div>
                        
                        <div class='row'>
                            
                            <div class="form-group col-6">
                                <label>Civil Status</label>
                                <select class="form-control" name='cstatus'>
                                    <option value='single'>Single</option>
                                    <option value='married'>Married</option>
                                    <option value='separated'>Separated</option>
                                    <option value='divorced'>Divorced</option>
                                    <option value='widowed'>Widowed</option>

                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label >Status</label>
                                <select class="form-control" name='status'>
                                    <option value='1'>Active</option>
                                    <option value='0'>Inactive</option>

                                </select>
                            </div>
                        </div>
                        
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="page.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>