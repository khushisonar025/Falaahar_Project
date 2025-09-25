<?php

include '../components/connect.php';
session_start();

?>

<!-- login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delivery Login</title>
    <link rel="stylesheet" href="styless.css">
</head>
<body>
<div class="login-register-container">
  
    <form action="login.php" method="POST">
    <h2>Login</h2>
    <h5>default email khushisonar@gmail.com and password 111</h5>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="submit">Login</button>
       
        <p> if don't have account<a href="register.php"> Register here</a></p>
    </form>
</div>

    <?php
    // Login code
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare and execute the PDO statement
        $stmt = $conn->prepare("SELECT * FROM delivery_persons WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and verify password
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Invalid email or password!";
        }
    }
    ?>
</body>
</html>
