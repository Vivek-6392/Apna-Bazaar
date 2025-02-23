
<?php
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




// Prepare SQL statement
$sql = "INSERT INTO ContactUs (name, email, message) VALUES ('$name', '$email', '$message')";

// Execute SQL statement
if ($conn->query($sql) === TRUE) {
    $conn->close();
    header('Location: index.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();

?>

