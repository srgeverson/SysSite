-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 16-Jul-2020 às 22:31
-- Versão do servidor: 5.7.30-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `func_pk_id` int(11) NOT NULL,
  `func_nome` varchar(50) DEFAULT NULL,
  `func_cpf` varchar(14) NOT NULL,
  `func_rg` varchar(20) NOT NULL,
  `func_pis` varchar(20) NOT NULL,
  `func_data_nascimento` date DEFAULT NULL,
  `func_status` tinyint(1) DEFAULT '1',
  `func_fk_user_pk_id` int(11) NOT NULL,
  `func_fk_endereco_pk_id` int(11) NOT NULL,
  `func_fk_contact_pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`func_pk_id`, `func_nome`, `func_cpf`, `func_rg`, `func_pis`, `func_data_nascimento`, `func_status`, `func_fk_user_pk_id`, `func_fk_user_login`, `func_fk_endereco_pk_id`, `func_fk_contact_pk_id`) VALUES
(2, 'geverson', 'aaa', '2077176686', 'aaa', '1993-04-12', 1, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`func_pk_id`),
  ADD UNIQUE KEY `func_fk_contact_pk_id_UNIQUE` (`func_fk_contact_pk_id`),
  ADD KEY `func_fk_endereco_pk_id_idx` (`func_fk_endereco_pk_id`),
  ADD KEY `func_fk_user_pk_id_idx` (`func_fk_user_pk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `func_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `func_fk_contact_pk_id` FOREIGN KEY (`func_fk_contact_pk_id`) REFERENCES `contact` (`cont_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `func_fk_endereco_pk_id` FOREIGN KEY (`func_fk_endereco_pk_id`) REFERENCES `endereco` (`ende_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
