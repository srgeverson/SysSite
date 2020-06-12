-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 07-Jun-2020 às 00:25
-- Versão do servidor: 5.7.30-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `template`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `authority`
--

CREATE TABLE `authority` (
  `auth_pk_id` int(11) NOT NULL,
  `auth_description` varchar(50) COLLATE utf8_bin NOT NULL,
  `auth_data` varchar(45) COLLATE utf8_bin NOT NULL,
  `auth_screen` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `auth_function` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `authority`
--

INSERT INTO `authority` (`auth_pk_id`, `auth_description`, `auth_data`, `auth_screen`, `auth_function`) VALUES
(1, 'TI', '2020-05-24', NULL, 'Gerenciamento do sistema...');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `user_pk_id` int(11) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `user_login` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `user_password` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `user_last_login` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `user_fk_authority_pk_id` int(11) NOT NULL,
  `user_image` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `user_status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`user_pk_id`, `user_name`, `user_login`, `user_password`, `user_last_login`, `user_fk_authority_pk_id`, `user_image`, `user_status`) VALUES
(1, 'geverson', 'root@root', '$2y$10$Qz7YbuliWVrwnqrYTa6Kh.52zeWeR3ZCc8wx7H4oA18jIhcdpeA3O', NULL, 1, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authority`
--
ALTER TABLE `authority`
  ADD PRIMARY KEY (`auth_pk_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_pk_id`),
  ADD UNIQUE KEY `user_login_UNIQUE` (`user_login`),
  ADD KEY `user_fk_authority_pk_id_idx` (`user_fk_authority_pk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authority`
--
ALTER TABLE `authority`
  MODIFY `auth_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_fk_authority_pk_id` FOREIGN KEY (`user_fk_authority_pk_id`) REFERENCES `authority` (`auth_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
