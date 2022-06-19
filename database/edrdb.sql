-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql300.epizy.com
-- Generation Time: Feb 18, 2022 at 01:23 PM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edrdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `usersId` int(11) NOT NULL,
  `usersFname` varchar(40) NOT NULL,
  `usersLname` varchar(40) NOT NULL,
  `usersAge` int(3) NOT NULL,
  `usersPnumber` varchar(12) NOT NULL,
  `usersAddress` varchar(100) NOT NULL,
  `usersGender` varchar(6) NOT NULL,
  `usersEmail` varchar(60) NOT NULL,
  `usersPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`usersId`, `usersFname`, `usersLname`, `usersAge`, `usersPnumber`, `usersAddress`, `usersGender`, `usersEmail`, `usersPassword`) VALUES
(7, 'admin', 'admin', 20, '09090909090', 'Admin adress', 'male', 'admin', '$2y$10$3hDYcsH8mgb.NDLKRI5B6eW5DFnDSpXrBnnjn.DUdiLEJzl.7pknu'),
(9, 'newadmin', 'sample', 28, '09123456788', 'sample address', 'female', 'newadmin@gmail.com', '$2y$10$7DzIv2rGhQgmaLcbcVWQBulQnOzfHPIfKs.E9JrtqQpLmAEMz6R6W');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `Id` int(11) NOT NULL,
  `room` varchar(100) NOT NULL,
  `clientName` varchar(100) NOT NULL,
  `clientEmail` varchar(100) NOT NULL,
  `clientNumber` varchar(12) NOT NULL,
  `checkInDate` date NOT NULL,
  `checkOutDate` date NOT NULL,
  `totalBill` int(12) NOT NULL,
  `transtatus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`Id`, `room`, `clientName`, `clientEmail`, `clientNumber`, `checkInDate`, `checkOutDate`, `totalBill`, `transtatus`) VALUES
(123, 'Single', ' jonathan llemit ', 'jonathan.llemit16@gmail.com', ' 09098859974', '2021-12-20', '2021-12-25', 4000, 'successful'),
(124, 'Double', ' jonathan llemit ', 'jonathan.llemit16@gmail.com', ' 09098859974', '2021-12-25', '2021-12-30', 6000, 'cancelled'),
(125, 'Single', ' jonathan llemit ', 'jonathan.llemit16@gmail.com', ' 09098859974', '2021-12-26', '2021-12-30', 3200, 'successful'),
(126, 'King', ' jonathan llemit ', 'jonathan.llemit16@gmail.com', ' 09098859974', '2021-12-20', '2021-12-24', 10000, 'successful'),
(127, 'Queen', ' jonathan llemit ', 'jonathan.llemit16@gmail.com', ' 09098859974', '2021-12-28', '2021-12-31', 6000, 'successful'),
(128, 'Double', ' juan dela cruz ', 'juan@gmail.com', ' 09091221121', '2021-12-29', '2021-12-31', 2400, 'successful');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `Id` int(11) NOT NULL,
  `usersName` varchar(100) NOT NULL,
  `usersEmail` varchar(100) NOT NULL,
  `usersMessage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`Id`, `usersName`, `usersEmail`, `usersMessage`) VALUES
(1, 'Jonathan Llemit Jr.', 'jonathan.llemit16@gmail.com', 'qwewqewqewqeqwe'),
(2, 'Jonathan Llemit Jr.', 'jonathan.llemit16@gmail.com', 'testing lodi kakes'),
(3, 'qweqweqwe', 'qwerty@gmail.com', 'qweqwewqeqw'),
(4, 'jorgie llemit', 'jorgie.llemit16@gmail.com', 'sample message umay!'),
(5, 'another sample', 'sample@gmail.com', 'sample malala');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `Id` int(11) NOT NULL,
  `room` varchar(100) NOT NULL,
  `clientName` varchar(100) NOT NULL,
  `clientEmail` varchar(100) NOT NULL,
  `clientNumber` varchar(12) NOT NULL,
  `checkInDate` date NOT NULL,
  `checkOutDate` date NOT NULL,
  `totalBill` int(12) NOT NULL,
  `occupied` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `Id` int(11) NOT NULL,
  `roomName` varchar(100) NOT NULL,
  `roomRate` int(11) NOT NULL,
  `roomDescription` text NOT NULL,
  `images` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`Id`, `roomName`, `roomRate`, `roomDescription`, `images`) VALUES
(52, 'Single', 800, 'Comfortable single room.', 'image52.jpg'),
(53, 'Double', 1200, 'Good for two people.', 'image53.jpg'),
(54, 'Triple', 1500, 'Good for three people.', 'image54.jpg'),
(55, 'Quad', 2000, 'Good for four people.', 'image55.jpeg'),
(56, 'Queen', 2000, 'More relaxing good for two people.', 'image56.png'),
(57, 'King', 2500, 'Feel like royalty.', 'image57.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersFname` varchar(40) NOT NULL,
  `usersLname` varchar(40) NOT NULL,
  `usersAge` int(3) NOT NULL,
  `usersPnumber` varchar(12) NOT NULL,
  `usersAddress` varchar(100) NOT NULL,
  `usersGender` varchar(6) NOT NULL,
  `usersEmail` varchar(60) NOT NULL,
  `usersPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersFname`, `usersLname`, `usersAge`, `usersPnumber`, `usersAddress`, `usersGender`, `usersEmail`, `usersPassword`) VALUES
(12, 'samplefname', 'samplelname', 21, '09886644235', 'sample address', 'male', 'newsample@gmail.com', '$2y$10$DhuCpBsYRYS7DbUdQi6SaeQgeBxHJjKh86hQS/Zz3PcF5UZfp.SSu'),
(13, 'jonathan', 'llemit', 21, '09098859974', 'Bagong Silang', 'male', 'jonathan.llemit16@gmail.com', '$2y$10$S9QyxVgl6fkuuSJFTxx1TeE.lubYll0gbNoILns1JlVj/l/SWNwKy'),
(14, 'Redlly', 'Escubido', 21, '09102081026', 'Bagong Silang Caloocan City', 'female', 'redescubido11@gmail.com', '$2y$10$p6Fw1ixXUHXoAGsKTHo1ROKbBKEpZsx9jLRxaoyJ4404kyyjq4qQe'),
(15, 'jeffrey', 'coco', 28, '09000000000', 'caloocan', 'male', 'jeffreycoco09@gmail.com', '$2y$10$VOsk2gISrZ7BpSyFNC/1fub4Ys95yHIrLusI1xFyOZMbej2TdpxGK'),
(16, 'coco', 'jeffrey', 28, '09000000001', 'caloocan', 'male', 'kaging.gaming@gmail.com', '$2y$10$ku45Y5oSv.6BHonk/TqAVeu.jkvC21.n6urO.WLrDh5FuYedHOJKq'),
(17, 'juan', 'dela cruz', 30, '09091221121', 'Sample Address', 'male', 'juan@gmail.com', '$2y$10$464mU5rgXuQ85E7GqQfc/uBIg76qd9jPphTU.u7HazyuVHP2N5EFa'),
(18, 'exta', 'extra', 21, '096563221542', 'Sample', 'male', 'extra@gmail.com', '$2y$10$6Z17Z5IhPHwlF2Co0eVtxO5WfIWixRAILmLo05HLT8joE/eVhf/i6'),
(19, 'another', 'sample', 18, '098476328921', 'Sample', 'female', 'another@gmail.com', '$2y$10$0NnPYO4E8fEr6W9ylYK2juhoOuRRDaUy.xw00GOnLQE0JEPHJrfAG'),
(20, 'Tiffany', 'Lagadon', 21, '09123456789', 'Caloocan City', 'female', 'email@gmail.com', '$2y$10$.pTm2QoUWx0ZapVt2DjKWeChIhPcCjwnijxjilLFvOKJ9PC8hCAQu'),
(21, 'John', 'Ramos', 24, '09563987261', 'Caloocan', 'male', 'johnd@gmail.com', '$2y$10$6PVTmN1E7YhnX2pVa37i5eGnktcg4toGX6wlR2kDavpxBln0mthyu'),
(22, 'Ann', 'Santos', 28, '09739721985', 'Caloocan', 'female', 'anns@gmail.com', '$2y$10$CCJD7TcQPlU3xDZGX9gx6e8JQLeQCw9lWoVDW3XPdgbyBzv5MS7di'),
(23, 'Mary', 'Cruz', 31, '09387618932', 'Caloocan', 'female', 'maryc@gmail.com', '$2y$10$j96xtY2DMW6noqq/.cATxOLwe4L13E3mIoo98f3HRoSr.vh2jPw7u'),
(24, 'vada', 'alabe', 20, '09264513790', 'villa imelda', 'female', 'vadaalabejerusalem11@gmail.com', '$2y$10$RvU.D9hWDeXauDatqn.20uSlx2aRAp20dmVKs7IAqa9ycJSeRqDde'),
(25, 'hello', 'hi', 29, '09223344559', 'caloocan', 'male', 'hello@gmail.com', '$2y$10$U6ZhPQRZXu3EgPhvjixslu48m8JCcw07SI34CmkVU/ZHUIx9Kkd2q');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`usersId`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
