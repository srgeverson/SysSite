-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 18-Jun-2020 às 07:18
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
-- Estrutura da tabela `authority`
--

CREATE TABLE `authority` (
  `auth_pk_id` int(11) NOT NULL,
  `auth_description` varchar(50) COLLATE utf8_bin NOT NULL,
  `auth_status` tinyint(1) NOT NULL,
  `auth_screen` varchar(100) COLLATE utf8_bin NOT NULL,
  `auth_function` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `authority`
--

INSERT INTO `authority` (`auth_pk_id`, `auth_description`, `auth_status`, `auth_screen`, `auth_function`) VALUES
(1, 'TI', 1, 'ti.php', 'Gerenciamento completo do sistema para auxiliar nossos clientes.'),
(2, 'Administrador', 1, 'administrador.php', 'Aqui você vai poder gerenciar suas Vendas, Clientes, Produtos...'),
(3, 'Funcionário', 1, 'funcionario.php', 'Essa área foi desenvolvida e reservada para você acompanhar seus pedidos, seus pagamentos e produtos disponíveis...'),
(4, 'teste', 0, 'teste.php', 'teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contact`
--

CREATE TABLE `contact` (
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
  `cont_fk_user_pk_id` int(11) DEFAULT NULL,
  `cont_texto` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `contact`
--

INSERT INTO `contact` (`cont_pk_id`, `cont_descricao`, `cont_telefone`, `cont_celular`, `cont_whatsapp`, `cont_email`, `cont_facebook`, `cont_instagran`, `cont_twitter`, `cont_status`, `cont_fk_user_pk_id`, `cont_texto`) VALUES
(1, 'particular', '(85) 3485-3571', '(85) 99695-8892', '(85) 98771-3985', 'geversonjosedesouza@gmail.com', 'sr_geverson', '@sr_geverson', '@sr_geverson', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `content`
--

CREATE TABLE `content` (
  `cont_pk_id` int(11) NOT NULL,
  `cont_status` tinyint(1) NOT NULL DEFAULT '1',
  `cont_fk_page_pk_id` int(11) NOT NULL,
  `cont_fk_user_pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Estrutura da tabela `page`
--

CREATE TABLE `page` (
  `page_pk_id` int(11) NOT NULL,
  `page_name` varchar(50) NOT NULL,
  `page_description` varchar(255) NOT NULL,
  `page_icon` varchar(45) NOT NULL,
  `page_label` varchar(45) NOT NULL,
  `page_status` tinyint(1) NOT NULL DEFAULT '1',
  `page_fk_user_pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `page`
--

INSERT INTO `page` (`page_pk_id`, `page_name`, `page_description`, `page_icon`, `page_label`, `page_status`, `page_fk_user_pk_id`) VALUES
(1, 'home', 'Página Inicial do Site', 'home', 'Página Inicial', 1, 1),
(2, 'contact', 'Contato da Empresa e Entre em Contato123', 'address-book', 'Contato', 1, 1),
(4, 'service', 'Alguns de Nossos Serviços', 'concierge-bell', 'Serviços', 1, 1),
(5, 'About', 'Sobre nós', 'address-card', 'Sobre', 1, 1);

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
(1, 'Brasil', 'BRA', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `parameter`
--

CREATE TABLE `parameter` (
  `para_pk_id` int(11) NOT NULL,
  `para_key` varchar(255) COLLATE utf8_bin NOT NULL,
  `para_value` varchar(255) COLLATE utf8_bin NOT NULL,
  `para_description` varchar(255) COLLATE utf8_bin NOT NULL,
  `para_status` tinyint(1) NOT NULL DEFAULT '1',
  `para_fk_user_pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `parameter`
--

INSERT INTO `parameter` (`para_pk_id`, `para_key`, `para_value`, `para_description`, `para_status`, `para_fk_user_pk_id`) VALUES
(8, 'nome_apelido', 'Geverson Souza', 'Como sou chamado\r\n', 0, 1),
(10, 'razao_social', 'Geverson ME', 'Razão social da empresa', 1, 1),
(11, 'titulo_site', 'Site Geverson', 'Nome do site', 1, 1),
(12, 'icone_site', 'cla.png', 'Imagem do Ícone do Site', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `user_pk_id` int(11) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `user_login` varchar(100) COLLATE utf8_bin NOT NULL,
  `user_password` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `user_last_login` timestamp NULL DEFAULT NULL,
  `user_image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT '0',
  `user_fk_authority_pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`user_pk_id`, `user_name`, `user_login`, `user_password`, `user_last_login`, `user_image`, `user_status`, `user_fk_authority_pk_id`) VALUES
(1, 'Geverson', 'root@root', '$2y$10$mNM/bzucj9T68.Ft5MdvS.N/Bb62KO0BfhnXj0Tw1RBLWOMfGpPFS', '2020-06-18 00:04:58', 'IMG_20190920_170641_783.jpg', 1, 1),
(5, 'teste', 'teste@tes', '$2y$10$rOaFpYfQZfV3HC8LtVtLJupq5n10CT75CvPuJglL9UL23jvnaarmq', '2020-06-10 02:08:18', 'adaptador_cel_usb.png', 0, 3),
(7, 'teste', 'teste@teste', '$2y$10$x7wD1IDIAP/faqBTP19KouDIqNVYpuCdE0sXUDytb6kdmvHm1MaUW', NULL, '23316710_1972660239673885_6404095959657453030_n.jpg', 0, 3),
(8, 'asdasd', 'teste@tesasdasd', '$2y$10$PMIGFehEepmRqrEymStsNOV3CEjMIpQeAK.W10b9XA5zm5Pbl/EB6', NULL, 'av_parcial_04.png', 0, 3),
(10, 'asd', 'asd@asd', '$2y$10$mUztqpo0pKoYVTXBsmn0A.tX7IwYpmc5Le4uOLVlas3SysMBeJ7IG', NULL, 'av_parcial_01.png', 0, 3),
(14, 'Geverson J de Souza', 'geversonjosedesouza@gmail.com', '$2y$10$2K0Wz6IHfhDeleRzLjdeO.Y7JDavH1drv56gjuHEOURixA3qEMzj2', NULL, NULL, 0, 3),
(24, '12', '12@12', '$2y$10$8B/EfzLy3V4KS8QRt6o8QekPwyg5kkqqItMY1x.ljVxmnrLz9yeji', NULL, NULL, 0, 1),
(26, 'as@', 'asd1@as', '$2y$10$5fSGlOCn57nz1KDzGNeK1OB2.iasj4dw1Rr97MNP03sT/pp39c9uO', NULL, NULL, 0, 3),
(27, 'asdasd', 'asdasd@asdasd', '$2y$10$FexxFbu/qau8wU0zExQEMOBhPFCU4d5rqo48RCj1P/hKeAo.YiSYC', NULL, NULL, 0, 1),
(28, '111111111', '1111111111@123', '$2y$10$zZreUMcLGoePIun1w5AaReCEFWgoWHfsEMliKhCYA/TLc7V96ZXmm', NULL, NULL, 0, 2),
(30, 'Geverson J de Souza', 'geversonjosedesouza@hotmail.com', '$2y$10$ZbICJgygB/42HF6Q.LvaB.af8D66pDVKwmKTwCQ9eKX1t2uScQ4Gq', NULL, NULL, 0, 3),
(31, '1', '', '$2y$10$2AKiJ.ZUGPDvzSjTeahX4.tpXFWW1r1SP.6NVMdhYPTe0TgxRzzia', NULL, NULL, 0, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authority`
--
ALTER TABLE `authority`
  ADD PRIMARY KEY (`auth_pk_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`cont_pk_id`),
  ADD KEY `cont_fk_user_pk_id_idx` (`cont_fk_user_pk_id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`cont_pk_id`),
  ADD KEY `cont_fk_page_pk_id_idx` (`cont_fk_page_pk_id`),
  ADD KEY `cont_fk_user_pk_id_idx` (`cont_fk_user_pk_id`);

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
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`page_pk_id`),
  ADD KEY `page_fk_user_pk_id_idx` (`page_fk_user_pk_id`);

--
-- Indexes for table `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`pais_pk_id`),
  ADD KEY `pais_fk_user_pk_id_idx` (`pais_fk_user_pk_id`);

--
-- Indexes for table `parameter`
--
ALTER TABLE `parameter`
  ADD PRIMARY KEY (`para_pk_id`),
  ADD UNIQUE KEY `para_key` (`para_key`),
  ADD KEY `empr_fk_user_pk_id_idx` (`para_fk_user_pk_id`);

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
  MODIFY `auth_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `cont_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `cont_pk_id` int(11) NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `page_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `pais_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `parameter`
--
ALTER TABLE `parameter`
  MODIFY `para_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `cont_fk_user_pk_id` FOREIGN KEY (`cont_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `cont_fk_page_pk_id` FOREIGN KEY (`cont_fk_page_pk_id`) REFERENCES `page` (`page_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Limitadores para a tabela `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `page_fk_user_pk_id` FOREIGN KEY (`page_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pais`
--
ALTER TABLE `pais`
  ADD CONSTRAINT `pais_fk_user_pk_id` FOREIGN KEY (`pais_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `parameter`
--
ALTER TABLE `parameter`
  ADD CONSTRAINT `empr_fk_user_pk_id` FOREIGN KEY (`para_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_fk_authority_pk_id` FOREIGN KEY (`user_fk_authority_pk_id`) REFERENCES `authority` (`auth_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
