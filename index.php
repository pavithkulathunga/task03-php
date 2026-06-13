<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <form action="inc/login.inc.php" method="POST">
            <label>Email:</label>
            <input type="email" name="email" placeholder="Enter email" required>

            <label>Password:</label>
            <div class="password-container">
                <input type="password" name="password" id="password" placeholder="Enter password" required>
                <button type="button" onclick="togglePassword()">Show</button>
            </div>

            <button type="submit" name="submit">Login</button>
        </form>

        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "wronglogin") {
                echo "<p class='error'>Invalid username or password!</p>";
            }
        }
        ?>

        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>

    <script src="js/script.js"></script>
</body>

</html>