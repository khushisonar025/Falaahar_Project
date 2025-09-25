<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

include 'components/wishlist_cart.php';

// Get the category from the URL, default to 'fruits' if not set
$category = isset($_GET['category']) ? $_GET['category'] : 'fruits';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category - <?= htmlspecialchars($category); ?></title>
    
    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products">

    <h1 class="heading">Category: <?= htmlspecialchars($category); ?></h1>

    <div class="box-container">

    <?php
    // Prepare and execute the query based on the category
    $select_products = $conn->prepare("SELECT * FROM `products` WHERE category = :category");
    $select_products->bindParam(':category', $category);
    $select_products->execute();

    if ($select_products->rowCount() > 0) {
        while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <form action="" method="post" class="box">
        <input type="hidden" name="pid" value="<?= htmlspecialchars($fetch_product['id']); ?>">
        <input type="hidden" name="name" value="<?= htmlspecialchars($fetch_product['name']); ?>">
        <input type="hidden" name="price" value="<?= htmlspecialchars($fetch_product['price']); ?>">
        <input type="hidden" name="image" value="<?= htmlspecialchars($fetch_product['image_01']); ?>">
        <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
        <a href="quick_view.php?pid=<?= htmlspecialchars($fetch_product['id']); ?>" class="fas fa-eye"></a>
        <img src="uploaded_img/<?= htmlspecialchars($fetch_product['image_01']); ?>" alt="">
        <div class="name"><?= htmlspecialchars($fetch_product['name']); ?></div>
        <div class="flex">
            <div class="price"><span>RS.</span><?= htmlspecialchars($fetch_product['price']); ?><span>/-</span></div>
            <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
        </div>
        <input type="submit" value="add to cart" class="btn" name="add_to_cart">
    </form>
    <?php
        }
    } else {
        echo '<p class="empty">No products found!</p>';
    }
    ?>

    </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
