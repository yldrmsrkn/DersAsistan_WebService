<?php
    include ('../dbinfo/dbinfo.php');
    date_default_timezone_set('Europe/Istanbul');
    $now_created = date("Y-m-d");
    $now_updated = date("Y-m-d H:i:s");

    if (isset($_GET['add_note'])) {
        $add_note_note_text = $_GET['add_note_note_text'];
        $add_note_course_id = $_GET['add_note_course_id'];
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "INSERT INTO `duyuru` (`dersid`, `duyuru`, `tarih`) VALUES ('".$add_note_course_id."', '".$add_note_note_text."', CURRENT_TIMESTAMP);";
        if ($result = mysqli_query($con, $sql)){
            echo "OK";
        }else {
            echo "ERR";
        }
    }elseif (isset($_GET['list_note'])) {
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM `duyuru`";
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