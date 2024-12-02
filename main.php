<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System - Products</title>
    <link rel="stylesheet" href="styles/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <h2>POS System</h2>
            <ul>
                <li><a href="#" onclick="showSection('products')">🛒Products</a></li>
                <li><a href="#" onclick="showSection('inventory')">📦Inventory</a></li>
                <li><a href="#" onclick="showSection('sales')">📈Sales</a></li>
                <li><a href="logout.php">🚪Logout</a></li>
            </ul>
        </div>

        <div class="main-content" id="main-content">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p>Select an option from the sidebar.</p>
        </div>
    </div>

    <script>
        
        function showSection(section) {
            const content = document.getElementById('main-content');
            content.innerHTML = '';

            if (section === 'products') {
                content.innerHTML = `
            <div class="products-section">
                <h2>Products</h2>
                <div id="categories"></div> <!-- Display categories here -->
                <div id="product-list"></div> <!-- Display product cards here -->
                <div id="cart"></div> <!-- Cart section -->
            </div>
        `;
                loadCategories();
            } else if (section === 'inventory') {
                content.innerHTML = `
            <div class="inventory-section">
                <h2>Inventory Management</h2>
                <form id="inventory-form" method="POST"  action="add_to_inventory.php" enctype="multipart/form-data">
                    <label for="category">Category:</label>
                    <input type="text" id="category" name="category" required>

                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" step="0.01" required>

                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>

                    <button type="submit">Add to Inventory</button>
                </form>
                <p id="response-message"></p>
            </div>
        `;
                handleInventoryFormSubmission();
            } 
            }
                 // Clear cart
        function clearCart() {
            localStorage.removeItem('cart');
            displayCart();}   
        
        function loadCategories() {
            $.ajax({
                url: 'get_categories.php',
                type: 'GET',
                success: function(response) {
                    const categories = JSON.parse(response);
                    let categoryHtml = `<div class="category-list">`;
                    categories.forEach(category => {
                        categoryHtml += `<button class="category-btn" onclick="loadProducts('${category}')">${category}</button>`;
                    });
                    categoryHtml += `</div>`;
                    $('#categories').html(categoryHtml);
                    loadProducts();
                },
                error: function() {
                    alert("Error loading categories");
                }
            });
        }

        function loadProducts(category = '') {
    $.ajax({
        url: 'get_products.php',
        type: 'GET',
        data: {
            category: category
        },
        success: function(response) {
            const products = JSON.parse(response);
            
           
            products.sort((a, b) => a.name.localeCompare(b.name));

            let productHtml = '<div class="product-list">';
            products.forEach(product => {
                productHtml += 
                    `<div class="product-card">
                        <img src="${product.image}" alt="${product.name}">
                        <h3>${product.name}</h3>
                        <p>${product.category}</p>
                        <p>$${product.price}</p>
                        <button onclick="addToCart(${product.id}, '${product.name}', ${product.price})">Add to Cart</button>
                    </div>`;
            });
            productHtml += '</div>';
            $('#product-list').html(productHtml);
        },
        error: function() {
            alert("Error loading products");
        }
    });
}


        
        function addToCart(id, name, price) {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const productIndex = cart.findIndex(item => item.id === id);

            if (productIndex !== -1) {
               
                cart[productIndex].quantity++;
            } else {
                const product = {
                    id,
                    name,
                    price,
                    quantity: 1
                };
                cart.push(product);
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            displayCart();
        }

       function displayCart() {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    let cartHtml = `<h3>Your Cart</h3><ul>`;
    let total = 0;
    cart.forEach(item => {
        cartHtml += `
            <li>${item.name} - ₱${item.price} x ${item.quantity}</li>
        `;
        total += item.price * item.quantity;
    });
    cartHtml += `</ul><h4>Total: ₱${total.toFixed(2)}</h4>`;
    cartHtml += `<button class="clear-cart-btn" onclick="clearCart()">Clear Cart</button>`;
    cartHtml += `<button id="checkout-button" onclick="checkout()">Checkout</button>`;
    $('#cart').html(cartHtml);
}

function checkout() {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
    }

    let receiptHtml = `
        <div style="text-align:center; font-family: Arial, sans-serif; color: #333; margin: 20px; background-color: #f9f3e9; padding: 20px; border-radius: 8px;">
            <h2 style="font-size: 28px; font-weight: bold; color: #007bff;">RA Vegetables & Fruits</h2>
            <h3 style="font-size: 20px; margin: 10px 0; color: #333;">Receipt</h3>
            <p style="font-size: 16px; color: #666; margin-bottom: 20px;">Thank you for shopping with us!</p>

            <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px; border: 1px solid #ddd;">
                <thead>
                    <tr>
                        <th style="padding: 12px 15px; background-color: #f2f2f2; text-align: left; border: 1px solid #ddd;">Product</th>
                        <th style="padding: 12px 15px; background-color: #f2f2f2; text-align: left; border: 1px solid #ddd;">Price</th>
                        <th style="padding: 12px 15px; background-color: #f2f2f2; text-align: left; border: 1px solid #ddd;">Quantity</th>
                        <th style="padding: 12px 15px; background-color: #f2f2f2; text-align: left; border: 1px solid #ddd;">Total</th>
                    </tr>
                </thead>
                <tbody>`;

    let totalAmount = 0;
    cart.forEach(item => {
        let itemTotal = item.price * item.quantity;
        totalAmount += itemTotal;
        receiptHtml += `
            <tr>
                <td style="padding: 12px 15px; border: 1px solid #ddd; text-align: left;">${item.name}</td>
                <td style="padding: 12px 15px; border: 1px solid #ddd; text-align: left;">₱${item.price.toFixed(2)}</td>
                <td style="padding: 12px 15px; border: 1px solid #ddd; text-align: left;">${item.quantity}</td>
                <td style="padding: 12px 15px; border: 1px solid #ddd; text-align: left;">₱${itemTotal.toFixed(2)}</td>
            </tr>`;
    });

    receiptHtml += `
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="padding: 12px 15px; text-align: right; font-weight: bold; background-color: #f2f2f2; border: 1px solid #ddd;">Total:</td>
                        <td style="padding: 12px 15px; background-color: #f2f2f2; font-weight: bold; border: 1px solid #ddd;">₱${totalAmount.toFixed(2)}</td>
                    </tr>
                </tfoot>
            </table>

            <p style="font-size: 16px; color: #007bff; font-weight: bold;">Thank you for your purchase!</p>
            <p style="font-size: 14px; color: #666;">Visit us again at RA Vegetables & Fruits.</p>
        </div>`;

    const printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>Receipt</title><style>');
    printWindow.document.write(`
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f3e9;
            color: #333;
            border-radius: 8px;
        }
        h2, h3 {
            margin: 0;
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        table td {
            background-color: #fff;
        }
        p {
            font-size: 16px;
            color: #333;
        }
    `);
    printWindow.document.write('</style></head><body>');
    printWindow.document.write(receiptHtml);
    printWindow.document.write('</body></html>');
    printWindow.document.close();

    setTimeout(function() {
        printWindow.print();
    }, 500);
}
    </script>
</body>

</html>