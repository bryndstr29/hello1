<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "ra_pos";


$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_input = $_POST['username'];
    $password_input = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username_input, $password_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username_input;

      
        header("Location: main.php");
        exit();
    } else {
        $error_message = "Invalid username or password!";
    }
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <div class="container">    
        
        <div class="logo">
            <img src="images/RA_Vegetables_and_Fruits_Logo.png" alt="Logo">
        </div>
        
        
        <div class="login-form">
            <h2>USER</h2>
            <form id="loginForm" method="POST" action="login.php">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
                <p id="errorMessage"></p>
            </form>
        </div>
    </div>

    <script src="scripts/login.js"></script>
</body>
</html>


