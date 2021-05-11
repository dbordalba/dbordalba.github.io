<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 900px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Employees Records</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Employee</a>
                    </div>
                  

                    <?php
                        require_once "config.php";
                    
                        $sql = "SELECT * FROM employees";
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){

                                echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            echo "<th>Name</th>";
                                            echo "<th>Address</th>";
                                            echo "<th>Birthdate</th>";
                                            echo "<th>Age</th>";
                                            echo "<th>Civil Status</th>";
                                            echo "<th>Status</th>";
                                            echo "<th>Action</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){

                                        $empstat = $row['status'] == 1 ? "Active" : "Inactive";
                                        echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
                                            echo "<td>" . $row['address'] . "</td>";
                                            echo "<td>" . $row['birthdate'] . "</td>";
                                            echo "<td>" . $row['age'] . "</td>";
                                            echo "<td>" . $row['civil_status'] . "</td>";
                                            echo "<td>" . $empstat   . "</td>";
                                            echo "<td>";
                                                echo '<a href="view.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                                echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                                echo '<a href="#" title="Delete Record" data-toggle="tooltip" onclick="confirmDelete(' . $row['id'] . ')"><span class="fa fa-trash"></span></a>';
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";
                                // Free result set
                                mysqli_free_result($result);
                            } else{
                                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                            }

                           
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
    
                        // Close connection
                        mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

<script  src="js/bootbox.js" type="text/javascript"></script>


<script  type="text/javascript">

    function confirmDelete(id){
        bootbox.confirm({
            title: "Confirm Delete",
            message: "Are you sure you want to delete this record?",
            buttons: {
                confirm: {
                    label: 'Yes, Delete it!',
                    className: 'btn-danger'
                },
                cancel: {
                    label: 'No, Cancel',
                }
            },
            callback: function (result) {
                if(result){
                    $.ajax({
                        url: "delete.php?id=" + id,
                        type: 'post',
                        success: function(data){

                            bootbox.alert({
                                    title: "Successful!",
                                    message: "Record was successfully deleted!",
                                    callback: function(){
                                        window.location.href = 'page.php';
                                    }
                                });
                        },
                        error: function(data){
                            bootbox.alert({
                                title: "Error!",
                                message: "Error occurred during deletion. Try again later!"
                            })
                        }
                    }); 

                }
                console.log('This was logged in the callback: ' + result);
            }
        });
    }
</script>