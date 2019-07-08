-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2018 at 07:16 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `middle_prj`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `article` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `uid`, `title`, `article`, `created_at`, `updated_at`) VALUES
(46, 16, 'my test', 'my test', '2018-12-04 17:32:10', '2018-12-04 17:32:10'),
(47, 14, 'hello its my first post', 'hello its my first post', '2018-12-05 16:54:57', '2018-12-05 16:54:57'),
(51, 10, 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2018-12-07 19:28:39', '2018-12-07 19:28:39'),
(52, 10, 'The standard Lorem Ipsum passage, used since the 1500s', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '2018-12-07 19:30:48', '2018-12-07 19:30:48'),
(53, 13, '1914 translation by H. Rackham', '\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame\r\n:))))))))', '2018-12-07 19:33:23', '2018-12-07 19:43:05'),
(54, 17, '  Lorem Ipsum', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...\r\nThere is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain.', '2018-12-10 10:30:41', '2018-12-14 16:54:38'),
(56, 17, 'Dress Code - Stay warm!', 'It is best to check the weather forecast every morning before you get dressed to make sure you keep warm and can see!\r\nSunglasses for the sun, goggles for the shade/cloud!\r\nDon&#39;t wear a cotton under layer or you&#39;ll get cold! Have a thermal layer next to your skin.\r\nUse layers of clothes, not big jumpers - it keeps you much warmer!\r\nOnly wear one pair of socks - more will actually make your feet colder!\r\nMake sure your outside layer is waterproof - especially your bottom half!\r\nMake sure you have lots of pocket space! You can take off layers when you get hot and carry extra ones in case the temperature drops...\r\nEnjoy!', '2018-12-14 12:53:06', '2018-12-14 12:53:06'),
(68, 9, ' Hello its Admin', 'Reminding you, that you welcome to write us with any question.\r\nJust proceed to Contact Us area. ', '2018-12-14 14:41:04', '2018-12-14 14:43:20'),
(69, 17, 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2018-12-14 16:52:11', '2018-12-14 16:52:11'),
(70, 14, 'lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tristique nisi sem, et laoreet elit ultrices congue. Sed quis tristique elit. Maecenas pellentesque quam elementum nisl rutrum maximus. Duis imperdiet nibh eu diam sagittis, sit amet molestie diam efficitur. Morbi elementum risus non vulputate placerat. Mauris feugiat odio eget interdum placerat. Morbi sed est vitae nunc rutrum dignissim eget id sapien. Aenean nec dui id eros pellentesque posuere. Nunc sodales urna non nulla convallis, eu convallis ex pulvinar. Duis malesuada dui nisl, vestibulum sagittis diam viverra non.', '2018-12-14 16:56:15', '2018-12-14 16:56:15'),
(71, 18, 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nisi odio, fringilla nec posuere sit amet, dignissim id sapien. Nam tristique est a fermentum dignissim.', '2018-12-14 17:09:07', '2018-12-14 17:09:07'),
(74, 10, 'Where to Ski: Great Advice on Where to Go', 'Where to ski? In planning your skiing holiday thatâ€™s the most important decision you have to make. Statistically, you can ski in 6,000 resorts in 75 countries, letâ€™s start by narrowing the field down by 75% - South Africa and North Korea donâ€™t need to be on your list.\r\n\r\nThe most popular European ski countries differ enormously in terms of price and facilities. France has the best mountain infrastructure with lots of purpose-built stations de ski offering ski-in, ski-out convenience.\r\n\r\nAustria and Switzerland have Christmas card-style villages with loads of atmosphere. Italy is known for its delicious food at good-value prices. Scandinavia is more of an all-round winter sports destination. Andorra and Eastern Europe are the best budget resorts, with plenty of vibrant nightlife.\r\n\r\nNorth America is more expensive to get to but once youâ€™re there food prices are more reasonable, the standard of tuition is extremely high and instruction from a native English-speaker is a massive advantage. Apartments tend to be larger and better equipped than the average in the Alps.', '2018-12-14 17:17:31', '2018-12-14 17:17:31'),
(75, 13, 'lore lorem', 'Fusce euismod nibh nec urna vulputate, eu rhoncus nisl maximus. Phasellus convallis maximus eleifend. Nunc consequat pulvinar mi. Ut sed sapien maximus, tempus arcu quis, mollis tellus. Morbi varius euismod neque, eget.', '2018-12-14 17:22:52', '2018-12-14 17:22:52'),
(76, 24, 'some lorem', 'Phasellus eget est tristique, molestie ligula accumsan, faucibus felis. Sed sed est in lectus porta faucibus et ac mauris. Donec quis aliquam leo, eget suscipit lorem. Maecenas ultricies dictum faucibus. Aliquam sit amet massa nec purus pretium eleifend. Nulla facilisi. Donec id erat id dui euismod auctor. Sed a scelerisque ante, non molestie quam. Vestibulum lobortis.', '2018-12-14 20:14:59', '2018-12-14 20:14:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `status`) VALUES
(9, 'liza', 'shostak', 'liza.mins@gmail.com', '$2y$10$WFwLiiWvJBEX4vwBA0p4mu8A0NVoPlpU5sRY6v.EE8QZefkQUMcNW', 1, 1),
(10, 'shai', 'cohen', 'shai@gmail.com', '$2y$10$qxASpY/hCVcua0f3egZMNexy3bBUtfyHETDRm17j0QUrFvjD7ty46', 2, 1),
(13, 'idan', 'cohen', 'idan@gmail.com', '$2y$10$KvPrJRxlt.5Bp0aRUN.dC.644x43cHwuqv2hIOqg2a075wDzMmqu.', 2, 1),
(14, 'moshe', 'cohen', 'moshe@gmail.com', '$2y$10$WSSKSbPINixyMRqYfRUZwugtJGfdGxUvBWRFsY2um5KCUMUy15z/C', 2, 1),
(16, 'david', 'Tzadok', 'david123@gmail.com', '$2y$10$mi9Czf.flhLFLkIwR5nSJO9BV.TCFdHk3aXwMMpVpzsFc9KeTPMGe', 2, 1),
(17, 'roy', 'cohen', 'roy@gmail.com', '$2y$10$vzkMU.K.67o0bWbwyecv7.GroBcHflKydNZ5Gi6tGB/un7X5a7gHe', 2, 1),
(18, 'adam', 'feldman', 'adam@gmail.com', '$2y$10$crnjB4n6Ymh5lV13leBEXO.KPsg2Wq8kwVQTCjXb.j.t56SgtAUF.', 2, 1),
(19, 'aviad', 'yossef', 'aviad@gmail.com', '$2y$10$y44xYGRBScJJYPzLEtvnUOGMK2mGG95ud1TygdxKG8wWlln7gzhFu', 2, 0),
(24, 'antonio', 'shostak', 'anton@gmail.com', '$2y$10$Ewh.2f8103DyUVK7V4JzouIKaIwRa7rj4y3SVsrHfehR3lv7qnKtm', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
