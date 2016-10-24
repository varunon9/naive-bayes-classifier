<?php
    /**
    * This file make connection to database using following parameters.
    */
    $servername = "localhost";
    $username = "root";
    $password = "root123";
    $dbname = "naiveBayes";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    mysqli_set_charset($conn, "utf8");
    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>