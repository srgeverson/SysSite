-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 10-Ago-2020 às 00:25
-- Versão do servidor: 5.7.31-0ubuntu0.18.04.1
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
CREATE DATABASE IF NOT EXISTS `system`;
USE `system`; 

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
(1, 'TI', 0, 'ti.php', 'Gerenciamento completo do sistema para auxiliar nossos clientes.'),
(2, 'Administrador', 1, 'administrador.php', 'ÁREA RESERVADA PARA GERENCIAR OPERAÇÕES E FAZER LANÇAMENTOS DAS FOLHA DE PAGAMENTOS'),
(3, 'Funcionário', 1, 'funcionario.php', 'ÁREA RESERVADA PARA ACOMPANHAMENTO DE SEUS CONTRA CHECHE');

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
  `cont_text` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `cont_fk_user_pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `contact`
--

INSERT INTO `contact` (`cont_pk_id`, `cont_description`, `cont_phone`, `cont_cell_phone`, `cont_whatsapp`, `cont_email`, `cont_facebook`, `cont_instagram`, `cont_twitter`, `cont_status`, `cont_text`, `cont_fk_user_pk_id`) VALUES
(1, 'Dados Pessoais', '(00)0000-0000', '(00)00000-0000', '00000000000', 'email@email.com', 'usurio', '@usuario', NULL, 1, 'Dados do sistema', 0),
(37, '123', '123', '123', '123', '123@123', '123', '123', NULL, 1, '123', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `content`
--

CREATE TABLE `content` (
  `conte_pk_id` int(11) NOT NULL,
  `conte_component` varchar(100) NOT NULL,
  `conte_title` varchar(255) DEFAULT NULL,
  `conte_subtitle` varchar(255) DEFAULT NULL,
  `conte_text` text,
  `conte_image` varchar(255) DEFAULT NULL,
  `conte_link` varchar(255) DEFAULT NULL,
  `conte_status` tinyint(1) NOT NULL DEFAULT '1',
  `conte_fk_page_pk_id` int(11) NOT NULL,
  `conte_fk_user_pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `content`
--

INSERT INTO `content` (`conte_pk_id`, `conte_component`, `conte_title`, `conte_subtitle`, `conte_text`, `conte_image`, `conte_link`, `conte_status`, `conte_fk_page_pk_id`, `conte_fk_user_pk_id`) VALUES
(1, 'destaques_servicos', 'destaques_servicos', '', '', '1200x300.png', '', 1, 3, 1),
(2, 'modern_business', 'A empresa...', '', '    Para ser percebida como uma empresa social e ambientalmente responsável e atuante, a Natura parte da premissa de que os impactos ambientais de sua atividade decorrem de uma cadeia de transformações, da qual representa somente uma parte. Por isso, acredita que, para ter eficácia, as ações ambientais precisam: considerar cada cadeia produtiva de maneira integral.', '750x450.png', '', 1, 4, 1),
(3, 'our_team', 'Nome do membro', 'Cargo do membro', 'Breve descrição do cardo do membro ou do próprio membro', '750x450.png', '', 1, 4, 1),
(4, 'our_customers', 'our_customers', '', '', 'foto012.jpeg', '123', 1, 4, 1),
(5, 'our_customers', 'our_customers', NULL, NULL, '500x300.png', NULL, 1, 4, 1),
(6, 'our_team', 'Nome do membro', 'Cargo do membro', 'Breve descrição do cardo do membro ou do próprio membro', '750x450.png', '', 1, 4, 1),
(7, 'our_team', 'Nome do membro', 'Cargo do membro', 'Breve descrição do cardo do membro ou do próprio membro', '750x450.png', '', 1, 4, 1),
(8, 'our_customers', 'our_customers', NULL, NULL, '500x300.png', NULL, 1, 4, 1),
(9, 'our_customers', 'our_customers', NULL, NULL, '500x300.png', NULL, 1, 4, 1),
(10, 'our_customers', 'our_customers', NULL, NULL, '500x300.png', NULL, 1, 4, 1),
(11, 'our_customers', 'our_customers', NULL, NULL, '500x300.png', NULL, 1, 4, 1),
(12, 'slide_apresentacao', 'Primeiro Destaque', 'Descrição destaque', '', '1900x1080.png', '', 1, 1, 1),
(13, 'slide_apresentacao', 'Segundo Destaque', 'Descrição destaque 2', '', '1900x1080.png', '', 1, 1, 1),
(14, 'slide_apresentacao', 'Terceiro Destaque', 'Descrição destaque 3', '', '1900x1080.png', '', 1, 1, 1),
(15, '', 'Outroes Destaque', '', 'Descrição destaque 3\r\nDescrição destaque 3\r\nDescrição destaque 3\r\nDescrição destaque 3', '', '', 0, 1, 1),
(16, 'nossos_destaques', 'nossos_destaques', '', 'nossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaques', '700x400.png', '', 0, 1, 1),
(17, 'nossos_servicos', 'nossos_servicos', 'nossos_servicos', 'nossos_servicos\r\nnossos_servicos\r\nnossos_servicos\r\nnossos_servicos\r\nnossos_servicos\r\nnossos_servicos', '', '', 1, 3, 1);

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
(1, 'Rua Teste', '00', 'Bairro Teste', '00.000-000', 'Municio Teste', 1, 6, 1),
(30, 'RUA PAULA LOPES', '1234', '123', '22.222-222', 'EUSEBIO', 1, 6, 1);

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
-- Estrutura da tabela `folha_pagamento`
--

CREATE TABLE `folha_pagamento` (
  `fopa_pk_id` int(11) NOT NULL,
  `fopa_competencia` varchar(7) NOT NULL,
  `fopa_nome_arquivo` varchar(255) DEFAULT NULL,
  `fopa_tamanho_arquivo` int(11) DEFAULT NULL,
  `fopa_caminho_arquivo` varchar(255) DEFAULT NULL,
  `fopa_arquivo` longblob,
  `fopa_status` tinyint(1) NOT NULL DEFAULT '1',
  `fopa_fk_funcionario_pk_id` int(11) NOT NULL,
  `fopa_fk_user_pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `func_pk_id` int(11) NOT NULL,
  `func_nome` varchar(50) NOT NULL,
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

INSERT INTO `funcionario` (`func_pk_id`, `func_nome`, `func_cpf`, `func_rg`, `func_pis`, `func_data_nascimento`, `func_status`, `func_fk_user_pk_id`, `func_fk_endereco_pk_id`, `func_fk_contact_pk_id`) VALUES
(19, '123', '606.717.623-89', '123', '123', '1212-03-12', 1, 1, 30, 37);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario_user`
--

CREATE TABLE `funcionario_user` (
  `fuus_pk_id` int(11) NOT NULL,
  `fuus_fk_user_pk_id` int(11) NOT NULL,
  `fuus_fk_funcionario_pk_id` int(11) NOT NULL,
  `fuus_status` tinyint(1) NOT NULL DEFAULT '1',
  `fuus_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Extraindo dados da tabela `funcionario_user`
--

INSERT INTO `funcionario_user` (`fuus_pk_id`, `fuus_fk_user_pk_id`, `fuus_fk_funcionario_pk_id`, `fuus_status`, `fuus_data`) VALUES
(13, 6, 19, 1, '2020-08-09 15:16:10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_user`
--

CREATE TABLE `log_user` (
  `luser_id_tabela` int(11) DEFAULT NULL,
  `luser_fk_usuario_pk_id` int(11) DEFAULT NULL,
  `luser_operacao` varchar(6) COLLATE ascii_bin DEFAULT NULL,
  `luser_campo_modificado` varchar(45) COLLATE ascii_bin DEFAULT NULL,
  `luser_valor_antigo` text COLLATE ascii_bin,
  `luser_valor_atual` text COLLATE ascii_bin,
  `luser_data_operacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Extraindo dados da tabela `log_user`
--

INSERT INTO `log_user` (`luser_id_tabela`, `luser_fk_usuario_pk_id`, `luser_operacao`, `luser_campo_modificado`, `luser_valor_antigo`, `luser_valor_atual`, `luser_data_operacao`) VALUES
(1, NULL, 'UPDATE', 'user_last_access', '2020-08-09 15:49:31', '2020-08-09 23:31:33', '2020-08-09 23:31:33'),
(1, NULL, 'UPDATE', 'user_name', 'Geverson', 'Geverson J de Souza', '2020-08-09 23:32:35'),
(1, NULL, 'UPDATE', 'user_password', '$2y$10$7V6yhg6xSHut0jJ4Qs9CieXgRefbUrofSx3YizQDa5qG/8sOWMV62', '$2y$10$IfvfgkG1LLW2jwJKgDueHe6YwJEt5dtUHyru5f7L3.yKSQKuhotOy', '2020-08-09 23:32:35'),
(6, NULL, 'UPDATE', 'user_password', '$2y$10$DaiWSl4vFIs052rGw1CQo.cqtYBnTwJ88R9PwHtQX8bwL7S.lt8fS', '$2y$10$ppKWSgMr3KBq1fsGa2m/l.7UUu2AQTBiC0wl21M3U/TqoFgsBZRV6', '2020-08-09 23:33:29'),
(0, NULL, 'INSERT', 'user_pk_id', '0', NULL, '2020-08-10 00:15:49'),
(0, NULL, 'INSERT', 'user_name', 'g', NULL, '2020-08-10 00:15:49'),
(0, NULL, 'INSERT', 'user_login', 'root@root1', NULL, '2020-08-10 00:15:49'),
(0, NULL, 'INSERT', 'user_password', '$2y$10$ggNgki2BK1lUFiQpH6En4eSLWPprI69P/0g.IEsuiBtxkSWlE4sdu', NULL, '2020-08-10 00:15:49'),
(0, NULL, 'INSERT', 'user_status', '1', NULL, '2020-08-10 00:15:49'),
(0, NULL, 'INSERT', 'user_fk_authority_pk_id', '2', NULL, '2020-08-10 00:15:49'),
(0, NULL, 'INSERT', 'user_pk_id', '0', NULL, '2020-08-10 00:17:19'),
(0, NULL, 'INSERT', 'user_name', 'teste1', NULL, '2020-08-10 00:17:19'),
(0, NULL, 'INSERT', 'user_login', 'asd@asd', NULL, '2020-08-10 00:17:19'),
(0, NULL, 'INSERT', 'user_password', '$2y$10$V7o4ORE1d2ysUqFWYql6xe3UZ4oGmZ.ZmjoqhaVVK0b5GXW279.EW', NULL, '2020-08-10 00:17:19'),
(0, NULL, 'INSERT', 'user_last_login', NULL, NULL, '2020-08-10 00:17:19'),
(0, NULL, 'INSERT', 'user_image', NULL, NULL, '2020-08-10 00:17:19'),
(0, NULL, 'INSERT', 'user_status', '1', NULL, '2020-08-10 00:17:19'),
(0, NULL, 'INSERT', 'user_fk_authority_pk_id', '2', NULL, '2020-08-10 00:17:19'),
(11, NULL, 'UPDATE', 'user_status', '1', '0', '2020-08-10 00:20:06'),
(11, NULL, 'DELETE', 'user_pk_id', '11', NULL, '2020-08-10 00:20:11'),
(11, NULL, 'DELETE', 'user_name', 'teste1', NULL, '2020-08-10 00:20:11'),
(11, NULL, 'DELETE', 'user_login', 'asd@asd', NULL, '2020-08-10 00:20:11'),
(11, NULL, 'DELETE', 'user_password', '$2y$10$V7o4ORE1d2ysUqFWYql6xe3UZ4oGmZ.ZmjoqhaVVK0b5GXW279.EW', NULL, '2020-08-10 00:20:11'),
(11, NULL, 'DELETE', 'user_last_login', NULL, NULL, '2020-08-10 00:20:11'),
(11, NULL, 'DELETE', 'user_image', NULL, NULL, '2020-08-10 00:20:11'),
(11, NULL, 'DELETE', 'user_status', '0', NULL, '2020-08-10 00:20:11'),
(11, NULL, 'DELETE', 'user_fk_authority_pk_id', '2', NULL, '2020-08-10 00:20:11'),
(10, NULL, 'UPDATE', 'user_status', '1', '0', '2020-08-10 00:20:50'),
(10, NULL, 'DELETE', 'user_pk_id', '10', NULL, '2020-08-10 00:20:54'),
(10, NULL, 'DELETE', 'user_name', 'g', NULL, '2020-08-10 00:20:54'),
(10, NULL, 'DELETE', 'user_login', 'root@root1', NULL, '2020-08-10 00:20:54'),
(10, NULL, 'DELETE', 'user_password', '$2y$10$ggNgki2BK1lUFiQpH6En4eSLWPprI69P/0g.IEsuiBtxkSWlE4sdu', NULL, '2020-08-10 00:20:54'),
(10, NULL, 'DELETE', 'user_last_login', NULL, NULL, '2020-08-10 00:20:54'),
(10, NULL, 'DELETE', 'user_image', NULL, NULL, '2020-08-10 00:20:54'),
(10, NULL, 'DELETE', 'user_status', '0', NULL, '2020-08-10 00:20:54'),
(10, NULL, 'DELETE', 'user_fk_authority_pk_id', '2', NULL, '2020-08-10 00:20:54'),
(0, NULL, 'INSERT', 'user_pk_id', '0', NULL, '2020-08-10 00:21:08'),
(0, NULL, 'INSERT', 'user_name', 'g', NULL, '2020-08-10 00:21:08'),
(0, NULL, 'INSERT', 'user_login', 'root@root1', NULL, '2020-08-10 00:21:08'),
(0, NULL, 'INSERT', 'user_password', '$2y$10$w6zSx4hQjlX2lKVPBk3BxueZZGaEoN3RMiiB35yjiIpaZ8fOZflzG', NULL, '2020-08-10 00:21:08'),
(0, NULL, 'INSERT', 'user_last_login', NULL, NULL, '2020-08-10 00:21:08'),
(0, NULL, 'INSERT', 'user_image', NULL, NULL, '2020-08-10 00:21:08'),
(0, NULL, 'INSERT', 'user_status', '1', NULL, '2020-08-10 00:21:08'),
(0, NULL, 'INSERT', 'user_fk_authority_pk_id', '2', NULL, '2020-08-10 00:21:08'),
(6, NULL, 'UPDATE', 'user_password', '$2y$10$ppKWSgMr3KBq1fsGa2m/l.7UUu2AQTBiC0wl21M3U/TqoFgsBZRV6', '$2y$10$DaiWSl4vFIs052rGw1CQo.cqtYBnTwJ88R9PwHtQX8bwL7S.lt8fS', '2020-08-10 00:25:09');

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
(1, 'home', 'Página Inicial do Site', 'home', 'Página Inicial', 0, 1),
(2, 'contact', 'Contato da Empresa e Entre em Contato123', 'address-book', 'Contato', 0, 1),
(3, 'service', 'Alguns de Nossos Serviços', 'concierge-bell', 'Serviços', 0, 1),
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
(1, 'nome_fantazia', '', 'Nome como que todos conhecem', 1, 1),
(2, 'razao_social', '', 'Nome como está no documento', 1, 1),
(3, 'titulo_site', '', 'Nome para o site', 1, 1),
(4, 'icone_site', '', 'Imagem do Ícone do Site', 1, 1),
(5, 'email', 'paulistensetecnologia@gmail.com', 'Email para envio automático', 1, 1),
(6, 'senha', '@G182534', 'Senha do email para envio automático', 1, 1),
(7, 'endereco', '1', 'Endereço do dono/empresa do sistema', 1, 1),
(8, 'sobre_titulo', 'Geverson', '', 1, 1),
(9, 'contato_titulo', 'Contato', '', 1, 1),
(10, 'contato', '1', 'Chave Estrangeira da tabela contatos', 1, 1),
(11, 'servicos_titulo', 'Serviços', 'Título da página de serviços', 1, 1),
(12, 'google_analytics', 'G-5ZS0PB48KT', 'Códifo do Google Analytics', 1, 1),
(13, 'servidor_email_smtp', 'smtp.gmail.com', 'Protocolo de E-mail', 1, 1),
(14, 'servidor_email_porta', '587', 'Porta do Servidor de E-mail', 1, 1),
(15, 'servidor_email_seguranca', 'tls', 'Tipo da Segurança do Envio de E-mail', 1, 1),
(16, 'mostrar_error', '1', 'Mostrar erros das páginas PHP', 1, 1),
(17, 'servidor_debug_email', '0', 'MOSTRAR ERROR AO ENVIAR EMAIL', 1, 1);

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
(1, 'Geverson J de Souza', 'geversonjosedesouza@gmail.com', '$2y$10$IfvfgkG1LLW2jwJKgDueHe6YwJEt5dtUHyru5f7L3.yKSQKuhotOy', '2020-08-10 02:31:33', '15969434015f2f6c29364fb.jpg', 1, 1),
(4, 'Geverson J de Souza', 'geversonjosedesouza@hotmail.com', '$2y$10$DaiWSl4vFIs052rGw1CQo.cqtYBnTwJ88R9PwHtQX8bwL7S.lt8fS', '2020-08-09 14:37:10', NULL, 1, 3),
(6, 'root', 'root@root', '$2y$10$DaiWSl4vFIs052rGw1CQo.cqtYBnTwJ88R9PwHtQX8bwL7S.lt8fS', '2020-08-10 02:20:49', NULL, 1, 3),
(12, 'g', 'root@root1', '$2y$10$w6zSx4hQjlX2lKVPBk3BxueZZGaEoN3RMiiB35yjiIpaZ8fOZflzG', NULL, NULL, 1, 2);

--
-- Acionadores `user`
--
DELIMITER $$
CREATE TRIGGER `trigger_user_delete` BEFORE DELETE ON `user` FOR EACH ROW BEGIN
	INSERT INTO log_user 
		(luser_id_tabela, luser_operacao, luser_campo_modificado, luser_valor_antigo, luser_data_operacao)
    VALUES
		(OLD.user_pk_id, 'DELETE', 'user_pk_id', OLD.user_pk_id, now()),
        (OLD.user_pk_id, 'DELETE','user_name', OLD.user_name, now()),
        (OLD.user_pk_id, 'DELETE','user_login', OLD.user_login, now()),
        (OLD.user_pk_id, 'DELETE','user_password', OLD.user_password, now()),
        (OLD.user_pk_id, 'DELETE','user_last_login', OLD.user_last_login, now()),
        (OLD.user_pk_id, 'DELETE','user_image', OLD.user_image, now()),
        (OLD.user_pk_id, 'DELETE','user_status', OLD.user_status, now()),
        (OLD.user_pk_id, 'DELETE','user_fk_authority_pk_id', OLD.user_fk_authority_pk_id, now());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_user_insert` BEFORE INSERT ON `user` FOR EACH ROW BEGIN
	INSERT INTO log_user 
		(luser_id_tabela, luser_operacao, luser_campo_modificado, luser_valor_antigo, luser_data_operacao)
    VALUES 
		(NEW.user_pk_id, 'INSERT', 'user_pk_id', NEW.user_pk_id, now()),
        (NEW.user_pk_id, 'INSERT','user_name', NEW.user_name, now()),
        (NEW.user_pk_id, 'INSERT','user_login', NEW.user_login, now()),
        (NEW.user_pk_id, 'INSERT','user_password', NEW.user_password, now()),
        (NEW.user_pk_id, 'INSERT','user_last_login', NEW.user_last_login, now()),
        (NEW.user_pk_id, 'INSERT','user_image', NEW.user_image, now()),
        (NEW.user_pk_id, 'INSERT','user_status', NEW.user_status, now()),
        (NEW.user_pk_id, 'INSERT','user_fk_authority_pk_id', NEW.user_fk_authority_pk_id, now());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_user_update` BEFORE UPDATE ON `user` FOR EACH ROW BEGIN
	IF (OLD.user_name <> NEW.user_name or (OLD.user_name IS NULL and NEW.user_name IS NOT NULL)) THEN
		INSERT INTO log_user
            (luser_campo_modificado, luser_valor_antigo, luser_valor_atual, luser_data_operacao, luser_operacao, luser_id_tabela)
        VALUES 
			('user_name', OLD.user_name, NEW.user_name, now(), 'UPDATE', OLD.user_pk_id);
	 END IF;
    
	IF (OLD.user_login <> NEW.user_login or (OLD.user_login IS NULL and NEW.user_login IS NOT NULL)) THEN
			INSERT INTO log_user
            (luser_campo_modificado, luser_valor_antigo, luser_valor_atual, luser_data_operacao, luser_operacao, luser_id_tabela)
            VALUES 
            ('user_login', OLD.user_login, NEW.user_login, now(), 'UPDATE', OLD.user_pk_id);
	END IF;
    
	IF (OLD.user_password <> NEW.user_password or (OLD.user_password IS NULL and NEW.user_password IS NOT NULL)) THEN
			INSERT INTO log_user 
            (luser_campo_modificado, luser_valor_antigo, luser_valor_atual, luser_data_operacao, luser_operacao, luser_id_tabela)
            VALUES 
            ('user_password', OLD.user_password, NEW.user_password, now(), 'UPDATE', OLD.user_pk_id);
	END IF;
    
	IF (OLD.user_status <> NEW.user_status or (OLD.user_status IS NULL and NEW.user_status IS NOT NULL)) THEN
			INSERT INTO log_user
            (luser_campo_modificado, luser_valor_antigo, luser_valor_atual, luser_data_operacao, luser_operacao, luser_id_tabela)
            VALUES
            ('user_status', OLD.user_status, NEW.user_status, now(), 'UPDATE', OLD.user_pk_id);
	END IF;

	IF (OLD.user_image <> NEW.user_image or (OLD.user_image IS NULL and NEW.user_image IS NOT NULL)) THEN
			INSERT INTO log_user 
                        (luser_campo_modificado, luser_valor_antigo, luser_valor_atual, luser_data_operacao, luser_operacao, luser_id_tabela)
            VALUES
            ('user_image', OLD.user_image, NEW.user_image, now(), 'UPDATE', OLD.user_pk_id);
	END IF;

	IF (OLD.user_last_login <> NEW.user_last_login or (OLD.user_last_login IS NULL and NEW.user_last_login IS NOT NULL)) THEN
			INSERT INTO log_user 
            (luser_campo_modificado, luser_valor_antigo, luser_valor_atual, luser_data_operacao, luser_operacao, luser_id_tabela)
            VALUES 
            ('user_last_access', OLD.user_last_login, NEW.user_last_login, now(), 'UPDATE', OLD.user_pk_id);
	END IF;
    
	IF (OLD.user_fk_authority_pk_id <> NEW.user_fk_authority_pk_id or (OLD.user_fk_authority_pk_id IS NULL and NEW.user_fk_authority_pk_id IS NOT NULL)) THEN
			INSERT INTO log_user 
            (luser_campo_modificado, luser_valor_antigo, luser_valor_atual, luser_data_operacao, luser_operacao, luser_id_tabela)
            VALUES
            ('user_fk_authority_pk_id', OLD.user_fk_authority_pk_id, NEW.user_fk_authority_pk_id, now(), 'UPDATE', OLD.user_pk_id);
	END IF;
END
$$
DELIMITER ;

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
  ADD PRIMARY KEY (`conte_pk_id`),
  ADD KEY `conte_fk_page_pk_id_idx` (`conte_fk_page_pk_id`),
  ADD KEY `conte_fk_user_pk_id_idx` (`conte_fk_user_pk_id`);

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
-- Indexes for table `folha_pagamento`
--
ALTER TABLE `folha_pagamento`
  ADD PRIMARY KEY (`fopa_pk_id`),
  ADD KEY `fopa_fk_funcionario_pk_id_idx` (`fopa_fk_funcionario_pk_id`),
  ADD KEY `func_fk_user_pk_id_idx` (`fopa_fk_user_pk_id`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`func_pk_id`),
  ADD KEY `func_fk_user_pk_id_idx` (`func_fk_user_pk_id`),
  ADD KEY `func_fk_endereco_pk_id_idx` (`func_fk_endereco_pk_id`),
  ADD KEY `func_fk_contact_pk_id_idx` (`func_fk_contact_pk_id`);

--
-- Indexes for table `funcionario_user`
--
ALTER TABLE `funcionario_user`
  ADD PRIMARY KEY (`fuus_pk_id`,`fuus_fk_user_pk_id`,`fuus_fk_funcionario_pk_id`),
  ADD UNIQUE KEY `fuus_fk_user_pk_id_UNIQUE` (`fuus_fk_user_pk_id`),
  ADD UNIQUE KEY `fuus_fk_funcionario_pk_id_UNIQUE` (`fuus_fk_funcionario_pk_id`),
  ADD UNIQUE KEY `fuus_pk_id_UNIQUE` (`fuus_pk_id`);

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
  MODIFY `auth_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `cont_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `conte_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `ende_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `esta_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `folha_pagamento`
--
ALTER TABLE `folha_pagamento`
  MODIFY `fopa_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;
--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `func_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `funcionario_user`
--
ALTER TABLE `funcionario_user`
  MODIFY `fuus_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `page_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `pais_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `parameter`
--
ALTER TABLE `parameter`
  MODIFY `para_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `conte_fk_page_pk_id` FOREIGN KEY (`conte_fk_page_pk_id`) REFERENCES `page` (`page_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `conte_fk_user_pk_id` FOREIGN KEY (`conte_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Limitadores para a tabela `folha_pagamento`
--
ALTER TABLE `folha_pagamento`
  ADD CONSTRAINT `fopa_fk_funcionario_pk_id` FOREIGN KEY (`fopa_fk_funcionario_pk_id`) REFERENCES `funcionario` (`func_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fopa_fk_user_pk_id` FOREIGN KEY (`fopa_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `func_fk_contact_pk_id` FOREIGN KEY (`func_fk_contact_pk_id`) REFERENCES `contact` (`cont_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `func_fk_endereco_pk_id` FOREIGN KEY (`func_fk_endereco_pk_id`) REFERENCES `endereco` (`ende_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `func_fk_user_pk_id` FOREIGN KEY (`func_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `funcionario_user`
--
ALTER TABLE `funcionario_user`
  ADD CONSTRAINT `fuus_fk_funcionario_pk_id` FOREIGN KEY (`fuus_fk_funcionario_pk_id`) REFERENCES `funcionario` (`func_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fuus_fk_user_pk_id` FOREIGN KEY (`fuus_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
