
CREATE DATABASE onlineshopdb
USE onlineshopdb
-- Table structure for table `users
CREATE TABLE `users` (
  `userid` mediumint(6) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` char(60) NOT NULL,
  `registration_date` datetime NOT NULL,
  `user_level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Indexes for table `users`
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);
-- AUTO_INCREMENT for table `users`
ALTER TABLE `users`
  MODIFY `userid` mediumint(6) UNSIGNED NOT NULL
  AUTO_INCREMENT, AUTO_INCREMENT=100;

INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`, `registration_date`) VALUES ('ABC','XYZ','abc@gmail.com', 'abc123456',NOW())