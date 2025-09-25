<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:user_login.php');
    exit;
}

// Import PHPMailer classes outside the conditional block
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($_POST['order'])) {

    $name = htmlspecialchars(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $number = htmlspecialchars(filter_var($_POST['number'], FILTER_SANITIZE_STRING));
    $email = htmlspecialchars(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $method = htmlspecialchars(filter_var($_POST['method'], FILTER_SANITIZE_STRING));
    $address = 'Flat no. '. htmlspecialchars($_POST['flat']) .', '. htmlspecialchars($_POST['street']) .', ' .
               htmlspecialchars($_POST['city']) .', '. htmlspecialchars($_POST['state']) .', ' .
               htmlspecialchars($_POST['country']) .' - '. htmlspecialchars($_POST['pin_code']);
    $total_products = htmlspecialchars($_POST['total_products']);
    $total_price = htmlspecialchars($_POST['total_price']);

    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $check_cart->execute([$user_id]);

    if ($check_cart->rowCount() > 0) {
      
      

        $insert_order = $conn->prepare("INSERT INTO `orders` (user_id, name, number, email, method, address, total_products, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

        $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart->execute([$user_id]);
      

        // Define order details HTML content for email
        
        $order_details = "<h3>Order Receipt</h3>
        <p>Order ID: <strong>{$conn->lastInsertId()}</strong></p>
        <p>Name: $name</p>
        <p>Email: $email</p>
        <p>Phone: $number</p>
        <p>Address: $address</p>
        <p>Payment Method: $method</p>
        <h4>Order Summary:</h4>
        <ul>";

        $cart_items = explode(', ', $total_products);
        foreach ($cart_items as $item) {
            $order_details .= "<li>" . htmlspecialchars($item) . "</li>";
        }
        $order_details .= "</ul><p><strong>Total Amount:</strong> RS. $total_price</p>";

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sonarkhushi313@gmail.com';
            $mail->Password = 'yvzw zinn ictp eymp';
            $mail->SMTPSecure = 'tls'; // or 'ssl' if using port 465
            $mail->Port = 587; // Use 587 for TLS or 465 for SSL


            // Recipients
            $mail->setFrom('sonarkhushi313@gmail.com', 'Falaahar.com');
            $mail->addAddress($email, $name);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Order Receipt - Thank You for Your Order!';
            $mail->Body = $order_details;

            $mail->send();
            echo "<script>alert('Order placed successfully! Receipt sent to your email.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Order placed, but email could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
        }
    } else {
        echo "<script>alert('Your cart is empty');</script>";
    }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
    .checkout-note {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        margin: 15px 0;
        text-align: center;
        font-size: 14px;
        color: #444;
    }

    .checkout-note strong {
        color: #e74c3c;
    }
    </style>

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="checkout-orders">

   <form action="" method="POST">

   <h3>Your Orders</h3>
        <!-- Add the free delivery note here -->
        <div class="checkout-note">
        <p><strong>Note:</strong> Free delivery is only available within a 2km radius.</p>
    </div>

      <div class="display-orders">
      <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
      ?>
         <p> <?= $fetch_cart['name']; ?> <span>(<?= '₹'.$fetch_cart['price'].'/- x '. $fetch_cart['quantity']; ?>)</span> </p>
      <?php
            }
         }else{
            echo '<p class="empty">Your cart is empty!</p>';
         }
      ?>
         <input type="hidden" name="total_products" value="<?= $total_products; ?>">
         <input type="hidden" name="total_price" value="<?= $grand_total; ?>">
         <div class="grand-total">Grand Total : <span>RS.<?= $grand_total; ?>/-</span></div>
      </div>

      <h3>Place your orders</h3>

      <div class="flex">
         <div class="inputBox">
            <span>Enter your Name:</span>
            <input type="text" name="name" placeholder="Enter your name" class="box" maxlength="20" required>
         </div>
         <div class="inputBox">
            <span>Your Number :</span>
            <input type="number" name="number" placeholder="Enter your number" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
         </div>
         <div class="inputBox">
            <span>Your Email :</span>
            <input type="email" name="email" placeholder="Enter your email" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Payment Status :</span>
            <select name="method" class="box" required>
               <option value="cash on delivery">Cash On Delivery</option>
               <!-- <option value="credit card">Credit Card</option> -->
            </select>
         </div>
         <div class="inputBox">
            <span>Address line 01 :</span>
            <input type="text" name="flat" placeholder="e.g. Flat number" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Address line 02 :</span>
            <input type="text" name="street" placeholder="Street name" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>City :</span>
            <input type="text" name="city" placeholder="City" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>State:</span>
            <input type="text" name="state" placeholder="State" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Country :</span>
            <input type="text" name="country" placeholder="Country" class="box" maxlength="50" required>
         </div>

         <div class="inputBox">
         <span>ZIP CODE :</span>
          <select name="pin_code" class="box" required>
       <option value="">Select your ZIP CODE</option>
        <option value="424001">424001</option>
        <option value="424002">424002</option>
        <option value="424004">424004</option>
        <option value="424005">424005</option>
        <option value="424006">424006</option>
        <option value="424011">424011</option>
    </select>
</div>


      </div>

      <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="Place Order">

   </form>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
