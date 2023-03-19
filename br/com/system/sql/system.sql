-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: system
-- ------------------------------------------------------
-- Server version	8.0.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `authority`
--

DROP TABLE IF EXISTS `authority`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `authority` (
  `auth_pk_id` int NOT NULL AUTO_INCREMENT,
  `auth_description` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `auth_status` tinyint(1) NOT NULL,
  `auth_screen` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `auth_function` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`auth_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authority`
--

LOCK TABLES `authority` WRITE;
/*!40000 ALTER TABLE `authority` DISABLE KEYS */;
INSERT INTO `authority` VALUES (1,'TI',1,'ti.php','Gerenciamento completo do sistema para auxiliar nossos clientes.'),(2,'Administrador',1,'administrador.php','Aqui você vai poder gerenciar suas Vendas, Clientes, Produtos...'),(3,'Funcionário',1,'funcionario.php','Essa área foi desenvolvida e reservada para você acompanhar seus pedidos, seus pagamentos e produtos disponíveis...');
/*!40000 ALTER TABLE `authority` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact` (
  `cont_pk_id` int NOT NULL AUTO_INCREMENT,
  `cont_description` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cont_phone` varchar(14) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cont_cell_phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cont_whatsapp` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cont_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cont_facebook` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cont_instagram` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cont_twitter` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cont_status` tinyint(1) NOT NULL DEFAULT '1',
  `cont_text` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cont_fk_user_pk_id` int NOT NULL,
  PRIMARY KEY (`cont_pk_id`),
  KEY `cont_fk_user_pk_id_idx` (`cont_fk_user_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,'Dados Pessoais','(00)0000-0000','(00)00000-0000','00000000000','email@email.com','usurio','@usuario',NULL,1,'Dados do sistema',0),(19,'PESSOAL','(85)8771-3985','(85)98771-3985','(85)98771-3985','geversonjosedesouza@gmail.com','@GEVERSON','@SR_GEVERSON',NULL,1,'EU1',1);
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `content` (
  `conte_pk_id` int NOT NULL AUTO_INCREMENT,
  `conte_component` varchar(100) NOT NULL,
  `conte_title` varchar(255) DEFAULT NULL,
  `conte_subtitle` varchar(255) DEFAULT NULL,
  `conte_text` text,
  `conte_image` varchar(255) DEFAULT NULL,
  `conte_link` varchar(255) DEFAULT NULL,
  `conte_status` tinyint(1) NOT NULL DEFAULT '1',
  `conte_fk_page_pk_id` int NOT NULL,
  `conte_fk_user_pk_id` int NOT NULL,
  PRIMARY KEY (`conte_pk_id`),
  KEY `conte_fk_page_pk_id_idx` (`conte_fk_page_pk_id`),
  KEY `conte_fk_user_pk_id_idx` (`conte_fk_user_pk_id`),
  CONSTRAINT `conte_fk_page_pk_id` FOREIGN KEY (`conte_fk_page_pk_id`) REFERENCES `page` (`page_pk_id`),
  CONSTRAINT `conte_fk_user_pk_id` FOREIGN KEY (`conte_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (1,'destaques_servicos','destaques_servicos','','','1200x300.png','',1,3,1),(2,'modern_business','A empresa...','','    Para ser percebida como uma empresa social e ambientalmente responsável e atuante, a Natura parte da premissa de que os impactos ambientais de sua atividade decorrem de uma cadeia de transformações, da qual representa somente uma parte. Por isso, acredita que, para ter eficácia, as ações ambientais precisam: considerar cada cadeia produtiva de maneira integral.','750x450.png','',1,4,1),(3,'our_team','Nome do membro','Cargo do membro','Breve descrição do cardo do membro ou do próprio membro','750x450.png','',1,4,1),(4,'our_customers','our_customers','','','foto012.jpeg','123',1,4,1),(5,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,1,4,1),(6,'our_team','Nome do membro','Cargo do membro','Breve descrição do cardo do membro ou do próprio membro','750x450.png','',1,4,1),(7,'our_team','Nome do membro','Cargo do membro','Breve descrição do cardo do membro ou do próprio membro','750x450.png','',1,4,1),(8,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,1,4,1),(9,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,1,4,1),(10,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,1,4,1),(11,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,1,4,1),(12,'slide_apresentacao','Primeiro Destaque','Descrição destaque','','1900x1080.png','',1,1,1),(13,'slide_apresentacao','Segundo Destaque','Descrição destaque 2','','1900x1080.png','',1,1,1),(14,'slide_apresentacao','Terceiro Destaque','Descrição destaque 3','','1900x1080.png','',1,1,1),(15,'','Outroes Destaque','','Descrição destaque 3\r\nDescrição destaque 3\r\nDescrição destaque 3\r\nDescrição destaque 3','','',0,1,1),(16,'nossos_destaques','nossos_destaques','','nossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaques','700x400.png','',0,1,1),(17,'nossos_servicos','nossos_servicos','nossos_servicos','nossos_servicos\r\nnossos_servicos\r\nnossos_servicos\r\nnossos_servicos\r\nnossos_servicos\r\nnossos_servicos','','',1,3,1);
/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `endereco` (
  `ende_pk_id` int NOT NULL AUTO_INCREMENT,
  `ende_logradouro` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ende_numero` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ende_bairro` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ende_cep` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ende_cidade` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ende_status` tinyint(1) NOT NULL DEFAULT '1',
  `ende_fk_estado_pk_id` int NOT NULL,
  `ende_fk_user_pk_id` int NOT NULL,
  PRIMARY KEY (`ende_pk_id`),
  KEY `ende_fk_user_pk_id_idx` (`ende_fk_user_pk_id`),
  KEY `ende_fk_estado_pk_id_idx` (`ende_fk_estado_pk_id`),
  CONSTRAINT `ende_fk_estado_pk_id` FOREIGN KEY (`ende_fk_estado_pk_id`) REFERENCES `estado` (`esta_pk_id`),
  CONSTRAINT `ende_fk_user_pk_id` FOREIGN KEY (`ende_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` VALUES (1,'Rua Teste','00','Bairro Teste','00.000-000','Municio Teste',1,6,1),(11,'RUA PAULA LOPES','05','PARQUE HAVAI','61.760-000','EUSEBIO',1,6,1),(12,'RUA PAULA LOPES','05','PARQUE HAVAI','61.760-000','EUSEBIO',1,25,1);
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado` (
  `esta_pk_id` int NOT NULL AUTO_INCREMENT,
  `esta_nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `esta_sigla` varchar(2) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `esta_status` tinyint(1) NOT NULL DEFAULT '1',
  `esta_fk_pais_pk_id` int NOT NULL,
  `esta_fk_user_pk_id` int NOT NULL,
  PRIMARY KEY (`esta_pk_id`),
  KEY `esta_fk_user_pk_id_idx` (`esta_fk_user_pk_id`),
  KEY `esta_fk_pais_pk_id_idx` (`esta_fk_pais_pk_id`),
  CONSTRAINT `esta_fk_pais_pk_id` FOREIGN KEY (`esta_fk_pais_pk_id`) REFERENCES `pais` (`pais_pk_id`),
  CONSTRAINT `esta_fk_user_pk_id` FOREIGN KEY (`esta_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'Acre','AC',1,1,1),(2,'Alagoas','AL',1,1,1),(3,'Amapá','AP',1,1,1),(4,'Amazonas','AM',1,1,1),(5,'Bahia','BA',1,1,1),(6,'Ceará','CE',1,1,1),(7,'Distrito Federal','DF',1,1,1),(8,'Espírito Santo','ES',1,1,1),(9,'Goiás','GO',1,1,1),(10,'Maranhão','MA',1,1,1),(11,'Mato Grosso','MT',1,1,1),(12,'Mato Grosso do Sul','MS',1,1,1),(13,'Minas Gerais','MG',1,1,1),(14,'Pará','PA',1,1,1),(15,'Paraíba','PB',1,1,1),(16,'Paraná','PR',1,1,1),(17,'Pernambuco','PE',1,1,1),(18,'Piauí','PI',1,1,1),(19,'Rio de Janeiro','RJ',1,1,1),(20,'Rio Grande do Norte','RN',1,1,1),(21,'Rio Grande do Sul','RS',1,1,1),(22,'Rondônia','RO',1,1,1),(23,'Roraima','RR',1,1,1),(24,'Santa Catarina','SC',1,1,1),(25,'São Paulo','SP',1,1,1),(26,'Sergipe','SE',1,1,1),(27,'Tocantins','TO',1,1,1);
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `folha_pagamento`
--

DROP TABLE IF EXISTS `folha_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `folha_pagamento` (
  `fopa_pk_id` int NOT NULL AUTO_INCREMENT,
  `fopa_competencia` varchar(7) NOT NULL,
  `fopa_arquivo` blob,
  `fopa_caminho_arquivo` varchar(255) DEFAULT NULL,
  `fopa_status` tinyint(1) NOT NULL DEFAULT '1',
  `fopa_fk_funcionario_pk_id` int NOT NULL,
  `fopa_fk_user_pk_id` int NOT NULL,
  PRIMARY KEY (`fopa_pk_id`),
  KEY `fopa_fk_funcionario_pk_id_idx` (`fopa_fk_funcionario_pk_id`),
  KEY `func_fk_user_pk_id_idx` (`fopa_fk_user_pk_id`),
  CONSTRAINT `fopa_fk_funcionario_pk_id` FOREIGN KEY (`fopa_fk_funcionario_pk_id`) REFERENCES `funcionario` (`func_pk_id`),
  CONSTRAINT `fopa_fk_user_pk_id` FOREIGN KEY (`fopa_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `folha_pagamento`
--

LOCK TABLES `folha_pagamento` WRITE;
/*!40000 ALTER TABLE `folha_pagamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `folha_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionario` (
  `func_pk_id` int NOT NULL AUTO_INCREMENT,
  `func_nome` varchar(50) NOT NULL,
  `func_cpf` varchar(14) NOT NULL,
  `func_rg` varchar(20) NOT NULL,
  `func_pis` varchar(20) NOT NULL,
  `func_data_nascimento` date DEFAULT NULL,
  `func_status` tinyint(1) DEFAULT '1',
  `func_fk_user_pk_id` int NOT NULL,
  `func_fk_endereco_pk_id` int NOT NULL,
  `func_fk_contact_pk_id` int NOT NULL,
  PRIMARY KEY (`func_pk_id`),
  KEY `func_fk_user_pk_id_idx` (`func_fk_user_pk_id`),
  KEY `func_fk_endereco_pk_id_idx` (`func_fk_endereco_pk_id`),
  KEY `func_fk_contact_pk_id_idx` (`func_fk_contact_pk_id`),
  CONSTRAINT `func_fk_contact_pk_id` FOREIGN KEY (`func_fk_contact_pk_id`) REFERENCES `contact` (`cont_pk_id`),
  CONSTRAINT `func_fk_endereco_pk_id` FOREIGN KEY (`func_fk_endereco_pk_id`) REFERENCES `endereco` (`ende_pk_id`),
  CONSTRAINT `func_fk_user_pk_id` FOREIGN KEY (`func_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionario`
--

LOCK TABLES `funcionario` WRITE;
/*!40000 ALTER TABLE `funcionario` DISABLE KEYS */;
INSERT INTO `funcionario` VALUES (1,'GEVERSON JOSE DE SOUZ','606.717.623-89','20077178836','18811656156','1993-04-12',1,1,12,19);
/*!40000 ALTER TABLE `funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page` (
  `page_pk_id` int NOT NULL AUTO_INCREMENT,
  `page_name` varchar(50) NOT NULL,
  `page_description` varchar(255) NOT NULL,
  `page_icon` varchar(45) NOT NULL,
  `page_label` varchar(45) NOT NULL,
  `page_status` tinyint(1) NOT NULL DEFAULT '1',
  `page_fk_user_pk_id` int NOT NULL,
  PRIMARY KEY (`page_pk_id`),
  KEY `page_fk_user_pk_id_idx` (`page_fk_user_pk_id`),
  CONSTRAINT `page_fk_user_pk_id` FOREIGN KEY (`page_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (1,'home','Página Inicial do Site','home','Página Inicial',1,1),(2,'contact','Contato da Empresa e Entre em Contato123','address-book','Contato',1,1),(3,'service','Alguns de Nossos Serviços','concierge-bell','Serviços',0,1),(4,'about','Sobre nós','address-card','Sobre',0,1);
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pais` (
  `pais_pk_id` int NOT NULL AUTO_INCREMENT,
  `pais_nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pais_sigla` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pais_status` tinyint NOT NULL DEFAULT '1',
  `pais_fk_user_pk_id` int NOT NULL,
  PRIMARY KEY (`pais_pk_id`),
  KEY `pais_fk_user_pk_id_idx` (`pais_fk_user_pk_id`),
  CONSTRAINT `pais_fk_user_pk_id` FOREIGN KEY (`pais_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` VALUES (1,'Brasil','BRA',1,1);
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parameter`
--

DROP TABLE IF EXISTS `parameter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parameter` (
  `para_pk_id` int NOT NULL AUTO_INCREMENT,
  `para_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `para_value` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `para_description` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `para_status` tinyint(1) NOT NULL DEFAULT '1',
  `para_fk_user_pk_id` int NOT NULL,
  PRIMARY KEY (`para_pk_id`),
  UNIQUE KEY `para_key` (`para_key`),
  KEY `empr_fk_user_pk_id_idx` (`para_fk_user_pk_id`),
  CONSTRAINT `empr_fk_user_pk_id` FOREIGN KEY (`para_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parameter`
--

LOCK TABLES `parameter` WRITE;
/*!40000 ALTER TABLE `parameter` DISABLE KEYS */;
INSERT INTO `parameter` VALUES (1,'nome_fantazia','','Nome como que todos conhecem',0,1),(2,'razao_social','','Nome como está no documento',1,1),(3,'titulo_site','','Nome para o site',1,1),(4,'icone_site','','Imagem do Ícone do Site',1,1),(5,'email','paulistensetecnologia@gmail.com','Email para envio automático',1,1),(6,'senha','@G182534','Senha do email para envio automático',1,1),(7,'endereco','1','Endereço do dono/empresa do sistema',1,1),(8,'sobre_titulo','Geverson','',1,1),(9,'contato_titulo','Contato','',1,1),(10,'contato','1','',1,1),(11,'servicos_titulo','Serviços','Título da página de serviços',1,1),(12,'google_analytics','G-5ZS0PB48KT','Códifo do Google Analytics',1,1),(13,'servidor_email_smtp','smtp.gmail.com','Protocolo de E-mail',1,1),(14,'servidor_email_porta','465','Porta do Servidor de E-mail',1,1),(15,'servidor_email_seguranca','ssl','Tipo da Segurança do Envio de E-mail',1,1),(16,'mostrar_error','1','APRESENTAÇÃO DE ERROS NO PHP',1,1);
/*!40000 ALTER TABLE `parameter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_pk_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_login` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `user_last_login` timestamp NULL DEFAULT NULL,
  `user_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT '0',
  `user_fk_authority_pk_id` int NOT NULL,
  PRIMARY KEY (`user_pk_id`),
  UNIQUE KEY `user_login_UNIQUE` (`user_login`),
  KEY `user_fk_authority_pk_id_idx` (`user_fk_authority_pk_id`),
  CONSTRAINT `user_fk_authority_pk_id` FOREIGN KEY (`user_fk_authority_pk_id`) REFERENCES `authority` (`auth_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Geverson','geversonjosedesouza@gmail.com','$2y$10$sC2.zLGoNmDyu7kc5N0d7OwiQcDhsH4N.ubAyt2aUtk2SSIa5SRLK','2023-03-17 01:54:08','1653533316628eea8442243.jpg',1,1),(2,'Geverson J de Souza','geversonjosedesouza@hotmail.com','$2y$10$iyBqjNHyi/lrpqJBFZpBz.cHWasRjQGWsfCzF09oqhQYEtIs./lPO','2020-07-21 00:59:39','av_parcial_01.png',1,3),(3,'root','root@root','$2y$10$LW5eueN7wYMSqoe17Mo3y.2p96Wapy/8JMx3qffFulYlA0RgKDwTC','2020-07-17 02:37:34','IMG_20190920_170641_783.jpg',0,3),(4,'Geverson J de Souza','geversonjosedesouza@hoatmail.com','$2y$10$r5cXidzF9i4j8KENQDOIfe5EotNoSmRy94KHJiqOyloFaVocj5WYK',NULL,NULL,0,3);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-19 12:27:14
