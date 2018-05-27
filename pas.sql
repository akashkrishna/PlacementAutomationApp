-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2018 at 10:08 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pas`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `aid` int(11) NOT NULL,
  `reg` varchar(8) NOT NULL,
  `jid` int(11) NOT NULL,
  `res` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`aid`, `reg`, `jid`, `res`) VALUES
(8, '157CS214', 23, 0),
(9, '157CS214', 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `jid` int(11) NOT NULL,
  `pos` varchar(256) NOT NULL,
  `com` int(11) NOT NULL,
  `deg` varchar(256) NOT NULL,
  `brh` varchar(256) NOT NULL,
  `xp` int(11) NOT NULL,
  `xiip` int(11) NOT NULL,
  `agg` int(11) NOT NULL,
  `arr` int(11) NOT NULL,
  `info` longtext NOT NULL,
  `ld` date NOT NULL,
  `rd` date NOT NULL,
  `con` varchar(256) NOT NULL,
  `status` int(1) NOT NULL,
  `conf` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jid`, `pos`, `com`, `deg`, `brh`, `xp`, `xiip`, `agg`, `arr`, `info`, `ld`, `rd`, `con`, `status`, `conf`) VALUES
(12, 'Software Engineer', 1200000, 'UG', 'Computer Applications, Maths, Statistics', 85, 85, 70, 0, 'â€¢ Students must carry the following for the recruitment process â€“ 2 Recent Photographs (both ears visible in light background), Resume (max of 2 pages), all academic mark sheets & certificates (original & 1 photocopy) for verification.\r\n\r\nâ€¢ Students must carry 1 photocopy of their PAN Card, Aadhaar Card & passport (front & back page).\r\n\r\nAs part of the selection process, the recruitment team will conduct the following assessments:\r\nâ€¢ Online Aptitude test\r\nâ€¢ Technical Interview\r\nâ€¢ HR discussion', '2018-04-15', '2018-04-20', 'ceo@amazon.com', 1, 0),
(13, 'Assistant Proffessor', 200000, 'PG, PHD', 'Computer Applications, Maths, Statistics, Physics, Chemistry, Commerce, Business Administration', 75, 75, 75, 0, '', '2018-03-15', '2018-03-30', 'akashkrishna.sr@gmail.com', 2, 0),
(14, 'Android Developer', 2500000, 'UG, PG', 'Computer Applications, Statistics, Maths', 85, 85, 70, 0, '', '2018-04-10', '2018-04-01', 'ceo@google.com', 2, 0),
(15, 'Full Stack Developer', 2300000, 'UG, PG', 'Computer Applications', 85, 85, 85, 0, '', '2018-03-31', '2018-04-01', 'ceo@apple.com', 1, 1),
(16, 'Business Analyst', 2300000, 'UG', 'Computer Applications, Statistics, Physics', 75, 75, 75, 0, '', '2018-03-16', '2018-03-21', 'ceo@dell.com', 2, 0),
(17, 'Office Administrator', 250000, 'UG, PG, PHD', 'Computer Applications, Maths, Statistics, Physics, Chemistry, Commerce, Business Administration', 70, 70, 70, 0, '', '2018-03-26', '2018-03-31', 'akashkrishna.sr@gmail.com', 2, 0),
(22, 'Something', 0, 'UG', 'Computer Applications', 35, 35, 0, 0, '', '2018-03-31', '2018-03-24', 'chandra@allsec.com', 2, 0),
(23, 'System Administrator', 200000, 'UG', 'Computer Applications', 70, 70, 70, 0, '', '2018-03-31', '2018-03-28', 'akashkrishna@gmail.com', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `un` varchar(256) NOT NULL,
  `pw` varchar(500) NOT NULL,
  `tp` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`un`, `pw`, `tp`) VALUES
('157CS213', '01/01/1998', 'S'),
('157CS214', '21/04/1998', 'S'),
('157CS220', '19/01/1998', 'S'),
('157CS243', '18/06/1998', 'S'),
('admin', 'aks@pas', 'A'),
('akashkrishna.sr@gmail.com', 'Password', 'R'),
('ceo@amazon.com', 'password', 'R'),
('ceo@apple.com', 'password', 'R'),
('ceo@dell.com', 'password', 'R'),
('ceo@google.com', 'password', 'R'),
('ceo@microsoft.com', 'password', 'R'),
('chandra@allsec.com', 'Password1', 'R');

-- --------------------------------------------------------

--
-- Table structure for table `rec`
--

CREATE TABLE `rec` (
  `com` varchar(256) NOT NULL,
  `nam` varchar(256) NOT NULL,
  `des` varchar(128) NOT NULL,
  `ema` varchar(100) NOT NULL,
  `cno` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rec`
--

INSERT INTO `rec` (`com`, `nam`, `des`, `ema`, `cno`) VALUES
('Madras Christian College', 'Akash Krishna', 'Placement Coordinator', 'akashkrishna.sr@gmail.com', 9500166810),
('Amazon', 'Jeff Bezos', 'CEO', 'ceo@amazon.com', 9876543210),
('Apple', 'Tim Cook', 'CEO', 'ceo@apple.com', 9876543210),
('Dell', 'Michael Dell', 'CEO', 'ceo@dell.com', 9876543210),
('Google', 'Sundar Pichai', 'CEO', 'ceo@google.com', 9876543210),
('Microsoft', 'Bill Gates', 'CEO', 'ceo@microsoft.com', 9876543210),
('Allsec', 'Chandra', 'HR', 'chandra@allsec.com', 9876543210);

-- --------------------------------------------------------

--
-- Table structure for table `stu`
--

CREATE TABLE `stu` (
  `reg` varchar(8) NOT NULL,
  `nam` varchar(256) NOT NULL,
  `deg` char(3) NOT NULL,
  `dep` varchar(128) NOT NULL,
  `x` int(3) NOT NULL,
  `xii` int(3) NOT NULL,
  `agg` int(3) NOT NULL,
  `arr` int(2) NOT NULL,
  `phone` double NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stu`
--

INSERT INTO `stu` (`reg`, `nam`, `deg`, `dep`, `x`, `xii`, `agg`, `arr`, `phone`, `email`) VALUES
('157CS213', 'Swathi', 'UG', 'Maths', 80, 70, 60, 0, 9876543210, 'swathi@gmail.com'),
('157CS214', 'Akash', 'UG', 'Computer Applications', 86, 87, 85, 0, 9500166810, 'akashkrishna.sr@gmail.com'),
('157CS220', 'Deepak', 'PG', 'Maths', 95, 95, 75, 0, 9876543210, 'deepak@gmail.com'),
('157CS243', 'Santheep', 'PHD', 'Statistics', 80, 80, 80, 0, 9876543210, 'santheep@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`un`);

--
-- Indexes for table `rec`
--
ALTER TABLE `rec`
  ADD PRIMARY KEY (`ema`);

--
-- Indexes for table `stu`
--
ALTER TABLE `stu`
  ADD PRIMARY KEY (`reg`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
