<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form action="inc/register.inc.php" method="POST">
            <label>Name:</label>
            <input type="text" name="name" placeholder="Enter name" required>
            
            <label>Email:</label>
            <input type="email" name="email" placeholder="Enter email" required>

            <label>Username:</label>
            <input type="text" name="uid" placeholder="Enter username" required>
            
            <label>Password:</label>
            <div class="password-container">
                <input type="password" name="password" id="password" placeholder="Enter password" required>
                <button type="button" onclick="togglePassword()">Show</button>
            </div>
            
            <label>Confirm Password:</label>
            <div class="password-container">
                <input type="password" name="confirm_password" id="confirm-password" placeholder="Confirm password" required>
                <button type="button" onclick="toggleConfirmPassword()">Show</button>
            </div>
            
            <button type="submit" name="submit">Register</button>
        </form>

        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyinput") {
                echo "<p class='error'>Please fill in all fields!</p>";
            } else if ($_GET['error'] == "invaliduid") {
                echo "<p class='error'>Choose a proper username!</p>";
            } else if ($_GET['error'] == "invalidemail") {
                echo "<p class='error'>Choose a proper email!</p>";
            } else if ($_GET['error'] == "passwordsdontmatch") {
                echo "<p class='error'>Passwords don't match!</p>";
            } else if ($_GET['error'] == "usernametaken") {
                echo "<p class='error'>Username or email already taken!</p>";
            } else if ($_GET['error'] == "stmtfailed") {
                echo "<p class='error'>Something went wrong, try again!</p>";
            } else if ($_GET['error'] == "none") {
                echo "<p class='success'>You have signed up successfully!</p>";
            }

        }
        ?>
        
        <p>Already have an account? <a href="index.php">Login here</a></p>
    </div>
    
    <script src="js/script.js"></script>
</body>
</html>
