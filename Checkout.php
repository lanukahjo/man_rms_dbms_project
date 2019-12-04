<!DOCTYPE html>
<html>
<?php
    session_start();
?>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bill Checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        input[type=submit]:hover{
            opacity: 0.8;
        }
        input[type=submit]{
            width: 10%;
        }
        input[type=text],input[type=date] {
            width : 80%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        .container {
            padding-top: 80px;
            padding-bottom: 80px;
            padding-right: 7%;
            padding-left: 7%;
            margin: 20px;
            border: 5px;
            border-style: solid;
            border-color: rgb(200, 200, 200);

        }
        .customer-form{
            align-content: center;
            padding-top: 20px;
            padding-bottom: 20px;
            padding-right: 20px;
            padding-left: 20px;
            border: 3px;
            margin-bottom: 10px;
            border-style: solid;
            border-color: rgb(200, 200, 200);
        }
        .item-list{
            padding-top: 10px;
            padding-bottom: 10px;
            height : 400px;
            border: 2px;
            border-style: solid;
            border-color: rgb(200, 200, 200);
            resize: vertical;
            overflow : scroll;
        }
        .footer{
            align-content: center;
            padding-top: 25px;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
<?php
    if(isset($_POST['pay']))
    {
        $x1 = $_POST['cname'];
        $x2 = $_POST['lname'];
        $x3 = $_POST['bdate'];
        $x4 = $_POST['gend'];
        $x5 = $_POST['phno'];
        $x6 = $_POST['email'];
        $cust_id = 1;
        $servername = "sql103.epizy.com";
        $username = "epiz_24648743";
        $password = "Yrxkn9lQRqYUtc8";
        // Create connection
        $conn = new mysqli($servername, $username, $password);
        $query = "Select * from epiz_24648743_Retail_Management_System.Customer where phone_no = '".$_POST['phno']."'";
        $result = $conn->query($query);
        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $cust_id = $row['cust_id'];
        }
        else
        {
            $query2 = "Select * from epiz_24648743_Retail_Management_System.Customer";
            $result2 = $conn->query($query2);
            if($result2->num_rows > 0)
            {
                echo "6<br>";
                $query3 = "Select max(cust_id) as max_cust from epiz_24648743_Retail_Management_System.Customer";
                $result3 = $conn->query($query3);
                $row3 = $result3->fetch_assoc();
                $cust_id = $row3['max_cust'] + 1;
            }
            $query4 = "insert into epiz_24648743_Retail_Management_System.Customer values(".$cust_id.",'".$x1."','".$x2."','".$x4."','".$x3."','".$x5."','".$x6."')";
            $conn->query($query4);
        }
        $sale_id = 1;
        $query4 = "Select * from epiz_24648743_Retail_Management_System.SalesRecord";
        $result4 = $conn->query($query4);
        if($result4->num_rows > 0)
        {
            $query5 = "Select max(sale_id) as max_sale from epiz_24648743_Retail_Management_System.SalesRecord";
            $result5 = $conn->query($query5);
            $row5 = $result5->fetch_assoc();
            $sale_id = $row5['max_sale'] + 1;
        }
        $sale_date = date('Y-m-d');
        $amt = $_SESSION['bill_total'];
        $emp = $_SESSION['id'];
        $query5 = "insert into epiz_24648743_Retail_Management_System.SalesRecord values(".$sale_id.",'".$sale_date."',".$amt.",'".$emp."',".$cust_id.")";
        $conn->query($query5);
        $item_list = json_decode($_SESSION['prod_arr']);
        foreach($item_list as $i => $j)
        {
            $query6 = "insert into epiz_24648743_Retail_Management_System.Bill_Items values('".$j."',".$sale_id.")";
            if ($conn->query($query6) === TRUE)
            {
            }
            $query = "Select * from epiz_24648743_Retail_Management_System.item where item_id = '".$j."'";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $query7 = "update epiz_24648743_Retail_Management_System.item set qty = ".($row['qty'] - 1)." where item_id = '".$j."'";
            if($conn->query($query7) === TRUE)
            {
            }
        }
        echo "<script>window.location.replace('./Emp_info.php')</script>";
    }
?>
<div class = "container">
    <div class = "customer-form">
        <p align = "center" style = "font-size: 25px;"><b><u>Customer Form</u></b></p>
        <form action = "<?php echo $_SERVER["PHP_SELF"];?>" name = "customer-form" method = "post">
        <table>
            <tr>
                <td>
                <label>
                    <b>First Name : 
                    </b>
                </label>
                </td>
                <td>
                    <input type = "text" name = "cname" required>
                </td>
            </tr>
            <tr>
                <td>
                <label>
                    <b>Last Name :
                    </b>
                </label>
                </td>
                <td>
                    <input type="text" name="lname">
                </td>
            </tr>
            <tr>
                <td>
                <label>
                    <b>Gender :
                    </b>
                </label>
                </td>
                <td>
                    <input type="text" name="gend">
                </td>
            </tr>
            <tr>
                <td>
                <label>
                    <b>Birth Date :
                    </b>
                </label>
                </td>
                <td>
                    <input type="date" name="bdate" required>
                </td>
            </tr>
            <tr>
                <td>
                <label>
                    <b>Phone Number :
                    </b>
                </label>
                </td>
                <td>
                    <input type="text" name="phno" required>
                </td>
            </tr>
            <tr>
                <td>
                <label>
                    <b>Email :
                        <b>
                </label>
                </td>
                <td>
                    <input type="text" name="email">
                </td>
            </tr>
        </table>
        <input type = "submit" name = "pay" value = "Pay">
        </form>
    </div>
    <p align = "center" style = "font-size: 25px;"><b><u>Bill</u></b></p>
    <div class = "item-list">
    <table>
            <tr>
                <th class = "t">Item ID</th>
                <th class = "t">Item Name</th>
                <th class = "t">Marked Price</th>
                <th class = "t">Sale Price</th>
                <th class = "t">Category</th>
            </tr>
    <?php
        $servername = "sql103.epizy.com";
        $username = "epiz_24648743";
        $password = "Yrxkn9lQRqYUtc8";
        // Create connection
        $conn = new mysqli($servername, $username, $password);
        $loc_item_list = json_decode($_SESSION['prod_arr']);
        foreach($loc_item_list as $x => $y)
        {
            $query = "Select * from epiz_24648743_Retail_Management_System.item where item_id = '".$y."'";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $query2 = "select cat_name from epiz_24648743_Retail_Management_System.Category where cat_id = '".$row["cat_id"]."'";
            $result2 = $conn->query($query2);
            $row2 = $result2->fetch_assoc();
            echo "<tr><td class = 't'>".$row["item_id"]."</td><td class = 't'>".$row["item_name"]."</td><td class = 't'>".$row["marked_price"]."</td><td class = 't'>".$row["sale_price"]."</td><td class = 't'>".$row2["cat_name"]."</td></tr>";
        }
    ?>
    </table>
    </div>
    <div>
        <span>Total : Rs. <?php echo $_SESSION['bill_total'];?></span>
    </div>
</div>
</body>
</html>