<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Falaahar.Com</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <!-- <link rel="stylesheet" href="css/styles.css"> -->

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="home-bg">

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="groimg/home_9.png" alt="">
         </div>
         <div class="content">
            <span>Upto 50% Off</span>
            <h3>“Colorful, Crunchy, and Completely Fresh: Elevate Your Meals with Our Veggies!”</h3>
            <a href="shop.php" class="btn">Shop Now</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="groimg/blog_2.png" alt="">
         </div>
         <div class="content">
            <span>Upto 50% off</span>
            <h3>“Freshly Picked Perfection: Enjoy the Natural Sweetness of Our Handpicked Fruits!”</h3>
            <a href="shop.php" class="btn">Shop Now.</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="groimg/home7.jpg" alt="">
         </div>
         <div class="content">
            <span>upto 50% off</span>
            <h3>“Sweet and Savory Perfection: Fresh Fruits and Vegetables Delivered to Your Door!”</h3>
            <a href="shop.php" class="btn">Shop Now.</a>
         </div>
      </div>

   </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

</div>



<section class="category">

   <h1 class="heading">Shop by Category</h1>

   <div class="category-container">
      <a href="category.php?category=fruits" class="category-item">
         <img src="groimg/All_fruits.png" alt="All Fruits">
         <h3>All Fruits</h3>
      </a>

      <a href="category.php?category=vegetables" class="category-item">
         <img src="groimg/All_vegetables.png" alt="All Vegetables">
         <h3>All Vegetables</h3>
      </a>

      <a href="category.php?category=localspecials" class="category-item">
         <img src="groimg/cucumber.png" alt="Local Specials">
         <h3>Local Specials</h3>
      </a>
      
      <a href="category.php?category=leafygreens" class="category-item">
         <img src="groimg/Fresh colocasia Leaf1.jpg" alt="Leafy Greens">
         <h3>Leafy Greens</h3>
      </a>

      <a href="category.php?category=seasonspecials" class="category-item">
         <img src="groimg/beat.jpg" alt="Season's Specials">
         <h3>Season's Specials</h3>
      </a>

      <a href="category.php?category=herbs" class="category-item">
         <img src="groimg/mint.jpg" alt="Herbs & Seasoning">
         <h3>Herbs & Seasoning</h3>
      </a>
   </div>
</section>




<section class="home-products">
   <h1 class="heading">Special Offers</h1>
   <div class="products-container">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`"); 
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="product-card">
         <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
         <button class="wishlist-btn fas fa-heart" type="submit" name="add_to_wishlist"></button>
         <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="view-btn fas fa-eye"></a>
         <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="<?= $fetch_product['name']; ?>">
         <div class="name"><?= $fetch_product['name']; ?></div>
         <div class="price-quantity">
            <div class="price"><span>RS. </span><?= $fetch_product['price']; ?><span>/-</span></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1">
         </div>
         <input type="submit" value="Add to Cart" class="btn" name="add_to_cart">
      </form>
      <?php
         }
      } else {
         echo '<p class="empty">No products added yet!</p>';
      }
      ?>
   </div>
</section>








<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   autoplay: {
         delay: 3000, // 3 seconds
         disableOnInteraction: false, // Keep autoplay running after user interaction
      },
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});



//var swiper = new Swiper(".products-slider", {
   // loop:true,
   // spaceBetween: 20,
   // pagination: {
   //    el: ".swiper-pagination",
   //    clickable:true,
   // },
   // breakpoints: {
   //    550: {
   //      slidesPerView: 2,
   //    },
   //    768: {
   //      slidesPerView: 2,
   //    },
   //    1024: {
   //      slidesPerView: 3,
   //    },
   // },
// });

</script>

</body>
</html>