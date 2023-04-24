-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: system
-- ------------------------------------------------------
-- Server version	8.0.32
CREATE DATABASE IF NOT EXISTS `system`;
USE `system`;

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
-- Table structure for table `cidades`
--

DROP TABLE IF EXISTS `cidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cidades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` int NOT NULL,
  `nome` varchar(255) NOT NULL,
  `estado_id` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cidades_estado_idx` (`estado_id`),
  KEY `fk_cidades_usuario_idx` (`usuario_id`),
  CONSTRAINT `fk_cidades_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
  CONSTRAINT `fk_cidades_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5571 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cidades`
--

LOCK TABLES `cidades` WRITE;
/*!40000 ALTER TABLE `cidades` DISABLE KEYS */;
INSERT INTO `cidades` VALUES (935,2303709,'Caucaia',6,1,1),(947,2304285,'Eusébio',6,1,1),(950,2304400,'Fortaleza',6,1,1);
/*!40000 ALTER TABLE `cidades` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `cidades_AFTER_INSERT` AFTER INSERT ON `cidades` FOR EACH ROW BEGIN
	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_atual, data_operacao, usuario_id)
    VALUES
		('cidades', NEW.id, 'INSERT', 'id', NEW.id, now(), NEW.usuario_id),
        ('cidades', NEW.id, 'INSERT','codigo', NEW.codigo, now(), NEW.usuario_id),
        ('cidades', NEW.id, 'INSERT','nome', NEW.nome, now(), NEW.usuario_id),
        ('cidades', NEW.id, 'INSERT','estado_id', NEW.estado_id, now(), NEW.usuario_id),
        ('cidades', NEW.id, 'INSERT','status', NEW.status, now(), NEW.usuario_id),
        ('cidades', NEW.id, 'INSERT','usuario_id', NEW.usuario_id, now(), NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `cidades_AFTER_UPDATE` AFTER UPDATE ON `cidades` FOR EACH ROW BEGIN
IF (OLD.nome <> NEW.nome or (OLD.nome IS NULL and NEW.nome IS NOT NULL)) THEN
INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
    VALUES 
  ('cidades', 'nome', OLD.nome, NEW.nome, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;

IF (OLD.codigo <> NEW.codigo or (OLD.codigo IS NULL and NEW.codigo IS NOT NULL)) THEN
  INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES 
        ('cidades', 'codigo', OLD.codigo, NEW.codigo, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.status <> NEW.status or (OLD.status IS NULL and NEW.status IS NOT NULL)) THEN
  INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES
        ('cidades', 'status', OLD.status, NEW.status, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.estado_id <> NEW.estado_id or (OLD.estado_id IS NULL and NEW.estado_id IS NOT NULL)) THEN
  INSERT INTO logs 
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES 
        ('cidades', 'estado_id', OLD.estado_id, NEW.estado_id, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.usuario_id <> NEW.usuario_id or (OLD.usuario_id IS NULL and NEW.usuario_id IS NOT NULL)) THEN
  INSERT INTO logs 
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES 
        ('cidades', 'usuario_id', OLD.usuario_id, NEW.usuario_id, now(), 'UPDATE', OLD.id, NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `cidades_AFTER_DELETE` AFTER DELETE ON `cidades` FOR EACH ROW BEGIN
	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
    VALUES
		('cidades', OLD.id, 'DELETE', 'id', OLD.id, now(), OLD.usuario_id),
        ('cidades', OLD.id, 'DELETE','nome', OLD.nome, now(), OLD.usuario_id),
        ('cidades', OLD.id, 'DELETE','codigo', OLD.codigo, now(), OLD.usuario_id),
        ('cidades', OLD.id, 'DELETE','status', OLD.status, now(), OLD.usuario_id),
        ('cidades', OLD.id, 'DELETE','estado_id', OLD.estado_id, now(), OLD.usuario_id),
        ('cidades', OLD.id, 'DELETE','usuario_id', OLD.usuario_id, now(), OLD.usuario_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `contatos`
--

DROP TABLE IF EXISTS `contatos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contatos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `whatsapp` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `observacao` varchar(45) DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contatos_usuario_idx` (`usuario_id`),
  CONSTRAINT `fk_contatos_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contatos`
--

LOCK TABLES `contatos` WRITE;
/*!40000 ALTER TABLE `contatos` DISABLE KEYS */;
INSERT INTO `contatos` VALUES (7,'Contato de usuário padrão.',NULL,NULL,NULL,'1@gmail.com',NULL,NULL,NULL,1,'Contato de usuário padrão.',NULL);
/*!40000 ALTER TABLE `contatos` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `contatos_AFTER_INSERT` AFTER INSERT ON `contatos` FOR EACH ROW BEGIN
  	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_atual, data_operacao, usuario_id)
    VALUES
		('contatos', NEW.id, 'INSERT', 'id', NEW.id, now(), NEW.usuario_id),
        ('contatos', NEW.id, 'INSERT','descricao', NEW.descricao, now(), NEW.usuario_id),
        ('contatos', NEW.id, 'INSERT','telefone', NEW.telefone, now(), NEW.usuario_id),
        ('contatos', NEW.id, 'INSERT','celular', NEW.celular, now(), NEW.usuario_id),
        ('contatos', NEW.id, 'INSERT','whatsapp', NEW.whatsapp, now(), NEW.usuario_id),
        ('contatos', NEW.id, 'INSERT','email', NEW.email, now(), NEW.usuario_id),
        ('contatos', NEW.id, 'INSERT','facebook', NEW.facebook, now(), NEW.usuario_id),
        ('contatos', NEW.id, 'INSERT','instagram', NEW.instagram, now(), NEW.usuario_id),
        ('contatos', NEW.id, 'INSERT','twitter', NEW.twitter, now(), NEW.usuario_id),
        ('contatos', NEW.id, 'INSERT','observacao', NEW.observacao, now(), NEW.usuario_id),
        ('contatos', NEW.id, 'INSERT','status', NEW.status, now(), NEW.usuario_id),
        ('contatos', NEW.id, 'INSERT','usuario_id', NEW.usuario_id, now(), NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `contatos_AFTER_UPDATE` AFTER UPDATE ON `contatos` FOR EACH ROW BEGIN

    IF (OLD.descricao <> NEW.descricao or (OLD.descricao IS NULL and NEW.descricao IS NOT NULL)) THEN
		INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES 
			('contatos', 'descricao', OLD.descricao, NEW.descricao, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	 END IF;
    
	
    IF (OLD.telefone <> NEW.telefone or (OLD.telefone IS NULL and NEW.telefone IS NOT NULL)) THEN
			INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('contatos', 'telefone', OLD.telefone, NEW.telefone, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;
    
	IF (OLD.celular <> NEW.celular or (OLD.celular IS NULL and NEW.celular IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('contatos', 'celular', OLD.celular, NEW.celular, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;
    
	IF (OLD.whatsapp <> NEW.whatsapp or (OLD.whatsapp IS NULL and NEW.whatsapp IS NOT NULL)) THEN
			INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES
            ('contatos', 'whatsapp', OLD.whatsapp, NEW.whatsapp, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

	IF (OLD.facebook <> NEW.facebook or (OLD.facebook IS NULL and NEW.facebook IS NOT NULL)) THEN
			INSERT INTO logs 
                        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES
            ('contatos', 'facebook', OLD.facebook, NEW.facebook, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

	IF (OLD.instagram <> NEW.instagram or (OLD.instagram IS NULL and NEW.instagram IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('contatos', 'instagram', OLD.instagram, NEW.instagram, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

	IF (OLD.twitter <> NEW.twitter or (OLD.twitter IS NULL and NEW.twitter IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('contatos', 'twitter', OLD.twitter, NEW.twitter, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

	IF (OLD.observacao <> NEW.observacao or (OLD.observacao IS NULL and NEW.observacao IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('contatos', 'observacao', OLD.observacao, NEW.observacao, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

	IF (OLD.status <> NEW.status or (OLD.status IS NULL and NEW.status IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('contatos', 'status', OLD.status, NEW.status, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

	IF (OLD.usuario_id <> NEW.usuario_id or (OLD.usuario_id IS NULL and NEW.usuario_id IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('contatos', 'usuario_id', OLD.usuario_id, NEW.usuario_id, now(), 'UPDATE', OLD.id, NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `contatos_AFTER_DELETE` AFTER DELETE ON `contatos` FOR EACH ROW BEGIN
	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
    VALUES
		('contatos', OLD.id, 'DELETE', 'id', OLD.id, now(), OLD.usuario_id),
        ('contatos', OLD.id, 'DELETE','descricao', OLD.descricao, now(), OLD.usuario_id),
        ('contatos', OLD.id, 'DELETE','telefone', OLD.telefone, now(), OLD.usuario_id),
        ('contatos', OLD.id, 'DELETE','celular', OLD.celular, now(), OLD.usuario_id),
        ('contatos', OLD.id, 'DELETE','whatsapp', OLD.whatsapp, now(), OLD.usuario_id),
        ('contatos', OLD.id, 'DELETE','email', OLD.email, now(), OLD.usuario_id),
        ('contatos', OLD.id, 'DELETE','facebook', OLD.facebook, now(), OLD.usuario_id),
        ('contatos', OLD.id, 'DELETE','instagram', OLD.instagram, now(), OLD.usuario_id),
        ('contatos', OLD.id, 'DELETE','twitter', OLD.twitter, now(), OLD.usuario_id),
        ('contatos', OLD.id, 'DELETE','observacao', OLD.observacao, now(), OLD.usuario_id),
        ('contatos', OLD.id, 'DELETE','status', OLD.status, now(), OLD.usuario_id),
        ('contatos', OLD.id, 'DELETE','usuario_id', OLD.usuario_id, now(), OLD.usuario_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

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
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`conte_pk_id`),
  KEY `conte_fk_page_pk_id_idx` (`conte_fk_page_pk_id`),
  KEY `fk_conteudos_usuario_idx` (`usuario_id`),
  CONSTRAINT `conte_fk_page_pk_id` FOREIGN KEY (`conte_fk_page_pk_id`) REFERENCES `page` (`page_pk_id`),
  CONSTRAINT `fk_conteudos_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (1,'destaques_servicos','destaques_servicos','','','1200x300.png','',0,3,1),(2,'modern_business','A empresa...','','    Para ser percebida como uma empresa social e ambientalmente responsável e atuante, a Natura parte da premissa de que os impactos ambientais de sua atividade decorrem de uma cadeia de transformações, da qual representa somente uma parte. Por isso, acredita que, para ter eficácia, as ações ambientais precisam: considerar cada cadeia produtiva de maneira integral.','750x450.png','',0,4,1),(3,'our_team','Nome do membro','Cargo do membro','Breve descrição do cardo do membro ou do próprio membro','750x450.png','',0,4,1),(4,'our_customers','our_customers','','','500x300.png','123',0,4,1),(5,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,0,4,1),(6,'our_team','Nome do membro','Cargo do membro','Breve descrição do cardo do membro ou do próprio membro','750x450.png','',0,4,1),(7,'our_team','Nome do membro','Cargo do membro','Breve descrição do cardo do membro ou do próprio membro','750x450.png','',0,4,1),(8,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,0,4,1),(9,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,0,4,1),(10,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,0,4,1),(11,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,0,4,1),(12,'slide_apresentacao','Primeiro Destaque','Descrição destaque','','1900x1080.png','',0,1,1),(13,'slide_apresentacao','Segundo Destaque','Descrição destaque 2','','1900x1080.png','',0,1,1),(14,'slide_apresentacao','Terceiro Destaque','Descrição destaque 3','','1900x1080.png','',0,1,1),(15,'outros_destaques','Outroes Destaque','','Descrição destaque 3\r\nDescrição destaque 3\r\nDescrição destaque 3\r\nDescrição destaque 3','','',0,1,1),(16,'nossos_destaques','nossos_destaques','','nossos_destaques','700x400.png','',0,1,1),(17,'nossos_servicos','nossos_servicos','nossos_servicos','nossos_servicos\r',NULL,'',0,3,1),(18,'our_contact','Nosso contato','Nosso contato','Nosso contato',NULL,NULL,0,2,1);
/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enderecos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(100) COLLATE utf8mb3_bin DEFAULT NULL,
  `numero` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `bairro` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cep` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `cidade_id` int DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_enderecos_cidade_idx` (`cidade_id`),
  KEY `fk_enderecos_usuario_idx` (`usuario_id`),
  CONSTRAINT `fk_enderecos_cidade` FOREIGN KEY (`cidade_id`) REFERENCES `cidades` (`id`),
  CONSTRAINT `fk_enderecos_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enderecos`
--

LOCK TABLES `enderecos` WRITE;
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
INSERT INTO `enderecos` VALUES (47,NULL,NULL,NULL,NULL,1,NULL,2);
/*!40000 ALTER TABLE `enderecos` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `enderecos_BEFORE_INSERT` BEFORE INSERT ON `enderecos` FOR EACH ROW BEGIN
    INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
  VALUES
      ('enderecos', NULL, 'INSERT','id', NEW.id, now(), NEW.usuario_id),
      ('enderecos', NULL, 'INSERT','logradouro', NEW.logradouro, now(), NEW.usuario_id),
      ('enderecos', NULL, 'INSERT','numero', NEW.numero, now(), NEW.usuario_id),
      ('enderecos', NULL, 'INSERT','bairro', NEW.bairro, now(), NEW.usuario_id),
      ('enderecos', NULL, 'INSERT','cep', NEW.cep, now(), NEW.usuario_id),
      ('enderecos', NULL, 'INSERT','status', NEW.status, now(), NEW.usuario_id),
      ('enderecos', NULL, 'INSERT','cidade_id', NEW.cidade_id, now(), NEW.usuario_id),
      ('enderecos', NULL, 'INSERT','usuario_id', NEW.usuario_id, now(), NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `enderecos_BEFORE_UPDATE` BEFORE UPDATE ON `enderecos` FOR EACH ROW BEGIN
    IF (OLD.logradouro <> NEW.logradouro or (OLD.logradouro IS NULL and NEW.logradouro IS NOT NULL)) THEN
		INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES 
			('enderecos', 'logradouro', OLD.logradouro, NEW.logradouro, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	 END IF;
    
	IF (OLD.numero <> NEW.numero or (OLD.numero IS NULL and NEW.numero IS NOT NULL)) THEN
			INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('enderecos', 'numero', OLD.numero, NEW.numero, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;
    
	IF (OLD.bairro <> NEW.bairro or (OLD.bairro IS NULL and NEW.bairro IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('enderecos', 'bairro', OLD.bairro, NEW.bairro, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

	IF (OLD.cep <> NEW.cep or (OLD.cep IS NULL and NEW.cep IS NOT NULL)) THEN
			INSERT INTO logs 
                        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES
            ('enderecos', 'cep', OLD.cep, NEW.cep, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;
    
	IF (OLD.status <> NEW.status or (OLD.status IS NULL and NEW.status IS NOT NULL)) THEN
			INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES
            ('enderecos', 'status', OLD.status, NEW.status, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

	IF (OLD.cidade_id <> NEW.cidade_id or (OLD.cidade_id IS NULL and NEW.cidade_id IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('enderecos', 'cidade_id', OLD.cidade_id, NEW.cidade_id, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

	IF (OLD.usuario_id <> NEW.usuario_id or (OLD.usuario_id IS NULL and NEW.usuario_id IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('enderecos', 'usuario_id', OLD.usuario_id, NEW.usuario_id, now(), 'UPDATE', OLD.id, NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `enderecos_BEFORE_DELETE` BEFORE DELETE ON `enderecos` FOR EACH ROW BEGIN

    	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
    VALUES
		('enderecos', OLD.id, 'DELETE', 'id', OLD.id, now(), OLD.usuario_id),
        ('enderecos', OLD.id, 'DELETE','logradouro', OLD.logradouro, now(), OLD.usuario_id),
        ('enderecos', OLD.id, 'DELETE','numero', OLD.numero, now(), OLD.usuario_id),
        ('enderecos', OLD.id, 'DELETE','bairro', OLD.bairro, now(), OLD.usuario_id),
        ('enderecos', OLD.id, 'DELETE','cep', OLD.cep, now(), OLD.usuario_id),
        ('enderecos', OLD.id, 'DELETE','status', OLD.status, now(), OLD.usuario_id),
        ('enderecos', OLD.id, 'DELETE','cidade_id', OLD.cidade_id, now(), OLD.usuario_id),
        ('enderecos', OLD.id, 'DELETE','usuario_id', OLD.usuario_id, now(), OLD.usuario_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `sigla` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `pais_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `esta_fk_pais_pk_id_idx` (`pais_id`),
  KEY `fk_estados_usuario_idx` (`usuario_id`),
  CONSTRAINT `fk_estados_pais` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`),
  CONSTRAINT `fk_estados_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` VALUES (1,'Acre','AC',0,1,1),(2,'Alagoas','AL',0,1,1),(3,'Amapá','AP',0,1,1),(4,'Amazonas','AM',0,1,1),(5,'Bahia','BA',0,1,1),(6,'Ceará','CE',1,1,1),(7,'Distrito Federal','DF',0,1,1),(8,'Espírito Santo','ES',0,1,1),(9,'Goiás','GO',0,1,1),(10,'Maranhão','MA',0,1,1),(11,'Mato Grosso','MT',0,1,1),(12,'Mato Grosso do Sul','MS',0,1,1),(13,'Minas Gerais','MG',0,1,1),(14,'Pará','PA',0,1,1),(15,'Paraíba','PB',0,1,1),(16,'Paraná','PR',0,1,1),(17,'Pernambuco','PE',0,1,1),(18,'Piauí','PI',0,1,1),(19,'Rio de Janeiro','RJ',0,1,1),(20,'Rio Grande do Norte','RN',0,1,1),(21,'Rio Grande do Sul','RS',0,1,1),(22,'Rondônia','RO',0,1,1),(23,'Roraima','RR',0,1,1),(24,'Santa Catarina','SC',0,1,1),(25,'São Paulo','SP',0,1,1),(26,'Sergipe','SE',0,1,1),(27,'Tocantins','TO',0,1,1);
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `estados_BEFORE_INSERT` BEFORE INSERT ON `estados` FOR EACH ROW BEGIN
	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao)
    VALUES
		('paises', NEW.id, 'INSERT', 'id', NEW.id, now()),
        ('paises', NEW.id, 'INSERT','nome', NEW.nome, now()),
        ('paises', NEW.id, 'INSERT','sigla', NEW.sigla, now()),
        ('paises', NEW.id, 'INSERT','status', NEW.status, now()),
        ('paises', NEW.id, 'INSERT','usuario_id', NEW.usuario_id, now()),
        ('paises', NEW.id, 'INSERT','pais_id', NEW.pais_id, now());
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `estados_BEFORE_UPDATE` BEFORE UPDATE ON `estados` FOR EACH ROW BEGIN
IF (OLD.nome <> NEW.nome or (OLD.nome IS NULL and NEW.nome IS NOT NULL)) THEN
		INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela)
        VALUES 
			('estados', 'nome', OLD.nome, NEW.nome, now(), 'UPDATE', OLD.id);
	 END IF;
    
	IF (OLD.sigla <> NEW.sigla or (OLD.sigla IS NULL and NEW.sigla IS NOT NULL)) THEN
			INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela)
            VALUES 
            ('estados', 'sigla', OLD.sigla, NEW.sigla, now(), 'UPDATE', OLD.id);
	END IF;
    
	IF (OLD.status <> NEW.status or (OLD.status IS NULL and NEW.status IS NOT NULL)) THEN
			INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela)
            VALUES
            ('estados', 'status', OLD.status, NEW.status, now(), 'UPDATE', OLD.id);
	END IF;
    
	IF (OLD.usuario_id <> NEW.usuario_id or (OLD.usuario_id IS NULL and NEW.usuario_id IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela)
            VALUES 
            ('estados', 'usuario_id', OLD.usuario_id, NEW.usuario_id, now(), 'UPDATE', OLD.id);
	END IF;

	IF (OLD.pais_id <> NEW.pais_id or (OLD.pais_id IS NULL and NEW.pais_id IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela)
            VALUES 
            ('estados', 'pais_id', OLD.pais_id, NEW.pais_id, now(), 'UPDATE', OLD.id);
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `estados_BEFORE_DELETE` BEFORE DELETE ON `estados` FOR EACH ROW BEGIN
	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao)
    VALUES
		('estados', OLD.id, 'DELETE', 'id', OLD.id, now()),
        ('estados', OLD.id, 'DELETE','nome', OLD.nome, now()),
        ('estados', OLD.id, 'DELETE','sigla', OLD.sigla, now()),
        ('estados', OLD.id, 'DELETE','status', OLD.status, now()),
        ('estados', OLD.id, 'DELETE','pais_id', OLD.pais_id, now()),
        ('estados', OLD.id, 'DELETE','usuario_id', OLD.usuario_id, now());
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

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
  PRIMARY KEY (`fopa_pk_id`)
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
  UNIQUE KEY `fuus_pk_id_UNIQUE` (`fuus_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=ascii COLLATE=ascii_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionario_user`
--

LOCK TABLES `funcionario_user` WRITE;
/*!40000 ALTER TABLE `funcionario_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `funcionario_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `pis` varchar(20) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `usuario_id` int NOT NULL,
  `endereco_id` int DEFAULT NULL,
  `contato_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  KEY `fk_funcionarios_endereco_id_idx` (`endereco_id`),
  KEY `fk_funcionarios_usuario_id_idx` (`usuario_id`),
  KEY `fk_funcionarios_usuario_idx` (`cpf`),
  KEY `fk_funcionarios_contato_idx` (`contato_id`),
  CONSTRAINT `fk_funcionarios_contato` FOREIGN KEY (`contato_id`) REFERENCES `contatos` (`id`),
  CONSTRAINT `fk_funcionarios_endereco_id` FOREIGN KEY (`endereco_id`) REFERENCES `enderecos` (`id`),
  CONSTRAINT `fk_funcionarios_usuario` FOREIGN KEY (`cpf`) REFERENCES `usuarios` (`cpf`),
  CONSTRAINT `fk_funcionarios_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` VALUES (21,'a','606.717.623-89',NULL,NULL,NULL,1,2,47,7);
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupos`
--

DROP TABLE IF EXISTS `grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_grupos_usuario_idx` (`usuario_id`),
  CONSTRAINT `fk_grupos_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupos`
--

LOCK TABLES `grupos` WRITE;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` VALUES (1,'TI',1,2),(2,'Administrador',1,2),(3,'Usuário',1,2),(4,'Funcionário',1,2),(5,'Marketing',1,2);
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `grupos_BEFORE_INSERT` BEFORE INSERT ON `grupos` FOR EACH ROW BEGIN
	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
    VALUES
		('grupos', NEW.id, 'INSERT', 'id', NEW.id, now(), NEW.usuario_id),
        ('grupos', NEW.id, 'INSERT','nome', NEW.nome, now(), NEW.usuario_id),
        ('grupos', NEW.id, 'INSERT','status', NEW.status, now(), NEW.usuario_id),
        ('grupos', NEW.id, 'INSERT','usuario_id', NEW.usuario_id, now(), NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `grupos_BEFORE_UPDATE` BEFORE UPDATE ON `grupos` FOR EACH ROW BEGIN
IF (OLD.nome <> NEW.nome or (OLD.nome IS NULL and NEW.nome IS NOT NULL)) THEN
INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
    VALUES 
  ('grupos', 'nome', OLD.nome, NEW.nome, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.status <> NEW.status or (OLD.status IS NULL and NEW.status IS NOT NULL)) THEN
  INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES
        ('grupos', 'status', OLD.status, NEW.status, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.usuario_id <> NEW.usuario_id or (OLD.usuario_id IS NULL and NEW.usuario_id IS NOT NULL)) THEN
  INSERT INTO logs 
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES 
        ('grupos', 'usuario_id', OLD.usuario_id, NEW.usuario_id, now(), 'UPDATE', OLD.id, NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `grupos_BEFORE_DELETE` BEFORE DELETE ON `grupos` FOR EACH ROW BEGIN
	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
    VALUES
		('grupos', OLD.id, 'DELETE', 'id', OLD.id, now(), OLD.usuario_id),
        ('grupos', OLD.id, 'DELETE','nome', OLD.nome, now(), OLD.usuario_id),
        ('grupos', OLD.id, 'DELETE','status', OLD.status, now(), OLD.usuario_id),
        ('grupos', OLD.id, 'DELETE','usuario_id', OLD.usuario_id, now(), OLD.usuario_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `grupos_permissoes`
--

DROP TABLE IF EXISTS `grupos_permissoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupos_permissoes` (
  `grupo_id` int NOT NULL,
  `permissao_id` int NOT NULL,
  `usuario_id` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`grupo_id`,`permissao_id`),
  KEY `fk_grupos_permissoes_usuario_idx` (`usuario_id`),
  KEY `fk_grupos_permissoes_permissao_idx` (`permissao_id`),
  CONSTRAINT `fk_grupos_permissoes_grupo` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`),
  CONSTRAINT `fk_grupos_permissoes_permissao` FOREIGN KEY (`permissao_id`) REFERENCES `permissoes` (`id`),
  CONSTRAINT `fk_grupos_permissoes_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupos_permissoes`
--

LOCK TABLES `grupos_permissoes` WRITE;
/*!40000 ALTER TABLE `grupos_permissoes` DISABLE KEYS */;
INSERT INTO `grupos_permissoes` VALUES (1,17,2,1),(1,18,2,1),(1,19,2,1),(1,20,2,1),(1,21,2,1),(1,22,2,1),(1,23,2,1),(1,24,2,1),(1,25,2,1),(1,26,2,1),(1,27,2,1),(1,28,2,1),(1,29,2,1),(1,30,2,1),(1,31,2,1),(1,33,2,1),(1,34,2,1),(1,35,2,1),(1,36,2,1),(1,37,2,1),(1,38,2,1),(1,39,2,1),(1,40,2,1),(2,17,2,1),(2,18,2,1),(2,19,2,1),(2,20,2,1),(3,18,2,1),(3,19,2,1),(3,20,2,1),(4,17,2,1),(4,18,2,1),(4,19,2,1),(4,20,2,1),(5,18,2,1),(5,19,2,1),(5,20,2,1),(5,24,2,1),(5,25,2,1),(5,37,2,1),(5,38,2,1),(5,39,2,1),(5,40,2,1);
/*!40000 ALTER TABLE `grupos_permissoes` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `grupos_permissoes_BEFORE_INSERT` BEFORE INSERT ON `grupos_permissoes` FOR EACH ROW BEGIN
  INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
  VALUES
      ('usuarios_permissoes', NULL, 'INSERT','status', NEW.status, now(), NEW.usuario_id),
      ('usuarios_permissoes', NULL, 'INSERT','usuario_id', NEW.usuario_id, now(), NEW.usuario_id),
      ('usuarios_permissoes', NULL, 'INSERT','grupo_id', NEW.grupo_id, now(), NEW.usuario_id),
      ('usuarios_permissoes', NULL, 'INSERT','permissao_id', NEW.permissao_id, now(), NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `grupos_permissoes_BEFORE_UPDATE` BEFORE UPDATE ON `grupos_permissoes` FOR EACH ROW BEGIN
IF (OLD.status <> NEW.status or (OLD.status IS NULL and NEW.status IS NOT NULL)) THEN
			INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES
            ('usuarios_grupos', 'status', OLD.status, NEW.status, now(), 'UPDATE', CONCAT(NEW.grupo_id, NEW.permissao_id), NEW.usuario_id);
	END IF;

  IF (OLD.usuario_id <> NEW.usuario_id or (OLD.usuario_id IS NULL and NEW.usuario_id IS NOT NULL)) THEN
    INSERT INTO logs 
          (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
          VALUES 
          ('usuarios_grupos', 'usuario_id', OLD.usuario_id, NEW.usuario_id, now(), 'UPDATE', CONCAT(NEW.grupo_id, NEW.permissao_id), NEW.usuario_id);
  END IF;

	IF (OLD.grupo_id <> NEW.grupo_id or (OLD.grupo_id IS NULL and NEW.grupo_id IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('usuarios_grupos', 'grupo_id', OLD.grupo_id, NEW.grupo_id, now(), 'UPDATE', CONCAT(NEW.grupo_id, NEW.permissao_id), NEW.usuario_id);
	END IF;

  	IF (OLD.permissao_id <> NEW.permissao_id or (OLD.permissao_id IS NULL and NEW.permissao_id IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('usuarios_grupos', 'permissao_id', OLD.permissao_id, NEW.permissao_id, now(), 'UPDATE', CONCAT(NEW.grupo_id, NEW.permissao_id), NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `grupos_permissoes_BEFORE_DELETE` BEFORE DELETE ON `grupos_permissoes` FOR EACH ROW BEGIN
	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
    VALUES
        ('grupos_permissoes', OLD.usuario_id, 'DELETE','usuario_id', OLD.usuario_id, now(), OLD.usuario_id),
        ('grupos_permissoes', OLD.grupo_id, 'DELETE','grupo_id', OLD.grupo_id, now(), OLD.usuario_id),
        ('grupos_permissoes', OLD.grupo_id, 'DELETE','permissao_id', OLD.permissao_id, now(), OLD.usuario_id),
        ('grupos_permissoes', OLD.status, 'DELETE','status', OLD.status, now(), OLD.usuario_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nome_tabela` varchar(100) DEFAULT NULL,
  `id_tabela` int DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  `operacao` varchar(6) DEFAULT NULL,
  `campo_modificado` varchar(45) DEFAULT NULL,
  `valor_antigo` text,
  `valor_atual` text,
  `data_operacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1951 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'menus',3,NULL,'UPDATE','descricao','Outras operações','1','2023-04-04 22:37:46'),(2,'menus',3,NULL,'UPDATE','descricao','1','Outras operações','2023-04-04 22:38:20'),(3,'menus',3,NULL,'UPDATE','status','0','1','2023-04-04 22:38:57'),(4,'menus',0,2,'INSERT','id','0',NULL,'2023-04-04 22:49:18'),(5,'menus',0,2,'INSERT','nome','a',NULL,'2023-04-04 22:49:18'),(6,'menus',0,2,'INSERT','descricao','a',NULL,'2023-04-04 22:49:18'),(7,'menus',0,2,'INSERT','status','1',NULL,'2023-04-04 22:49:18'),(8,'menus',0,2,'INSERT','class','a',NULL,'2023-04-04 22:49:18'),(9,'menus',0,2,'INSERT','url','a',NULL,'2023-04-04 22:49:18'),(10,'menus',0,2,'INSERT','image','',NULL,'2023-04-04 22:49:18'),(11,'menus',0,2,'INSERT','icone','a',NULL,'2023-04-04 22:49:18'),(12,'menus',0,2,'INSERT','sistema_id','1',NULL,'2023-04-04 22:49:18'),(13,'menus',0,2,'INSERT','usuario_id','2',NULL,'2023-04-04 22:49:18'),(14,'menus',0,2,'INSERT','id','0',NULL,'2023-04-04 22:50:07'),(15,'menus',0,2,'INSERT','nome','a',NULL,'2023-04-04 22:50:07'),(16,'menus',0,2,'INSERT','descricao','a',NULL,'2023-04-04 22:50:07'),(17,'menus',0,2,'INSERT','status','1',NULL,'2023-04-04 22:50:07'),(18,'menus',0,2,'INSERT','class','a',NULL,'2023-04-04 22:50:07'),(19,'menus',0,2,'INSERT','url','a',NULL,'2023-04-04 22:50:07'),(20,'menus',0,2,'INSERT','image','',NULL,'2023-04-04 22:50:07'),(21,'menus',0,2,'INSERT','icone','a',NULL,'2023-04-04 22:50:07'),(22,'menus',0,2,'INSERT','sistema_id','1',NULL,'2023-04-04 22:50:07'),(23,'menus',0,2,'INSERT','usuario_id','2',NULL,'2023-04-04 22:50:07'),(24,'menus',6,2,'UPDATE','status','1','0','2023-04-04 22:54:22'),(25,'menus',6,2,'DELETE','id','6',NULL,'2023-04-04 22:54:30'),(26,'menus',6,2,'DELETE','nome','a',NULL,'2023-04-04 22:54:30'),(27,'menus',6,2,'DELETE','descricao','a',NULL,'2023-04-04 22:54:30'),(28,'menus',6,2,'DELETE','status','0',NULL,'2023-04-04 22:54:30'),(29,'menus',6,2,'DELETE','class','a',NULL,'2023-04-04 22:54:30'),(30,'menus',6,2,'DELETE','url','a',NULL,'2023-04-04 22:54:30'),(31,'menus',6,2,'DELETE','image','',NULL,'2023-04-04 22:54:30'),(32,'menus',6,2,'DELETE','icone','a',NULL,'2023-04-04 22:54:30'),(33,'menus',6,2,'DELETE','sistema_id','1',NULL,'2023-04-04 22:54:30'),(34,'menus',6,2,'DELETE','usuario_id','2',NULL,'2023-04-04 22:54:30'),(35,'menus',7,2,'UPDATE','status','1','0','2023-04-04 22:54:53'),(36,'menus',7,2,'DELETE','id','7',NULL,'2023-04-04 22:55:00'),(37,'menus',7,2,'DELETE','nome','a',NULL,'2023-04-04 22:55:00'),(38,'menus',7,2,'DELETE','descricao','a',NULL,'2023-04-04 22:55:00'),(39,'menus',7,2,'DELETE','status','0',NULL,'2023-04-04 22:55:00'),(40,'menus',7,2,'DELETE','class','a',NULL,'2023-04-04 22:55:00'),(41,'menus',7,2,'DELETE','url','a',NULL,'2023-04-04 22:55:00'),(42,'menus',7,2,'DELETE','image','',NULL,'2023-04-04 22:55:00'),(43,'menus',7,2,'DELETE','icone','a',NULL,'2023-04-04 22:55:00'),(44,'menus',7,2,'DELETE','sistema_id','1',NULL,'2023-04-04 22:55:00'),(45,'menus',7,2,'DELETE','usuario_id','2',NULL,'2023-04-04 22:55:00'),(46,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-04 20:16:35','2023-04-04 23:01:22','2023-04-04 23:01:22'),(47,'menus',0,2,'INSERT','id','0',NULL,'2023-04-04 23:04:03'),(48,'menus',0,2,'INSERT','nome','Itens de Menu',NULL,'2023-04-04 23:04:03'),(49,'menus',0,2,'INSERT','descricao','Cadastro de Itens de Menu',NULL,'2023-04-04 23:04:03'),(50,'menus',0,2,'INSERT','status','1',NULL,'2023-04-04 23:04:03'),(51,'menus',0,2,'INSERT','class','',NULL,'2023-04-04 23:04:03'),(52,'menus',0,2,'INSERT','url','',NULL,'2023-04-04 23:04:03'),(53,'menus',0,2,'INSERT','image','',NULL,'2023-04-04 23:04:03'),(54,'menus',0,2,'INSERT','icone','fas fa-list-dropdown fa-fw',NULL,'2023-04-04 23:04:03'),(55,'menus',0,2,'INSERT','sistema_id','1',NULL,'2023-04-04 23:04:03'),(56,'menus',0,2,'INSERT','usuario_id','2',NULL,'2023-04-04 23:04:03'),(57,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-04 23:01:22','2023-04-04 23:05:59','2023-04-04 23:05:59'),(58,'menu_itens',18,1,'INSERT','id','18',NULL,'2023-04-04 23:11:10'),(59,'menu_itens',18,1,'INSERT','nome','Itens de Menu',NULL,'2023-04-04 23:11:10'),(60,'menu_itens',18,1,'INSERT','descricao','Cadastro de Itens de Menu do Sistema',NULL,'2023-04-04 23:11:10'),(61,'menu_itens',18,1,'INSERT','status','1',NULL,'2023-04-04 23:11:10'),(62,'menu_itens',18,1,'INSERT','class',NULL,NULL,'2023-04-04 23:11:10'),(63,'menu_itens',18,1,'INSERT','titulo',NULL,NULL,'2023-04-04 23:11:10'),(64,'menu_itens',18,1,'INSERT','url','?page=ControllerMenuItem&option=listar',NULL,'2023-04-04 23:11:10'),(65,'menu_itens',18,1,'INSERT','image',NULL,NULL,'2023-04-04 23:11:10'),(66,'menu_itens',18,1,'INSERT','icone','fas fa-list-dropdown fa-sm fa-fw mr-2 text-gray-400',NULL,'2023-04-04 23:11:10'),(67,'menu_itens',18,1,'INSERT','menu_item_id',NULL,NULL,'2023-04-04 23:11:10'),(68,'menu_itens',18,1,'INSERT','menu_id','2',NULL,'2023-04-04 23:11:10'),(69,'menu_itens',18,1,'INSERT','usuario_id','1',NULL,'2023-04-04 23:11:10'),(70,'menu_itens',18,1,'UPDATE','icone','fas fa-list-dropdown fa-sm fa-fw mr-2 text-gray-400','fas fa-dropdown fa-sm fa-fw mr-2 text-gray-400','2023-04-05 00:00:54'),(71,'menu_itens',18,1,'UPDATE','icone','fas fa-dropdown fa-sm fa-fw mr-2 text-gray-400','fas fa-list-dropdown fa-sm fa-fw mr-2 text-gray-400','2023-04-05 00:02:48'),(72,'menu_itens',18,1,'UPDATE','icone','fas fa-list-dropdown fa-sm fa-fw mr-2 text-gray-400','fas fa-elementor fa-sm fa-fw mr-2 text-gray-400','2023-04-05 00:09:28'),(73,'menu_itens',18,1,'UPDATE','icone','fas fa-elementor fa-sm fa-fw mr-2 text-gray-400','fas fa-list fa-sm fa-fw mr-2 text-gray-400','2023-04-05 00:12:19'),(74,'menu_itens',12,2,'UPDATE','status','1','0','2023-04-05 01:27:54'),(75,'menu_itens',12,2,'UPDATE','usuario_id','1','2','2023-04-05 01:27:54'),(76,'menu_itens',12,2,'UPDATE','status','0','1','2023-04-05 01:31:00'),(77,'menu_itens',2,2,'UPDATE','status','1','0','2023-04-05 01:31:48'),(78,'menu_itens',2,2,'UPDATE','usuario_id','1','2','2023-04-05 01:31:48'),(79,'menu_itens',0,2,'INSERT','id','0',NULL,'2023-04-05 02:04:06'),(80,'menu_itens',0,2,'INSERT','nome','a',NULL,'2023-04-05 02:04:06'),(81,'menu_itens',0,2,'INSERT','descricao','a',NULL,'2023-04-05 02:04:06'),(82,'menu_itens',0,2,'INSERT','status','0',NULL,'2023-04-05 02:04:06'),(83,'menu_itens',0,2,'INSERT','class','a',NULL,'2023-04-05 02:04:06'),(84,'menu_itens',0,2,'INSERT','titulo','s',NULL,'2023-04-05 02:04:06'),(85,'menu_itens',0,2,'INSERT','url','a',NULL,'2023-04-05 02:04:06'),(86,'menu_itens',0,2,'INSERT','image','',NULL,'2023-04-05 02:04:06'),(87,'menu_itens',0,2,'INSERT','icone','a',NULL,'2023-04-05 02:04:06'),(88,'menu_itens',0,2,'INSERT','menu_item_id','1',NULL,'2023-04-05 02:04:06'),(89,'menu_itens',0,2,'INSERT','menu_id','8',NULL,'2023-04-05 02:04:06'),(90,'menu_itens',0,2,'INSERT','usuario_id','2',NULL,'2023-04-05 02:04:06'),(91,'menu_itens',20,2,'UPDATE','menu_item_id','1','0','2023-04-05 02:14:34'),(92,'menu_itens',20,2,'UPDATE','nome','a','ab','2023-04-05 02:14:46'),(93,'menu_itens',20,2,'UPDATE','descricao','a','ab','2023-04-05 02:14:46'),(94,'menu_itens',20,2,'UPDATE','titulo','s','sb','2023-04-05 02:14:46'),(95,'menu_itens',20,2,'UPDATE','class','a','ab','2023-04-05 02:14:46'),(96,'menu_itens',20,2,'UPDATE','url','a','ab','2023-04-05 02:14:46'),(97,'menu_itens',20,2,'UPDATE','icone','a','ab','2023-04-05 02:14:46'),(98,'menu_itens',20,2,'UPDATE','menu_id','8','1','2023-04-05 02:14:54'),(99,'menu_itens',20,2,'UPDATE','menu_id','1','3','2023-04-05 02:15:02'),(100,'menu_itens',20,2,'UPDATE','menu_item_id','0','18','2023-04-05 02:16:26'),(101,'menu_itens',20,2,'UPDATE','menu_item_id','18','0','2023-04-05 02:16:37'),(102,'menu_itens',2,2,'UPDATE','status','0','1','2023-04-05 02:16:58'),(103,'menu_itens',20,2,'DELETE','id','20',NULL,'2023-04-05 02:17:07'),(104,'menu_itens',20,2,'DELETE','nome','ab',NULL,'2023-04-05 02:17:07'),(105,'menu_itens',20,2,'DELETE','descricao','ab',NULL,'2023-04-05 02:17:07'),(106,'menu_itens',20,2,'DELETE','status','0',NULL,'2023-04-05 02:17:07'),(107,'menu_itens',20,2,'DELETE','titulo','sb',NULL,'2023-04-05 02:17:07'),(108,'menu_itens',20,2,'DELETE','class','ab',NULL,'2023-04-05 02:17:07'),(109,'menu_itens',20,2,'DELETE','url','ab',NULL,'2023-04-05 02:17:07'),(110,'menu_itens',20,2,'DELETE','image','',NULL,'2023-04-05 02:17:07'),(111,'menu_itens',20,2,'DELETE','icone','ab',NULL,'2023-04-05 02:17:07'),(112,'menu_itens',20,2,'DELETE','menu_item_id','0',NULL,'2023-04-05 02:17:07'),(113,'menu_itens',20,2,'DELETE','menu_id','3',NULL,'2023-04-05 02:17:07'),(114,'menu_itens',20,2,'DELETE','usuario_id','2',NULL,'2023-04-05 02:17:07'),(115,'menu_itens',18,2,'UPDATE','status','1','0','2023-04-05 02:21:43'),(116,'menu_itens',18,2,'UPDATE','usuario_id','1','2','2023-04-05 02:21:43'),(117,'menu_itens',18,2,'UPDATE','status','0','1','2023-04-05 02:22:55'),(118,'menus',5,2,'UPDATE','status','1','0','2023-04-05 02:23:08'),(119,'menus',5,2,'UPDATE','usuario_id','1','2','2023-04-05 02:23:08'),(120,'menu_itens',0,2,'INSERT','id','0',NULL,'2023-04-05 02:35:22'),(121,'menu_itens',0,2,'INSERT','nome','Grupos',NULL,'2023-04-05 02:35:22'),(122,'menu_itens',0,2,'INSERT','descricao','Cadastro de grupos',NULL,'2023-04-05 02:35:22'),(123,'menu_itens',0,2,'INSERT','status','0',NULL,'2023-04-05 02:35:22'),(124,'menu_itens',0,2,'INSERT','class','',NULL,'2023-04-05 02:35:22'),(125,'menu_itens',0,2,'INSERT','titulo','',NULL,'2023-04-05 02:35:22'),(126,'menu_itens',0,2,'INSERT','url','',NULL,'2023-04-05 02:35:22'),(127,'menu_itens',0,2,'INSERT','image','',NULL,'2023-04-05 02:35:22'),(128,'menu_itens',0,2,'INSERT','icone','',NULL,'2023-04-05 02:35:22'),(129,'menu_itens',0,2,'INSERT','menu_item_id','0',NULL,'2023-04-05 02:35:22'),(130,'menu_itens',0,2,'INSERT','menu_id','2',NULL,'2023-04-05 02:35:22'),(131,'menu_itens',0,2,'INSERT','usuario_id','2',NULL,'2023-04-05 02:35:22'),(132,'menu_itens',17,2,'UPDATE','status','1','0','2023-04-05 02:36:52'),(133,'menu_itens',17,2,'UPDATE','usuario_id','1','2','2023-04-05 02:36:52'),(134,'menu_itens',21,2,'UPDATE','icone','','fas fa-group fa-sm fa-fw mr-2 text-gray-400','2023-04-05 02:37:34'),(135,'menu_itens',21,2,'UPDATE','status','0','1','2023-04-05 02:37:48'),(136,'menu_itens',21,2,'UPDATE','status','1','0','2023-04-05 02:40:11'),(137,'menu_itens',21,2,'UPDATE','icone','fas fa-group fa-sm fa-fw mr-2 text-gray-400','fas fa-layer-group fa-sm fa-fw mr-2 text-gray-400','2023-04-05 02:40:32'),(138,'menu_itens',21,2,'UPDATE','status','0','1','2023-04-05 02:40:37'),(139,'menu_itens',21,2,'UPDATE','status','1','0','2023-04-05 02:41:18'),(140,'menu_itens',21,2,'UPDATE','url','','?page=ControllerGrupo&option=listar','2023-04-05 02:41:47'),(141,'menu_itens',21,2,'UPDATE','status','0','1','2023-04-05 02:41:49'),(142,'grupos',0,2,'INSERT','id','0',NULL,'2023-04-05 02:54:27'),(143,'grupos',0,2,'INSERT','nome','',NULL,'2023-04-05 02:54:27'),(144,'grupos',0,2,'INSERT','status','1',NULL,'2023-04-05 02:54:27'),(145,'grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-05 02:54:27'),(146,'grupos',0,2,'INSERT','id','0',NULL,'2023-04-05 02:54:38'),(147,'grupos',0,2,'INSERT','nome','a',NULL,'2023-04-05 02:54:38'),(148,'grupos',0,2,'INSERT','status','1',NULL,'2023-04-05 02:54:38'),(149,'grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-05 02:54:38'),(150,'grupos',1,NULL,'UPDATE','status','1','0','2023-04-05 02:56:32'),(151,'grupos',2,NULL,'UPDATE','status','1','0','2023-04-05 02:56:48'),(152,'grupos',1,1,'UPDATE','usuario_id',NULL,'1','2023-04-05 03:00:37'),(153,'grupos',2,1,'UPDATE','usuario_id',NULL,'1','2023-04-05 03:00:37'),(154,'grupos',2,2,'UPDATE','status','0','1','2023-04-05 03:01:41'),(155,'grupos',2,2,'UPDATE','usuario_id','1','2','2023-04-05 03:01:41'),(156,'grupos',2,NULL,'UPDATE','status','1','0','2023-04-05 03:02:08'),(157,'grupos',2,2,'UPDATE','usuario_id',NULL,'2','2023-04-05 03:03:06'),(158,'grupos',2,2,'UPDATE','status','0','1','2023-04-05 03:03:12'),(159,'grupos',2,2,'UPDATE','status','1','0','2023-04-05 03:03:16'),(160,'grupos',1,1,'UPDATE','nome','','a','2023-04-05 03:09:08'),(161,'grupos',1,2,'UPDATE','status','0','1','2023-04-05 03:11:03'),(162,'grupos',1,2,'UPDATE','usuario_id','1','2','2023-04-05 03:11:03'),(163,'grupos',1,2,'UPDATE','status','1','0','2023-04-05 03:11:08'),(164,'grupos',1,2,'DELETE','id','1',NULL,'2023-04-05 03:12:20'),(165,'grupos',1,2,'DELETE','nome','a',NULL,'2023-04-05 03:12:20'),(166,'grupos',1,2,'DELETE','status','0',NULL,'2023-04-05 03:12:20'),(167,'grupos',1,2,'DELETE','usuario_id','2',NULL,'2023-04-05 03:12:20'),(168,'grupos',2,2,'DELETE','id','2',NULL,'2023-04-05 03:12:27'),(169,'grupos',2,2,'DELETE','nome','a',NULL,'2023-04-05 03:12:27'),(170,'grupos',2,2,'DELETE','status','0',NULL,'2023-04-05 03:12:27'),(171,'grupos',2,2,'DELETE','usuario_id','2',NULL,'2023-04-05 03:12:27'),(172,'grupos',0,2,'INSERT','id','0',NULL,'2023-04-05 03:12:33'),(173,'grupos',0,2,'INSERT','nome','a',NULL,'2023-04-05 03:12:33'),(174,'grupos',0,2,'INSERT','status','1',NULL,'2023-04-05 03:12:33'),(175,'grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-05 03:12:33'),(176,'grupos',3,2,'UPDATE','status','1','0','2023-04-05 03:12:36'),(177,'grupos',3,2,'UPDATE','nome','a','aa','2023-04-05 03:15:20'),(178,'grupos',3,2,'UPDATE','nome','aa','ab','2023-04-05 03:15:55'),(179,'grupos',3,2,'UPDATE','nome','ab','aaaa','2023-04-05 03:16:14'),(180,'grupos',3,2,'UPDATE','nome','aaaa','ab','2023-04-05 03:16:18'),(181,'grupos',3,2,'UPDATE','nome','ab','blablabla','2023-04-05 03:17:07'),(182,'grupos',3,2,'UPDATE','status','0','1','2023-04-05 03:17:10'),(183,'grupos',3,2,'UPDATE','status','1','0','2023-04-05 03:17:15'),(184,'grupos',3,2,'DELETE','id','3',NULL,'2023-04-05 03:17:19'),(185,'grupos',3,2,'DELETE','nome','blablabla',NULL,'2023-04-05 03:17:19'),(186,'grupos',3,2,'DELETE','status','0',NULL,'2023-04-05 03:17:19'),(187,'grupos',3,2,'DELETE','usuario_id','2',NULL,'2023-04-05 03:17:19'),(188,'menu_itens',9,2,'UPDATE','status','1','0','2023-04-05 03:19:24'),(189,'menu_itens',9,2,'UPDATE','usuario_id','1','2','2023-04-05 03:19:24'),(190,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-04 23:05:59','2023-04-05 09:44:41','2023-04-05 09:44:41'),(191,'menu_itens',17,2,'UPDATE','status','0','1','2023-04-05 09:45:44'),(192,'menu_itens',21,2,'UPDATE','status','1','0','2023-04-05 09:45:59'),(193,'menu_itens',21,2,'UPDATE','nome','Grupos','Grupos de Permissões','2023-04-05 09:46:24'),(194,'menu_itens',21,2,'UPDATE','status','0','1','2023-04-05 09:46:33'),(195,'menu_itens',0,2,'INSERT','id','0',NULL,'2023-04-05 09:51:36'),(196,'menu_itens',0,2,'INSERT','nome','Grupos com Permissões',NULL,'2023-04-05 09:51:36'),(197,'menu_itens',0,2,'INSERT','descricao','Cadastro de grupos a permissões',NULL,'2023-04-05 09:51:36'),(198,'menu_itens',0,2,'INSERT','status','0',NULL,'2023-04-05 09:51:36'),(199,'menu_itens',0,2,'INSERT','class','',NULL,'2023-04-05 09:51:36'),(200,'menu_itens',0,2,'INSERT','titulo','',NULL,'2023-04-05 09:51:36'),(201,'menu_itens',0,2,'INSERT','url','?page=ControllerGurpoPermissao&option=listar',NULL,'2023-04-05 09:51:36'),(202,'menu_itens',0,2,'INSERT','image','',NULL,'2023-04-05 09:51:36'),(203,'menu_itens',0,2,'INSERT','icone','fas fa-file-code fa-sm fa-fw mr-2 text-gray-400',NULL,'2023-04-05 09:51:36'),(204,'menu_itens',0,2,'INSERT','menu_item_id','0',NULL,'2023-04-05 09:51:36'),(205,'menu_itens',0,2,'INSERT','menu_id','2',NULL,'2023-04-05 09:51:36'),(206,'menu_itens',0,2,'INSERT','usuario_id','2',NULL,'2023-04-05 09:51:36'),(207,'menu_itens',22,2,'UPDATE','icone','fas fa-file-code fa-sm fa-fw mr-2 text-gray-400','fas fa-share fa-sm fa-fw mr-2 text-gray-400','2023-04-05 09:54:36'),(208,'menu_itens',22,2,'UPDATE','status','0','1','2023-04-05 09:54:38'),(209,'menu_itens',22,2,'UPDATE','status','1','0','2023-04-05 10:26:29'),(210,'menu_itens',22,2,'UPDATE','url','?page=ControllerGurpoPermissao&option=listar','?page=ControllerGrupoPermissao&option=listar','2023-04-05 10:26:50'),(211,'menu_itens',22,2,'UPDATE','status','0','1','2023-04-05 10:27:30'),(212,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-05 09:44:41','2023-04-06 00:05:30','2023-04-06 00:05:30'),(213,'menu_itens',22,2,'UPDATE','status','1','0','2023-04-06 00:12:52'),(214,'menu_itens',22,2,'DELETE','id','22',NULL,'2023-04-06 00:12:59'),(215,'menu_itens',22,2,'DELETE','nome','Grupos com Permissões',NULL,'2023-04-06 00:12:59'),(216,'menu_itens',22,2,'DELETE','descricao','Cadastro de grupos a permissões',NULL,'2023-04-06 00:12:59'),(217,'menu_itens',22,2,'DELETE','status','0',NULL,'2023-04-06 00:12:59'),(218,'menu_itens',22,2,'DELETE','titulo','',NULL,'2023-04-06 00:12:59'),(219,'menu_itens',22,2,'DELETE','class','',NULL,'2023-04-06 00:12:59'),(220,'menu_itens',22,2,'DELETE','url','?page=ControllerGrupoPermissao&option=listar',NULL,'2023-04-06 00:12:59'),(221,'menu_itens',22,2,'DELETE','image','',NULL,'2023-04-06 00:12:59'),(222,'menu_itens',22,2,'DELETE','icone','fas fa-share fa-sm fa-fw mr-2 text-gray-400',NULL,'2023-04-06 00:12:59'),(223,'menu_itens',22,2,'DELETE','menu_item_id','0',NULL,'2023-04-06 00:12:59'),(224,'menu_itens',22,2,'DELETE','menu_id','2',NULL,'2023-04-06 00:12:59'),(225,'menu_itens',22,2,'DELETE','usuario_id','2',NULL,'2023-04-06 00:12:59'),(226,'grupos',0,2,'INSERT','id','0',NULL,'2023-04-06 01:08:25'),(227,'grupos',0,2,'INSERT','nome','teste',NULL,'2023-04-06 01:08:25'),(228,'grupos',0,2,'INSERT','status','1',NULL,'2023-04-06 01:08:25'),(229,'grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-06 01:08:25'),(230,'grupos',0,2,'INSERT','id','0',NULL,'2023-04-06 01:28:56'),(231,'grupos',0,2,'INSERT','nome','asdasdsda',NULL,'2023-04-06 01:28:56'),(232,'grupos',0,2,'INSERT','status','1',NULL,'2023-04-06 01:28:56'),(233,'grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-06 01:28:56'),(234,'grupos',0,2,'INSERT','id','0',NULL,'2023-04-06 01:29:08'),(235,'grupos',0,2,'INSERT','nome','asdasdsda',NULL,'2023-04-06 01:29:08'),(236,'grupos',0,2,'INSERT','status','1',NULL,'2023-04-06 01:29:08'),(237,'grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-06 01:29:08'),(238,'grupos',0,2,'INSERT','id','0',NULL,'2023-04-06 01:29:25'),(239,'grupos',0,2,'INSERT','nome','asdasdsda',NULL,'2023-04-06 01:29:25'),(240,'grupos',0,2,'INSERT','status','1',NULL,'2023-04-06 01:29:25'),(241,'grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-06 01:29:25'),(242,'grupos',0,2,'INSERT','id','0',NULL,'2023-04-06 01:29:30'),(243,'grupos',0,2,'INSERT','nome','asdasdsda',NULL,'2023-04-06 01:29:30'),(244,'grupos',0,2,'INSERT','status','1',NULL,'2023-04-06 01:29:30'),(245,'grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-06 01:29:30'),(246,'usuarios',1,NULL,'UPDATE','ultimo_acesso','2023-04-04 20:16:01','2023-04-07 14:00:33','2023-04-07 14:00:33'),(247,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-06 00:05:30','2023-04-07 14:05:20','2023-04-07 14:05:20'),(248,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-07 14:05:20','2023-04-07 14:34:10','2023-04-07 14:34:10'),(249,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-07 14:34:10','2023-04-07 14:38:00','2023-04-07 14:38:00'),(250,'usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 15:22:34'),(251,'usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','1',NULL,'2023-04-07 15:22:34'),(252,'usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','4',NULL,'2023-04-07 15:22:34'),(253,'usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','9',NULL,'2023-04-07 15:22:34'),(254,'permissoes',9,1,'UPDATE','status','0','1','2023-04-07 15:23:35'),(255,'permissoes',NULL,1,'INSERT','id','0',NULL,'2023-04-07 15:33:46'),(256,'permissoes',NULL,1,'INSERT','nome','4',NULL,'2023-04-07 15:33:46'),(257,'permissoes',NULL,1,'INSERT','descricao','4',NULL,'2023-04-07 15:33:46'),(258,'permissoes',NULL,1,'INSERT','status','1',NULL,'2023-04-07 15:33:46'),(259,'permissoes',NULL,1,'INSERT','menu_item_id','16',NULL,'2023-04-07 15:33:46'),(260,'permissoes',NULL,1,'INSERT','usuario_id','1',NULL,'2023-04-07 15:33:46'),(261,'permissoes',NULL,1,'INSERT','id','0',NULL,'2023-04-07 15:33:46'),(262,'permissoes',NULL,1,'INSERT','nome','5',NULL,'2023-04-07 15:33:46'),(263,'permissoes',NULL,1,'INSERT','descricao','5',NULL,'2023-04-07 15:33:46'),(264,'permissoes',NULL,1,'INSERT','status','1',NULL,'2023-04-07 15:33:46'),(265,'permissoes',NULL,1,'INSERT','menu_item_id','16',NULL,'2023-04-07 15:33:46'),(266,'permissoes',NULL,1,'INSERT','usuario_id','1',NULL,'2023-04-07 15:33:46'),(267,'usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 15:34:39'),(268,'usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','1',NULL,'2023-04-07 15:34:39'),(269,'usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','4',NULL,'2023-04-07 15:34:39'),(270,'usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','16',NULL,'2023-04-07 15:34:39'),(271,'usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 15:34:39'),(272,'usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','1',NULL,'2023-04-07 15:34:39'),(273,'usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','4',NULL,'2023-04-07 15:34:39'),(274,'usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','17',NULL,'2023-04-07 15:34:39'),(275,'permissoes',NULL,1,'INSERT','id','0',NULL,'2023-04-07 15:35:23'),(276,'permissoes',NULL,1,'INSERT','nome','6',NULL,'2023-04-07 15:35:23'),(277,'permissoes',NULL,1,'INSERT','descricao','6',NULL,'2023-04-07 15:35:23'),(278,'permissoes',NULL,1,'INSERT','status','1',NULL,'2023-04-07 15:35:23'),(279,'permissoes',NULL,1,'INSERT','menu_item_id','1',NULL,'2023-04-07 15:35:23'),(280,'permissoes',NULL,1,'INSERT','usuario_id','1',NULL,'2023-04-07 15:35:23'),(281,'usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 15:36:51'),(282,'usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','1',NULL,'2023-04-07 15:36:51'),(283,'usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','5',NULL,'2023-04-07 15:36:51'),(284,'usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','18',NULL,'2023-04-07 15:36:51'),(285,'grupos_permissoes',1,NULL,'DELETE','usuario_id','1',NULL,'2023-04-07 16:50:45'),(286,'grupos_permissoes',5,NULL,'DELETE','grupo_id','5',NULL,'2023-04-07 16:50:45'),(287,'grupos_permissoes',5,NULL,'DELETE','permissao_id','18',NULL,'2023-04-07 16:50:45'),(288,'grupos_permissoes',1,NULL,'DELETE','status','1',NULL,'2023-04-07 16:50:45'),(289,'grupos_permissoes',1,NULL,'DELETE','usuario_id','1',NULL,'2023-04-07 16:51:48'),(290,'grupos_permissoes',4,NULL,'DELETE','grupo_id','4',NULL,'2023-04-07 16:51:48'),(291,'grupos_permissoes',4,NULL,'DELETE','permissao_id','17',NULL,'2023-04-07 16:51:48'),(292,'grupos_permissoes',1,NULL,'DELETE','status','1',NULL,'2023-04-07 16:51:48'),(293,'usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 16:55:13'),(294,'usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','1',NULL,'2023-04-07 16:55:13'),(295,'usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','4',NULL,'2023-04-07 16:55:13'),(296,'usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','18',NULL,'2023-04-07 16:55:13'),(297,'usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 16:56:00'),(298,'usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','1',NULL,'2023-04-07 16:56:00'),(299,'usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','4',NULL,'2023-04-07 16:56:00'),(300,'usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','17',NULL,'2023-04-07 16:56:00'),(301,'usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 18:54:15'),(302,'usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','2',NULL,'2023-04-07 18:54:15'),(303,'usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','5',NULL,'2023-04-07 18:54:15'),(304,'usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','9',NULL,'2023-04-07 18:54:15'),(305,'usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 18:56:15'),(306,'usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','2',NULL,'2023-04-07 18:56:15'),(307,'usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','5',NULL,'2023-04-07 18:56:15'),(308,'usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','16',NULL,'2023-04-07 18:56:15'),(309,'usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 18:56:15'),(310,'usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','2',NULL,'2023-04-07 18:56:15'),(311,'usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','5',NULL,'2023-04-07 18:56:15'),(312,'usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','17',NULL,'2023-04-07 18:56:15'),(313,'usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 18:56:15'),(314,'usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','2',NULL,'2023-04-07 18:56:15'),(315,'usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','5',NULL,'2023-04-07 18:56:15'),(316,'usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','18',NULL,'2023-04-07 18:56:15'),(317,'usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 18:56:58'),(318,'usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','2',NULL,'2023-04-07 18:56:58'),(319,'usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','6',NULL,'2023-04-07 18:56:58'),(320,'usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','9',NULL,'2023-04-07 18:56:58'),(321,'usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 18:56:58'),(322,'usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','2',NULL,'2023-04-07 18:56:58'),(323,'usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','6',NULL,'2023-04-07 18:56:58'),(324,'usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','16',NULL,'2023-04-07 18:56:58'),(325,'usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 18:56:58'),(326,'usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','2',NULL,'2023-04-07 18:56:58'),(327,'usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','6',NULL,'2023-04-07 18:56:58'),(328,'usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','17',NULL,'2023-04-07 18:56:58'),(329,'usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 18:56:58'),(330,'usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','2',NULL,'2023-04-07 18:56:58'),(331,'usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','6',NULL,'2023-04-07 18:56:58'),(332,'usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','18',NULL,'2023-04-07 18:56:58'),(333,NULL,11,NULL,NULL,NULL,NULL,NULL,NULL),(334,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-07 14:38:00','2023-04-07 19:52:33','2023-04-07 19:52:33'),(335,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-07 19:53:17'),(336,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 19:53:17'),(337,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','7',NULL,'2023-04-07 19:53:17'),(338,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','9',NULL,'2023-04-07 19:53:17'),(339,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-07 19:54:05'),(340,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 19:54:05'),(341,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','7',NULL,'2023-04-07 19:54:05'),(342,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','17',NULL,'2023-04-07 19:54:05'),(343,'grupos_permissoes',1,1,'DELETE','usuario_id','1',NULL,'2023-04-07 20:44:23'),(344,'grupos_permissoes',4,1,'DELETE','grupo_id','4',NULL,'2023-04-07 20:44:23'),(345,'grupos_permissoes',4,1,'DELETE','permissao_id','9',NULL,'2023-04-07 20:44:23'),(346,'grupos_permissoes',1,1,'DELETE','status','1',NULL,'2023-04-07 20:44:23'),(347,'grupos_permissoes',1,1,'DELETE','usuario_id','1',NULL,'2023-04-07 20:44:23'),(348,'grupos_permissoes',4,1,'DELETE','grupo_id','4',NULL,'2023-04-07 20:44:23'),(349,'grupos_permissoes',4,1,'DELETE','permissao_id','18',NULL,'2023-04-07 20:44:23'),(350,'grupos_permissoes',1,1,'DELETE','status','1',NULL,'2023-04-07 20:44:23'),(351,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-07 21:25:05'),(352,'grupos_permissoes',5,2,'DELETE','grupo_id','5',NULL,'2023-04-07 21:25:05'),(353,'grupos_permissoes',5,2,'DELETE','permissao_id','16',NULL,'2023-04-07 21:25:05'),(354,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-07 21:25:05'),(355,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-07 21:25:05'),(356,'grupos_permissoes',5,2,'DELETE','grupo_id','5',NULL,'2023-04-07 21:25:05'),(357,'grupos_permissoes',5,2,'DELETE','permissao_id','17',NULL,'2023-04-07 21:25:05'),(358,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-07 21:25:05'),(359,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-07 21:28:42'),(360,'grupos_permissoes',5,2,'DELETE','grupo_id','5',NULL,'2023-04-07 21:28:42'),(361,'grupos_permissoes',5,2,'DELETE','permissao_id','9',NULL,'2023-04-07 21:28:42'),(362,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-07 21:28:42'),(363,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-07 21:28:42'),(364,'grupos_permissoes',5,2,'DELETE','grupo_id','5',NULL,'2023-04-07 21:28:42'),(365,'grupos_permissoes',5,2,'DELETE','permissao_id','18',NULL,'2023-04-07 21:28:42'),(366,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-07 21:28:42'),(367,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-07 21:28:59'),(368,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 21:28:59'),(369,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','5',NULL,'2023-04-07 21:28:59'),(370,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','9',NULL,'2023-04-07 21:28:59'),(371,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-07 21:28:59'),(372,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 21:28:59'),(373,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','5',NULL,'2023-04-07 21:28:59'),(374,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','16',NULL,'2023-04-07 21:28:59'),(375,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-07 21:28:59'),(376,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 21:28:59'),(377,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','5',NULL,'2023-04-07 21:28:59'),(378,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','17',NULL,'2023-04-07 21:28:59'),(379,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-07 21:28:59'),(380,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 21:28:59'),(381,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','5',NULL,'2023-04-07 21:28:59'),(382,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','18',NULL,'2023-04-07 21:28:59'),(383,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-07 21:29:10'),(384,'grupos_permissoes',5,2,'DELETE','grupo_id','5',NULL,'2023-04-07 21:29:10'),(385,'grupos_permissoes',5,2,'DELETE','permissao_id','9',NULL,'2023-04-07 21:29:10'),(386,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-07 21:29:10'),(387,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-07 21:29:10'),(388,'grupos_permissoes',5,2,'DELETE','grupo_id','5',NULL,'2023-04-07 21:29:10'),(389,'grupos_permissoes',5,2,'DELETE','permissao_id','16',NULL,'2023-04-07 21:29:10'),(390,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-07 21:29:10'),(391,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-07 21:29:10'),(392,'grupos_permissoes',5,2,'DELETE','grupo_id','5',NULL,'2023-04-07 21:29:10'),(393,'grupos_permissoes',5,2,'DELETE','permissao_id','17',NULL,'2023-04-07 21:29:10'),(394,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-07 21:29:10'),(395,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-07 21:29:10'),(396,'grupos_permissoes',5,2,'DELETE','grupo_id','5',NULL,'2023-04-07 21:29:10'),(397,'grupos_permissoes',5,2,'DELETE','permissao_id','18',NULL,'2023-04-07 21:29:10'),(398,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-07 21:29:10'),(399,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-07 19:52:33','2023-04-07 21:36:20','2023-04-07 21:36:20'),(400,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-07 21:36:20','2023-04-07 21:42:06','2023-04-07 21:42:06'),(401,'grupos',8,2,'UPDATE','status','1','0','2023-04-07 21:45:46'),(402,'menu_itens',21,2,'UPDATE','status','1','0','2023-04-07 22:04:20'),(403,'menu_itens',0,2,'INSERT','id','0',NULL,'2023-04-07 22:05:42'),(404,'menu_itens',0,2,'INSERT','nome','Grupos de Usuários',NULL,'2023-04-07 22:05:42'),(405,'menu_itens',0,2,'INSERT','descricao','Cadastro de grupos de usuários',NULL,'2023-04-07 22:05:42'),(406,'menu_itens',0,2,'INSERT','status','0',NULL,'2023-04-07 22:05:42'),(407,'menu_itens',0,2,'INSERT','class','',NULL,'2023-04-07 22:05:42'),(408,'menu_itens',0,2,'INSERT','titulo','',NULL,'2023-04-07 22:05:42'),(409,'menu_itens',0,2,'INSERT','url','?page=ControllerGrupoUsuario&option=listar',NULL,'2023-04-07 22:05:42'),(410,'menu_itens',0,2,'INSERT','image','',NULL,'2023-04-07 22:05:42'),(411,'menu_itens',0,2,'INSERT','icone','fas fa-layer-group fa-sm fa-fw mr-2 text-gray-400',NULL,'2023-04-07 22:05:42'),(412,'menu_itens',0,2,'INSERT','menu_item_id','0',NULL,'2023-04-07 22:05:42'),(413,'menu_itens',0,2,'INSERT','menu_id','2',NULL,'2023-04-07 22:05:42'),(414,'menu_itens',0,2,'INSERT','usuario_id','2',NULL,'2023-04-07 22:05:42'),(415,'menu_itens',23,2,'UPDATE','status','0','1','2023-04-07 22:06:30'),(416,'menu_itens',21,2,'UPDATE','status','0','1','2023-04-07 22:07:10'),(417,'menu_itens',23,2,'UPDATE','status','1','0','2023-04-07 22:16:17'),(418,'menu_itens',23,2,'UPDATE','url','?page=ControllerGrupoUsuario&option=listar','?page=ControllerUsuarioGrupo&option=listar','2023-04-07 22:16:34'),(419,'menu_itens',23,2,'UPDATE','status','0','1','2023-04-07 22:16:35'),(420,'menu_itens',23,2,'UPDATE','icone','fas fa-layer-group fa-sm fa-fw mr-2 text-gray-400','fa-solid fa-users-between-lines fa-sm fa-fw mr-2 text-gray-400','2023-04-07 22:20:51'),(421,'grupos',8,2,'UPDATE','status','0','1','2023-04-07 22:37:15'),(422,'menu_itens',23,2,'DELETE','id','23',NULL,'2023-04-07 22:37:40'),(423,'menu_itens',23,2,'DELETE','nome','Grupos de Usuários',NULL,'2023-04-07 22:37:40'),(424,'menu_itens',23,2,'DELETE','descricao','Cadastro de grupos de usuários',NULL,'2023-04-07 22:37:40'),(425,'menu_itens',23,2,'DELETE','status','1',NULL,'2023-04-07 22:37:40'),(426,'menu_itens',23,2,'DELETE','titulo','',NULL,'2023-04-07 22:37:40'),(427,'menu_itens',23,2,'DELETE','class','',NULL,'2023-04-07 22:37:40'),(428,'menu_itens',23,2,'DELETE','url','?page=ControllerUsuarioGrupo&option=listar',NULL,'2023-04-07 22:37:40'),(429,'menu_itens',23,2,'DELETE','image','',NULL,'2023-04-07 22:37:40'),(430,'menu_itens',23,2,'DELETE','icone','fa-solid fa-users-between-lines fa-sm fa-fw mr-2 text-gray-400',NULL,'2023-04-07 22:37:40'),(431,'menu_itens',23,2,'DELETE','menu_item_id','0',NULL,'2023-04-07 22:37:40'),(432,'menu_itens',23,2,'DELETE','menu_id','2',NULL,'2023-04-07 22:37:40'),(433,'menu_itens',23,2,'DELETE','usuario_id','2',NULL,'2023-04-07 22:37:40'),(434,'menu_itens',21,2,'UPDATE','nome','Grupos de Permissões','Grupos de Permissões/Usuários','2023-04-07 22:38:48'),(435,'menu_itens',21,2,'UPDATE','descricao','Cadastro de grupos','Cadastro de grupos de usuários e permissões','2023-04-07 22:38:48'),(436,'usuarios_grupos',NULL,2,'INSERT','status','1',NULL,'2023-04-07 23:24:34'),(437,'usuarios_grupos',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 23:24:34'),(438,'usuarios_grupos',NULL,2,'INSERT','usuario','2',NULL,'2023-04-07 23:24:34'),(439,'usuarios_grupos',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:24:34'),(440,'usuarios_grupos',14,1,'INSERT','status','1',NULL,'2023-04-07 23:31:17'),(441,'usuarios_grupos',14,1,'INSERT','usuario_id','1',NULL,'2023-04-07 23:31:17'),(442,'usuarios_grupos',14,1,'INSERT','usuario','1',NULL,'2023-04-07 23:31:17'),(443,'usuarios_grupos',14,1,'INSERT','grupo_id','4',NULL,'2023-04-07 23:31:17'),(444,'usuarios_grupos',34,3,'INSERT','status','1',NULL,'2023-04-07 23:31:27'),(445,'usuarios_grupos',34,3,'INSERT','usuario_id','3',NULL,'2023-04-07 23:31:27'),(446,'usuarios_grupos',34,3,'INSERT','usuario','3',NULL,'2023-04-07 23:31:27'),(447,'usuarios_grupos',34,3,'INSERT','grupo_id','4',NULL,'2023-04-07 23:31:27'),(448,'grupos_permissoes',1,1,'DELETE','usuario_id','1',NULL,'2023-04-07 23:42:13'),(449,'grupos_permissoes',4,1,'DELETE','grupo_id','4',NULL,'2023-04-07 23:42:13'),(450,'grupos_permissoes',4,1,'DELETE','permissao_id','16',NULL,'2023-04-07 23:42:13'),(451,'grupos_permissoes',1,1,'DELETE','status','1',NULL,'2023-04-07 23:42:13'),(452,'grupos_permissoes',1,1,'DELETE','usuario_id','1',NULL,'2023-04-07 23:42:13'),(453,'grupos_permissoes',4,1,'DELETE','grupo_id','4',NULL,'2023-04-07 23:42:13'),(454,'grupos_permissoes',4,1,'DELETE','permissao_id','17',NULL,'2023-04-07 23:42:13'),(455,'grupos_permissoes',1,1,'DELETE','status','1',NULL,'2023-04-07 23:42:13'),(456,'usuarios_grupos',14,1,'DELETE','usuario_id','1',NULL,'2023-04-07 23:45:04'),(457,'usuarios_grupos',14,1,'DELETE','grupo_id','4',NULL,'2023-04-07 23:45:04'),(458,'usuarios_grupos',14,1,'DELETE','usuario','1',NULL,'2023-04-07 23:45:04'),(459,'usuarios_grupos',14,1,'DELETE','status','1',NULL,'2023-04-07 23:45:04'),(460,'usuarios_grupos',24,2,'DELETE','usuario_id','2',NULL,'2023-04-07 23:45:04'),(461,'usuarios_grupos',24,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:45:04'),(462,'usuarios_grupos',24,2,'DELETE','usuario','2',NULL,'2023-04-07 23:45:04'),(463,'usuarios_grupos',24,2,'DELETE','status','1',NULL,'2023-04-07 23:45:04'),(464,'usuarios_grupos',34,3,'DELETE','usuario_id','3',NULL,'2023-04-07 23:45:04'),(465,'usuarios_grupos',34,3,'DELETE','grupo_id','4',NULL,'2023-04-07 23:45:04'),(466,'usuarios_grupos',34,3,'DELETE','usuario','3',NULL,'2023-04-07 23:45:04'),(467,'usuarios_grupos',34,3,'DELETE','status','1',NULL,'2023-04-07 23:45:04'),(468,'usuarios_grupos',24,2,'INSERT','status','1',NULL,'2023-04-07 23:45:24'),(469,'usuarios_grupos',24,2,'INSERT','usuario_id','2',NULL,'2023-04-07 23:45:24'),(470,'usuarios_grupos',24,2,'INSERT','usuario','2',NULL,'2023-04-07 23:45:24'),(471,'usuarios_grupos',24,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:45:24'),(472,'usuarios_grupos',34,2,'INSERT','status','1',NULL,'2023-04-07 23:45:24'),(473,'usuarios_grupos',34,2,'INSERT','usuario_id','3',NULL,'2023-04-07 23:45:24'),(474,'usuarios_grupos',34,2,'INSERT','usuario','2',NULL,'2023-04-07 23:45:24'),(475,'usuarios_grupos',34,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:45:24'),(476,'usuarios_grupos',24,2,'DELETE','usuario_id','2',NULL,'2023-04-07 23:45:36'),(477,'usuarios_grupos',24,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:45:36'),(478,'usuarios_grupos',24,2,'DELETE','usuario','2',NULL,'2023-04-07 23:45:36'),(479,'usuarios_grupos',24,2,'DELETE','status','1',NULL,'2023-04-07 23:45:36'),(480,'usuarios_grupos',34,2,'DELETE','usuario_id','3',NULL,'2023-04-07 23:45:36'),(481,'usuarios_grupos',34,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:45:36'),(482,'usuarios_grupos',34,2,'DELETE','usuario','2',NULL,'2023-04-07 23:45:36'),(483,'usuarios_grupos',34,2,'DELETE','status','1',NULL,'2023-04-07 23:45:36'),(484,'usuarios_grupos',14,2,'INSERT','status','1',NULL,'2023-04-07 23:47:02'),(485,'usuarios_grupos',14,2,'INSERT','usuario_id','1',NULL,'2023-04-07 23:47:02'),(486,'usuarios_grupos',14,2,'INSERT','usuario','2',NULL,'2023-04-07 23:47:02'),(487,'usuarios_grupos',14,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:47:02'),(488,'usuarios_grupos',24,2,'INSERT','status','1',NULL,'2023-04-07 23:47:02'),(489,'usuarios_grupos',24,2,'INSERT','usuario_id','2',NULL,'2023-04-07 23:47:02'),(490,'usuarios_grupos',24,2,'INSERT','usuario','2',NULL,'2023-04-07 23:47:02'),(491,'usuarios_grupos',24,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:47:02'),(492,'usuarios_grupos',34,2,'INSERT','status','1',NULL,'2023-04-07 23:47:02'),(493,'usuarios_grupos',34,2,'INSERT','usuario_id','3',NULL,'2023-04-07 23:47:02'),(494,'usuarios_grupos',34,2,'INSERT','usuario','2',NULL,'2023-04-07 23:47:02'),(495,'usuarios_grupos',34,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:47:02'),(496,'usuarios_grupos',14,2,'DELETE','usuario_id','1',NULL,'2023-04-07 23:47:12'),(497,'usuarios_grupos',14,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:47:12'),(498,'usuarios_grupos',14,2,'DELETE','usuario','2',NULL,'2023-04-07 23:47:12'),(499,'usuarios_grupos',14,2,'DELETE','status','1',NULL,'2023-04-07 23:47:12'),(500,'usuarios_grupos',24,2,'DELETE','usuario_id','2',NULL,'2023-04-07 23:47:12'),(501,'usuarios_grupos',24,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:47:12'),(502,'usuarios_grupos',24,2,'DELETE','usuario','2',NULL,'2023-04-07 23:47:12'),(503,'usuarios_grupos',24,2,'DELETE','status','1',NULL,'2023-04-07 23:47:12'),(504,'usuarios_grupos',34,2,'DELETE','usuario_id','3',NULL,'2023-04-07 23:47:12'),(505,'usuarios_grupos',34,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:47:12'),(506,'usuarios_grupos',34,2,'DELETE','usuario','2',NULL,'2023-04-07 23:47:12'),(507,'usuarios_grupos',34,2,'DELETE','status','1',NULL,'2023-04-07 23:47:12'),(508,'usuarios_grupos',14,2,'INSERT','status','1',NULL,'2023-04-07 23:47:40'),(509,'usuarios_grupos',14,2,'INSERT','usuario_id','1',NULL,'2023-04-07 23:47:40'),(510,'usuarios_grupos',14,2,'INSERT','usuario','2',NULL,'2023-04-07 23:47:40'),(511,'usuarios_grupos',14,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:47:40'),(512,'usuarios_grupos',24,2,'INSERT','status','1',NULL,'2023-04-07 23:47:40'),(513,'usuarios_grupos',24,2,'INSERT','usuario_id','2',NULL,'2023-04-07 23:47:40'),(514,'usuarios_grupos',24,2,'INSERT','usuario','2',NULL,'2023-04-07 23:47:40'),(515,'usuarios_grupos',24,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:47:40'),(516,'usuarios_grupos',34,2,'INSERT','status','1',NULL,'2023-04-07 23:47:40'),(517,'usuarios_grupos',34,2,'INSERT','usuario_id','3',NULL,'2023-04-07 23:47:40'),(518,'usuarios_grupos',34,2,'INSERT','usuario','2',NULL,'2023-04-07 23:47:40'),(519,'usuarios_grupos',34,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:47:40'),(520,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-07 23:53:52'),(521,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 23:53:52'),(522,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:53:52'),(523,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','9',NULL,'2023-04-07 23:53:52'),(524,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-07 23:53:52'),(525,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 23:53:52'),(526,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:53:52'),(527,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','16',NULL,'2023-04-07 23:53:52'),(528,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-07 23:53:52'),(529,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 23:53:52'),(530,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:53:52'),(531,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','17',NULL,'2023-04-07 23:53:52'),(532,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-07 23:53:52'),(533,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 23:53:52'),(534,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:53:52'),(535,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','18',NULL,'2023-04-07 23:53:52'),(536,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-07 23:54:05'),(537,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:54:05'),(538,'grupos_permissoes',4,2,'DELETE','permissao_id','9',NULL,'2023-04-07 23:54:05'),(539,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-07 23:54:05'),(540,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-07 23:54:05'),(541,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:54:05'),(542,'grupos_permissoes',4,2,'DELETE','permissao_id','16',NULL,'2023-04-07 23:54:05'),(543,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-07 23:54:05'),(544,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-07 23:54:05'),(545,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:54:05'),(546,'grupos_permissoes',4,2,'DELETE','permissao_id','17',NULL,'2023-04-07 23:54:05'),(547,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-07 23:54:05'),(548,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-07 23:54:05'),(549,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:54:05'),(550,'grupos_permissoes',4,2,'DELETE','permissao_id','18',NULL,'2023-04-07 23:54:05'),(551,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-07 23:54:05'),(552,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-07 23:54:36'),(553,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 23:54:36'),(554,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:54:36'),(555,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','9',NULL,'2023-04-07 23:54:36'),(556,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-07 23:54:36'),(557,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 23:54:36'),(558,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:54:36'),(559,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','16',NULL,'2023-04-07 23:54:36'),(560,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-07 23:54:36'),(561,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 23:54:36'),(562,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:54:36'),(563,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','17',NULL,'2023-04-07 23:54:36'),(564,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-07 23:54:36'),(565,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 23:54:36'),(566,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:54:36'),(567,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','18',NULL,'2023-04-07 23:54:36'),(568,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-07 23:54:50'),(569,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:54:50'),(570,'grupos_permissoes',4,2,'DELETE','permissao_id','9',NULL,'2023-04-07 23:54:50'),(571,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-07 23:54:50'),(572,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-07 23:54:50'),(573,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:54:50'),(574,'grupos_permissoes',4,2,'DELETE','permissao_id','16',NULL,'2023-04-07 23:54:50'),(575,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-07 23:54:50'),(576,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-07 23:54:50'),(577,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:54:50'),(578,'grupos_permissoes',4,2,'DELETE','permissao_id','17',NULL,'2023-04-07 23:54:50'),(579,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-07 23:54:50'),(580,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-07 23:54:50'),(581,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:54:50'),(582,'grupos_permissoes',4,2,'DELETE','permissao_id','18',NULL,'2023-04-07 23:54:50'),(583,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-07 23:54:50'),(584,'usuarios_grupos',34,2,'DELETE','usuario_id','3',NULL,'2023-04-07 23:56:24'),(585,'usuarios_grupos',34,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:56:24'),(586,'usuarios_grupos',34,2,'DELETE','usuario','2',NULL,'2023-04-07 23:56:24'),(587,'usuarios_grupos',34,2,'DELETE','status','1',NULL,'2023-04-07 23:56:24'),(588,'usuarios_grupos',34,2,'INSERT','status','1',NULL,'2023-04-07 23:56:37'),(589,'usuarios_grupos',34,2,'INSERT','usuario_id','3',NULL,'2023-04-07 23:56:37'),(590,'usuarios_grupos',34,2,'INSERT','usuario','2',NULL,'2023-04-07 23:56:37'),(591,'usuarios_grupos',34,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:56:37'),(592,'usuarios_grupos',14,2,'DELETE','usuario_id','1',NULL,'2023-04-07 23:56:58'),(593,'usuarios_grupos',14,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:56:58'),(594,'usuarios_grupos',14,2,'DELETE','usuario','2',NULL,'2023-04-07 23:56:58'),(595,'usuarios_grupos',14,2,'DELETE','status','1',NULL,'2023-04-07 23:56:58'),(596,'usuarios_grupos',24,2,'DELETE','usuario_id','2',NULL,'2023-04-07 23:56:58'),(597,'usuarios_grupos',24,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:56:58'),(598,'usuarios_grupos',24,2,'DELETE','usuario','2',NULL,'2023-04-07 23:56:58'),(599,'usuarios_grupos',24,2,'DELETE','status','1',NULL,'2023-04-07 23:56:58'),(600,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-07 23:57:41'),(601,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 23:57:41'),(602,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:57:41'),(603,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','9',NULL,'2023-04-07 23:57:41'),(604,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-07 23:57:41'),(605,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 23:57:41'),(606,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:57:41'),(607,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','16',NULL,'2023-04-07 23:57:41'),(608,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-07 23:57:41'),(609,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 23:57:41'),(610,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:57:41'),(611,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','17',NULL,'2023-04-07 23:57:41'),(612,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-07 23:57:41'),(613,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-07 23:57:41'),(614,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-07 23:57:41'),(615,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','18',NULL,'2023-04-07 23:57:41'),(616,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-07 23:57:55'),(617,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:57:55'),(618,'grupos_permissoes',4,2,'DELETE','permissao_id','9',NULL,'2023-04-07 23:57:55'),(619,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-07 23:57:55'),(620,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-07 23:57:55'),(621,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-07 23:57:55'),(622,'grupos_permissoes',4,2,'DELETE','permissao_id','16',NULL,'2023-04-07 23:57:55'),(623,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-07 23:57:55'),(624,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-07 21:42:06','2023-04-08 00:11:49','2023-04-08 00:11:49'),(625,'grupos',5,2,'UPDATE','status','1','0','2023-04-08 00:12:32'),(626,'grupos',6,2,'UPDATE','status','1','0','2023-04-08 00:12:39'),(627,'grupos',7,2,'UPDATE','status','1','0','2023-04-08 00:12:43'),(628,'grupos',8,2,'UPDATE','status','1','0','2023-04-08 00:12:46'),(629,'grupos',4,2,'UPDATE','status','1','0','2023-04-08 00:12:59'),(630,'grupos',4,2,'UPDATE','status','0','1','2023-04-08 00:15:44'),(631,'grupos',4,2,'UPDATE','status','1','0','2023-04-08 00:15:48'),(632,'grupos',4,2,'UPDATE','status','0','1','2023-04-08 00:15:53'),(633,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:19:26'),(634,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-08 00:19:26'),(635,'grupos_permissoes',4,2,'DELETE','permissao_id','17',NULL,'2023-04-08 00:19:26'),(636,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:19:26'),(637,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:19:26'),(638,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-08 00:19:26'),(639,'grupos_permissoes',4,2,'DELETE','permissao_id','18',NULL,'2023-04-08 00:19:26'),(640,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:19:26'),(641,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:19:45'),(642,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:19:45'),(643,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-08 00:19:45'),(644,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','9',NULL,'2023-04-08 00:19:45'),(645,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:19:45'),(646,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:19:45'),(647,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-08 00:19:45'),(648,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','16',NULL,'2023-04-08 00:19:45'),(649,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:19:45'),(650,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:19:45'),(651,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-08 00:19:45'),(652,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','17',NULL,'2023-04-08 00:19:45'),(653,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:19:45'),(654,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:19:45'),(655,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-08 00:19:45'),(656,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','18',NULL,'2023-04-08 00:19:45'),(657,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:19:53'),(658,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-08 00:19:53'),(659,'grupos_permissoes',4,2,'DELETE','permissao_id','9',NULL,'2023-04-08 00:19:53'),(660,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:19:53'),(661,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:19:53'),(662,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-08 00:19:53'),(663,'grupos_permissoes',4,2,'DELETE','permissao_id','16',NULL,'2023-04-08 00:19:53'),(664,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:19:53'),(665,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:19:53'),(666,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-08 00:19:53'),(667,'grupos_permissoes',4,2,'DELETE','permissao_id','17',NULL,'2023-04-08 00:19:53'),(668,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:19:53'),(669,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:19:53'),(670,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-08 00:19:53'),(671,'grupos_permissoes',4,2,'DELETE','permissao_id','18',NULL,'2023-04-08 00:19:53'),(672,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:19:53'),(673,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:20:07'),(674,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:20:07'),(675,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-08 00:20:07'),(676,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','9',NULL,'2023-04-08 00:20:07'),(677,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:20:07'),(678,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:20:07'),(679,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-08 00:20:07'),(680,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','16',NULL,'2023-04-08 00:20:07'),(681,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:20:07'),(682,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:20:07'),(683,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-08 00:20:07'),(684,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','17',NULL,'2023-04-08 00:20:07'),(685,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:20:07'),(686,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:20:07'),(687,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-08 00:20:07'),(688,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','18',NULL,'2023-04-08 00:20:07'),(689,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:20:14'),(690,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-08 00:20:14'),(691,'grupos_permissoes',4,2,'DELETE','permissao_id','9',NULL,'2023-04-08 00:20:14'),(692,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:20:14'),(693,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:20:14'),(694,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-08 00:20:14'),(695,'grupos_permissoes',4,2,'DELETE','permissao_id','16',NULL,'2023-04-08 00:20:14'),(696,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:20:14'),(697,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:20:14'),(698,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-08 00:20:14'),(699,'grupos_permissoes',4,2,'DELETE','permissao_id','17',NULL,'2023-04-08 00:20:14'),(700,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:20:14'),(701,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:20:14'),(702,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-08 00:20:14'),(703,'grupos_permissoes',4,2,'DELETE','permissao_id','18',NULL,'2023-04-08 00:20:14'),(704,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:20:14'),(705,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:20:40'),(706,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:20:40'),(707,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-08 00:20:40'),(708,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','9',NULL,'2023-04-08 00:20:40'),(709,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:20:40'),(710,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:20:40'),(711,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-08 00:20:40'),(712,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','16',NULL,'2023-04-08 00:20:40'),(713,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:20:40'),(714,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:20:40'),(715,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-08 00:20:40'),(716,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','17',NULL,'2023-04-08 00:20:40'),(717,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:20:40'),(718,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:20:40'),(719,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-08 00:20:40'),(720,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','18',NULL,'2023-04-08 00:20:40'),(721,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:20:55'),(722,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-08 00:20:55'),(723,'grupos_permissoes',4,2,'DELETE','permissao_id','16',NULL,'2023-04-08 00:20:55'),(724,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:20:55'),(725,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:20:55'),(726,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-08 00:20:55'),(727,'grupos_permissoes',4,2,'DELETE','permissao_id','18',NULL,'2023-04-08 00:20:55'),(728,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:20:55'),(729,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:21:09'),(730,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:21:09'),(731,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-08 00:21:09'),(732,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','16',NULL,'2023-04-08 00:21:09'),(733,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:21:09'),(734,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:21:09'),(735,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-08 00:21:09'),(736,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','18',NULL,'2023-04-08 00:21:09'),(737,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:21:29'),(738,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-08 00:21:29'),(739,'grupos_permissoes',4,2,'DELETE','permissao_id','9',NULL,'2023-04-08 00:21:29'),(740,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:21:29'),(741,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:21:29'),(742,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-08 00:21:29'),(743,'grupos_permissoes',4,2,'DELETE','permissao_id','16',NULL,'2023-04-08 00:21:29'),(744,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:21:29'),(745,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:21:29'),(746,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-08 00:21:29'),(747,'grupos_permissoes',4,2,'DELETE','permissao_id','17',NULL,'2023-04-08 00:21:29'),(748,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:21:29'),(749,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:21:29'),(750,'grupos_permissoes',4,2,'DELETE','grupo_id','4',NULL,'2023-04-08 00:21:29'),(751,'grupos_permissoes',4,2,'DELETE','permissao_id','18',NULL,'2023-04-08 00:21:29'),(752,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:21:29'),(753,'usuarios_grupos',34,2,'DELETE','usuario_id','3',NULL,'2023-04-08 00:23:38'),(754,'usuarios_grupos',34,2,'DELETE','grupo_id','4',NULL,'2023-04-08 00:23:38'),(755,'usuarios_grupos',34,2,'DELETE','usuario','2',NULL,'2023-04-08 00:23:38'),(756,'usuarios_grupos',34,2,'DELETE','status','1',NULL,'2023-04-08 00:23:38'),(757,'grupos',5,2,'UPDATE','status','0','1','2023-04-08 00:26:19'),(758,'grupos',6,2,'UPDATE','status','0','1','2023-04-08 00:27:12'),(759,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:27:29'),(760,'grupos_permissoes',6,2,'DELETE','grupo_id','6',NULL,'2023-04-08 00:27:29'),(761,'grupos_permissoes',6,2,'DELETE','permissao_id','9',NULL,'2023-04-08 00:27:29'),(762,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:27:29'),(763,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:27:29'),(764,'grupos_permissoes',6,2,'DELETE','grupo_id','6',NULL,'2023-04-08 00:27:29'),(765,'grupos_permissoes',6,2,'DELETE','permissao_id','16',NULL,'2023-04-08 00:27:29'),(766,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:27:29'),(767,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:27:29'),(768,'grupos_permissoes',6,2,'DELETE','grupo_id','6',NULL,'2023-04-08 00:27:29'),(769,'grupos_permissoes',6,2,'DELETE','permissao_id','17',NULL,'2023-04-08 00:27:29'),(770,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:27:29'),(771,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:27:29'),(772,'grupos_permissoes',6,2,'DELETE','grupo_id','6',NULL,'2023-04-08 00:27:29'),(773,'grupos_permissoes',6,2,'DELETE','permissao_id','18',NULL,'2023-04-08 00:27:29'),(774,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:27:29'),(775,'grupos',1,2,'UPDATE','nome','teste','TI','2023-04-08 00:29:05'),(776,'grupos',2,2,'UPDATE','nome','asdasdsda','Administrador','2023-04-08 00:29:05'),(777,'grupos',3,2,'UPDATE','nome','asdasdsda','Usuário','2023-04-08 00:29:05'),(778,'grupos',7,2,'UPDATE','status','0','1','2023-04-08 00:39:50'),(779,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:40:11'),(780,'grupos_permissoes',7,2,'DELETE','grupo_id','7',NULL,'2023-04-08 00:40:11'),(781,'grupos_permissoes',7,2,'DELETE','permissao_id','9',NULL,'2023-04-08 00:40:11'),(782,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:40:11'),(783,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:40:11'),(784,'grupos_permissoes',7,2,'DELETE','grupo_id','7',NULL,'2023-04-08 00:40:11'),(785,'grupos_permissoes',7,2,'DELETE','permissao_id','17',NULL,'2023-04-08 00:40:11'),(786,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 00:40:11'),(787,'grupos',7,2,'UPDATE','status','1','0','2023-04-08 00:40:18'),(788,'grupos',7,2,'DELETE','id','7',NULL,'2023-04-08 00:42:17'),(789,'grupos',7,2,'DELETE','nome','asdasdsda',NULL,'2023-04-08 00:42:17'),(790,'grupos',7,2,'DELETE','status','0',NULL,'2023-04-08 00:42:17'),(791,'grupos',7,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:42:17'),(792,'grupos',8,2,'UPDATE','status','0','1','2023-04-08 00:42:28'),(793,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:42:37'),(794,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:42:37'),(795,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 00:42:37'),(796,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','16',NULL,'2023-04-08 00:42:37'),(797,'grupos',8,2,'UPDATE','status','1','0','2023-04-08 00:42:44'),(798,'grupos',8,2,'DELETE','id','8',NULL,'2023-04-08 00:42:48'),(799,'grupos',8,2,'DELETE','nome','asdasdsda',NULL,'2023-04-08 00:42:48'),(800,'grupos',8,2,'DELETE','status','0',NULL,'2023-04-08 00:42:48'),(801,'grupos',8,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:42:48'),(802,'grupos',0,2,'INSERT','id','0',NULL,'2023-04-08 00:43:27'),(803,'grupos',0,2,'INSERT','nome','teste',NULL,'2023-04-08 00:43:27'),(804,'grupos',0,2,'INSERT','status','1',NULL,'2023-04-08 00:43:27'),(805,'grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:43:27'),(806,'grupos',9,2,'UPDATE','status','1','0','2023-04-08 00:43:31'),(807,'grupos',9,2,'DELETE','id','9',NULL,'2023-04-08 00:44:21'),(808,'grupos',9,2,'DELETE','nome','teste',NULL,'2023-04-08 00:44:21'),(809,'grupos',9,2,'DELETE','status','0',NULL,'2023-04-08 00:44:21'),(810,'grupos',9,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:44:21'),(811,'grupos',0,2,'INSERT','id','0',NULL,'2023-04-08 00:44:29'),(812,'grupos',0,2,'INSERT','nome','teste',NULL,'2023-04-08 00:44:29'),(813,'grupos',0,2,'INSERT','status','1',NULL,'2023-04-08 00:44:29'),(814,'grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:44:29'),(815,'grupos',10,2,'UPDATE','status','1','0','2023-04-08 00:44:32'),(816,'grupos',10,2,'UPDATE','status','0','1','2023-04-08 00:44:39'),(817,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:44:47'),(818,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:44:47'),(819,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 00:44:47'),(820,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','9',NULL,'2023-04-08 00:44:47'),(821,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:44:47'),(822,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:44:47'),(823,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 00:44:47'),(824,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','17',NULL,'2023-04-08 00:44:47'),(825,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:44:47'),(826,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:44:47'),(827,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 00:44:47'),(828,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','18',NULL,'2023-04-08 00:44:47'),(829,'grupos',10,2,'UPDATE','status','1','0','2023-04-08 00:44:50'),(830,'grupos',10,2,'DELETE','id','10',NULL,'2023-04-08 00:44:54'),(831,'grupos',10,2,'DELETE','nome','teste',NULL,'2023-04-08 00:44:54'),(832,'grupos',10,2,'DELETE','status','0',NULL,'2023-04-08 00:44:54'),(833,'grupos',10,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:44:54'),(834,'grupos',0,2,'INSERT','id','0',NULL,'2023-04-08 00:45:37'),(835,'grupos',0,2,'INSERT','nome','teste',NULL,'2023-04-08 00:45:37'),(836,'grupos',0,2,'INSERT','status','1',NULL,'2023-04-08 00:45:37'),(837,'grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:45:37'),(838,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:45:46'),(839,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:45:46'),(840,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','2',NULL,'2023-04-08 00:45:46'),(841,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','9',NULL,'2023-04-08 00:45:46'),(842,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:45:46'),(843,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:45:46'),(844,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','2',NULL,'2023-04-08 00:45:46'),(845,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','16',NULL,'2023-04-08 00:45:46'),(846,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:45:46'),(847,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:45:46'),(848,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','2',NULL,'2023-04-08 00:45:46'),(849,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','17',NULL,'2023-04-08 00:45:46'),(850,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:45:46'),(851,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:45:46'),(852,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','2',NULL,'2023-04-08 00:45:46'),(853,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','18',NULL,'2023-04-08 00:45:46'),(854,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:45:57'),(855,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:45:57'),(856,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','11',NULL,'2023-04-08 00:45:57'),(857,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','9',NULL,'2023-04-08 00:45:57'),(858,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:45:57'),(859,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:45:57'),(860,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','11',NULL,'2023-04-08 00:45:57'),(861,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','16',NULL,'2023-04-08 00:45:57'),(862,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:45:57'),(863,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:45:57'),(864,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','11',NULL,'2023-04-08 00:45:57'),(865,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','17',NULL,'2023-04-08 00:45:57'),(866,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 00:45:57'),(867,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:45:57'),(868,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','11',NULL,'2023-04-08 00:45:57'),(869,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','18',NULL,'2023-04-08 00:45:57'),(870,'grupos',11,2,'UPDATE','status','1','0','2023-04-08 00:46:02'),(871,'grupos',0,2,'INSERT','id','0',NULL,'2023-04-08 00:50:42'),(872,'grupos',0,2,'INSERT','nome','teste1',NULL,'2023-04-08 00:50:42'),(873,'grupos',0,2,'INSERT','status','1',NULL,'2023-04-08 00:50:42'),(874,'grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-08 00:50:42'),(875,'grupos',12,2,'UPDATE','status','1','0','2023-04-08 00:57:09'),(876,'grupos',12,2,'DELETE','id','12',NULL,'2023-04-08 00:57:17'),(877,'grupos',12,2,'DELETE','nome','teste1',NULL,'2023-04-08 00:57:17'),(878,'grupos',12,2,'DELETE','status','0',NULL,'2023-04-08 00:57:17'),(879,'grupos',12,2,'DELETE','usuario_id','2',NULL,'2023-04-08 00:57:17'),(880,'grupos',11,2,'UPDATE','status','0','1','2023-04-08 01:13:44'),(881,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 01:13:53'),(882,'grupos_permissoes',11,2,'DELETE','grupo_id','11',NULL,'2023-04-08 01:13:53'),(883,'grupos_permissoes',11,2,'DELETE','permissao_id','9',NULL,'2023-04-08 01:13:53'),(884,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 01:13:53'),(885,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 01:13:53'),(886,'grupos_permissoes',11,2,'DELETE','grupo_id','11',NULL,'2023-04-08 01:13:53'),(887,'grupos_permissoes',11,2,'DELETE','permissao_id','16',NULL,'2023-04-08 01:13:53'),(888,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 01:13:53'),(889,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 01:13:53'),(890,'grupos_permissoes',11,2,'DELETE','grupo_id','11',NULL,'2023-04-08 01:13:53'),(891,'grupos_permissoes',11,2,'DELETE','permissao_id','17',NULL,'2023-04-08 01:13:53'),(892,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 01:13:53'),(893,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-08 01:13:53'),(894,'grupos_permissoes',11,2,'DELETE','grupo_id','11',NULL,'2023-04-08 01:13:53'),(895,'grupos_permissoes',11,2,'DELETE','permissao_id','18',NULL,'2023-04-08 01:13:53'),(896,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-08 01:13:53'),(897,'grupos',11,2,'UPDATE','status','1','0','2023-04-08 01:13:57'),(898,'grupos',11,2,'DELETE','id','11',NULL,'2023-04-08 01:14:00'),(899,'grupos',11,2,'DELETE','nome','teste',NULL,'2023-04-08 01:14:00'),(900,'grupos',11,2,'DELETE','status','0',NULL,'2023-04-08 01:14:00'),(901,'grupos',11,2,'DELETE','usuario_id','2',NULL,'2023-04-08 01:14:00'),(902,'usuarios_grupos',21,2,'INSERT','status','1',NULL,'2023-04-08 01:37:17'),(903,'usuarios_grupos',21,2,'INSERT','usuario_id','2',NULL,'2023-04-08 01:37:17'),(904,'usuarios_grupos',21,2,'INSERT','usuario','2',NULL,'2023-04-08 01:37:17'),(905,'usuarios_grupos',21,2,'INSERT','grupo_id','1',NULL,'2023-04-08 01:37:17'),(906,'permissoes',9,NULL,'UPDATE','status','1','0','2023-04-08 02:00:38'),(907,'permissoes',16,NULL,'UPDATE','status','1','0','2023-04-08 02:00:44'),(908,'permissoes',17,NULL,'UPDATE','status','1','0','2023-04-08 02:00:49'),(909,'permissoes',18,NULL,'UPDATE','status','1','0','2023-04-08 02:00:52'),(910,'permissoes',18,2,'UPDATE','nome','6','Próprio Perfil','2023-04-08 02:01:56'),(911,'permissoes',18,2,'UPDATE','descricao','6','Visualizar e editar as informações do próprio pefil','2023-04-08 02:01:56'),(912,'permissoes',18,2,'UPDATE','usuario_id',NULL,'2','2023-04-08 02:01:56'),(913,'permissoes',18,2,'UPDATE','status','0','1','2023-04-08 02:02:06'),(914,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-08 02:02:59'),(915,'permissoes',NULL,2,'INSERT','nome','Página Inicial',NULL,'2023-04-08 02:02:59'),(916,'permissoes',NULL,2,'INSERT','descricao','Página de início ao entrar no sistema',NULL,'2023-04-08 02:02:59'),(917,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:02:59'),(918,'permissoes',NULL,2,'INSERT','menu_item_id','2',NULL,'2023-04-08 02:02:59'),(919,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:02:59'),(920,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-08 02:03:32'),(921,'permissoes',NULL,2,'INSERT','nome','Sair do Sistema',NULL,'2023-04-08 02:03:32'),(922,'permissoes',NULL,2,'INSERT','descricao','Desconectar do sistema',NULL,'2023-04-08 02:03:32'),(923,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:03:32'),(924,'permissoes',NULL,2,'INSERT','menu_item_id','3',NULL,'2023-04-08 02:03:32'),(925,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:03:32'),(926,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-08 02:04:32'),(927,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar usuários',NULL,'2023-04-08 02:04:32'),(928,'permissoes',NULL,2,'INSERT','descricao','Cadastro de usuários',NULL,'2023-04-08 02:04:32'),(929,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:04:32'),(930,'permissoes',NULL,2,'INSERT','menu_item_id','4',NULL,'2023-04-08 02:04:32'),(931,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:04:32'),(932,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-08 02:05:01'),(933,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar permissões',NULL,'2023-04-08 02:05:01'),(934,'permissoes',NULL,2,'INSERT','descricao','Cadastro de permissões',NULL,'2023-04-08 02:05:01'),(935,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:05:01'),(936,'permissoes',NULL,2,'INSERT','menu_item_id','5',NULL,'2023-04-08 02:05:01'),(937,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:05:01'),(938,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-08 02:05:49'),(939,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar parâmetros',NULL,'2023-04-08 02:05:49'),(940,'permissoes',NULL,2,'INSERT','descricao','Cadastro de parâmetros de configuração do sistema',NULL,'2023-04-08 02:05:49'),(941,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:05:49'),(942,'permissoes',NULL,2,'INSERT','menu_item_id','6',NULL,'2023-04-08 02:05:49'),(943,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:05:49'),(944,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-08 02:06:33'),(945,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar páginas do site',NULL,'2023-04-08 02:06:33'),(946,'permissoes',NULL,2,'INSERT','descricao','Cadastro de páginas do site',NULL,'2023-04-08 02:06:33'),(947,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:06:33'),(948,'permissoes',NULL,2,'INSERT','menu_item_id','7',NULL,'2023-04-08 02:06:33'),(949,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:06:33'),(950,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-08 02:07:07'),(951,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar conteúdos',NULL,'2023-04-08 02:07:07'),(952,'permissoes',NULL,2,'INSERT','descricao','Cadastro de conteúdos das páginas do site',NULL,'2023-04-08 02:07:07'),(953,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:07:07'),(954,'permissoes',NULL,2,'INSERT','menu_item_id','8',NULL,'2023-04-08 02:07:07'),(955,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:07:07'),(956,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-08 02:07:33'),(957,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar endereços',NULL,'2023-04-08 02:07:33'),(958,'permissoes',NULL,2,'INSERT','descricao','Cadastro de endereços',NULL,'2023-04-08 02:07:33'),(959,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:07:33'),(960,'permissoes',NULL,2,'INSERT','menu_item_id','10',NULL,'2023-04-08 02:07:33'),(961,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:07:33'),(962,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-08 02:08:49'),(963,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar estados',NULL,'2023-04-08 02:08:49'),(964,'permissoes',NULL,2,'INSERT','descricao','Cadastro de estados',NULL,'2023-04-08 02:08:49'),(965,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:08:49'),(966,'permissoes',NULL,2,'INSERT','menu_item_id','11',NULL,'2023-04-08 02:08:49'),(967,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:08:49'),(968,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-08 02:09:39'),(969,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar países',NULL,'2023-04-08 02:09:39'),(970,'permissoes',NULL,2,'INSERT','descricao','Cadastro de países',NULL,'2023-04-08 02:09:39'),(971,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:09:39'),(972,'permissoes',NULL,2,'INSERT','menu_item_id','12',NULL,'2023-04-08 02:09:39'),(973,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:09:39'),(974,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-08 02:10:27'),(975,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar funcionários',NULL,'2023-04-08 02:10:27'),(976,'permissoes',NULL,2,'INSERT','descricao','Cadastro de funcionários',NULL,'2023-04-08 02:10:27'),(977,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:10:27'),(978,'permissoes',NULL,2,'INSERT','menu_item_id','13',NULL,'2023-04-08 02:10:27'),(979,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:10:27'),(980,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-08 02:10:50'),(981,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar contatos',NULL,'2023-04-08 02:10:50'),(982,'permissoes',NULL,2,'INSERT','descricao','Cadastro de contatos',NULL,'2023-04-08 02:10:50'),(983,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:10:50'),(984,'permissoes',NULL,2,'INSERT','menu_item_id','14',NULL,'2023-04-08 02:10:50'),(985,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:10:50'),(986,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-08 02:11:20'),(987,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar folha de pagamento',NULL,'2023-04-08 02:11:20'),(988,'permissoes',NULL,2,'INSERT','descricao','Cadastro de folha de pagamento',NULL,'2023-04-08 02:11:20'),(989,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:11:20'),(990,'permissoes',NULL,2,'INSERT','menu_item_id','15',NULL,'2023-04-08 02:11:20'),(991,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:11:20'),(992,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-08 02:12:31'),(993,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar visualizar folha de pagamento',NULL,'2023-04-08 02:12:31'),(994,'permissoes',NULL,2,'INSERT','descricao','Cadastro de visualizar endereços',NULL,'2023-04-08 02:12:31'),(995,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:12:31'),(996,'permissoes',NULL,2,'INSERT','menu_item_id','16',NULL,'2023-04-08 02:12:31'),(997,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:12:31'),(998,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-08 02:13:07'),(999,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar módulos(menu)',NULL,'2023-04-08 02:13:07'),(1000,'permissoes',NULL,2,'INSERT','descricao','Cadastro de módulos(menus)',NULL,'2023-04-08 02:13:07'),(1001,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:13:07'),(1002,'permissoes',NULL,2,'INSERT','menu_item_id','17',NULL,'2023-04-08 02:13:07'),(1003,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:13:07'),(1004,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-08 02:13:42'),(1005,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar sub módulos(item de menu)',NULL,'2023-04-08 02:13:42'),(1006,'permissoes',NULL,2,'INSERT','descricao','Cadastro de sub módulos(item de menu)',NULL,'2023-04-08 02:13:42'),(1007,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:13:42'),(1008,'permissoes',NULL,2,'INSERT','menu_item_id','18',NULL,'2023-04-08 02:13:42'),(1009,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:13:42'),(1010,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-08 02:14:18'),(1011,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar grupos de acesso ao sistema',NULL,'2023-04-08 02:14:18'),(1012,'permissoes',NULL,2,'INSERT','descricao','Cadastro de grupos de acesso ao sistema',NULL,'2023-04-08 02:14:18'),(1013,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:14:18'),(1014,'permissoes',NULL,2,'INSERT','menu_item_id','21',NULL,'2023-04-08 02:14:18'),(1015,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:14:18'),(1016,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:15:13'),(1017,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:15:13'),(1018,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 02:15:13'),(1019,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','19',NULL,'2023-04-08 02:15:13'),(1020,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:15:13'),(1021,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:15:13'),(1022,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 02:15:13'),(1023,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','20',NULL,'2023-04-08 02:15:13'),(1024,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:15:13'),(1025,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:15:13'),(1026,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 02:15:13'),(1027,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','21',NULL,'2023-04-08 02:15:13'),(1028,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:15:13'),(1029,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:15:13'),(1030,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 02:15:13'),(1031,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','22',NULL,'2023-04-08 02:15:13'),(1032,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:15:13'),(1033,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:15:13'),(1034,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 02:15:13'),(1035,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','23',NULL,'2023-04-08 02:15:13'),(1036,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:15:13'),(1037,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:15:13'),(1038,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 02:15:13'),(1039,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','24',NULL,'2023-04-08 02:15:13'),(1040,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:15:13'),(1041,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:15:13'),(1042,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 02:15:13'),(1043,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','25',NULL,'2023-04-08 02:15:13'),(1044,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:15:13'),(1045,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:15:13'),(1046,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 02:15:13'),(1047,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','26',NULL,'2023-04-08 02:15:13'),(1048,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:15:13'),(1049,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:15:13'),(1050,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 02:15:13'),(1051,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','27',NULL,'2023-04-08 02:15:13'),(1052,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:15:13'),(1053,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:15:13'),(1054,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 02:15:13'),(1055,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','28',NULL,'2023-04-08 02:15:13'),(1056,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:15:13'),(1057,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:15:13'),(1058,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 02:15:13'),(1059,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','29',NULL,'2023-04-08 02:15:13'),(1060,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:15:13'),(1061,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:15:13'),(1062,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 02:15:13'),(1063,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','30',NULL,'2023-04-08 02:15:13'),(1064,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:15:13'),(1065,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:15:13'),(1066,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 02:15:13'),(1067,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','31',NULL,'2023-04-08 02:15:13'),(1068,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:15:13'),(1069,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:15:13'),(1070,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 02:15:13'),(1071,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','32',NULL,'2023-04-08 02:15:13'),(1072,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:15:13'),(1073,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:15:13'),(1074,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 02:15:13'),(1075,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','33',NULL,'2023-04-08 02:15:13'),(1076,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:15:13'),(1077,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:15:13'),(1078,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 02:15:13'),(1079,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','34',NULL,'2023-04-08 02:15:13'),(1080,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:15:13'),(1081,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:15:13'),(1082,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-08 02:15:13'),(1083,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','35',NULL,'2023-04-08 02:15:13'),(1084,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:17:53'),(1085,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:17:53'),(1086,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','2',NULL,'2023-04-08 02:17:53'),(1087,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','19',NULL,'2023-04-08 02:17:53'),(1088,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:17:53'),(1089,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:17:53'),(1090,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','2',NULL,'2023-04-08 02:17:53'),(1091,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','20',NULL,'2023-04-08 02:17:53'),(1092,'usuarios_grupos',12,2,'INSERT','status','1',NULL,'2023-04-08 02:18:37'),(1093,'usuarios_grupos',12,2,'INSERT','usuario_id','1',NULL,'2023-04-08 02:18:37'),(1094,'usuarios_grupos',12,2,'INSERT','usuario','2',NULL,'2023-04-08 02:18:37'),(1095,'usuarios_grupos',12,2,'INSERT','grupo_id','2',NULL,'2023-04-08 02:18:37'),(1096,'usuarios',1,NULL,'UPDATE','ultimo_acesso','2023-04-07 14:00:33','2023-04-08 02:18:48','2023-04-08 02:18:48'),(1097,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-08 00:11:49','2023-04-08 02:18:56','2023-04-08 02:18:56'),(1098,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:19:34'),(1099,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:19:34'),(1100,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','3',NULL,'2023-04-08 02:19:34'),(1101,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','18',NULL,'2023-04-08 02:19:34'),(1102,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:19:34'),(1103,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:19:34'),(1104,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','3',NULL,'2023-04-08 02:19:34'),(1105,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','19',NULL,'2023-04-08 02:19:34'),(1106,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-08 02:19:34'),(1107,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-08 02:19:34'),(1108,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','3',NULL,'2023-04-08 02:19:34'),(1109,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','20',NULL,'2023-04-08 02:19:34'),(1110,'usuarios_grupos',33,2,'INSERT','status','1',NULL,'2023-04-08 02:19:45'),(1111,'usuarios_grupos',33,2,'INSERT','usuario_id','3',NULL,'2023-04-08 02:19:45'),(1112,'usuarios_grupos',33,2,'INSERT','usuario','2',NULL,'2023-04-08 02:19:45'),(1113,'usuarios_grupos',33,2,'INSERT','grupo_id','3',NULL,'2023-04-08 02:19:45'),(1114,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-08 02:18:56','2023-04-08 02:34:16','2023-04-08 02:34:16'),(1115,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-08 02:34:16','2023-04-09 00:57:00','2023-04-09 00:57:00'),(1116,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-09 00:57:00','2023-04-09 01:04:32','2023-04-09 01:04:32'),(1117,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-09 01:04:32','2023-04-23 14:25:09','2023-04-23 14:25:09'),(1118,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-23 14:25:09','2023-04-23 15:13:50','2023-04-23 15:13:50'),(1119,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-23 15:13:50','2023-04-23 16:39:45','2023-04-23 16:39:45'),(1120,'menus',5,2,'UPDATE','status','0','1','2023-04-23 17:23:11'),(1121,'usuarios',14,2,'UPDATE','nome','a','funcionario','2023-04-23 17:27:56'),(1122,'usuarios',14,2,'UPDATE','login','a@gmail.com','funcionario@email.com','2023-04-23 17:27:56'),(1123,'usuarios',14,2,'UPDATE','senha','$2y$10$RO7D4b41JM1uiZxmZcppbe/.gru0TuWxucIt6zZG6bMs31Azpq0pm','$2y$10$EAW9YOmIdECWXAhAMUyP9uTitfcl0QRty2AlxeXcg0k2Vn1.plvUO','2023-04-23 17:27:56'),(1124,'usuarios',14,2,'UPDATE','status','0','1','2023-04-23 17:27:56'),(1125,'usuarios',14,NULL,'UPDATE','ultimo_acesso','2023-03-29 01:10:54','2023-04-23 17:28:08','2023-04-23 17:28:08'),(1126,'grupos',4,2,'INSERT','id','4',NULL,'2023-04-23 17:29:40'),(1127,'grupos',4,2,'INSERT','nome','Funcionário',NULL,'2023-04-23 17:29:40'),(1128,'grupos',4,2,'INSERT','status','1',NULL,'2023-04-23 17:29:40'),(1129,'grupos',4,2,'INSERT','usuario_id','2',NULL,'2023-04-23 17:29:40'),(1130,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-23 16:39:45','2023-04-23 17:30:37','2023-04-23 17:30:37'),(1131,'permissoes',32,NULL,'UPDATE','status','1','0','2023-04-23 17:32:45'),(1132,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-23 17:38:41'),(1133,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-23 17:38:41'),(1134,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-23 17:38:41'),(1135,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','18',NULL,'2023-04-23 17:38:41'),(1136,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-23 17:38:41'),(1137,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-23 17:38:41'),(1138,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-23 17:38:41'),(1139,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','19',NULL,'2023-04-23 17:38:41'),(1140,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-23 17:38:41'),(1141,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-23 17:38:41'),(1142,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-23 17:38:41'),(1143,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','20',NULL,'2023-04-23 17:38:41'),(1144,'usuarios',14,NULL,'UPDATE','ultimo_acesso','2023-04-23 17:28:08','2023-04-23 17:40:21','2023-04-23 17:40:21'),(1145,'usuarios_grupos',144,2,'INSERT','status','1',NULL,'2023-04-23 17:40:38'),(1146,'usuarios_grupos',144,2,'INSERT','usuario_id','14',NULL,'2023-04-23 17:40:38'),(1147,'usuarios_grupos',144,2,'INSERT','usuario','2',NULL,'2023-04-23 17:40:38'),(1148,'usuarios_grupos',144,2,'INSERT','grupo_id','4',NULL,'2023-04-23 17:40:38'),(1149,'permissoes',32,2,'UPDATE','nome','Cadastrar/Listar/Excluir/Alterar visualizar folha de pagamento','Visualizar folha de pagamento','2023-04-23 17:45:50'),(1150,'permissoes',32,2,'UPDATE','descricao','Cadastro de visualizar endereços','Visualizar folha de pagamento','2023-04-23 17:45:50'),(1151,'permissoes',32,2,'UPDATE','usuario_id',NULL,'2','2023-04-23 17:45:50'),(1152,'menu_itens',15,2,'UPDATE','status','1','0','2023-04-23 18:51:11'),(1153,'menu_itens',15,2,'UPDATE','usuario_id','1','2','2023-04-23 18:51:11'),(1154,'menu_itens',15,2,'UPDATE','nome','Folha de Pagamento','Gerênciar Folha de Pagamento','2023-04-23 18:52:41'),(1155,'menu_itens',15,2,'UPDATE','titulo',NULL,'','2023-04-23 18:52:41'),(1156,'menu_itens',15,2,'UPDATE','class',NULL,'','2023-04-23 18:52:41'),(1157,'menu_itens',15,2,'UPDATE','image',NULL,'','2023-04-23 18:52:41'),(1158,'menu_itens',15,2,'UPDATE','menu_item_id',NULL,'0','2023-04-23 18:52:41'),(1159,'menu_itens',15,2,'UPDATE','status','0','1','2023-04-23 18:52:56'),(1160,'menu_itens',15,2,'UPDATE','status','1','0','2023-04-23 18:53:43'),(1161,'menu_itens',15,2,'UPDATE','descricao','Folha de Pagamento','Gerenciar Folhas de Pagamento','2023-04-23 18:54:27'),(1162,'menu_itens',15,2,'UPDATE','status','0','1','2023-04-23 18:54:30'),(1163,'permissoes',32,2,'UPDATE','status','0','1','2023-04-23 18:58:24'),(1164,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-23 18:58:48'),(1165,'grupos_permissoes',1,2,'DELETE','grupo_id','1',NULL,'2023-04-23 18:58:48'),(1166,'grupos_permissoes',1,2,'DELETE','permissao_id','9',NULL,'2023-04-23 18:58:48'),(1167,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-23 18:58:48'),(1168,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-23 18:58:48'),(1169,'grupos_permissoes',1,2,'DELETE','grupo_id','1',NULL,'2023-04-23 18:58:48'),(1170,'grupos_permissoes',1,2,'DELETE','permissao_id','16',NULL,'2023-04-23 18:58:48'),(1171,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-23 18:58:48'),(1172,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-23 18:58:48'),(1173,'grupos_permissoes',1,2,'DELETE','grupo_id','1',NULL,'2023-04-23 18:58:48'),(1174,'grupos_permissoes',1,2,'DELETE','permissao_id','17',NULL,'2023-04-23 18:58:48'),(1175,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-23 18:58:48'),(1176,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-23 18:58:48'),(1177,'grupos_permissoes',1,2,'DELETE','grupo_id','1',NULL,'2023-04-23 18:58:48'),(1178,'grupos_permissoes',1,2,'DELETE','permissao_id','32',NULL,'2023-04-23 18:58:48'),(1179,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-23 18:58:48'),(1180,'permissoes',32,NULL,'UPDATE','status','1','0','2023-04-23 19:00:25'),(1181,'permissoes',32,NULL,'DELETE','id','32',NULL,'2023-04-23 19:03:15'),(1182,'permissoes',32,NULL,'DELETE','nome','Visualizar folha de pagamento',NULL,'2023-04-23 19:03:15'),(1183,'permissoes',32,NULL,'DELETE','descricao','Visualizar folha de pagamento',NULL,'2023-04-23 19:03:15'),(1184,'permissoes',32,NULL,'DELETE','status','0',NULL,'2023-04-23 19:03:15'),(1185,'permissoes',32,NULL,'DELETE','menu_item_id','16',NULL,'2023-04-23 19:03:15'),(1186,'permissoes',32,NULL,'DELETE','usuario_id',NULL,NULL,'2023-04-23 19:03:15'),(1187,'permissoes',17,2,'UPDATE','nome','5','Visualizar Própria Folha de Pagamento ','2023-04-23 19:04:59'),(1188,'permissoes',17,2,'UPDATE','descricao','5','Visualizar Folha de Pagamento Vinculadas ao Usuário(Funcionário)','2023-04-23 19:04:59'),(1189,'permissoes',17,2,'UPDATE','usuario_id',NULL,'2','2023-04-23 19:04:59'),(1190,'permissoes',17,2,'UPDATE','status','0','1','2023-04-23 19:05:30'),(1191,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-23 19:06:51'),(1192,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-23 19:06:51'),(1193,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-23 19:06:51'),(1194,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','17',NULL,'2023-04-23 19:06:51'),(1195,'permissoes',16,2,'UPDATE','status','0','1','2023-04-23 19:08:00'),(1196,'permissoes',16,2,'UPDATE','usuario_id',NULL,'2','2023-04-23 19:08:00'),(1197,'permissoes',9,2,'UPDATE','status','0','1','2023-04-23 19:08:09'),(1198,'permissoes',9,2,'UPDATE','usuario_id',NULL,'2','2023-04-23 19:08:09'),(1199,'permissoes',9,NULL,'UPDATE','status','1','0','2023-04-23 19:08:31'),(1200,'permissoes',16,NULL,'UPDATE','status','1','0','2023-04-23 19:08:52'),(1201,'permissoes',9,2,'UPDATE','status','0','1','2023-04-23 19:11:23'),(1202,'permissoes',9,2,'UPDATE','usuario_id',NULL,'2','2023-04-23 19:11:23'),(1203,'permissoes',16,2,'UPDATE','status','0','1','2023-04-23 19:11:27'),(1204,'permissoes',16,2,'UPDATE','usuario_id',NULL,'2','2023-04-23 19:11:27'),(1205,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-23 19:11:36'),(1206,'grupos_permissoes',2,2,'DELETE','grupo_id','2',NULL,'2023-04-23 19:11:36'),(1207,'grupos_permissoes',2,2,'DELETE','permissao_id','9',NULL,'2023-04-23 19:11:36'),(1208,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-23 19:11:36'),(1209,'grupos_permissoes',2,2,'DELETE','usuario_id','2',NULL,'2023-04-23 19:11:36'),(1210,'grupos_permissoes',2,2,'DELETE','grupo_id','2',NULL,'2023-04-23 19:11:36'),(1211,'grupos_permissoes',2,2,'DELETE','permissao_id','16',NULL,'2023-04-23 19:11:36'),(1212,'grupos_permissoes',1,2,'DELETE','status','1',NULL,'2023-04-23 19:11:36'),(1213,'permissoes',9,NULL,'UPDATE','status','1','0','2023-04-23 19:11:45'),(1214,'permissoes',16,NULL,'UPDATE','status','1','0','2023-04-23 19:11:48'),(1215,'permissoes',9,NULL,'DELETE','id','9',NULL,'2023-04-23 19:11:51'),(1216,'permissoes',9,NULL,'DELETE','nome','admin',NULL,'2023-04-23 19:11:51'),(1217,'permissoes',9,NULL,'DELETE','descricao','admin',NULL,'2023-04-23 19:11:51'),(1218,'permissoes',9,NULL,'DELETE','status','0',NULL,'2023-04-23 19:11:51'),(1219,'permissoes',9,NULL,'DELETE','menu_item_id','16',NULL,'2023-04-23 19:11:51'),(1220,'permissoes',9,NULL,'DELETE','usuario_id',NULL,NULL,'2023-04-23 19:11:51'),(1221,'permissoes',16,NULL,'DELETE','id','16',NULL,'2023-04-23 19:11:54'),(1222,'permissoes',16,NULL,'DELETE','nome','4',NULL,'2023-04-23 19:11:54'),(1223,'permissoes',16,NULL,'DELETE','descricao','4',NULL,'2023-04-23 19:11:54'),(1224,'permissoes',16,NULL,'DELETE','status','0',NULL,'2023-04-23 19:11:54'),(1225,'permissoes',16,NULL,'DELETE','menu_item_id','16',NULL,'2023-04-23 19:11:54'),(1226,'permissoes',16,NULL,'DELETE','usuario_id',NULL,NULL,'2023-04-23 19:11:54'),(1227,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-23 19:14:07'),(1228,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-23 19:14:07'),(1229,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','4',NULL,'2023-04-23 19:14:07'),(1230,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','17',NULL,'2023-04-23 19:14:07'),(1235,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-23 17:30:37','2023-04-23 21:30:39','2023-04-23 21:30:39'),(1236,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-23 21:30:39','2023-04-23 21:46:12','2023-04-23 21:46:12'),(1237,'usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-23 21:46:12','2023-04-23 21:49:30','2023-04-23 21:49:30'),(1238,'usuarios',0,NULL,'INSERT','id','0',NULL,'2023-04-23 22:54:26'),(1239,'usuarios',0,NULL,'INSERT','nome','teste',NULL,'2023-04-23 22:54:26'),(1240,'usuarios',0,NULL,'INSERT','login','1@gmail.com',NULL,'2023-04-23 22:54:26'),(1241,'usuarios',0,NULL,'INSERT','senha','$2y$10$krLs6Sc/zJ.3Vtr9gpE6huEF2RuxmI51l1EJgoSsCNMMx/RfF3csS',NULL,'2023-04-23 22:54:26'),(1242,'usuarios',0,NULL,'INSERT','ultimo_acesso',NULL,NULL,'2023-04-23 22:54:26'),(1243,'usuarios',0,NULL,'INSERT','imagem',NULL,NULL,'2023-04-23 22:54:26'),(1244,'usuarios',0,NULL,'INSERT','status','1',NULL,'2023-04-23 22:54:26'),(1245,'usuarios',15,2,'UPDATE','status','1','0','2023-04-23 22:54:36'),(1246,'usuarios',15,2,'DELETE','id','15',NULL,'2023-04-23 22:55:41'),(1247,'usuarios',15,2,'DELETE','nome','teste',NULL,'2023-04-23 22:55:41'),(1248,'usuarios',15,2,'DELETE','login','1@gmail.com',NULL,'2023-04-23 22:55:41'),(1249,'usuarios',15,2,'DELETE','senha','$2y$10$krLs6Sc/zJ.3Vtr9gpE6huEF2RuxmI51l1EJgoSsCNMMx/RfF3csS',NULL,'2023-04-23 22:55:41'),(1250,'usuarios',15,2,'DELETE','ultimo_acesso',NULL,NULL,'2023-04-23 22:55:41'),(1251,'usuarios',15,2,'DELETE','imagem',NULL,NULL,'2023-04-23 22:55:41'),(1252,'usuarios',15,2,'DELETE','status','0',NULL,'2023-04-23 22:55:41'),(1253,'usuarios',0,NULL,'INSERT','id','0',NULL,'2023-04-23 22:56:14'),(1254,'usuarios',0,NULL,'INSERT','nome','a',NULL,'2023-04-23 22:56:14'),(1255,'usuarios',0,NULL,'INSERT','login','1@gmail.com',NULL,'2023-04-23 22:56:14'),(1256,'usuarios',0,NULL,'INSERT','senha','$2y$10$z/xc42YAIz5k0i02Gy1fyuB1SsXrbYAn0rkITFdabFNRbbw7TnA1C',NULL,'2023-04-23 22:56:14'),(1257,'usuarios',0,NULL,'INSERT','ultimo_acesso',NULL,NULL,'2023-04-23 22:56:14'),(1258,'usuarios',0,NULL,'INSERT','imagem',NULL,NULL,'2023-04-23 22:56:14'),(1259,'usuarios',0,NULL,'INSERT','status','1',NULL,'2023-04-23 22:56:14'),(1260,'usuarios',16,2,'UPDATE','status','1','0','2023-04-23 22:56:23'),(1261,'permissoes',21,NULL,'UPDATE','status','1','0','2023-04-23 23:00:14'),(1262,'permissoes',21,2,'UPDATE','nome','Cadastrar/Listar/Excluir/Alterar usuários','Cadastrar/Listar/Ecluir/Alterar usuários','2023-04-23 23:00:32'),(1263,'permissoes',21,2,'UPDATE','usuario_id',NULL,'2','2023-04-23 23:00:32'),(1264,'permissoes',21,2,'UPDATE','status','0','1','2023-04-23 23:00:36'),(1265,'permissoes',21,NULL,'UPDATE','status','1','0','2023-04-23 23:01:16'),(1266,'permissoes',21,2,'UPDATE','nome','Cadastrar/Listar/Ecluir/Alterar usuários','Cadastrar/Listar/Excluir/Alterar usuários','2023-04-23 23:01:24'),(1267,'permissoes',21,2,'UPDATE','usuario_id',NULL,'2','2023-04-23 23:01:24'),(1268,'permissoes',21,2,'UPDATE','status','0','1','2023-04-23 23:01:26'),(1269,'usuarios',16,2,'DELETE','id','16',NULL,'2023-04-23 23:06:01'),(1270,'usuarios',16,2,'DELETE','nome','a',NULL,'2023-04-23 23:06:01'),(1271,'usuarios',16,2,'DELETE','login','1@gmail.com',NULL,'2023-04-23 23:06:01'),(1272,'usuarios',16,2,'DELETE','senha','$2y$10$z/xc42YAIz5k0i02Gy1fyuB1SsXrbYAn0rkITFdabFNRbbw7TnA1C',NULL,'2023-04-23 23:06:01'),(1273,'usuarios',16,2,'DELETE','ultimo_acesso',NULL,NULL,'2023-04-23 23:06:01'),(1274,'usuarios',16,2,'DELETE','imagem',NULL,NULL,'2023-04-23 23:06:01'),(1275,'usuarios',16,2,'DELETE','status','0',NULL,'2023-04-23 23:06:01'),(1276,'menus',8,2,'UPDATE','status','1','0','2023-04-23 23:11:37'),(1277,'menus',8,2,'UPDATE','nome','Itens de Menu','Site','2023-04-23 23:14:58'),(1278,'menus',8,2,'UPDATE','descricao','Cadastro de Itens de Menu','Páginas do Site','2023-04-23 23:15:25'),(1279,'menus',8,2,'UPDATE','status','0','1','2023-04-23 23:16:55'),(1280,'menu_itens',0,2,'INSERT','id','0',NULL,'2023-04-23 23:27:13'),(1281,'menu_itens',0,2,'INSERT','nome','Página Inicial',NULL,'2023-04-23 23:27:13'),(1282,'menu_itens',0,2,'INSERT','descricao','Página Inicial do Site',NULL,'2023-04-23 23:27:13'),(1283,'menu_itens',0,2,'INSERT','status','0',NULL,'2023-04-23 23:27:13'),(1284,'menu_itens',0,2,'INSERT','class','',NULL,'2023-04-23 23:27:13'),(1285,'menu_itens',0,2,'INSERT','titulo','',NULL,'2023-04-23 23:27:13'),(1286,'menu_itens',0,2,'INSERT','url','?page=ControllerContent&option=filterByPage&conte_fk_page_pk_id=',NULL,'2023-04-23 23:27:13'),(1287,'menu_itens',0,2,'INSERT','image','',NULL,'2023-04-23 23:27:13'),(1288,'menu_itens',0,2,'INSERT','icone','fas fa-home fa-sm fa-fw mr-2 text-gray-400',NULL,'2023-04-23 23:27:13'),(1289,'menu_itens',0,2,'INSERT','menu_item_id','0',NULL,'2023-04-23 23:27:13'),(1290,'menu_itens',0,2,'INSERT','menu_id','8',NULL,'2023-04-23 23:27:13'),(1291,'menu_itens',0,2,'INSERT','usuario_id','2',NULL,'2023-04-23 23:27:13'),(1292,'menu_itens',24,2,'UPDATE','status','0','1','2023-04-23 23:27:19'),(1293,'menu_itens',0,2,'INSERT','id','0',NULL,'2023-04-23 23:29:55'),(1294,'menu_itens',0,2,'INSERT','nome','Contato',NULL,'2023-04-23 23:29:55'),(1295,'menu_itens',0,2,'INSERT','descricao','Página de informações de Contato ',NULL,'2023-04-23 23:29:55'),(1296,'menu_itens',0,2,'INSERT','status','0',NULL,'2023-04-23 23:29:55'),(1297,'menu_itens',0,2,'INSERT','class','',NULL,'2023-04-23 23:29:55'),(1298,'menu_itens',0,2,'INSERT','titulo','',NULL,'2023-04-23 23:29:55'),(1299,'menu_itens',0,2,'INSERT','url','',NULL,'2023-04-23 23:29:55'),(1300,'menu_itens',0,2,'INSERT','image','',NULL,'2023-04-23 23:29:55'),(1301,'menu_itens',0,2,'INSERT','icone','fas fa-contact fa-sm fa-fw mr-2 text-gray-400',NULL,'2023-04-23 23:29:55'),(1302,'menu_itens',0,2,'INSERT','menu_item_id','0',NULL,'2023-04-23 23:29:55'),(1303,'menu_itens',0,2,'INSERT','menu_id','8',NULL,'2023-04-23 23:29:55'),(1304,'menu_itens',0,2,'INSERT','usuario_id','2',NULL,'2023-04-23 23:29:55'),(1305,'menu_itens',25,2,'UPDATE','status','0','1','2023-04-23 23:29:58'),(1306,'menu_itens',0,2,'INSERT','id','0',NULL,'2023-04-23 23:32:58'),(1307,'menu_itens',0,2,'INSERT','nome','Serviço',NULL,'2023-04-23 23:32:58'),(1308,'menu_itens',0,2,'INSERT','descricao','Serviços que é realizado.',NULL,'2023-04-23 23:32:58'),(1309,'menu_itens',0,2,'INSERT','status','0',NULL,'2023-04-23 23:32:58'),(1310,'menu_itens',0,2,'INSERT','class','',NULL,'2023-04-23 23:32:58'),(1311,'menu_itens',0,2,'INSERT','titulo','',NULL,'2023-04-23 23:32:58'),(1312,'menu_itens',0,2,'INSERT','url','',NULL,'2023-04-23 23:32:58'),(1313,'menu_itens',0,2,'INSERT','image','',NULL,'2023-04-23 23:32:58'),(1314,'menu_itens',0,2,'INSERT','icone','fas fa-fconcierge-bell fa-sm fa-fw mr-2 text-gray-400',NULL,'2023-04-23 23:32:58'),(1315,'menu_itens',0,2,'INSERT','menu_item_id','0',NULL,'2023-04-23 23:32:58'),(1316,'menu_itens',0,2,'INSERT','menu_id','8',NULL,'2023-04-23 23:32:58'),(1317,'menu_itens',0,2,'INSERT','usuario_id','2',NULL,'2023-04-23 23:32:58'),(1318,'menu_itens',26,2,'UPDATE','status','0','1','2023-04-23 23:33:00'),(1319,'menu_itens',0,2,'INSERT','id','0',NULL,'2023-04-23 23:34:20'),(1320,'menu_itens',0,2,'INSERT','nome','Sobre',NULL,'2023-04-23 23:34:20'),(1321,'menu_itens',0,2,'INSERT','descricao','Informações sobre o negócio/empresa',NULL,'2023-04-23 23:34:20'),(1322,'menu_itens',0,2,'INSERT','status','0',NULL,'2023-04-23 23:34:20'),(1323,'menu_itens',0,2,'INSERT','class','',NULL,'2023-04-23 23:34:20'),(1324,'menu_itens',0,2,'INSERT','titulo','',NULL,'2023-04-23 23:34:20'),(1325,'menu_itens',0,2,'INSERT','url','',NULL,'2023-04-23 23:34:20'),(1326,'menu_itens',0,2,'INSERT','image','',NULL,'2023-04-23 23:34:20'),(1327,'menu_itens',0,2,'INSERT','icone','fas fa-address-card fa-sm fa-fw mr-2 text-gray-400',NULL,'2023-04-23 23:34:20'),(1328,'menu_itens',0,2,'INSERT','menu_item_id','0',NULL,'2023-04-23 23:34:20'),(1329,'menu_itens',0,2,'INSERT','menu_id','8',NULL,'2023-04-23 23:34:20'),(1330,'menu_itens',0,2,'INSERT','usuario_id','2',NULL,'2023-04-23 23:34:20'),(1331,'menu_itens',27,2,'UPDATE','status','0','1','2023-04-23 23:34:25'),(1332,'menu_itens',24,2,'UPDATE','status','1','0','2023-04-23 23:34:33'),(1333,'menu_itens',24,2,'UPDATE','descricao','Página Inicial do Site','Página Inicial do Site negócio/empresa','2023-04-23 23:34:45'),(1334,'menu_itens',24,2,'UPDATE','status','0','1','2023-04-23 23:35:21'),(1335,'menu_itens',25,2,'UPDATE','status','1','0','2023-04-23 23:35:29'),(1336,'menu_itens',0,2,'INSERT','id','0',NULL,'2023-04-23 23:43:16'),(1337,'menu_itens',0,2,'INSERT','nome','Página de Entrada',NULL,'2023-04-23 23:43:16'),(1338,'menu_itens',0,2,'INSERT','descricao','Página de Destino(landing page )',NULL,'2023-04-23 23:43:16'),(1339,'menu_itens',0,2,'INSERT','status','0',NULL,'2023-04-23 23:43:16'),(1340,'menu_itens',0,2,'INSERT','class','',NULL,'2023-04-23 23:43:16'),(1341,'menu_itens',0,2,'INSERT','titulo','',NULL,'2023-04-23 23:43:16'),(1342,'menu_itens',0,2,'INSERT','url','',NULL,'2023-04-23 23:43:16'),(1343,'menu_itens',0,2,'INSERT','image','',NULL,'2023-04-23 23:43:16'),(1344,'menu_itens',0,2,'INSERT','icone','fas fa-address-card fa-sm fa-fw mr-2 text-gray-400',NULL,'2023-04-23 23:43:16'),(1345,'menu_itens',0,2,'INSERT','menu_item_id','0',NULL,'2023-04-23 23:43:16'),(1346,'menu_itens',0,2,'INSERT','menu_id','8',NULL,'2023-04-23 23:43:16'),(1347,'menu_itens',0,2,'INSERT','usuario_id','2',NULL,'2023-04-23 23:43:16'),(1348,'menu_itens',24,2,'UPDATE','status','1','0','2023-04-23 23:44:52'),(1349,'menu_itens',24,2,'UPDATE','url','?page=ControllerContent&option=filterByPage&conte_fk_page_pk_id=','?page=ControllerContent&option=filterByPage&conte_fk_page_pk_id=1','2023-04-23 23:45:56'),(1350,'menu_itens',24,2,'UPDATE','status','0','1','2023-04-23 23:46:01'),(1351,'menu_itens',25,2,'UPDATE','url','','?page=ControllerContent&option=filterByPage&conte_fk_page_pk_id=2','2023-04-23 23:46:11'),(1352,'menu_itens',25,2,'UPDATE','status','0','1','2023-04-23 23:46:14'),(1353,'menu_itens',26,2,'UPDATE','status','1','0','2023-04-23 23:46:24'),(1354,'menu_itens',26,2,'UPDATE','url','','?page=ControllerContent&option=filterByPage&conte_fk_page_pk_id=3','2023-04-23 23:46:41'),(1355,'menu_itens',26,2,'UPDATE','status','0','1','2023-04-23 23:46:43'),(1356,'menu_itens',27,2,'UPDATE','status','1','0','2023-04-23 23:46:47'),(1357,'menu_itens',27,2,'UPDATE','url','','?page=ControllerContent&option=filterByPage&conte_fk_page_pk_id=4','2023-04-23 23:47:11'),(1358,'menu_itens',27,2,'UPDATE','status','0','1','2023-04-23 23:47:13'),(1359,'menu_itens',28,2,'UPDATE','url','','?page=ControllerContent&option=filterByPage&conte_fk_page_pk_id=5','2023-04-23 23:47:22'),(1360,'menu_itens',28,2,'UPDATE','status','0','1','2023-04-23 23:47:32'),(1361,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-23 23:50:11'),(1362,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar página home',NULL,'2023-04-23 23:50:11'),(1363,'permissoes',NULL,2,'INSERT','descricao','Gerenciar conteúdo da página inicial do site',NULL,'2023-04-23 23:50:11'),(1364,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-23 23:50:11'),(1365,'permissoes',NULL,2,'INSERT','menu_item_id','24',NULL,'2023-04-23 23:50:11'),(1366,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-23 23:50:11'),(1367,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-23 23:51:00'),(1368,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar página contatos do site',NULL,'2023-04-23 23:51:00'),(1369,'permissoes',NULL,2,'INSERT','descricao','Gerenciar conteúdo da página contatos do site',NULL,'2023-04-23 23:51:00'),(1370,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-23 23:51:00'),(1371,'permissoes',NULL,2,'INSERT','menu_item_id','25',NULL,'2023-04-23 23:51:00'),(1372,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-23 23:51:00'),(1373,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-23 23:51:41'),(1374,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar página serviços do site',NULL,'2023-04-23 23:51:41'),(1375,'permissoes',NULL,2,'INSERT','descricao','Gerenciar conteúdo da página serviços do site',NULL,'2023-04-23 23:51:41'),(1376,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-23 23:51:41'),(1377,'permissoes',NULL,2,'INSERT','menu_item_id','26',NULL,'2023-04-23 23:51:41'),(1378,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-23 23:51:41'),(1379,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-23 23:52:20'),(1380,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar página sobre do site',NULL,'2023-04-23 23:52:20'),(1381,'permissoes',NULL,2,'INSERT','descricao','Gerenciar conteúdo da página sobre do site',NULL,'2023-04-23 23:52:20'),(1382,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-23 23:52:20'),(1383,'permissoes',NULL,2,'INSERT','menu_item_id','27',NULL,'2023-04-23 23:52:20'),(1384,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-23 23:52:20'),(1385,'permissoes',NULL,2,'INSERT','id','0',NULL,'2023-04-23 23:53:16'),(1386,'permissoes',NULL,2,'INSERT','nome','Cadastrar/Listar/Excluir/Alterar página de entrada',NULL,'2023-04-23 23:53:16'),(1387,'permissoes',NULL,2,'INSERT','descricao','Gerenciar conteúdo da página de entrada do site',NULL,'2023-04-23 23:53:16'),(1388,'permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-23 23:53:16'),(1389,'permissoes',NULL,2,'INSERT','menu_item_id','28',NULL,'2023-04-23 23:53:16'),(1390,'permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-23 23:53:16'),(1391,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-23 23:54:13'),(1392,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-23 23:54:13'),(1393,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-23 23:54:13'),(1394,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','36',NULL,'2023-04-23 23:54:13'),(1395,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-23 23:54:13'),(1396,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-23 23:54:13'),(1397,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-23 23:54:13'),(1398,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','37',NULL,'2023-04-23 23:54:13'),(1399,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-23 23:54:13'),(1400,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-23 23:54:13'),(1401,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-23 23:54:13'),(1402,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','38',NULL,'2023-04-23 23:54:13'),(1403,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-23 23:54:13'),(1404,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-23 23:54:13'),(1405,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-23 23:54:13'),(1406,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','39',NULL,'2023-04-23 23:54:13'),(1407,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-23 23:54:13'),(1408,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-23 23:54:13'),(1409,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','1',NULL,'2023-04-23 23:54:13'),(1410,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','40',NULL,'2023-04-23 23:54:13'),(1411,'menus',8,2,'UPDATE','status','1','0','2023-04-23 23:57:03'),(1412,'menus',8,2,'UPDATE','icone','fas fa-list-dropdown fa-fw','fas fa-sliders-h fa-fw','2023-04-23 23:57:15'),(1413,'menus',8,2,'UPDATE','status','0','1','2023-04-23 23:57:21'),(1414,'menu_itens',26,2,'UPDATE','status','1','0','2023-04-23 23:59:27'),(1415,'menu_itens',26,2,'UPDATE','icone','fas fa-fconcierge-bell fa-sm fa-fw mr-2 text-gray-400','fa-regular fa-bell-concierge mr-2 text-gray-400','2023-04-24 00:00:08'),(1416,'menu_itens',26,2,'UPDATE','status','0','1','2023-04-24 00:00:19'),(1417,'menu_itens',26,2,'UPDATE','status','1','0','2023-04-24 00:00:41'),(1418,'menu_itens',26,2,'UPDATE','icone','fa-regular fa-bell-concierge mr-2 text-gray-400','fas fa-bell-concierge fa-fw mr-2 text-gray-400','2023-04-24 00:02:12'),(1419,'menu_itens',26,2,'UPDATE','status','0','1','2023-04-24 00:02:14'),(1420,'menu_itens',26,2,'UPDATE','status','1','0','2023-04-24 00:02:31'),(1421,'menu_itens',26,2,'UPDATE','status','0','1','2023-04-24 00:02:51'),(1422,'menu_itens',25,2,'UPDATE','status','1','0','2023-04-24 00:02:56'),(1423,'menu_itens',25,2,'UPDATE','status','0','1','2023-04-24 00:05:40'),(1424,'menu_itens',25,2,'UPDATE','status','1','0','2023-04-24 00:06:35'),(1425,'menu_itens',25,2,'UPDATE','icone','fas fa-contact fa-sm fa-fw mr-2 text-gray-400','fas fa-address-contact fa-sm fa-fw mr-2 text-gray-400','2023-04-24 00:07:14'),(1426,'menu_itens',25,2,'UPDATE','status','0','1','2023-04-24 00:07:16'),(1427,'menu_itens',25,2,'UPDATE','status','1','0','2023-04-24 00:08:09'),(1428,'menu_itens',25,2,'UPDATE','icone','fas fa-address-contact fa-sm fa-fw mr-2 text-gray-400','fas fa-address-book fa-sm fa-fw mr-2 text-gray-400','2023-04-24 00:08:23'),(1429,'menu_itens',25,2,'UPDATE','status','0','1','2023-04-24 00:08:25'),(1430,'menu_itens',28,2,'UPDATE','status','1','0','2023-04-24 00:09:45'),(1431,'menu_itens',28,2,'UPDATE','icone','fas fa-address-card fa-sm fa-fw mr-2 text-gray-400','fas fa-plane-arrival fa-sm fa-fw mr-2 text-gray-400','2023-04-24 00:09:57'),(1432,'menu_itens',28,2,'UPDATE','status','0','1','2023-04-24 00:09:59'),(1433,'grupos',0,2,'INSERT','id','0',NULL,'2023-04-24 00:11:05'),(1434,'grupos',0,2,'INSERT','nome','Marketing',NULL,'2023-04-24 00:11:05'),(1435,'grupos',0,2,'INSERT','status','1',NULL,'2023-04-24 00:11:05'),(1436,'grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-24 00:11:05'),(1437,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-24 00:12:18'),(1438,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 00:12:18'),(1439,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','13',NULL,'2023-04-24 00:12:18'),(1440,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','18',NULL,'2023-04-24 00:12:18'),(1441,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-24 00:12:18'),(1442,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 00:12:18'),(1443,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','13',NULL,'2023-04-24 00:12:18'),(1444,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','19',NULL,'2023-04-24 00:12:18'),(1445,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-24 00:12:18'),(1446,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 00:12:18'),(1447,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','13',NULL,'2023-04-24 00:12:18'),(1448,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','20',NULL,'2023-04-24 00:12:18'),(1449,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-24 00:12:18'),(1450,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 00:12:18'),(1451,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','13',NULL,'2023-04-24 00:12:18'),(1452,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','24',NULL,'2023-04-24 00:12:18'),(1453,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-24 00:12:18'),(1454,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 00:12:18'),(1455,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','13',NULL,'2023-04-24 00:12:18'),(1456,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','25',NULL,'2023-04-24 00:12:18'),(1457,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-24 00:12:18'),(1458,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 00:12:18'),(1459,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','13',NULL,'2023-04-24 00:12:18'),(1460,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','37',NULL,'2023-04-24 00:12:18'),(1461,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-24 00:12:18'),(1462,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 00:12:18'),(1463,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','13',NULL,'2023-04-24 00:12:18'),(1464,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','38',NULL,'2023-04-24 00:12:18'),(1465,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-24 00:12:18'),(1466,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 00:12:18'),(1467,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','13',NULL,'2023-04-24 00:12:18'),(1468,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','39',NULL,'2023-04-24 00:12:18'),(1469,'usuarios_permissoes',NULL,2,'INSERT','status','1',NULL,'2023-04-24 00:12:18'),(1470,'usuarios_permissoes',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 00:12:18'),(1471,'usuarios_permissoes',NULL,2,'INSERT','grupo_id','13',NULL,'2023-04-24 00:12:18'),(1472,'usuarios_permissoes',NULL,2,'INSERT','permissao_id','40',NULL,'2023-04-24 00:12:18'),(1473,'usuarios',0,NULL,'INSERT','id','0',NULL,'2023-04-24 00:18:56'),(1474,'usuarios',0,NULL,'INSERT','nome','a',NULL,'2023-04-24 00:18:56'),(1475,'usuarios',0,NULL,'INSERT','login','1@gmail.com',NULL,'2023-04-24 00:18:56'),(1476,'usuarios',0,NULL,'INSERT','senha','$2y$10$.DjBS/wHYj.Zv6gmr8Q1T.y0nL/J12Leq3RMFWz8x5bKTahkPjyg6',NULL,'2023-04-24 00:18:56'),(1477,'usuarios',0,NULL,'INSERT','ultimo_acesso',NULL,NULL,'2023-04-24 00:18:56'),(1478,'usuarios',0,NULL,'INSERT','imagem',NULL,NULL,'2023-04-24 00:18:56'),(1479,'usuarios',0,NULL,'INSERT','status','1',NULL,'2023-04-24 00:18:56'),(1480,'usuarios',17,2,'UPDATE','status','1','0','2023-04-24 00:19:03'),(1481,'menu_itens',14,1,'UPDATE','url','?page=ControllerContact&option=listar','?page=ControllerContato&option=listar','2023-04-24 00:54:27'),(1482,'usuarios',17,2,'DELETE','id','17',NULL,'2023-04-24 02:03:31'),(1483,'usuarios',17,2,'DELETE','nome','a',NULL,'2023-04-24 02:03:31'),(1484,'usuarios',17,2,'DELETE','login','1@gmail.com',NULL,'2023-04-24 02:03:31'),(1485,'usuarios',17,2,'DELETE','senha','$2y$10$.DjBS/wHYj.Zv6gmr8Q1T.y0nL/J12Leq3RMFWz8x5bKTahkPjyg6',NULL,'2023-04-24 02:03:31'),(1486,'usuarios',17,2,'DELETE','ultimo_acesso',NULL,NULL,'2023-04-24 02:03:31'),(1487,'usuarios',17,2,'DELETE','imagem',NULL,NULL,'2023-04-24 02:03:31'),(1488,'usuarios',17,2,'DELETE','status','0',NULL,'2023-04-24 02:03:31'),(1489,'enderecos',NULL,2,'INSERT','id','0',NULL,'2023-04-24 02:06:38'),(1490,'enderecos',NULL,2,'INSERT','logradouro',NULL,NULL,'2023-04-24 02:06:38'),(1491,'enderecos',NULL,2,'INSERT','numero',NULL,NULL,'2023-04-24 02:06:38'),(1492,'enderecos',NULL,2,'INSERT','bairro',NULL,NULL,'2023-04-24 02:06:38'),(1493,'enderecos',NULL,2,'INSERT','cep',NULL,NULL,'2023-04-24 02:06:38'),(1494,'enderecos',NULL,2,'INSERT','status','1',NULL,'2023-04-24 02:06:38'),(1495,'enderecos',NULL,2,'INSERT','cidade_id',NULL,NULL,'2023-04-24 02:06:38'),(1496,'enderecos',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 02:06:38'),(1497,'enderecos',NULL,2,'INSERT','id','0',NULL,'2023-04-24 02:07:30'),(1498,'enderecos',NULL,2,'INSERT','logradouro',NULL,NULL,'2023-04-24 02:07:30'),(1499,'enderecos',NULL,2,'INSERT','numero',NULL,NULL,'2023-04-24 02:07:30'),(1500,'enderecos',NULL,2,'INSERT','bairro',NULL,NULL,'2023-04-24 02:07:30'),(1501,'enderecos',NULL,2,'INSERT','cep',NULL,NULL,'2023-04-24 02:07:30'),(1502,'enderecos',NULL,2,'INSERT','status','1',NULL,'2023-04-24 02:07:30'),(1503,'enderecos',NULL,2,'INSERT','cidade_id',NULL,NULL,'2023-04-24 02:07:30'),(1504,'enderecos',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 02:07:30'),(1505,'enderecos',NULL,2,'INSERT','id','0',NULL,'2023-04-24 02:07:46'),(1506,'enderecos',NULL,2,'INSERT','logradouro',NULL,NULL,'2023-04-24 02:07:46'),(1507,'enderecos',NULL,2,'INSERT','numero',NULL,NULL,'2023-04-24 02:07:46'),(1508,'enderecos',NULL,2,'INSERT','bairro',NULL,NULL,'2023-04-24 02:07:46'),(1509,'enderecos',NULL,2,'INSERT','cep',NULL,NULL,'2023-04-24 02:07:46'),(1510,'enderecos',NULL,2,'INSERT','status','1',NULL,'2023-04-24 02:07:46'),(1511,'enderecos',NULL,2,'INSERT','cidade_id',NULL,NULL,'2023-04-24 02:07:46'),(1512,'enderecos',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 02:07:46'),(1513,'enderecos',NULL,2,'INSERT','id','0',NULL,'2023-04-24 02:08:07'),(1514,'enderecos',NULL,2,'INSERT','logradouro',NULL,NULL,'2023-04-24 02:08:07'),(1515,'enderecos',NULL,2,'INSERT','numero',NULL,NULL,'2023-04-24 02:08:07'),(1516,'enderecos',NULL,2,'INSERT','bairro',NULL,NULL,'2023-04-24 02:08:07'),(1517,'enderecos',NULL,2,'INSERT','cep',NULL,NULL,'2023-04-24 02:08:07'),(1518,'enderecos',NULL,2,'INSERT','status','1',NULL,'2023-04-24 02:08:07'),(1519,'enderecos',NULL,2,'INSERT','cidade_id',NULL,NULL,'2023-04-24 02:08:07'),(1520,'enderecos',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 02:08:07'),(1521,'enderecos',NULL,2,'INSERT','id','0',NULL,'2023-04-24 02:09:18'),(1522,'enderecos',NULL,2,'INSERT','logradouro',NULL,NULL,'2023-04-24 02:09:18'),(1523,'enderecos',NULL,2,'INSERT','numero',NULL,NULL,'2023-04-24 02:09:18'),(1524,'enderecos',NULL,2,'INSERT','bairro',NULL,NULL,'2023-04-24 02:09:18'),(1525,'enderecos',NULL,2,'INSERT','cep',NULL,NULL,'2023-04-24 02:09:18'),(1526,'enderecos',NULL,2,'INSERT','status','1',NULL,'2023-04-24 02:09:18'),(1527,'enderecos',NULL,2,'INSERT','cidade_id',NULL,NULL,'2023-04-24 02:09:18'),(1528,'enderecos',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 02:09:18'),(1529,'contatos',1,NULL,'INSERT','id',NULL,'1','2023-04-24 02:09:18'),(1530,'contatos',1,NULL,'INSERT','descricao',NULL,'Contato de usuário padrão.','2023-04-24 02:09:18'),(1531,'contatos',1,NULL,'INSERT','telefone',NULL,NULL,'2023-04-24 02:09:18'),(1532,'contatos',1,NULL,'INSERT','celular',NULL,NULL,'2023-04-24 02:09:18'),(1533,'contatos',1,NULL,'INSERT','whatsapp',NULL,NULL,'2023-04-24 02:09:18'),(1534,'contatos',1,NULL,'INSERT','email',NULL,'1@gmail.com','2023-04-24 02:09:18'),(1535,'contatos',1,NULL,'INSERT','facebook',NULL,NULL,'2023-04-24 02:09:18'),(1536,'contatos',1,NULL,'INSERT','instagram',NULL,NULL,'2023-04-24 02:09:18'),(1537,'contatos',1,NULL,'INSERT','twitter',NULL,NULL,'2023-04-24 02:09:18'),(1538,'contatos',1,NULL,'INSERT','observacao',NULL,'Contato de usuário padrão.','2023-04-24 02:09:18'),(1539,'contatos',1,NULL,'INSERT','status',NULL,'1','2023-04-24 02:09:18'),(1540,'contatos',1,NULL,'INSERT','usuario_id',NULL,NULL,'2023-04-24 02:09:18'),(1541,'enderecos',NULL,2,'INSERT','id','0',NULL,'2023-04-24 02:11:39'),(1542,'enderecos',NULL,2,'INSERT','logradouro',NULL,NULL,'2023-04-24 02:11:39'),(1543,'enderecos',NULL,2,'INSERT','numero',NULL,NULL,'2023-04-24 02:11:39'),(1544,'enderecos',NULL,2,'INSERT','bairro',NULL,NULL,'2023-04-24 02:11:39'),(1545,'enderecos',NULL,2,'INSERT','cep',NULL,NULL,'2023-04-24 02:11:39'),(1546,'enderecos',NULL,2,'INSERT','status','1',NULL,'2023-04-24 02:11:39'),(1547,'enderecos',NULL,2,'INSERT','cidade_id',NULL,NULL,'2023-04-24 02:11:39'),(1548,'enderecos',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 02:11:39'),(1549,'contatos',2,NULL,'INSERT','id',NULL,'2','2023-04-24 02:11:39'),(1550,'contatos',2,NULL,'INSERT','descricao',NULL,'Contato de usuário padrão.','2023-04-24 02:11:39'),(1551,'contatos',2,NULL,'INSERT','telefone',NULL,NULL,'2023-04-24 02:11:39'),(1552,'contatos',2,NULL,'INSERT','celular',NULL,NULL,'2023-04-24 02:11:39'),(1553,'contatos',2,NULL,'INSERT','whatsapp',NULL,NULL,'2023-04-24 02:11:39'),(1554,'contatos',2,NULL,'INSERT','email',NULL,'1@gmail.com','2023-04-24 02:11:39'),(1555,'contatos',2,NULL,'INSERT','facebook',NULL,NULL,'2023-04-24 02:11:39'),(1556,'contatos',2,NULL,'INSERT','instagram',NULL,NULL,'2023-04-24 02:11:39'),(1557,'contatos',2,NULL,'INSERT','twitter',NULL,NULL,'2023-04-24 02:11:39'),(1558,'contatos',2,NULL,'INSERT','observacao',NULL,'Contato de usuário padrão.','2023-04-24 02:11:39'),(1559,'contatos',2,NULL,'INSERT','status',NULL,'1','2023-04-24 02:11:39'),(1560,'contatos',2,NULL,'INSERT','usuario_id',NULL,NULL,'2023-04-24 02:11:39'),(1561,'usuarios',18,NULL,'INSERT','id',NULL,'18','2023-04-24 02:13:31'),(1562,'usuarios',18,NULL,'INSERT','nome',NULL,'a','2023-04-24 02:13:31'),(1563,'usuarios',18,NULL,'INSERT','login',NULL,'1@gmail.com','2023-04-24 02:13:31'),(1564,'usuarios',18,NULL,'INSERT','senha',NULL,'$2y$10$sqXhRiFwWEE8IJNsXM3TYuHB3ZjdL0z33F0nujAdL.DXaUfNX2m32','2023-04-24 02:13:31'),(1565,'usuarios',18,NULL,'INSERT','ultimo_acesso',NULL,NULL,'2023-04-24 02:13:31'),(1566,'usuarios',18,NULL,'INSERT','imagem',NULL,NULL,'2023-04-24 02:13:31'),(1567,'usuarios',18,NULL,'INSERT','status',NULL,'1','2023-04-24 02:13:31'),(1568,'enderecos',NULL,2,'INSERT','id','0',NULL,'2023-04-24 02:13:31'),(1569,'enderecos',NULL,2,'INSERT','logradouro',NULL,NULL,'2023-04-24 02:13:31'),(1570,'enderecos',NULL,2,'INSERT','numero',NULL,NULL,'2023-04-24 02:13:31'),(1571,'enderecos',NULL,2,'INSERT','bairro',NULL,NULL,'2023-04-24 02:13:31'),(1572,'enderecos',NULL,2,'INSERT','cep',NULL,NULL,'2023-04-24 02:13:31'),(1573,'enderecos',NULL,2,'INSERT','status','1',NULL,'2023-04-24 02:13:31'),(1574,'enderecos',NULL,2,'INSERT','cidade_id',NULL,NULL,'2023-04-24 02:13:31'),(1575,'enderecos',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 02:13:31'),(1576,'contatos',3,NULL,'INSERT','id',NULL,'3','2023-04-24 02:13:31'),(1577,'contatos',3,NULL,'INSERT','descricao',NULL,'Contato de usuário padrão.','2023-04-24 02:13:31'),(1578,'contatos',3,NULL,'INSERT','telefone',NULL,NULL,'2023-04-24 02:13:31'),(1579,'contatos',3,NULL,'INSERT','celular',NULL,NULL,'2023-04-24 02:13:31'),(1580,'contatos',3,NULL,'INSERT','whatsapp',NULL,NULL,'2023-04-24 02:13:31'),(1581,'contatos',3,NULL,'INSERT','email',NULL,'1@gmail.com','2023-04-24 02:13:31'),(1582,'contatos',3,NULL,'INSERT','facebook',NULL,NULL,'2023-04-24 02:13:31'),(1583,'contatos',3,NULL,'INSERT','instagram',NULL,NULL,'2023-04-24 02:13:31'),(1584,'contatos',3,NULL,'INSERT','twitter',NULL,NULL,'2023-04-24 02:13:31'),(1585,'contatos',3,NULL,'INSERT','observacao',NULL,'Contato de usuário padrão.','2023-04-24 02:13:31'),(1586,'contatos',3,NULL,'INSERT','status',NULL,'1','2023-04-24 02:13:31'),(1587,'contatos',3,NULL,'INSERT','usuario_id',NULL,NULL,'2023-04-24 02:13:31'),(1588,'usuarios',18,2,'UPDATE','status','1','0','2023-04-24 02:35:41'),(1593,'grupos',14,1,'INSERT','id','14',NULL,'2023-04-24 03:21:05'),(1594,'grupos',14,1,'INSERT','nome','bk',NULL,'2023-04-24 03:21:05'),(1595,'grupos',14,1,'INSERT','status','1',NULL,'2023-04-24 03:21:05'),(1596,'grupos',14,1,'INSERT','usuario_id','1',NULL,'2023-04-24 03:21:05'),(1597,'usuarios_grupos',1418,2,'UPDATE','grupo_id','13','14','2023-04-24 03:22:06'),(1598,'usuarios_grupos',1419,2,'UPDATE','grupo_id','13','14','2023-04-24 03:22:06'),(1599,'usuarios_grupos',1420,2,'UPDATE','grupo_id','13','14','2023-04-24 03:22:06'),(1600,'usuarios_grupos',1424,2,'UPDATE','grupo_id','13','14','2023-04-24 03:22:06'),(1601,'usuarios_grupos',1425,2,'UPDATE','grupo_id','13','14','2023-04-24 03:22:06'),(1602,'usuarios_grupos',1437,2,'UPDATE','grupo_id','13','14','2023-04-24 03:22:06'),(1603,'usuarios_grupos',1438,2,'UPDATE','grupo_id','13','14','2023-04-24 03:22:06'),(1604,'usuarios_grupos',1439,2,'UPDATE','grupo_id','13','14','2023-04-24 03:22:06'),(1605,'usuarios_grupos',1440,2,'UPDATE','grupo_id','13','14','2023-04-24 03:22:06'),(1606,'usuarios_grupos',518,2,'UPDATE','grupo_id','14','5','2023-04-24 03:23:44'),(1607,'usuarios_grupos',519,2,'UPDATE','grupo_id','14','5','2023-04-24 03:23:44'),(1608,'usuarios_grupos',520,2,'UPDATE','grupo_id','14','5','2023-04-24 03:23:44'),(1609,'usuarios_grupos',524,2,'UPDATE','grupo_id','14','5','2023-04-24 03:23:44'),(1610,'usuarios_grupos',525,2,'UPDATE','grupo_id','14','5','2023-04-24 03:23:44'),(1611,'usuarios_grupos',537,2,'UPDATE','grupo_id','14','5','2023-04-24 03:23:44'),(1612,'usuarios_grupos',538,2,'UPDATE','grupo_id','14','5','2023-04-24 03:23:44'),(1613,'usuarios_grupos',539,2,'UPDATE','grupo_id','14','5','2023-04-24 03:23:44'),(1614,'usuarios_grupos',540,2,'UPDATE','grupo_id','14','5','2023-04-24 03:23:44'),(1615,'grupos',14,2,'UPDATE','status','1','0','2023-04-24 03:50:14'),(1616,'grupos',14,2,'UPDATE','usuario_id','1','2','2023-04-24 03:50:14'),(1617,'grupos',14,2,'DELETE','id','14',NULL,'2023-04-24 03:50:21'),(1618,'grupos',14,2,'DELETE','nome','bk',NULL,'2023-04-24 03:50:21'),(1619,'grupos',14,2,'DELETE','status','0',NULL,'2023-04-24 03:50:21'),(1620,'grupos',14,2,'DELETE','usuario_id','2',NULL,'2023-04-24 03:50:21'),(1621,'contatos',1,NULL,'DELETE','id','1',NULL,'2023-04-24 04:17:25'),(1622,'contatos',1,NULL,'DELETE','descricao','Contato de usuário padrão.',NULL,'2023-04-24 04:17:25'),(1623,'contatos',1,NULL,'DELETE','telefone',NULL,NULL,'2023-04-24 04:17:25'),(1624,'contatos',1,NULL,'DELETE','celular',NULL,NULL,'2023-04-24 04:17:25'),(1625,'contatos',1,NULL,'DELETE','whatsapp',NULL,NULL,'2023-04-24 04:17:25'),(1626,'contatos',1,NULL,'DELETE','email','1@gmail.com',NULL,'2023-04-24 04:17:25'),(1627,'contatos',1,NULL,'DELETE','facebook',NULL,NULL,'2023-04-24 04:17:25'),(1628,'contatos',1,NULL,'DELETE','instagram',NULL,NULL,'2023-04-24 04:17:25'),(1629,'contatos',1,NULL,'DELETE','twitter',NULL,NULL,'2023-04-24 04:17:25'),(1630,'contatos',1,NULL,'DELETE','observacao','Contato de usuário padrão.',NULL,'2023-04-24 04:17:25'),(1631,'contatos',1,NULL,'DELETE','status','1',NULL,'2023-04-24 04:17:25'),(1632,'contatos',1,NULL,'DELETE','usuario_id',NULL,NULL,'2023-04-24 04:17:25'),(1633,'contatos',2,NULL,'DELETE','id','2',NULL,'2023-04-24 04:17:25'),(1634,'contatos',2,NULL,'DELETE','descricao','Contato de usuário padrão.',NULL,'2023-04-24 04:17:25'),(1635,'contatos',2,NULL,'DELETE','telefone',NULL,NULL,'2023-04-24 04:17:25'),(1636,'contatos',2,NULL,'DELETE','celular',NULL,NULL,'2023-04-24 04:17:25'),(1637,'contatos',2,NULL,'DELETE','whatsapp',NULL,NULL,'2023-04-24 04:17:25'),(1638,'contatos',2,NULL,'DELETE','email','1@gmail.com',NULL,'2023-04-24 04:17:25'),(1639,'contatos',2,NULL,'DELETE','facebook',NULL,NULL,'2023-04-24 04:17:25'),(1640,'contatos',2,NULL,'DELETE','instagram',NULL,NULL,'2023-04-24 04:17:25'),(1641,'contatos',2,NULL,'DELETE','twitter',NULL,NULL,'2023-04-24 04:17:25'),(1642,'contatos',2,NULL,'DELETE','observacao','Contato de usuário padrão.',NULL,'2023-04-24 04:17:25'),(1643,'contatos',2,NULL,'DELETE','status','1',NULL,'2023-04-24 04:17:25'),(1644,'contatos',2,NULL,'DELETE','usuario_id',NULL,NULL,'2023-04-24 04:17:25'),(1645,'contatos',3,NULL,'DELETE','id','3',NULL,'2023-04-24 04:17:25'),(1646,'contatos',3,NULL,'DELETE','descricao','Contato de usuário padrão.',NULL,'2023-04-24 04:17:25'),(1647,'contatos',3,NULL,'DELETE','telefone',NULL,NULL,'2023-04-24 04:17:25'),(1648,'contatos',3,NULL,'DELETE','celular',NULL,NULL,'2023-04-24 04:17:25'),(1649,'contatos',3,NULL,'DELETE','whatsapp',NULL,NULL,'2023-04-24 04:17:25'),(1650,'contatos',3,NULL,'DELETE','email','1@gmail.com',NULL,'2023-04-24 04:17:25'),(1651,'contatos',3,NULL,'DELETE','facebook',NULL,NULL,'2023-04-24 04:17:25'),(1652,'contatos',3,NULL,'DELETE','instagram',NULL,NULL,'2023-04-24 04:17:25'),(1653,'contatos',3,NULL,'DELETE','twitter',NULL,NULL,'2023-04-24 04:17:25'),(1654,'contatos',3,NULL,'DELETE','observacao','Contato de usuário padrão.',NULL,'2023-04-24 04:17:25'),(1655,'contatos',3,NULL,'DELETE','status','1',NULL,'2023-04-24 04:17:25'),(1656,'contatos',3,NULL,'DELETE','usuario_id',NULL,NULL,'2023-04-24 04:17:25'),(1657,'usuarios',18,2,'DELETE','id','18',NULL,'2023-04-24 04:19:48'),(1658,'usuarios',18,2,'DELETE','nome','a',NULL,'2023-04-24 04:19:48'),(1659,'usuarios',18,2,'DELETE','login','1@gmail.com',NULL,'2023-04-24 04:19:48'),(1660,'usuarios',18,2,'DELETE','senha','$2y$10$sqXhRiFwWEE8IJNsXM3TYuHB3ZjdL0z33F0nujAdL.DXaUfNX2m32',NULL,'2023-04-24 04:19:48'),(1661,'usuarios',18,2,'DELETE','ultimo_acesso',NULL,NULL,'2023-04-24 04:19:48'),(1662,'usuarios',18,2,'DELETE','imagem',NULL,NULL,'2023-04-24 04:19:48'),(1663,'usuarios',18,2,'DELETE','status','0',NULL,'2023-04-24 04:19:48'),(1664,'usuarios',19,NULL,'INSERT','id',NULL,'19','2023-04-24 04:20:52'),(1665,'usuarios',19,NULL,'INSERT','nome',NULL,'a','2023-04-24 04:20:52'),(1666,'usuarios',19,NULL,'INSERT','login',NULL,'1@gmail.com','2023-04-24 04:20:52'),(1667,'usuarios',19,NULL,'INSERT','senha',NULL,'$2y$10$YN4PjyAlpS47yfCqId38yONxt6bLqjlKc49v5uUh19I4QxYf8JGoK','2023-04-24 04:20:52'),(1668,'usuarios',19,NULL,'INSERT','ultimo_acesso',NULL,NULL,'2023-04-24 04:20:52'),(1669,'usuarios',19,NULL,'INSERT','imagem',NULL,NULL,'2023-04-24 04:20:52'),(1670,'usuarios',19,NULL,'INSERT','status',NULL,'1','2023-04-24 04:20:52'),(1671,'enderecos',NULL,2,'INSERT','id','0',NULL,'2023-04-24 04:20:53'),(1672,'enderecos',NULL,2,'INSERT','logradouro',NULL,NULL,'2023-04-24 04:20:53'),(1673,'enderecos',NULL,2,'INSERT','numero',NULL,NULL,'2023-04-24 04:20:53'),(1674,'enderecos',NULL,2,'INSERT','bairro',NULL,NULL,'2023-04-24 04:20:53'),(1675,'enderecos',NULL,2,'INSERT','cep',NULL,NULL,'2023-04-24 04:20:53'),(1676,'enderecos',NULL,2,'INSERT','status','1',NULL,'2023-04-24 04:20:53'),(1677,'enderecos',NULL,2,'INSERT','cidade_id',NULL,NULL,'2023-04-24 04:20:53'),(1678,'enderecos',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 04:20:53'),(1679,'contatos',4,NULL,'INSERT','id',NULL,'4','2023-04-24 04:20:53'),(1680,'contatos',4,NULL,'INSERT','descricao',NULL,'Contato de usuário padrão.','2023-04-24 04:20:53'),(1681,'contatos',4,NULL,'INSERT','telefone',NULL,NULL,'2023-04-24 04:20:53'),(1682,'contatos',4,NULL,'INSERT','celular',NULL,NULL,'2023-04-24 04:20:53'),(1683,'contatos',4,NULL,'INSERT','whatsapp',NULL,NULL,'2023-04-24 04:20:53'),(1684,'contatos',4,NULL,'INSERT','email',NULL,'1@gmail.com','2023-04-24 04:20:53'),(1685,'contatos',4,NULL,'INSERT','facebook',NULL,NULL,'2023-04-24 04:20:53'),(1686,'contatos',4,NULL,'INSERT','instagram',NULL,NULL,'2023-04-24 04:20:53'),(1687,'contatos',4,NULL,'INSERT','twitter',NULL,NULL,'2023-04-24 04:20:53'),(1688,'contatos',4,NULL,'INSERT','observacao',NULL,'Contato de usuário padrão.','2023-04-24 04:20:53'),(1689,'contatos',4,NULL,'INSERT','status',NULL,'1','2023-04-24 04:20:53'),(1690,'contatos',4,NULL,'INSERT','usuario_id',NULL,NULL,'2023-04-24 04:20:53'),(1691,'usuarios',19,2,'UPDATE','status','1','0','2023-04-24 04:21:20'),(1692,'enderecos',1,2,'DELETE','id','1',NULL,'2023-04-24 04:25:13'),(1693,'enderecos',1,2,'DELETE','logradouro','Logradouro',NULL,'2023-04-24 04:25:13'),(1694,'enderecos',1,2,'DELETE','numero','s/n',NULL,'2023-04-24 04:25:13'),(1695,'enderecos',1,2,'DELETE','bairro','Bairro',NULL,'2023-04-24 04:25:13'),(1696,'enderecos',1,2,'DELETE','cep','00.000-000',NULL,'2023-04-24 04:25:13'),(1697,'enderecos',1,2,'DELETE','status','1',NULL,'2023-04-24 04:25:13'),(1698,'enderecos',1,2,'DELETE','cidade_id','950',NULL,'2023-04-24 04:25:13'),(1699,'enderecos',1,2,'DELETE','usuario_id','2',NULL,'2023-04-24 04:25:13'),(1700,'enderecos',37,2,'DELETE','id','37',NULL,'2023-04-24 04:25:13'),(1701,'enderecos',37,2,'DELETE','logradouro',NULL,NULL,'2023-04-24 04:25:13'),(1702,'enderecos',37,2,'DELETE','numero',NULL,NULL,'2023-04-24 04:25:13'),(1703,'enderecos',37,2,'DELETE','bairro',NULL,NULL,'2023-04-24 04:25:13'),(1704,'enderecos',37,2,'DELETE','cep',NULL,NULL,'2023-04-24 04:25:13'),(1705,'enderecos',37,2,'DELETE','status','1',NULL,'2023-04-24 04:25:13'),(1706,'enderecos',37,2,'DELETE','cidade_id',NULL,NULL,'2023-04-24 04:25:13'),(1707,'enderecos',37,2,'DELETE','usuario_id','2',NULL,'2023-04-24 04:25:13'),(1708,'enderecos',38,2,'DELETE','id','38',NULL,'2023-04-24 04:25:13'),(1709,'enderecos',38,2,'DELETE','logradouro',NULL,NULL,'2023-04-24 04:25:13'),(1710,'enderecos',38,2,'DELETE','numero',NULL,NULL,'2023-04-24 04:25:13'),(1711,'enderecos',38,2,'DELETE','bairro',NULL,NULL,'2023-04-24 04:25:13'),(1712,'enderecos',38,2,'DELETE','cep',NULL,NULL,'2023-04-24 04:25:13'),(1713,'enderecos',38,2,'DELETE','status','1',NULL,'2023-04-24 04:25:13'),(1714,'enderecos',38,2,'DELETE','cidade_id',NULL,NULL,'2023-04-24 04:25:13'),(1715,'enderecos',38,2,'DELETE','usuario_id','2',NULL,'2023-04-24 04:25:13'),(1716,'enderecos',39,2,'DELETE','id','39',NULL,'2023-04-24 04:25:13'),(1717,'enderecos',39,2,'DELETE','logradouro',NULL,NULL,'2023-04-24 04:25:13'),(1718,'enderecos',39,2,'DELETE','numero',NULL,NULL,'2023-04-24 04:25:13'),(1719,'enderecos',39,2,'DELETE','bairro',NULL,NULL,'2023-04-24 04:25:13'),(1720,'enderecos',39,2,'DELETE','cep',NULL,NULL,'2023-04-24 04:25:13'),(1721,'enderecos',39,2,'DELETE','status','1',NULL,'2023-04-24 04:25:13'),(1722,'enderecos',39,2,'DELETE','cidade_id',NULL,NULL,'2023-04-24 04:25:13'),(1723,'enderecos',39,2,'DELETE','usuario_id','2',NULL,'2023-04-24 04:25:13'),(1724,'enderecos',40,2,'DELETE','id','40',NULL,'2023-04-24 04:25:13'),(1725,'enderecos',40,2,'DELETE','logradouro',NULL,NULL,'2023-04-24 04:25:13'),(1726,'enderecos',40,2,'DELETE','numero',NULL,NULL,'2023-04-24 04:25:13'),(1727,'enderecos',40,2,'DELETE','bairro',NULL,NULL,'2023-04-24 04:25:13'),(1728,'enderecos',40,2,'DELETE','cep',NULL,NULL,'2023-04-24 04:25:13'),(1729,'enderecos',40,2,'DELETE','status','1',NULL,'2023-04-24 04:25:13'),(1730,'enderecos',40,2,'DELETE','cidade_id',NULL,NULL,'2023-04-24 04:25:13'),(1731,'enderecos',40,2,'DELETE','usuario_id','2',NULL,'2023-04-24 04:25:13'),(1732,'enderecos',41,2,'DELETE','id','41',NULL,'2023-04-24 04:25:13'),(1733,'enderecos',41,2,'DELETE','logradouro',NULL,NULL,'2023-04-24 04:25:13'),(1734,'enderecos',41,2,'DELETE','numero',NULL,NULL,'2023-04-24 04:25:13'),(1735,'enderecos',41,2,'DELETE','bairro',NULL,NULL,'2023-04-24 04:25:13'),(1736,'enderecos',41,2,'DELETE','cep',NULL,NULL,'2023-04-24 04:25:13'),(1737,'enderecos',41,2,'DELETE','status','1',NULL,'2023-04-24 04:25:13'),(1738,'enderecos',41,2,'DELETE','cidade_id',NULL,NULL,'2023-04-24 04:25:13'),(1739,'enderecos',41,2,'DELETE','usuario_id','2',NULL,'2023-04-24 04:25:13'),(1740,'enderecos',42,2,'DELETE','id','42',NULL,'2023-04-24 04:25:13'),(1741,'enderecos',42,2,'DELETE','logradouro',NULL,NULL,'2023-04-24 04:25:13'),(1742,'enderecos',42,2,'DELETE','numero',NULL,NULL,'2023-04-24 04:25:13'),(1743,'enderecos',42,2,'DELETE','bairro',NULL,NULL,'2023-04-24 04:25:13'),(1744,'enderecos',42,2,'DELETE','cep',NULL,NULL,'2023-04-24 04:25:13'),(1745,'enderecos',42,2,'DELETE','status','1',NULL,'2023-04-24 04:25:13'),(1746,'enderecos',42,2,'DELETE','cidade_id',NULL,NULL,'2023-04-24 04:25:13'),(1747,'enderecos',42,2,'DELETE','usuario_id','2',NULL,'2023-04-24 04:25:13'),(1748,'enderecos',43,2,'DELETE','id','43',NULL,'2023-04-24 04:25:13'),(1749,'enderecos',43,2,'DELETE','logradouro',NULL,NULL,'2023-04-24 04:25:13'),(1750,'enderecos',43,2,'DELETE','numero',NULL,NULL,'2023-04-24 04:25:13'),(1751,'enderecos',43,2,'DELETE','bairro',NULL,NULL,'2023-04-24 04:25:13'),(1752,'enderecos',43,2,'DELETE','cep',NULL,NULL,'2023-04-24 04:25:13'),(1753,'enderecos',43,2,'DELETE','status','1',NULL,'2023-04-24 04:25:13'),(1754,'enderecos',43,2,'DELETE','cidade_id',NULL,NULL,'2023-04-24 04:25:13'),(1755,'enderecos',43,2,'DELETE','usuario_id','2',NULL,'2023-04-24 04:25:13'),(1756,'enderecos',44,2,'DELETE','id','44',NULL,'2023-04-24 04:25:13'),(1757,'enderecos',44,2,'DELETE','logradouro',NULL,NULL,'2023-04-24 04:25:13'),(1758,'enderecos',44,2,'DELETE','numero',NULL,NULL,'2023-04-24 04:25:13'),(1759,'enderecos',44,2,'DELETE','bairro',NULL,NULL,'2023-04-24 04:25:13'),(1760,'enderecos',44,2,'DELETE','cep',NULL,NULL,'2023-04-24 04:25:13'),(1761,'enderecos',44,2,'DELETE','status','1',NULL,'2023-04-24 04:25:13'),(1762,'enderecos',44,2,'DELETE','cidade_id',NULL,NULL,'2023-04-24 04:25:13'),(1763,'enderecos',44,2,'DELETE','usuario_id','2',NULL,'2023-04-24 04:25:13'),(1764,'usuarios',19,2,'DELETE','id','19',NULL,'2023-04-24 04:25:29'),(1765,'usuarios',19,2,'DELETE','nome','a',NULL,'2023-04-24 04:25:29'),(1766,'usuarios',19,2,'DELETE','login','1@gmail.com',NULL,'2023-04-24 04:25:29'),(1767,'usuarios',19,2,'DELETE','senha','$2y$10$YN4PjyAlpS47yfCqId38yONxt6bLqjlKc49v5uUh19I4QxYf8JGoK',NULL,'2023-04-24 04:25:29'),(1768,'usuarios',19,2,'DELETE','ultimo_acesso',NULL,NULL,'2023-04-24 04:25:29'),(1769,'usuarios',19,2,'DELETE','imagem',NULL,NULL,'2023-04-24 04:25:29'),(1770,'usuarios',19,2,'DELETE','status','0',NULL,'2023-04-24 04:25:29'),(1771,'usuarios',20,NULL,'INSERT','id',NULL,'20','2023-04-24 04:26:06'),(1772,'usuarios',20,NULL,'INSERT','nome',NULL,'a','2023-04-24 04:26:06'),(1773,'usuarios',20,NULL,'INSERT','login',NULL,'a@gmail.com','2023-04-24 04:26:06'),(1774,'usuarios',20,NULL,'INSERT','senha',NULL,'$2y$10$FeLd.cv1Z6k9AJmSkPMqm.T/rB6H21BC.LIzL7kNb/y2TaEqkaUa.','2023-04-24 04:26:06'),(1775,'usuarios',20,NULL,'INSERT','ultimo_acesso',NULL,NULL,'2023-04-24 04:26:06'),(1776,'usuarios',20,NULL,'INSERT','imagem',NULL,NULL,'2023-04-24 04:26:06'),(1777,'usuarios',20,NULL,'INSERT','status',NULL,'1','2023-04-24 04:26:06'),(1778,'enderecos',NULL,2,'INSERT','id','0',NULL,'2023-04-24 04:26:06'),(1779,'enderecos',NULL,2,'INSERT','logradouro',NULL,NULL,'2023-04-24 04:26:06'),(1780,'enderecos',NULL,2,'INSERT','numero',NULL,NULL,'2023-04-24 04:26:06'),(1781,'enderecos',NULL,2,'INSERT','bairro',NULL,NULL,'2023-04-24 04:26:06'),(1782,'enderecos',NULL,2,'INSERT','cep',NULL,NULL,'2023-04-24 04:26:06'),(1783,'enderecos',NULL,2,'INSERT','status','1',NULL,'2023-04-24 04:26:06'),(1784,'enderecos',NULL,2,'INSERT','cidade_id',NULL,NULL,'2023-04-24 04:26:06'),(1785,'enderecos',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 04:26:06'),(1786,'contatos',5,NULL,'INSERT','id',NULL,'5','2023-04-24 04:26:06'),(1787,'contatos',5,NULL,'INSERT','descricao',NULL,'Contato de usuário padrão.','2023-04-24 04:26:06'),(1788,'contatos',5,NULL,'INSERT','telefone',NULL,NULL,'2023-04-24 04:26:06'),(1789,'contatos',5,NULL,'INSERT','celular',NULL,NULL,'2023-04-24 04:26:06'),(1790,'contatos',5,NULL,'INSERT','whatsapp',NULL,NULL,'2023-04-24 04:26:06'),(1791,'contatos',5,NULL,'INSERT','email',NULL,'a@gmail.com','2023-04-24 04:26:06'),(1792,'contatos',5,NULL,'INSERT','facebook',NULL,NULL,'2023-04-24 04:26:06'),(1793,'contatos',5,NULL,'INSERT','instagram',NULL,NULL,'2023-04-24 04:26:06'),(1794,'contatos',5,NULL,'INSERT','twitter',NULL,NULL,'2023-04-24 04:26:06'),(1795,'contatos',5,NULL,'INSERT','observacao',NULL,'Contato de usuário padrão.','2023-04-24 04:26:06'),(1796,'contatos',5,NULL,'INSERT','status',NULL,'1','2023-04-24 04:26:06'),(1797,'contatos',5,NULL,'INSERT','usuario_id',NULL,NULL,'2023-04-24 04:26:06'),(1798,'usuarios',20,2,'UPDATE','status','1','0','2023-04-24 04:29:04'),(1799,'usuarios',20,2,'DELETE','id','20',NULL,'2023-04-24 04:29:09'),(1800,'usuarios',20,2,'DELETE','nome','a',NULL,'2023-04-24 04:29:09'),(1801,'usuarios',20,2,'DELETE','login','a@gmail.com',NULL,'2023-04-24 04:29:09'),(1802,'usuarios',20,2,'DELETE','senha','$2y$10$FeLd.cv1Z6k9AJmSkPMqm.T/rB6H21BC.LIzL7kNb/y2TaEqkaUa.',NULL,'2023-04-24 04:29:09'),(1803,'usuarios',20,2,'DELETE','ultimo_acesso',NULL,NULL,'2023-04-24 04:29:09'),(1804,'usuarios',20,2,'DELETE','imagem',NULL,NULL,'2023-04-24 04:29:09'),(1805,'usuarios',20,2,'DELETE','status','0',NULL,'2023-04-24 04:29:09'),(1806,'usuarios',21,NULL,'INSERT','id',NULL,'21','2023-04-24 04:31:10'),(1807,'usuarios',21,NULL,'INSERT','nome',NULL,'a','2023-04-24 04:31:10'),(1808,'usuarios',21,NULL,'INSERT','login',NULL,'1@gmail.com','2023-04-24 04:31:10'),(1809,'usuarios',21,NULL,'INSERT','senha',NULL,'$2y$10$abNTJ1ZHuzp3jlvYgEDwl.VMQPxK6WayIA3FRb6jvlMuX1GgwVIpe','2023-04-24 04:31:10'),(1810,'usuarios',21,NULL,'INSERT','ultimo_acesso',NULL,NULL,'2023-04-24 04:31:10'),(1811,'usuarios',21,NULL,'INSERT','imagem',NULL,NULL,'2023-04-24 04:31:10'),(1812,'usuarios',21,NULL,'INSERT','status',NULL,'1','2023-04-24 04:31:10'),(1813,'enderecos',NULL,2,'INSERT','id','0',NULL,'2023-04-24 04:31:10'),(1814,'enderecos',NULL,2,'INSERT','logradouro',NULL,NULL,'2023-04-24 04:31:10'),(1815,'enderecos',NULL,2,'INSERT','numero',NULL,NULL,'2023-04-24 04:31:10'),(1816,'enderecos',NULL,2,'INSERT','bairro',NULL,NULL,'2023-04-24 04:31:10'),(1817,'enderecos',NULL,2,'INSERT','cep',NULL,NULL,'2023-04-24 04:31:10'),(1818,'enderecos',NULL,2,'INSERT','status','1',NULL,'2023-04-24 04:31:10'),(1819,'enderecos',NULL,2,'INSERT','cidade_id',NULL,NULL,'2023-04-24 04:31:10'),(1820,'enderecos',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 04:31:10'),(1821,'contatos',6,NULL,'INSERT','id',NULL,'6','2023-04-24 04:31:10'),(1822,'contatos',6,NULL,'INSERT','descricao',NULL,'Contato de usuário padrão.','2023-04-24 04:31:10'),(1823,'contatos',6,NULL,'INSERT','telefone',NULL,NULL,'2023-04-24 04:31:10'),(1824,'contatos',6,NULL,'INSERT','celular',NULL,NULL,'2023-04-24 04:31:10'),(1825,'contatos',6,NULL,'INSERT','whatsapp',NULL,NULL,'2023-04-24 04:31:10'),(1826,'contatos',6,NULL,'INSERT','email',NULL,'1@gmail.com','2023-04-24 04:31:10'),(1827,'contatos',6,NULL,'INSERT','facebook',NULL,NULL,'2023-04-24 04:31:10'),(1828,'contatos',6,NULL,'INSERT','instagram',NULL,NULL,'2023-04-24 04:31:10'),(1829,'contatos',6,NULL,'INSERT','twitter',NULL,NULL,'2023-04-24 04:31:10'),(1830,'contatos',6,NULL,'INSERT','observacao',NULL,'Contato de usuário padrão.','2023-04-24 04:31:10'),(1831,'contatos',6,NULL,'INSERT','status',NULL,'1','2023-04-24 04:31:10'),(1832,'contatos',6,NULL,'INSERT','usuario_id',NULL,NULL,'2023-04-24 04:31:10'),(1857,'contatos',4,NULL,'DELETE','id','4',NULL,'2023-04-24 04:33:26'),(1858,'contatos',4,NULL,'DELETE','descricao','Contato de usuário padrão.',NULL,'2023-04-24 04:33:26'),(1859,'contatos',4,NULL,'DELETE','telefone',NULL,NULL,'2023-04-24 04:33:26'),(1860,'contatos',4,NULL,'DELETE','celular',NULL,NULL,'2023-04-24 04:33:26'),(1861,'contatos',4,NULL,'DELETE','whatsapp',NULL,NULL,'2023-04-24 04:33:26'),(1862,'contatos',4,NULL,'DELETE','email','1@gmail.com',NULL,'2023-04-24 04:33:26'),(1863,'contatos',4,NULL,'DELETE','facebook',NULL,NULL,'2023-04-24 04:33:26'),(1864,'contatos',4,NULL,'DELETE','instagram',NULL,NULL,'2023-04-24 04:33:26'),(1865,'contatos',4,NULL,'DELETE','twitter',NULL,NULL,'2023-04-24 04:33:26'),(1866,'contatos',4,NULL,'DELETE','observacao','Contato de usuário padrão.',NULL,'2023-04-24 04:33:26'),(1867,'contatos',4,NULL,'DELETE','status','1',NULL,'2023-04-24 04:33:26'),(1868,'contatos',4,NULL,'DELETE','usuario_id',NULL,NULL,'2023-04-24 04:33:26'),(1869,'contatos',5,NULL,'DELETE','id','5',NULL,'2023-04-24 04:33:26'),(1870,'contatos',5,NULL,'DELETE','descricao','Contato de usuário padrão.',NULL,'2023-04-24 04:33:26'),(1871,'contatos',5,NULL,'DELETE','telefone',NULL,NULL,'2023-04-24 04:33:26'),(1872,'contatos',5,NULL,'DELETE','celular',NULL,NULL,'2023-04-24 04:33:26'),(1873,'contatos',5,NULL,'DELETE','whatsapp',NULL,NULL,'2023-04-24 04:33:26'),(1874,'contatos',5,NULL,'DELETE','email','a@gmail.com',NULL,'2023-04-24 04:33:26'),(1875,'contatos',5,NULL,'DELETE','facebook',NULL,NULL,'2023-04-24 04:33:26'),(1876,'contatos',5,NULL,'DELETE','instagram',NULL,NULL,'2023-04-24 04:33:26'),(1877,'contatos',5,NULL,'DELETE','twitter',NULL,NULL,'2023-04-24 04:33:26'),(1878,'contatos',5,NULL,'DELETE','observacao','Contato de usuário padrão.',NULL,'2023-04-24 04:33:26'),(1879,'contatos',5,NULL,'DELETE','status','1',NULL,'2023-04-24 04:33:26'),(1880,'contatos',5,NULL,'DELETE','usuario_id',NULL,NULL,'2023-04-24 04:33:26'),(1881,'contatos',6,NULL,'DELETE','id','6',NULL,'2023-04-24 04:33:26'),(1882,'contatos',6,NULL,'DELETE','descricao','Contato de usuário padrão.',NULL,'2023-04-24 04:33:26'),(1883,'contatos',6,NULL,'DELETE','telefone',NULL,NULL,'2023-04-24 04:33:26'),(1884,'contatos',6,NULL,'DELETE','celular',NULL,NULL,'2023-04-24 04:33:26'),(1885,'contatos',6,NULL,'DELETE','whatsapp',NULL,NULL,'2023-04-24 04:33:26'),(1886,'contatos',6,NULL,'DELETE','email','1@gmail.com',NULL,'2023-04-24 04:33:26'),(1887,'contatos',6,NULL,'DELETE','facebook',NULL,NULL,'2023-04-24 04:33:26'),(1888,'contatos',6,NULL,'DELETE','instagram',NULL,NULL,'2023-04-24 04:33:26'),(1889,'contatos',6,NULL,'DELETE','twitter',NULL,NULL,'2023-04-24 04:33:26'),(1890,'contatos',6,NULL,'DELETE','observacao','Contato de usuário padrão.',NULL,'2023-04-24 04:33:26'),(1891,'contatos',6,NULL,'DELETE','status','1',NULL,'2023-04-24 04:33:26'),(1892,'contatos',6,NULL,'DELETE','usuario_id',NULL,NULL,'2023-04-24 04:33:26'),(1893,'enderecos',45,2,'DELETE','id','45',NULL,'2023-04-24 04:33:42'),(1894,'enderecos',45,2,'DELETE','logradouro',NULL,NULL,'2023-04-24 04:33:42'),(1895,'enderecos',45,2,'DELETE','numero',NULL,NULL,'2023-04-24 04:33:42'),(1896,'enderecos',45,2,'DELETE','bairro',NULL,NULL,'2023-04-24 04:33:42'),(1897,'enderecos',45,2,'DELETE','cep',NULL,NULL,'2023-04-24 04:33:42'),(1898,'enderecos',45,2,'DELETE','status','1',NULL,'2023-04-24 04:33:42'),(1899,'enderecos',45,2,'DELETE','cidade_id',NULL,NULL,'2023-04-24 04:33:42'),(1900,'enderecos',45,2,'DELETE','usuario_id','2',NULL,'2023-04-24 04:33:42'),(1901,'enderecos',46,2,'DELETE','id','46',NULL,'2023-04-24 04:33:42'),(1902,'enderecos',46,2,'DELETE','logradouro',NULL,NULL,'2023-04-24 04:33:42'),(1903,'enderecos',46,2,'DELETE','numero',NULL,NULL,'2023-04-24 04:33:42'),(1904,'enderecos',46,2,'DELETE','bairro',NULL,NULL,'2023-04-24 04:33:42'),(1905,'enderecos',46,2,'DELETE','cep',NULL,NULL,'2023-04-24 04:33:42'),(1906,'enderecos',46,2,'DELETE','status','1',NULL,'2023-04-24 04:33:42'),(1907,'enderecos',46,2,'DELETE','cidade_id',NULL,NULL,'2023-04-24 04:33:42'),(1908,'enderecos',46,2,'DELETE','usuario_id','2',NULL,'2023-04-24 04:33:42'),(1909,'usuarios',21,2,'UPDATE','status','1','0','2023-04-24 04:34:23'),(1910,'usuarios',21,2,'DELETE','id','21',NULL,'2023-04-24 04:34:28'),(1911,'usuarios',21,2,'DELETE','nome','a',NULL,'2023-04-24 04:34:28'),(1912,'usuarios',21,2,'DELETE','login','1@gmail.com',NULL,'2023-04-24 04:34:28'),(1913,'usuarios',21,2,'DELETE','senha','$2y$10$abNTJ1ZHuzp3jlvYgEDwl.VMQPxK6WayIA3FRb6jvlMuX1GgwVIpe',NULL,'2023-04-24 04:34:28'),(1914,'usuarios',21,2,'DELETE','ultimo_acesso',NULL,NULL,'2023-04-24 04:34:28'),(1915,'usuarios',21,2,'DELETE','imagem',NULL,NULL,'2023-04-24 04:34:28'),(1916,'usuarios',21,2,'DELETE','status','0',NULL,'2023-04-24 04:34:28'),(1917,'usuarios',22,NULL,'INSERT','id',NULL,'22','2023-04-24 04:34:45'),(1918,'usuarios',22,NULL,'INSERT','nome',NULL,'a','2023-04-24 04:34:45'),(1919,'usuarios',22,NULL,'INSERT','login',NULL,'1@gmail.com','2023-04-24 04:34:45'),(1920,'usuarios',22,NULL,'INSERT','senha',NULL,'$2y$10$dy6N0S0w3THbvB6kH5l3H.sj8nU0YURBtf7nipJxAS/9Zh1/fSxCW','2023-04-24 04:34:45'),(1921,'usuarios',22,NULL,'INSERT','ultimo_acesso',NULL,NULL,'2023-04-24 04:34:45'),(1922,'usuarios',22,NULL,'INSERT','imagem',NULL,NULL,'2023-04-24 04:34:45'),(1923,'usuarios',22,NULL,'INSERT','status',NULL,'1','2023-04-24 04:34:45'),(1924,'enderecos',NULL,2,'INSERT','id','0',NULL,'2023-04-24 04:34:46'),(1925,'enderecos',NULL,2,'INSERT','logradouro',NULL,NULL,'2023-04-24 04:34:46'),(1926,'enderecos',NULL,2,'INSERT','numero',NULL,NULL,'2023-04-24 04:34:46'),(1927,'enderecos',NULL,2,'INSERT','bairro',NULL,NULL,'2023-04-24 04:34:46'),(1928,'enderecos',NULL,2,'INSERT','cep',NULL,NULL,'2023-04-24 04:34:46'),(1929,'enderecos',NULL,2,'INSERT','status','1',NULL,'2023-04-24 04:34:46'),(1930,'enderecos',NULL,2,'INSERT','cidade_id',NULL,NULL,'2023-04-24 04:34:46'),(1931,'enderecos',NULL,2,'INSERT','usuario_id','2',NULL,'2023-04-24 04:34:46'),(1932,'contatos',7,NULL,'INSERT','id',NULL,'7','2023-04-24 04:34:46'),(1933,'contatos',7,NULL,'INSERT','descricao',NULL,'Contato de usuário padrão.','2023-04-24 04:34:46'),(1934,'contatos',7,NULL,'INSERT','telefone',NULL,NULL,'2023-04-24 04:34:46'),(1935,'contatos',7,NULL,'INSERT','celular',NULL,NULL,'2023-04-24 04:34:46'),(1936,'contatos',7,NULL,'INSERT','whatsapp',NULL,NULL,'2023-04-24 04:34:46'),(1937,'contatos',7,NULL,'INSERT','email',NULL,'1@gmail.com','2023-04-24 04:34:46'),(1938,'contatos',7,NULL,'INSERT','facebook',NULL,NULL,'2023-04-24 04:34:46'),(1939,'contatos',7,NULL,'INSERT','instagram',NULL,NULL,'2023-04-24 04:34:46'),(1940,'contatos',7,NULL,'INSERT','twitter',NULL,NULL,'2023-04-24 04:34:46'),(1941,'contatos',7,NULL,'INSERT','observacao',NULL,'Contato de usuário padrão.','2023-04-24 04:34:46'),(1942,'contatos',7,NULL,'INSERT','status',NULL,'1','2023-04-24 04:34:46'),(1943,'contatos',7,NULL,'INSERT','usuario_id',NULL,NULL,'2023-04-24 04:34:46'),(1944,'usuarios_grupos',224,2,'INSERT','status','1',NULL,'2023-04-24 04:34:46'),(1945,'usuarios_grupos',224,2,'INSERT','usuario_id','22',NULL,'2023-04-24 04:34:46'),(1946,'usuarios_grupos',224,2,'INSERT','usuario','2',NULL,'2023-04-24 04:34:46'),(1947,'usuarios_grupos',224,2,'INSERT','grupo_id','4',NULL,'2023-04-24 04:34:46'),(1948,'usuarios',22,2,'UPDATE','status','1','0','2023-04-24 04:35:26'),(1949,'usuarios',22,2,'UPDATE','status','0','1','2023-04-24 04:35:30'),(1950,'usuarios',22,2,'UPDATE','status','1','0','2023-04-24 04:35:34');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `logs_BEFORE_UPDATE` BEFORE UPDATE ON `logs` FOR EACH ROW BEGIN
	SIGNAL SQLSTATE '42000'
			SET MESSAGE_TEXT = 'Not allowed update values this table';
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `logs_BEFORE_DELETE` BEFORE DELETE ON `logs` FOR EACH ROW BEGIN
	SIGNAL SQLSTATE '42000'
			SET MESSAGE_TEXT = 'Not allowed delete data this table';
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `menu_itens`
--

DROP TABLE IF EXISTS `menu_itens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_itens` (
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
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_menu_item_menu_idx` (`menu_id`),
  KEY `fk_menu_item_submenu` (`menu_item_id`),
  KEY `fk_menu_itens_usuario_idx` (`usuario_id`),
  CONSTRAINT `fk_menu_item_menu` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  CONSTRAINT `fk_menu_itens_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_itens`
--

LOCK TABLES `menu_itens` WRITE;
/*!40000 ALTER TABLE `menu_itens` DISABLE KEYS */;
INSERT INTO `menu_itens` VALUES (1,'Perfil','Perfil do Usuário',1,NULL,NULL,'?page=ControllerUser&option=editProfile&id=usuario_logado_id',NULL,'fas fa-user fa-sm fa-fw mr-2 text-gray-400',NULL,1,1),(2,'Boas vindas','Boas vindas',1,NULL,NULL,'?page=ControllerSystem&option=welcome',NULL,'fas fa-tachometer-alt fa-sm fa-fw mr-2 text-gray-400',NULL,1,2),(3,'Sair','Sair',1,NULL,NULL,'?page=ControllerUser&option=logout',NULL,'fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400',NULL,1,1),(4,'Usuários','Usuários',1,NULL,NULL,'?page=ControllerUser&option=listar',NULL,'fas fa-users-cog fa-sm fa-fw mr-2 text-gray-400',NULL,2,1),(5,'Permissões','Permissões',1,NULL,NULL,'?page=ControllerPemissao&option=listar',NULL,'fas fa-user-lock fa-sm fa-fw mr-2 text-gray-400',NULL,2,1),(6,'Parâmetros','Parâmetros',1,NULL,NULL,'?page=ControllerParameter&option=listar',NULL,'fas fa-tasks fa-sm fa-fw mr-2 text-gray-400',NULL,2,1),(7,'Páginas do Site','Páginas do Site',1,NULL,NULL,'?page=ControllerPage&option=listar',NULL,'fas fa-file-alt fa-sm fa-fw mr-2 text-gray-400',NULL,2,1),(8,'Conteúdo das Páginas','Conteúdo das Páginas',1,NULL,NULL,'?page=ControllerContent&option=listar',NULL,'fas fa-file-code fa-sm fa-fw mr-2 text-gray-400',NULL,2,1),(9,'Teste de Desenvolvimento','Teste de Desenvolvimento',0,NULL,NULL,'?page=ControllerTest&option=listar',NULL,'fas fa-file-code fa-sm fa-fw mr-2 text-gray-400',NULL,2,2),(10,'Endereços','Endereços',1,NULL,NULL,'?page=ControllerEndereco&option=listar',NULL,'fas fa-address-book fa-sm fa-fw mr-2 text-gray-400',NULL,3,1),(11,'Estados','Estados',1,NULL,NULL,'?page=ControllerEstado&option=listar',NULL,'fas fa-city fa-sm fa-fw mr-2 text-gray-400',NULL,3,1),(12,'Países','Países',1,NULL,NULL,'?page=ControllerPais&option=listar',NULL,'fas fa-university fa-sm fa-fw mr-2 text-gray-400',NULL,3,2),(13,'Funcionários','Funcionários',1,NULL,NULL,'?page=ControllerFuncionario&option=listar',NULL,'fas fa-users fa-sm fa-fw mr-2 text-gray-400',NULL,4,1),(14,'Contatos','Contatos',1,NULL,NULL,'?page=ControllerContato&option=listar',NULL,'fas fa-address-book fa-sm fa-fw mr-2 text-gray-400',NULL,4,1),(15,'Gerenciar Folha de Pagamento','Gerenciar Folhas de Pagamento',1,'','','?page=ControllerFolhaPagamento&option=listar','','fas fa-money-check-alt fa-sm fa-fw mr-2 text-gray-400',0,4,2),(16,'Todas folhas de pagamento','Lista de contracheques disponíveis',1,'Não existe folha de pagamento lançado',NULL,'?page=ControllerFolhaPagamento&option=listar',NULL,'dropdown-item text-center small text-gray-500',NULL,5,1),(17,'Menus','Cadastro de Menus do Sistema',1,NULL,NULL,'?page=ControllerMenu&option=listar',NULL,'fas fa-bars fa-sm fa-fw mr-2 text-gray-400',NULL,2,2),(18,'Itens de Menu','Cadastro de Itens de Menu do Sistema',1,NULL,NULL,'?page=ControllerMenuItem&option=listar',NULL,'fas fa-list fa-sm fa-fw mr-2 text-gray-400',NULL,2,2),(21,'Grupos de Permissões/Usuários','Cadastro de grupos de usuários e permissões',1,'','','?page=ControllerGrupo&option=listar','','fas fa-layer-group fa-sm fa-fw mr-2 text-gray-400',0,2,2),(24,'Página Inicial','Página Inicial do Site negócio/empresa',1,'','','?page=ControllerContent&option=filterByPage&conte_fk_page_pk_id=1','','fas fa-home fa-sm fa-fw mr-2 text-gray-400',0,8,2),(25,'Contato','Página de informações de Contato ',1,'','','?page=ControllerContent&option=filterByPage&conte_fk_page_pk_id=2','','fas fa-address-book fa-sm fa-fw mr-2 text-gray-400',0,8,2),(26,'Serviço','Serviços que é realizado.',1,'','','?page=ControllerContent&option=filterByPage&conte_fk_page_pk_id=3','','fas fa-bell-concierge fa-fw mr-2 text-gray-400',0,8,2),(27,'Sobre','Informações sobre o negócio/empresa',1,'','','?page=ControllerContent&option=filterByPage&conte_fk_page_pk_id=4','','fas fa-address-card fa-sm fa-fw mr-2 text-gray-400',0,8,2),(28,'Página de Entrada','Página de Destino(landing page )',1,'','','?page=ControllerContent&option=filterByPage&conte_fk_page_pk_id=5','','fas fa-plane-arrival fa-sm fa-fw mr-2 text-gray-400',0,8,2);
/*!40000 ALTER TABLE `menu_itens` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `menu_itens_BEFORE_INSERT` BEFORE INSERT ON `menu_itens` FOR EACH ROW BEGIN
		INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
    VALUES
		('menu_itens', NEW.id, 'INSERT', 'id', NEW.id, now(), NEW.usuario_id),
        ('menu_itens', NEW.id, 'INSERT','nome', NEW.nome, now(), NEW.usuario_id),
        ('menu_itens', NEW.id, 'INSERT','descricao', NEW.descricao, now(), NEW.usuario_id),
        ('menu_itens', NEW.id, 'INSERT','status', NEW.status, now(), NEW.usuario_id),
        ('menu_itens', NEW.id, 'INSERT','class', NEW.class, now(), NEW.usuario_id),
        ('menu_itens', NEW.id, 'INSERT','titulo', NEW.titulo, now(), NEW.usuario_id),
        ('menu_itens', NEW.id, 'INSERT','url', NEW.url, now(), NEW.usuario_id),
        ('menu_itens', NEW.id, 'INSERT','image', NEW.image, now(), NEW.usuario_id),
        ('menu_itens', NEW.id, 'INSERT','icone', NEW.icone, now(), NEW.usuario_id),
        ('menu_itens', NEW.id, 'INSERT','menu_item_id', NEW.menu_item_id, now(), NEW.usuario_id),
        ('menu_itens', NEW.id, 'INSERT','menu_id', NEW.menu_id, now(), NEW.usuario_id),
        ('menu_itens', NEW.id, 'INSERT','usuario_id', NEW.usuario_id, now(), NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `menu_itens_BEFORE_UPDATE` BEFORE UPDATE ON `menu_itens` FOR EACH ROW BEGIN

IF (OLD.nome <> NEW.nome or (OLD.nome IS NULL and NEW.nome IS NOT NULL)) THEN
INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
    VALUES 
  ('menu_itens', 'nome', OLD.nome, NEW.nome, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;

IF (OLD.descricao <> NEW.descricao or (OLD.descricao IS NULL and NEW.descricao IS NOT NULL)) THEN
  INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES 
        ('menu_itens', 'descricao', OLD.descricao, NEW.descricao, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.status <> NEW.status or (OLD.status IS NULL and NEW.status IS NOT NULL)) THEN
  INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES
        ('menu_itens', 'status', OLD.status, NEW.status, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.titulo <> NEW.titulo or (OLD.titulo IS NULL and NEW.titulo IS NOT NULL)) THEN
  INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES
        ('menu_itens', 'titulo', OLD.titulo, NEW.titulo, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.class <> NEW.class or (OLD.class IS NULL and NEW.class IS NOT NULL)) THEN
  INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES
        ('menu_itens', 'class', OLD.class, NEW.class, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.url <> NEW.url or (OLD.url IS NULL and NEW.url IS NOT NULL)) THEN
  INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES
        ('menu_itens', 'url', OLD.url, NEW.url, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.image <> NEW.image or (OLD.image IS NULL and NEW.image IS NOT NULL)) THEN
  INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES
        ('menu_itens', 'image', OLD.image, NEW.image, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.icone <> NEW.icone or (OLD.icone IS NULL and NEW.icone IS NOT NULL)) THEN
  INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES
        ('menu_itens', 'icone', OLD.icone, NEW.icone, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.menu_item_id <> NEW.menu_item_id or (OLD.menu_item_id IS NULL and NEW.menu_item_id IS NOT NULL)) THEN
  INSERT INTO logs 
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES 
        ('menu_itens', 'menu_item_id', OLD.menu_item_id, NEW.menu_item_id, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.menu_id <> NEW.menu_id or (OLD.menu_id IS NULL and NEW.menu_id IS NOT NULL)) THEN
  INSERT INTO logs 
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES 
        ('menu_itens', 'menu_id', OLD.menu_id, NEW.menu_id, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.usuario_id <> NEW.usuario_id or (OLD.usuario_id IS NULL and NEW.usuario_id IS NOT NULL)) THEN
  INSERT INTO logs 
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES 
        ('menu_itens', 'usuario_id', OLD.usuario_id, NEW.usuario_id, now(), 'UPDATE', OLD.id, NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `menu_itens_BEFORE_DELETE` BEFORE DELETE ON `menu_itens` FOR EACH ROW BEGIN

	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
    VALUES
		('menu_itens', OLD.id, 'DELETE', 'id', OLD.id, now(), OLD.usuario_id),
        ('menu_itens', OLD.id, 'DELETE','nome', OLD.nome, now(), OLD.usuario_id),
        ('menu_itens', OLD.id, 'DELETE','descricao', OLD.descricao, now(), OLD.usuario_id),
        ('menu_itens', OLD.id, 'DELETE','status', OLD.status, now(), OLD.usuario_id),
        ('menu_itens', OLD.id, 'DELETE','titulo', OLD.titulo, now(), OLD.usuario_id),
        ('menu_itens', OLD.id, 'DELETE','class', OLD.class, now(), OLD.usuario_id),
        ('menu_itens', OLD.id, 'DELETE','url', OLD.url, now(), OLD.usuario_id),
        ('menu_itens', OLD.id, 'DELETE','image', OLD.image, now(), OLD.usuario_id),
        ('menu_itens', OLD.id, 'DELETE','icone', OLD.icone, now(), OLD.usuario_id),
        ('menu_itens', OLD.id, 'DELETE','menu_item_id', OLD.menu_item_id, now(), OLD.usuario_id),
        ('menu_itens', OLD.id, 'DELETE','menu_id', OLD.menu_id, now(), OLD.usuario_id),
        ('menu_itens', OLD.id, 'DELETE','usuario_id', OLD.usuario_id, now(), OLD.usuario_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
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
  KEY `menu_fk_usuario_idx` (`usuario_id`),
  KEY `menu_fk_sistema_idx` (`sistema_id`,`usuario_id`),
  CONSTRAINT `menu_fk_sistema` FOREIGN KEY (`sistema_id`) REFERENCES `sistemas` (`id`),
  CONSTRAINT `menu_fk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Perfil','Perfil do usuário',1,NULL,NULL,NULL,'1',1,1),(2,'Sistema','Configurações do Sistema',1,NULL,NULL,NULL,'fas fa-cogs fa-fw',1,2),(3,'Outros','Outras operações',1,'','','','fas fa-arrows-alt fa-fw',1,2),(4,'Recursos Humanos','Operações de RH',1,NULL,NULL,NULL,'fas fa-chalkboard-teacher fa-fw',1,2),(5,'Contra-cheque','Caixa de Menssagens',1,NULL,NULL,NULL,'fas fa-envelope fa-fw',1,2),(8,'Site','Páginas do Site',1,'','','','fas fa-sliders-h fa-fw',1,2);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `menus_BEFORE_INSERT` BEFORE INSERT ON `menus` FOR EACH ROW BEGIN
	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
    VALUES
		('menus', NEW.id, 'INSERT', 'id', NEW.id, now(), NEW.usuario_id),
        ('menus', NEW.id, 'INSERT','nome', NEW.nome, now(), NEW.usuario_id),
        ('menus', NEW.id, 'INSERT','descricao', NEW.descricao, now(), NEW.usuario_id),
        ('menus', NEW.id, 'INSERT','status', NEW.status, now(), NEW.usuario_id),
        ('menus', NEW.id, 'INSERT','class', NEW.class, now(), NEW.usuario_id),
        ('menus', NEW.id, 'INSERT','url', NEW.url, now(), NEW.usuario_id),
        ('menus', NEW.id, 'INSERT','image', NEW.image, now(), NEW.usuario_id),
        ('menus', NEW.id, 'INSERT','icone', NEW.icone, now(), NEW.usuario_id),
        ('menus', NEW.id, 'INSERT','sistema_id', NEW.sistema_id, now(), NEW.usuario_id),
        ('menus', NEW.id, 'INSERT','usuario_id', NEW.usuario_id, now(), NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `menus_BEFORE_UPDATE` BEFORE UPDATE ON `menus` FOR EACH ROW BEGIN
IF (OLD.nome <> NEW.nome or (OLD.nome IS NULL and NEW.nome IS NOT NULL)) THEN
INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
    VALUES 
  ('menus', 'nome', OLD.nome, NEW.nome, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
/**/
IF (OLD.descricao <> NEW.descricao or (OLD.descricao IS NULL and NEW.descricao IS NOT NULL)) THEN
  INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES 
        ('menus', 'descricao', OLD.descricao, NEW.descricao, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.status <> NEW.status or (OLD.status IS NULL and NEW.status IS NOT NULL)) THEN
  INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES
        ('menus', 'status', OLD.status, NEW.status, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.class <> NEW.class or (OLD.class IS NULL and NEW.class IS NOT NULL)) THEN
  INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES
        ('menus', 'class', OLD.class, NEW.class, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.url <> NEW.url or (OLD.url IS NULL and NEW.url IS NOT NULL)) THEN
  INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES
        ('menus', 'url', OLD.url, NEW.url, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.image <> NEW.image or (OLD.image IS NULL and NEW.image IS NOT NULL)) THEN
  INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES
        ('menus', 'image', OLD.image, NEW.image, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.icone <> NEW.icone or (OLD.icone IS NULL and NEW.icone IS NOT NULL)) THEN
  INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES
        ('menus', 'icone', OLD.icone, NEW.icone, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.sistema_id <> NEW.sistema_id or (OLD.sistema_id IS NULL and NEW.sistema_id IS NOT NULL)) THEN
  INSERT INTO logs 
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES 
        ('menus', 'sistema_id', OLD.sistema_id, NEW.sistema_id, now(), 'UPDATE', OLD.id, NEW.usuario_id);
END IF;
IF (OLD.usuario_id <> NEW.usuario_id or (OLD.usuario_id IS NULL and NEW.usuario_id IS NOT NULL)) THEN
  INSERT INTO logs 
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES 
        ('menus', 'usuario_id', OLD.usuario_id, NEW.usuario_id, now(), 'UPDATE', OLD.id, NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `menus_BEFORE_DELETE` BEFORE DELETE ON `menus` FOR EACH ROW BEGIN
	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
    VALUES
		('menus', OLD.id, 'DELETE', 'id', OLD.id, now(), OLD.usuario_id),
        ('menus', OLD.id, 'DELETE','nome', OLD.nome, now(), OLD.usuario_id),
        ('menus', OLD.id, 'DELETE','descricao', OLD.descricao, now(), OLD.usuario_id),
        ('menus', OLD.id, 'DELETE','status', OLD.status, now(), OLD.usuario_id),
        ('menus', OLD.id, 'DELETE','class', OLD.class, now(), OLD.usuario_id),
        ('menus', OLD.id, 'DELETE','url', OLD.url, now(), OLD.usuario_id),
        ('menus', OLD.id, 'DELETE','image', OLD.image, now(), OLD.usuario_id),
        ('menus', OLD.id, 'DELETE','icone', OLD.icone, now(), OLD.usuario_id),
        ('menus', OLD.id, 'DELETE','sistema_id', OLD.sistema_id, now(), OLD.usuario_id),
        ('menus', OLD.id, 'DELETE','usuario_id', OLD.usuario_id, now(), OLD.usuario_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

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
  PRIMARY KEY (`page_pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (1,'home','Página Inicial do Site','home','Página Inicial',0,1),(2,'contact','Contato da Empresa e Entre em Contato123','address-book','Contato',0,1),(3,'service','Alguns de Nossos Serviços','concierge-bell','Serviços',0,1),(4,'about','Sobre nós','address-card','Sobre',0,1),(5,'landingpage ','Página de Entrada','address-card','Página de Destino',0,1);
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paises`
--

DROP TABLE IF EXISTS `paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paises` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `sigla` varchar(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_paises_usuario_idx` (`usuario_id`),
  CONSTRAINT `fk_paises_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paises`
--

LOCK TABLES `paises` WRITE;
/*!40000 ALTER TABLE `paises` DISABLE KEYS */;
INSERT INTO `paises` VALUES (1,'Brasil','BRA',1,2),(3,'a','s',1,2),(4,'','',1,2);
/*!40000 ALTER TABLE `paises` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `paises_BEFORE_INSERT` BEFORE INSERT ON `paises` FOR EACH ROW BEGIN
	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao)
    VALUES
		('paises', NEW.id, 'INSERT', 'id', NEW.id, now()),
        ('paises', NEW.id, 'INSERT','nome', NEW.nome, now()),
        ('paises', NEW.id, 'INSERT','sigla', NEW.sigla, now()),
        ('paises', NEW.id, 'INSERT','status', NEW.status, now()),
        ('paises', NEW.id, 'INSERT','usuario_id', NEW.usuario_id, now());
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `paises_BEFORE_UPDATE` BEFORE UPDATE ON `paises` FOR EACH ROW BEGIN
IF (OLD.nome <> NEW.nome or (OLD.nome IS NULL and NEW.nome IS NOT NULL)) THEN
		INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela)
        VALUES 
			('paises', 'nome', OLD.nome, NEW.nome, now(), 'UPDATE', OLD.id);
	 END IF;
    
	IF (OLD.sigla <> NEW.sigla or (OLD.sigla IS NULL and NEW.sigla IS NOT NULL)) THEN
			INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela)
            VALUES 
            ('paises', 'sigla', OLD.sigla, NEW.sigla, now(), 'UPDATE', OLD.id);
	END IF;
    
	IF (OLD.status <> NEW.status or (OLD.status IS NULL and NEW.status IS NOT NULL)) THEN
			INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela)
            VALUES
            ('paises', 'status', OLD.status, NEW.status, now(), 'UPDATE', OLD.id);
	END IF;
    
	IF (OLD.usuario_id <> NEW.usuario_id or (OLD.usuario_id IS NULL and NEW.usuario_id IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela)
            VALUES 
            ('paises', 'usuario_id', OLD.usuario_id, NEW.usuario_id, now(), 'UPDATE', OLD.id);
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `paises_BEFORE_DELETE` BEFORE DELETE ON `paises` FOR EACH ROW BEGIN
	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao)
    VALUES
		('paises', OLD.id, 'DELETE', 'id', OLD.id, now()),
        ('paises', OLD.id, 'DELETE','nome', OLD.nome, now()),
        ('paises', OLD.id, 'DELETE','sigla', OLD.sigla, now()),
        ('paises', OLD.id, 'DELETE','status', OLD.status, now()),
        ('paises', OLD.id, 'DELETE','usuario_id', OLD.usuario_id, now());
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

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
  UNIQUE KEY `para_key` (`para_key`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parameter`
--

LOCK TABLES `parameter` WRITE;
/*!40000 ALTER TABLE `parameter` DISABLE KEYS */;
INSERT INTO `parameter` VALUES (1,'nome_fantazia','','Nome como que todos conhecem',1,1),(2,'razao_social','','Nome como está no documento',1,1),(3,'titulo_site','','Nome para o site',1,1),(4,'icone_site','favicon.png','Imagem do Ícone do Site',1,1),(5,'email','paulistensetecnologia@gmail.com','Email para envio automático',0,1),(6,'senha','@G182534','Senha do email para envio automático',0,1),(7,'endereco','1','Endereço do dono/empresa do sistema',1,1),(8,'sobre_titulo','Sobre','',1,1),(9,'contato_titulo','Contato','',1,1),(10,'contato','1','Chave Estrangeira da tabela contatos',1,1),(11,'servicos_titulo','Serviços','Título da página de serviços',1,1),(12,'google_analytics','G-5ZS0PB48KT','Códifo do Google Analytics',1,1),(13,'servidor_email_smtp','smtp.gmail.com','Protocolo de E-mail',0,1),(14,'servidor_email_porta','587','Porta do Servidor de E-mail',0,1),(15,'servidor_email_seguranca','tls','Tipo da Segurança do Envio de E-mail',0,1),(16,'mostrar_error','1','Mostrar erros das páginas PHP',0,1),(17,'servidor_debug_email','0','MOSTRAR ERROR AO ENVIAR EMAIL',1,1),(18,'tempo_sessao_site','60','Tempo de usuário ficar logado',1,1),(19,'autor_site','Geverson Souza','Quem criou o site',1,1),(20,'modulos_sistema','2','Módulo do sistema que está ativo/contratado',1,1),(21,'teste_ambiente_sistema','1','Teste ambiente sistema',1,1),(22,'landing_page','landing_page','landing_page',0,1);
/*!40000 ALTER TABLE `parameter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissoes`
--

DROP TABLE IF EXISTS `permissoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `descricao` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `menu_item_id` int NOT NULL,
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome`),
  KEY `fk_permissoes_menu_item_idx` (`menu_item_id`),
  KEY `fk_permissoes_usuario_idx` (`usuario_id`),
  CONSTRAINT `fk_permissoes_menu_item` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_itens` (`id`),
  CONSTRAINT `fk_permissoes_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissoes`
--

LOCK TABLES `permissoes` WRITE;
/*!40000 ALTER TABLE `permissoes` DISABLE KEYS */;
INSERT INTO `permissoes` VALUES (17,'Visualizar Própria Folha de Pagamento ','Visualizar Folha de Pagamento Vinculadas ao Usuário(Funcionário)',1,16,2),(18,'Próprio Perfil','Visualizar e editar as informações do próprio pefil',1,1,2),(19,'Página Inicial','Página de início ao entrar no sistema',1,2,2),(20,'Sair do Sistema','Desconectar do sistema',1,3,2),(21,'Cadastrar/Listar/Excluir/Alterar usuários','Cadastro de usuários',1,4,2),(22,'Cadastrar/Listar/Excluir/Alterar permissões','Cadastro de permissões',1,5,2),(23,'Cadastrar/Listar/Excluir/Alterar parâmetros','Cadastro de parâmetros de configuração do sistema',1,6,2),(24,'Cadastrar/Listar/Excluir/Alterar páginas do site','Cadastro de páginas do site',1,7,2),(25,'Cadastrar/Listar/Excluir/Alterar conteúdos','Cadastro de conteúdos das páginas do site',1,8,2),(26,'Cadastrar/Listar/Excluir/Alterar endereços','Cadastro de endereços',1,10,2),(27,'Cadastrar/Listar/Excluir/Alterar estados','Cadastro de estados',1,11,2),(28,'Cadastrar/Listar/Excluir/Alterar países','Cadastro de países',1,12,2),(29,'Cadastrar/Listar/Excluir/Alterar funcionários','Cadastro de funcionários',1,13,2),(30,'Cadastrar/Listar/Excluir/Alterar contatos','Cadastro de contatos',1,14,2),(31,'Cadastrar/Listar/Excluir/Alterar folha de pagamento','Cadastro de folha de pagamento',1,15,2),(33,'Cadastrar/Listar/Excluir/Alterar módulos(menu)','Cadastro de módulos(menus)',1,17,2),(34,'Cadastrar/Listar/Excluir/Alterar sub módulos(item de menu)','Cadastro de sub módulos(item de menu)',1,18,2),(35,'Cadastrar/Listar/Excluir/Alterar grupos de acesso ao sistema','Cadastro de grupos de acesso ao sistema',1,21,2),(36,'Cadastrar/Listar/Excluir/Alterar página home','Gerenciar conteúdo da página inicial do site',1,24,2),(37,'Cadastrar/Listar/Excluir/Alterar página contatos do site','Gerenciar conteúdo da página contatos do site',1,25,2),(38,'Cadastrar/Listar/Excluir/Alterar página serviços do site','Gerenciar conteúdo da página serviços do site',1,26,2),(39,'Cadastrar/Listar/Excluir/Alterar página sobre do site','Gerenciar conteúdo da página sobre do site',1,27,2),(40,'Cadastrar/Listar/Excluir/Alterar página de entrada','Gerenciar conteúdo da página de entrada do site',1,28,2);
/*!40000 ALTER TABLE `permissoes` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `permissoes_BEFORE_INSERT` BEFORE INSERT ON `permissoes` FOR EACH ROW BEGIN
  INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
  VALUES
      ('permissoes', NULL, 'INSERT','id', NEW.id, now(), NEW.usuario_id),
      ('permissoes', NULL, 'INSERT','nome', NEW.nome, now(), NEW.usuario_id),
      ('permissoes', NULL, 'INSERT','descricao', NEW.descricao, now(), NEW.usuario_id),
      ('permissoes', NULL, 'INSERT','status', NEW.status, now(), NEW.usuario_id),
      ('permissoes', NULL, 'INSERT','menu_item_id', NEW.menu_item_id, now(), NEW.usuario_id),
      ('permissoes', NULL, 'INSERT','usuario_id', NEW.usuario_id, now(), NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `permissoes_BEFORE_UPDATE` BEFORE UPDATE ON `permissoes` FOR EACH ROW BEGIN
    IF (OLD.nome <> NEW.nome or (OLD.nome IS NULL and NEW.nome IS NOT NULL)) THEN
		INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES 
			('permissoes', 'nome', OLD.nome, NEW.nome, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	 END IF;
    
	IF (OLD.descricao <> NEW.descricao or (OLD.descricao IS NULL and NEW.descricao IS NOT NULL)) THEN
			INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('permissoes', 'descricao', OLD.descricao, NEW.descricao, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

	IF (OLD.status <> NEW.status or (OLD.status IS NULL and NEW.status IS NOT NULL)) THEN
			INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES
            ('permissoes', 'status', OLD.status, NEW.status, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

	IF (OLD.menu_item_id <> NEW.menu_item_id or (OLD.menu_item_id IS NULL and NEW.menu_item_id IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('permissoes', 'menu_item_id', OLD.menu_item_id, NEW.menu_item_id, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

	IF (OLD.usuario_id <> NEW.usuario_id or (OLD.usuario_id IS NULL and NEW.usuario_id IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('permissoes', 'usuario_id', OLD.usuario_id, NEW.usuario_id, now(), 'UPDATE', OLD.id, NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `permissoes_BEFORE_DELETE` BEFORE DELETE ON `permissoes` FOR EACH ROW BEGIN
    	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
    VALUES
		('permissoes', OLD.id, 'DELETE', 'id', OLD.id, now(), OLD.usuario_id),
        ('permissoes', OLD.id, 'DELETE','nome', OLD.nome, now(), OLD.usuario_id),
        ('permissoes', OLD.id, 'DELETE','descricao', OLD.descricao, now(), OLD.usuario_id),
        ('permissoes', OLD.id, 'DELETE','status', OLD.status, now(), OLD.usuario_id),
        ('permissoes', OLD.id, 'DELETE','menu_item_id', OLD.menu_item_id, now(), OLD.usuario_id),
        ('permissoes', OLD.id, 'DELETE','usuario_id', OLD.usuario_id, now(), OLD.usuario_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `sistemas`
--

DROP TABLE IF EXISTS `sistemas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sistemas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome`),
  KEY `sitemas_fk_usuario_idx` (`usuario_id`),
  CONSTRAINT `sitemas_fk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sistemas`
--

LOCK TABLES `sistemas` WRITE;
/*!40000 ALTER TABLE `sistemas` DISABLE KEYS */;
INSERT INTO `sistemas` VALUES (1,'SysSite','Sistema Integrado com Site',1,1),(2,'ServicoNotificacaoJava','Serviço de Envio de Notificação Java',1,1);
/*!40000 ALTER TABLE `sistemas` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `sistemas_AFTER_INSERT` AFTER INSERT ON `sistemas` FOR EACH ROW BEGIN
	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
    VALUES
		('sistemas', NEW.id, 'INSERT', 'id', NEW.id, now(), NEW.usuario_id),
        ('sistemas', NEW.id, 'INSERT','nome', NEW.nome, now(), NEW.usuario_id),
        ('sistemas', NEW.id, 'INSERT','descricao', NEW.descricao, now(), NEW.usuario_id),
        ('sistemas', NEW.id, 'INSERT','status', NEW.status, now(), NEW.usuario_id),
        ('sistemas', NEW.id, 'INSERT','usuario_id', NEW.usuario_id, now(), NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `sistemas_AFTER_UPDATE` AFTER UPDATE ON `sistemas` FOR EACH ROW BEGIN
  IF (OLD.nome <> NEW.nome or (OLD.nome IS NULL and NEW.nome IS NOT NULL)) THEN
  INSERT INTO logs
          (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
      VALUES 
    ('sistemas', 'nome', OLD.nome, NEW.nome, now(), 'UPDATE', OLD.id, NEW.usuario_id);
  END IF;

  IF (OLD.descricao <> NEW.descricao or (OLD.descricao IS NULL and NEW.descricao IS NOT NULL)) THEN
    INSERT INTO logs
          (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
          VALUES 
          ('sistemas', 'descricao', OLD.descricao, NEW.descricao, now(), 'UPDATE', OLD.id, NEW.usuario_id);
  END IF;
  IF (OLD.status <> NEW.status or (OLD.status IS NULL and NEW.status IS NOT NULL)) THEN
    INSERT INTO logs
          (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
          VALUES
          ('sistemas', 'status', OLD.status, NEW.status, now(), 'UPDATE', OLD.id, NEW.usuario_id);
  END IF;
  IF (OLD.usuario_id <> NEW.usuario_id or (OLD.usuario_id IS NULL and NEW.usuario_id IS NOT NULL)) THEN
    INSERT INTO logs 
          (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
          VALUES 
          ('sistemas', 'usuario_id', OLD.usuario_id, NEW.usuario_id, now(), 'UPDATE', OLD.id, NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `sistemas_AFTER_DELETE` AFTER DELETE ON `sistemas` FOR EACH ROW BEGIN
  	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
    VALUES
		    ('sistemas', OLD.id, 'DELETE', 'id', OLD.id, now(), OLD.usuario_id),
        ('sistemas', OLD.id, 'DELETE','nome', OLD.nome, now(), OLD.usuario_id),
        ('sistemas', OLD.id, 'DELETE','descricao', OLD.descricao, now(), OLD.usuario_id),
        ('sistemas', OLD.id, 'DELETE','status', OLD.status, now(), OLD.usuario_id),
        ('sistemas', OLD.id, 'DELETE','usuario_id', OLD.usuario_id, now(), OLD.usuario_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `ultimo_acesso` timestamp NULL DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  KEY `fk_usuarios_usuario_idx` (`usuario_id`),
  CONSTRAINT `fk_usuarios_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Administrator',NULL,'admin@admin.com','$2y$10$IfvfgkG1LLW2jwJKgDueHe6YwJEt5dtUHyru5f7L3.yKSQKuhotOy','2023-04-08 02:18:48',NULL,1,NULL),(2,'Geverson J de Souza',NULL,'geversonjosedesouza@gmail.com','$2y$10$EAW9YOmIdECWXAhAMUyP9uTitfcl0QRty2AlxeXcg0k2Vn1.plvUO','2023-04-23 21:49:30',NULL,1,NULL),(3,'Geverson Souza',NULL,'geversonjosedesouza@hotmail.com','$2y$10$SWj6kd3RCpNAn2Alne32Ge0nSU37.GAtkL7SwlwlPAbWsBHIZL9jm',NULL,NULL,1,2),(14,'funcionario',NULL,'funcionario@email.com','$2y$10$EAW9YOmIdECWXAhAMUyP9uTitfcl0QRty2AlxeXcg0k2Vn1.plvUO','2023-04-23 17:40:21',NULL,1,NULL),(22,'a','606.717.623-89','1@gmail.com','$2y$10$dy6N0S0w3THbvB6kH5l3H.sj8nU0YURBtf7nipJxAS/9Zh1/fSxCW',NULL,NULL,0,2);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `usuarios_AFTER_INSERT` AFTER INSERT ON `usuarios` FOR EACH ROW BEGIN
	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_atual, data_operacao, usuario_id)
    VALUES
		('usuarios', NEW.id, 'INSERT', 'id', NEW.id, now(), NEW.usuario_id),
        ('usuarios', NEW.id, 'INSERT','nome', NEW.nome, now(), NEW.usuario_id),
        ('usuarios', NEW.id, 'INSERT','login', NEW.login, now(), NEW.usuario_id),
        ('usuarios', NEW.id, 'INSERT','senha', NEW.senha, now(), NEW.usuario_id),
        ('usuarios', NEW.id, 'INSERT','ultimo_acesso', NEW.ultimo_acesso, now(), NEW.usuario_id),
        ('usuarios', NEW.id, 'INSERT','imagem', NEW.imagem, now(), NEW.usuario_id),
        ('usuarios', NEW.id, 'INSERT','status', NEW.status, now(), NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `usuarios_AFTER_UPDATE` AFTER UPDATE ON `usuarios` FOR EACH ROW BEGIN
IF (OLD.nome <> NEW.nome or (OLD.nome IS NULL and NEW.nome IS NOT NULL)) THEN
		INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES 
			('usuarios', 'nome', OLD.nome, NEW.nome, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	 END IF;
    
	IF (OLD.login <> NEW.login or (OLD.login IS NULL and NEW.login IS NOT NULL)) THEN
			INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('usuarios', 'login', OLD.login, NEW.login, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;
    
	IF (OLD.senha <> NEW.senha or (OLD.senha IS NULL and NEW.senha IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('usuarios', 'senha', OLD.senha, NEW.senha, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;
    
	IF (OLD.status <> NEW.status or (OLD.status IS NULL and NEW.status IS NOT NULL)) THEN
			INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES
            ('usuarios', 'status', OLD.status, NEW.status, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

	IF (OLD.imagem <> NEW.imagem or (OLD.imagem IS NULL and NEW.imagem IS NOT NULL)) THEN
			INSERT INTO logs 
                        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES
            ('usuarios', 'imagem', OLD.imagem, NEW.imagem, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

	IF (OLD.ultimo_acesso <> NEW.ultimo_acesso or (OLD.ultimo_acesso IS NULL and NEW.ultimo_acesso IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('usuarios', 'ultimo_acesso', OLD.ultimo_acesso, NEW.ultimo_acesso, now(), 'UPDATE', OLD.id, NEW.usuario_id);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `usuarios_AFTER_DELETE` AFTER DELETE ON `usuarios` FOR EACH ROW BEGIN
	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
    VALUES
		('usuarios', OLD.id, 'DELETE', 'id', OLD.id, now(), OLD.usuario_id),
        ('usuarios', OLD.id, 'DELETE','nome', OLD.nome, now(), OLD.usuario_id),
        ('usuarios', OLD.id, 'DELETE','login', OLD.login, now(), OLD.usuario_id),
        ('usuarios', OLD.id, 'DELETE','senha', OLD.senha, now(), OLD.usuario_id),
        ('usuarios', OLD.id, 'DELETE','ultimo_acesso', OLD.ultimo_acesso, now(), OLD.usuario_id),
        ('usuarios', OLD.id, 'DELETE','imagem', OLD.imagem, now(), OLD.usuario_id),
        ('usuarios', OLD.id, 'DELETE','status', OLD.status, now(), OLD.usuario_id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `usuarios_grupos`
--

DROP TABLE IF EXISTS `usuarios_grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios_grupos` (
  `usuario_id` int NOT NULL,
  `grupo_id` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `usuario` int NOT NULL,
  PRIMARY KEY (`usuario_id`,`grupo_id`),
  KEY `fk_usuarios_grupos_grupos_idx` (`grupo_id`),
  KEY `fk_usuarios_grupos_usuario_operacao_idx` (`usuario`),
  CONSTRAINT `fk_usuarios_grupos_grupos` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`),
  CONSTRAINT `fk_usuarios_grupos_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `fk_usuarios_grupos_usuario_operacao` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_grupos`
--

LOCK TABLES `usuarios_grupos` WRITE;
/*!40000 ALTER TABLE `usuarios_grupos` DISABLE KEYS */;
INSERT INTO `usuarios_grupos` VALUES (1,2,1,2),(2,1,1,2),(3,3,1,2),(14,4,1,2),(22,4,1,2);
/*!40000 ALTER TABLE `usuarios_grupos` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `usuarios_grupos_AFTER_INSERT` AFTER INSERT ON `usuarios_grupos` FOR EACH ROW BEGIN
  INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
  VALUES
      ('usuarios_grupos', CONCAT(NEW.usuario_id, NEW.grupo_id), 'INSERT','status', NEW.status, now(), NEW.usuario),
      ('usuarios_grupos', CONCAT(NEW.usuario_id, NEW.grupo_id), 'INSERT','usuario_id', NEW.usuario_id, now(), NEW.usuario),
      ('usuarios_grupos', CONCAT(NEW.usuario_id, NEW.grupo_id), 'INSERT','usuario', NEW.usuario, now(), NEW.usuario),
      ('usuarios_grupos', CONCAT(NEW.usuario_id, NEW.grupo_id), 'INSERT','grupo_id', NEW.grupo_id, now(), NEW.usuario);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `usuarios_grupos_AFTER_UPDATE` AFTER UPDATE ON `usuarios_grupos` FOR EACH ROW BEGIN
	IF (OLD.status <> NEW.status or (OLD.status IS NULL and NEW.status IS NOT NULL)) THEN
			INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES
            ('usuarios_grupos', 'status', OLD.status, NEW.status, now(), 'UPDATE', CONCAT(NEW.usuario_id, NEW.grupo_id), NEW.usuario);
	END IF;

  IF (OLD.usuario_id <> NEW.usuario_id or (OLD.usuario_id IS NULL and NEW.usuario_id IS NOT NULL)) THEN
    INSERT INTO logs 
          (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
          VALUES 
          ('usuarios_grupos', 'usuario_id', OLD.usuario_id, NEW.usuario_id, now(), 'UPDATE', CONCAT(NEW.usuario_id, NEW.grupo_id), NEW.usuario);
  END IF;

	IF (OLD.grupo_id <> NEW.grupo_id or (OLD.grupo_id IS NULL and NEW.grupo_id IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('grupos_grupos', 'grupo_id', OLD.grupo_id, NEW.grupo_id, now(), 'UPDATE', CONCAT(NEW.usuario_id, NEW.grupo_id), NEW.usuario);
  END IF;

	IF (OLD.usuario <> NEW.usuario or (OLD.usuario IS NULL and NEW.usuario IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('grupos_grupos', 'usuario', OLD.usuario, NEW.usuario, now(), 'UPDATE', CONCAT(NEW.usuario_id, NEW.grupo_id), NEW.usuario);
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
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `usuarios_grupos_BEFORE_DELETE` BEFORE DELETE ON `usuarios_grupos` FOR EACH ROW BEGIN
  	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
    VALUES
        ('usuarios_grupos', CONCAT(OLD.usuario_id, OLD.grupo_id), 'DELETE','usuario_id', OLD.usuario_id, now(), OLD.usuario),
        ('usuarios_grupos', CONCAT(OLD.usuario_id, OLD.grupo_id), 'DELETE','grupo_id', OLD.grupo_id, now(), OLD.usuario),
        ('usuarios_grupos', CONCAT(OLD.usuario_id, OLD.grupo_id), 'DELETE','usuario', OLD.usuario, now(), OLD.usuario),
        ('usuarios_grupos', CONCAT(OLD.usuario_id, OLD.grupo_id), 'DELETE','status', OLD.status, now(), OLD.usuario);
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

-- Dump completed on 2023-04-24  1:36:00
