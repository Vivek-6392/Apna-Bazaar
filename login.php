<?php
session_start(); // Start session for storing login state
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "project";

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    
    // Validate Username and Password (you might want to add more validation)
    if (!empty($Username) && !empty($Password)) {
        $sql = "SELECT * FROM signup WHERE Username = '$Username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($Password == $row['Password']) {
                $_SESSION['Username'] = $Username;
                // After successful login, retrieve the username from the database
                $loggedInUsername = $row['Username']; // Assuming you fetched the username from the database

                header('Location: index.php');
            } else {
                $error_message = "Incorrect Username or Password";
                echo $error_message . "<br>";
            }
        } else {
            $error_message = "User not found";
            echo $error_message;
        }
    } else {
        $error_message = "Please enter both Username and Password";
        echo $error_message;
    }
}
