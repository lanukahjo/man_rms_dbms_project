<!DOCTYPE html>
<html>
<?php
    session_start();
    $_SESSION['prod_arr'] = "";
    $_SESSION['bill_total'] = 0;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $_SESSION['prod_arr'] = $_POST['item-list'];
        $_SESSION['bill_total'] = $_POST['total-box'];
        echo "<script>window.location.replace('Checkout.php')</script>";
    }
?>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sales Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
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
        #checkout-box
        {
            padding: 12px 20px;
            margin: 8px 0;
            display: inline;
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
        tr:nth-child(even) {
            background-color: #dddddd;
        }
        .container{
            padding-top: 80px;
            padding-bottom: 80px;
            padding-right: 5%;
            padding-left: 10%;
            margin: 20px;
            border: 5px;
            border-style: solid;
            border-color: rgb(200, 200, 200);
        }
        .entry-box{

        }
        .cust-details{

        }
        .bill-area{
            padding-top: 10px;
            padding-bottom: 10px;
            width : 990px;
            height : 400px;
            border: 2px;
            border-style: solid;
            border-color: rgb(200, 200, 200);
            resize: vertical;
            overflow : scroll;
        }
        .footer{
            padding-top: : 40px;
        }
    </style>
</head>
<body>
    <script>
        var items = [];
        function readProdDetails(str)
        {
            console.log(str);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    if(this.responseText !== "")
                    {
                        document.getElementById('sp2').innerHTML = "";
                        var x = document.getElementById("bill-table").innerHTML;
                        var y = JSON.parse(this.responseText);
                        console.log(y);
                        //document.getElementById('bill-table').innerHTML = "<tr><td>"+y.item_id+"</td><td>"y.item_name"</td><td>".$row["marked_price"]."</td><td>".$row["sale_price"]."</td><td>".$row2["cat_name"]."</td></tr>";
                        document.getElementById('bill-table').innerHTML = x + "<tr><td>" + y.item_id + "</td><td>" + y.item_name + "</td><td>" + y.marked_price + "</td><td>" + y.sale_price + "</td><td>" + y.cat_name + "</td></tr>";
                        var z = parseFloat(document.getElementById('checkout-box').value);
                        document.getElementById('checkout-box').value = z + parseFloat(y.sale_price);
                        items.push(y.item_id);
                        console.log(items);
                        console.log(items[items.length-1]);
                        console.log(JSON.stringify(items));
                        document.getElementById('item-l').value = JSON.stringify(items);
                     }
                    else
                    {
                        document.getElementById('sp2').innerHTML = "No Such Product";
                    }
                }
            };
            xmlhttp.open("GET","ProductQuery.php?q="+str,true);
            xmlhttp.send();
        }
    </script>
    <div class = "container">
        <div class = "cust-details">
        </div>
        <div class = "entry-box">
            <span>
                <input id = "inp1" type = "text" name = "product"> 
                <input type = "submit" value="Add" onclick = "readProdDetails(document.getElementById('inp1').value)">
            </span>
        </div>
        <div id = "sp2"></div>
        <div class= "bill-area">
            <table id = "bill-table">
            <tr>
                <th>Item ID</th>
                <th>Item Name</th>
                <th>Marked Price</th>
                <th>Sale Price</th>
                <th>Category</th>
            </tr>
            </table>
        </div>
        <div class = "footer">
            <form action = "<?php echo $_SERVER["PHP_SELF"];?>" method = "post" name = "Checkout">
            <span>Total Amount till now : Rs.</span><span><input type = "number" value = "0" name = "total-box" id = "checkout-box"></span></br>
            <input type = "hidden" name = "item-list" id = "item-l">
            <span><input type = "submit" value = "Checkout" name = "checkout"></span>
            </form>
        </div>
    </div>
</body>
</html>