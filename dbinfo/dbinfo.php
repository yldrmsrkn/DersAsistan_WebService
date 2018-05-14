<?php
    $servername = "172.17.0.3:3306";
    $username = "root";
    $password = "q1w2e3r4t5";

    $con=mysqli_connect($servername,$username,$password,"dersAsistan");
    // Check connection
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>