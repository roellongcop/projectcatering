-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 09, 2018 at 10:46 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_catering`
--

-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

CREATE TABLE `food_category` (
  `id` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_category`
--

INSERT INTO `food_category` (`id`, `category`, `date_created`) VALUES
(8, 'FISH/SEAFOOD', '2018-03-26 07:16:34'),
(9, 'NOODLES', '2018-03-26 07:17:03'),
(10, 'PASTA', '2018-03-26 07:17:19'),
(11, 'DESSERT', '2018-03-26 07:17:31'),
(12, 'SOUP', '2018-03-26 07:17:39'),
(13, 'CAKES', '2018-03-26 08:13:18'),
(14, 'MAIN COURSE', '2018-04-03 06:26:45');

-- --------------------------------------------------------

--
-- Table structure for table `t_about`
--

CREATE TABLE `t_about` (
  `id` int(11) NOT NULL,
  `display` text COLLATE utf8_unicode_ci,
  `contact_no` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_about`
--

INSERT INTO `t_about` (`id`, `display`, `contact_no`, `address`) VALUES
(13, '<p>\n\"Our Packages are adjustable to your budget.\"</p>\n<p>\nRecto\'s Table and Chairs Rental and Catering Services was established in 2006 owned by Nelia M. Recto. It is located in Barangay San Gabriel, General Mariano Alvarez (GMA), Cavite. We are open for catering service in any events like birthday, wedding, debut, baptismal, reunion, anniversary celebration, food seminar, municipal celebration, charity and company parties.</p>', '09216748960/09999914233/09167891604', 'Congressional Rd. (Lumang Petron) Brgy. Maderan, GMA, Cavite');

-- --------------------------------------------------------

--
-- Table structure for table `t_admins`
--

CREATE TABLE `t_admins` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `is_active` smallint(6) DEFAULT '1',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_admins`
--

INSERT INTO `t_admins` (`id`, `full_name`, `username`, `password`, `is_active`, `date_created`) VALUES
(1, 'Administrator', 'admin', '17c4520f6cfd1ab53d8745e84681eb49', 1, '2018-03-01 07:55:24');

-- --------------------------------------------------------

--
-- Table structure for table `t_availability`
--

CREATE TABLE `t_availability` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `inventory` int(11) DEFAULT NULL,
  `available` int(11) DEFAULT NULL,
  `reserved` int(11) DEFAULT NULL,
  `is_completed` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_events`
--

CREATE TABLE `t_events` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `image` varchar(200) DEFAULT NULL,
  `is_deleted` smallint(6) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_events`
--

INSERT INTO `t_events` (`id`, `name`, `description`, `image`, `is_deleted`) VALUES
(1, 'Birthday', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a ', '{\"current_path\":\".\\/event_images\\/birthday\\/birthday_1521303317.jpeg\",\"image_name\":\"birthday_1521303317.jpeg\"}', 1),
(2, 'Wedding', 'testing sample', '{\"current_path\":\".\\/event_images\\/wedding\\/wedding_1521316091.jpeg\",\"image_name\":\"wedding_1521316091.jpeg\"}', 1),
(3, 'sample', 'sample', '{\"current_path\":\".\\/event_images\\/sample\\/sample_1521432659.jpeg\",\"image_name\":\"sample_1521432659.jpeg\"}', 1),
(4, 'Baptism', 'sample sample sample', '{\"current_path\":\".\\/event_images\\/baptism\\/baptism_1521901211.jpeg\",\"image_name\":\"baptism_1521901211.jpeg\"}', 1),
(5, 'Baptismal', 'The ceremony of initiation into Christianity; in most Christian churches, it is considered a sacrament.', '{\"current_path\":\".\\/event_images\\/baptismal\\/baptismal_1522059278.jpg\",\"image_name\":\"baptismal_1522059278.jpg\"}', 1),
(6, 'Municipal Event', 'Event in Baranggay(s)', '{\"current_path\":\".\\/event_images\\/municipal_event\\/municipal_event_1522061011.jpeg\",\"image_name\":\"municipal_event_1522061011.jpeg\"}', 1),
(7, 'Debut', '18th Birthday', '{\"current_path\":\".\\/event_images\\/debut\\/debut_1522059443.jpg\",\"image_name\":\"debut_1522059443.jpg\"}', 0),
(8, 'Reunion ', 'Family Gatherings', '{\"current_path\":\".\\/event_images\\/reunion_\\/reunion__1522059559.jpeg\",\"image_name\":\"reunion__1522059559.jpeg\"}', 0),
(9, 'Baptismal', '', '{\"current_path\":\".\\/event_images\\/baptismal\\/baptismal_1522063653.jpg\",\"image_name\":\"baptismal_1522063653.jpg\"}', 0),
(10, 'Birthday', '', '{\"current_path\":\".\\/event_images\\/birthday\\/birthday_1522063770.jpg\",\"image_name\":\"birthday_1522063770.jpg\"}', 0),
(11, 'Wedding', '', '{\"current_path\":\".\\/event_images\\/wedding\\/wedding_1522063846.jpg\",\"image_name\":\"wedding_1522063846.jpg\"}', 0),
(12, 'OTHERS', 'Other events', '{\"current_path\":\".\\/event_images\\/others\\/others_1522648224.jpg\",\"image_name\":\"others_1522648224.jpg\"}', 0),
(13, 'suprise party', 'it is surprise', '{\"current_path\":\".\\/event_images\\/suprise_party\\/suprise_party_1523884449.jpeg\",\"image_name\":\"suprise_party_1523884449.jpeg\"}', 1),
(14, 'js prom', 'js prom', '{\"current_path\":\".\\/event_images\\/js_prom\\/js_prom_1524451423.jpg\",\"image_name\":\"js_prom_1524451423.jpg\"}', 1),
(15, 'funeral', 'death', '{\"current_path\":\".\\/event_images\\/funeral\\/funeral_1524529726.jpg\",\"image_name\":\"funeral_1524529726.jpg\"}', 1),
(16, 'Municipal Event', 'Municipal Event', '{\"current_path\":\".\\/event_images\\/municipal_event\\/municipal_event_1524530286.jpg\",\"image_name\":\"municipal_event_1524530286.jpg\"}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_foods`
--

CREATE TABLE `t_foods` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `image` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` double DEFAULT NULL,
  `is_available` smallint(6) DEFAULT '1',
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_foods`
--

INSERT INTO `t_foods` (`id`, `name`, `description`, `image`, `date_created`, `price`, `is_available`, `category_id`) VALUES
(9, 'Chopsuey', 'Chopsuey', '{\"current_path\":\".\\/food_images\\/chopsuey\\/chopsuey_1522050042.png\",\"image_name\":\"chopsuey_1522050042.png\"}', '2018-03-26 07:41:28', 5000, 1, 7),
(10, 'Lumpiang Sariwa', 'Lumpiang Sariwa', '{\"current_path\":\".\\/food_images\\/lumpiang_sariwa\\/lumpiang_sariwa_1522050114.jpg\",\"image_name\":\"lumpiang_sariwa_1522050114.jpg\"}', '2018-03-26 07:42:40', 5000, 1, 7),
(11, 'Relyenong Bangus', 'Relyenong Bangus', '{\"current_path\":\".\\/food_images\\/relyenong_bangus\\/relyenong_bangus_1522050178.jpg\",\"image_name\":\"relyenong_bangus_1522050178.jpg\"}', '2018-03-26 07:43:44', 4500, 1, 8),
(12, 'Nilasing na Hipon', 'Nilasing na Hipon', '{\"current_path\":\".\\/food_images\\/nilasing_na_hipon\\/nilasing_na_hipon_1522050243.jpg\",\"image_name\":\"nilasing_na_hipon_1522050243.jpg\"}', '2018-03-26 07:44:48', 6500, 1, 8),
(13, 'Pancit Bihon', 'Pancit Bihon', '{\"current_path\":\".\\/food_images\\/pancit_bihon\\/pancit_bihon_1522050416.jpg\",\"image_name\":\"pancit_bihon_1522050416.jpg\"}', '2018-03-26 07:47:42', 5000, 1, 9),
(14, 'Pancit Palabok', 'Pancit Palabok', '{\"current_path\":\".\\/food_images\\/pancit_palabok\\/pancit_palabok_1522050540.jpg\",\"image_name\":\"pancit_palabok_1522050540.jpg\"}', '2018-03-26 07:49:45', 5000, 1, 9),
(15, 'Spaghetti', 'Spaghetti', '{\"current_path\":\".\\/food_images\\/spaghetti\\/spaghetti_1522050617.jpg\",\"image_name\":\"spaghetti_1522050617.jpg\"}', '2018-03-26 07:51:03', 3500, 1, 10),
(16, 'Carbonara', 'Carbonara', '{\"current_path\":\".\\/food_images\\/carbonara\\/carbonara_1522050654.jpg\",\"image_name\":\"carbonara_1522050654.jpg\"}', '2018-03-26 07:51:39', 3500, 1, 10),
(17, 'Leche Flan', 'Leche Flan', '{\"current_path\":\".\\/food_images\\/leche_flan\\/leche_flan_1522050768.jpg\",\"image_name\":\"leche_flan_1522050768.jpg\"}', '2018-03-26 07:53:34', 3500, 1, 11),
(18, 'Puto', 'Puto', '{\"current_path\":\".\\/food_images\\/puto\\/puto_1522050864.jpg\",\"image_name\":\"puto_1522050864.jpg\"}', '2018-03-26 07:55:09', 2500, 1, 11),
(19, 'Chicken & Corn Soup', 'Chicken & Corn Soup', '{\"current_path\":\".\\/food_images\\/chicken_&_corn_soup\\/chicken_&_corn_soup_1522051002.jpg\",\"image_name\":\"chicken_&_corn_soup_1522051002.jpg\"}', '2018-03-26 07:57:28', 2000, 1, 12),
(20, 'Mushroom Soup', 'Mushroom Soup', '{\"current_path\":\".\\/food_images\\/mushroom_soup\\/mushroom_soup_1522051115.jpg\",\"image_name\":\"mushroom_soup_1522051115.jpg\"}', '2018-03-26 07:59:20', 2000, 1, 12),
(21, '2 Round Cake', '2 Round Cake', '{\"current_path\":\".\\/food_images\\/2_round_cake\\/2_round_cake_1522051988.jpg\",\"image_name\":\"2_round_cake_1522051988.jpg\"}', '2018-03-26 08:13:54', 1500, 1, 13),
(22, '3 Round Cake', '3 Round Cake', '{\"current_path\":\".\\/food_images\\/3_round_cake\\/3_round_cake_1522761285.jpg\",\"image_name\":\"3_round_cake_1522761285.jpg\"}', '2018-03-26 08:14:21', 8000, 1, 13),
(23, '4 Round Cake', '4 Round Cake', '{\"current_path\":\".\\/food_images\\/4_round_cake\\/4_round_cake_1522052040.jpg\",\"image_name\":\"4_round_cake_1522052040.jpg\"}', '2018-03-26 08:14:45', 12000, 1, 13),
(24, 'Beef Caldereta', 'Beef Caldereta', '{\"current_path\":\".\\/food_images\\/beef_caldereta\\/beef_caldereta_1522737184.jpg\",\"image_name\":\"beef_caldereta_1522737184.jpg\"}', '2018-04-03 06:33:58', 1500, 1, 14),
(25, 'Beef Teriyaki', 'Beef Teriyaki', '{\"current_path\":\".\\/food_images\\/beef_teriyaki\\/beef_teriyaki_1522737250.jpg\",\"image_name\":\"beef_teriyaki_1522737250.jpg\"}', '2018-04-03 06:35:04', 1500, 1, 14),
(26, 'Chicken Barbeque', 'Chicken Barbeque', '{\"current_path\":\".\\/food_images\\/chicken_barbeque\\/chicken_barbeque_1522737316.jpg\",\"image_name\":\"chicken_barbeque_1522737316.jpg\"}', '2018-04-03 06:36:11', 1500, 1, 14),
(27, 'Chicken Curry', 'Chicken Curry', '{\"current_path\":\".\\/food_images\\/chicken_curry\\/chicken_curry_1522737366.jpg\",\"image_name\":\"chicken_curry_1522737366.jpg\"}', '2018-04-03 06:37:00', 1600, 1, 14),
(28, 'Pork Menudo', 'Pork Menudo', '{\"current_path\":\".\\/food_images\\/pork_menudo\\/pork_menudo_1522737622.jpg\",\"image_name\":\"pork_menudo_1522737622.jpg\"}', '2018-04-03 06:41:16', 1700, 1, 14),
(29, 'Pork Hamonado', 'Pork Hamonado', '{\"current_path\":\".\\/food_images\\/pork_hamonado\\/pork_hamonado_1522737883.jpg\",\"image_name\":\"pork_hamonado_1522737883.jpg\"}', '2018-04-03 06:45:37', 1600, 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `t_items`
--

CREATE TABLE `t_items` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `quantity` varchar(10) DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_items`
--

INSERT INTO `t_items` (`id`, `item_name`, `category_id`, `price`, `quantity`, `date_modified`, `image`) VALUES
(1, 'Guess Table (Good for 10 persons)', 4, 100, '455', '2018-03-26 08:02:05', '{\"current_path\":\".\\/item_images\\/guess_table_(good_for_10_persons)_1522055334.jpg\",\"image_name\":\"guess_table_(good_for_10_persons)_1522055334.jpg\"}'),
(3, 'Happy Birthday Hats', 8, 15, '2000', '2018-03-26 08:04:16', '{\"current_path\":\".\\/item_images\\/birthday_hats_1522054385.jpg\",\"image_name\":\"birthday_hats_1522054385.jpg\"}'),
(4, 'Spoon and Fork', 7, 20, '2000', '2018-03-26 08:06:45', '{\"current_path\":\".\\/item_images\\/spoon_and_fork_1522054395.jpg\",\"image_name\":\"spoon_and_fork_1522054395.jpg\"}'),
(5, 'Carpet', 7, 2500, '50', '2018-03-26 08:11:05', '{\"current_path\":\".\\/item_images\\/carpet_1522761601.jpg\",\"image_name\":\"carpet_1522761601.jpg\"}'),
(6, 'Floor-length Table', 4, 500, '20', '2018-03-26 08:12:43', '{\"current_path\":\".\\/item_images\\/floor-length_table_1522054419.jpg\",\"image_name\":\"floor-length_table_1522054419.jpg\"}'),
(7, 'Photobooth', 7, 3500, '3', '2018-03-26 08:18:14', '{\"current_path\":\".\\/item_images\\/photobooth_1522054429.jpg\",\"image_name\":\"photobooth_1522054429.jpg\"}'),
(8, 'Emcee', 13, 2500, '3', '2018-03-26 08:20:42', '{\"current_path\":\".\\/item_images\\/emcee_1522054440.png\",\"image_name\":\"emcee_1522054440.png\"}'),
(9, 'Uniformed Waiters', 13, 1500, '50', '2018-03-26 08:22:51', '{\"current_path\":\".\\/item_images\\/uniformed_waiters_1522052525.jpg\",\"image_name\":\"uniformed_waiters_1522052525.jpg\"}'),
(10, 'Invitation Card', 7, 15, '3000', '2018-03-26 08:24:23', '{\"current_path\":\".\\/item_images\\/invitation_card_1522054243.jpg\",\"image_name\":\"invitation_card_1522054243.jpg\"}'),
(11, 'Guess Chairs', 12, 15, '196', '2018-03-26 09:11:12', '{\"current_path\":\".\\/item_images\\/guess_chairs_1522055426.jpg\",\"image_name\":\"guess_chairs_1522055426.jpg\"}'),
(12, 'Table Cloth', 4, 15, '500', '2018-03-26 09:13:22', '{\"current_path\":\".\\/item_images\\/table_clothe_1522055557.jpg\",\"image_name\":\"table_clothe_1522055557.jpg\"}'),
(13, 'Gift Table', 4, 150, '50', '2018-03-26 09:16:20', '{\"current_path\":\".\\/item_images\\/gift_table_1522055734.jpg\",\"image_name\":\"gift_table_1522055734.jpg\"}'),
(14, '\'Will you marry me \' Figurine', 5, 25, '500', '2018-03-26 09:18:54', '{\"current_path\":\".\\/item_images\\/\'will_you_marry_me_\'_figurine_1522055888.jpg\",\"image_name\":\"\'will_you_marry_me_\'_figurine_1522055888.jpg\"}'),
(15, 'Personalized Cup Couple', 5, 50, '500', '2018-03-26 09:21:34', '{\"current_path\":\".\\/item_images\\/personalized_cup_couple_1522056049.jpg\",\"image_name\":\"personalized_cup_couple_1522056049.jpg\"}'),
(16, 'Clay Doll', 5, 50, '500', '2018-03-26 09:22:37', '{\"current_path\":\".\\/item_images\\/clay_doll_1522056112.jpg\",\"image_name\":\"clay_doll_1522056112.jpg\"}'),
(17, 'Antique Key', 5, 30, '500', '2018-03-26 09:24:31', '{\"current_path\":\".\\/item_images\\/antique_key_1522056226.jpg\",\"image_name\":\"antique_key_1522056226.jpg\"}'),
(18, 'Personalized Tumbler', 6, 100, '500', '2018-03-26 09:25:11', '{\"current_path\":\".\\/item_images\\/personalized_tumbler_1522056265.jpg\",\"image_name\":\"personalized_tumbler_1522056265.jpg\"}'),
(19, 'Cute Candies in a Jar', 6, 80, '500', '2018-03-26 09:26:04', '{\"current_path\":\".\\/item_images\\/cute_candies_in_a_jar_1522056318.jpg\",\"image_name\":\"cute_candies_in_a_jar_1522056318.jpg\"}'),
(20, 'Guitar Keychain', 6, 30, '500', '2018-03-26 09:28:27', '{\"current_path\":\".\\/item_images\\/guitar_keychain_1522056461.jpg\",\"image_name\":\"guitar_keychain_1522056461.jpg\"}'),
(21, 'Frozen Tumbler', 6, 100, '500', '2018-03-26 09:30:33', '{\"current_path\":\".\\/item_images\\/frozen_tumbler_1522056587.jpg\",\"image_name\":\"frozen_tumbler_1522056587.jpg\"}'),
(22, 'Pinyata', 7, 300, '20', '2018-03-26 09:33:35', '{\"current_path\":\".\\/item_images\\/pinyata_1522761539.jpg\",\"image_name\":\"pinyata_1522761539.jpg\"}'),
(23, 'Powerpuff Girls Hats', 8, 15, '500', '2018-03-26 09:35:33', '{\"current_path\":\".\\/item_images\\/powerpuff_girls_hats_1522056887.jpg\",\"image_name\":\"powerpuff_girls_hats_1522056887.jpg\"}'),
(24, 'Bonetes Hats', 8, 15, '500', '2018-03-26 09:36:11', '{\"current_path\":\".\\/item_images\\/bonetes_hats_1522056925.jpg\",\"image_name\":\"bonetes_hats_1522056925.jpg\"}'),
(25, 'Hello Kitty Hats', 8, 15, '500', '2018-03-26 09:39:01', '{\"current_path\":\".\\/item_images\\/hello_kitty_hats_1522057095.jpg\",\"image_name\":\"hello_kitty_hats_1522057095.jpg\"}'),
(27, 'Couple and Parents Chairs', 12, 100, '500', '2018-03-26 09:43:05', '{\"current_path\":\".\\/item_images\\/couple_and_parents_chairs_1522057339.jpg\",\"image_name\":\"couple_and_parents_chairs_1522057339.jpg\"}'),
(28, 'Chairs with cloth', 12, 45, '350', '2018-03-26 09:44:37', '{\"current_path\":\".\\/item_images\\/chairs_with_cloth_1522057431.jpg\",\"image_name\":\"chairs_with_cloth_1522057431.jpg\"}'),
(29, 'Latex Balloons', 15, 15, '500', '2018-03-26 09:52:54', '{\"current_path\":\".\\/item_images\\/latex_balloons_1522057929.jpg\",\"image_name\":\"latex_balloons_1522057929.jpg\"}'),
(30, 'Foil Balloons', 15, 25, '476', '2018-03-26 09:56:37', '{\"current_path\":\".\\/item_images\\/foil_balloons_1522058152.jpg\",\"image_name\":\"foil_balloons_1522058152.jpg\"}'),
(31, 'Bubble Balloon', 15, 25, '460', '2018-03-26 09:58:40', '{\"current_path\":\".\\/item_images\\/bubble_balloon_1522058275.jpg\",\"image_name\":\"bubble_balloon_1522058275.jpg\"}'),
(32, 'Angel Figurine', 17, 25, '500', '2018-03-26 10:00:17', '{\"current_path\":\".\\/item_images\\/angel_figurine_1522058372.jpg\",\"image_name\":\"angel_figurine_1522058372.jpg\"}'),
(33, 'Pokemon Keychain', 17, 25, '500', '2018-03-26 10:01:04', '{\"current_path\":\".\\/item_images\\/pokemon_keychain_1522058418.jpg\",\"image_name\":\"pokemon_keychain_1522058418.jpg\"}'),
(34, 'Frozen Tumbler', 4, 100, '500', '2018-03-26 10:02:55', '{\"current_path\":\".\\/item_images\\/frozen_tumbler_1522058530.jpg\",\"image_name\":\"frozen_tumbler_1522058530.jpg\"}'),
(35, 'Personalized Candles', 17, 15, '500', '2018-03-26 10:03:57', '{\"current_path\":\".\\/item_images\\/personalized_cancer_1522058591.jpg\",\"image_name\":\"personalized_cancer_1522058591.jpg\"}');

-- --------------------------------------------------------

--
-- Table structure for table `t_item_categories`
--

CREATE TABLE `t_item_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_item_categories`
--

INSERT INTO `t_item_categories` (`id`, `name`, `date_created`) VALUES
(4, 'Tables', '2018-03-10 06:00:22'),
(5, 'Wedding Souvenirs', '2018-03-10 06:05:54'),
(6, 'Birthday giveaways', '2018-03-12 16:30:37'),
(7, 'Party tools', '2018-03-12 16:30:57'),
(8, 'Birthday Hats', '2018-03-12 16:31:09'),
(12, 'Chairs', '2018-03-26 08:02:29'),
(15, 'Balloons', '2018-03-26 08:55:10'),
(17, 'Baptism Souvenirs', '2018-03-26 09:00:32');

-- --------------------------------------------------------

--
-- Table structure for table `t_logs`
--

CREATE TABLE `t_logs` (
  `id` int(11) NOT NULL,
  `action` text COLLATE utf8_unicode_ci,
  `admin_id` int(11) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_logs`
--

INSERT INTO `t_logs` (`id`, `action`, `admin_id`, `date_time`) VALUES
(1, 'Admin Login', 1, '2018-04-23 07:09:09'),
(2, 'Declined Reservation QI7UVL5S26 due to 5 day no down payment policy', 1, '2018-04-23 07:09:22'),
(3, 'Declined Reservation WWJJK0JO25 due to 5 day no down payment policy', 1, '2018-04-23 07:09:22'),
(4, 'Declined Reservation F83FGIVH24 due to 5 day no down payment policy', 1, '2018-04-23 07:09:23'),
(5, 'Declined Reservation CZ9HBEFQ23 due to 5 day no down payment policy', 1, '2018-04-23 07:09:24'),
(6, 'Declined Reservation 0K0MJHEG19 due to 5 day no down payment policy', 1, '2018-04-23 07:09:25'),
(7, 'Declined Reservation 9GQRQADT16 due to 5 day no down payment policy', 1, '2018-04-23 07:09:25'),
(8, 'Declined Reservation CS7ZJ0FL14 due to 5 day no down payment policy', 1, '2018-04-23 07:09:26'),
(9, 'Declined Reservation G4F5527M12 due to 5 day no down payment policy', 1, '2018-04-23 07:09:27'),
(10, 'Declined Reservation RSUPAGBR11 due to 5 day no down payment policy', 1, '2018-04-23 07:09:28'),
(11, 'Declined Reservation 8XD58Y0S67 due to 5 day no down payment policy', 1, '2018-04-23 07:09:28'),
(12, 'Declined Reservation VW8ITGFVI6 due to 5 day no down payment policy', 1, '2018-04-23 07:09:29'),
(13, 'Declined Reservation V5NXDG7P84 due to 5 day no down payment policy', 1, '2018-04-23 07:09:30'),
(14, 'Declined Reservation 4T84UFB9M5 due to 5 day no down payment policy', 1, '2018-04-23 07:09:31'),
(15, 'Admin Login', 1, '2018-04-23 07:44:55'),
(16, 'Sales report generation', 1, '2018-04-23 07:45:16'),
(17, 'New Reservation Russel Escalderon Lobrio ( May 29, 2018 )', NULL, '2018-04-23 08:41:58'),
(18, 'New Reservation John Sample Doe ( May 28, 2018 )', NULL, '2018-04-23 08:44:10'),
(19, 'New Reservation last asdf asdf ( May 28, 2018 )', NULL, '2018-04-23 08:46:08'),
(20, 'New Reservation Bella  Hasnudi ( May 24, 2018 )', NULL, '2018-04-23 08:52:37'),
(21, 'Admin Login', 1, '2018-04-23 09:02:26'),
(22, 'New Reservation Cyris  Tura ( May 24, 2018 )', NULL, '2018-04-23 09:08:04'),
(23, 'Admin Login', 1, '2018-04-23 09:08:10'),
(24, 'Admin Login', 1, '2018-04-23 09:10:47'),
(25, 'Declined Reservation 7F3P4MTK32 due to no downpayment', 1, '2018-04-23 09:11:12'),
(26, 'Declined Reservation 82XWSFZY27 due to no downpayment', 1, '2018-04-23 09:11:12'),
(27, 'Declined Reservation 821SHLCI31 due to no downpayment', 1, '2018-04-23 09:11:13'),
(28, 'New Reservation My Last Name My Middle Name My First Name ( May 30, 2018 )', NULL, '2018-04-23 09:11:19'),
(29, 'New Reservation Fernandez  Roel Jay ( May 30, 2018 )', NULL, '2018-04-23 09:29:16'),
(30, 'Admin Login', 1, '2018-04-23 10:15:34'),
(31, 'Admin Login', 1, '2018-04-23 10:15:38'),
(32, 'Reservations report generation', 1, '2018-04-23 10:27:34'),
(33, 'Items report generation', 1, '2018-04-23 10:28:02'),
(34, 'Sales report generation', 1, '2018-04-23 10:28:37'),
(35, 'Create new event js prom', 1, '2018-04-23 10:43:43'),
(36, 'Sales report generation', 1, '2018-04-23 11:15:53'),
(37, 'Sales report generation', 1, '2018-04-23 11:16:28'),
(38, 'Items report generation', 1, '2018-04-23 11:21:08'),
(39, 'Reservations report generation', 1, '2018-04-23 11:26:24'),
(40, 'Reservations report generation', 1, '2018-04-23 11:27:15'),
(41, 'New Reservation pingal  argee ( May 26, 2018 )', NULL, '2018-04-23 01:22:10'),
(42, 'Admin Login', 1, '2018-04-23 01:22:27'),
(43, 'Admin Login', 1, '2018-04-23 01:24:43'),
(44, 'Updated item inventory of Guess Table (Good for 10 persons) from ( 460 ) to 455', 1, '2018-04-23 01:26:14'),
(45, 'Confirmed Reservation LCMQRECW35', 1, '2018-04-23 01:26:15'),
(46, 'Admin Login', 1, '2018-04-23 01:26:58'),
(47, 'Admin Login', 1, '2018-04-23 01:28:29'),
(48, 'Admin Logout', 1, '2018-04-23 01:32:16'),
(49, 'Admin Login', 1, '2018-04-23 01:32:35'),
(50, 'Admin Login', 1, '2018-04-24 08:28:06'),
(51, 'Create new event funeral', 1, '2018-04-24 08:28:46'),
(52, 'Create new event Municipal Event', 1, '2018-04-24 08:38:06'),
(53, 'New Reservation Vicente,  Jackielyn ( May 31, 2018 )', NULL, '2018-04-24 02:07:52'),
(54, 'Admin Login', 1, '2018-04-24 02:08:20'),
(55, 'Admin Login', 1, '2018-04-24 02:08:20'),
(56, 'Admin Login', 1, '2018-04-24 06:00:31'),
(57, 'Admin Login', 1, '2018-04-27 09:24:44');

-- --------------------------------------------------------

--
-- Table structure for table `t_notifications`
--

CREATE TABLE `t_notifications` (
  `id` int(11) NOT NULL,
  `reservation_code` varchar(50) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `reservation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_packages`
--

CREATE TABLE `t_packages` (
  `id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `items` text,
  `pax` text,
  `staff_needed` int(11) DEFAULT NULL,
  `price` varchar(20) DEFAULT NULL,
  `image` text,
  `is_available` smallint(6) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `theme_id` int(11) DEFAULT NULL,
  `foods` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_packages`
--

INSERT INTO `t_packages` (`id`, `event_id`, `name`, `description`, `items`, `pax`, `staff_needed`, `price`, `image`, `is_available`, `date_created`, `theme_id`, `foods`) VALUES
(1, 2, 'Package 1', 'Presidential Set-Up\nBuffet Set-up with Fountain and Center piece\nComplete Catering Equipment/Utensils', '{\"0\":{\"id\":1,\"name\":\"Tables\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":300,\"amount\":15},\"1\":{\"id\":6,\"name\":\"Floor-length Table\",\"quantity\":\"1\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":500},\"2\":{\"id\":4,\"name\":\"Spoon and Fork\",\"quantity\":\"100\",\"category\":\"Party_tools\",\"subtotal\":2000,\"amount\":20},\"3\":{\"id\":5,\"name\":\"Carpet\",\"quantity\":\"1\",\"category\":\"Party_tools\",\"subtotal\":2500,\"amount\":2500},\"4\":{\"id\":10,\"name\":\"Invitation Card\",\"quantity\":\"100\",\"category\":\"Party_tools\",\"subtotal\":1500,\"amount\":15}}', '200', 10, '99300', '{\"current_path\":\".\\/package_img\\/package_1_1522053421.jpg\",\"image_name\":\"package_1_1522053421.jpg\"}', 0, '2018-03-26 08:37:46', 11, '{\"0\":{\"id\":5,\"name\":\"Beef Caldereta\",\"quantity\":\"3\",\"subtotal\":15000,\"amount\":5000},\"1\":{\"id\":1,\"name\":\"Pork Hamonado\",\"quantity\":\"3\",\"subtotal\":15000,\"amount\":5000},\"2\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"3\":{\"id\":13,\"name\":\"Pancit Bihon\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"4\":{\"id\":8,\"name\":\"Chicken Curry\",\"quantity\":\"2\",\"subtotal\":12000,\"amount\":6000}}'),
(2, 6, 'Municipal Event Package1', 'Sports event theme', '{\"0\":{\"id\":11,\"name\":\"Guess Chairs\",\"quantity\":\"100\",\"category\":\"Chairs\",\"subtotal\":1500,\"amount\":15},\"1\":{\"id\":6,\"name\":\"Floor-length Table\",\"quantity\":\"5\",\"category\":\"Tables\",\"subtotal\":2500,\"amount\":500}}', '100-140', 5, '53000', '{\"current_path\":\".\\/package_img\\/package1_1522067668.jpg\",\"image_name\":\"package1_1522067668.jpg\"}', 1, '2018-03-26 12:35:13', 25, '{\"0\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500}}'),
(3, 6, 'Municipal Event Package2', 'for corporate event', '{\"0\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"5\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":100},\"1\":{\"id\":6,\"name\":\"Floor-length Table\",\"quantity\":\"1\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":500}}', '100-150', 5, '26500', '{\"current_path\":\".\\/package_img\\/package2_1522067879.jpg\",\"image_name\":\"package2_1522067879.jpg\"}', 1, '2018-03-26 12:38:45', 12, '[]'),
(4, 6, 'Municipal Event Package3', 'Acquaintance Party ', '{\"0\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":2000,\"amount\":100},\"1\":{\"id\":26,\"name\":\"Chairs with Ribbon Accent\",\"quantity\":\"150\",\"category\":\"Chairs\",\"subtotal\":4500,\"amount\":30}}', '300-320', 15, '68500', '{\"current_path\":\".\\/package_img\\/package3_1522068237.jpg\",\"image_name\":\"package3_1522068237.jpg\"}', 0, '2018-03-26 12:44:43', 9, '{\"2\":{\"id\":17,\"name\":\"Leche Flan\",\"quantity\":\"4\",\"subtotal\":14000,\"amount\":3500}}'),
(5, 7, 'Debut Package1', 'A debut Celebration', '{\"0\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"5\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":100},\"1\":{\"id\":30,\"name\":\"Foil Balloons\",\"quantity\":\"12\",\"category\":\"Balloons\",\"subtotal\":300,\"amount\":25},\"2\":{\"id\":26,\"name\":\"Chairs with Ribbon Accent\",\"quantity\":\"100\",\"category\":\"Chairs\",\"subtotal\":3000,\"amount\":30}}', '100-130', 6, '40800', '{\"current_path\":\".\\/package_img\\/package1_1522068451.jpg\",\"image_name\":\"package1_1522068451.jpg\"}', 0, '2018-03-26 12:48:17', 11, '{\"2\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"3\":{\"id\":21,\"name\":\"2 Round Cake\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000}}'),
(6, 7, 'Debut Package2', 'A simple elegant debut Celebration', '{\"0\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"5\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":100},\"1\":{\"id\":11,\"name\":\"Guess Chairs\",\"quantity\":\"100\",\"category\":\"Chairs\",\"subtotal\":1500,\"amount\":15},\"2\":{\"id\":31,\"name\":\"Bubble Balloon\",\"quantity\":\"20\",\"category\":\"Balloons\",\"subtotal\":500,\"amount\":25}}', '100-150 ', 5, '44500', '{\"current_path\":\".\\/package_img\\/package2_1522070027.jpg\",\"image_name\":\"package2_1522070027.jpg\"}', 1, '2018-03-26 13:14:33', 9, '{\"0\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"1\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"4\":{\"id\":20,\"name\":\"Mushroom Soup\",\"quantity\":\"2\",\"subtotal\":4000,\"amount\":2000}}'),
(7, 10, 'Birthday Package 1', 'Their party will be one epic adventure with Moana party supplies!\nFeaturing super-vibrant designs of Moana, Maui, tribal art, and flowers, these Moana party supplies are perfect for any Polynesian princess or Moana fan. The complementary paper plates, paper napkins, and paper cups feature the brave Moana, demigod Maui, bright colors, and a lot of adventure.', '{\"0\":{\"id\":6,\"name\":\"Floor-length Table\",\"quantity\":\"2\",\"category\":\"Tables\",\"subtotal\":1000,\"amount\":500},\"1\":{\"id\":12,\"name\":\"Table Cloth\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":300,\"amount\":15},\"2\":{\"id\":3,\"name\":\"Happy Birthday Hats\",\"quantity\":\"100\",\"category\":\"Birthday Hats\",\"subtotal\":1500,\"amount\":15},\"3\":{\"id\":4,\"name\":\"Spoon and Fork\",\"quantity\":\"100\",\"category\":\"Party tools\",\"subtotal\":2000,\"amount\":20},\"4\":{\"id\":10,\"name\":\"Invitation Card\",\"quantity\":\"100\",\"category\":\"Party tools\",\"subtotal\":1500,\"amount\":15},\"5\":{\"id\":22,\"name\":\"Pinyata\",\"quantity\":\"1\",\"category\":\"Party tools\",\"subtotal\":300,\"amount\":300},\"6\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"10\",\"category\":\"Tables\",\"subtotal\":1000,\"amount\":100},\"7\":{\"id\":29,\"name\":\"Latex Balloons\",\"quantity\":\"50\",\"category\":\"Balloons\",\"subtotal\":750,\"amount\":15},\"8\":{\"id\":18,\"name\":\"Personalized Tumbler\",\"quantity\":\"100\",\"category\":\"Birthday giveaways\",\"subtotal\":10000,\"amount\":100}}', '100', 10, '57850', '{\"current_path\":\".\\/package_img\\/birthday_package_1_1522070278.jpg\",\"image_name\":\"birthday_package_1_1522070278.jpg\"}', 1, '2018-03-26 13:18:43', 1, '{\"1\":{\"id\":21,\"name\":\"2 Round Cake\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"3\":{\"id\":18,\"name\":\"Puto\",\"quantity\":\"2\",\"subtotal\":5000,\"amount\":2500},\"4\":{\"id\":13,\"name\":\"Pancit Bihon\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000},\"5\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"6\":{\"id\":19,\"name\":\"Chicken & Corn Soup\",\"quantity\":\"2\",\"subtotal\":4000,\"amount\":2000}}'),
(8, 7, 'Debut Package3', 'Elegant debut ', '{\"0\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":2000,\"amount\":100},\"1\":{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"150\",\"category\":\"Chairs\",\"subtotal\":6750,\"amount\":45}}', '150-200', 10, '76750', '{\"current_path\":\".\\/package_img\\/package3_1522070341.jpg\",\"image_name\":\"package3_1522070341.jpg\"}', 1, '2018-03-26 13:19:47', 19, '{\"0\":{\"id\":22,\"name\":\"3 Round Cake\",\"quantity\":\"1\",\"subtotal\":8000,\"amount\":8000},\"1\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"2\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"3\":{\"id\":12,\"name\":\"Nilasing na Hipon\",\"quantity\":\"1\",\"subtotal\":6500,\"amount\":6500}}'),
(9, 8, 'Reunion package1', 'Reunion', '{\"0\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"10\",\"category\":\"Tables\",\"subtotal\":1000,\"amount\":100},\"1\":{\"id\":11,\"name\":\"Guess Chairs\",\"quantity\":\"170\",\"category\":\"Chairs\",\"subtotal\":2550,\"amount\":15},\"2\":{\"id\":4,\"name\":\"Spoon and Fork\",\"quantity\":\"3\",\"category\":\"Party tools\",\"subtotal\":60,\"amount\":20},\"3\":{\"id\":7,\"name\":\"Photobooth\",\"quantity\":\"2\",\"category\":\"Party tools\",\"subtotal\":7000,\"amount\":3500},\"4\":{\"id\":31,\"name\":\"Bubble Balloon\",\"quantity\":\"20\",\"category\":\"Balloons\",\"subtotal\":500,\"amount\":25}}', '150-200', 5, '46110', '{\"current_path\":\".\\/package_img\\/reunion_package1_1522070621.jpg\",\"image_name\":\"reunion_package1_1522070621.jpg\"}', 1, '2018-03-26 13:24:27', 24, '{\"2\":{\"id\":11,\"name\":\"Relyenong Bangus\",\"quantity\":\"2\",\"subtotal\":9000,\"amount\":4500},\"3\":{\"id\":12,\"name\":\"Nilasing na Hipon\",\"quantity\":\"1\",\"subtotal\":6500,\"amount\":6500},\"4\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500}}'),
(10, 8, 'Reunion package2', 'Reunion', '{\"0\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"10\",\"category\":\"Tables\",\"subtotal\":1000,\"amount\":100},\"1\":{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"170\",\"category\":\"Chairs\",\"subtotal\":7650,\"amount\":45},\"2\":{\"id\":5,\"name\":\"Carpet\",\"quantity\":\"1\",\"category\":\"Party tools\",\"subtotal\":2500,\"amount\":2500},\"3\":{\"id\":7,\"name\":\"Photobooth\",\"quantity\":\"1\",\"category\":\"Party tools\",\"subtotal\":3500,\"amount\":3500}}', '150-200', 5, '55250', '{\"current_path\":\".\\/package_img\\/reunion_package2_1522070754.jpg\",\"image_name\":\"reunion_package2_1522070754.jpg\"}', 1, '2018-03-26 13:26:39', 10, '{\"2\":{\"id\":17,\"name\":\"Leche Flan\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"4\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500}}'),
(11, 8, 'Reunion Package3', 'Reunion', '{\"0\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":2000,\"amount\":100},\"1\":{\"id\":11,\"name\":\"Guess Chairs\",\"quantity\":\"250\",\"category\":\"Chairs\",\"subtotal\":3750,\"amount\":15},\"2\":{\"id\":22,\"name\":\"Pinyata\",\"quantity\":\"3\",\"category\":\"Party_tools\",\"subtotal\":900,\"amount\":300},\"3\":{\"id\":7,\"name\":\"Photobooth\",\"quantity\":\"3\",\"category\":\"Party_tools\",\"subtotal\":10500,\"amount\":3500},\"4\":{\"id\":5,\"name\":\"Carpet\",\"quantity\":\"1\",\"category\":\"Party_tools\",\"subtotal\":2500,\"amount\":2500}}', '200-250', 12, '68150', '{\"current_path\":\".\\/package_img\\/reunion_package3_1522070891.jpg\",\"image_name\":\"reunion_package3_1522070891.jpg\"}', 1, '2018-03-26 13:28:57', 1, '{\"0\":{\"id\":18,\"name\":\"Puto\",\"quantity\":\"5\",\"subtotal\":12500,\"amount\":2500}}'),
(12, 10, 'Birthday Package 2', 'Enter the Mickey Mouse Clubhouse! Mickey Mouse Party Supplies feature full-color images of your favorite Disney mouse on just about everything imaginable, including dinner plates, napkins, cups, invitations, and party favors. With Mickey Mouse-themed party supplies all conveniently located in one place, your little one is in for a super special Mickey Mouse birthday party!', '{\"0\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"15\",\"category\":\"Tables\",\"subtotal\":1500,\"amount\":100},\"1\":{\"id\":6,\"name\":\"Floor-length Table\",\"quantity\":\"2\",\"category\":\"Tables\",\"subtotal\":1000,\"amount\":500},\"2\":{\"id\":3,\"name\":\"Happy Birthday Hats\",\"quantity\":\"150\",\"category\":\"Birthday Hats\",\"subtotal\":2250,\"amount\":15},\"3\":{\"id\":4,\"name\":\"Spoon and Fork\",\"quantity\":\"150\",\"category\":\"Party tools\",\"subtotal\":3000,\"amount\":20},\"4\":{\"id\":7,\"name\":\"Photobooth\",\"quantity\":\"1\",\"category\":\"Party tools\",\"subtotal\":3500,\"amount\":3500},\"5\":{\"id\":10,\"name\":\"Invitation Card\",\"quantity\":\"150\",\"category\":\"Party tools\",\"subtotal\":2250,\"amount\":15},\"6\":{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"150\",\"category\":\"Chairs\",\"subtotal\":6750,\"amount\":45},\"7\":{\"id\":19,\"name\":\"Cute Candies in a Jar\",\"quantity\":\"150\",\"category\":\"Birthday giveaways\",\"subtotal\":12000,\"amount\":80},\"8\":{\"id\":30,\"name\":\"Foil Balloons\",\"quantity\":\"50\",\"category\":\"Balloons\",\"subtotal\":1250,\"amount\":25}}', '150', 15, '84600', '{\"current_path\":\".\\/package_img\\/birthday_package_2_1522071021.jpg\",\"image_name\":\"birthday_package_2_1522071021.jpg\"}', 1, '2018-03-26 13:31:07', 6, '{\"1\":{\"id\":21,\"name\":\"2 Round Cake\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"3\":{\"id\":17,\"name\":\"Leche Flan\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"4\":{\"id\":13,\"name\":\"Pancit Bihon\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"5\":{\"id\":14,\"name\":\"Pancit Palabok\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"6\":{\"id\":20,\"name\":\"Mushroom Soup\",\"quantity\":\"1\",\"subtotal\":2000,\"amount\":2000},\"7\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"1\",\"subtotal\":3500,\"amount\":3500},\"9\":{\"id\":11,\"name\":\"Relyenong Bangus\",\"quantity\":\"2\",\"subtotal\":9000,\"amount\":4500}}'),
(13, 10, 'Birthday Package 3', 'Are you hosting a party at your secret lair? End the experiment: Despicable Me Party Supplies are all you need for a fun-filled themed birthday! Despicable Me Party Supplies feature Gru\'s mischievous Minions on themed plates, napkins and cups. Choose a Despicable Me party kit to take the guesswork out of shopping. Hang the decorations, send out the invitations and hand out the party favors — with Despicable Me Minion Party Supplies, everything matches and stays in theme!', '{\"0\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":2000,\"amount\":100},\"1\":{\"id\":6,\"name\":\"Floor-length Table\",\"quantity\":\"2\",\"category\":\"Tables\",\"subtotal\":1000,\"amount\":500},\"2\":{\"id\":3,\"name\":\"Happy Birthday Hats\",\"quantity\":\"200\",\"category\":\"Birthday Hats\",\"subtotal\":3000,\"amount\":15},\"3\":{\"id\":7,\"name\":\"Photobooth\",\"quantity\":\"1\",\"category\":\"Party tools\",\"subtotal\":3500,\"amount\":3500},\"4\":{\"id\":10,\"name\":\"Invitation Card\",\"quantity\":\"200\",\"category\":\"Party tools\",\"subtotal\":3000,\"amount\":15},\"5\":{\"id\":4,\"name\":\"Spoon and Fork\",\"quantity\":\"200\",\"category\":\"Party tools\",\"subtotal\":4000,\"amount\":20},\"6\":{\"id\":22,\"name\":\"Pinyata\",\"quantity\":\"5\",\"category\":\"Party tools\",\"subtotal\":1500,\"amount\":300},\"7\":{\"id\":11,\"name\":\"Guess Chairs\",\"quantity\":\"200\",\"category\":\"Chairs\",\"subtotal\":3000,\"amount\":15},\"8\":{\"id\":20,\"name\":\"Guitar Keychain\",\"quantity\":\"200\",\"category\":\"Birthday giveaways\",\"subtotal\":6000,\"amount\":30},\"9\":{\"id\":31,\"name\":\"Bubble Balloon\",\"quantity\":\"50\",\"category\":\"Balloons\",\"subtotal\":1250,\"amount\":25}}', '200', 20, '116750', '{\"current_path\":\".\\/package_img\\/birthday_package_3_1522071255.jpg\",\"image_name\":\"birthday_package_3_1522071255.jpg\"}', 0, '2018-03-26 13:35:01', 8, '{\"1\":{\"id\":21,\"name\":\"2 Round Cake\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000},\"3\":{\"id\":12,\"name\":\"Nilasing na Hipon\",\"quantity\":\"2\",\"subtotal\":13000,\"amount\":6500},\"4\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"5\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"6\":{\"id\":13,\"name\":\"Pancit Bihon\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000},\"7\":{\"id\":17,\"name\":\"Leche Flan\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"8\":{\"id\":20,\"name\":\"Mushroom Soup\",\"quantity\":\"1\",\"subtotal\":2000,\"amount\":2000},\"9\":{\"id\":19,\"name\":\"Chicken & Corn Soup\",\"quantity\":\"1\",\"subtotal\":2000,\"amount\":2000}}'),
(14, 11, 'Wedding Package 1', 'Draw inspiration from decades past if you want a vintage style for your wedding—and one of the easiest ways to channel this is through your wedding outfit and beauty look. As for the ceremony and reception, you can rely on antique-looking decor, like weathered doors and worn-in wood seats, to further exemplify a vintage-inspired wedding. For your last hoorah, finish off the vintage theme driving away in a classic getaway car, like an old Porsche or Volkswagen.', '{\"0\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"10\",\"category\":\"Tables\",\"subtotal\":1000,\"amount\":100},\"1\":{\"id\":6,\"name\":\"Floor-length Table\",\"quantity\":\"1\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":500},\"2\":{\"id\":12,\"name\":\"Table Cloth\",\"quantity\":\"10\",\"category\":\"Tables\",\"subtotal\":150,\"amount\":15},\"3\":{\"id\":4,\"name\":\"Spoon and Fork\",\"quantity\":\"100\",\"category\":\"Party_tools\",\"subtotal\":2000,\"amount\":20},\"4\":{\"id\":5,\"name\":\"Carpet\",\"quantity\":\"1\",\"category\":\"Party_tools\",\"subtotal\":2500,\"amount\":2500},\"5\":{\"id\":7,\"name\":\"Photobooth\",\"quantity\":\"1\",\"category\":\"Party_tools\",\"subtotal\":3500,\"amount\":3500},\"6\":{\"id\":10,\"name\":\"Invitation Card\",\"quantity\":\"100\",\"category\":\"Party_tools\",\"subtotal\":1500,\"amount\":15},\"7\":{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"100\",\"category\":\"Chairs\",\"subtotal\":4500,\"amount\":45},\"8\":{\"id\":17,\"name\":\"Antique Key\",\"quantity\":\"100\",\"category\":\"Wedding_Souvenirs\",\"subtotal\":3000,\"amount\":30}}', '100', 10, '53650', '{\"current_path\":\".\\/package_img\\/wedding_package_1_1522071504.jpg\",\"image_name\":\"wedding_package_1_1522071504.jpg\"}', 1, '2018-03-26 13:39:10', 11, '{\"0\":{\"id\":17,\"name\":\"Leche Flan\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"1\":{\"id\":14,\"name\":\"Pancit Palabok\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"2\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"1\",\"subtotal\":3500,\"amount\":3500},\"3\":{\"id\":19,\"name\":\"Chicken & Corn Soup\",\"quantity\":\"1\",\"subtotal\":2000,\"amount\":2000},\"4\":{\"id\":22,\"name\":\"3 Round Cake\",\"quantity\":\"1\",\"subtotal\":8000,\"amount\":8000}}'),
(15, 11, 'Wedding Package 2', 'For the whimsical couple, your wedding will be one of bright splashes of color and quirky, bohemian components. Incorporate design elements like multicolored balloons, streamers, punchy floral arrangements, and mismatched chairs if you and your future groom want to plan a whimsical wedding.', '{\"0\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"15\",\"category\":\"Tables\",\"subtotal\":1500,\"amount\":100},\"1\":{\"id\":12,\"name\":\"Table Cloth\",\"quantity\":\"15\",\"category\":\"Tables\",\"subtotal\":225,\"amount\":15},\"2\":{\"id\":6,\"name\":\"Floor-length Table\",\"quantity\":\"2\",\"category\":\"Tables\",\"subtotal\":1000,\"amount\":500},\"3\":{\"id\":13,\"name\":\"Gift Table\",\"quantity\":\"1\",\"category\":\"Tables\",\"subtotal\":150,\"amount\":150},\"4\":{\"id\":4,\"name\":\"Spoon and Fork\",\"quantity\":\"150\",\"category\":\"Party_tools\",\"subtotal\":3000,\"amount\":20},\"5\":{\"id\":7,\"name\":\"Photobooth\",\"quantity\":\"1\",\"category\":\"Party_tools\",\"subtotal\":3500,\"amount\":3500},\"6\":{\"id\":10,\"name\":\"Invitation Card\",\"quantity\":\"150\",\"category\":\"Party_tools\",\"subtotal\":2250,\"amount\":15},\"7\":{\"id\":5,\"name\":\"Carpet\",\"quantity\":\"1\",\"category\":\"Party_tools\",\"subtotal\":2500,\"amount\":2500},\"8\":{\"id\":27,\"name\":\"Couple and Parents Chairs\",\"quantity\":\"1\",\"category\":\"Chairs\",\"subtotal\":100,\"amount\":100},\"9\":{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"150\",\"category\":\"Chairs\",\"subtotal\":6750,\"amount\":45},\"10\":{\"id\":29,\"name\":\"Latex Balloons\",\"quantity\":\"30\",\"category\":\"Balloons\",\"subtotal\":450,\"amount\":15},\"11\":{\"id\":16,\"name\":\"Clay Doll\",\"quantity\":\"150\",\"category\":\"Wedding_Souvenirs\",\"subtotal\":7500,\"amount\":50}}', '150', 15, '95925', '{\"current_path\":\".\\/package_img\\/wedding_package_2_1522071737.jpg\",\"image_name\":\"wedding_package_2_1522071737.jpg\"}', 1, '2018-03-26 13:43:03', 12, '{\"0\":{\"id\":22,\"name\":\"3 Round Cake\",\"quantity\":\"1\",\"subtotal\":8000,\"amount\":8000},\"1\":{\"id\":18,\"name\":\"Puto\",\"quantity\":\"2\",\"subtotal\":5000,\"amount\":2500},\"2\":{\"id\":13,\"name\":\"Pancit Bihon\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"3\":{\"id\":14,\"name\":\"Pancit Palabok\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"4\":{\"id\":19,\"name\":\"Chicken & Corn Soup\",\"quantity\":\"1\",\"subtotal\":2000,\"amount\":2000},\"5\":{\"id\":12,\"name\":\"Nilasing na Hipon\",\"quantity\":\"1\",\"subtotal\":6500,\"amount\":6500}}'),
(16, 11, 'Wedding Package 3', 'If you envision a more intimate, casual ceremony, opt for an outdoor garden party-themed wedding. This laid-back style is perfect if you have a backyard wedding on the brain and a spring or summer date.', '{\"0\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":2000,\"amount\":100},\"1\":{\"id\":6,\"name\":\"Floor-length Table\",\"quantity\":\"2\",\"category\":\"Tables\",\"subtotal\":1000,\"amount\":500},\"2\":{\"id\":12,\"name\":\"Table Cloth\",\"quantity\":\"200\",\"category\":\"Tables\",\"subtotal\":3000,\"amount\":15},\"3\":{\"id\":13,\"name\":\"Gift Table\",\"quantity\":\"2\",\"category\":\"Tables\",\"subtotal\":300,\"amount\":150},\"4\":{\"id\":4,\"name\":\"Spoon and Fork\",\"quantity\":\"200\",\"category\":\"Party_tools\",\"subtotal\":4000,\"amount\":20},\"5\":{\"id\":10,\"name\":\"Invitation Card\",\"quantity\":\"200\",\"category\":\"Party_tools\",\"subtotal\":3000,\"amount\":15},\"6\":{\"id\":7,\"name\":\"Photobooth\",\"quantity\":\"1\",\"category\":\"Party_tools\",\"subtotal\":3500,\"amount\":3500},\"7\":{\"id\":5,\"name\":\"Carpet\",\"quantity\":\"1\",\"category\":\"Party_tools\",\"subtotal\":2500,\"amount\":2500},\"8\":{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"200\",\"category\":\"Chairs\",\"subtotal\":9000,\"amount\":45},\"9\":{\"id\":14,\"name\":\"\'Will you marry me \' Figurine\",\"quantity\":\"200\",\"category\":\"Wedding_Souvenirs\",\"subtotal\":5000,\"amount\":25},\"10\":{\"id\":31,\"name\":\"Bubble Balloon\",\"quantity\":\"50\",\"category\":\"Balloons\",\"subtotal\":1250,\"amount\":25},\"11\":{\"id\":29,\"name\":\"Latex Balloons\",\"quantity\":\"50\",\"category\":\"Balloons\",\"subtotal\":750,\"amount\":15}}', '200', 20, '121300', '{\"current_path\":\".\\/package_img\\/wedding_package_3_1522071991.jpg\",\"image_name\":\"wedding_package_3_1522071991.jpg\"}', 0, '2018-03-26 13:47:17', 13, '{\"0\":{\"id\":23,\"name\":\"4 Round Cake\",\"quantity\":\"1\",\"subtotal\":12000,\"amount\":12000},\"1\":{\"id\":18,\"name\":\"Puto\",\"quantity\":\"2\",\"subtotal\":5000,\"amount\":2500},\"2\":{\"id\":13,\"name\":\"Pancit Bihon\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000},\"3\":{\"id\":14,\"name\":\"Pancit Palabok\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000},\"4\":{\"id\":12,\"name\":\"Nilasing na Hipon\",\"quantity\":\"2\",\"subtotal\":13000,\"amount\":6500},\"5\":{\"id\":11,\"name\":\"Relyenong Bangus\",\"quantity\":\"2\",\"subtotal\":9000,\"amount\":4500}}'),
(17, 9, 'Baptismal Package 1', 'Blue and white pin-stripes pair with tan and gold accents in this regal blue and gold boy’s baptism party. The inviting dessert table can easily be created using a tiered table skirt, monochromatic flowers, and large variety of clear apothecary jars filled with coordinating candy and embellished with ribbon ties and printable labels.', '{\"0\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"10\",\"category\":\"Tables\",\"subtotal\":1000,\"amount\":100},\"1\":{\"id\":6,\"name\":\"Floor-length Table\",\"quantity\":\"1\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":500},\"2\":{\"id\":12,\"name\":\"Table Cloth\",\"quantity\":\"10\",\"category\":\"Tables\",\"subtotal\":150,\"amount\":15},\"3\":{\"id\":13,\"name\":\"Gift Table\",\"quantity\":\"1\",\"category\":\"Tables\",\"subtotal\":150,\"amount\":150},\"4\":{\"id\":4,\"name\":\"Spoon and Fork\",\"quantity\":\"100\",\"category\":\"Party_tools\",\"subtotal\":2000,\"amount\":20},\"5\":{\"id\":10,\"name\":\"Invitation Card\",\"quantity\":\"100\",\"category\":\"Party_tools\",\"subtotal\":1500,\"amount\":15},\"6\":{\"id\":7,\"name\":\"Photobooth\",\"quantity\":\"1\",\"category\":\"Party_tools\",\"subtotal\":3500,\"amount\":3500},\"7\":{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"100\",\"category\":\"Chairs\",\"subtotal\":4500,\"amount\":45},\"8\":{\"id\":29,\"name\":\"Latex Balloons\",\"quantity\":\"50\",\"category\":\"Balloons\",\"subtotal\":750,\"amount\":15},\"9\":{\"id\":32,\"name\":\"Angel Figurine\",\"quantity\":\"100\",\"category\":\"Baptism_Souvenirs\",\"subtotal\":2500,\"amount\":25}}', '100', 10, '44050', '{\"current_path\":\".\\/package_img\\/baptismal_package_1_1522072203.jpg\",\"image_name\":\"baptismal_package_1_1522072203.jpg\"}', 1, '2018-03-26 13:50:49', 18, '{\"0\":{\"id\":21,\"name\":\"2 Round Cake\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"1\":{\"id\":18,\"name\":\"Puto\",\"quantity\":\"1\",\"subtotal\":2500,\"amount\":2500},\"2\":{\"id\":13,\"name\":\"Pancit Bihon\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"3\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"1\",\"subtotal\":3500,\"amount\":3500},\"4\":{\"id\":20,\"name\":\"Mushroom Soup\",\"quantity\":\"1\",\"subtotal\":2000,\"amount\":2000}}'),
(18, 9, 'Baptismal Package 2', 'Celebrate a fall baptism with a fall themed baptism party! This one comes complete with ombre fall hues and textures used to decorate place settings, a refreshment area and pie dessert table.', '{\"0\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"15\",\"category\":\"Tables\",\"subtotal\":1500,\"amount\":100},\"1\":{\"id\":6,\"name\":\"Floor-length Table\",\"quantity\":\"1\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":500},\"2\":{\"id\":12,\"name\":\"Table Cloth\",\"quantity\":\"15\",\"category\":\"Tables\",\"subtotal\":225,\"amount\":15},\"3\":{\"id\":13,\"name\":\"Gift Table\",\"quantity\":\"1\",\"category\":\"Tables\",\"subtotal\":150,\"amount\":150},\"4\":{\"id\":4,\"name\":\"Spoon and Fork\",\"quantity\":\"150\",\"category\":\"Party_tools\",\"subtotal\":3000,\"amount\":20},\"5\":{\"id\":10,\"name\":\"Invitation Card\",\"quantity\":\"150\",\"category\":\"Party_tools\",\"subtotal\":2250,\"amount\":15},\"6\":{\"id\":7,\"name\":\"Photobooth\",\"quantity\":\"1\",\"category\":\"Party_tools\",\"subtotal\":3500,\"amount\":3500},\"7\":{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"150\",\"category\":\"Chairs\",\"subtotal\":6750,\"amount\":45},\"8\":{\"id\":33,\"name\":\"Pokemon Keychain\",\"quantity\":\"100\",\"category\":\"Baptism_Souvenirs\",\"subtotal\":2500,\"amount\":25}}', '150', 15, '60875', '{\"current_path\":\".\\/package_img\\/baptismal_package_2_1522072640.jpg\",\"image_name\":\"baptismal_package_2_1522072640.jpg\"}', 1, '2018-03-26 13:58:06', 19, '{\"0\":{\"id\":21,\"name\":\"2 Round Cake\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"1\":{\"id\":20,\"name\":\"Mushroom Soup\",\"quantity\":\"1\",\"subtotal\":2000,\"amount\":2000},\"2\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"1\",\"subtotal\":3500,\"amount\":3500},\"3\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"1\",\"subtotal\":3500,\"amount\":3500},\"4\":{\"id\":13,\"name\":\"Pancit Bihon\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"5\":{\"id\":17,\"name\":\"Leche Flan\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500}}'),
(19, 9, 'Baptismal Package 3', 'You’re sure to be carried away by the amazing styling and elegant details of this hot air balloon baptism party which boasts a gorgeous sky inspired cake and full dessert table, plus airy decorations. I’m obsessed with the hot air balloon props, but also love the cloud cookie pops and cupcakes!', '{\"0\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":2000,\"amount\":100},\"1\":{\"id\":6,\"name\":\"Floor-length Table\",\"quantity\":\"2\",\"category\":\"Tables\",\"subtotal\":1000,\"amount\":500},\"2\":{\"id\":12,\"name\":\"Table Cloth\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":300,\"amount\":15},\"3\":{\"id\":13,\"name\":\"Gift Table\",\"quantity\":\"2\",\"category\":\"Tables\",\"subtotal\":300,\"amount\":150},\"4\":{\"id\":4,\"name\":\"Spoon and Fork\",\"quantity\":\"200\",\"category\":\"Party_tools\",\"subtotal\":4000,\"amount\":20},\"5\":{\"id\":7,\"name\":\"Photobooth\",\"quantity\":\"1\",\"category\":\"Party_tools\",\"subtotal\":3500,\"amount\":3500},\"6\":{\"id\":10,\"name\":\"Invitation Card\",\"quantity\":\"200\",\"category\":\"Party_tools\",\"subtotal\":3000,\"amount\":15},\"7\":{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"200\",\"category\":\"Chairs\",\"subtotal\":9000,\"amount\":45},\"8\":{\"id\":31,\"name\":\"Bubble Balloon\",\"quantity\":\"55\",\"category\":\"Balloons\",\"subtotal\":1375,\"amount\":25},\"9\":{\"id\":35,\"name\":\"Personalized Cancer\",\"quantity\":\"200\",\"category\":\"Baptism_Souvenirs\",\"subtotal\":3000,\"amount\":15}}', '200', 25, '117075', '{\"current_path\":\".\\/package_img\\/baptismal_package_3_1522072893.jpg\",\"image_name\":\"baptismal_package_3_1522072893.jpg\"}', 0, '2018-03-26 14:02:19', 21, '{\"0\":{\"id\":21,\"name\":\"2 Round Cake\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"1\":{\"id\":17,\"name\":\"Leche Flan\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"2\":{\"id\":13,\"name\":\"Pancit Bihon\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000},\"3\":{\"id\":14,\"name\":\"Pancit Palabok\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000},\"4\":{\"id\":20,\"name\":\"Mushroom Soup\",\"quantity\":\"1\",\"subtotal\":2000,\"amount\":2000},\"5\":{\"id\":12,\"name\":\"Nilasing na Hipon\",\"quantity\":\"1\",\"subtotal\":6500,\"amount\":6500}}'),
(20, 7, 'sample', 'test', '{\"0\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"1\",\"category\":\"Tables\",\"subtotal\":100,\"amount\":100}}', '14', 11, '2100', '{\"current_path\":\".\\/package_img\\/sample_1522763640.jpg\",\"image_name\":\"sample_1522763640.jpg\"}', 0, '2018-04-03 13:54:00', 3, '{}'),
(21, 13, 'pax1', 'for surprises', '{\"0\":{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"1\",\"category\":\"Tables\",\"subtotal\":100,\"amount\":100}}', '100', 5, '9100', '{\"current_path\":\".\\/package_img\\/pax1_1523884549.jpeg\",\"image_name\":\"pax1_1523884549.jpeg\"}', 0, '2018-04-16 13:15:49', 1, '{\"0\":{\"id\":22,\"name\":\"3 Round Cake\",\"quantity\":\"1\",\"subtotal\":8000,\"amount\":8000}}');

-- --------------------------------------------------------

--
-- Table structure for table `t_past_events`
--

CREATE TABLE `t_past_events` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `image` text,
  `additional_desc` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_featured` smallint(6) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_past_events`
--

INSERT INTO `t_past_events` (`id`, `title`, `description`, `image`, `additional_desc`, `date_created`, `is_featured`) VALUES
(1, 'Sample Past event', 'Hey you!\r\n<br>\r\n\r\n<b> HAHAHAHA </b>', '{\"current_path\":\".\\/past_event_images\\/sample_past_event\\/sample_past_event_1521996712.jpg\",\"image_name\":\"sample_past_event_1521996712.jpg\"}', 'Mr and Ms Something', '2018-03-25 16:51:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_reservations`
--

CREATE TABLE `t_reservations` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_contact` varchar(11) DEFAULT NULL,
  `customer_address` text,
  `date_of_event` date DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `package_items` text,
  `total_amount` double DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `event_completed` smallint(6) DEFAULT '0',
  `date_of_reservation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `reservation_code` varchar(10) DEFAULT NULL,
  `reject_reason` text,
  `foods` text,
  `theme_id` int(11) DEFAULT NULL,
  `theme_desc` text,
  `cancelled_flag` smallint(6) DEFAULT NULL,
  `cancellation_details` text,
  `valid_document` text,
  `venue_id` int(11) DEFAULT NULL,
  `custom_venue` text,
  `event_time` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_reservations`
--

INSERT INTO `t_reservations` (`id`, `customer_name`, `customer_email`, `customer_contact`, `customer_address`, `date_of_event`, `package_id`, `package_items`, `total_amount`, `status`, `event_completed`, `date_of_reservation`, `reservation_code`, `reject_reason`, `foods`, `theme_id`, `theme_desc`, `cancelled_flag`, `cancellation_details`, `valid_document`, `venue_id`, `custom_venue`, `event_time`) VALUES
(1, 'Shiela Mae  Agustin', 'shiela16@yahoo.com', '09364553227', ' B7 L7 Cabilang Baybay Carmona Cavite', '2018-04-04', 2, '[{\"id\":11,\"name\":\"Guess Chairs\",\"quantity\":\"100\",\"category\":\"Chairs\",\"subtotal\":1500,\"amount\":15},{\"id\":6,\"name\":\"Floor-length Table\",\"quantity\":\"5\",\"category\":\"Tables\",\"subtotal\":2500,\"amount\":500}]', 53000, 'rejected', 0, '2018-03-27 03:09:28', 'MOX8HYFYW1', 'no 50% downpayment', '{\"0\":{\"id\":5,\"name\":\"Beef Caldereta\",\"quantity\":\"3\",\"subtotal\":4500,\"amount\":1500},\"1\":{\"id\":6,\"name\":\"Beef Teriyaki\",\"quantity\":\"3\",\"subtotal\":15000,\"amount\":5000},\"2\":{\"id\":8,\"name\":\"Chicken Curry\",\"quantity\":\"3\",\"subtotal\":18000,\"amount\":6000},\"3\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500}}', 25, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/shiela_mae__agustin_1522120121.jpg\",\"image_name\":\"shiela_mae__agustin_1522120121.jpg\"}', 1, NULL, NULL),
(2, 'jae  min', 'bhabyjen.asiatico96@gmail.com', '09568857848', ' B21 L21 dalkaej daegu', '2018-04-03', 18, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"15\",\"category\":\"Tables\",\"subtotal\":1500,\"amount\":100},{\"id\":6,\"name\":\"Floor-length Table\",\"quantity\":\"1\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":500},{\"id\":12,\"name\":\"Table Cloth\",\"quantity\":\"15\",\"category\":\"Tables\",\"subtotal\":225,\"amount\":15},{\"id\":13,\"name\":\"Gift Table\",\"quantity\":\"1\",\"category\":\"Tables\",\"subtotal\":150,\"amount\":150},{\"id\":4,\"name\":\"Spoon and Fork\",\"quantity\":\"150\",\"category\":\"Party tools\",\"subtotal\":3000,\"amount\":20},{\"id\":10,\"name\":\"Invitation Card\",\"quantity\":\"150\",\"category\":\"Party tools\",\"subtotal\":2250,\"amount\":15},{\"id\":7,\"name\":\"Photobooth\",\"quantity\":\"1\",\"category\":\"Party tools\",\"subtotal\":3500,\"amount\":3500},{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"150\",\"category\":\"Chairs\",\"subtotal\":6750,\"amount\":45},{\"id\":33,\"name\":\"Pokemon Keychain\",\"quantity\":\"100\",\"category\":\"Baptism Souvenirs\",\"subtotal\":2500,\"amount\":25}]', 70875, 'rejected', 0, '2018-03-27 03:12:58', 'GF81PXQSX2', 'no 50% downpayment', '{\"0\":{\"id\":5,\"name\":\"Beef Caldereta\",\"quantity\":\"1\",\"subtotal\":1500,\"amount\":1500},\"1\":{\"id\":21,\"name\":\"2 Round Cake\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"2\":{\"id\":9,\"name\":\"Chopsuey\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"3\":{\"id\":10,\"name\":\"Lumpiang Sariwa\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"4\":{\"id\":20,\"name\":\"Mushroom Soup\",\"quantity\":\"1\",\"subtotal\":2000,\"amount\":2000},\"5\":{\"id\":2,\"name\":\"Pork Menudo\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"6\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"1\",\"subtotal\":3500,\"amount\":3500},\"7\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"1\",\"subtotal\":3500,\"amount\":3500},\"8\":{\"id\":7,\"name\":\"Chicken Barbeque\",\"quantity\":\"1\",\"subtotal\":6000,\"amount\":6000},\"9\":{\"id\":13,\"name\":\"Pancit Bihon\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"10\":{\"id\":17,\"name\":\"Leche Flan\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500}}', 19, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/jae__min_1522120331.jpg\",\"image_name\":\"jae__min_1522120331.jpg\"}', 1, NULL, NULL),
(3, 'j  dope', 'bhabyjen.asiatico96@gmail.com', '09568857548', 'House #12 B21 L21 busan sokor', '2018-04-03', 16, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":2000,\"amount\":100},{\"id\":6,\"name\":\"Floor-length Table\",\"quantity\":\"2\",\"category\":\"Tables\",\"subtotal\":1000,\"amount\":500},{\"id\":12,\"name\":\"Table Cloth\",\"quantity\":\"200\",\"category\":\"Tables\",\"subtotal\":3000,\"amount\":15},{\"id\":13,\"name\":\"Gift Table\",\"quantity\":\"2\",\"category\":\"Tables\",\"subtotal\":300,\"amount\":150},{\"id\":4,\"name\":\"Spoon and Fork\",\"quantity\":\"200\",\"category\":\"Party tools\",\"subtotal\":4000,\"amount\":20},{\"id\":10,\"name\":\"Invitation Card\",\"quantity\":\"200\",\"category\":\"Party tools\",\"subtotal\":3000,\"amount\":15},{\"id\":7,\"name\":\"Photobooth\",\"quantity\":\"1\",\"category\":\"Party tools\",\"subtotal\":3500,\"amount\":3500},{\"id\":5,\"name\":\"Carpet\",\"quantity\":\"1\",\"category\":\"Party tools\",\"subtotal\":2500,\"amount\":2500},{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"200\",\"category\":\"Chairs\",\"subtotal\":9000,\"amount\":45},{\"id\":14,\"name\":\"\'Will you marry me \' Figurine\",\"quantity\":\"200\",\"category\":\"Wedding Souvenirs\",\"subtotal\":5000,\"amount\":25},{\"id\":31,\"name\":\"Bubble Balloon\",\"quantity\":\"50\",\"category\":\"Balloons\",\"subtotal\":1250,\"amount\":25},{\"id\":29,\"name\":\"Latex Balloons\",\"quantity\":\"50\",\"category\":\"Balloons\",\"subtotal\":750,\"amount\":15}]', 141300, 'rejected', 0, '2018-03-27 03:16:53', '8QOQG23083', '', '{\"0\":{\"id\":5,\"name\":\"Beef Caldereta\",\"quantity\":\"2\",\"subtotal\":3000,\"amount\":1500},\"1\":{\"id\":23,\"name\":\"4 Round Cake\",\"quantity\":\"1\",\"subtotal\":12000,\"amount\":12000},\"2\":{\"id\":7,\"name\":\"Chicken Barbeque\",\"quantity\":\"2\",\"subtotal\":12000,\"amount\":6000},\"3\":{\"id\":18,\"name\":\"Puto\",\"quantity\":\"2\",\"subtotal\":5000,\"amount\":2500},\"4\":{\"id\":13,\"name\":\"Pancit Bihon\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000},\"5\":{\"id\":14,\"name\":\"Pancit Palabok\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000},\"6\":{\"id\":12,\"name\":\"Nilasing na Hipon\",\"quantity\":\"2\",\"subtotal\":13000,\"amount\":6500},\"7\":{\"id\":11,\"name\":\"Relyenong Bangus\",\"quantity\":\"2\",\"subtotal\":9000,\"amount\":4500},\"8\":{\"id\":2,\"name\":\"Pork Menudo\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000},\"9\":{\"id\":9,\"name\":\"Chopsuey\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000},\"10\":{\"id\":10,\"name\":\"Lumpiang Sariwa\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000}}', 13, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/j__dope_1522120566.jpg\",\"image_name\":\"j__dope_1522120566.jpg\"}', 0, 'Enchanted Kingdom', NULL),
(4, 'Ma. Josefina  Dela Cruz', 'bhabyjen.asiatico96@gmail.com', '09198136249', ' B2 L2 Brgy. Estrada Manila CIty', '2018-04-05', NULL, '{\"0\":{\"id\":\"18\",\"name\":\"Personalized Tumbler\",\"quantity\":\"100\",\"subtotal\":\"10000\",\"price\":\"100\"}}', 16000, 'rejected', 0, '2018-03-27 03:25:46', 'V5NXDG7P84', '5 day no down payment policy', '{\"0\":{\"id\":\"1\",\"name\":\"Pork Hamonado\",\"quantity\":\"1\",\"subtotal\":\"5000\",\"price\":\"5000\"}}', 1, '', NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/ma._josefina__dela_cruz_1522121099.jpg\",\"image_name\":\"ma._josefina__dela_cruz_1522121099.jpg\"}', 0, 'Jollibee', NULL),
(5, 'Maria Josefina  Dela Cruz', 'shiela16@yahoo.com', '09364553227', 'House #10374 San Pablo St Carmona Cavite', '2018-04-10', 13, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":2000,\"amount\":100},{\"id\":6,\"name\":\"Floor-length Table\",\"quantity\":\"2\",\"category\":\"Tables\",\"subtotal\":1000,\"amount\":500},{\"id\":3,\"name\":\"Happy Birthday Hats\",\"quantity\":\"200\",\"category\":\"Birthday Hats\",\"subtotal\":3000,\"amount\":15},{\"id\":7,\"name\":\"Photobooth\",\"quantity\":\"1\",\"category\":\"Party tools\",\"subtotal\":3500,\"amount\":3500},{\"id\":10,\"name\":\"Invitation Card\",\"quantity\":\"200\",\"category\":\"Party tools\",\"subtotal\":3000,\"amount\":15},{\"id\":4,\"name\":\"Spoon and Fork\",\"quantity\":\"200\",\"category\":\"Party tools\",\"subtotal\":4000,\"amount\":20},{\"id\":22,\"name\":\"Pinyata\",\"quantity\":\"5\",\"category\":\"Party tools\",\"subtotal\":1500,\"amount\":300},{\"id\":11,\"name\":\"Guess Chairs\",\"quantity\":\"200\",\"category\":\"Chairs\",\"subtotal\":3000,\"amount\":15},{\"id\":20,\"name\":\"Guitar Keychain\",\"quantity\":\"200\",\"category\":\"Birthday giveaways\",\"subtotal\":6000,\"amount\":30},{\"id\":31,\"name\":\"Bubble Balloon\",\"quantity\":\"50\",\"category\":\"Balloons\",\"subtotal\":1250,\"amount\":25}]', 116750, 'rejected', 0, '2018-03-27 03:25:46', '4T84UFB9M5', '5 day no down payment policy', '{\"0\":{\"id\":5,\"name\":\"Beef Caldereta\",\"quantity\":\"2\",\"subtotal\":3000,\"amount\":1500},\"1\":{\"id\":21,\"name\":\"2 Round Cake\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000},\"2\":{\"id\":7,\"name\":\"Chicken Barbeque\",\"quantity\":\"2\",\"subtotal\":12000,\"amount\":6000},\"3\":{\"id\":12,\"name\":\"Nilasing na Hipon\",\"quantity\":\"2\",\"subtotal\":13000,\"amount\":6500},\"4\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"5\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"6\":{\"id\":13,\"name\":\"Pancit Bihon\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000},\"7\":{\"id\":17,\"name\":\"Leche Flan\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"8\":{\"id\":20,\"name\":\"Mushroom Soup\",\"quantity\":\"1\",\"subtotal\":2000,\"amount\":2000},\"9\":{\"id\":19,\"name\":\"Chicken & Corn Soup\",\"quantity\":\"1\",\"subtotal\":2000,\"amount\":2000},\"10\":{\"id\":2,\"name\":\"Pork Menudo\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000}}', 8, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/maria_josefina__dela_cruz_1522121100.jpg\",\"image_name\":\"maria_josefina__dela_cruz_1522121100.jpg\"}', 1, NULL, NULL),
(6, 'Jose Antonio Tan Bonifacio', 'bhabyjen.asiatico96@gmail.com', '09198136249', 'House #4452 Ilocto Compount Santolan Rd Gen T. De Leon', '2018-04-10', 10, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"10\",\"category\":\"Tables\",\"subtotal\":1000,\"amount\":100},{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"170\",\"category\":\"Chairs\",\"subtotal\":7650,\"amount\":45},{\"id\":5,\"name\":\"Carpet\",\"quantity\":\"1\",\"category\":\"Party tools\",\"subtotal\":2500,\"amount\":2500},{\"id\":7,\"name\":\"Photobooth\",\"quantity\":\"1\",\"category\":\"Party tools\",\"subtotal\":3500,\"amount\":3500}]', 55250, 'rejected', 0, '2018-03-27 03:30:24', 'VW8ITGFVI6', '5 day no down payment policy', '{\"0\":{\"id\":5,\"name\":\"Beef Caldereta\",\"quantity\":\"3\",\"subtotal\":4500,\"amount\":1500},\"1\":{\"id\":6,\"name\":\"Beef Teriyaki\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000},\"2\":{\"id\":17,\"name\":\"Leche Flan\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"3\":{\"id\":1,\"name\":\"Pork Hamonado\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000},\"4\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500}}', 10, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/jose_antonio_tan_bonifacio_1522121378.jpg\",\"image_name\":\"jose_antonio_tan_bonifacio_1522121378.jpg\"}', 1, NULL, NULL),
(7, 'Roella  White', 'shiela16@yahoo.com', '09363443227', ' B8 L8 Narra St. Bacoor Cavite', '2018-05-10', NULL, '{\"0\":{\"id\":\"12\",\"name\":\"Table Cloth\",\"quantity\":\"30\",\"subtotal\":\"450\",\"price\":\"15\"},\"1\":{\"id\":\"11\",\"name\":\"Guess Chairs\",\"quantity\":\"130\",\"subtotal\":\"1950\",\"price\":\"15\"}}', 24400, 'rejected', 0, '2018-03-27 03:39:45', '8XD58Y0S67', '5 day no down payment policy', '{\"0\":{\"id\":\"1\",\"name\":\"Pork Hamonado\",\"quantity\":\"1\",\"subtotal\":\"5000\",\"price\":\"5000\"},\"1\":{\"id\":\"7\",\"name\":\"Chicken Barbeque\",\"quantity\":\"1\",\"subtotal\":\"6000\",\"price\":\"6000\"},\"2\":{\"id\":\"18\",\"name\":\"Puto\",\"quantity\":\"4\",\"subtotal\":\"10000\",\"price\":\"2500\"}}', 12, '', NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/roella__white_1522121938.jpg\",\"image_name\":\"roella__white_1522121938.jpg\"}', 0, 'none', NULL),
(8, 'Edith Joyce Orquia Saragal', 'bhabyjen.asiatico96@gmail.com', '09198136249', 'House #16 Hagen St.', '2018-04-17', NULL, '{\"0\":{\"id\":\"8\",\"name\":\"Emcee\",\"quantity\":\"1\",\"subtotal\":\"2500\",\"price\":\"2500\"},\"1\":{\"id\":\"9\",\"name\":\"Uniformed Waiters\",\"quantity\":\"10\",\"subtotal\":\"15000\",\"price\":\"1500\"},\"2\":{\"id\":\"1\",\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"10\",\"subtotal\":\"1000\",\"price\":\"100\"},\"3\":{\"id\":\"6\",\"name\":\"Floor-length Table\",\"quantity\":\"1\",\"subtotal\":\"500\",\"price\":\"500\"},\"4\":{\"id\":\"12\",\"name\":\"Table Cloth\",\"quantity\":\"10\",\"subtotal\":\"150\",\"price\":\"15\"},\"5\":{\"id\":\"4\",\"name\":\"Spoon and Fork\",\"quantity\":\"100\",\"subtotal\":\"2000\",\"price\":\"20\"},\"6\":{\"id\":\"10\",\"name\":\"Invitation Card\",\"quantity\":\"100\",\"subtotal\":\"1500\",\"price\":\"15\"},\"7\":{\"id\":\"7\",\"name\":\"Photobooth\",\"quantity\":\"1\",\"subtotal\":\"3500\",\"price\":\"3500\"},\"8\":{\"id\":\"28\",\"name\":\"Chairs with cloth\",\"quantity\":\"100\",\"subtotal\":\"4500\",\"price\":\"45\"},\"9\":{\"id\":\"29\",\"name\":\"Latex Balloons\",\"quantity\":\"15\",\"subtotal\":\"225\",\"price\":\"15\"},\"10\":{\"id\":\"35\",\"name\":\"Personalized Candles\",\"quantity\":\"100\",\"subtotal\":\"1500\",\"price\":\"15\"}}', 67875, 'rejected', 0, '2018-03-27 03:42:23', '5FWO5FA958', 'lack of utensils', '{\"0\":{\"id\":\"1\",\"name\":\"Pork Hamonado\",\"quantity\":\"1\",\"subtotal\":\"5000\",\"price\":\"5000\"},\"1\":{\"id\":\"5\",\"name\":\"Beef Caldereta\",\"quantity\":\"1\",\"subtotal\":\"1500\",\"price\":\"1500\"},\"2\":{\"id\":\"9\",\"name\":\"Chopsuey\",\"quantity\":\"1\",\"subtotal\":\"5000\",\"price\":\"5000\"},\"3\":{\"id\":\"11\",\"name\":\"Relyenong Bangus\",\"quantity\":\"1\",\"subtotal\":\"4500\",\"price\":\"4500\"},\"4\":{\"id\":\"14\",\"name\":\"Pancit Palabok\",\"quantity\":\"1\",\"subtotal\":\"5000\",\"price\":\"5000\"},\"5\":{\"id\":\"15\",\"name\":\"Spaghetti\",\"quantity\":\"1\",\"subtotal\":\"3500\",\"price\":\"3500\"},\"6\":{\"id\":\"17\",\"name\":\"Leche Flan\",\"quantity\":\"1\",\"subtotal\":\"3500\",\"price\":\"3500\"},\"7\":{\"id\":\"18\",\"name\":\"Puto\",\"quantity\":\"1\",\"subtotal\":\"2500\",\"price\":\"2500\"},\"8\":{\"id\":\"21\",\"name\":\"2 Round Cake\",\"quantity\":\"1\",\"subtotal\":\"5000\",\"price\":\"5000\"}}', 0, 'Disney Princess', NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/edith_joyce_orquia_saragal_1522122096.jpg\",\"image_name\":\"edith_joyce_orquia_saragal_1522122096.jpg\"}', 0, 'Alta Tierra Club House', NULL),
(9, 'jen  asiatico', 'shiela16@yahoo.com', '09568857848', ' B23 L23 olaes cavite', '2018-04-03', NULL, '{\"0\":{\"id\":\"11\",\"name\":\"Guess Chairs\",\"quantity\":\"4\",\"subtotal\":\"60\",\"price\":\"15\"}}', 11560, 'rejected', 0, '2018-03-27 09:11:50', 'PRG1G65EK9', 'moana theme is not available', '{\"0\":{\"id\":\"15\",\"name\":\"Spaghetti\",\"quantity\":\"3\",\"subtotal\":\"10500\",\"price\":\"3500\"}}', 1, '', NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/jen__asiatico_1522141863.jpg\",\"image_name\":\"jen__asiatico_1522141863.jpg\"}', 0, 'house', NULL),
(10, 's;dkalsdj  lskdjsdlf', 'bhabyjen.asiatico96@gmail.com', '09568857848', ' B2 L2 gdfsf sdfsdf', '2018-04-17', 6, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"5\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":100},{\"id\":11,\"name\":\"Guess Chairs\",\"quantity\":\"100\",\"category\":\"Chairs\",\"subtotal\":1500,\"amount\":15},{\"id\":31,\"name\":\"Bubble Balloon\",\"quantity\":\"20\",\"category\":\"Balloons\",\"subtotal\":500,\"amount\":25}]', 44500, 'rejected', 0, '2018-04-02 02:33:05', 'KHRRRP4810', 'no payment', '{\"0\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"1\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"2\":{\"id\":5,\"name\":\"Beef Caldereta\",\"quantity\":\"2\",\"subtotal\":3000,\"amount\":1500},\"3\":{\"id\":7,\"name\":\"Chicken Barbeque\",\"quantity\":\"2\",\"subtotal\":12000,\"amount\":6000},\"4\":{\"id\":20,\"name\":\"Mushroom Soup\",\"quantity\":\"2\",\"subtotal\":4000,\"amount\":2000}}', 9, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/s;dkalsdj__lskdjsdlf_1522636332.jpg\",\"image_name\":\"s;dkalsdj__lskdjsdlf_1522636332.jpg\"}', 1, NULL, '08:31AM TO 06:31PM'),
(11, 'Russ Escl Lobr', 'russel.lobrio@directwithhotels.com', '09068498271', 'House #145 B14 L14 Nicolasa Virata GMA Cavite', '2018-04-18', 8, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":2000,\"amount\":100},{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"150\",\"category\":\"Chairs\",\"subtotal\":6750,\"amount\":45}]', 76750, 'rejected', 0, '2018-04-06 05:06:15', 'RSUPAGBR11', '5 day no down payment policy', '{\"0\":{\"id\":22,\"name\":\"3 Round Cake\",\"quantity\":\"1\",\"subtotal\":8000,\"amount\":8000},\"1\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"2\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"3\":{\"id\":12,\"name\":\"Nilasing na Hipon\",\"quantity\":\"1\",\"subtotal\":6500,\"amount\":6500}}', 19, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/russ_escl_lobr_1522991118.png\",\"image_name\":\"russ_escl_lobr_1522991118.png\"}', 0, NULL, '01:03PM TO 03:03PM'),
(12, 'Russ Escl Lobr', 'russel.lobrio@directwithhotels.com', '09068498271', 'House #145 B14 L14 Nicolasa Virata GMA Cavite', '2018-04-18', 8, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":2000,\"amount\":100},{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"150\",\"category\":\"Chairs\",\"subtotal\":6750,\"amount\":45}]', 76750, 'rejected', 0, '2018-04-06 05:08:04', 'G4F5527M12', '5 day no down payment policy', '{\"0\":{\"id\":22,\"name\":\"3 Round Cake\",\"quantity\":\"1\",\"subtotal\":8000,\"amount\":8000},\"1\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"2\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"3\":{\"id\":12,\"name\":\"Nilasing na Hipon\",\"quantity\":\"1\",\"subtotal\":6500,\"amount\":6500}}', 19, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/russ_escl_lobr_1522991226.png\",\"image_name\":\"russ_escl_lobr_1522991226.png\"}', 0, NULL, '01:03PM TO 03:03PM'),
(13, 'Russ Ec Lobrio', 'russel.lobrio@directwithhotels.com', '09068498271', 'House #1 B14 L14 N. Virata  GMA Cavite', '2018-04-17', 8, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":2000,\"amount\":100},{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"150\",\"category\":\"Chairs\",\"subtotal\":6750,\"amount\":45}]', 76750, 'rejected', 0, '2018-04-06 05:38:05', 'CU8Q4N7F13', 'lack of utensils', '{\"0\":{\"id\":22,\"name\":\"3 Round Cake\",\"quantity\":\"1\",\"subtotal\":8000,\"amount\":8000},\"1\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"2\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"3\":{\"id\":12,\"name\":\"Nilasing na Hipon\",\"quantity\":\"1\",\"subtotal\":6500,\"amount\":6500}}', 19, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/russ_ec_lobrio_1522993027.png\",\"image_name\":\"russ_ec_lobrio_1522993027.png\"}', 0, NULL, '01:09PM TO 04:09PM'),
(14, 'Russ Escalderon Lobrio', 'russel.lobrio@directwithhotels.com', '09068278235', 'House #15 B14 L14 Nicolasa Virata GMA Cavite', '2018-04-18', 19, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":2000,\"amount\":100},{\"id\":6,\"name\":\"Floor-length Table\",\"quantity\":\"2\",\"category\":\"Tables\",\"subtotal\":1000,\"amount\":500},{\"id\":12,\"name\":\"Table Cloth\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":300,\"amount\":15},{\"id\":13,\"name\":\"Gift Table\",\"quantity\":\"2\",\"category\":\"Tables\",\"subtotal\":300,\"amount\":150},{\"id\":4,\"name\":\"Spoon and Fork\",\"quantity\":\"200\",\"category\":\"Party_tools\",\"subtotal\":4000,\"amount\":20},{\"id\":7,\"name\":\"Photobooth\",\"quantity\":\"1\",\"category\":\"Party_tools\",\"subtotal\":3500,\"amount\":3500},{\"id\":10,\"name\":\"Invitation Card\",\"quantity\":\"200\",\"category\":\"Party_tools\",\"subtotal\":3000,\"amount\":15},{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"200\",\"category\":\"Chairs\",\"subtotal\":9000,\"amount\":45},{\"id\":31,\"name\":\"Bubble Balloon\",\"quantity\":\"55\",\"category\":\"Balloons\",\"subtotal\":1375,\"amount\":25},{\"id\":35,\"name\":\"Personalized Cancer\",\"quantity\":\"200\",\"category\":\"Baptism_Souvenirs\",\"subtotal\":3000,\"amount\":15}]', 117075, 'rejected', 0, '2018-04-06 05:39:27', 'CS7ZJ0FL14', '5 day no down payment policy', '{\"0\":{\"id\":21,\"name\":\"2 Round Cake\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000},\"1\":{\"id\":17,\"name\":\"Leche Flan\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"2\":{\"id\":13,\"name\":\"Pancit Bihon\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000},\"3\":{\"id\":14,\"name\":\"Pancit Palabok\",\"quantity\":\"2\",\"subtotal\":10000,\"amount\":5000},\"4\":{\"id\":20,\"name\":\"Mushroom Soup\",\"quantity\":\"1\",\"subtotal\":2000,\"amount\":2000},\"5\":{\"id\":12,\"name\":\"Nilasing na Hipon\",\"quantity\":\"1\",\"subtotal\":6500,\"amount\":6500}}', 21, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/russ_escalderon_lobrio_1522993109.png\",\"image_name\":\"russ_escalderon_lobrio_1522993109.png\"}', 2, NULL, '01:37PM TO 02:37PM'),
(15, 'jen  asiativo', 'bhabyjen.asiatico96@gmail.com', '09568857848', ' B2988 L2988 fkhdkjfhkj', '2018-04-17', 5, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"5\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":100},{\"id\":30,\"name\":\"Foil Balloons\",\"quantity\":\"12\",\"category\":\"Balloons\",\"subtotal\":300,\"amount\":25},{\"id\":26,\"name\":\"Chairs with Ribbon Accent\",\"quantity\":\"100\",\"category\":\"Chairs\",\"subtotal\":3000,\"amount\":30}]', 40800, 'confirmed', 0, '2018-04-06 07:32:53', 'DAD6S9AF15', NULL, '{\"2\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"3\":{\"id\":21,\"name\":\"2 Round Cake\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000}}', 11, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/jen__asiativo_1522999915.png\",\"image_name\":\"jen__asiativo_1522999915.png\"}', 2, NULL, '02:00AM TO 06:30PM'),
(16, 'gk,fdjglkdj lkjlkj ljkljkl', 'bhabyjen.asiatico96@gmail.com', '09568857848', 'House #87687 B86876 L86876 jghjhkjh kjhkjh', '2018-04-19', 6, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"5\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":100},{\"id\":11,\"name\":\"Guess Chairs\",\"quantity\":\"100\",\"category\":\"Chairs\",\"subtotal\":1500,\"amount\":15},{\"id\":31,\"name\":\"Bubble Balloon\",\"quantity\":\"20\",\"category\":\"Balloons\",\"subtotal\":500,\"amount\":25}]', 44500, 'rejected', 0, '2018-04-06 07:34:56', '9GQRQADT16', '5 day no down payment policy', '{\"0\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"1\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"4\":{\"id\":20,\"name\":\"Mushroom Soup\",\"quantity\":\"2\",\"subtotal\":4000,\"amount\":2000}}', 9, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/gk,fdjglkdj_lkjlkj_ljkljkl_1523000038.jpg\",\"image_name\":\"gk,fdjglkdj_lkjlkj_ljkljkl_1523000038.jpg\"}', 3, NULL, '06:32AM TO 06:32PM'),
(17, 'shiela  agustin', 'bhabyjen.asiatico96@gmail.com', '09568857848', 'House #786 B876 L876 macopa imus', '2018-04-16', 8, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":2000,\"amount\":100},{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"150\",\"category\":\"Chairs\",\"subtotal\":6750,\"amount\":45}]', 76750, 'confirmed', 1, '2018-04-06 07:41:34', '0JEVEHRS17', '', '{\"0\":{\"id\":22,\"name\":\"3 Round Cake\",\"quantity\":\"1\",\"subtotal\":8000,\"amount\":8000},\"1\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"2\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"3\":{\"id\":12,\"name\":\"Nilasing na Hipon\",\"quantity\":\"1\",\"subtotal\":6500,\"amount\":6500}}', 19, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/shiela__agustin_1523000436.png\",\"image_name\":\"shiela__agustin_1523000436.png\"}', 1, NULL, '07:39AM TO 06:39PM'),
(18, 'shiela  agustin', 'bhabyjen.asiatico96@gmail.com', '09568857848', 'House #65 B76 L76 macopa imus', '2018-04-15', 5, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"5\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":100},{\"id\":30,\"name\":\"Foil Balloons\",\"quantity\":\"12\",\"category\":\"Balloons\",\"subtotal\":300,\"amount\":25},{\"id\":26,\"name\":\"Chairs with Ribbon Accent\",\"quantity\":\"100\",\"category\":\"Chairs\",\"subtotal\":3000,\"amount\":30}]', 40800, 'confirmed', 1, '2018-04-06 07:46:57', '86YB3JZN18', '', '{\"2\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"3\":{\"id\":21,\"name\":\"2 Round Cake\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000}}', 11, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/shiela__agustin_1523000759.png\",\"image_name\":\"shiela__agustin_1523000759.png\"}', 3, NULL, '06:44AM TO 06:44PM'),
(19, 'mark  vivero', 'bhabyjen.asiatico96@gmail.com', '09568857848', 'House #576 B765 L765 manggahan imus', '2018-04-28', 6, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"5\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":100},{\"id\":11,\"name\":\"Guess Chairs\",\"quantity\":\"100\",\"category\":\"Chairs\",\"subtotal\":1500,\"amount\":15},{\"id\":31,\"name\":\"Bubble Balloon\",\"quantity\":\"20\",\"category\":\"Balloons\",\"subtotal\":500,\"amount\":25}]', 44500, 'rejected', 0, '2018-04-06 07:51:57', '0K0MJHEG19', '5 day no down payment policy', '{\"0\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"1\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"4\":{\"id\":20,\"name\":\"Mushroom Soup\",\"quantity\":\"2\",\"subtotal\":4000,\"amount\":2000}}', 9, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/mark__vivero_1523001059.png\",\"image_name\":\"mark__vivero_1523001059.png\"}', 4, NULL, '07:48AM TO 03:49PM'),
(20, 'a  a', 'loghorizon1491@gmail.com', '09182772791', 'House #a Ba La a a', '2018-04-14', 5, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"5\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":100},{\"id\":30,\"name\":\"Foil Balloons\",\"quantity\":\"12\",\"category\":\"Balloons\",\"subtotal\":300,\"amount\":25},{\"id\":26,\"name\":\"Chairs with Ribbon Accent\",\"quantity\":\"100\",\"category\":\"Chairs\",\"subtotal\":3000,\"amount\":30}]', 40800, 'confirmed', 1, '2018-04-08 05:48:03', '0LS6KTKF20', '', '{\"2\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"3\":{\"id\":21,\"name\":\"2 Round Cake\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000}}', 11, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/a__a_1523166423.jpg\",\"image_name\":\"a__a_1523166423.jpg\"}', 2, NULL, '10:45PM TO 11:45PM'),
(21, 'jen  mint', 'bhabyjen.asiatico96@gmail.com', '09568857848', 'House #12 B21 L21 daegu asd', '2018-05-23', 6, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"5\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":100},{\"id\":11,\"name\":\"Guess Chairs\",\"quantity\":\"100\",\"category\":\"Chairs\",\"subtotal\":1500,\"amount\":15},{\"id\":31,\"name\":\"Bubble Balloon\",\"quantity\":\"20\",\"category\":\"Balloons\",\"subtotal\":500,\"amount\":25}]', 44500, 'confirmed', 0, '2018-04-10 03:41:11', 'TAA6CCAI21', '', '{\"0\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"1\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"4\":{\"id\":20,\"name\":\"Mushroom Soup\",\"quantity\":\"2\",\"subtotal\":4000,\"amount\":2000}}', 9, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/jen__mint_1523331671.png\",\"image_name\":\"jen__mint_1523331671.png\"}', 1, NULL, '08:39AM TO 06:30PM'),
(22, 'jen  kim', 'bhabyjen.asiatico96@gmail.com', '09568857848', 'House #1 B1 L1 daegu tokyo', '2018-05-25', 6, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"5\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":100},{\"id\":11,\"name\":\"Guess Chairs\",\"quantity\":\"100\",\"category\":\"Chairs\",\"subtotal\":1500,\"amount\":15},{\"id\":31,\"name\":\"Bubble Balloon\",\"quantity\":\"20\",\"category\":\"Balloons\",\"subtotal\":500,\"amount\":25}]', 44500, 'confirmed', 0, '2018-04-10 05:21:11', '6J55J75J22', '', '{\"0\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"1\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"4\":{\"id\":20,\"name\":\"Mushroom Soup\",\"quantity\":\"2\",\"subtotal\":4000,\"amount\":2000}}', 9, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/jen__kim_1523337671.jpg\",\"image_name\":\"jen__kim_1523337671.jpg\"}', 2, NULL, '06:18AM TO 06:19PM'),
(23, 'Pamela  Ocampo', 'bhabyjen.asiatico96@gmail.com', '09568857848', 'House #1 B1 L1 sampaguita manila', '2018-05-15', 5, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"5\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":100},{\"id\":30,\"name\":\"Foil Balloons\",\"quantity\":\"12\",\"category\":\"Balloons\",\"subtotal\":300,\"amount\":25},{\"id\":26,\"name\":\"Chairs with Ribbon Accent\",\"quantity\":\"100\",\"category\":\"Chairs\",\"subtotal\":3000,\"amount\":30}]', 40800, 'rejected', 0, '2018-04-15 01:01:32', 'CZ9HBEFQ23', '5 day no down payment policy', '{\"2\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"3\":{\"id\":21,\"name\":\"2 Round Cake\",\"quantity\":\"1\",\"subtotal\":5000,\"amount\":5000}}', 11, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/pamela__ocampo_1523754092.jpg\",\"image_name\":\"pamela__ocampo_1523754092.jpg\"}', 2, NULL, '06:30AM TO 06:58PM'),
(24, 'jayneil  lagahiy', 'shiela16@yahoo.com', '09364553227', 'House #12 B56 L56 carmona  cavite', '2018-05-26', NULL, '{\"0\":{\"id\":\"6\",\"name\":\"Floor-length Table\",\"quantity\":\"3\",\"subtotal\":\"1500\",\"price\":\"500\"}}', 23500, 'rejected', 0, '2018-04-15 10:48:21', 'F83FGIVH24', '5 day no down payment policy', '{\"0\":{\"id\":\"11\",\"name\":\"Relyenong Bangus\",\"quantity\":\"2\",\"subtotal\":\"9000\",\"price\":\"4500\"},\"1\":{\"id\":\"12\",\"name\":\"Nilasing na Hipon\",\"quantity\":\"2\",\"subtotal\":\"13000\",\"price\":\"6500\"}}', 0, '', NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/jayneil__lagahiy_1523789301.jpg\",\"image_name\":\"jayneil__lagahiy_1523789301.jpg\"}', 3, NULL, '06:35AM TO 06:45PM'),
(25, 'retchel  piedad', 'shiela16@yahoo.com', '09568857848', 'House #1 B2 L2 alta tierra gma cavite', '2018-05-26', 6, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"5\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":100},{\"id\":11,\"name\":\"Guess Chairs\",\"quantity\":\"100\",\"category\":\"Chairs\",\"subtotal\":1500,\"amount\":15},{\"id\":31,\"name\":\"Bubble Balloon\",\"quantity\":\"20\",\"category\":\"Balloons\",\"subtotal\":500,\"amount\":25}]', 44500, 'rejected', 0, '2018-04-15 22:44:11', 'WWJJK0JO25', '5 day no down payment policy', '{\"0\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"1\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"4\":{\"id\":20,\"name\":\"Mushroom Soup\",\"quantity\":\"2\",\"subtotal\":4000,\"amount\":2000}}', 9, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/retchel__piedad_1523832251.jpg\",\"image_name\":\"retchel__piedad_1523832251.jpg\"}', 4, NULL, '06:50AM TO 12:30PM'),
(26, 'katherine  endozo', 'shiela16@yahoo.com', '09568857848', 'House #2 B2 L2 bancal cavite', '2018-05-29', NULL, '{\"0\":{\"id\":\"1\",\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"6\",\"subtotal\":\"600\",\"price\":\"100\"}}', 1600, 'rejected', 0, '2018-04-18 00:34:27', 'QI7UVL5S26', '5 day no down payment policy', '{}', 1, '', NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/katherine__endozo_1524011667.jpg\",\"image_name\":\"katherine__endozo_1524011667.jpg\"}', 1, NULL, '06:30AM TO 12:30PM'),
(27, 'bhabyjen  asiatico', 'bhabyjen.asiatico96@gmail.com', '09568857848', 'House #1 B1 L1 cavite ciy', '2018-05-24', 8, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":2000,\"amount\":100},{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"150\",\"category\":\"Chairs\",\"subtotal\":6750,\"amount\":45}]', 76750, 'rejected', 0, '2018-04-23 00:04:52', '82XWSFZY27', 'no downpayment', '{\"0\":{\"id\":22,\"name\":\"3 Round Cake\",\"quantity\":\"1\",\"subtotal\":8000,\"amount\":8000},\"1\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"2\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"3\":{\"id\":12,\"name\":\"Nilasing na Hipon\",\"quantity\":\"1\",\"subtotal\":6500,\"amount\":6500}}', 19, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/bhabyjen__asiatico_1524441892.jpg\",\"image_name\":\"bhabyjen__asiatico_1524441892.jpg\"}', 2, NULL, '06:02AM TO 06:02PM'),
(28, 'Russel Escalderon Lobrio', 'russel.lobrio@directwithhotels.com', '09068498271', 'House #195 B14 L14 Nicolasa Virata GMA Cavite', '2018-05-29', 8, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":2000,\"amount\":100},{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"150\",\"category\":\"Chairs\",\"subtotal\":6750,\"amount\":45}]', 76750, 'pending', 0, '2018-04-23 00:41:58', 'EOVU9NAO28', NULL, '{\"0\":{\"id\":22,\"name\":\"3 Round Cake\",\"quantity\":\"1\",\"subtotal\":8000,\"amount\":8000},\"1\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"2\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"3\":{\"id\":12,\"name\":\"Nilasing na Hipon\",\"quantity\":\"1\",\"subtotal\":6500,\"amount\":6500}}', 19, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/russel_escalderon_lobrio_1524444118.png\",\"image_name\":\"russel_escalderon_lobrio_1524444118.png\"}', 1, NULL, '08:40AM TO 10:40AM'),
(29, 'John Sample Doe', 'russel.lobrio@directwithhotels.com', '09068498271', 'House #14 B12 L12 Sample Street GMA Cavite', '2018-05-28', NULL, '{\"0\":{\"id\":\"15\",\"name\":\"Personalized Cup Couple\",\"quantity\":\"5\",\"subtotal\":\"250\",\"price\":\"50\"}}', 24750, 'pending', 0, '2018-04-23 00:44:10', 'NQ5C7HG129', NULL, '{\"0\":{\"id\":\"11\",\"name\":\"Relyenong Bangus\",\"quantity\":\"5\",\"subtotal\":\"22500\",\"price\":\"4500\"}}', 11, '', NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/john_sample_doe_1524444250.png\",\"image_name\":\"john_sample_doe_1524444250.png\"}', 3, NULL, '08:43AM TO 10:43AM'),
(31, 'Bella  Hasnudi', 'bhabyjen.asiatico96@gmail.com', '09568857848', 'House #1 B1 L1 ca v', '2018-05-24', 8, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":2000,\"amount\":100},{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"150\",\"category\":\"Chairs\",\"subtotal\":6750,\"amount\":45}]', 76750, 'rejected', 0, '2018-04-23 00:52:37', '821SHLCI31', 'no downpayment', '{\"0\":{\"id\":22,\"name\":\"3 Round Cake\",\"quantity\":\"1\",\"subtotal\":8000,\"amount\":8000},\"1\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"2\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"3\":{\"id\":12,\"name\":\"Nilasing na Hipon\",\"quantity\":\"1\",\"subtotal\":6500,\"amount\":6500}}', 19, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/bella__hasnudi_1524444757.jpg\",\"image_name\":\"bella__hasnudi_1524444757.jpg\"}', 2, NULL, '08:51AM TO 08:51PM'),
(32, 'Cyris  Tura', 'bhabyjen.asiatico96@gmail.com', '09568857848', 'House #1 B1 L1 cavite gma', '2018-05-24', 8, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":2000,\"amount\":100},{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"150\",\"category\":\"Chairs\",\"subtotal\":6750,\"amount\":45}]', 76750, 'confirmed', 0, '2018-04-23 01:08:04', '7F3P4MTK32', NULL, '{\"0\":{\"id\":22,\"name\":\"3 Round Cake\",\"quantity\":\"1\",\"subtotal\":8000,\"amount\":8000},\"1\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"2\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"3\":{\"id\":12,\"name\":\"Nilasing na Hipon\",\"quantity\":\"1\",\"subtotal\":6500,\"amount\":6500}}', 19, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/cyris__tura_1524445684.jpg\",\"image_name\":\"cyris__tura_1524445684.jpg\"}', 2, NULL, '09:07AM TO 09:07PM'),
(33, 'My Last Name My Middle Name My First Name', 'russel.lobrio@directwithhotels.com', '09068498271', 'House #12 B23 L23 Sample GMA Cavite', '2018-05-30', 6, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"5\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":100},{\"id\":11,\"name\":\"Guess Chairs\",\"quantity\":\"100\",\"category\":\"Chairs\",\"subtotal\":1500,\"amount\":15},{\"id\":31,\"name\":\"Bubble Balloon\",\"quantity\":\"20\",\"category\":\"Balloons\",\"subtotal\":500,\"amount\":25}]', 44500, 'pending', 0, '2018-04-23 01:11:19', 'LW14RLWT33', NULL, '{\"0\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"1\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"4\":{\"id\":20,\"name\":\"Mushroom Soup\",\"quantity\":\"2\",\"subtotal\":4000,\"amount\":2000}}', 9, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/my_last_name_my_middle_name_my_first_name_1524445879.png\",\"image_name\":\"my_last_name_my_middle_name_my_first_name_1524445879.png\"}', 0, NULL, '09:10AM TO 10:10AM'),
(34, 'Fernandez  Roel Jay', 'bhabyjen.asiatico96@gmail.com', '09568857848', 'House #1 B1 L1 gma cavite', '2018-05-30', 8, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"20\",\"category\":\"Tables\",\"subtotal\":2000,\"amount\":100},{\"id\":28,\"name\":\"Chairs with cloth\",\"quantity\":\"150\",\"category\":\"Chairs\",\"subtotal\":6750,\"amount\":45}]', 76750, 'pending', 0, '2018-04-23 01:29:16', '1J7KFKV734', NULL, '{\"0\":{\"id\":22,\"name\":\"3 Round Cake\",\"quantity\":\"1\",\"subtotal\":8000,\"amount\":8000},\"1\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"2\",\"subtotal\":7000,\"amount\":3500},\"2\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"3\":{\"id\":12,\"name\":\"Nilasing na Hipon\",\"quantity\":\"1\",\"subtotal\":6500,\"amount\":6500}}', 19, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/fernandez__roel_jay_1524446956.jpg\",\"image_name\":\"fernandez__roel_jay_1524446956.jpg\"}', 3, NULL, '09:25AM TO 09:25PM'),
(35, 'pingal  argee', 'shiela16@yahoo.com', '09568857848', 'House #1 B2 L2 cabilang baybay  carmona cavite', '2018-05-26', NULL, '{\"0\":{\"id\":\"1\",\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"5\",\"subtotal\":\"500\",\"price\":\"100\"}}', 10500, 'confirmed', 0, '2018-04-23 05:22:10', 'LCMQRECW35', '', '{\"0\":{\"id\":\"11\",\"name\":\"Relyenong Bangus\",\"quantity\":\"2\",\"subtotal\":\"9000\",\"price\":\"4500\"}}', 1, '', NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/pingal__argee_1524460930.jpg\",\"image_name\":\"pingal__argee_1524460930.jpg\"}', 2, NULL, '06:30AM TO 01:30PM'),
(36, 'Vicente,  Jackielyn', 'shiela16@yahoo.com', '09568857848', 'House #6 B6 L6 bancal cavite', '2018-05-31', 6, '[{\"id\":1,\"name\":\"Guess Table (Good for 10 persons)\",\"quantity\":\"5\",\"category\":\"Tables\",\"subtotal\":500,\"amount\":100},{\"id\":11,\"name\":\"Guess Chairs\",\"quantity\":\"100\",\"category\":\"Chairs\",\"subtotal\":1500,\"amount\":15},{\"id\":31,\"name\":\"Bubble Balloon\",\"quantity\":\"20\",\"category\":\"Balloons\",\"subtotal\":500,\"amount\":25}]', 44500, 'pending', 0, '2018-04-24 06:07:52', 'RM1COMLQ36', NULL, '{\"0\":{\"id\":15,\"name\":\"Spaghetti\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"1\":{\"id\":16,\"name\":\"Carbonara\",\"quantity\":\"3\",\"subtotal\":10500,\"amount\":3500},\"4\":{\"id\":20,\"name\":\"Mushroom Soup\",\"quantity\":\"2\",\"subtotal\":4000,\"amount\":2000}}', 9, NULL, NULL, NULL, '{\"current_path\":\".\\/valid_documents\\/vicente,__jackielyn_1524550072.jpg\",\"image_name\":\"vicente,__jackielyn_1524550072.jpg\"}', 2, NULL, '06:30AM TO 01:30PM');

-- --------------------------------------------------------

--
-- Table structure for table `t_temporary_code`
--

CREATE TABLE `t_temporary_code` (
  `id` int(11) NOT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_temporary_code`
--

INSERT INTO `t_temporary_code` (`id`, `email_address`, `code`, `date_sent`) VALUES
(9, 'bhabyjen.asiatico96@gmail.com', '8T00B', '2018-03-27 03:11:41'),
(14, 'shela16@yahoo.com', 'HL7V0', '2018-03-27 03:31:22'),
(19, 'russel.lobrio@directwithhotels.com', 'EUT3D', '2018-04-06 01:04:49'),
(28, 'divinity1491@gmail.com', 'BSD68', '2018-04-08 01:44:46'),
(30, 'bhabyjen.asiatico96@gmail.com', '02QN8', '2018-04-10 11:38:19'),
(42, 'bhabyjen.asiatico96@gmail.com', '25YF1', '2018-04-23 09:04:48');

-- --------------------------------------------------------

--
-- Table structure for table `t_terms`
--

CREATE TABLE `t_terms` (
  `id` int(11) NOT NULL,
  `term` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_terms`
--

INSERT INTO `t_terms` (`id`, `term`) VALUES
(2, '\n1. GUARANTEE COUNTS\n<br>\nThe final attendance count must be received by Recto’s Table & Chairs Rentals Catering Services no later that 5:00 PM, five (5) working days prior to the commencement of the function.\n</br>\n\n<br>\n2. FOOD AND BEVERAGE\n<br>No food beverage of any kind may be brought into Recto’s Table & Chairs Rentals Catering Services by the customer or any of the Customer’s guests or invitees unless prearranged and approved by Recto’s Table & Chairs Rentals Catering Services.</br>\n</br>\n\n3. LIABILITY\n<br>\nThe customer agrees to be responsible for any damage done to the function rooms or any other part of Recto’s Table & Chairs Rentals Catering Services or any off- site premises at which the function may be held, by the customer, his guest, invitees, employees, independent contractors, or other agents under the Customer’s control. Recto’s Table & Chairs Rentals Catering Services</br>\n<br></br>\n<br></br>\n <br>will not assure or accept any responsibility for damage to or loss of any merchandise or articles left in the venue prior to, during, or following the Customer’s function. To minimize any risk of fire, flammable or any explosive materials shall not be allowed at the venue.</br>\n<br>\n*if something unexpected happened to the chosen date of the event reservation, the caterer will still continue the preparation. For the cancellation of the event there will be 5% deduction of payment.\n</br>\n<br></br>\n4. PERMITS/LICENSES\n<br>\nIn the event that the Customer’s function requires a permit or license from any governing body, local, or national, the Customer is solely responsible for obtaining such license or permit at Customer’s expense. \n</br>\n<br>\n</br>\n\n5. AGREEMENT\n<br>\nThe agreement shall be considered accepted once both parties have signed. It is out undersigned that you are empowered by your group to make these arrangements. A signature delivered by facsimile or electronic means will be considered binding both parties.\n</br>\n<br>\n</br>\n5. PAYMENT\n<brr>The payment shall be paid on the following terms:</br>\n<br> a. Cash, check or bank transfer within 5 days from the date of reservation.\n<br>*for the details please contact us. 09216748960/09999914233/09167801604</br>\n');

-- --------------------------------------------------------

--
-- Table structure for table `t_themes`
--

CREATE TABLE `t_themes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `image` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_available` smallint(6) DEFAULT '1',
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_themes`
--

INSERT INTO `t_themes` (`id`, `name`, `description`, `image`, `date_created`, `is_available`, `price`) VALUES
(1, 'Moana Party', 'includes\n200-300 pcs moana paper plates\n200-300 pcs moana plastic cups\n200-300 pcs of plastic spoon and forks\nfree borrowed  3 moana curtains\n10 latex moana balloons\n', '{\"current_path\":\".\\/theme_images\\/moana_party\\/moana_party_1522044799.jpg\",\"image_name\":\"moana_party_1522044799.jpg\"}', '2018-03-26 06:14:05', 1, 1000),
(2, 'Minnie Mouse Party', 'Celebrate an adorable Disney adventure with Minnie Mouse Party Supplies! Minnie Mouse Party Supplies feature your favorite mouse on themed plates, napkins, cups, and party kits. Add our Minnie Mouse party favors, decorations, and invitations to our Minnie Mouse Party Supplies for a perfectly pink birthday!', '{\"current_path\":\".\\/theme_images\\/minnie_mouse_party\\/minnie_mouse_party_1522044909.jpg\",\"image_name\":\"minnie_mouse_party_1522044909.jpg\"}', '2018-03-26 06:15:55', 0, 1500),
(3, 'Beauty and the Beast Party', 'Make your little princess\' special day magical with this collection of Beauty and the Beast Party Supplies! Beauty and the Beast tableware, decorations, and party favors will enchant at your daughter\'s birthday party! Invite family and friends to your little one\'s princess party with adorable Beauty and the Beast invitations! Complete with postcard-style invitations, envelopes, and stickers, Beauty and the Beast invitations feature Belle, Lumiere, and other Beauty and the Beast characters. The little ones will be so excited to open their invitations to the birthday ball! Turn your home into the enchanted world of Beauty and the Beast with adorable Beauty and the Beast decorations! Brighten up your daughter\'s Disney Princess party by hanging up blue, pink, and yellow swirl decorations featuring cutouts of Belle, Chip, and Mrs. Potts. Customize your decorations with a Beauty and the Beast birthday banner kit and your little princess will feel extra special! Serve a royal feast with Beauty and the Beast tableware! Pink napkins and plates feature Belle, the Beast, and other Beauty and the Beast characters surrounded by colorful roses and castles. Display your lovely princess table decor on top of a cute plastic table cover with Belle and the Beast dancing together! After the princess party, show appreciation for your guests by sending them off with Beauty and the Beast party favors! Your guests will love favor bags and favor cups filled with tattoos, blowouts, and other Beauty and the Beast party favors. Each party favor features Philippe, Lumiere, and other beloved Beauty and the Beast characters! Your little princess will have the time of her life at her birthday party with Beauty and the Beast party supplies! Complete her magical day with a wonderful assortment of Beauty and the Beast items!', '{\"current_path\":\".\\/theme_images\\/beauty_and_the_beast_party\\/beauty_and_the_beast_party_1522045007.jpg\",\"image_name\":\"beauty_and_the_beast_party_1522045007.jpg\"}', '2018-03-26 06:17:32', 0, 2000),
(4, 'Frozen Party', 'Our Frozen Party Supplies won\'t leave anyone out in the cold! Break the ice with a table setting filled with themed plates, napkins and cups matched with solid-colored tableware. Featuring Anna, Elsa the Ice Queen, Olaf and other memorable characters, our Frozen decorations and party favors are just the thing to heat things up at an epic birthday party. Don\'t forget Frozen accessories and other Frozen Party Supplies to celebrate the birthday girl!', '{\"current_path\":\".\\/theme_images\\/frozen_party\\/frozen_party_1522045082.jpg\",\"image_name\":\"frozen_party_1522045082.jpg\"}', '2018-03-26 06:18:47', 0, 2000),
(5, 'Super Mario Party', 'It\'s-a Mario, Luigi, Yoshi, Princess Peach, and the rest of the Nintendo Super Mario gang! Shop Super Mario Party Supplies, including paper cups, paper plates, paper napkins, plastic table covers, to make the birthday celebration extra special for the birthday girl or boy.  Set the foundation for a power-up party with Super Mario Party Supplies featuring your favorite Nintendo heroes, including Birdo and Toad. With a Super Mario plastic table cover, printed plates, matching napkins, as well as paper and plastic cups for birthday snacks and drinks, you can be sure even Bowser, Wario, Waluigi, King Boo, and other baddies will have a blast! Complement Super Mario tableware with solid-color plastic forks, knives, and spoons. All-in-one party kits to save time and money on a Nintendo Super Mario-themed birthday for 8 or 16 party guests. Create a Super Mario World of fun with Super Mario decorations, including Mario balloons, and pinatas. Be sure to sprinkle confetti about the party room; they\'re like Super Stars for real life! Party favors are great ice-breakers, so stock up on Super Mario party favors like bracelets and accessories, games and toys, themed candy, and even plastic tumblers. With an extensive assortment of Super Mario party supplies and even baking supplies for themed cupcakes, party snacks, and a birthday cake, your little one\'s ready to take on all of the Koopa Troopas and Goombas that come their way!', '{\"current_path\":\".\\/theme_images\\/super_mario_party\\/super_mario_party_1522045322.jpg\",\"image_name\":\"super_mario_party_1522045322.jpg\"}', '2018-03-26 06:22:47', 0, 1500),
(6, 'Mickey Mouse Party', 'Enter the Mickey Mouse Clubhouse! Mickey Mouse Party Supplies feature full-color images of your favorite Disney mouse on just about everything imaginable, including dinner plates, napkins, cups, invitations, and party favors. With Mickey Mouse-themed party supplies all conveniently located in one place, your little one is in for a super special Mickey Mouse birthday party!\n\nInvite all your little one\'s friends and fellow Mouseketeers to the party with Mickey Mouse invitations. Flip the postcard-style invitations over to write down the location of your clubhouse and other party details! Or, opt for custom invites for a super special touch!\n\nGet your party room ready with Mickey Mouse decorations like hanging swirl decorations, balloons, and happy birthday banners. Take some Goofy pictures with a photo booth kit that comes with fun photo props! These awesome decorations will transform your home into Mickey\'s Clubhouse.\n\nWhen the party guests arrive, hand out Mickey Mouse masks, then crown the birthday boy or girl with a an awesome Mickey Mouse hat with ears! Next, bring out the Mickey Mouse toys and favors for some fun party activities for the whole crew!\n\nWhen it\'s time for pizza or a slice of cake, we have a variety of Mickey Mouse-themed paper plates and napkins to suit your needs. Don\'t forget to complete your place settings and table decor with a Mickey Mouse table cover, confetti, and solid-colored plastic forks, knives, and spoons! With disposable tableware, your cleanup will be easy.\n\nReward partygoers for attending with goodie bags stuffed with Mickey Mouse favors. Fill favor bags or favor containers with a variety of candy or fun favors like wristbands, temporary tattoos, award ribbons, and bouncy balls for an awesome parting gift that will keep the fun going.\n\nBrowse our Mickey Mouse Party Supplies and other birthday party decorations to inspire your Mickey Mouse birthday party theme!', '{\"current_path\":\".\\/theme_images\\/mickey_mouse_party\\/mickey_mouse_party_1522045399.jpg\",\"image_name\":\"mickey_mouse_party_1522045399.jpg\"}', '2018-03-26 06:24:04', 0, 2100),
(7, 'Avengers Party', 'Assemble your birthday buddies for a super party! These action-packed Avengers Party Supplies feature images of Iron Man, Thor, Captain America, Hulk and more on plates, napkins, cups and table covers. Add themed decorations, party favors, invitations and thank you notes to Avengers Party Supplies for a superhero soiree full of Hulk-sized fun! Mix and match Avengers Party Supplies with solid colored tableware and decorations for a look as powerful as your favorite crime-fighting team.', '{\"current_path\":\".\\/theme_images\\/avengers_party\\/avengers_party_1522045655.jpg\",\"image_name\":\"avengers_party_1522045655.jpg\"}', '2018-03-26 06:28:20', 0, 2000),
(8, 'Despicable Me Minions Party', 'Are you hosting a party at your secret lair? End the experiment: Despicable Me Party Supplies are all you need for a fun-filled themed birthday! Despicable Me Party Supplies feature Gru\'s mischievous Minions on themed plates, napkins and cups. Choose a Despicable Me party kit to take the guesswork out of shopping. Hang the decorations, send out the invitations and hand out the party favors — with Despicable Me Minion Party Supplies, everything matches and stays in theme!', '{\"current_path\":\".\\/theme_images\\/despicable_me_minions_party\\/despicable_me_minions_party_1522045721.jpg\",\"image_name\":\"despicable_me_minions_party_1522045721.jpg\"}', '2018-03-26 06:29:26', 0, 2000),
(9, 'Romantic', 'Soft hues, delicate lighting, and plenty of florals typically make up a romantic wedding. For this theme, envision pastels, hanging lights (even chandeliers), calligraphy, and a flower wall.', '{\"current_path\":\".\\/theme_images\\/romantic\\/romantic_1522047043.jpg\",\"image_name\":\"romantic_1522047043.jpg\"}', '2018-03-26 06:49:20', 0, 2000),
(10, 'Alternative', 'More of an offbeat bride who\'s never been one to take the normal route? We get you. Buck tradition with an alternative wedding theme, and roll with it however you see fit. If cool, moody color palettes and creative stand-ins match your style better than bright flora and been-there-done-that wedding decor, then an alternative theme has your name written all over it. Push the boundaries as much as you want.', '{\"current_path\":\".\\/theme_images\\/alternative\\/alternative_1522046954.jpg\",\"image_name\":\"alternative_1522046954.jpg\"}', '2018-03-26 06:49:59', 0, 2100),
(11, 'Vintage', 'Draw inspiration from decades past if you want a vintage style for your wedding—and one of the easiest ways to channel this is through your wedding outfit and beauty look. As for the ceremony and reception, you can rely on antique-looking decor, like weathered doors and worn-in wood seats, to further exemplify a vintage-inspired wedding. For your last hoorah, finish off the vintage theme driving away in a classic getaway car, like an old Porsche or Volkswagen.', '{\"current_path\":\".\\/theme_images\\/vintage\\/vintage_1522047098.jpg\",\"image_name\":\"vintage_1522047098.jpg\"}', '2018-03-26 06:52:23', 1, 2000),
(12, 'Whimsical', 'For the whimsical couple, your wedding will be one of bright splashes of color and quirky, bohemian components. Incorporate design elements like multicolored balloons, streamers, punchy floral arrangements, and mismatched chairs if you and your future groom want to plan a whimsical wedding.', '{\"current_path\":\".\\/theme_images\\/whimsical\\/whimsical_1522047230.jpg\",\"image_name\":\"whimsical_1522047230.jpg\"}', '2018-03-26 06:54:35', 0, 1000),
(13, 'Garden Party/Casual', 'If you envision a more intimate, casual ceremony, opt for an outdoor garden party-themed wedding. This laid-back style is perfect if you have a backyard wedding on the brain and a spring or summer date.\n\n', 'false', '2018-03-26 06:57:55', 1, 2000),
(14, 'Garden Party/Casual', 'If you envision a more intimate, casual ceremony, opt for an outdoor garden party-themed wedding. This laid-back style is perfect if you have a backyard wedding on the brain and a spring or summer date.\n\n', 'false', '2018-03-26 06:58:36', 0, 50000),
(15, 'Garden Party/Casual', 'If you envision a more intimate, casual ceremony, opt for an outdoor garden party-themed wedding. This laid-back style is perfect if you have a backyard wedding on the brain and a spring or summer date.\n\n', 'false', '2018-03-26 06:59:00', 0, 50000),
(16, 'Garden Party/Casual', 'If you envision a more intimate, casual ceremony, opt for an outdoor garden party-themed wedding. This laid-back style is perfect if you have a backyard wedding on the brain and a spring or summer date.\n\n', 'false', '2018-03-26 06:59:00', 0, 50000),
(17, 'Garden Party/Casual', 'If you envision a more intimate, casual ceremony, opt for an outdoor garden party-themed wedding. This laid-back style is perfect if you have a backyard wedding on the brain and a spring or summer date.\n\n', 'false', '2018-03-26 06:59:00', 0, 50000),
(18, 'Blue and Gold Boys Baptism Party', 'Blue and white pin-stripes pair with tan and gold accents in this regal blue and gold boy’s baptism party. The inviting dessert table can easily be created using a tiered table skirt, monochromatic flowers, and large variety of clear apothecary jars filled with coordinating candy and embellished with ribbon ties and printable labels.', '{\"current_path\":\".\\/theme_images\\/blue_and_gold_boys_baptism_party\\/blue_and_gold_boys_baptism_party_1522047986.jpg\",\"image_name\":\"blue_and_gold_boys_baptism_party_1522047986.jpg\"}', '2018-03-26 07:07:11', 0, 2000),
(19, 'Fall Themed Baptism Party :: GreyGrey Designs', 'Celebrate a fall baptism with a fall themed baptism party! This one comes complete with ombre fall hues and textures used to decorate place settings, a refreshment area and pie dessert table.', '{\"current_path\":\".\\/theme_images\\/fall_themed_baptism_party_::_greygrey_designs\\/fall_themed_baptism_party_::_greygrey_designs_1522048078.jpg\",\"image_name\":\"fall_themed_baptism_party_::_greygrey_designs_1522048078.jpg\"}', '2018-03-26 07:08:43', 0, 2000),
(20, 'Elephant Themed Baptism for Boys Party ', 'The sweetness of a baby elephant and shades of blue, yellow and green pair with patterns of polka dots and chevron creating a special elephant themed baptism party. So many thoughtful details like printable toppers, party flags and labels were added to candy jars, beverage jars, cupcakes and favor boxes to build lasting memories of a lovely celebration', '{\"current_path\":\".\\/theme_images\\/elephant_themed_baptism_for_boys_party_\\/elephant_themed_baptism_for_boys_party__1522048158.jpg\",\"image_name\":\"elephant_themed_baptism_for_boys_party__1522048158.jpg\"}', '2018-03-26 07:10:04', 0, 2000),
(21, 'Hot Air Balloon Baptism Party ', 'You’re sure to be carried away by the amazing styling and elegant details of this hot air balloon baptism party which boasts a gorgeous sky inspired cake and full dessert table, plus airy decorations.  I’m obsessed with the hot air balloon props, but also love the cloud cookie pops and cupcakes!', '{\"current_path\":\".\\/theme_images\\/hot_air_balloon_baptism_party_\\/hot_air_balloon_baptism_party__1522048211.jpg\",\"image_name\":\"hot_air_balloon_baptism_party__1522048211.jpg\"}', '2018-03-26 07:10:57', 0, 2100),
(22, 'Pink Christening Day Party', 'Celebrate your baby’s Christening with our beautiful pink Christening party supplies. Choose from tableware, decorations, invitations and other party essentials with a cute pink elephant design.', '{\"current_path\":\".\\/theme_images\\/pink_christening_day_party\\/pink_christening_day_party_1522048322.jpg\",\"image_name\":\"pink_christening_day_party_1522048322.jpg\"}', '2018-03-26 07:12:48', 0, 1000),
(23, 'Rock-a-Bye Baby Party', 'Whether you\'re hosting a baby shower or a 1st birthday party, celebrate with our range of Rock-a-Bye Baby party supplies - complete with beautiful plates, napkins, cups and party invitations.', '{\"current_path\":\".\\/theme_images\\/rock-a-bye_baby_party\\/rock-a-bye_baby_party_1522048353.jpg\",\"image_name\":\"rock-a-bye_baby_party_1522048353.jpg\"}', '2018-03-26 07:13:18', 0, 1000),
(24, 'Peter Rabbit Party', 'Explore the wonderful world of Beatrix Potter with this beautiful collection of party supplies and accessories, based on the naughty Peter Rabbit and all his friends.', '{\"current_path\":\".\\/theme_images\\/peter_rabbit_party\\/peter_rabbit_party_1522048387.jpg\",\"image_name\":\"peter_rabbit_party_1522048387.jpg\"}', '2018-03-26 07:13:53', 0, 2000),
(25, 'Sports theme', 'A multi-sport event is an organized sporting event, often held over multiple days, featuring competition in many different sports.', '{\"current_path\":\".\\/theme_images\\/sports_theme\\/sports_theme_1522066362.jpg\",\"image_name\":\"sports_theme_1522066362.jpg\"}', '2018-03-26 12:13:28', 0, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `t_users`
--

CREATE TABLE `t_users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(45) DEFAULT NULL,
  `contact_no` varchar(11) DEFAULT NULL,
  `email_address` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_venues`
--

CREATE TABLE `t_venues` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_venues`
--

INSERT INTO `t_venues` (`id`, `name`, `description`, `image`) VALUES
(1, 'Tagaytay Highlands', 'Tagaytay is a popular holiday town south of Manila on the Philippine island Luzon. Known for its mild climate, it sits on a ridge above Taal Volcano Island, an active volcano surrounded by Taal Lake. Overlooking the area, People’s Park in the Sky occupies the grounds of a never-finished presidential mansion. Picnic Grove is a recreation area with trails and a zip line.', '{\"current_path\":\".\\/venue_images\\/tagaytay_highlands_1522116145.jpeg\",\"image_name\":\"tagaytay_highlands_1522116145.jpeg\"}'),
(2, 'Pacific Park Place', '6 G Governor\'s Dr, Paliparan 1, Dasmariñas, 4117 Cavite', '{\"current_path\":\".\\/venue_images\\/pacific_park_place_1522122306.jpg\",\"image_name\":\"pacific_park_place_1522122306.jpg\"}'),
(3, 'La Meditteranea', 'La Mediterranea Subdivision, Governor’s Drive, Dasmarinas, Cavite', '{\"current_path\":\".\\/venue_images\\/la_meditteranea_1522122533.jpg\",\"image_name\":\"la_meditteranea_1522122533.jpg\"}'),
(4, 'Bluegrass Pavilion ', ' Congressional Rd, General Mariano Alvarez, Cavite', '{\"current_path\":\".\\/venue_images\\/bluegrass_pavilion__1522122725.jpg\",\"image_name\":\"bluegrass_pavilion__1522122725.jpg\"}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food_category`
--
ALTER TABLE `food_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_about`
--
ALTER TABLE `t_about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_admins`
--
ALTER TABLE `t_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_availability`
--
ALTER TABLE `t_availability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_events`
--
ALTER TABLE `t_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_foods`
--
ALTER TABLE `t_foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_items`
--
ALTER TABLE `t_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_item_categories`
--
ALTER TABLE `t_item_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_logs`
--
ALTER TABLE `t_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_notifications`
--
ALTER TABLE `t_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_packages`
--
ALTER TABLE `t_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_past_events`
--
ALTER TABLE `t_past_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_reservations`
--
ALTER TABLE `t_reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_temporary_code`
--
ALTER TABLE `t_temporary_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_terms`
--
ALTER TABLE `t_terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_themes`
--
ALTER TABLE `t_themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_venues`
--
ALTER TABLE `t_venues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food_category`
--
ALTER TABLE `food_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `t_about`
--
ALTER TABLE `t_about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t_admins`
--
ALTER TABLE `t_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_availability`
--
ALTER TABLE `t_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_events`
--
ALTER TABLE `t_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `t_foods`
--
ALTER TABLE `t_foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `t_items`
--
ALTER TABLE `t_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `t_item_categories`
--
ALTER TABLE `t_item_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `t_logs`
--
ALTER TABLE `t_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `t_notifications`
--
ALTER TABLE `t_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_packages`
--
ALTER TABLE `t_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `t_past_events`
--
ALTER TABLE `t_past_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_reservations`
--
ALTER TABLE `t_reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `t_temporary_code`
--
ALTER TABLE `t_temporary_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `t_terms`
--
ALTER TABLE `t_terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_themes`
--
ALTER TABLE `t_themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_venues`
--
ALTER TABLE `t_venues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
