<!-- dashboard.php -->
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    

    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?></h1>
    <div class="dashboard">
        <div class="box">
        <a href="placed_orders.php">
            <h2>Order Management</h2></a>

        </div>
        <div class="box">
            <a href="otp_verification.php">
         
            <h2>OTP Verification</h2></a>
            
       
        </div>
    </div>
</body>
</html>
