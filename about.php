<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="groimg/home8.png" alt="">
      </div>

      <div class="content">
         <h3>About-us</h3>
         <p>
         Welcome to FreshNest Organics, where nature's bounty meets quality and 
         freshness! We are passionate about bringing you the finest selection of fresh fruits and vegetables, 
         sourced directly from trusted farms and suppliers. Our commitment to quality ensures that every product 
         is handpicked and delivered to you at its peak freshness, bursting with natural flavors and nutrients.
         At [Your Brand Name], we believe in supporting healthy lifestyles and sustainable practices.
          Our produce is carefully grown using eco-friendly methods that prioritize both the environment and your well-being. Whether you're looking for farm-fresh fruits to enjoy as a snack or vibrant vegetables
          to enhance your meals, we have a wide variety of seasonal offerings to meet your needs.
         </p>
         <p>
         We pride ourselves on transparency, quality, and customer satisfaction
         With a deep-rooted connection to our community and the farmers we work with, 
         we aim to bring you the best of nature's harvest with every order.
         Discover the taste of freshness at FreshNest Organics, where healthy choices begin!
             </p>
         <a href="contact.php" class="btn">Contact Us</a>
      </div>

   </div>

</section>

<section class="reviews">
   <h1 class="heading">Our Team</h1>

   <div class="reviews-grid">

      <div class="team-member">
         <img src="groimg/man6.png" alt="Sandhya Patil">
         <p>Hey There! I'm Sandhya Patil. A Student of MCA in Computer/IT Department from Svkm College [Batch: 2024-25]. I love designing websites and exploring new things. Learning new things is my hobby.</p>
         <div class="social-links">
            <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin"></i></a>
         </div>
         <h3><a href="https://www.linkedin.com/" target="_blank">Sandhya Patil</a></h3>
      </div>

      <div class="team-member">
         <img src="groimg/man4.png" alt="Khushi Sonar">
         <p>Hey There! I'm Khushi Sonar. A Student of MCA in Computer/IT Department from Svkm College [Batch: 2024-25]. I love designing websites and exploring new things. Learning new things is my hobby.</p>
         <div class="social-links">
            <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin"></i></a>
         </div>
         <h3><a href="https://www.linkedin.com/" target="_blank">Khushi Sonar</a></h3>
      </div>

      <div class="team-member">
         <img src="groimg/man1.png" alt="Mayur Patil">
         <p>Hey There! I'm Mayur Patil. A Student of MCA in Computer/IT Department from Svkm College [Batch: 2024-25]. I love designing websites and exploring new things. Learning new things is my hobby.</p>
         <div class="social-links">
            <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin"></i></a>
         </div>
         <h3><a href="https://www.linkedin.com/" target="_blank">Mayur Patil</a></h3>
      </div>

      <div class="team-member">
         <img src="groimg/man5.png" alt="Kalpesh Kute">
         <p>Hey There! I'm Kalpesh Kute. A Student of MCA in Computer/IT Department from Svkm College [Batch: 2024-25]. I love designing websites and exploring new things. Learning new things is my hobby.</p>
         <div class="social-links">
            <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin"></i></a>
         </div>
         <h3><a href="https://www.facebook.com/pra.x.nil" target="_blank">Kalpesh Kute</a></h3>
      </div>

   </div>
</section>


<section class="our-services">
   <h2 class="section-heading">Our Services</h2>
   <div class="services-container">
      <div class="service-box">
         <i class="fas fa-truck fa-3x service-icon"></i>
         <h3 class="service-title">Farm-Fresh Delivery</h3>
         <p class="service-description">Enjoy the convenience of having premium fruits and vegetables delivered straight to your door. Our farm-to-table delivery service ensures that you receive the freshest produce possible, right at your doorstep.</p>
      </div>
      <div class="service-box">
         <i class="fas fa-headset fa-3x service-icon"></i>
         <h3 class="service-title">Customer Support</h3>
         <p class="service-description">Our dedicated customer support team is available to assist with any delivery-related questions or concerns. From rescheduling to addressing any issues, we’re here to provide prompt and helpful assistance.</p>
      </div>
      <div class="service-box">
         <i class="fas fa-leaf fa-3x service-icon"></i>
         <h3 class="service-title">Eco-Friendly Packaging</h3>
         <p class="service-description">We are committed to sustainability. Our delivery packaging is eco-friendly, designed to keep your produce fresh while minimizing environmental impact.</p>
      </div>
   </div>
</section>








<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<!-- <script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});


</script> -->

</body>
</html>