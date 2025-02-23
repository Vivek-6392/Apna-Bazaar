<?php
session_start();

// Retrieve product names from URL parameter
$productNames = isset($_GET['productNames']) ? $_GET['productNames'] : '';
$productNamesArray = explode(';', $productNames); // Split the product names into an array

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form - Apna Bazaar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSY499qfskNiRDlVcw6ILdx6P-52I84lZaAjTrL8XWvdyg01HYxWkukV4PiFWnkcBxFEtA&usqp=CAU" alt="">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 0 400px black;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        textarea {
            background-color: #CAEFEF;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        body {
            background-image: url(https://png.pngtree.com/background/20220725/original/pngtree-online-payment-protection-system-picture-image_1759927.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .container {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <nav>
        <div class="navbar">
            <div><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSY499qfskNiRDlVcw6ILdx6P-52I84lZaAjTrL8XWvdyg01HYxWkukV4PiFWnkcBxFEtA&usqp=CAU" alt="" title="Apna Bazar" style="height: 50px;width: 50px; border-radius: 50%;"></a></div>
            <div style="border-bottom: 5px solid orange;"><a href="index.php">Home</a></div>
            <div class="dropdown">
                <span>Shop</span>
                <div class="dropdown-content">
                    <a href="#clothes">Clothes</a>
                    <a href="#electronics">Electronics</a>
                    <a href="#stationaries">Stationaries</a>
                    <a href="#nutrition">Nutrition</a>
                </div>
            </div>
            <div><a href="aboutus.php">About us</a></div>

            <div><a href="contactus.php">Contact Us</a></div>
            <div class="dropdown-center">
                <!-- <span id="loggedInUsername">
                    <i class="fa-solid fa-user">&nbsp;<span id="userName">User</span></i>
                </span> -->
                <button class="btn btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user">&nbsp;<span id="userName"> <?php
                                                                            if (isset($_SESSION['Username'])) {
                                                                                echo $_SESSION['Username'];
                                                                            } else {
                                                                                echo "User";
                                                                            }
                                                                            ?></span></i>
                </button>
                <ul class="dropdown-menu">
                    <li><button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: white; margin-left: 40px;">
                            Login
                        </button></li>
                    <li>
                        <form action="logout.php">
                            <input type="submit" value="Logout" style="background-color: white; margin-left: 0px;">
                        </form>
                    </li>
                    <li><button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#signupModal" style="background-color: white; margin-left: 40px;">
                            Sign Up
                        </button>
                    </li>
                </ul>

            </div>



            <div>
                <button class="btn btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="background-color: transparent;border: none;">
                    <i class="fas fa-shopping-cart" title="Cart"><span id="items">0</span></i>
                    
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasRightLabel">Shopping Cart</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body" id="cart-container">

                    </div>
                </div>
            </div>
            <div class="admin">
                <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#adminloginModal" style="padding: 0px; background-color: blue; border-radius: 50%;height:50px;width:50px;">
                    <img src="images/admin.png" title="Admin" alt="Admin" id="admin" style="height: 40px; width: 40px;">
                </button>
            </div>
        </div>
    </nav>
    <!-- admin profile login -->
    <div class="modal fade" id="adminloginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-15" id="exampleModalLabel">Login For Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="adminlogin.php" method="post">
                        <label for="">Username</label><br>
                        <input type="text" id="name1" name="adminUsername"><br>
                        <label for="">Password</label><br>
                        <input type="password" id="password1" name="adminPassword"><br><br>
                        <p id="message"></p>
                        <button id="submit1">Login</button>

                    </form>

                </div>

            </div>
        </div>
    </div>


    <!-- Login Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-15" id="exampleModalLabel">Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="login.php" method="post">
                        <label for="">Username</label><br>
                        <input type="text" id="name1" name="Username"><br>
                        <label for="">Password</label><br>
                        <input type="password" id="password1" name="Password"><br><br>
                        <p id="message"></p>
                        <button id="submit1">Login</button>

                    </form>
                    <p>New user? </p>
                    <button class="submit" type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#signupModal">
                        Sign up
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- Sign up Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-15" id="exampleModalLabel">Create Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="signup.php" method="post">
                        <!-- -->
                        <label for="username">Your name</label><br>
                        <input type="text" placeholder="First and last name" id="name" name="Username"><br><br>
                        <label for="mobile-email">Mobile number or email</label><br>
                        <input type="text" id="number-email" name="mobile_or_email"><br><br>
                        <label for="password">Password</label><br>
                        <input type="password" id="password" name="Password"><br>
                        <p><i style="color: rgb(0 179 255);">i &nbsp;</i>Passwords must be at least 6 characters.</p>
                        <label for="password">Re-enter password</label><br>
                        <input type="password" id="re-enter-password" name="re_enter_password"><br><br>
                        <p id="success"></p>
                        <div id="checkbox"> <input type="checkbox" name="tick" id="tick">
                            <p> By creating an account you agree to the terms of use and have read our Privacy Policy.
                            </p>
                        </div>

                        <button id="submit2">Sign Up</button>


                    </form>
                    <p>Already have account? </p>
                    <button class="submit" type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Login
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <h2>Payment Form</h2>
        <!-- Display final amount received from another page -->
        <label for="totalPrice">Total Price:</label>
        <input type="text" id="totalPrice" name="totalPrice" readonly>

        <!-- Display product names -->
        <div class="form-group">
            <label for="productNames">Product Names:</label>
            <textarea id="productNames" name="productNames" readonly><?php echo implode(", ", $productNamesArray); ?></textarea>
        </div>

        <form id="paymentForm" action="paymentdb.php" method="post">
            <input type="hidden" id="totalPriceHidden" name="totalPrice" value="">
            <input type="hidden" id="productNamesHidden" name="productNames" value="<?php echo $productNames; ?>">

            <div class="form-group">
                <label for="customerName">Name:</label>
                <input type="text" id="customerName" name="customerName" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label for="customerMob">Contact Number:</label>
                <input type="number" id="customerMob" name="customerMob" placeholder="9856321340" required>
            </div>

            <div class="form-group">
                <label for="billingAddress">Billing Address:</label>
                <input type="text" id="billingAddress" name="billingAddress" placeholder="Enter billing address" required>
            </div>
            <input type="submit" id="submit" value="Submit Payment">
        </form>
    </div>

    <div class="footer" style="padding: 9px; margin-top: 16px;">
        <p>
            <a href="#">Condition of use & sale</a>
            <a href="#">Privacy Notice</a>
            <a href="#">Interest-Based Ads</a>
        </p>
        <p>&copy; 2005-2024 V-Cart.com Inc. or its affiliates</p>
        <p>
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-whatsapp"></i>
            <i class="fa-brands fa-twitter"></i>
        </p>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function() {
    // Retrieve total price from URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const totalPriceParam = urlParams.get('totalPrice');

    // Convert totalPriceParam to float
    const totalPriceFloat = parseFloat(totalPriceParam);

    // Populate the payment form with the total price
    const totalPriceInput = document.getElementById('totalPrice');
    if (totalPriceInput) {
        totalPriceInput.value = totalPriceFloat.toFixed(2);
    } else {
        console.log('Element with ID "totalPrice" not found');
    }

    // Set the value of totalPriceHidden input field
    const totalPriceHiddenInput = document.getElementById('totalPriceHidden');
    if (totalPriceHiddenInput) {
        totalPriceHiddenInput.value = totalPriceFloat.toFixed(2);
    } else {
        console.log('Element with ID "totalPriceHidden" not found');
    }
});

// Add an event listener to the form submission
const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener('submit', function(event) {
    // Retrieve product names from the hidden input field
    const productNamesHiddenInput = document.getElementById('productNamesHidden');
    const productNames = productNamesHiddenInput.value;

    // Append product names to the form data
    const formData = new FormData(paymentForm);
    formData.append('productNames', productNames);

    // Replace the form data with the updated one
    event.formData = formData;
});


        let submit = document.querySelector('#submit');
        submit.addEventListener('click', (e) => {
            let customerName = document.querySelector('#customerName');
            let customerMob = document.querySelector('#customerMob');

            let address = document.querySelector('#billingAddress');
            if (!/^[0-9]{10}$/.test(customerMob.value)) {
                alert('Contact Number should be 10 digits.');
                e.preventDefault();
            }
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>