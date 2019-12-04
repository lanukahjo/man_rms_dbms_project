<!DOCTYPE html>
<html>
<?php
    session_start();
    $_SESSION['prod_arr_purch'] = "";
    $_SESSION['bill_total_purch'] = 0;
    if(isset($_GET['proceed']))
    {
        $_SESSION['prod_arr_purch'] = $_GET['item-list'];
        $_SESSION['bill_total_purch'] = $_GET['total-box'];
        echo "<script>window.location.replace('./PurchaseCheckout.php')</script>";
    }
?>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
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
            padding-right: 7%;
            padding-left: 7%;
            margin: 20px;
            border: 5px;
            border-style: solid;
            border-color: rgb(200, 200, 200);
        }
        .bill-area{
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
            padding-left: 48%;
            padding-top: 10px;
        }
        #id{
            padding-top : 19px;
            display : block;
        }
    </style>
</head>
<body>
    <script>
        var items = [];
        function addToItem(s1,s2,s3,s4,s5,s6,s7){
            var xmlhttp = new XMLHttpRequest();
            var l = "AddProduct.php?q="+s1+"&r="+s2+"&s="+s3+"&t="+s4+"&u="+s5+"&v="+s6+"&w="+s7;
            console.log(l);
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) 
                {
                    var retval = this.responseText;
                    console.log(retval);
                    document.getElementById("item-list").innerHTML = document.getElementById("item-list").innerHTML + "<tr><td>"+s1+"</td><td>"+s2+"</td><td>"+s3+"</td><td>"+s6+"</td></tr>";
                    document.getElementById("item-id").value = "";
                    document.getElementById("item-name").value = "";
                    document.getElementById("cprice").value = "0";
                    document.getElementById("sprice").value = "0";
                    document.getElementById("mprice").value = "0";
                    document.getElementById("qty").value = "0";
                    document.getElementById("catid").value = "";
                    console.log(parseInt(s3)*parseInt(s6));
                    console.log(s3*s6);
                    items.push(s1);
                    document.getElementById("bill_total").value = parseInt(document.getElementById("bill_total").value) + parseInt(s3)*parseInt(s6);
                    document.getElementById('item-l').value = JSON.stringify(items);
                    
                }

            };
            xmlhttp.open("POST", l ,true);
            xmlhttp.send();

        }
    </script>
    <div class = "container">
        <div class = "product-form">
            <p align="center" style="font-size: 25px;">
                <b>
                    <u>Product Form</u>
                </b>
            </p>
            <form name="customer-form" method="post">
                <table>
                    <tr>
                        <td>
                            <label>
                                <b>Item ID :
                                </b>
                            </label>
                        </td>
                        <td>
                            <input type="text" id="item-id" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <b>Item name :
                                </b>
                            </label>
                        </td>
                        <td>
                            <input type="text" id="item-name">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <b>Cost Price :
                                </b>
                            </label>
                        </td>
                        <td>
                            <input type="number" id="cprice" value = "0" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <b>Sale Price :
                                    <b>
                            </label>
                        </td>
                        <td>
                            <input type="number" id="sprice" value = "0" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <b>Marked Price :
                                    <b>
                            </label>
                        </td>
                        <td>
                            <input type="number" id="mprice" value = "0" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <b>Quantity :
                                    <b>
                            </label>
                        </td>
                        <td>
                            <input type="number" id="qty" value = "0" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <b>Category ID :
                                    <b>
                            </label>
                        </td>
                        <td>
                            <input type="text" id = "catid" required>
                        </td>
                    </tr>
                </table>
                </form>
                <input type="submit" name="add" value="Add" onclick = "addToItem(document.getElementById('item-id').value,document.getElementById('item-name').value,document.getElementById('cprice').value,document.getElementById('sprice').value,document.getElementById('mprice').value,document.getElementById('qty').value,document.getElementById('catid').value)">
        </div>
        <div class = "bill-area">
            <table id = 'item-list'>
                <tr>
                    <th>
                        Item ID
                    </th>
                    <th>
                        Item name
                    </th>
                    <th>
                        Cost Price
                    </th>
                    <th>
                        Quantity
                    </th>
                </tr>
            </table>
        </div>
        <form class = "footer" action= "<?php echo $_SERVER["PHP_SELF"];?>" method = "get">
        <span id = "total">Total : Rs. <input type = "number" value = "0" id = "bill_total" name = "total-box"></span>
            <input type ="hidden" name ="item-list" id = "item-l">
            <input type="submit" value="Proceed" name = "proceed">
        </form>
    </div>
</body>
</html>