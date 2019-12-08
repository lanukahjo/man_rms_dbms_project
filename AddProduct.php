<?php
    $x1 = $_REQUEST["q"];
    $x2 = $_REQUEST["r"];
    $x3 = $_REQUEST["s"];
    $x4 = $_REQUEST["t"];
    $x5 = $_REQUEST["u"];
    $x6 = $_REQUEST["v"];
    $x7 = $_REQUEST["w"];

    
    $servername = "sql103.epizy.com";
    $username = "epiz_24648743";
    $password = "Yrxkn9lQRqYUtc8";
    $conn = new mysqli($servername, $username, $password);

    $query1 = "select * from epiz_24648743_Retail_Management_System.item where item_id = '".$x1."'";
    $result1 = $conn->query($query1);
    if($result1->num_rows > 0)
    {
        $row1 = $result1->fetch_assoc();
        $query2 = "update epiz_24648743_Retail_Management_System.item set qty = ".($row1['qty'] + number_format($x6))." where item_id = '".$x1."'";
        $result2 = $conn->query($query2);
    } 
    else
    {
        $query3 = "insert into epiz_24648743_Retail_Management_System.item values('".$x1."',".$x3.",".$x4.",".$x5.",'".$x2."','".$x7."',".$x6.")";
        $conn->query($query3);
    }

    echo $query1;
    echo "<br>";
    echo $query2;
    echo "<br>";
    echo $result2;
    
?>