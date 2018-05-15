<?php
    include ('../dbinfo/dbinfo.php');
    date_default_timezone_set('Europe/Istanbul');
    $now_created = date("Y-m-d");
    $now_updated = date("Y-m-d H:i:s");

    if (isset($_GET['register_akademisyen'])) {
        $register_username = $_GET['register_aka_username'];
        $register_password = $_GET['register_aka_password'];
        
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM `users` WHERE `username` = '".$register_username."'";
        if ($result = mysqli_query($con, $sql)) {
            if(mysqli_num_rows($result) > 0){
                $arr = array('message' => "EXIST");
                echo json_encode($arr);
            }else{
                $sql = "INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES (NULL, '".$register_username."', '".$register_password."', '2');";
                if (mysqli_query($con, $sql)) {
                    $arr = array('message' => "OK");
                    echo json_encode($arr);
                } else {
                    $arr = array('message' => "ERR");
                    echo json_encode($arr);
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
    }elseif (isset($_GET['add_ders'])) {
        ///
    }


?>