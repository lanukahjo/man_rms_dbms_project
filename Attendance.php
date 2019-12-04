<?php
    session_start();
    $servername = "sql103.epizy.com";
    $username = "epiz_24648743";
    $password = "Yrxkn9lQRqYUtc8";
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    $usr =  $_SESSION['id'];
    date_default_timezone_set("Asia/Kolkata");
    $cur_date = date('Y-m-d');
    $query1 = "select * from epiz_24648743_Retail_Management_System.Shift where emp_id = '".$usr."' and entr_date = '".$cur_date."'";
    $result = $conn->query($query1);
    if($result->num_rows > 0)
    {   
        $end_t = date('H:i:s');
        $query3 = "update epiz_24648743_Retail_Management_System.Shift set end_time = '".$end_t."' where emp_id = '".$usr."'";
        $conn->query($query3);
    }
    else
    {
        echo "End Time:<br>";
        $start_t = date('H:i:s');
        $query2 = "insert into epiz_24648743_Retail_Management_System.Shift(emp_id,entr_date,start_time) values('".$usr."','".$cur_date."','".$start_t."')";
        $conn->query($query2);
    }
    echo "<script>window.location.replace('./Emp_info.php')</script>";
?>