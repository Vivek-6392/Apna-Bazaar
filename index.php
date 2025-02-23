<?php
session_start();
?>

<?php

// Establish database connection
$con = mysqli_connect("localhost", "root", "", "Project");

if ($con == false) {
    die("connection error:" . mysqli_connect_error());
}

// Fetch product data from the database
$res = mysqli_query($con, "SELECT * FROM products");
?>
<!DOCTYPE php>
<php lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0">
        <title>Apna Bazaar</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSY499qfskNiRDlVcw6ILdx6P-52I84lZaAjTrL8XWvdyg01HYxWkukV4PiFWnkcBxFEtA&usqp=CAU" alt="">
        <link rel="stylesheet" href="style.css">
        <style>
            #new:hover {
                box-shadow: 0 0 15px grey;

            }
            /* #username{
                font-weight:bold;
                font-size: 20px;
                text-transform: uppercase;
            } */
            #clothes {
                border-radius: 5px;
                display: flex;
                flex-wrap: wrap;
                gap: 35px;
                justify-content: flex-start;
                margin-left: 30px;
            }
        </style>
    </head>

    <body>
        <div id="top"></div>
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
               
                            <!-- <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#profileModal" style="background-color: white; margin-left: 40px;">
                            <i class="fa-solid fa-user">&nbsp;</i>
                            </button> -->
                            
                    <button class="btn btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user">&nbsp;<span id="userName"> <?php if (isset($_SESSION['Username'])) {
                                                                                    echo $_SESSION['Username'];
                                                                                } else {
                                                                                    echo "User";
                                                                                } ?></span></i>
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



                <!-- <div> <button class="btn btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="background-color: transparent;border: none;"><i class="fa-solid fa-cart-shopping" title="Cart"><span id="items">0</span></i></button>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasRightLabel">Shopping Cart</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="info">
                                <p>Product</p>
                                <p>Price</p>
                                
                            </div>

                        </div>
                    </div>
                </div> -->

                <!-- <div>
                    <button class="btn btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="background-color: transparent;border: none;">
                        <i class="fa-solid fa-cart-shopping" title="Cart"><span id="items">0</span></i>
                    </button>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasRightLabel">Shopping Cart</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body" id="cart-container">
                            <div class="info">
                                <p>Product</p>
                                <p>Price</p>
                                
                            </div>
                        </div>
                    </div>
                </div> -->

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
                            <!-- Cart items will be displayed here -->
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


        <!-- Admin Sign up Modal -->
        <!-- <div class="modal fade" id="adminsignupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-15" id="exampleModalLabel">Register as Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="signup.php" method="post">
                      
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
                    <button class="submit" type="button" class="btn btn" data-bs-toggle="modal"
                        data-bs-target="#adminloginModal">
                        Login
                    </button>
                </div>

            </div>
        </div>
    </div> -->

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
                            <p id="success" name="message"></p>
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
        <!-- profile modal -->
        <!-- <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-15" id="exampleModalLabel">User Profile</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Username: <?php echo $_SESSION['Username'] ?></p>
                        <p>Contact: <?php echo $_SESSION['mobile_or_email'] ?></p>

                    </div>

                </div>
            </div>
        </div> -->

        <!--slider -->
        <div class="slider" id="slider">
            <a href="#" id="prev-btn">
                < </a>
                    <a href="#" id="next-btn">></a>
                    <!-- <img src="https://source.unsplash.com/1688x350/?clotheselectronicsstationary"  alt=""> -->

                    <img src="./images/header1.jpg" alt="header1" title="header1">
                    <img src="./images/header2.jpg" alt="">
                    <img src="./images/header3.jpg" alt="">
                    <img src="./images/header4.jpg" alt="">
                    <img src="./images/header5.jpg" alt="">
                    <img src="./images/header6.jpg" alt="">
        </div>
        <!-- products-->
        <div class="products">
            <h1 class="type" id="clothes">Clothes</h1>
            <div class="clothes">
                <div>
                    <img src="https://m.media-amazon.com/images/I/815qEJOhhvL._AC_UL480_QL65_T2F_.jpg" alt=""><br>
                    <center>
                        <p>₹99</p>
                        <p id="name">Black T-Shirt</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/51RJRQPnuDL._AC_UL480_QL65_T2F_.jpg" alt=""><br>
                    <center>
                        <p>₹249</p>
                        <p id="name">Green Top</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/51aPaivXlRL._AC_UL480_QL65_T2F_.jpg" alt=""><br>
                    <center>
                        <p>₹499</p>
                        <p id="name">T-Shirts</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/71HuLCyNNhL._AC_UL480_QL65_T2F_.jpg" alt=""><br>
                    <center>
                        <p>₹399</p>
                        <p id="name">Plain Black</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/91ceS1gCeaL._AC_UL480_QL65_T2F_.jpg" alt=""><br>
                    <center>
                        <p>₹499</p>
                        <p id="name">Cheks Shirt</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <!-- <div>
                <img src="https://m.media-amazon.com/images/I/71zwwaD9fEL._AC_UL480_QL65_T2F_.jpg" alt=""><br>
                <center>
                    <p>$500</p>
                </center>
                <button class="add-to-cart">Add to Cart</button>
            </div> -->
                <div>
                    <img src="https://m.media-amazon.com/images/I/41j2wUsRTnL._AC_UL480_FMwebp_QL65_.jpg" alt=""><br>
                    <center>
                        <p>₹499</p>
                        <p id="name">Plain Shirt</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
            </div>

            <div class="clothes">

                <div>
                    <img src="https://m.media-amazon.com/images/I/81431NT8y4L._AC_UL480_QL65_T2F_.jpg" alt=""><br>
                    <center>
                        <p>₹499</p>
                        <p id="name">Slim-Fit</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/81+oQBvBR-L._AC_UL480_QL65_T2F_.jpg" alt=""><br>
                    <center>
                        <p>₹699</p>
                        <p id="name">Shirt</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/71fXcMfJilL._AC_UL480_FMwebp_QL65_.jpg" alt=""><br>
                    <center>
                        <p>₹549</p>
                        <p id="name">Fancy Shirt</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/61ocmRfLe7L._AC_UL480_FMwebp_QL65_.jpg" alt=""><br>
                    <center>
                        <p>₹399</p>
                        <p id="name">White shirt (women)</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/71u7z-fRi4L._AC_UL480_FMwebp_QL65_.jpg" alt=""><br>
                    <center>
                        <p>₹249</p>
                        <p id="name">Women T-Shirt</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <!-- <div>
                <img src="https://m.media-amazon.com/images/I/612o-F8LZaL._AC_UL480_FMwebp_QL65_.jpg" alt=""><br>
                <center>
                    <p>$500</p>
                </center>
                <button class="add-to-cart">Add to Cart</button>
            </div> -->
                <div>
                    <img src="https://m.media-amazon.com/images/I/61aRrnw5HFL._AC_UL480_FMwebp_QL65_.jpg" alt=""><br>
                    <center>
                        <p>₹99</p>
                        <p id="name">Black T-Shirt</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
            </div>
            <h1 class="type" id="electronics">Electronics</h1>
            <div class="electronics">
                <div>
                    <img src="https://m.media-amazon.com/images/I/61w1OAQYekL._AC_UY327_FMwebp_QL65_.jpg" alt="">
                    <center>
                        <p>₹42000</p>
                        <p id="name">DELL Laptop</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/618d5bS2lUL._AC_UY327_FMwebp_QL65_.jpg" alt="">
                    <center>
                        <p>₹130000</p>
                        <p id="name">Macbook</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/71xb2xkN5qL._AC_UY327_FMwebp_QL65_.jpg" alt="">
                    <center>
                        <p>₹60000</p>
                        <p id="name"> iphone 13</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/61NGnpjoRDL._AC_UY327_FMwebp_QL65_.jpg" alt="">
                    <center>
                        <p>₹40000</p>
                        <p id="name">iPad</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/81pmO0iVNhL._AC_UY327_FMwebp_QL65_.jpg" alt="">
                    <center>
                        <p>₹12000</p>
                        <p id="name">Samsung 5g</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <!-- <div>
                <img src="https://m.media-amazon.com/images/I/61M4gkurLUL._AC_UY327_FMwebp_QL65_.jpg" alt="">
                <center>
                    <p>$500</p>
                </center>
                <button class="add-to-cart">Add to Cart</button>
            </div> -->
                <div>
                    <img src="https://m.media-amazon.com/images/I/418AP8pw3KL._AC_UY327_FMwebp_QL65_.jpg" alt="">
                    <center>
                        <p>₹349</p>
                        <p id="name">Earphone</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
            </div>
            <div class="electronics">
                <div>
                    <img src="https://m.media-amazon.com/images/I/61KNJav3S9L._AC_UY327_FMwebp_QL65_.jpg" alt="">
                    <center>
                        <p>₹1499</p>
                        <p id="name">BOAT Earbuds</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/61b8STGCCxL._AC_UY327_FMwebp_QL65_.jpg" alt="">
                    <center>
                        <p>₹1299</p>
                        <p id="name">MIVI Earbuds</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/61QvlYQsYWL._AC_UL480_FMwebp_QL65_.jpg" alt="">
                    <center>
                        <p>₹849</p>
                        <p id="name">Soundcore</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/71vI6nfLtYL._AC_UY327_FMwebp_QL65_.jpg" alt="">
                    <center>
                        <p>₹1299</p>
                        <p id="name">Boat Speaker</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/61JtVmcxb0L._AC_UY327_FMwebp_QL65_.jpg" alt="">
                    <center>
                        <p>₹1899</p>
                        <p id="name">Fastrack Smart Watch</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <!-- <div>
                <img src="https://m.media-amazon.com/images/I/71DjjntHOEL._AC_UY327_FMwebp_QL65_.jpg" alt="">
                <center>
                    <p>$500</p>
                </center>
                <button class="add-to-cart">Add to Cart</button>
            </div> -->
                <div>
                    <img src="https://m.media-amazon.com/images/I/71uOgDy40BL._AC_UY327_FMwebp_QL65_.jpg" alt="">
                    <center>
                        <p>₹38000</p>
                        <p id="name">iWatch</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
            </div>



            <h1 class="type" id="stationaries">Stationaries</h1>
            <div class="stationaries">
                <div>
                    <img src="https://m.media-amazon.com/images/I/71CUaxW+IdL._AC_UL480_FMwebp_QL65_.jpg" alt="">
                    <center>
                        <p>₹499</p>
                        <p id="name">Colourfull Pen</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/71fZWNRaPfS._AC_UL480_FMwebp_QL65_.jpg" alt="">
                    <center>
                        <p>₹249</p>
                        <p id="name">Classmate Notebook</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/71cjh8csrfL._AC_UL480_FMwebp_QL65_.jpg" alt="">
                    <center>
                        <p>₹89</p>
                        <p id="name">Luxar Marker pen</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/61AiDuBhsEL._AC_UL480_FMwebp_QL65_.jpg" alt="">
                    <center>
                        <p>₹280</p>
                        <p id="name">Daily NoteBook</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/61zHe+OFcnS._AC_UL480_FMwebp_QL65_.jpg" alt="">
                    <center>
                        <p>₹249</p>
                        <p id="name">DOMS Poster Colour</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <!-- <div>
                <img src="https://m.media-amazon.com/images/I/617pWj4VBvL._AC_UY327_FMwebp_QL65_.jpg" alt="">
                <center>
                    <p>$500</p>
                </center>
                <button class="add-to-cart">Add to Cart</button>
            </div> -->
                <div>
                    <img src="https://m.media-amazon.com/images/I/912+mfE2XBL._AC_UL480_FMwebp_QL65_.jpg" alt="">
                    <center>
                        <p>₹299</p>
                        <p id="name">Notes</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
            </div>


            <h1 class="type" id="nutrition">Diet & Nutrition</h1>
            <div class="nutrition">
                <div>
                    <img src="https://m.media-amazon.com/images/I/415FalTMeEL.AC_SX250.jpg" alt="">
                    <center>
                        <p>₹480</p>
                        <p id="name">Gold Standard</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/41eEuXIS24L.AC_SX250.jpg" alt="">
                    <center>
                        <p>₹549</p>
                        <p id="name">Chyawanprash</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/410sfO2U5wL.AC_SX250.jpg" alt="">
                    <center>
                        <p>₹240</p>
                        <p id="name">Himalaya</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/61ZKpqtTJ2L._AC_UL480_QL65_.jpg" alt="">
                    <center>
                        <p>₹890</p>
                        <p id="name">Protinex</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <!-- <div>
                <img src="https://m.media-amazon.com/images/I/51QbU1j5iLL.AC_SX250.jpg" alt="">
                <center>
                    <p>$500</p>
                </center>
                <button class="add-to-cart">Add to Cart</button>
            </div> -->
                <div>
                    <img src="https://m.media-amazon.com/images/I/61Nc4SUU3jL._AC_UL480_QL65_.jpg" alt="">
                    <center>
                        <p>₹390</p>
                        <p id="name">Bourn Vita</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div>
                    <img src="https://m.media-amazon.com/images/I/61wvG+2Fa4L._AC_UL480_QL65_.jpg" alt="">
                    <center>
                        <p>₹469</p>
                        <p id="name">wellcore</p>
                    </center>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
            </div>
            <h1 class="type" id="nutrition">Newly Arrived</h1>
            <div class="clothes" id="clothes">
                <?php
                // Loop through each product and display its details
                while ($row = mysqli_fetch_assoc($res)) {
                ?>
                    <div id="new">
                        <img src="images/<?php echo $row['productImage']; ?>" alt="">
                        <center>
                            <p>₹<?php echo $row['productPrice']; ?></p>
                            <p id="name"><?php echo $row['productName']; ?></p>
                        </center>
                        <button style="background-color: orange; border: none; height:30px; border-radius: 10px; /* padding:10px; */ width:100%; cursor: pointer; box-shadow: 0 0 10px grey;">Add to Cart</button>
                    </div>
                <?php } ?>
            </div>
        </div>





        <div class="back">
            <center><a href="#top">Back to Top</a></center>
        </div>
        <div class="footer">
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

        <script src="script.js"></script>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>

</php>