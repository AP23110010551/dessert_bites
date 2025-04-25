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
    <title>Register - Popcorn Shop</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <h1>POPCORN</h1>
            <p>Delicious treats for movie nights</p>
        </div>

        <div class="form-container">
            <h2>Create an Account</h2>
            <p id="errorMsg" class="error-message"></p>
            <form id="registerForm">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn-primary">Register</button>
            </form>
            <p class="form-footer">Already have an account? <a href="index.php">Login here</a></p>
        </div>
    </div>

    <script>
        const registerForm = document.getElementById('registerForm');
        const errorMsg = document.getElementById('errorMsg');

        registerForm.addEventListener('submit', function (e) {
            e.preventDefault();
            
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password !== confirmPassword) {
                errorMsg.innerText = "Passwords do not match!";
                return;
            }
            
            const formData = new FormData(registerForm);
            
            fetch('register_process.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'index.php?registered=true';
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
