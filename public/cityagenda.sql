-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2024 at 07:21 PM
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
-- Database: `cityagenda`
--

-- --------------------------------------------------------

--
-- Table structure for table `agendas`
--

CREATE TABLE `agendas` (
  `agenda_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `agenda_title` varchar(110) NOT NULL,
  `agenda_description` longtext NOT NULL,
  `agenda_start_time` time NOT NULL,
  `agenda_end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogcategories`
--

CREATE TABLE `blogcategories` (
  `blog_category_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(110) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `description` longtext NOT NULL,
  `content` longtext NOT NULL,
  `blogimage` varchar(250) NOT NULL,
  `tags` varchar(250) NOT NULL,
  `publishstatus` varchar(30) NOT NULL,
  `dateadded` date NOT NULL,
  `dateupdated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `categoryname` varchar(50) NOT NULL,
  `slug` varchar(110) NOT NULL,
  `categoryimage` varchar(110) NOT NULL,
  `is_top_category` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `categoryname`, `slug`, `categoryimage`, `is_top_category`) VALUES
(3, 'Politics', '/events?category=Politics', 'uploads/category-image/1725878192_2a4e6f3c82300bf84a90.png', 'Yes'),
(9, 'Religions', '/events?category=Religions', 'uploads/category-image/1725878386_9b9a97d34575d0e11388.png', ''),
(10, 'Business', '/events?category=Business', 'uploads/category-image/1725878403_7780438ec39be4fce524.png', 'Yes'),
(11, 'Sports', '/events?category=Sports', 'uploads/category-image/1725878415_e8da412f29cf2e2b042f.png', ''),
(12, 'Education', '/events?category=Education', 'uploads/category-image/1725878431_a06ff4b026d942e53f6a.png', 'Yes'),
(13, 'Cultures', '/events?category=Cultures', 'uploads/category-image/1725878448_47108e265d1aa1dc81bd.png', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `publishstatus` varchar(20) NOT NULL,
  `eventbanner` varchar(110) NOT NULL,
  `category_id` int(11) NOT NULL,
  `eventname` varchar(110) NOT NULL,
  `slug` varchar(110) NOT NULL,
  `shortdescription` longtext NOT NULL,
  `eventtype` varchar(20) DEFAULT NULL,
  `eventdate` date NOT NULL,
  `eventstartingtime` time NOT NULL,
  `eventendingtime` time NOT NULL,
  `recurrence` varchar(20) DEFAULT NULL,
  `locationname` varchar(110) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `event_image` varchar(110) DEFAULT NULL,
  `event_video` varchar(110) DEFAULT NULL,
  `eventdescription` longtext NOT NULL,
  `publishsetting` varchar(30) NOT NULL,
  `refundpolicy` varchar(220) NOT NULL,
  `dateadded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `faq_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `answer` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `fullname` varchar(110) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` longtext NOT NULL,
  `message_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `price` double(16,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` double(16,2) NOT NULL,
  `ticket_type` varchar(30) NOT NULL,
  `paymentdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `payment_method_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `account_name` varchar(100) DEFAULT NULL,
  `swift` varchar(100) DEFAULT NULL,
  `iban` varchar(100) DEFAULT NULL,
  `card_number` varchar(30) DEFAULT NULL,
  `expiration_date` varchar(5) DEFAULT NULL,
  `cvv` varchar(30) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `card_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`payment_method_id`, `user_id`, `payment_type`, `account_name`, `swift`, `iban`, `card_number`, `expiration_date`, `cvv`, `created_at`, `card_status`) VALUES
(1, 8, 'bank', 'Rustom Codilan', '456123165561323465', '135645623546512334', '', '', '', '2024-09-16 08:13:53', '1'),
(9, 8, 'bank', 'Rustom Codilan', '465124568713456', '465124568713456', NULL, NULL, NULL, '2024-09-20 06:26:37', ''),
(10, 8, 'credit', NULL, NULL, NULL, '465124568713456', '11/28', '4651', '2024-09-20 06:33:21', '1'),
(11, 8, 'credit', NULL, NULL, NULL, '23434234324234', '11/28', '1234', '2024-09-20 06:38:23', '');

-- --------------------------------------------------------

--
-- Table structure for table `qrcodes`
--

CREATE TABLE `qrcodes` (
  `qrcode_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `location` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `speakers`
--

CREATE TABLE `speakers` (
  `speaker_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `job` varchar(50) NOT NULL,
  `image` varchar(110) NOT NULL,
  `facebook_link` varchar(80) DEFAULT NULL,
  `instagram_link` varchar(80) DEFAULT NULL,
  `youtube_link` varchar(80) DEFAULT NULL,
  `twitter_link` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `sponsor_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `sponsor_description` longtext NOT NULL,
  `sponsor_logo` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `subscriber_id` int(11) NOT NULL,
  `emailaddress` varchar(100) NOT NULL,
  `subscription_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `tickettype` varchar(20) NOT NULL,
  `ticketname` varchar(50) NOT NULL,
  `ticketdescription` longtext NOT NULL,
  `availablequantity` int(11) NOT NULL,
  `soldticket` int(11) NOT NULL,
  `price` double(16,2) NOT NULL,
  `salesstart` datetime NOT NULL,
  `salesend` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `image` varchar(110) NOT NULL,
  `coverphoto` varchar(110) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `jobtitle` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `emailaddress` varchar(100) NOT NULL,
  `phonenumber` varchar(15) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `encryptedpass` varchar(110) NOT NULL,
  `aboutyourself` longtext NOT NULL,
  `account_status` varchar(20) NOT NULL,
  `two_factor_enabled` varchar(20) NOT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `image`, `coverphoto`, `firstname`, `lastname`, `jobtitle`, `username`, `emailaddress`, `phonenumber`, `password`, `usertype`, `encryptedpass`, `aboutyourself`, `account_status`, `two_factor_enabled`, `created_at`) VALUES
(4, 'uploads/profile-image/1725874017_5d0ea71d123c2cfb1284.jpg', '', 'Rustom', 'Codilan', '', 'admin', 'rustomcodilan@gmail.com', NULL, 'mis137', 'Administrator', '$2y$10$WdL/jStypgyMUCRef37b9elIOPeoBGpKiaiEWk3py7Lzmbsr.hP76', '', '', '', '2024-09-20'),
(8, 'uploads/profile-image/1726463378_5d4bd4f019c2efb4a50c.jpg', '', 'Rustom', 'Codilan', 'PHP Backend Developer', '', 'rustom@braveegg.com', '09975304890', 'mis137', 'Event Organizer', '$2y$10$8rIQ72d/j6ls0FJQBp1J7.OLawOT/uaR8IeLL/gvqs0Mkw1iRQ2OW', 'Hard Working!', 'Active', '0', '2024-09-20'),
(9, 'uploads/profile-image/1728317713_c9c9af66708e9eeade88.png', 'uploads/cover-photo/1728317706_9b87bd01966917f1349b.png', 'Richard', 'Peterson', 'PHP Backend Developer', '', 'rustomlacrecodilan@gmail.com', '09975304890', 'mis137', 'Event Organizer', '$2y$10$DmGrgkRVxwVQBYFgfXoxo.C2cDxi9MSHmxqdwJPZJeKIVcxP0xiqS', 'Hello World! Hooray! Praise!!!', 'Active', '1', '2024-09-20');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`agenda_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `blogcategories`
--
ALTER TABLE `blogcategories`
  ADD PRIMARY KEY (`blog_category_id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `state_id` (`state`),
  ADD KEY `city_id` (`city`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`faq_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`payment_method_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `qrcodes`
--
ALTER TABLE `qrcodes`
  ADD PRIMARY KEY (`qrcode_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `speakers`
--
ALTER TABLE `speakers`
  ADD PRIMARY KEY (`speaker_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`sponsor_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`subscriber_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agendas`
--
ALTER TABLE `agendas`
  MODIFY `agenda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `blogcategories`
--
ALTER TABLE `blogcategories`
  MODIFY `blog_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `qrcodes`
--
ALTER TABLE `qrcodes`
  MODIFY `qrcode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `speakers`
--
ALTER TABLE `speakers`
  MODIFY `speaker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `sponsor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `subscriber_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agendas`
--
ALTER TABLE `agendas`
  ADD CONSTRAINT `agendas_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);

--
-- Constraints for table `blogcategories`
--
ALTER TABLE `blogcategories`
  ADD CONSTRAINT `blogcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `blogcategories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `faqs_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`);

--
-- Constraints for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD CONSTRAINT `payment_methods_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `qrcodes`
--
ALTER TABLE `qrcodes`
  ADD CONSTRAINT `qrcodes_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`);

--
-- Constraints for table `speakers`
--
ALTER TABLE `speakers`
  ADD CONSTRAINT `speakers_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);

--
-- Constraints for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD CONSTRAINT `sponsors_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `wishlists_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
