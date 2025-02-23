<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the JavaScript
    $totalPrice = $_POST['totalPrice'];
    $productNames = $_POST['productNames'];

    // Insert data into the database
    $sql = "INSERT INTO cart (total_price, product_names) VALUES ('$totalPrice', '$productNames')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
