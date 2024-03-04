-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 11:59 PM
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
-- Database: `unzapdf`
--

-- --------------------------------------------------------

--
-- Table structure for table `pdfs`
--

CREATE TABLE `pdfs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `creator` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `recommendation` int(11) NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pdfs`
--

INSERT INTO `pdfs` (`id`, `name`, `link`, `creator`, `type`, `recommendation`, `date`) VALUES
(1, 'The Great Gatsby by F. Scott Fitzgerald', 'The_Great_Gatsby_by_F._Scott_Fitzgerald.pdf', 'Autone Mululuma', 'NS', 3, '2024-03-04 23:53:06'),
(2, 'To Kill a Mockingbird by Harper Lee', 'To_Kill_a_Mockingbird_by_Harper_Lee.pdf', 'magret monga', 'hss', 2, '2024-03-05 00:02:14'),
(3, '1984 by George Orwell', '1984_by_George_Orwell', 'Emmanuel Muswalo', 'NS', 1, '2024-03-05 00:02:18'),
(4, 'Pride and Prejudice by Jane Austen', 'Pride_and_Prejudice_by_Jane_Austen', 'peter marques', 'vet', 1, '2024-03-04 22:59:29'),
(5, 'The Catcher in the Rye by J.D. Salinger', 'The_Catcher_in_the_Rye_by_J.D._Salinger', 'John Doe', 'hss', 1, '2024-03-04 22:59:42'),
(6, 'Lord of the Flies by William Golding', 'Lord_of_the_Flies_by_William_Golding', 'Jane Doe', 'law', 0, '2024-03-04 22:59:52'),
(7, 'The Hobbit by J.R.R. Tolkien', 'The_Hobbit_by_J.R.R._Tolkien', 'C. mumba', 'law', 0, '2024-03-04 23:39:05'),
(8, 'The Harry Potter series by J.K. Rowling', 'The_Harry_Potter_series_by_J.K._Rowling', 'John doe', 'ns', 1, '2024-03-04 23:39:05'),
(9, 'Animal Farm by George Orwell', 'Animal_Farm_by_George_Orwell', 'Emmanuel Muswalo', 'eng', 0, '2024-03-04 23:40:41'),
(10, 'Brave New World by Aldous Huxley', 'Brave_New_World_by_Aldous_Huxley', 'Auton mululuma', 'hss', 0, '2024-03-04 23:40:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pdfs`
--
ALTER TABLE `pdfs`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `pdfs` ADD FULLTEXT KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pdfs`
--
ALTER TABLE `pdfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
