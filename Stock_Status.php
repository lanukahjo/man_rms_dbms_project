<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Stock Status</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        form{
            padding-left: 48%;
            padding-top: 10px;

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
            padding-right: 4%;
            padding-left: 4%;
            margin: 20px;
            border: 5px;
            border-style: solid;
            border-color: rgb(200, 200, 200);
        }
        .stock-details{
            padding-top: 10px;
            padding-bottom: 10px;
            height : 400px;
            border: 2px;
            border-style: solid;
            border-color: rgb(200, 200, 200);
            resize: vertical;
            overflow : scroll;
        }
    </style>
</head>
<body>
    <div class = "container">
        <p align = "center" style = "font-size: 25px;">
            Stock Details
        </p>
        <div class = "stock-details">
            <table>
                <tr>
                    <th>Item Id</th>
                    <th>Item name</th>
                    <th>Manufacture Date</th>
                    <th>Expiry Date</th>
                    <th>Cost Price</th>
                    <th>Selling Price</th>
                    <th>Marked Price</th>
                    <th>Category</th>
                    <th>Quantity</th>
                </tr>
                <?php
                    $servername = "sql103.epizy.com";
                    $username = "epiz_24648743";
                    $password = "Yrxkn9lQRqYUtc8";
                    // Create connection
                    $conn = new mysqli($servername, $username, $password);
                    $query = "Select * from epiz_24648743_Retail_Management_System.item i,epiz_24648743_Retail_Management_System.Category j where i.cat_id = j.cat_id";
                    $result = $conn->query($query);
                    if($result->num_rows > 0)
                    {
                        while($row = $result->fetch_assoc()) 
                        {
                            echo "<tr>";
                                echo "<td>";
                                    echo $row['item_id'];
                                echo "</td>";
                                echo "<td>";
                                    echo $row['item_name'];
                                echo "</td>";
                                echo "<td>";
                                    echo $row['manufacture_date'];
                                echo "</td>";
                                echo "<td>";
                                    echo $row['expiry_date'];
                                echo "</td>";
                                echo "<td>";
                                    echo $row['cost_price'];
                                echo "</td>";
                                echo "<td>";
                                    echo $row['sale_price'];
                                echo "</td>";
                                echo "<td>";
                                    echo $row['marked_price'];
                                echo "</td>";
                                echo "<td>";
                                    echo $row['cat_name'];
                                echo "</td>";
                                echo "<td>";
                                    echo $row['qty'];
                                echo "</td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </table>
        </div>
        <form action = "Purchase.php">
            <input type="submit" value="Proceed">
        </form>
    </div>
</body>
</html>