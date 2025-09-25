<?php
include '../components/connect.php';
?>

<!-- register.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delivery Register</title>
    <link rel="stylesheet" href="styless.css">
</head>
<body>
<div class="login-register-container">
    <form action="register.php" method="POST">
    <h2>Register Delivery Person</h2>
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="phone" placeholder="Phone"><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
        <p> After register<a href="login.php"> login here</a></p>
        <p>already have account<a href="login.php">login here</a></p>
    </form>
</div>

    <?php
    // Registration code
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO delivery_persons (name, email, phone, password) VALUES (:name, :email, :phone, :password)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':password', $password);

        // Execute the statement and check for errors
        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    }
    ?>
</body>
</html>
