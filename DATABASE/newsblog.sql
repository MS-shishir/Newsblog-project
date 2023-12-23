-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 04:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `is_parent` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `cat_name`, `is_parent`, `status`) VALUES
(1, 'Bangladesh', 0, 1),
(2, 'Entertenment', 0, 1),
(3, 'Sport', 0, 1),
(5, 'IPL', 3, 1),
(6, 'News', 0, 1),
(7, 'Other', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `cuser_name` varchar(255) NOT NULL,
  `cuser_mail` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `coment` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `cdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `cuser_name`, `cuser_mail`, `subject`, `coment`, `status`, `cdate`) VALUES
(2, 'Md SHISHIR', 'smd990903@gmail.com', 'News', 'This newsblog site is very beautiful. I like this site. Thank you.', 1, '2023-11-05'),
(3, 'MD SHISHIR', 'smd990903@gmail.com', 'News', 'This newsblog site is very beautiful. I like this site. Thank you.', 2, '2023-11-05'),
(6, 'amnad', 'adfsa@dfdsgf', 'fdgfd', 'fsgsfddf', 2, '2023-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `category_type` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `post_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `image`, `category_type`, `status`, `author_name`, `tag`, `post_date`) VALUES
(16, 'ঘূর্ণিঝড় হামুন আঘাত হানতে পারে বুধবার', '‘ঘূর্ণিঝড়প্রবণ’এই মাসে বঙ্গোপসাগরে অতিদ্রুত একটি ঘূনাবর্ত তৈরী হয়েছে। নিম্নচাপটি আজ সোমবার গভীর নিম্নচাপ অত:পর ঘূর্ণিঝড় ‘হামুন’-এ রূপ পরিগ্রহ করতে পারে। নিম্নচাপ কেন্দ্রের ৪৪ কিলোমিটারের মধ্যে বাতাসের একটানা সর্বোচ্চ গতিবেগ ঘণ্টায় ৪০ কিলোমিটার। যা দমকা অথবা ঝড়ো হাওয়ার আকারে ৫০ কিলোমিটার পর্যন্ত বৃদ্ধি পাচ্ছে। সাগর উত্তাল রয়েছে।', '850829_e2a977820870ac14cea536429a34b545-65356c8b590e0.jpg', 'News', 1, 'MD SHISHIR', 'BD news', '2023-10-23'),
(17, '‘আমার শিল্পকর্ম মানুষ জানুক, আমাকে না চিনলেও হবে’', 'জাতীয় চলচ্চিত্র পুরস্কার প্রাপ্ত কণ্ঠশিল্পী চন্দন সিনহা এবছর চ্যানেল আই মিউজিক অ্যাওয়ার্ডে সেরা গায়কের পুরস্কার পেলেন। হূদিতা চলচ্চিত্রের জন্য তিনি এই পুরস্কারটি পান। উপমহাদেশের বরেণ্য কণ্ঠশিল্পী রুণা লায়লার হাত থেকে চন্দন সিনহা এই পুরস্কারটি গ্রহন করেন।', '1073_ca329247c36662624b9de5c1dfdaeea1-6535e615ef982.jpg', 'Entertenment', 1, 'MD SHISHIR', 'BD Entertenment', '2023-10-23'),
(18, 'গাজার শরণার্থী শিবিরে ইসরায়েলি হামলা, নিহত ৩০', 'গাজার জাবালিয়া শরণার্থী শিবিরে ইসরায়েলি বোমা হামলার পরে ভবনের ধ্বংসাবশেষ থেকে ৩০ জনের লাশ উদ্ধার করা হয়েছে। নিহতদের মধ্যে অধিকাংশই নারী ও শিশু। গাজার সিভিল ডিফেন্স ইউনিটের বরাতে আল-জাজিরা এ তথ্য জানিয়েছে।', '502223_38bc948e7e0a2168cf013cf2f6895d0f-6535f02d4b36e.jpg', 'News', 1, 'MD SHISHIR', 'BD news', '2023-10-23'),
(21, 'A spark that flourished into fire', 'The English duo of Richard Illingworth and Richard Kettleborough will be the sports ', '876901_download.jpeg', 'IPL', 1, 'MD SHISHIR', 'Sports', '2023-11-26'),
(23, 'Bus torched in Kafrul', '‘ঘূর্ণিঝড়প্রবণ’এই মাসে বঙ্গোপসাগরে অতিদ্রুত একটি ঘূনাবর্ত তৈরী হয়েছে। নিম্নচাপটি আজ সোমবার গভীর নিম্নচাপ অত:পর ঘূর্ণিঝড় ‘হামুন’-এ রূপ পরিগ্রহ করতে পারে। নিম্নচাপ কেন্দ্রের ৪৪ কিলোমিটারের মধ্যে বাতাসের একটানা সর্বোচ্চ গতিবেগ ঘণ্টায় ৪০ কিলোমিটার। যা দমকা অথবা ঝড়ো হাওয়ার আকারে ৫০ কিলোমিটার পর্যন্ত বৃদ্ধি পাচ্ছে। সাগর উত্তাল রয়েছে।', '576231_download.jpg', 'Bangladesh', 1, 'MD SHISHIR', 'BD news', '2023-11-18'),
(24, 'PM seeks vote for ‘boat’ to serve people again', 'Prime Minister and Awami League (AL) President Sheikh Hasina today called upon the people to cast their votes for ‘boat’ in the forthcoming national election to give her party the opportunity to serve them again.  “It’s my call to you (the country’s people) to give us the opportunity to serve you again by casting your vote for boat (AL’s electoral symbol),” she said, addressing a grand rally as chief guest, organised by Khulna City and District Awami League at Khulna Circuit House ground.', '501759_PM-boat.jpg', 'Bangladesh', 1, 'MD SHISHIR', 'BD news', '2023-11-18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `user_nam` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` text NOT NULL,
  `Role` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `user_nam`, `email`, `password`, `image`, `Role`, `status`) VALUES
(1, 'MD SHISHIR', 'smd990903@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '540823_2021-12-30-17-32-18-468.jpg', '1', 1),
(4, 'Rayhan', 'rayhan@gmail.com', '0d467c11c1f788a43266782aac388b66b0f22551', '658195_', '2', 1),
(40, 'Moryom', 'mimakter@gmail.com', '7b21848ac9af35be0ddb2d6b9fc3851934db8420', '899180_', '2', 1),
(41, 'Amit Hasan', 'amit@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '517000_', '2', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
