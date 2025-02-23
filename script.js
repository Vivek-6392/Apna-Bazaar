// slider
let imgs = document.querySelectorAll(".slider img");
let prev = document.querySelector("#prev-btn");
let next = document.querySelector("#next-btn");
let n = 0;
let intervalId; // Variable to store the interval ID for stopping autoplay

function changeSlide() {
    for (let i = 0; i < imgs.length; i++) {
        imgs[i].style.display = 'none';
    }
    imgs[n].style.display = 'block';
}

function nextSlide() {
    if (n < imgs.length - 1) {
        n++;
    } else {
        n = 0;
    }
    changeSlide();
}

function prevSlide() {
    if (n > 0) {
        n--;
    } else {
        n = imgs.length - 1;
    }
    changeSlide();
}

function startAutoplay() {
    intervalId = setInterval(() => {
        nextSlide();
    }, 3000); // Change slide every 3 seconds
}

function stopAutoplay() {
    clearInterval(intervalId);
}

changeSlide();

// Event listeners for next and previous buttons
prev.addEventListener("click", (e) => {
    //stopAutoplay(); // Stop autoplay when manual navigation is used
    prevSlide();
});

next.addEventListener("click", (e) => {
    //stopAutoplay(); // Stop autoplay when manual navigation is used
    nextSlide();
});

// Start autoplay when the page loads
startAutoplay();




// // cart functionality


// Define variables for buttons, ordered paragraph, items count, and total price
let btns = document.querySelectorAll('.products button');
let ordered = document.createElement('p');
let items = document.querySelector('#items');
let item = 0;
let totalPriceValue = 0;


// Array to store product names
let productNames = [];

// Function to add Remove from Cart button
function addRemoveButton(productInfo, pElement, nameElement) {
    //let removeButton = document.createElement('button');
    let removeButton = document.createElement('span');
    removeButton.innerHTML = '<i class="fa-solid fa-trash-can"></i>';
    
    //removeButton.style.backgroundColor = 'red';
    removeButton.style.color = 'red';
    // removeButton.style.border = 'none';

    removeButton.addEventListener('click', () => {
        item--;
        items.textContent = item;
        // Remove the product info element from the cart
        productInfo.remove();

        // Update the product names array by removing the name of the removed product
        const index = productNames.indexOf(nameElement.textContent);
        if (index !== -1) {
            productNames.splice(index, 1);
        }

        // Update the total price after removing the product
        totalPriceValue -= parseFloat(pElement.textContent.replace('₹', ''));
        updateTotalPrice();

        // If the cart becomes empty, remove the 'ordered' paragraph
        if (item === 0) {
            ordered.remove();
        }
    });

    // Append the remove button to the product info <div>
    productInfo.appendChild(removeButton);
}

// Loop through each button
btns.forEach(btn => {
    btn.addEventListener('click', () => {
        // Find the <p> tag containing the price
        let pElement = btn.previousElementSibling.querySelector('p');
        // Find the <p> tag containing the name
        let nameElement = btn.previousElementSibling.querySelector('#name');

        // Add the name to the productNames array
        productNames.push(nameElement.textContent);

        item++;
        // Find the <img> tag containing the image
        let productImg = btn.parentNode.querySelector('img');

        // Create a new <div> element to hold the product info
        let productInfo = document.createElement('div');
        productInfo.style.display = 'flex';
        productInfo.style.justifyContent = 'space-between';
        productInfo.style.padding = '20px';

        // Clone the image element
        let imageClone = productImg.cloneNode(true);
        imageClone.style.height = '50px';
        imageClone.style.width = '50px';
        productInfo.appendChild(imageClone);

        // Clone the name paragraph element
        let nameClone = nameElement.cloneNode(true);

        // Append the cloned name paragraph to the product info <div>
        productInfo.appendChild(nameClone);

        // Clone the price paragraph element
        let priceClone = pElement.cloneNode(true);

        // Append the cloned price paragraph to the product info <div>
        productInfo.appendChild(priceClone);

        // Change button style and text
        btn.style.backgroundColor = 'green';
        btn.textContent = 'Added to cart';

        // Find the cart list
        let cartList = document.querySelector('.offcanvas-body');

        // Append the product info <div> to the cart list
        cartList.appendChild(productInfo);

        // Extract the numerical value from the price paragraph and add it to the total price
        totalPriceValue += parseFloat(pElement.textContent.replace('₹', ''));

        // Remove existing total price element if it exists
        let existingTotalPriceElement = document.querySelector('#totalPrice');
        if (existingTotalPriceElement) {
            existingTotalPriceElement.remove();
        }

        // Create a new total price element
        let totalPrice = document.createElement('p');
        totalPrice.id = 'totalPrice';
        totalPrice.style.textAlign = 'right';
        totalPrice.textContent = 'Total Price = ₹' + totalPriceValue.toFixed(2);

        // Append the total price element to the cart list
        cartList.appendChild(totalPrice);

        // Remove existing order now button if it exists
        let existingOrderNow = document.querySelector('#orderNow');
        if (existingOrderNow) {
            existingOrderNow.remove();
        }

        // Create a new order now button
        let orderNow = document.createElement('button');
        orderNow.id = 'orderNow';
        orderNow.textContent = 'Checkout';
        orderNow.style.backgroundColor = 'orange';
        orderNow.style.border = 'none';
        orderNow.style.width = '100%';

        // Append the order now button to the cart list
        cartList.appendChild(orderNow);

        // Add event listener for checkout button
        orderNow.addEventListener('click', () => {
            cartList.appendChild(ordered);
            ordered.style.backgroundColor = '#6a994e';
            let totalPriceParam = encodeURIComponent(totalPriceValue);
            let productNamesParam = encodeURIComponent(productNames.join(';')); // Convert array to string separated by ';'
            // Pass both total price and product names as URL parameters
            window.location.href = "payment.php?totalPrice=" + totalPriceParam + "&productNames=" + productNamesParam;
            resetCart();
        });

        // Add Remove from Cart button for the added product
        addRemoveButton(productInfo, pElement, nameElement);

        // Update items count display
        items.textContent = item;
    });
});

// Function to remove the 'Checkout' button
function removeCheckoutButton() {
    let orderNow = document.querySelector('#orderNow');
    if (orderNow) {
        orderNow.remove();
    }
}

// Function to remove the 'ordered' paragraph
function removeOrderedParagraph() {
    if (ordered.parentNode) {
        ordered.remove();
    }
}

// Function to reset item count to zero and clear cart items
function resetCart() {
    item = 0; // Reset item count to zero
    items.textContent = item; // Update the displayed item count
    let cartList = document.querySelector('.offcanvas-body');
    cartList.innerHTML = ''; // Clear the cart items

    removeCheckoutButton(); // Remove the 'Checkout' button
    removeOrderedParagraph(); // Remove the 'ordered' paragraph
}

// Select all product info elements in the cart
let productInfos = document.querySelectorAll('.offcanvas-body div');

// Iterate over each product info element
productInfos.forEach(productInfo => {
    // Add click event listener to each product info element
    productInfo.addEventListener('click', () => {
        // Find the price paragraph element within the product info
        let pElement = productInfo.querySelector('p');

        // Extract the numerical value from the price paragraph
        let price = parseFloat(pElement.textContent.replace('₹', ''));

        // Subtract the price from the total price
        totalPriceValue -= price;

        // Remove the product info element from the cart
        productInfo.remove();

        // Update the product names array by removing the name of the removed product
        let nameElement = productInfo.querySelector('#name');
        const index = productNames.indexOf(nameElement.textContent);
        if (index !== -1) {
            productNames.splice(index, 1);
        }

        // Update the total price displayed in the cart
        updateTotalPrice();

        // If the cart becomes empty, remove the 'Checkout' button and the 'ordered' paragraph
        if (item === 0) {
            removeCheckoutButton();
            removeOrderedParagraph();
        }
    });
});

// Function to update the total price displayed in the cart
function updateTotalPrice() {
    // Find the cart list
    let cartList = document.querySelector('.offcanvas-body');

    // Remove existing total price element if it exists
    let existingTotalPriceElement = document.querySelector('#totalPrice');
    if (existingTotalPriceElement) {
        existingTotalPriceElement.remove();
    }

    // Create a new total price element
    let totalPrice = document.createElement('p');
    totalPrice.id = 'totalPrice';
    totalPrice.style.textAlign = 'right';
    totalPrice.textContent = 'Total Price = ₹' + totalPriceValue.toFixed(2);

    // Append the total price element to the cart list
    cartList.appendChild(totalPrice);

    // If the cart becomes empty, remove the 'Checkout' button and the 'ordered' paragraph
    if (item === 0) {
        removeCheckoutButton();
        removeOrderedParagraph();
        //totalPrice.remove();
        totalPrice.innerText = 'Your cart is empty!';
        totalPrice.style.textAlign =  'center';
    }
}




// sign up
let x = null;
let y = null;
let submit2 = document.querySelector('#submit2');
submit2.addEventListener('click', (e) => {
    // let user = document.querySelector('#userName');
    let name = document.querySelector('#name').value;
    // user.textContent = name;

    let numberEmail = document.querySelector('#number-email').value;
    let check = document.querySelector('#tick');
    let password = document.querySelector('#password').value;
    let confirmPass = document.querySelector('#re-enter-password').value;
    let msg = document.querySelector('#success');

    if (name === "" || numberEmail === "" || password === "" || confirmPass === "") {
        msg.textContent = "*Input all the required fields!";
        msg.style.color = "red";
        console.log("input all required fields");
        e.preventDefault();
    } else if (password.length < 6) {
        msg.textContent = "*Password length should be at least 6 character";
        msg.style.color = "red";
        e.preventDefault();
    }
    else if (password != confirmPass) {
        msg.textContent = "*Password and re-enter-password should be same.";
        msg.style.color = "red";
        e.preventDefault();
    } else if (!check.checked) {
        msg.textContent = "*Check the check box to continue.";
        msg.style.color = "red";
        e.preventDefault();
    } else if (!(/^[a-zA-Z0-9.%*-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(numberEmail)) && !(/^[0-9]{10}$/.test(numberEmail))) {
        msg.textContent = "*Incorrect email format!";
        msg.style.color = "red";
        e.preventDefault();
    } 
    else if(mysqli_sql_exception){
        msg.textContent = "*username available. Try new!";
        msg.style.color = "red";
    }
    else {
        // let user = document.querySelector('#userName');
        // user.textContent = name;
        msg.textContent = "*Form submitted successfully!";
        msg.style.color = "green";
        console.log("Form submitted successfully");

        //  localStorage.setItem('user',name);
        //  localStorage.setItem('key',password);
        x = name;
        y = password;
        console.log(x);
        console.log(y);
        // You can proceed with further actions here, like submitting the form data.
    }

});




//login 

// let submit1 = document.querySelector('#submit1');
// submit1.addEventListener('click', (e) => {

//     let name1 = document.querySelector('#name1').value;
//     //  let x = localStorage.getItem('user');
//     //  let y = localStorage.getItem('key');

//     // e.preventDefault();
//     let password1 = document.querySelector('#password1').value;

//     let msg = document.querySelector('#message');

//     if (name1 == "" || password1 == "") {
//         msg.textContent = "*Input all the required fields!";
//         msg.style.color = "red";
//         console.log("input all required fields");
//         e.preventDefault();
//     }
//     else if (x === null || y === null) {
//         msg.textContent = "*Username not found!!";
//         msg.style.color = "red";
//         console.log('error1');
//         e.preventDefault();
//     }
//     else if (name1 !== x) {
//         msg.textContent = "*Username not found!!";
//         msg.style.color = "red";
//         console.log('error2');
//         e.preventDefault();
//     } else if (password1 !== y) {
//         msg.textContent = "*Password is incorrect!!";
//         msg.style.color = "red";
//         e.preventDefault();
//     }
//     else {
//         let user = document.querySelector('#userName');
//         user.textContent = name1;
//         msg.textContent = "*Login successfully!";
//         msg.style.color = "green";
//         console.log("Form submitted successfully");
//     }

// });
