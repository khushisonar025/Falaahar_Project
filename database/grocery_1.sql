-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 17, 2024 at 02:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(27, 5, 16, 'Blue Berry', 120, 1, 'blue grapes 2.png');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(2, 5, 'khushi', 'khushi@gmail.com', '1234567890', 'good quality and products.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(4, 5, 'khushi', '1234567890', 'khushi@gmail.com', 'cash on delivery', 'flat no. 90, 6, dhule, Maharashtra, india - 1234', 'Blue Berry (120 x 1) - ', 120, '2024-09-17', 'completed'),
(5, 5, 'khushi', '1234567890', 'khushi@gmail.com', 'cash on delivery', 'flat no. 90, 6, dhulw, Maharashtra, india - 1234', 'Amala (55 x 1) - Capsicum (60 x 1) - Blue Berry (120 x 1) - ', 235, '2024-09-17', 'pending'),
(6, 5, 'khushi', '1234567890', 'khushi@gmail.com', 'cash on delivery', 'flat no. 90, 6, dhulw, Maharashtra, india - 1234', 'Amala (55 x 1) - Orenge (70 x 1) - Fresh Beet Root (10 x 1) - Coriander (10 x 1) - ', 145, '2024-09-17', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`, `category`) VALUES
(15, 'Apple', 'Benefits:\r\n\r\nRich in Nutrients: Packed with vitamins like Vitamin C and dietary fiber, apples support overall health and digestion.\r\nAntioxidant Power: Contains antioxidants such as quercetin that help protect cells from damage and support immune function.\r\nHeart Health: Regular consumption of apples is associated with improved heart health and reduced risk of cardiovascular disease.\r\nLow in Calories: A great choice for maintaining a healthy weight, apples are low in calories and provide a satis', 60, 'apple.png', 'apple2.png', 'apple3.png', 'fruits'),
(16, 'Blue Berry', 'About This Product: Discover the burst of flavor and vibrant color of our premium blueberries. These tiny, nutrient-packed berries are harvested at their peak, offering a sweet and tangy taste that’s perfect for snacking, cooking, or adding to your favourite recipes.\r\nBenefits:\r\nHigh in Vitamins: Rich in Vitamin C and Vitamin K, blueberries boost your immune system and support healthy bones.\r\nSupports Brain Health: Regular consumption of blueberries is linked to improved cognitive function.', 120, 'blue grapes 2.png', 'blue grapes.png', 'blue grapes 3.png', 'fruits'),
(17, 'Orenge', 'About This Product: \r\nIndulge in the juicy, refreshing taste of our premium oranges, picked at the height of their ripeness. These vibrant fruits are known for their sweet and tangy flavor, making them a delightful addition to any meal or snack. Perfect for juicing or eating fresh, our oranges offer a burst of citrus goodness in every bite.\r\nBenefits:\r\n\r\nRich in Vitamin C: Oranges are an excellent source of Vitamin C, which supports a strong immune system and healthy skin.', 70, 'orenge.png', 'Orange2.jpg', 'orenge2.jpg', 'fruits'),
(18, 'Banana', 'About This Product:\r\n Enjoy the naturally sweet and creamy goodness of our premium bananas. Handpicked at their peak ripeness, these bananas are perfect for snacking, baking, or adding a touch of sweetness to your favorite dishes\r\nBenefits:\r\n\r\nRich in Potassium: Bananas are an excellent source of potassium, which supports heart health and helps regulate blood pressure.', 69, 'banana.png', 'banana_2.png', 'banana_3.png', 'fruits'),
(19, 'Strawberry', 'About This Product: Indulge in the succulent sweetness of our premium strawberries, picked at the peak of their ripeness. These vibrant berries are known for their juicy flavor and bright red hue, making them a delightful addition to a variety of dishes. Perfect for snacking, desserts, or adding a touch of freshness to your meals.\r\nBenefits:\r\nRich in Vitamin C: Strawberries are an excellent source of Vitamin C, which boosts the immune system and promotes healthy skin.\r\n', 150, 'strawberry.png', 'strawberry2.jpg', 'strawberry3.jpg', 'fruits'),
(20, 'Amala', 'About This Product: \r\nDiscover the exceptional benefits of amla, also known as Indian gooseberry. Known for its tangy flavor and impressive nutritional profile, amala is a powerful fruit widely celebrated for its health-promoting properties\r\nBenefits:\r\nSupports Digestive Health: Amla aids in digestion and helps regulate bowel movements, promoting a healthy digestive system.\r\nBoosts Hair and Skin Health: The nutrients in amala are known to support healthy hair growth and improve skin appearance.', 55, 'amala.jpg', 'amala2.jpg', 'amala.jpg', 'fruits'),
(21, 'Onions', 'About This Product: Elevate your culinary creations with our high-quality onions, freshly harvested to bring you the perfect balance of flavor and texture. Known for their versatility and rich, aromatic taste, onions are a staple ingredient in kitchens around the world. \r\nBenefits:\r\nBoosts Immune System: Onions contain Vitamin C and other nutrients that strengthen the immune system and help fight off illnesses.\r\nPromotes Digestive Health: High in dietary fiber, onions aid in digestion and suppor', 35, 'Onions.png', 'onions2.png', 'onions3.png', 'vegetables'),
(22, 'Brinjal', 'About This Product: \r\nExplore the rich, savory flavor and versatile nature of our premium brinjal (eggplant). Harvested at the perfect stage for tenderness and taste, our brinjals are ideal for a variety of dishes, from hearty stews to grilled delights. With its unique texture and ability to absorb flavors, brinjal is a culinary favorite in many cuisines.\r\nBenefits:\r\nSupports Digestive Health: The fiber in brinjal promotes healthy digestion and helps regulate bowel movements.\r\n', 40, 'brinjal2.png', 'Brinjal.png', 'brinjal3.jpg', 'vegetables'),
(23, 'Cabbage', 'About This Product: Discover the crunchy, crisp texture and mild flavor of our premium cabbage. Freshly harvested for peak quality, cabbage is a versatile vegetable that can enhance a wide range of dishes, from salads and slaws to hearty soups and stir-fries. Its ability to absorb flavors makes it a staple ingredient in many cuisines around the world.\r\nHow to Use:\r\n\r\nRaw: Slice or shred cabbage for refreshing salads, coleslaws, or as a crunchy topping for sandwiches and tacos.\r\n', 39, 'cabbage.png', 'Cabbage_2.png', 'cabbage_3.png', 'vegetables'),
(24, 'Cauliflower', 'About This Product: \r\nExperience the versatile and nutritious qualities of our premium cauliflower. With its mild flavor and firm texture, cauliflower is a versatile vegetable that can be used in a variety of dishes. Whether you&#39;re making a creamy soup, a hearty stir-fry, or a healthy rice substitute, our cauliflower is freshly harvested and ready to enhance your meals.\r\nHow to Use:\r\nSteamed: Steam cauliflower until tender and use as a healthy side dish.', 55, 'cauliflower.png', 'cauliflower_2.png', 'cauliflower_3.png', 'vegetables'),
(25, 'Capsicum', 'About This Product: \r\nAdd a burst of color and flavor to your dishes with our premium capsicum (bell pepper). Available in a range of vibrant colors, including red, yellow, and green, our capsicums are freshly harvested to ensure crispness and sweetness. Perfect for a variety of culinary uses, they bring both taste and visual appeal to your meals.\r\nHow to Use:\r\n\r\nRaw: Slice capsicum into strips for a crunchy, refreshing addition to salads, sandwiches, and veggie platters.\r\n', 60, 'capsicum.png', 'Red_YellowCapsicum.png', 'capsicum.png', 'vegetables'),
(26, 'Carrot', 'About This Product: Enjoy the crisp, sweet flavor of our premium carrots, freshly harvested to ensure the highest quality and taste. Known for their vibrant orange color and crunchy texture, our carrots are a versatile vegetable that can be enjoyed raw, cooked, or incorporated into a variety of dishes. They add both nutrition and flavor to your meals.\r\nHow to Use:\r\nJuiced: Blend carrots into fresh juice or smoothies for a nutritious drink packed with vitamins and natural sweetness.\r\n', 30, 'carrot_3.jpg', 'carrot2.jpg', 'carrot.png', 'vegetables'),
(27, 'fresh drumstick (moringa) ', 'About This Product: \r\nDiscover the unique flavor and exceptional nutritional benefits of our fresh drumstick (moringa) pods. Known for their long, slender shape and slightly earthy taste, drumsticks are a versatile ingredient that can enhance a variety of dishes. Freshly harvested for peak quality, they bring both health benefits and distinctive flavor to your meals.\r\nHow to Use:\r\nSautéed: Sauté drumsticks with spices or herbs to create a delicious and flavorful side dish.\r\n', 22, 'leaf.jpg', 'leaf2.jpg', 'leaf3.jpg', 'leafygreens'),
(28, 'Fresh Colocasia Leaf', 'About This Product: \r\nExperience the unique texture and flavor of our fresh colocasia leaves. Known for their heart-shaped appearance and slightly earthy taste, colocasia leaves are a staple in various cuisines and offer a delightful addition to your dishes. Freshly harvested to ensure optimal quality, these leaves are versatile and packed with nutrients.\r\nHow to Use:\r\nSautéed: Sauté colocasia leaves with garlic and spices for a flavorful side dish or as a complement to main courses.\r\n', 14, 'Fresh Colocasia Leaf2.jpg', 'Fresh Colocasia Leaf1.jpg', 'Fresh Colocasia Leaf2.jpg', 'leafygreens'),
(29, 'Fresh Beet Root', 'About This Product: \r\nDelight in the vibrant color and earthy sweetness of our premium beetroot. Freshly harvested to ensure the highest quality, our beetroots are perfect for adding a burst of flavor and nutrition to your meals. With their rich, deep red hue and versatile use, beetroots are a fantastic addition to both raw and cooked dishes.\r\nHow to Use:\r\nRaw: Grate or slice beetroot to add a crunchy, sweet element to salads, or enjoy it as a refreshing raw snack.', 10, 'beat.jpg', 'Beetroot3.jpg', 'beetroot1.jpg', 'seasonspecials'),
(32, 'CuCumber', 'About This Product:\r\nEnjoy the crisp, refreshing taste of our premium cucumbers, harvested at their peak for optimal flavor and texture. Known for their cool, hydrating qualities and versatile use, cucumbers are perfect for adding a touch of freshness to a variety of dishes. Whether you&#39;re preparing a light salad or a hydrating snack, our cucumbers are a nutritious and delightful choice.\r\nHow to Use:\r\nRaw: Slice or dice cucumbers to add a refreshing crunch to salads, sandwiches, or veggie pl', 10, 'cucumber.jpg', 'cucumber.png', 'cucumber2.jpg', 'localspecials'),
(33, 'Green Chillies', 'About This Product: \r\nAdd a kick of heat and a burst of flavor to your dishes with our fresh green chillies. Harvested for their vibrant color and spicy zest, green chillies are a versatile ingredient that can elevate a wide range of recipes. Whether you&#39;re cooking up a spicy curry or adding a fiery touch to your favorite dishes, our green chillies deliver the perfect level of heat.\r\nHow to Use:\r\nSautéed: Add chopped green chillies to stir-fries, curries, or sautés for a burst of heat and fl', 10, 'chill.jpg', 'chill2.jpg', 'GreenChillies.png', 'localspecials'),
(35, 'Fresh Curry Leaves', 'About This Product: Elevate your culinary creations with the aromatic and flavorful fresh curry leaves. Known for their distinct, slightly citrusy and earthy aroma, curry leaves are a staple in many traditional dishes. Freshly picked to ensure maximum flavor and potency, these leaves add a unique taste and a touch of authenticity to your recipes.\r\nHow to Use:\r\n\r\nTempering: Add curry leaves to hot oil at the start of cooking to release their essential oils and infuse your dishes with a fragrant, ', 10, 'Fresh Curry Leaves1.jpg', 'Fresh Curry Leaves1.jpg', 'Fresh Curry Leaves1.jpg', 'herbs'),
(36, 'Fresh Mint Leaves', 'About This Product:\r\n Infuse your dishes and drinks with the refreshing and aromatic flavor of our premium fresh mint leaves. Harvested for their vibrant green color and crisp, invigorating taste, mint leaves are a versatile ingredient that adds a delightful touch to both sweet and savory dishes. Perfect for enhancing flavors and adding a burst of freshness.\r\nHow to Use:\r\nGarnish: Use mint as a garnish for desserts, soups, and main courses to add a touch of elegance and flavor.\r\nSauces and Dress', 10, 'mint.jpg', 'mint2.jpg', 'mint3.jpg', 'herbs'),
(37, 'Coriander', 'About This Product: Enhance your dishes with the fresh, citrusy flavor of our premium coriander leaves. Known for their bright green color and fragrant aroma, fresh coriander is a staple in many cuisines around the world. Whether you’re using it as a garnish or as an integral ingredient in your cooking, coriander brings a burst of freshness and flavor to every dish.\r\n\r\nHow to Use:\r\n\r\nGarnish: Sprinkle fresh coriander leaves on curries, soups, salads, and rice dishes to add a fresh.', 10, 'coriander.jpg', 'coriander1.jpg', 'coriander2.jpg', 'herbs');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(5, 'khushi', 'khushi@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(14, 5, 20, 'Amala', 55, 'amala.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
