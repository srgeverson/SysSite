-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: system
-- ------------------------------------------------------
-- Server version	8.0.32

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
  `auth_description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `auth_status` tinyint(1) NOT NULL,
  `auth_screen` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `auth_function` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`auth_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authority`
--

LOCK TABLES `authority` WRITE;
/*!40000 ALTER TABLE `authority` DISABLE KEYS */;
INSERT INTO `authority` VALUES (1,'TI',0,'ti.php','Gerenciamento completo do sistema para auxiliar nossos clientes.'),(2,'Administrador',1,'administrador.php','ÁREA RESERVADA PARA GERENCIAR OPERAÇÕES E FAZER LANÇAMENTOS DAS FOLHA DE PAGAMENTOS'),(3,'Funcionário',1,'funcionario.php','ÁREA RESERVADA PARA ACOMPANHAMENTO DE SEUS CONTRA CHECHE'),(4,'Marketing',1,'marketing.php','ÁREA RESERVADA PARA GERENCIAMENTO DO CONTEÚDO DO SITE');
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
  `cont_description` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `cont_phone` varchar(14) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `cont_cell_phone` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `cont_whatsapp` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `cont_email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `cont_facebook` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `cont_instagram` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `cont_twitter` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `cont_status` tinyint(1) NOT NULL DEFAULT '1',
  `cont_text` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `cont_fk_user_pk_id` int DEFAULT NULL,
  PRIMARY KEY (`cont_pk_id`),
  KEY `cont_fk_user_pk_id_idx` (`cont_fk_user_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,'Dados Pessoais','(00)0000-0000','(00)00000-0000','00000000000','email@email.com','usurio','@usuario',NULL,1,'Dados do sistema',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (1,'destaques_servicos','destaques_servicos','','','1200x300.png','',1,3,1),(2,'modern_business','A empresa...','','    Para ser percebida como uma empresa social e ambientalmente responsável e atuante, a Natura parte da premissa de que os impactos ambientais de sua atividade decorrem de uma cadeia de transformações, da qual representa somente uma parte. Por isso, acredita que, para ter eficácia, as ações ambientais precisam: considerar cada cadeia produtiva de maneira integral.','750x450.png','',1,4,1),(3,'our_team','Nome do membro','Cargo do membro','Breve descrição do cardo do membro ou do próprio membro','750x450.png','',1,4,1),(4,'our_customers','our_customers','','','500x300.png','123',1,4,1),(5,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,1,4,1),(6,'our_team','Nome do membro','Cargo do membro','Breve descrição do cardo do membro ou do próprio membro','750x450.png','',1,4,1),(7,'our_team','Nome do membro','Cargo do membro','Breve descrição do cardo do membro ou do próprio membro','750x450.png','',1,4,1),(8,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,1,4,1),(9,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,1,4,1),(10,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,1,4,1),(11,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,1,4,1),(12,'slide_apresentacao','Primeiro Destaque','Descrição destaque','','1900x1080.png','',0,1,1),(13,'slide_apresentacao','Segundo Destaque','Descrição destaque 2','','1900x1080.png','',0,1,1),(14,'slide_apresentacao','Terceiro Destaque','Descrição destaque 3','','1900x1080.png','',0,1,1),(15,'outros_destaques','Outroes Destaque','','Descrição destaque 3\r\nDescrição destaque 3\r\nDescrição destaque 3\r\nDescrição destaque 3','','',0,1,1),(16,'nossos_destaques','nossos_destaques','','nossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaques','700x400.png','',0,1,1),(17,'nossos_servicos','nossos_servicos','nossos_servicos','nossos_servicos\r\nnossos_servicos\r\nnossos_servicos\r\nnossos_servicos\r\nnossos_servicos\r\nnossos_servicos',NULL,'',1,3,1),(18,'our_contact','Nosso contato','Nosso contato','Nosso contato',NULL,NULL,1,2,1);
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
  `ende_logradouro` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `ende_numero` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `ende_bairro` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `ende_cep` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `ende_cidade` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `ende_status` tinyint(1) NOT NULL DEFAULT '1',
  `ende_fk_estado_pk_id` int NOT NULL,
  `ende_fk_user_pk_id` int NOT NULL,
  PRIMARY KEY (`ende_pk_id`),
  KEY `ende_fk_user_pk_id_idx` (`ende_fk_user_pk_id`),
  KEY `ende_fk_estado_pk_id_idx` (`ende_fk_estado_pk_id`),
  CONSTRAINT `ende_fk_estado_pk_id` FOREIGN KEY (`ende_fk_estado_pk_id`) REFERENCES `estado` (`esta_pk_id`),
  CONSTRAINT `ende_fk_user_pk_id` FOREIGN KEY (`ende_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` VALUES (1,'Rua Padrão','00','Bairro Padrão','00.000-000','Municio Padrão',1,6,1),(2,'Rua','00','Bairro','00.000-000','Municio',1,6,1);
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
  `esta_nome` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `esta_sigla` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `esta_status` tinyint(1) NOT NULL DEFAULT '1',
  `esta_fk_pais_pk_id` int NOT NULL,
  `esta_fk_user_pk_id` int NOT NULL,
  PRIMARY KEY (`esta_pk_id`),
  KEY `esta_fk_user_pk_id_idx` (`esta_fk_user_pk_id`),
  KEY `esta_fk_pais_pk_id_idx` (`esta_fk_pais_pk_id`),
  CONSTRAINT `esta_fk_pais_pk_id` FOREIGN KEY (`esta_fk_pais_pk_id`) REFERENCES `pais` (`pais_pk_id`),
  CONSTRAINT `esta_fk_user_pk_id` FOREIGN KEY (`esta_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
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
  `fopa_nome_arquivo` varchar(255) DEFAULT NULL,
  `fopa_tamanho_arquivo` int DEFAULT NULL,
  `fopa_caminho_arquivo` varchar(255) DEFAULT NULL,
  `fopa_arquivo` longblob,
  `fopa_status` tinyint(1) NOT NULL DEFAULT '1',
  `fopa_fk_funcionario_pk_id` int NOT NULL,
  `fopa_fk_user_pk_id` int NOT NULL,
  PRIMARY KEY (`fopa_pk_id`),
  KEY `fopa_fk_funcionario_pk_id_idx` (`fopa_fk_funcionario_pk_id`),
  KEY `func_fk_user_pk_id_idx` (`fopa_fk_user_pk_id`),
  CONSTRAINT `fopa_fk_funcionario_pk_id` FOREIGN KEY (`fopa_fk_funcionario_pk_id`) REFERENCES `funcionario` (`func_pk_id`),
  CONSTRAINT `fopa_fk_user_pk_id` FOREIGN KEY (`fopa_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=236 DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionario`
--

LOCK TABLES `funcionario` WRITE;
/*!40000 ALTER TABLE `funcionario` DISABLE KEYS */;
INSERT INTO `funcionario` VALUES (1,'123','000.000.000-00','00000000000','00000000000','1212-03-12',1,1,2,1);
/*!40000 ALTER TABLE `funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionario_user`
--

DROP TABLE IF EXISTS `funcionario_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionario_user` (
  `fuus_pk_id` int NOT NULL AUTO_INCREMENT,
  `fuus_fk_user_pk_id` int NOT NULL,
  `fuus_fk_funcionario_pk_id` int NOT NULL,
  `fuus_status` tinyint(1) NOT NULL DEFAULT '1',
  `fuus_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fuus_pk_id`,`fuus_fk_user_pk_id`,`fuus_fk_funcionario_pk_id`),
  UNIQUE KEY `fuus_fk_user_pk_id_UNIQUE` (`fuus_fk_user_pk_id`),
  UNIQUE KEY `fuus_fk_funcionario_pk_id_UNIQUE` (`fuus_fk_funcionario_pk_id`),
  UNIQUE KEY `fuus_pk_id_UNIQUE` (`fuus_pk_id`),
  CONSTRAINT `fuus_fk_funcionario_pk_id` FOREIGN KEY (`fuus_fk_funcionario_pk_id`) REFERENCES `funcionario` (`func_pk_id`),
  CONSTRAINT `fuus_fk_user_pk_id` FOREIGN KEY (`fuus_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=ascii COLLATE=ascii_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionario_user`
--

LOCK TABLES `funcionario_user` WRITE;
/*!40000 ALTER TABLE `funcionario_user` DISABLE KEYS */;
INSERT INTO `funcionario_user` VALUES (13,3,1,1,'2023-03-19 19:44:44');
/*!40000 ALTER TABLE `funcionario_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_user`
--

DROP TABLE IF EXISTS `log_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_user` (
  `luser_id_tabela` int DEFAULT NULL,
  `luser_fk_usuario_pk_id` int DEFAULT NULL,
  `luser_operacao` varchar(6) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `luser_campo_modificado` varchar(45) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `luser_valor_antigo` text CHARACTER SET ascii COLLATE ascii_bin,
  `luser_valor_atual` text CHARACTER SET ascii COLLATE ascii_bin,
  `luser_data_operacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_user`
--

LOCK TABLES `log_user` WRITE;
/*!40000 ALTER TABLE `log_user` DISABLE KEYS */;
INSERT INTO `log_user` VALUES (1,NULL,'UPDATE','user_last_access','2020-08-09 15:49:31','2020-08-09 23:31:33','2020-08-09 23:31:33'),(1,NULL,'UPDATE','user_name','Geverson','Geverson J de Souza','2020-08-09 23:32:35'),(1,NULL,'UPDATE','user_password','$2y$10$7V6yhg6xSHut0jJ4Qs9CieXgRefbUrofSx3YizQDa5qG/8sOWMV62','$2y$10$IfvfgkG1LLW2jwJKgDueHe6YwJEt5dtUHyru5f7L3.yKSQKuhotOy','2020-08-09 23:32:35'),(6,NULL,'UPDATE','user_password','$2y$10$DaiWSl4vFIs052rGw1CQo.cqtYBnTwJ88R9PwHtQX8bwL7S.lt8fS','$2y$10$ppKWSgMr3KBq1fsGa2m/l.7UUu2AQTBiC0wl21M3U/TqoFgsBZRV6','2020-08-09 23:33:29'),(0,NULL,'INSERT','user_pk_id','0',NULL,'2020-08-10 00:15:49'),(0,NULL,'INSERT','user_name','g',NULL,'2020-08-10 00:15:49'),(0,NULL,'INSERT','user_login','root@root1',NULL,'2020-08-10 00:15:49'),(0,NULL,'INSERT','user_password','$2y$10$ggNgki2BK1lUFiQpH6En4eSLWPprI69P/0g.IEsuiBtxkSWlE4sdu',NULL,'2020-08-10 00:15:49'),(0,NULL,'INSERT','user_status','1',NULL,'2020-08-10 00:15:49'),(0,NULL,'INSERT','user_fk_authority_pk_id','2',NULL,'2020-08-10 00:15:49'),(0,NULL,'INSERT','user_pk_id','0',NULL,'2020-08-10 00:17:19'),(0,NULL,'INSERT','user_name','teste1',NULL,'2020-08-10 00:17:19'),(0,NULL,'INSERT','user_login','asd@asd',NULL,'2020-08-10 00:17:19'),(0,NULL,'INSERT','user_password','$2y$10$V7o4ORE1d2ysUqFWYql6xe3UZ4oGmZ.ZmjoqhaVVK0b5GXW279.EW',NULL,'2020-08-10 00:17:19'),(0,NULL,'INSERT','user_last_login',NULL,NULL,'2020-08-10 00:17:19'),(0,NULL,'INSERT','user_image',NULL,NULL,'2020-08-10 00:17:19'),(0,NULL,'INSERT','user_status','1',NULL,'2020-08-10 00:17:19'),(0,NULL,'INSERT','user_fk_authority_pk_id','2',NULL,'2020-08-10 00:17:19'),(11,NULL,'UPDATE','user_status','1','0','2020-08-10 00:20:06'),(11,NULL,'DELETE','user_pk_id','11',NULL,'2020-08-10 00:20:11'),(11,NULL,'DELETE','user_name','teste1',NULL,'2020-08-10 00:20:11'),(11,NULL,'DELETE','user_login','asd@asd',NULL,'2020-08-10 00:20:11'),(11,NULL,'DELETE','user_password','$2y$10$V7o4ORE1d2ysUqFWYql6xe3UZ4oGmZ.ZmjoqhaVVK0b5GXW279.EW',NULL,'2020-08-10 00:20:11'),(11,NULL,'DELETE','user_last_login',NULL,NULL,'2020-08-10 00:20:11'),(11,NULL,'DELETE','user_image',NULL,NULL,'2020-08-10 00:20:11'),(11,NULL,'DELETE','user_status','0',NULL,'2020-08-10 00:20:11'),(11,NULL,'DELETE','user_fk_authority_pk_id','2',NULL,'2020-08-10 00:20:11'),(10,NULL,'UPDATE','user_status','1','0','2020-08-10 00:20:50'),(10,NULL,'DELETE','user_pk_id','10',NULL,'2020-08-10 00:20:54'),(10,NULL,'DELETE','user_name','g',NULL,'2020-08-10 00:20:54'),(10,NULL,'DELETE','user_login','root@root1',NULL,'2020-08-10 00:20:54'),(10,NULL,'DELETE','user_password','$2y$10$ggNgki2BK1lUFiQpH6En4eSLWPprI69P/0g.IEsuiBtxkSWlE4sdu',NULL,'2020-08-10 00:20:54'),(10,NULL,'DELETE','user_last_login',NULL,NULL,'2020-08-10 00:20:54'),(10,NULL,'DELETE','user_image',NULL,NULL,'2020-08-10 00:20:54'),(10,NULL,'DELETE','user_status','0',NULL,'2020-08-10 00:20:54'),(10,NULL,'DELETE','user_fk_authority_pk_id','2',NULL,'2020-08-10 00:20:54'),(0,NULL,'INSERT','user_pk_id','0',NULL,'2020-08-10 00:21:08'),(0,NULL,'INSERT','user_name','g',NULL,'2020-08-10 00:21:08'),(0,NULL,'INSERT','user_login','root@root1',NULL,'2020-08-10 00:21:08'),(0,NULL,'INSERT','user_password','$2y$10$w6zSx4hQjlX2lKVPBk3BxueZZGaEoN3RMiiB35yjiIpaZ8fOZflzG',NULL,'2020-08-10 00:21:08'),(0,NULL,'INSERT','user_last_login',NULL,NULL,'2020-08-10 00:21:08'),(0,NULL,'INSERT','user_image',NULL,NULL,'2020-08-10 00:21:08'),(0,NULL,'INSERT','user_status','1',NULL,'2020-08-10 00:21:08'),(0,NULL,'INSERT','user_fk_authority_pk_id','2',NULL,'2020-08-10 00:21:08'),(6,NULL,'UPDATE','user_password','$2y$10$ppKWSgMr3KBq1fsGa2m/l.7UUu2AQTBiC0wl21M3U/TqoFgsBZRV6','$2y$10$DaiWSl4vFIs052rGw1CQo.cqtYBnTwJ88R9PwHtQX8bwL7S.lt8fS','2020-08-10 00:25:09'),(1,NULL,'UPDATE','user_last_access','2020-08-10 02:31:33','2023-03-19 16:06:10','2023-03-19 16:06:10'),(12,NULL,'DELETE','user_pk_id','12',NULL,'2023-03-19 16:06:43'),(12,NULL,'DELETE','user_name','g',NULL,'2023-03-19 16:06:43'),(12,NULL,'DELETE','user_login','root@root1',NULL,'2023-03-19 16:06:43'),(12,NULL,'DELETE','user_password','$2y$10$w6zSx4hQjlX2lKVPBk3BxueZZGaEoN3RMiiB35yjiIpaZ8fOZflzG',NULL,'2023-03-19 16:06:43'),(12,NULL,'DELETE','user_last_login',NULL,NULL,'2023-03-19 16:06:43'),(12,NULL,'DELETE','user_image',NULL,NULL,'2023-03-19 16:06:43'),(12,NULL,'DELETE','user_status','1',NULL,'2023-03-19 16:06:43'),(12,NULL,'DELETE','user_fk_authority_pk_id','2',NULL,'2023-03-19 16:06:43'),(1,NULL,'UPDATE','user_name','Geverson J de Souza','Administrator','2023-03-19 16:07:12'),(1,NULL,'UPDATE','user_image','15969434015f2f6c29364fb.jpg','NULL','2023-03-19 16:07:31'),(1,NULL,'UPDATE','user_last_access','2023-03-19 16:06:10','2023-03-19 16:07:53','2023-03-19 16:07:53'),(1,NULL,'UPDATE','user_image',NULL,'admin.png','2023-03-19 16:08:06'),(1,NULL,'UPDATE','user_last_access','2023-03-19 16:07:53','2023-03-19 16:09:34','2023-03-19 16:09:34'),(1,NULL,'UPDATE','user_image','admin.png','admin.jpg','2023-03-19 16:17:11'),(1,NULL,'UPDATE','user_last_access','2023-03-19 16:09:34','2023-03-19 16:17:22','2023-03-19 16:17:22'),(1,NULL,'UPDATE','user_login','geversonjosedesouza@gmail.com','admin@adminl.com','2023-03-19 16:19:24'),(4,NULL,'UPDATE','user_login','geversonjosedesouza@hotmail.com','geversonjosedesouza@gmail.com','2023-03-19 19:39:56'),(6,NULL,'UPDATE','user_login','root@root','geversonjosedesouza@hotmail.com','2023-03-19 19:40:09'),(6,NULL,'UPDATE','user_name','root','Geverson Souza','2023-03-19 19:40:19'),(2,NULL,'UPDATE','user_fk_authority_pk_id','3','1','2023-03-19 19:45:39'),(2,NULL,'UPDATE','user_password','$2y$10$DaiWSl4vFIs052rGw1CQo.cqtYBnTwJ88R9PwHtQX8bwL7S.lt8fS','$2y$10$IfvfgkG1LLW2jwJKgDueHe6YwJEt5dtUHyru5f7L3.yKSQKuhotOy','2023-03-19 19:46:28'),(3,NULL,'UPDATE','user_password','$2y$10$DaiWSl4vFIs052rGw1CQo.cqtYBnTwJ88R9PwHtQX8bwL7S.lt8fS','$2y$10$IfvfgkG1LLW2jwJKgDueHe6YwJEt5dtUHyru5f7L3.yKSQKuhotOy','2023-03-19 19:46:28'),(2,NULL,'UPDATE','user_last_access','2020-08-09 14:37:10','2023-03-19 19:46:32','2023-03-19 19:46:32'),(2,NULL,'UPDATE','user_last_access','2023-03-19 19:46:32','2023-03-19 19:49:51','2023-03-19 19:49:51'),(2,NULL,'UPDATE','user_last_access','2023-03-19 19:49:51','2023-03-19 20:18:22','2023-03-19 20:18:22'),(2,NULL,'UPDATE','user_last_access','2023-03-19 20:18:22','2023-03-19 20:19:47','2023-03-19 20:19:47'),(2,NULL,'UPDATE','user_last_access','2023-03-19 20:19:47','2023-03-19 20:20:53','2023-03-19 20:20:53'),(2,NULL,'UPDATE','user_last_access','2023-03-19 20:20:53','2023-03-19 20:28:29','2023-03-19 20:28:29'),(2,NULL,'UPDATE','user_last_access','2023-03-19 20:28:29','2023-03-19 20:38:37','2023-03-19 20:38:37'),(2,NULL,'UPDATE','user_last_access','2023-03-19 20:38:37','2023-03-19 20:41:13','2023-03-19 20:41:13'),(2,NULL,'UPDATE','user_last_access','2023-03-19 20:41:13','2023-03-19 21:13:14','2023-03-19 21:13:14'),(2,NULL,'UPDATE','user_password','$2y$10$IfvfgkG1LLW2jwJKgDueHe6YwJEt5dtUHyru5f7L3.yKSQKuhotOy','$2y$10$GO84OdmEE/ltQw3KIvUcFORh818wQIvW46x/2VS1Ya/JyWRYsSEma','2023-03-19 21:17:06'),(2,NULL,'UPDATE','user_last_access','2023-03-19 21:13:14','2023-03-19 21:17:52','2023-03-19 21:17:52'),(3,NULL,'UPDATE','user_password','$2y$10$IfvfgkG1LLW2jwJKgDueHe6YwJEt5dtUHyru5f7L3.yKSQKuhotOy','$2y$10$GO84OdmEE/ltQw3KIvUcFORh818wQIvW46x/2VS1Ya/JyWRYsSEma','2023-03-19 21:18:56');
/*!40000 ALTER TABLE `log_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `class` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `icone` varchar(255) DEFAULT NULL,
  `sistema_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_fk_sistema_idx` (`sistema_id`),
  KEY `menu_fk_usuario_idx` (`usuario_id`),
  CONSTRAINT `menu_fk_sistema` FOREIGN KEY (`sistema_id`) REFERENCES `sistema` (`id`),
  CONSTRAINT `menu_fk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `user` (`user_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Perfil','Perfil do usuário',1,NULL,NULL,NULL,'1',1,1),(2,'Sistema','Configurações do Sistema',1,NULL,NULL,NULL,'fas fa-cogs fa-fw',1,1),(3,'Outros','Outras operações',1,NULL,NULL,NULL,'fas fa-arrows-alt fa-fw',1,1),(4,'Recursos Humanos','Operações de RH',1,NULL,NULL,NULL,'fas fa-chalkboard-teacher fa-fw',1,1),(5,'Contra-cheque','Caixa de Menssagens',1,NULL,NULL,NULL,'fas fa-envelope fa-fw',1,1);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_item`
--

DROP TABLE IF EXISTS `menu_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `titulo` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `icone` varchar(255) DEFAULT NULL,
  `menu_item_id` int DEFAULT NULL,
  `menu_id` int NOT NULL,
  `menu_itemcol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_menu_item_menu_idx` (`menu_id`),
  KEY `fk_menu_item_submenu` (`menu_item_id`),
  CONSTRAINT `fk_menu_item_menu` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`),
  CONSTRAINT `fk_menu_item_submenu` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_item` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_item`
--

LOCK TABLES `menu_item` WRITE;
/*!40000 ALTER TABLE `menu_item` DISABLE KEYS */;
INSERT INTO `menu_item` VALUES (1,'Perfil','Perfil do Usuário',1,NULL,NULL,'?page=ControllerUser&option=editProfile&user_pk_id=usuario_logado_user_pk_id',NULL,'fas fa-user fa-sm fa-fw mr-2 text-gray-400',1,1,NULL),(2,'Boas vindas','Boas vindas',1,NULL,NULL,'?page=ControllerSystem&option=welcome',NULL,'fas fa-tachometer-alt fa-sm fa-fw mr-2 text-gray-400',1,1,NULL),(3,'Sair','Sair',1,NULL,NULL,'?page=ControllerUser&option=logout',NULL,'fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400',1,1,NULL),(4,'Usuários','Usuários',1,NULL,NULL,'?page=ControllerUser&option=listar',NULL,'fas fa-users-cog fa-sm fa-fw mr-2 text-gray-400',1,2,NULL),(5,'Permissões','Permissões',1,NULL,NULL,'?page=ControllerAuthority&option=listar',NULL,'fas fa-user-lock fa-sm fa-fw mr-2 text-gray-400',1,2,NULL),(6,'Parâmetros','Parâmetros',1,NULL,NULL,'?page=ControllerParameter&option=listar',NULL,'fas fa-tasks fa-sm fa-fw mr-2 text-gray-400',1,2,NULL),(7,'Páginas do Site','Páginas do Site',1,NULL,NULL,'?page=ControllerPage&option=listar',NULL,'fas fa-file-alt fa-sm fa-fw mr-2 text-gray-400',1,2,NULL),(8,'Conteúdo das Páginas','Conteúdo das Páginas',1,NULL,NULL,'?page=ControllerContent&option=listar',NULL,'fas fa-file-code fa-sm fa-fw mr-2 text-gray-400',1,2,NULL),(9,'Teste de Desenvolvimento','Teste de Desenvolvimento',1,NULL,NULL,'?page=ControllerTest&option=listar',NULL,'fas fa-file-code fa-sm fa-fw mr-2 text-gray-400',1,2,NULL),(10,'Endereços','Endereços',1,NULL,NULL,'?page=ControllerEndereco&option=listar',NULL,'fas fa-address-book fa-sm fa-fw mr-2 text-gray-400',1,3,NULL),(11,'Estados','Estados',1,NULL,NULL,'?page=ControllerEstado&option=listar',NULL,'fas fa-city fa-sm fa-fw mr-2 text-gray-400',1,3,NULL),(12,'Países','Países',1,NULL,NULL,'?page=ControllerPais&option=listar',NULL,'fas fa-university fa-sm fa-fw mr-2 text-gray-400',1,3,NULL),(13,'Funcionários','Funcionários',1,NULL,NULL,'?page=ControllerFuncionario&option=listar',NULL,'fas fa-users fa-sm fa-fw mr-2 text-gray-400',1,4,NULL),(14,'Contatos','Contatos',1,NULL,NULL,'?page=ControllerContact&option=listar',NULL,'fas fa-address-book fa-sm fa-fw mr-2 text-gray-400',1,4,NULL),(15,'Folha de Pagamento','Folha de Pagamento',1,NULL,NULL,'?page=ControllerFolhaPagamento&option=listar',NULL,'fas fa-money-check-alt fa-sm fa-fw mr-2 text-gray-400',1,4,NULL),(16,'Todas folhas de pagamento','Lista de contracheques disponíveis',1,'Não existe folha de pagamento lançado',NULL,'?page=ControllerFolhaPagamento&option=listar',NULL,'dropdown-item text-center small text-gray-500',1,5,NULL);
/*!40000 ALTER TABLE `menu_item` ENABLE KEYS */;
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
INSERT INTO `page` VALUES (1,'home','Página Inicial do Site','home','Página Inicial',0,1),(2,'contact','Contato da Empresa e Entre em Contato123','address-book','Contato',0,1),(3,'service','Alguns de Nossos Serviços','concierge-bell','Serviços',0,1),(4,'about','Sobre nós','address-card','Sobre',0,1);
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
  `pais_nome` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `pais_sigla` varchar(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `pais_status` tinyint NOT NULL DEFAULT '1',
  `pais_fk_user_pk_id` int NOT NULL,
  PRIMARY KEY (`pais_pk_id`),
  KEY `pais_fk_user_pk_id_idx` (`pais_fk_user_pk_id`),
  CONSTRAINT `pais_fk_user_pk_id` FOREIGN KEY (`pais_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
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
  `para_key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `para_value` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `para_description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `para_status` tinyint(1) NOT NULL DEFAULT '1',
  `para_fk_user_pk_id` int NOT NULL,
  PRIMARY KEY (`para_pk_id`),
  UNIQUE KEY `para_key` (`para_key`),
  KEY `empr_fk_user_pk_id_idx` (`para_fk_user_pk_id`),
  CONSTRAINT `empr_fk_user_pk_id` FOREIGN KEY (`para_fk_user_pk_id`) REFERENCES `user` (`user_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parameter`
--

LOCK TABLES `parameter` WRITE;
/*!40000 ALTER TABLE `parameter` DISABLE KEYS */;
INSERT INTO `parameter` VALUES (1,'nome_fantazia','','Nome como que todos conhecem',1,1),(2,'razao_social','','Nome como está no documento',1,1),(3,'titulo_site','','Nome para o site',1,1),(4,'icone_site','favicon.png','Imagem do Ícone do Site',1,1),(5,'email','paulistensetecnologia@gmail.com','Email para envio automático',1,1),(6,'senha','@G182534','Senha do email para envio automático',1,1),(7,'endereco','1','Endereço do dono/empresa do sistema',1,1),(8,'sobre_titulo','Sobre','',1,1),(9,'contato_titulo','Contato','',1,1),(10,'contato','1','Chave Estrangeira da tabela contatos',1,1),(11,'servicos_titulo','Serviços','Título da página de serviços',1,1),(12,'google_analytics','G-5ZS0PB48KT','Códifo do Google Analytics',1,1),(13,'servidor_email_smtp','smtp.gmail.com','Protocolo de E-mail',1,1),(14,'servidor_email_porta','587','Porta do Servidor de E-mail',1,1),(15,'servidor_email_seguranca','tls','Tipo da Segurança do Envio de E-mail',1,1),(16,'mostrar_error','1','Mostrar erros das páginas PHP',1,1),(17,'servidor_debug_email','0','MOSTRAR ERROR AO ENVIAR EMAIL',1,1),(18,'tempo_sessao_site','60','Tempo de usuário ficar logado',1,1),(19,'autor_site','Geverson Souza','Quem criou o site',1,1),(20,'modulos_sistema','2','Módulo do sistema que está ativo/contratado',1,1),(21,'teste_ambiente_sistema','1','Teste ambiente sistema',1,1);
/*!40000 ALTER TABLE `parameter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sistema`
--

DROP TABLE IF EXISTS `sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sistema` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sistema`
--

LOCK TABLES `sistema` WRITE;
/*!40000 ALTER TABLE `sistema` DISABLE KEYS */;
INSERT INTO `sistema` VALUES (1,'SysSite','Sistema Integrado com Site',1);
/*!40000 ALTER TABLE `sistema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tests`
--

LOCK TABLES `tests` WRITE;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_pk_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `user_login` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `user_password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `user_last_login` timestamp NULL DEFAULT NULL,
  `user_image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT '0',
  `user_fk_authority_pk_id` int DEFAULT NULL,
  PRIMARY KEY (`user_pk_id`),
  UNIQUE KEY `user_login_UNIQUE` (`user_login`),
  KEY `user_fk_authority_pk_id_idx` (`user_fk_authority_pk_id`),
  CONSTRAINT `user_fk_authority_pk_id` FOREIGN KEY (`user_fk_authority_pk_id`) REFERENCES `authority` (`auth_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Administrator','admin@admin.com','$2y$10$IfvfgkG1LLW2jwJKgDueHe6YwJEt5dtUHyru5f7L3.yKSQKuhotOy','2023-03-19 16:17:22',NULL,1,2),(2,'Geverson J de Souza','geversonjosedesouza@gmail.com','$2y$10$GO84OdmEE/ltQw3KIvUcFORh818wQIvW46x/2VS1Ya/JyWRYsSEma','2023-03-19 21:17:52',NULL,1,1),(3,'Geverson Souza','geversonjosedesouza@hotmail.com','$2y$10$GO84OdmEE/ltQw3KIvUcFORh818wQIvW46x/2VS1Ya/JyWRYsSEma','2020-08-10 02:20:49',NULL,1,4);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `trigger_user_insert` BEFORE INSERT ON `user` FOR EACH ROW BEGIN
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
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `trigger_user_update` BEFORE UPDATE ON `user` FOR EACH ROW BEGIN
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
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `trigger_user_delete` BEFORE DELETE ON `user` FOR EACH ROW BEGIN
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
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-26 22:16:36
