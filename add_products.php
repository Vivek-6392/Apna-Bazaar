<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "Project");

if ($con == false) {
    die("connection error:" . mysqli_connect_error());
}

// Check if delete button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $Id = $_POST['Id'];
    // Delete the product from the database
    $query = mysqli_query($con, "DELETE FROM products WHERE Id = '$Id'");
    if ($query) {
        $_SESSION['success'] = "Product deleted successfully";
    } else {
        $_SESSION['error'] = "Error deleting product";
    }
    // Redirect to prevent form resubmission
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
    exit();
}

// Check if form is submitted for uploading a new product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upload'])) {
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'images/' . $file_name;

    // Move uploaded image to the 'images' folder
    if (move_uploaded_file($tempname, $folder)) {
        // Insert product details into the database
        $query = mysqli_query($con, "INSERT INTO products (productName, productPrice, productImage) VALUES ('$productName', '$productPrice', '$file_name')");
        if ($query) {
            $_SESSION['success'] = "Product uploaded successfully";
        } else {
            $_SESSION['error'] = "Error uploading product";
        }
    } else {
        $_SESSION['error'] = "Error uploading image";
    }

    // Redirect to prevent form resubmission
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Product</title>
    <style>
        html,
        body {
            width: 100%;
            margin: 0;
            padding: 0;
    
        }

        .body {
            display: flex;
            margin-top: 10px;
        }

        .form {
           
            width: 20%;
         
          
            
        }

        img {
            height: 200px;
            width: 200px;
        }

        .product1 {
            height: 100%;
            width: 80%;
            background-color: white;
        }
        form{
            margin-left: 10px;
        }
        a {
            text-decoration: none;
            color: black;
            padding: 2px;

        }

        .product3 form {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            gap: 10px;

        }
        h1{
            background-color: blueviolet;
            margin: 0;
            padding: 0;
            height:50px;
        }
        img {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
<center><h1>Add Your Products Here</h1></center>
    <?php if (isset($_SESSION['success'])) : ?>
        <h2><?php echo $_SESSION['success']; ?></h2>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])) : ?>
        <h2><?php echo $_SESSION['error']; ?></h2>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
 
    <div class="body">
    <div class="form">
        <form method="POST" enctype="multipart/form-data">
            <label>Upload product image: </label><br><br>
            <input type="file" name="image" id="productImage" required><br><br>
            <label>Product Name: </label>
            <input type="text" name="productName" required><br><br>
            <label>Product Price: </label>
            <input type="number" name="productPrice" required><br><br>
            <input type="submit" value="Upload" name="upload" class="upload">
            <button id="home"><a href="index.php">Home</a></button><br><br>
        </form><br>

    </div>
    <div class="product1">
        <?php
        $res = mysqli_query($con, "SELECT * FROM products");
        while ($row = mysqli_fetch_assoc($res)) {
            echo
            '<div class="product3">
                <form method="POST">
                    <input type="hidden" name="Id" value="' . $row['Id'] . '">
                    <img src="images/' . $row['productImage'] . '" alt=""><br>
                    <p>Name: ' . $row['productName'] . '</p>
                    <p>Price: ' . $row['productPrice'] . '</p>
                    <input type="submit" value="Delete" name="delete">
                </form>
            </div>';
        };
        ?>
    </div>
    </div>
</body>

</html>