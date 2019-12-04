<?php
    session_start();
    $rec_prod_id = $_REQUEST["q"];
    $servername = "sql103.epizy.com";
    $username = "epiz_24648743";
    $password = "Yrxkn9lQRqYUtc8";
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    $sql = "select * from epiz_24648743_Retail_Management_System.item where item_id = '".$rec_prod_id."'";
    $result = $conn->query($sql);
    if($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        //array_push($_SESSION['prod_arr'],$row["item_id"]); 
        $sql2 = "select cat_name from epiz_24648743_Retail_Management_System.Category where cat_id = '".$row["cat_id"]."'";
        //$_SESSION['bill_total'] = $_SESSION['bill_total'] + $row["sale_price"];
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();
        //echo json_encode($row);
        //echo "<br>";
        $ret = '{"item_id":"'.$row['item_id'].'",
                "sale_price":"'.$row['sale_price'].'",
                "marked_price":"'.$row['marked_price'].'",
                "item_name":"'.$row['item_name'].'",
                "cat_name":"'.$row2['cat_name'].'"}'; 
        echo $ret;
        //echo "<tr><td>".$row["item_id"]."</td><td>".$row["item_name"]."</td><td>".$row["marked_price"]."</td><td>".$row["sale_price"]."</td><td>".$row2["cat_name"]."</td></tr>";
    }
    else
    {
        echo "";
    }
?>