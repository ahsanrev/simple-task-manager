-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2018 at 02:14 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tasktracker`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `completeTask` (IN `user_id` INT(11), `status` INT(11))  BEGIN
        UPDATE taskmanager SET status = 1
        WHERE id = user_id;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteTask` (IN `user_id` INT(11))  BEGIN
        DELETE FROM taskmanager WHERE id = user_id;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteUser` (IN `user_id` INT(11))  BEGIN
        DELETE FROM user WHERE id = user_id;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertTask` (IN `project_title` VARCHAR(255), `task` VARCHAR(555))  BEGIN
        INSERT INTO taskmanager(project_title,task)VALUES(project_title,task);
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertUser` (IN `project_title` VARCHAR(255), `task` VARCHAR(255))  BEGIN
        INSERT INTO user(project_title,task)VALUES(project_title,task);
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectCompletedTasks` ()  BEGIN
    SELECT * FROM taskManager where status = 1 ORDER BY time DESC;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectTasks` ()  BEGIN
    SELECT * FROM taskManager where status = 0 ORDER BY id DESC;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectUser` ()  BEGIN
    SELECT * FROM taskManager ORDER BY id DESC;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateTask` (IN `user_id` INT(11), `project_title` VARCHAR(255), `task` VARCHAR(555))  BEGIN
        UPDATE taskmanager SET project_title = project_title, task = task
        WHERE id = user_id;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateUser` (IN `user_id` INT(11), `project_title` VARCHAR(255), `task` VARCHAR(255))  BEGIN
        UPDATE user SET project_title = project_title, task= task
        WHERE id = user_id;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `whereTask` (IN `user_id` INT(11))  BEGIN
        SELECT * FROM taskmanager WHERE id = user_id;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `whereUser` (IN `user_id` INT(11))  BEGIN
        SELECT * FROM user WHERE id = user_id;
        END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `name`, `username`, `password`) VALUES
(7, 'Admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `taskmanager`
--

CREATE TABLE `taskmanager` (
  `id` int(11) NOT NULL,
  `project_title` varchar(255) NOT NULL,
  `task` varchar(555) NOT NULL,
  `status` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taskmanager`
--

INSERT INTO `taskmanager` (`id`, `project_title`, `task`, `status`, `time`) VALUES
(16, 'Internal', 'Generate Weekly Reports', 0, '2018-09-14 13:42:25'),
(17, 'Internal', 'Meeting with Client', 0, '2018-09-14 13:48:31'),
(18, 'Estimates', 'Project Name To Estimate', 1, '2018-09-14 13:48:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `taskmanager`
--
ALTER TABLE `taskmanager`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `taskmanager`
--
ALTER TABLE `taskmanager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
