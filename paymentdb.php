<?php
$db_server = "localhost";
$db_user = "root"; 
$db_pass= ""; 
$db_name= "project";

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $billingAddress = $_POST['billingAddress'];
    $productNames =  $_POST['productNames'];
    $totalPrice =  $_POST['totalPrice'];
    $customerName =  $_POST['customerName'];
    $customerMob =  $_POST['customerMob'];

  

    $sql = "INSERT INTO payment (customerName, customerMob, totalPrice, productNames, billingAddress) 
            VALUES ('$customerName', '$customerMob', '$totalPrice', '$productNames', '$billingAddress')";
    mysqli_query($conn, $sql);
  
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apna Bazaar - Payment success</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        i {
            padding: 50px;
            color: green;
            font-size: 60px;
            margin-top: 50px;
            margin-bottom: 50px;
            animation: btn 1s infinite;
        }

        #success {
            height: 200px;
            width: 1000px;
            background-color: green;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            box-shadow: 0 0 50px black;
            border-bottom: 2px solid orange;
            
        }

        a {
            font-size: 20px;
            text-decoration: none;
        }

        #button {
            background-color: orange;
            border: none;
            margin-top: 100px;
            padding: 20px;
            border-radius: 12px;

        }

        @keyframes btn {
            0% {
                scale: 0;
            }

            50% {
                scale: 1;
            }

            100% {
                scale: 0;
            }
        }

      
    </style>
</head>

<body>
       
    <center><i class="fa-sharp fa-solid fa-circle-check"></i></center>
    <center>
        <div id="success">
            <center>Order placed successfully!!</center>
        </div>
    </center>
</body>

<center><button id="button"><a href="index.php">Continue</a></button></center>

</html>
