<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu | POPCORN</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <div class="logo">POPCORN</div>
        <div class="nav-links">
            <a href="menu.php" class="active">Menu</a>
            <a href="cart.php">Cart</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h2>📋 Our Menu</h2>
        <p class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        
        <div class="menu">
            <div class="food-item">
                <img src="margerita pizza.png" alt="Pizza">
                <h3>Margherita Pizza</h3>
                <p class="price">₹250</p>
                <button onclick="addToCart('Margherita Pizza', 250)">Add to Cart</button>
            </div>
            <div class="food-item">
                <img src="CheeseBurger.jpg" alt="Burger">
                <h3>Cheese Burger</h3>
                <p class="price">₹150</p>
                <button onclick="addToCart('Cheese Burger', 150)">Add to Cart</button>
            </div>
            <div class="food-item">
                <img src="red-sauce-pasta.jpg" alt="Pasta">
                <h3>Red Sauce Pasta</h3>
                <p class="price">₹180</p>
                <button onclick="addToCart('Red Sauce Pasta', 180)">Add to Cart</button>
            </div>
            <div class="food-item">
                <img src="choco hazelnut.png" alt="Chocolate Hazelnut">
                <h3>Chocolate Hazelnut</h3>
                <p class="price">₹300</p>
                <button onclick="addToCart('Chocolate Hazelnut', 300)">Add to Cart</button>
            </div>
            <div class="food-item">
                <img src="choco donut.jpg" alt="Chocolate Donut">
                <h3>Chocolate Donut</h3>
                <p class="price">₹180</p>
                <button onclick="addToCart('Chocolate Donut', 180)">Add to Cart</button>
            </div>
            <div class="food-item">
                <img src="hot fudge ice cream.jpg" alt="Hot Fudge Ice Cream">
                <h3>Hot Fudge Ice Cream</h3>
                <p class="price">₹250</p>
                <button onclick="addToCart('Hot Fudge Ice Cream', 250)">Add to Cart</button>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
</body>
</html>
