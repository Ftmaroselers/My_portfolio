-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2025 at 06:44 PM
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
-- Database: `myporfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'Fatima Arnado', 'timayroselloza24@gmail.com', 'this is awesome', '2025-11-27 16:55:39'),
(2, 'Pat Roselloza', 'patroselloza@gmail.com', 'haiyst', '2025-12-01 18:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `auth_type` enum('manual','google') NOT NULL DEFAULT 'manual'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `google_id`, `created_at`, `reset_token`, `reset_expires`, `auth_type`) VALUES
(2, 'Josiah Travis Montefalco', 'josiahmontefalco@gmail.com', '$2y$10$LpKUCeI1/xASaNY.zF/mg.NG3z1Re1/Ru379jwOvjjNybiBkYQbF2', NULL, '2025-12-09 12:28:29', NULL, NULL, 'manual'),
(5, 'Ace Zaldua', 'aestheriellemercadejas@gmail.com', '$2y$10$IOq2lE5P6XfDWZP9yS5QG.zbsJ77OZ9XmOsmU/rWm52OckTpxe1J2', NULL, '2025-12-09 14:02:40', NULL, NULL, 'manual'),
(6, 'FATIMA ARNADO', 'timayroselloza24@gmail.com', '', '108819725368872587052', '2025-12-09 16:58:49', NULL, NULL, 'google'),
(7, 'Fatima Arnado', 'fatimaarnado08@gmail.com', '', '116832184030722221457', '2025-12-09 17:08:15', NULL, NULL, 'manual'),
(8, 'Fatima', 'ftmarosell24@gmail.com', '', '117263899162345182809', '2025-12-09 17:11:28', NULL, NULL, 'manual'),
(9, 'Knoxx Gideon Montefalco', 'knoxxmontefalco@gmail.com', '$2y$10$f82nP2HtYW8G4SIHuHMmne7GyxkP.tu9GyiUdx26OaRqkH6zKzGrC', NULL, '2025-12-09 17:38:51', NULL, NULL, 'manual');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `google_id` (`google_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
