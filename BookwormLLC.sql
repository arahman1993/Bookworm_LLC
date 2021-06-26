-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 19, 2020 at 08:27 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BookwormLLC`
--

-- --------------------------------------------------------

--
-- Table structure for table `Book`
--

CREATE TABLE `Book` (
  `ISBN` char(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `Author` varchar(30) NOT NULL,
  `Publisher` varchar(30) NOT NULL,
  `Edition` varchar(45) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `count` smallint(6) NOT NULL,
  `genre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Book`
--

INSERT INTO `Book` (`ISBN`, `title`, `Author`, `Publisher`, `Edition`, `price`, `count`, `genre`) VALUES
('0374300216', 'If Animals Kissed Good Night', 'Ann Whitford Paul', 'Farrar', 'illustrated edition', '4.79', 84, 'children'),
('039480001X', 'The Cat In the Hat', 'Dr.Seuss', 'Random House Books', 'illustrated edition', '5.90', 34, 'children'),
('0394800796', 'How The Grinch Stole Christmas!', 'Dr.Seuss', 'Random House Books', 'illustrated edition', '7.98', 20, 'children'),
('0525559477', 'The Midnight Library', 'Matt Haig', 'Viking', 'Hardcover', '15.99', 15, 'Sci-fi'),
('0593139135', 'Greenlights', 'Matthew McConaughey ', 'Crown', 'Hardcover', '14.98', 3, 'Biography'),
('0804187061', 'Modern Comfort Food: A Barefoot Contessa Cookbook', 'Ina Garten', 'Clarkson Potter', 'illustrated edition', '17.50', 30, 'cook-book'),
('1250219590', 'Saint X: A Novel', 'Alexis Schaitkin', 'Celadon Books', 'Hardcover', '13.49', 5, 'fiction'),
('1524763136', 'Becoming', 'Michelle Obama', 'Crown', 'Hardcover', '11.89', 9, 'Biography'),
('1524763160', 'A Promised Land', 'Barack Obama', 'Crown', 'Hardcover', '27.00', 12, 'Memoirs'),
('1984801252', 'Untamed', 'Glennon Doyle', 'The Dial Press', 'Hardcover', '16.75', 0, 'self-help'),
('9781452139', 'Construction Site on Christmas Night', 'Sherri Duskey Rinker', 'Chronicle Books', 'illustrated edition', '6.74', 0, 'children');

-- --------------------------------------------------------

--
-- Table structure for table `Branch`
--

CREATE TABLE `Branch` (
  `BID` char(3) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip` int(11) NOT NULL,
  `street` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Branch`
--

INSERT INTO `Branch` (`BID`, `city`, `zip`, `street`) VALUES
('B00', 'Houston', 77070, 'Hollow Rock Dr.');

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `CID` char(3) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`CID`, `fname`, `lname`, `city`, `zip`, `phone`) VALUES
('C00', 'Unregistered', 'Customer', 'Houston', 77070, '0000000000'),
('C01', 'John', 'Doe', 'Dallas', 77665, '2813796666'),
('C02', 'Sally ', 'Hill', 'Houston', 77555, '8325122228');

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE `Employee` (
  `EID` char(3) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `type` char(1) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `BID` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Employee`
--

INSERT INTO `Employee` (`EID`, `fname`, `lname`, `type`, `salary`, `phone`, `BID`) VALUES
('E00', 'Online', 'User', 'N', '0.00', '0000000000', 'B00'),
('E01', 'Kyle', 'Smith', 'M', '70000.00', '8888888888', 'B00'),
('E02', 'Randy', 'Lee', 'B', '50000.00', '7134288776', 'B00'),
('E03', 'lucy', 'Dale', 'B', '50000.00', '8324006001', 'B00');

-- --------------------------------------------------------

--
-- Table structure for table `Transactions`
--

CREATE TABLE `Transactions` (
  `TID` char(3) NOT NULL,
  `ISBN` char(10) NOT NULL,
  `CID` char(3) NOT NULL,
  `EID` char(3) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Transactions`
--

INSERT INTO `Transactions` (`TID`, `ISBN`, `CID`, `EID`, `date`) VALUES
('T00', '039480001X', 'C01', 'E00', '2020-11-04'),
('T01', '0374300216', 'C01', 'E00', '2020-10-14'),
('T02', '0394800796', 'C01', 'E00', '2020-10-19'),
('T03', '039480001X', 'C01', 'E01', '2020-09-09'),
('T04', '9781452139', 'C00', 'E02', '2020-11-01'),
('T05', '1984801252', 'C00', 'E02', '2020-11-01'),
('T06', '1984801252', 'C00', 'E02', '2020-11-01'),
('T07', '0804187061', 'C00', 'E02', '2020-10-14'),
('T08', '0804187061', 'C00', 'E03', '2020-10-23'),
('T09', '0525559477', 'C00', 'E03', '2020-10-18'),
('T10', '1524763136', 'C00', 'E01', '2020-10-03'),
('T11', '1984801252', 'C00', 'E03', '2020-09-20'),
('T12', '0394800796', 'C00', 'E03', '2020-09-12'),
('T13', '0394800796', 'C02', 'E00', '2020-06-09'),
('T14', '0374300216', 'C00', 'E02', '2020-11-16'),
('T15', '0374300216', 'C00', 'E02', '2020-11-16'),
('T16', '039480001X', 'C00', 'E02', '2020-11-18'),
('T17', '039480001X', 'C00', 'E02', '2020-11-18'),
('T18', '039480001X', 'C00', 'E02', '2020-11-18'),
('T19', '0374300216', 'C00', 'E02', '2020-11-19'),
('T20', '039480001X', 'C00', 'E02', '2020-11-19'),
('T21', '0374300216', 'C00', 'E01', '2020-11-19'),
('T22', '0374300216', 'C00', 'E01', '2020-11-19'),
('T23', '1524763136', 'C00', 'E01', '2020-11-19'),
('T24', '1524763136', 'C00', 'E01', '2020-11-19'),
('T25', '0374300216', 'C01', 'E00', '2020-11-19'),
('T26', '0374300216', 'C00', 'E01', '2020-11-19'),
('T27', '0374300216', 'C00', 'E01', '2020-11-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Book`
--
ALTER TABLE `Book`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `Branch`
--
ALTER TABLE `Branch`
  ADD PRIMARY KEY (`BID`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`CID`);

--
-- Indexes for table `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`EID`),
  ADD KEY `branch_employee` (`BID`);

--
-- Indexes for table `Transactions`
--
ALTER TABLE `Transactions`
  ADD PRIMARY KEY (`TID`),
  ADD KEY `customer_transaction` (`CID`),
  ADD KEY `employee_transaction` (`EID`),
  ADD KEY `book_transaction` (`ISBN`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Employee`
--
ALTER TABLE `Employee`
  ADD CONSTRAINT `branch_employee` FOREIGN KEY (`BID`) REFERENCES `Branch` (`BID`);

--
-- Constraints for table `Transactions`
--
ALTER TABLE `Transactions`
  ADD CONSTRAINT `book_transaction` FOREIGN KEY (`ISBN`) REFERENCES `Book` (`ISBN`),
  ADD CONSTRAINT `customer_transaction` FOREIGN KEY (`CID`) REFERENCES `Customer` (`CID`),
  ADD CONSTRAINT `employee_transaction` FOREIGN KEY (`EID`) REFERENCES `Employee` (`EID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
