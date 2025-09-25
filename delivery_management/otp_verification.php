<?php

include '../components/connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Add these lines at the top of your file if not already included
require '../vendor/autoload.php'; // Adjust the path as necessaryuse PHPMailer\PHPMailer\PHPMailer;


session_start();

$admin_id = $_SESSION['user'];

if(!isset($admin_id)){
   header('location:login.php');
}
if (isset($_POST['send_otp'])) {
   $order_id = $_POST['order_id'];
   $email = $_POST['email']; // Ensure you get the customer's email

   // Generate OTP
   $otp = rand(100000, 999999); // 6-digit OTP

   // Store OTP in session
   $_SESSION['otp'] = $otp;
   $_SESSION['otp_order_id'] = $order_id;

   // Send OTP via email
   $mail = new PHPMailer(true);
   $mail = new PHPMailer(true);
   try {
       $mail->isSMTP();
       $mail->Host = 'smtp.gmail.com'; // Use your SMTP server
       $mail->SMTPAuth = true;
       $mail->Username = 'sonarkhushi313@gmail.com'; // Your email
       $mail->Password = 'yvzw zinn ictp eymp'; // Your email password
       $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
       $mail->Port = 587;
   
       $mail->setFrom('sonarkhushi313@gmail.com', 'Falaahar.com');
       $mail->addAddress($email);
       $mail->Subject = 'Your OTP Code';
       $mail->Body    = "Your OTP code is: $otp";
       $mail->send();
       echo "<script>alert('OTP sent to $email');</script>";
   } catch (Exception $e) {
       echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
   }
   
}

// Verify OTP
if (isset($_POST['verify_otp'])) {
   $input_otp = $_POST['otp'];
   $order_id = $_POST['order_id']; // Get the order ID
   $payment_status = $_POST['payment_status']; // Get the payment status

   if (isset($_SESSION['otp']) && $input_otp == $_SESSION['otp']) {
       // OTP is correct, proceed to update order status
       $update_status = $conn->prepare("UPDATE `orders` SET delivery_status = 'delivered', payment_status = ? WHERE id = ?");
       $update_status->execute([$payment_status, $order_id]);

       echo "<script>alert('Order delivered successfully!'); window.location.href = 'dashboard.php';</script>";
       unset($_SESSION['otp'], $_SESSION['otp_order_id']); // Clear the OTP from session
   } else {
       echo "<script>alert('Invalid OTP, please try again.');</script>";
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="style.css">
   


</head>
<body>

<?php include 'header.php'; ?>

<section class="delivery-dashboard">
   <h1 class="heading">Delivery Dashboard</h1>
   <div class="order-container">
      <!-- Delivery Orders Section -->
      <?php
        // Fetch pending orders
        $select_orders = $conn->prepare("
        SELECT orders.*, users.name AS customer_name 
        FROM `orders`
        JOIN `users` ON orders.user_id = users.id
        WHERE delivery_status = 'pending'
        ");
        $select_orders->execute();

        if ($select_orders->rowCount() > 0) {
            while ($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="order-item">';
                echo '<h3>Order ID: ' . $fetch_order['id'] . '</h3>';
                echo '<p><strong>Customer:</strong> ' . $fetch_order['customer_name'] . '</p>';
                echo '<p><strong>Email:</strong> ' . $fetch_order['email'] . '</p>';
                echo '<p><strong>Total:</strong> RS.' . $fetch_order['total_price'] . '</p>';

                // Send OTP form
                echo '<form action="" method="post" class="otp-form">';
                echo '<input type="hidden" name="order_id" value="' . $fetch_order['id'] . '">';
                echo '<input type="hidden" name="email" value="' . $fetch_order['email'] . '">';
                echo '<input type="submit" name="send_otp" value="Send OTP" class="btn">';
                echo '</form>';

                // OTP verification form
                echo '<form action="" method="post" class="otp-form">';
                echo '<input type="text" name="otp" placeholder="Enter OTP" required>';
                echo '<input type="hidden" name="order_id" value="' . $fetch_order['id'] . '">';
                echo '<input type="hidden" name="payment_status" value="completed">';
                echo '<input type="submit" name="verify_otp" value="Verify OTP" class="btn">';
                echo '</form>';

                // Status update form (similar to cart's quantity update)
                echo '<form action="" method="post" class="status-form">';
                echo '<input type="hidden" name="order_id" value="' . $fetch_order['id'] . '">';
                echo '<select name="status" required>';
                echo '<option value="pending" ' . ($fetch_order['delivery_status'] == 'pending' ? 'selected' : '') . '>Pending</option>';
                echo '<option value="delivered" ' . ($fetch_order['delivery_status'] == 'delivered' ? 'selected' : '') . '>Delivered</option>';
                echo '<option value="canceled" ' . ($fetch_order['delivery_status'] == 'canceled' ? 'selected' : '') . '>Canceled</option>';
                echo '</select>';

                echo '<select name="payment_status" required>';
                echo '<option value="pending" ' . ($fetch_order['payment_status'] == 'pending' ? 'selected' : '') . '>Pending</option>';
                echo '<option value="completed" ' . ($fetch_order['payment_status'] == 'completed' ? 'selected' : '') . '>Completed</option>';
                echo '</select>';

                echo '<input type="submit" value="Update Status" class="btn">';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo '<p>No pending orders.</p>';
        }
      ?>
   </div>
</section>




 </div>
</div>
</section>













<script src="../js/admin_script.js"></script>
   
</body>
</html>