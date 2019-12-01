<!DOCTYPE html>
<html>
<head>
    <title>Employee Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
        opacity: 0.8;
        }
        #p1{
            font-family: Arial, Helvetica, sans-serif;
            text-align : center;
        }
        #p2,#p3{
            font-family: Arial, Helvetica, sans-serif;
        }
        #welcome{
            font-family: Arial, Helvetica, sans-serif;
        }
        .container {
            padding-top: 80px;
            padding-bottom: 80px;
            padding-right: 30%;
            padding-left: 30%;
            margin: 20px;
            border: 5px;
            border-style: solid;
            border-color: rgb(200, 200, 200);

        }
        .emp-details {
            align-content: center;
            padding-top: 20px;
            padding-bottom: 20px;
            padding-right: 20px;
            padding-left: 20px;
            border: 5px;
            margin: 10px;
            border-style: solid;
            border-color: rgb(200, 200, 200);
        }
    
        .emp-attendance {
            align-content: center;
            padding-top: 20px;
            padding-bottom: 20px;
            padding-right: 20px;
            padding-left: 20px;
            border: 5px;
            margin: 10px;
            border-style: solid;
            border-color: rgb(200, 200, 200);
        }
    
        .tra-page {
            align-content: center;
            padding-top: 20px;
            padding-bottom: 20px;
            padding-right: 20px;
            padding-left: 20px;
            border: 5px;
            margin: 10px;
            border-style: solid;
            border-color: rgb(200, 200, 200);
        }
    </style>
</head>
<body>
<?php
    session_start();
    $i = 10;
    $name = $_SESSION['user'];
    echo "<span id = 'welcome'>Welcome ";
    echo $name; 
    echo "</span>";
?>
    <div class = "container">
        <div class = "emp-details">
            <p id = "p1"><b><u>Employee Details</u></b></p1>
                <?php
                    $servername = "sql103.epizy.com";
                    $username = "epiz_24648743";
                    $password = "Yrxkn9lQRqYUtc8";
                    // Create connection
                    $conn = new mysqli($servername, $username, $password);
                    $id = $_SESSION['id'];
                    $sql = "Select * from epiz_24648743_Retail_Management_System.Employee where emp_id = '".$id."'";
                    if($conn->connect_error)
                    {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    echo "<table>";
                        echo "<tr>";
                            echo "<td>";
                                echo "Employee ID:";
                            echo "</td>";
                            echo "<td>";
                                echo $row["emp_id"];
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td>";
                                echo "First Name:";
                            echo "</td>";
                            echo "<td>";
                                echo $row["fname"];
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td>";
                                echo "Last Name:";
                            echo "</td>";
                            echo "<td>";
                                echo $row["lname"];
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td>";
                                echo "Phone:";
                            echo "</td>";
                            echo "<td>";
                                echo $row["phone_no"];
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td>";
                                echo "Email:";
                            echo "</td>";
                            echo "<td>";
                                echo $row["email_id"];
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td>";
                                echo "Birth Date:";
                            echo "</td>";
                            echo "<td>";
                                echo $row["birth_date"];
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td>";
                                echo "Hire Date:";
                            echo "</td>";
                            echo "<td>";
                                echo $row["hire_date"];
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td>";
                                echo "Position:";
                            echo "</td>";
                            echo "<td>";
                                echo $row["pos"];
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td>";
                                echo "Gender:";
                            echo "</td>";
                            echo "<td>";
                                echo $row["gender"];
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td>";
                                echo "Salary:";
                            echo "</td>";
                            echo "<td>";
                                echo $row["salary"];
                            echo "</td>";
                        echo "</tr>";
                    echo "</table>";
                ?>
        </div>
        <div class = "emp-attendance">
            <form action = "Attendance.php" method = "post">
            <p id = "p3">Click here to mark Attendance:.....</br></p>
            <button type = "submit">Mark Attendance</button>
            </form>
        </div>
<?php
    $servername = "sql103.epizy.com";
                    $username = "epiz_24648743";
                    $password = "Yrxkn9lQRqYUtc8";
                    // Create connection
                    $conn = new mysqli($servername, $username, $password);
    $sql = "Select login_type from epiz_24648743_Retail_Management_System.LoginCredentials where login_id = '".$_SESSION["login_id"]."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if($row["login_type"] == "Cash")
    {
        echo "<div class = 'tra-page'>
                <form action = 'Sales.php'>
                <p id = 'p3'>
                </p>
                <button type = 'submit'>Go to Sales Page</button>
                </form>
            </div>";
    }
    if($row["login_type"] == "Purch")
    {
        echo "<div class = 'tra-page'>
                <form action = 'Purchase.php'>
                <p id = 'p3'>
                </p>
                <button type = 'submit'>Go to Purchase Page</button>
                </form>
            </div>";
    }
    if($row["login_type"] == "Admin")
    {
        echo "<div class = 'tra-page'>
                <form action = 'Admin.php'>
                <p id = 'p3'>
                </p>
                <button type = 'submit'>Go to Admin Page</button>
                </form>
            </div>";
    }
?>
    </div>
</body>
</html>
