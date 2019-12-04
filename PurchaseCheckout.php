<!DOCTYPE html>
<html>
<head>
<?php
    session_start();
?>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Distributor Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        input[type=text]{
            width: 900px;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box
        }
        input[type=submit]{
            width: 90px;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box
        }
        input[type=submit]:hover{
            opacity: 0.8;
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
        .container{
            padding-top: 40px;
            padding-bottom: 80px;
            padding-right: 22%;
            padding-left: 11%;
            margin: 20px;
            border: 5px;
            border-style: solid;
            border-color: rgb(200, 200, 200);
        }
    </style>
</head>
<body>
<?php
    if(isset($_POST['pay']))
    {
        $x1 = $_POST["dist-name"];
        $x2 = $_POST["phno"];
        $x3 = $_POST["email"];
        $servername = "sql103.epizy.com";
        $username = "epiz_24648743";
        $password = "Yrxkn9lQRqYUtc8";
        // Create connection
        $conn = new mysqli($servername, $username, $password);
        $dist_id = 1;
        $query1 = "Select * from epiz_24648743_Retail_Management_System.Distributor where phone_no = '".$x2."'";
        $result1 = $conn->query($query1);
        if($result1->num_rows > 0)
        {
            $row1 = $result1->fetch_assoc();
            $dist_id = $row1['dist_id'];
        }
        else
        {
            $query2 = "Select * from epiz_24648743_Retail_Management_System.Distributor";
            $result2 = $conn->query($query2);
            if($result2->num_rows > 0)
            {
                echo "6<br>";
                $query3 = "Select max(dist_id) as max_dist from epiz_24648743_Retail_Management_System.Distributor";
                $result3 = $conn->query($query3);
                $row3 = $result3->fetch_assoc();
                $dist_id = $row3['max_dist'] + 1;
            }
            $query4 = "insert into epiz_24648743_Retail_Management_System.Distributor values(".$dist_id.",'".$x3."','".$x2."','".$x1."')";
            $conn->query($query4);
        }
        $purchase_id = 1;
        $query4 = "Select * from epiz_24648743_Retail_Management_System.PurchaseRecord";
        $result4 = $conn->query($query4);
        if($result4->num_rows > 0)
        {
            $query5 = "Select max(purchase_id) as max_purch from epiz_24648743_Retail_Management_System.PurchaseRecord";
            $result5 = $conn->query($query5);
            $row5 = $result5->fetch_assoc();
            $purchase_id = $row5['max_purch'] + 1;
        }
        $purchase_date = date('Y-m-d');
        $amt = $_SESSION['bill_total_purch'];
        $emp = $_SESSION['id'];
        $query5 = "insert into epiz_24648743_Retail_Management_System.PurchaseRecord values(".$purchase_id.",'".$purchase_date."',".$amt.",'".$emp."',".$dist_id.")";
        $conn->query($query5);
        $item_list = json_decode($_SESSION['prod_arr_purch']);
        foreach($item_list as $i => $j)
        {
            $query6 = "insert into epiz_24648743_Retail_Management_System.Purchase_Items values('".$j."',".$purchase_id.")";
            echo $query6;
            if ($conn->query($query6) === TRUE)
            {
            }
        }
        echo "<script>window.location.replace('./Emp_info.php')</script>";
    }
?>
    <div class = "container">
        <p align="center" style="font-size: 25px;">
            <b>
                <u>Distributor Form</u>
            </b>
        </p>
        <div class = "distributor-form">
            <form name="customer-form" method="post" action = "<?php echo $_SERVER["PHP_SELF"];?>">
                <table>
                    <tr>
                        <td>
                            <label>
                                <b>Distributor Name :
                                </b>
                            </label>
                        </td>
                        <td>
                            <input type="text" name = "dist-name" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <b>Phone Number:
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
                                <b>Email:
                                </b>
                            </label>
                        </td>
                        <td>
                            <input type="text" name = "email" required>
                        </td>
                    </tr>
                </table>
                <input type= "submit" value = "Complete" name = "pay">
            </form>
        </div>
    </div>
</body>
</html>