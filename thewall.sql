-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2019 at 05:03 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thewall`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_size` varchar(255) NOT NULL,
  `image_date` datetime NOT NULL,
  `user_id` int(255) NOT NULL,
  `image_title` varchar(255) NOT NULL,
  `image_description` text NOT NULL,
  `score` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image_name`, `image_size`, `image_date`, `user_id`, `image_title`, `image_description`, `score`) VALUES
(149, '1555598785.jpg', '0.042938 MB', '2019-04-18 16:46:25', 21, 'ja', 'haaa', 0),
(150, '1555598825.jpg', '0.039858 MB', '2019-04-18 16:47:05', 21, 'ja', 'haaa', 1),
(151, '1555598882.jpg', '0.012928 MB', '2019-04-18 16:48:02', 21, 'tes', 'tes', 0),
(152, 'IMG_20171009_141803.jpg', '0.487101 MB', '2019-04-18 16:49:15', 21, 'imagecompress', 'lesa', 0),
(153, '1555598984.jpg', '0.404131 MB', '2019-04-18 16:49:44', 21, 'imagecompress', 'lesa', 1),
(154, '1555599018.jpg', '0.359178 MB', '2019-04-18 16:50:18', 21, 'imagecompress', 'lesa', 0),
(155, '1555599062.jpg', '0.00936 MB', '2019-04-18 16:51:02', 21, 'yes please', 'ss', 0),
(156, 'BpzAuax.png', '0.172623 MB', '2019-04-18 16:52:09', 21, 'compression test', 'e', 0),
(157, 'Boku-no-Hero-Academia-anime-girls-Mei-Hatsume-1383001-wallhere.com.jpg', '0.418918 MB', '2019-04-18 16:54:00', 21, 'BIGfile', 'yes big', 0);

-- --------------------------------------------------------

--
-- Table structure for table `image_tags`
--

CREATE TABLE `image_tags` (
  `image_id` int(255) NOT NULL,
  `tag_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image_tags`
--

INSERT INTO `image_tags` (`image_id`, `tag_id`) VALUES
(106, 99),
(107, 100),
(108, 101),
(108, 102),
(109, 103),
(110, 104),
(111, 105),
(112, 106),
(113, 107),
(114, 108),
(115, 109),
(116, 110),
(117, 111),
(118, 112),
(119, 113),
(120, 114),
(121, 115),
(122, 116),
(123, 117),
(124, 118),
(125, 119),
(126, 120),
(127, 121),
(128, 122),
(129, 123),
(130, 124),
(131, 125),
(132, 126),
(133, 127),
(134, 128),
(135, 129),
(136, 130),
(137, 131),
(138, 132),
(139, 133),
(140, 134),
(141, 135),
(142, 136),
(143, 137),
(144, 138),
(145, 139),
(146, 140),
(147, 141),
(148, 142),
(149, 143),
(150, 144),
(151, 145),
(152, 146),
(153, 147),
(154, 148),
(155, 149),
(156, 150),
(157, 151);

-- --------------------------------------------------------

--
-- Table structure for table `image_votes`
--

CREATE TABLE `image_votes` (
  `image_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `vote` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image_votes`
--

INSERT INTO `image_votes` (`image_id`, `user_id`, `vote`) VALUES
(107, 21, 1),
(106, 21, 1),
(123, 21, 1),
(109, 21, 1),
(110, 21, 1),
(111, 21, 1),
(112, 21, 1),
(113, 21, 1),
(114, 21, 1),
(115, 21, 1),
(108, 21, 1),
(111, 22, 1),
(128, 21, 1),
(129, 21, 1),
(143, 21, 1),
(150, 21, 1),
(153, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`) VALUES
(99, '22'),
(100, 'aaa'),
(101, 'zeker'),
(102, 'een driehoek'),
(103, 'nice image'),
(104, 'nice image'),
(105, 'nice image'),
(106, 'nice image'),
(107, 'nice image'),
(108, 'nice image'),
(109, 'nice image'),
(110, 'nice image'),
(111, 'nice image'),
(112, 'nice image'),
(113, 'nice image'),
(114, 'www'),
(115, 'sex'),
(116, 'ses'),
(117, 'ssss'),
(118, 'sqwd'),
(119, 'jaja'),
(120, 'jaja'),
(121, 'D'),
(122, 'tes'),
(123, 'tee'),
(124, 'tee'),
(125, 'tee'),
(126, 'tee'),
(127, 'tee'),
(128, 'tee'),
(129, 'tee'),
(130, 'test'),
(131, 'tt'),
(132, 'tt'),
(133, 'tt'),
(134, 'tt'),
(135, 'tt'),
(136, 'tt'),
(137, 'tt'),
(138, 'no'),
(139, 'no'),
(140, 'no'),
(141, 'gaa'),
(142, 'gaa'),
(143, 'gaa'),
(144, 'gaa'),
(145, 'tee'),
(146, 'aa'),
(147, 'aa'),
(148, 'aa'),
(149, 'ss'),
(150, 'e'),
(151, 'too big');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `profilepicture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_email`, `user_password`, `profilepicture`) VALUES
(21, 'pim55', 'mail222@mail.com', '$argon2i$v=19$m=1024,t=2,p=2$YlNqdi9SZzRyUlVTQmtROQ$duddbSAwCh/5K3fORSLYRWuuqNNDBjaweQltDDxCr/E', 'pim55.png'),
(24, 'pim', 'mail@mail.com', '$argon2i$v=19$m=1024,t=2,p=2$dDBsbkZsbDhrRGpsZ2MyaA$CQrrllQdX6ZhSIRX1IoX0qF8Ztjk5lfY2/MtXzLeB30', 'pim.png'),
(25, 'pim123', 'mail22@mial.com', '$argon2i$v=19$m=1024,t=2,p=2$ZlEzaXhGenhDL1AxcktGQQ$NwwCqi+Yr51wMATDiulOJ4OkFdN/IaTMxYK9rOUZZN4', 'pim123.png'),
(26, 'pim555444', 'mail2mail@mail.com', '$argon2i$v=19$m=1024,t=2,p=2$b2VxMkVxQkJVa2FzeDZxSg$Dan0J58Gtp9KxvpJbSrVme9w0tmZAapgmMKZlLO5S4c', 'pim555444.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
