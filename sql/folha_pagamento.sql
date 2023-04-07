-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 16-Jul-2020 às 22:32
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
-- Estrutura da tabela `folha_pagamento`
--

CREATE TABLE `folha_pagamento` (
  `fopa_pk_id` int(11) NOT NULL,
  `fopa_competencia` varchar(7) NOT NULL,
  `fopa_status` tinyint(1) DEFAULT '1',
  `fopa_fk_funcionario_pk_id` int(11) NOT NULL,
  `fopa_fk_user_pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `folha_pagamento`
--
ALTER TABLE `folha_pagamento`
  ADD PRIMARY KEY (`fopa_pk_id`),
  ADD KEY `fopa_fk_funcionario_pk_id_idx` (`fopa_fk_funcionario_pk_id`),
  ADD KEY `fopa_fk_user_pk_id_idx` (`fopa_fk_user_pk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `folha_pagamento`
--
ALTER TABLE `folha_pagamento`
  MODIFY `fopa_pk_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `folha_pagamento`
--
ALTER TABLE `folha_pagamento`
  ADD CONSTRAINT `fopa_fk_funcionario_pk_id` FOREIGN KEY (`fopa_fk_funcionario_pk_id`) REFERENCES `funcionario` (`func_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fopa_fk_user_pk_id` FOREIGN KEY (`fopa_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
