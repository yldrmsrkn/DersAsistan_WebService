<?php
    include ('../dbinfo/dbinfo.php');
    date_default_timezone_set('Europe/Istanbul');
    $now_created = date("Y-m-d");
    $now_updated = date("Y-m-d H:i:s");
    if (isset($_GET['add_course'])) {
        $add_course_course_name = $_GET['add_course_course_name'];
        $add_course_course_id = $_GET['add_course_course_id'];
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM `dersler` WHERE `dersid` = ". $add_course_course_id ."";
        if ($result = mysqli_query($con, $sql)){
            if(mysqli_num_rows($result) > 0){
                echo "exist"
            }else{
                $sql = "INSERT INTO `dersler` (`dersid`, `dersadi`) VALUES ('".$add_course_course_id."', '".$add_course_course_name."');";
                if (mysqli_query($con, $sql)) {
                    echo "OK"
                } else {
                    echo "Err"
                }
            }
        }
    }elseif (isset($_GET['remove_course'])) {
        $remove_course_course_id = $_GET['remove_course_course_id'];
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "DELETE FROM `dersler` WHERE `dersid` = ".$remove_course_course_id."";
        if ($result = mysqli_query($con, $sql)) 
        {
            echo "OK";
        }
        else {
            echo "ERR";
        }
    }elseif (isset($_GET['list_course'])) {
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM `dersler`";
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