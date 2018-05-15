<?php
    include ('../dbinfo/dbinfo.php');
    date_default_timezone_set('Europe/Istanbul');
    $now_created = date("Y-m-d");
    $now_updated = date("Y-m-d H:i:s");

    if (isset($_GET['register_user'])) {
        $register_username = $_GET['register_username'];
        $register_password = $_GET['register_password'];
        
        
        
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM `users` WHERE `username` = '".$register_username."'";
        if ($result = mysqli_query($con, $sql)) {
            if(mysqli_num_rows($result) > 0){
                echo "EXIST";
            }else{
                $sql = "INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES (NULL, '".$register_username."', '".$register_password."', '3');";
                if (mysqli_query($con, $sql)) {
                    echo "OK";
                } else {
                    echo "ERR";
                }
            }
        }
    }elseif (isset($_GET['login_user'])) {
        $login_username = $_GET['login_username'];
        $login_password = $_GET['login_password'];
        
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM `users` WHERE `username` = '".$login_username."' AND `password` = '".$login_password."'";
        if ($result = mysqli_query($con, $sql)) {
            if(mysqli_num_rows($result) > 0){
                while($row = $result->fetch_assoc()) {
                    echo "OK#" . $row["role"];
                }
            }else{
               echo "ERR#2";
            }
        }
    }elseif (isset($_GET['list_user'])) {
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT `username` FROM `users` WHERE `role` = 3 ";
        if ($result = mysqli_query($con, $sql)) 
        {
            $emparray = array();
            while($row =mysqli_fetch_assoc($result))
            {
                $emparray[] = $row;
            }
            echo json_encode($emparray);
        }
    }


?>