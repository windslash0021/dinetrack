-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2024 at 11:21 PM
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
-- Database: `catering_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_meal` (IN `p_service_id` INT(11), IN `p_meal_name` VARCHAR(255), IN `p_meal_description` TEXT, IN `p_meal_price` DECIMAL(10,2), IN `p_meal_image_url` VARCHAR(255), IN `p_meal_ingredients` TEXT)   BEGIN
    INSERT INTO meals (service_id, name, description, price, image_url, ingredients)
    VALUES (p_service_id, p_meal_name, p_meal_description, p_meal_price, p_meal_image_url, p_meal_ingredients);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `status` enum('Active','Disabled','Pending') DEFAULT 'Pending',
  `code` int(11) NOT NULL,
  `joined_at` datetime DEFAULT current_timestamp(),
  `last_login_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `first_name`, `last_name`, `gender`, `username`, `email`, `password`, `address`, `phone`, `status`, `code`, `joined_at`, `last_login_at`) VALUES
(1, 'james', 'apostol', 'Male', 'clienttest', 'marcelinoosera3@gmail.com', '$2y$10$/jUNH.0R0nX8hF0N7Q3Fv.N243UXVuPCAVQ3c9P5Nh4G40DLZL1cC', '13062 DAGAT-DAGATAN CAMARIN\r\n180', '09924728300', 'Active', 6572, '2024-11-24 13:40:40', '2024-11-24 13:40:40'),
(2, 'hat', 'dog', 'Female', 'hatdog', 'ni4san4@gmail.com', '$2y$10$YzWWh92B.2JrwipfTZAuU.q1/yBW4d51kXBFMUabMGfvIB2sWkNoe', 'burger king', '1234', 'Active', 7725, '2024-11-26 19:19:31', '2024-11-26 19:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `meal_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `ingredients` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`meal_id`, `service_id`, `name`, `description`, `price`, `image_url`, `ingredients`) VALUES
(2, 1, 'Sushi', 'STEP 1\nTO MAKE SUSHI ROLLS: Pat out some rice. La...', 300.00, 'https://www.themealdb.com/images/media/meals/g046bb1663960946.jpg', '300ml  Sushi Rice, 100ml Rice wine, 2 tbs Caster Sugar, 3 tbs Mayonnaise, 1 tbs Rice wine, 1 tbs Soy Sauce, 1 Cucumber'),
(3, 1, 'Burek', 'Fry the finely chopped onions and minced meat in o...', 500.00, 'https://www.themealdb.com/images/media/meals/tkxquw1628771028.jpg', '1 Packet Filo Pastry, 150g Minced Beef, 150g Onion, 40g Oil, Dash Salt, Dash Pepper'),
(4, 1, 'Corba', 'Pick through your lentils for any foreign debris, ...', 600.00, 'https://www.themealdb.com/images/media/meals/58oia61564916529.jpg', '1 cup  Lentils, 1 large Onion, 1 large Carrots, 1 tbs Tomato Puree, 2 tsp Cumin, 1 tsp  Paprika, 1/2 tsp Mint, 1/2 tsp Thyme, 1/4 tsp Black Pepper, 1/4 tsp Red Pepper Flakes, 4 cups  Vegetable Stock, 1 cup  Water, Pinch Sea Salt'),
(5, 1, 'milo', 'milo na may gatas', 99999.00, 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAnCAYAAACFSPFPAAAACXBIWXMAAA7DAAAOwwHHb6hkAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAB8RJREFUWIW1mH1U0+cVx7/3l4QgCIgIvo3xIgK+UG1hikCHsWohKGonnFbPjsd6rOu0zh6tuM11SmtPna66numZs9aj9aUNoMWXJCom2FXwB', 'sikret'),
(6, 1, 'hatdog', 'dog', 12.00, 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAfQAAAH0CAYAAADL1t+KAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAE52lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPHg6eG1wbWV0YSB4bWxuczp4PSdhZG9iZTpuczptZXRhLyc+CiAgICAgICAgPHJkZjpSREYgeG1sbnM6cmRmPSdodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyL', 'asfas');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(10,8) DEFAULT NULL,
  `invoice_status` enum('Pending','Generated') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `client_id`, `package_id`, `service_id`, `event_date`, `location`, `total_amount`, `latitude`, `longitude`, `invoice_status`) VALUES
(3, 1, 2, 1, '2024-11-28', NULL, 0.00, 0.00000000, 0.00000000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `package_name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `service_id`, `package_name`, `price`, `description`, `created_at`) VALUES
(1, 1, 'testpackage', 5000.00, 'test', '0000-00-00 00:00:00'),
(2, 1, 'pakej', 20.00, 'pakejing', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `package_meals`
--

CREATE TABLE `package_meals` (
  `package_id` int(11) NOT NULL,
  `meal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_meals`
--

INSERT INTO `package_meals` (`package_id`, `meal_id`) VALUES
(1, 2),
(1, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `status` enum('Active','Disabled','Pending') DEFAULT 'Pending',
  `code` int(11) NOT NULL,
  `joined_at` datetime DEFAULT current_timestamp(),
  `last_login_at` datetime DEFAULT current_timestamp(),
  `orders_completed` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `company_name`, `first_name`, `last_name`, `gender`, `username`, `email`, `password`, `address`, `phone`, `status`, `code`, `joined_at`, `last_login_at`, `orders_completed`) VALUES
(1, 'testcompany', 'Shane', 'Gabatin', 'Male', 'servicetest', 'gabatinshanemarc@gmail.com', '$2y$10$oEIa.gwOUzJeyapZ/wYuROJnW4tWfVDop2sKm8cAbYc2EOzQfrOeK', '13062 DAGAT-DAGATAN CAMARIN\r\n178', '09924728300', 'Active', 1764, '2024-11-24 13:38:44', '2024-11-24 13:38:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_archive`
--

CREATE TABLE `user_archive` (
  `archive_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `status` enum('Active','Pending','Disabled') NOT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `archived_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`meal_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_service_id` (`service_id`),
  ADD KEY `fk_client_id` (`client_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `package_meals`
--
ALTER TABLE `package_meals`
  ADD PRIMARY KEY (`package_id`,`meal_id`),
  ADD KEY `meal_id` (`meal_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `user_archive`
--
ALTER TABLE `user_archive`
  ADD PRIMARY KEY (`archive_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `meal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_archive`
--
ALTER TABLE `user_archive`
  MODIFY `archive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `service_id` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_client_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_service_id` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`);

--
-- Constraints for table `package_meals`
--
ALTER TABLE `package_meals`
  ADD CONSTRAINT `package_meals_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`),
  ADD CONSTRAINT `package_meals_ibfk_2` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`meal_id`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `event_archive_user` ON SCHEDULE EVERY 5 SECOND STARTS '2024-11-04 11:07:55' ENDS '2024-12-04 11:07:55' ON COMPLETION NOT PRESERVE ENABLE DO INSERT INTO user_archive (service_id, company_name, status, last_login_at, archived_at)
SELECT service_id, company_name, status, last_login_at, NOW()
FROM services
WHERE last_login_at < NOW() - INTERVAL 8 DAY
  AND status = 'Disabled'
	AND service_id NOT IN (SELECT service_id FROM 					user_archive WHERE status = 'Disabled')$$

CREATE DEFINER=`root`@`localhost` EVENT `event_disabling_user` ON SCHEDULE EVERY 5 SECOND STARTS '2024-11-17 14:47:00' ENDS '2025-11-17 14:47:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE services
SET status = 'Disabled'
WHERE last_login_at < NOW() - INTERVAL 7 DAY
  AND status = 'Active'$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
