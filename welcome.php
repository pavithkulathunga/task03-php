<?php
session_start();

if (!isset($_SESSION['useruid'])) {
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome!</h1>
        <p>You have successfully logged in.</p>
        
        <div class="user-info">
            <p><strong>User Email:</strong> <?php echo $_SESSION['useruid']; ?></p>
            <p><strong>Login Time:</strong> <?php echo date("Y-m-d H:i:s"); ?></p>
        </div>
        
        <a href="inc/logout.inc.php"><button onclick="logout()">Logout</button></a>
    </div>
    
    <script src="js/script.js"></script>
</body>
</html>
