<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: menu.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Popcorn Shop - Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <h1>POPCORN</h1>
            <p>Delicious treats for movie nights</p>
        </div>

        <div id="loginView" class="form-container">
            <h2>Login to Popcorn Shop</h2>
            <p id="errorMsg" class="error-message"></p>
            <form id="loginForm">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn-primary">Login</button>
            </form>
            <p class="form-footer">Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>

    <script>
        const loginForm = document.getElementById('loginForm');
        const errorMsg = document.getElementById('errorMsg');

        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(loginForm);
            
            fetch('login_process.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'menu.php';
                } else {
                    errorMsg.innerText = data.message;
                }
            })
            .catch(error => {
                errorMsg.innerText = "An error occurred. Please try again.";
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
