<?php
// Include config file
require_once "config.php";

if(isset($_GET["id"]) && !empty($_GET["id"])){
    $id = $_GET["id"];
    
    $sql = "DELETE FROM employees WHERE id = " . $id;
    
    echo mysqli_query($link, $sql) === TRUE ? 'success' : "failed";

    // Close connection
    mysqli_close($link);
}
?>
 