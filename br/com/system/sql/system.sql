-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 22-Jun-2020 às 01:58
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
  `cont_description` varchar(20) COLLATE utf8_bin NOT NULL,
  `cont_phone` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `cont_cell_phone` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `cont_whatsapp` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `cont_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cont_facebook` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cont_instagram` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cont_twitter` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cont_status` tinyint(1) NOT NULL DEFAULT '1',
  `cont_text` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `contact`
--

INSERT INTO `contact` (`cont_pk_id`, `cont_description`, `cont_phone`, `cont_cell_phone`, `cont_whatsapp`, `cont_email`, `cont_facebook`, `cont_instagram`, `cont_twitter`, `cont_status`, `cont_text`) VALUES
(1, 'Dados Pessoais', '(00)0000-0000', '(00)00000-0000', '00000000000', 'email@email.com', 'usurio', '@usuario', NULL, 0, 'Dados do sistema'),
(2, '2', '2', '2', '2', '2', '2', '2', '2', 1, '2'),
(3, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '3'),
(4, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '4'),
(5, '5', '5', '5', NULL, NULL, NULL, NULL, NULL, 1, '5'),
(6, '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '6'),
(7, '7', '7', NULL, NULL, NULL, NULL, NULL, NULL, 1, '7'),
(8, '1', '1', '1', '1', '1@1', '1', '1', NULL, 0, '1'),
(9, '123', '', '123', '', '123@123', '', '', NULL, 1, 'sadsdasd'),
(10, 'Dados Pessoais', '', '(00)00000-0000', '', 'geversonjosedesouza@gmail.com', '', '', NULL, 1, 'teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `content`
--

CREATE TABLE `content` (
  `cont_pk_id` int(11) NOT NULL,
  `cont_component` varchar(100) NOT NULL,
  `cont_title` varchar(255) DEFAULT NULL,
  `cont_subtitle` varchar(255) DEFAULT NULL,
  `cont_text` text,
  `cont_image` varchar(255) DEFAULT NULL,
  `cont_link` varchar(255) DEFAULT NULL,
  `cont_status` tinyint(1) NOT NULL DEFAULT '1',
  `cont_fk_page_pk_id` int(11) NOT NULL,
  `cont_fk_user_pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `content`
--

INSERT INTO `content` (`cont_pk_id`, `cont_component`, `cont_title`, `cont_subtitle`, `cont_text`, `cont_image`, `cont_link`, `cont_status`, `cont_fk_page_pk_id`, `cont_fk_user_pk_id`) VALUES
(1, 'our_contact', 'Formas de Contato', '', '', '', 'https://www.google.com/maps/@-3.9058296,-38.4506571,21z?hl=pt-br', 1, 3, 1),
(3, 'modern_business', 'A empresa...', '', '    Para ser percebida como uma empresa social e ambientalmente responsável e atuante, a Natura parte da premissa de que os impactos ambientais de sua atividade decorrem de uma cadeia de transformações, da qual representa somente uma parte. Por isso, acredita que, para ter eficácia, as ações ambientais precisam: considerar cada cadeia produtiva de maneira integral.', '750x450.png', '', 1, 4, 1),
(4, 'our_team', 'Nome do membro', 'Cargo do membro', 'Breve descrição do cardo do membro ou do próprio membro', '750x450.png', '', 1, 4, 1),
(6, 'our_customers', 'our_customers', '', '', 'foto012.jpeg', '123', 1, 4, 1),
(7, 'our_customers', 'our_customers', NULL, NULL, '500x300.png', NULL, 1, 4, 1),
(8, 'our_team', 'Nome do membro', 'Cargo do membro', 'Breve descrição do cardo do membro ou do próprio membro', '750x450.png', '', 1, 4, 1),
(9, 'our_team', 'Nome do membro', 'Cargo do membro', 'Breve descrição do cardo do membro ou do próprio membro', '750x450.png', '', 1, 4, 1),
(10, 'our_customers', 'our_customers', NULL, NULL, '500x300.png', NULL, 1, 4, 1),
(11, 'our_customers', 'our_customers', NULL, NULL, '500x300.png', NULL, 1, 4, 1),
(12, 'our_customers', 'our_customers', NULL, NULL, '500x300.png', NULL, 1, 4, 1),
(13, 'our_customers', 'our_customers', NULL, NULL, '500x300.png', NULL, 1, 4, 1),
(14, 'teste', '123', '123', '123', 'foto01.jpeg', '123', 1, 1, 1);

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
  `ende_status` tinyint(1) NOT NULL DEFAULT '1',
  `ende_fk_estado_pk_id` int(11) NOT NULL,
  `ende_fk_user_pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`ende_pk_id`, `ende_logradouro`, `ende_numero`, `ende_bairro`, `ende_cep`, `ende_cidade`, `ende_status`, `ende_fk_estado_pk_id`, `ende_fk_user_pk_id`) VALUES
(1, 'Rua Teste', '00', 'Bairro Teste', '00.000-000', 'Municio Teste', 1, 6, 1);

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
(27, 'Tocantins', 'TO', 1, 1, 1),
(28, '123', '', 1, 1, 1),
(29, '12', '12', 1, 1, 1);

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
(2, 'contact', 'Contato da Empresa e Entre em Contato123', 'address-book', 'Contato', 0, 1),
(3, 'service', 'Alguns de Nossos Serviços', 'concierge-bell', 'Serviços', 1, 1),
(4, 'about', 'Sobre nós', 'address-card', 'Sobre', 0, 1);

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
(8, 'nome_fantazia', 'Geverson Souza', 'Como sou chamado\r\n', 1, 1),
(10, 'razao_social', 'Geverson ME', 'Razão social da empresa', 1, 1),
(11, 'titulo_site', 'Site Geverson', 'Nome do site', 1, 1),
(12, 'icone_site', 'cla.png', 'Imagem do Ícone do Site', 1, 1),
(19, 'email', 'paulistensetecnologia@gmail.com', 'Email para envio automático', 1, 1),
(20, 'senha', '@G182534', 'Senha do email para envio automático', 1, 1),
(21, 'endereco', '1', 'Endereço do dono/empresa do sistema', 1, 1),
(22, 'sobre_titulo', 'Geverson', '', 1, 1),
(23, 'contato_titulo', 'Contato', '', 1, 1),
(24, 'contato', '1', '', 1, 1);

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
(1, 'Geverson', 'root@root', '$2y$10$mNM/bzucj9T68.Ft5MdvS.N/Bb62KO0BfhnXj0Tw1RBLWOMfGpPFS', '2020-06-22 03:11:31', 'IMG_20190920_170641_783.jpg', 1, 1),
(5, 'teste', 'teste@tes', '$2y$10$rOaFpYfQZfV3HC8LtVtLJupq5n10CT75CvPuJglL9UL23jvnaarmq', '2020-06-10 02:08:18', 'adaptador_cel_usb.png', 0, 3),
(7, 'teste', 'teste@teste', '$2y$10$x7wD1IDIAP/faqBTP19KouDIqNVYpuCdE0sXUDytb6kdmvHm1MaUW', NULL, '23316710_1972660239673885_6404095959657453030_n.jpg', 0, 3),
(8, 'asdasd', 'teste@tesasdasd', '$2y$10$PMIGFehEepmRqrEymStsNOV3CEjMIpQeAK.W10b9XA5zm5Pbl/EB6', NULL, 'av_parcial_04.png', 0, 3),
(10, 'asd', 'asd@asd', '$2y$10$mUztqpo0pKoYVTXBsmn0A.tX7IwYpmc5Le4uOLVlas3SysMBeJ7IG', NULL, 'av_parcial_01.png', 0, 3),
(35, 'Geverson J de Souza', 'geversonjosedesouza@hotmail.com', '$2y$10$/eCcnUzOev0ghaaYC6voDOrwv9AzpUsv3Af4aMJe8wTbYjTa3A96C', NULL, NULL, 1, 3);

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
  ADD PRIMARY KEY (`cont_pk_id`);

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
  MODIFY `cont_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `cont_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `ende_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `esta_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `page_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `pais_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `parameter`
--
ALTER TABLE `parameter`
  MODIFY `para_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `cont_fk_page_pk_id` FOREIGN KEY (`cont_fk_page_pk_id`) REFERENCES `page` (`page_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cont_fk_user_pk_id` FOREIGN KEY (`cont_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
