<?php

include '../components/connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Add these lines at the top of your file if not already included
require '../vendor/autoload.php'; // Adjust the path as necessaryuse PHPMailer\PHPMailer\PHPMailer;


session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
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
   
       $mail->setFrom('sonarkhushi313@gmail.com', 'Your Name');
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

   <link rel="stylesheet" href="../css/admin_style.css">
   

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="dashboard">

   <h1 class="heading">Dashboard</h1>

   <div class="box-container">

      <div class="box">
         <h3>Welcome!</h3>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">Update Profile</a>
      </div>

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_pendings->execute(['pending']);
            if($select_pendings->rowCount() > 0){
               while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                  $total_pendings += $fetch_pendings['total_price'];
               }
            }
         ?>
         <h3><span>RS.</span><?= $total_pendings; ?><span>/-</span></h3>
         <p>Total pendings</p>
         <a href="placed_orders.php" class="btn">See Orders.</a>
      </div>

      <div class="box">
         <?php
            $total_completes = 0;
            $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_completes->execute(['completed']);
            if($select_completes->rowCount() > 0){
               while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                  $total_completes += $fetch_completes['total_price'];
               }
            }
         ?>
         <h3><span>RS.</span><?= $total_completes; ?><span>/-</span></h3>
         <p>Completed orders</p>
         <a href="placed_orders.php" class="btn">See orders</a>
      </div>

      <div class="box">
         <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $number_of_orders = $select_orders->rowCount()
         ?>
         <h3><?= $number_of_orders; ?></h3>
         <p>Orders Placed.</p>
         <a href="placed_orders.php" class="btn">See orders.</a>
      </div>

      <div class="box">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>Products added</p>
         <a href="products.php" class="btn">See products</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>Normal users</p>
         <a href="users_accounts.php" class="btn">See Users</a>
      </div>

      <div class="box">
         <?php
            $select_admins = $conn->prepare("SELECT * FROM `admins`");
            $select_admins->execute();
            $number_of_admins = $select_admins->rowCount()
         ?>
         <h3><?= $number_of_admins; ?></h3>
         <p>Admin users</p>
         <a href="admin_accounts.php" class="btn">See admins</a>
      </div>

      <div class="box">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
         ?>
         <h3><?= $number_of_messages; ?></h3>
         <p>New messages</p>
         <a href="messages.php" class="btn">See messages</a>
      </div>

   </div>

</section>


<section class="dashboard-delivery">
   <h1 class="heading">Dashboard</h1>
   <div class="box-container">
      <!-- Existing sections here (Profile, Orders, etc.) -->
       <!-- Delivery Management Section -->
        <div class="box">
         <h3>Delivery Management</h3>
          <?php
            // Fetch pending orders
            $select_orders = $conn->prepare("
            SELECT orders.*, users.name AS customer_name 
            FROM `orders`
            JOIN `users` ON orders.user_id = users.id
            WHERE delivery_status = 'pending'
            ");
            $select_orders->execute();
            if($select_orders->rowCount() > 0) {
            while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)) {
               // Display each order in the dashboard
               echo '<div class="order-box">';
               echo '<p>Order ID: ' . $fetch_order['id'] . '</p>';
               echo '<p>Customer: ' . $fetch_order['customer_name'] . '</p>';
               echo '<p>Email: ' . $fetch_order['email'] . '</p>';
               echo '<p>Phone: ' . $fetch_order['number'] . '</p>';
               echo '<p>Address: ' . $fetch_order['address'] . '</p>';
               echo '<p>Total Amount: RS.' . $fetch_order['total_price'] . '</p>';
               //   send otp
               echo '<form action="" method="post">';
               echo '<input type="hidden" name="order_id" value="' . $fetch_order['id'] . '">';
               echo '<input type="hidden" name="email" value="' . $fetch_order['email'] . '">';
               echo '<input type="submit" name="send_otp" value="Send OTP" class="btn">';
               echo '</form>';

               // Form to verify OTP
               echo '<form action="" method="post">';
                  echo '<input type="text" name="otp" placeholder="Enter OTP" required>';
                  echo '<input type="hidden" name="order_id" value="' . $fetch_order['id'] . '">'; // Include order ID
                  echo '<input type="hidden" name="payment_status" value="completed">'; // Assuming you want to mark it completed
                  echo '<input type="submit" name="verify_otp" value="Verify OTP" class="btn">';
                  echo '</form>';
               // Update form for delivery and payment status
                  echo '<form action="" method="post">';
                  echo '<input type="hidden" name="order_id" value="' . $fetch_order['id'] . '">';
                  echo '<select name="status" required>';
                  echo '<option value="pending"' . ($fetch_order['delivery_status'] == 'pending' ? ' selected' : '') . '>Pending</option>';
                  echo '<option value="delivered"' . ($fetch_order['delivery_status'] == 'delivered' ? ' selected' : '') . '>Delivered</option>';
                  echo '<option value="canceled"' . ($fetch_order['delivery_status'] == 'canceled' ? ' selected' : '') . '>Canceled</option>';
                  echo '</select>';

                  echo '<select name="payment_status" required>';
                  echo '<option value="pending"' . ($fetch_order['payment_status'] == 'pending' ? ' selected' : '') . '>Pending</option>';
                  echo '<option value="completed"' . ($fetch_order['payment_status'] == 'completed' ? ' selected' : '') . '>Completed</option>';
                  echo '</select>';

                  echo '<input type="submit" value="Update Status" class="btn" name="update_status">';
                  echo '</form>';
                  echo '</div>';
        
    }
}
// Update delivery and payment status if form submitted
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];
    $new_payment_status = $_POST['payment_status'];
    // Update the order's status in the database
    $update_status = $conn->prepare("UPDATE `orders` SET delivery_status = ?, payment_status = ? WHERE id = ?");
    $update_status->execute([$new_status, $new_payment_status, $order_id]);
     echo "<script>alert('Delivery and payment status updated!'); window.location.href = 'dashboard.php';</script>";
    }
?>
 </div>
</div>
</section>













<script src="../js/admin_script.js"></script>
   
</body>
</html>