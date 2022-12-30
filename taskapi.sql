-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 30, 2022 at 09:32 AM
-- Server version: 10.3.37-MariaDB-cll-lve
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nittuinf_stagingpmr`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `attachment` text NOT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `task_id`, `subject`, `attachment`, `note`, `created_at`) VALUES
(1, 1, 'my first subject note', 'a:3:{i:0;O:8:\"stdClass\":1:{s:8:\"filename\";s:8:\"test.jpg\";}i:1;O:8:\"stdClass\":1:{s:8:\"filename\";s:9:\"test2.png\";}i:2;O:8:\"stdClass\":1:{s:8:\"filename\";s:9:\"test.docx\";}}', 'My note text', '2022-12-29 15:45:42'),
(2, 1, 'my first subject note', 'a:3:{i:0;O:8:\"stdClass\":1:{s:8:\"filename\";s:9:\"front.jpg\";}i:1;O:8:\"stdClass\":1:{s:8:\"filename\";s:8:\"test.pdf\";}i:2;O:8:\"stdClass\":1:{s:8:\"filename\";s:9:\"mydoc.csv\";}}', 'My note text', '2022-12-29 15:45:42'),
(3, 2, 'my first subject note', 'a:3:{i:0;O:8:\"stdClass\":1:{s:8:\"filename\";s:8:\"test.jpg\";}i:1;O:8:\"stdClass\":1:{s:8:\"filename\";s:9:\"test2.png\";}i:2;O:8:\"stdClass\":1:{s:8:\"filename\";s:9:\"test.docx\";}}', 'My note text', '2022-12-30 06:29:52'),
(4, 2, 'my first subject note', 'a:3:{i:0;O:8:\"stdClass\":1:{s:8:\"filename\";s:8:\"test.jpg\";}i:1;O:8:\"stdClass\":1:{s:8:\"filename\";s:9:\"test2.png\";}i:2;O:8:\"stdClass\":1:{s:8:\"filename\";s:9:\"test.docx\";}}', 'My note text', '2022-12-30 06:29:52'),
(5, 3, 'my third subject note', 'a:3:{i:0;O:8:\"stdClass\":1:{s:8:\"filename\";s:8:\"test.jpg\";}i:1;O:8:\"stdClass\":1:{s:8:\"filename\";s:9:\"test2.png\";}i:2;O:8:\"stdClass\":1:{s:8:\"filename\";s:9:\"test.docx\";}}', 'My note text', '2022-12-30 06:31:00'),
(6, 3, 'my third subject note', 'a:3:{i:0;O:8:\"stdClass\":1:{s:8:\"filename\";s:8:\"test.jpg\";}i:1;O:8:\"stdClass\":1:{s:8:\"filename\";s:9:\"test2.png\";}i:2;O:8:\"stdClass\":1:{s:8:\"filename\";s:9:\"test.docx\";}}', 'My note text', '2022-12-30 06:31:00'),
(7, 4, 'my Fourth subject note', 'a:3:{i:0;O:8:\"stdClass\":1:{s:8:\"filename\";s:8:\"test.jpg\";}i:1;O:8:\"stdClass\":1:{s:8:\"filename\";s:9:\"test2.png\";}i:2;O:8:\"stdClass\":1:{s:8:\"filename\";s:9:\"test.docx\";}}', 'My note text', '2022-12-30 06:31:24'),
(8, 4, 'my Fourth subject note', 'a:3:{i:0;O:8:\"stdClass\":1:{s:8:\"filename\";s:8:\"test.jpg\";}i:1;O:8:\"stdClass\":1:{s:8:\"filename\";s:9:\"test2.png\";}i:2;O:8:\"stdClass\":1:{s:8:\"filename\";s:9:\"test.docx\";}}', 'My note text', '2022-12-30 06:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `priority` enum('0','1','2') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `subject`, `description`, `start_date`, `due_date`, `status`, `priority`, `created_at`) VALUES
(1, 'My First Task', 'description for first task', '2022-12-29', '2023-02-01', '1', '2', '2022-12-29 15:45:42'),
(2, 'My Second Task', 'description for second task', '2023-01-05', '2023-02-12', '1', '1', '2022-12-30 06:29:52'),
(3, 'My Third Task', 'description for third task', '2023-01-05', '2023-02-12', '1', '0', '2022-12-30 06:31:00'),
(4, 'My Fourth Task', 'description for Fourth task', '2023-01-15', '2023-02-12', '1', '2', '2022-12-30 06:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Shashank', 'Sharma', 'sharmashashank810@gmail.com', '$2y$10$oWphhtVcHdhg1SeKnhIDnuwvOYcbpdQfyQ9QY4URaIeV/Lhto5sna'),
(2, 'Shashank1', 'Sharma', 'sharmashashasnk@gmail.com', '$2y$10$mh.cxJVgFF37YXUQsEkOEOqQaopRUJAgbBT0gV2sQjNRzbHXnvNX.'),
(3, 'Shashank1', 'Sharma', 'sharmashashasnk@gmail.com', '$2y$10$gY4G/s1RTCOAev54F.f3Geg4Eh8m4kQqWlOzMh7p73f4QLV0Agp5G'),
(4, 'Shashank1', 'Sharma', 'sharmashashasnk@gmail.com', '$2y$10$LLkO7LTxD0XxoGEWwKG2tOg7SsivBow3JTXU2axm0NfV/HeSIescO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
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
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
