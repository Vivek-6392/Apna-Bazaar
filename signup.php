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
    $Username = $_POST['Username'];
    $mobile_or_email = $_POST['mobile_or_email'];
    $Password = $_POST['Password'];
    // $encrypt_password=password_hash($Password,PASSWORD_DEFAULT);
  

    $sql = "INSERT INTO signup (Username, mobile_or_email, Password) 
            VALUES ('$Username', '$mobile_or_email', '$Password')";
try{
    mysqli_query($conn, $sql);
    header("Location: index.php");
}
catch( mysqli_sql_exception){
    echo "This username is taken. Try new!";
}
}

mysqli_close($conn);
?>