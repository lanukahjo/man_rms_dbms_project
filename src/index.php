<html>
<head>
<style>
<title>Man_Rms</title>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 5px solid rgb(200,200,200);}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

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

.container {
  padding-top: 200px;
  padding-bottom: 200px;
  padding-right : 400px;
  padding-left  : 400px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
</style>
</head>
<body>

<?php
if (session_id() == "")
    session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $user = $_POST['uname'];
    $_SESSION['login_id'] = $user;
    $passwod = $_POST['psw'];
    $servername = "sql103.epizy.com";
    $username = "epiz_24648743";
    $password = "Yrxkn9lQRqYUtc8";
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    $_SESSION['sqlconn'] = $conn;
    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "Select login_type,emp_id,passwd from epiz_24648743_Retail_Management_System.LoginCredentials where login_id = '".$user."'";
    $result1 = $conn->query($sql);
    if($result1->num_rows > 0)
    {
        $row = $result1->fetch_assoc();
        if($row["passwd"] == $passwod)
        {
            $sql2 = "Select fname,lname from epiz_24648743_Retail_Management_System.Employee where emp_id = '".$row["emp_id"]."'";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $_SESSION['user'] = $row2["fname"]." ".$row2["lname"];
            $_SESSION['id'] = $row["emp_id"];
            echo "<script>window.location.replace('./Emp_info.php')</script>";
        }
        else
        {
            echo "Incorrect Password</br>";
        }
    }
    else
    {
        echo "Not Valid Credentials</br>";
    }
}
?>
<form method = "post" action = "<?php echo $_SERVER["PHP_SELF"];?>">
  <div class="container">
    <label for="uname"><b>Username</b><label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
        
    <button type="submit">Login</button>
  </div>

  <div class="container" style="float:left">
    Here
  </div>
  <div class="container" style="background:#f1f1f1">
    Here
  </div>
</form>
</body>
</html>
