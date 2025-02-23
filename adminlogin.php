<?php

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "project";

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminUsername = $_POST['adminUsername'];
    $adminPassword = $_POST['adminPassword'];

    // Validate adminUsername and adminPassword (you might want to add more validation)
    if (!empty($adminUsername) && !empty($adminPassword)) {
        $sql = "SELECT * FROM admin WHERE adminUsername = '$adminUsername'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($adminPassword == $row['adminPassword']) {
                $_SESSION['adminUsername'] = $adminUsername;
                // After successful login, retrieve the adminUsername from the database
                $loggedInadminUsername = $row['adminUsername']; // Assuming you fetched the adminUsername from the database

                header('Location: add_products.php');

            } else {
                $error_message = "Incorrect adminUsername or adminPassword";
                echo $error_message . "<br>";
            }
        } else {
            $error_message = "User not found";
            echo $error_message;
        }
    } else {
        $error_message = "Please enter both adminUsername and adminPassword";
        echo $error_message;
    }
}
?>