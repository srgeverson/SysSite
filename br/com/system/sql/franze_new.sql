-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 07-Jun-2020 às 16:00
-- Versão do servidor: 5.7.30-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `franze`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `authority`
--

CREATE TABLE `authority` (
  `auth_pk_id` int(11) NOT NULL,
  `auth_fk_user_pk_id` int(11) NOT NULL,
  `auth_fk_screen_pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `authority`
--

INSERT INTO `authority` (`auth_pk_id`, `auth_fk_user_pk_id`, `auth_fk_screen_pk_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `cont_pk_id` int(11) NOT NULL,
  `cont_descricao` varchar(20) COLLATE utf8_bin NOT NULL,
  `cont_telefone` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `cont_celular` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `cont_whatsapp` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `cont_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cont_facebook` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cont_instagran` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cont_twitter` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cont_status` tinyint(4) NOT NULL DEFAULT '1',
  `cont_fk_user_pk_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `contato`
--

INSERT INTO `contato` (`cont_pk_id`, `cont_descricao`, `cont_telefone`, `cont_celular`, `cont_whatsapp`, `cont_email`, `cont_facebook`, `cont_instagran`, `cont_twitter`, `cont_status`, `cont_fk_user_pk_id`) VALUES
(1, 'particular', '(85) 3485-3571', '(85) 99695-8892', '(85) 98771-3985', 'geversonjosedesouza@gmail.com', 'sr_geverson', '@sr_geverson', '@sr_geverson', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `empr_pk_id` int(11) NOT NULL,
  `empr_nome` varchar(100) COLLATE utf8_bin NOT NULL,
  `empr_cnpj` varchar(18) COLLATE utf8_bin NOT NULL,
  `empr_razao_social` varchar(100) COLLATE utf8_bin NOT NULL,
  `empr_status` tinyint(1) NOT NULL DEFAULT '1',
  `empr_fk_user_pk_id` int(11) NOT NULL,
  `empr_fk_contato_pk_id` int(11) NOT NULL,
  `empr_fk_endereco_pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`empr_pk_id`, `empr_nome`, `empr_cnpj`, `empr_razao_social`, `empr_status`, `empr_fk_user_pk_id`, `empr_fk_contato_pk_id`, `empr_fk_endereco_pk_id`) VALUES
(1, 'Geverson', '00.000.000/0000-00', 'Geverson TI', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `ende_pk_id` int(11) NOT NULL,
  `ende_logradouro` varchar(100) COLLATE utf8_bin NOT NULL,
  `ende_numero` varchar(10) COLLATE utf8_bin NOT NULL,
  `ende_bairro` varchar(50) COLLATE utf8_bin NOT NULL,
  `ende_cep` varchar(10) COLLATE utf8_bin NOT NULL,
  `ende_cidade` varchar(50) COLLATE utf8_bin NOT NULL,
  `ende_fk_estado_pk_id` int(11) NOT NULL,
  `ende_status` tinyint(4) NOT NULL DEFAULT '1',
  `ende_fk_user_pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`ende_pk_id`, `ende_logradouro`, `ende_numero`, `ende_bairro`, `ende_cep`, `ende_cidade`, `ende_fk_estado_pk_id`, `ende_status`, `ende_fk_user_pk_id`) VALUES
(1, 'Rua Paula Lopes', '05', 'Parque Havai', '61.760-000', 'Eusébio', 6, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `esta_pk_id` int(11) NOT NULL,
  `esta_nome` varchar(50) COLLATE utf8_bin NOT NULL,
  `esta_sigla` varchar(2) COLLATE utf8_bin NOT NULL,
  `esta_status` tinyint(1) NOT NULL DEFAULT '1',
  `esta_fk_pais_pk_id` int(11) NOT NULL,
  `esta_fk_user_pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `estado`
--

INSERT INTO `estado` (`esta_pk_id`, `esta_nome`, `esta_sigla`, `esta_status`, `esta_fk_pais_pk_id`, `esta_fk_user_pk_id`) VALUES
(1, 'Acre', 'AC', 1, 1, 1),
(2, 'Alagoas', 'AL', 1, 1, 1),
(3, 'Amapá', 'AP', 1, 1, 1),
(4, 'Amazonas', 'AM', 1, 1, 1),
(5, 'Bahia', 'BA', 1, 1, 1),
(6, 'Ceará', 'CE', 1, 1, 1),
(7, 'Distrito Federal', 'DF', 1, 1, 1),
(8, 'Espírito Santo', 'ES', 1, 1, 1),
(9, 'Goiás', 'GO', 1, 1, 1),
(10, 'Maranhão', 'MA', 1, 1, 1),
(11, 'Mato Grosso', 'MT', 1, 1, 1),
(12, 'Mato Grosso do Sul', 'MS', 1, 1, 1),
(13, 'Minas Gerais', 'MG', 1, 1, 1),
(14, 'Pará', 'PA', 1, 1, 1),
(15, 'Paraíba', 'PB', 1, 1, 1),
(16, 'Paraná', 'PR', 1, 1, 1),
(17, 'Pernambuco', 'PE', 1, 1, 1),
(18, 'Piauí', 'PI', 1, 1, 1),
(19, 'Rio de Janeiro', 'RJ', 1, 1, 1),
(20, 'Rio Grande do Norte', 'RN', 1, 1, 1),
(21, 'Rio Grande do Sul', 'RS', 1, 1, 1),
(22, 'Rondônia', 'RO', 1, 1, 1),
(23, 'Roraima', 'RR', 1, 1, 1),
(24, 'Santa Catarina', 'SC', 1, 1, 1),
(25, 'São Paulo', 'SP', 1, 1, 1),
(26, 'Sergipe', 'SE', 1, 1, 1),
(27, 'Tocantins', 'TO', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

CREATE TABLE `pais` (
  `pais_pk_id` int(11) NOT NULL,
  `pais_nome` varchar(50) COLLATE utf8_bin NOT NULL,
  `pais_sigla` varchar(3) COLLATE utf8_bin NOT NULL,
  `pais_status` tinyint(4) NOT NULL DEFAULT '1',
  `pais_fk_user_pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `pais`
--

INSERT INTO `pais` (`pais_pk_id`, `pais_nome`, `pais_sigla`, `pais_status`, `pais_fk_user_pk_id`) VALUES
(1, 'brasil', 'BRA', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `screen`
--

CREATE TABLE `screen` (
  `scre_pk_id` int(11) NOT NULL,
  `scre_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `scre_description` varchar(255) COLLATE utf8_bin NOT NULL,
  `scre_create` tinyint(1) NOT NULL DEFAULT '0',
  `scre_read` tinyint(1) NOT NULL DEFAULT '0',
  `scre_update` tinyint(1) NOT NULL DEFAULT '0',
  `scre_delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `screen`
--

INSERT INTO `screen` (`scre_pk_id`, `scre_name`, `scre_description`, `scre_create`, `scre_read`, `scre_update`, `scre_delete`) VALUES
(1, 'Usuário', 'CRUD da tabela user(Usuários)', 1, 1, 1, 1),
(2, 'Permissão', 'CRUD da tabela authority(Permissões)', 1, 1, 0, 0),
(3, 'Contato', 'CRUD da tabela contato(Contatos)', 0, 0, 0, 0),
(4, 'Empresa', 'CRUD da tabela empresa(Empresa)', 0, 1, 1, 0),
(5, 'Endereco', 'CRUD da tabela endereço(Endereços)', 0, 0, 0, 0),
(6, 'País', 'CRUD da tabela pais(Países)', 0, 0, 0, 0),
(7, 'Estado', 'CRUD da tabela estado(Estados)', 0, 0, 0, 0),
(8, 'Tela', 'CRUD da tabela screen(Telas)', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `user_pk_id` int(11) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `user_login` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `user_password` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `user_last_login` timestamp NULL DEFAULT NULL,
  `user_image` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `user_status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`user_pk_id`, `user_name`, `user_login`, `user_password`, `user_last_login`, `user_image`, `user_status`) VALUES
(1, 'geverson', 'root@root', '$2y$10$Qz7YbuliWVrwnqrYTa6Kh.52zeWeR3ZCc8wx7H4oA18jIhcdpeA3O', '2020-06-07 18:54:01', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authority`
--
ALTER TABLE `authority`
  ADD PRIMARY KEY (`auth_pk_id`),
  ADD KEY `auth_fk_user_pk_id_idx` (`auth_fk_user_pk_id`),
  ADD KEY `auth_fk_screen_pk_id_idx` (`auth_fk_screen_pk_id`);

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`cont_pk_id`),
  ADD KEY `cont_fk_user_pk_id_idx` (`cont_fk_user_pk_id`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`empr_pk_id`),
  ADD KEY `empr_fk_user_pk_id_idx` (`empr_fk_user_pk_id`),
  ADD KEY `empr_fk_contato_pk_id_idx` (`empr_fk_contato_pk_id`),
  ADD KEY `empr_fk_endereco_pk_id_idx` (`empr_fk_endereco_pk_id`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`ende_pk_id`),
  ADD KEY `ende_fk_user_pk_id_idx` (`ende_fk_user_pk_id`),
  ADD KEY `ende_fk_estado_pk_id_idx` (`ende_fk_estado_pk_id`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`esta_pk_id`),
  ADD KEY `esta_fk_user_pk_id_idx` (`esta_fk_user_pk_id`),
  ADD KEY `esta_fk_pais_pk_id_idx` (`esta_fk_pais_pk_id`);

--
-- Indexes for table `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`pais_pk_id`),
  ADD KEY `pais_fk_user_pk_id_idx` (`pais_fk_user_pk_id`);

--
-- Indexes for table `screen`
--
ALTER TABLE `screen`
  ADD PRIMARY KEY (`scre_pk_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_pk_id`),
  ADD UNIQUE KEY `user_login_UNIQUE` (`user_login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authority`
--
ALTER TABLE `authority`
  MODIFY `auth_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
  MODIFY `cont_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `empr_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `ende_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `esta_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `pais_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `screen`
--
ALTER TABLE `screen`
  MODIFY `scre_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `authority`
--
ALTER TABLE `authority`
  ADD CONSTRAINT `auth_fk_screen_pk_id` FOREIGN KEY (`auth_fk_screen_pk_id`) REFERENCES `screen` (`scre_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `auth_fk_user_pk_id` FOREIGN KEY (`auth_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `contato`
--
ALTER TABLE `contato`
  ADD CONSTRAINT `cont_fk_user_pk_id` FOREIGN KEY (`cont_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `empr_fk_contato_pk_id` FOREIGN KEY (`empr_fk_contato_pk_id`) REFERENCES `contato` (`cont_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `empr_fk_endereco_pk_id` FOREIGN KEY (`empr_fk_endereco_pk_id`) REFERENCES `endereco` (`ende_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `empr_fk_user_pk_id` FOREIGN KEY (`empr_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `ende_fk_estado_pk_id` FOREIGN KEY (`ende_fk_estado_pk_id`) REFERENCES `estado` (`esta_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ende_fk_user_pk_id` FOREIGN KEY (`ende_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `esta_fk_pais_pk_id` FOREIGN KEY (`esta_fk_pais_pk_id`) REFERENCES `pais` (`pais_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `esta_fk_user_pk_id` FOREIGN KEY (`esta_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pais`
--
ALTER TABLE `pais`
  ADD CONSTRAINT `pais_fk_user_pk_id` FOREIGN KEY (`pais_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
