<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "surgemotors";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


    $conn = new mysqli($host, $username, $password, $database);
    if($conn -> connect_errno){
        echo "Failed to Connect to MYSQL";
    }
    else{
        echo" Connected Sucessfully\n";
    }

?>
