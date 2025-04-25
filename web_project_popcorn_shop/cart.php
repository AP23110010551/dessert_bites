<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart | POPCORN</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <div class="logo">POPCORN</div>
        <div class="nav-links">
            <a href="menu.php">Menu</a>
            <a href="cart.php" class="active">Cart</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h2>🛒 Your Cart</h2>
        
        <div id="cart-container">
            <div id="cart-items" class="cart-items">
            </div>
            
            <div class="cart-summary">
                <h3 id="total-price">Total: ₹0</h3>
                <button id="pay-button" onclick="payNow()" class="btn-primary">Pay Now</button>
                <button onclick="clearCart()" class="btn-secondary">Clear Cart</button>
            </div>
        </div>
    </div>

    <script src="cart.js"></script>
    <script src="payment.js"></script>
</body>
</html>
