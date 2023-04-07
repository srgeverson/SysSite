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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `cidades_BEFORE_INSERT` BEFORE INSERT ON `cidades` FOR EACH ROW BEGIN
	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao)
    VALUES
		('cidades', NEW.id, 'INSERT', 'id', NEW.id, now()),
        ('cidades', NEW.id, 'INSERT','codigo', NEW.codigo, now()),
        ('cidades', NEW.id, 'INSERT','nome', NEW.nome, now()),
        ('cidades', NEW.id, 'INSERT','estado_id', NEW.estado_id, now()),
        ('cidades', NEW.id, 'INSERT','status', NEW.status, now()),
        ('cidades', NEW.id, 'INSERT','usuario_id', NEW.usuario_id, now());
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `cidades_BEFORE_UPDATE` BEFORE UPDATE ON `cidades` FOR EACH ROW BEGIN
IF (OLD.nome <> NEW.nome or (OLD.nome IS NULL and NEW.nome IS NOT NULL)) THEN
INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela)
    VALUES 
  ('cidades', 'nome', OLD.nome, NEW.nome, now(), 'UPDATE', OLD.id);
END IF;

IF (OLD.codigo <> NEW.codigo or (OLD.codigo IS NULL and NEW.codigo IS NOT NULL)) THEN
  INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela)
        VALUES 
        ('cidades', 'codigo', OLD.codigo, NEW.codigo, now(), 'UPDATE', OLD.id);
END IF;
IF (OLD.status <> NEW.status or (OLD.status IS NULL and NEW.status IS NOT NULL)) THEN
  INSERT INTO logs
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela)
        VALUES
        ('cidades', 'status', OLD.status, NEW.status, now(), 'UPDATE', OLD.id);
END IF;
IF (OLD.estado_id <> NEW.estado_id or (OLD.estado_id IS NULL and NEW.estado_id IS NOT NULL)) THEN
  INSERT INTO logs 
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela)
        VALUES 
        ('cidades', 'estado_id', OLD.estado_id, NEW.estado_id, now(), 'UPDATE', OLD.id);
END IF;
IF (OLD.usuario_id <> NEW.usuario_id or (OLD.usuario_id IS NULL and NEW.usuario_id IS NOT NULL)) THEN
  INSERT INTO logs 
        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela)
        VALUES 
        ('cidades', 'usuario_id', OLD.usuario_id, NEW.usuario_id, now(), 'UPDATE', OLD.id);
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `cidades_BEFORE_DELETE` BEFORE DELETE ON `cidades` FOR EACH ROW BEGIN

	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao)
    VALUES
		('cidades', OLD.id, 'DELETE', 'id', OLD.id, now()),
        ('cidades', OLD.id, 'DELETE','nome', OLD.nome, now()),
        ('cidades', OLD.id, 'DELETE','codigo', OLD.codigo, now()),
        ('cidades', OLD.id, 'DELETE','status', OLD.status, now()),
        ('cidades', OLD.id, 'DELETE','estado_id', OLD.estado_id, now()),
        ('cidades', OLD.id, 'DELETE','usuario_id', OLD.usuario_id, now());
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

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
INSERT INTO `content` VALUES (1,'destaques_servicos','destaques_servicos','','','1200x300.png','',0,3,1),(2,'modern_business','A empresa...','','    Para ser percebida como uma empresa social e ambientalmente responsável e atuante, a Natura parte da premissa de que os impactos ambientais de sua atividade decorrem de uma cadeia de transformações, da qual representa somente uma parte. Por isso, acredita que, para ter eficácia, as ações ambientais precisam: considerar cada cadeia produtiva de maneira integral.','750x450.png','',0,4,1),(3,'our_team','Nome do membro','Cargo do membro','Breve descrição do cardo do membro ou do próprio membro','750x450.png','',0,4,1),(4,'our_customers','our_customers','','','500x300.png','123',0,4,1),(5,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,0,4,1),(6,'our_team','Nome do membro','Cargo do membro','Breve descrição do cardo do membro ou do próprio membro','750x450.png','',0,4,1),(7,'our_team','Nome do membro','Cargo do membro','Breve descrição do cardo do membro ou do próprio membro','750x450.png','',0,4,1),(8,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,0,4,1),(9,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,0,4,1),(10,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,0,4,1),(11,'our_customers','our_customers',NULL,NULL,'500x300.png',NULL,0,4,1),(12,'slide_apresentacao','Primeiro Destaque','Descrição destaque','','1900x1080.png','',0,1,1),(13,'slide_apresentacao','Segundo Destaque','Descrição destaque 2','','1900x1080.png','',0,1,1),(14,'slide_apresentacao','Terceiro Destaque','Descrição destaque 3','','1900x1080.png','',0,1,1),(15,'outros_destaques','Outroes Destaque','','Descrição destaque 3\r\nDescrição destaque 3\r\nDescrição destaque 3\r\nDescrição destaque 3','','',0,1,1),(16,'nossos_destaques','nossos_destaques','','nossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaquesnossos_destaques','700x400.png','',0,1,1),(17,'nossos_servicos','nossos_servicos','nossos_servicos','nossos_servicos\r\nnossos_servicos\r\nnossos_servicos\r\nnossos_servicos\r\nnossos_servicos\r\nnossos_servicos',NULL,'',0,3,1),(18,'our_contact','Nosso contato','Nosso contato','Nosso contato',NULL,NULL,0,2,1);
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
  `logradouro` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `numero` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `bairro` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `cep` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `cidade_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_enderecos_cidade_idx` (`cidade_id`),
  KEY `fk_enderecos_usuario_idx` (`usuario_id`),
  CONSTRAINT `fk_enderecos_cidade` FOREIGN KEY (`cidade_id`) REFERENCES `cidades` (`id`),
  CONSTRAINT `fk_enderecos_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enderecos`
--

LOCK TABLES `enderecos` WRITE;
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
INSERT INTO `enderecos` VALUES (1,'Logradouro','s/n','Bairro','00.000-000',1,950,2);
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
  PRIMARY KEY (`fopa_pk_id`),
  KEY `fopa_fk_funcionario_pk_id_idx` (`fopa_fk_funcionario_pk_id`),
  CONSTRAINT `fopa_fk_funcionario_pk_id` FOREIGN KEY (`fopa_fk_funcionario_pk_id`) REFERENCES `funcionario` (`func_pk_id`)
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
  KEY `func_fk_endereco_pk_id_idx` (`func_fk_endereco_pk_id`),
  KEY `func_fk_contact_pk_id_idx` (`func_fk_contact_pk_id`),
  CONSTRAINT `func_fk_contact_pk_id` FOREIGN KEY (`func_fk_contact_pk_id`) REFERENCES `contact` (`cont_pk_id`),
  CONSTRAINT `func_fk_endereco_pk_id` FOREIGN KEY (`func_fk_endereco_pk_id`) REFERENCES `enderecos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionario`
--

LOCK TABLES `funcionario` WRITE;
/*!40000 ALTER TABLE `funcionario` DISABLE KEYS */;
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
  UNIQUE KEY `fuus_fk_funcionario_pk_id_UNIQUE` (`fuus_fk_funcionario_pk_id`),
  UNIQUE KEY `fuus_pk_id_UNIQUE` (`fuus_pk_id`),
  CONSTRAINT `fuus_fk_funcionario_pk_id` FOREIGN KEY (`fuus_fk_funcionario_pk_id`) REFERENCES `funcionario` (`func_pk_id`)
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupos`
--

LOCK TABLES `grupos` WRITE;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` VALUES (4,'teste',1,2),(5,'asdasdsda',1,2),(6,'asdasdsda',1,2),(7,'asdasdsda',1,2),(8,'asdasdsda',1,2);
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
INSERT INTO `grupos_permissoes` VALUES (4,9,1,1),(4,16,1,1),(4,17,1,1),(4,18,1,1),(5,9,2,1),(5,16,2,1),(5,17,2,1),(5,18,2,1),(6,9,2,1),(6,16,2,1),(6,17,2,1),(6,18,2,1);
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
  `nome_tabela` varchar(100) DEFAULT NULL,
  `id_tabela` int DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  `operacao` varchar(6) DEFAULT NULL,
  `campo_modificado` varchar(45) DEFAULT NULL,
  `valor_antigo` text,
  `valor_atual` text,
  `data_operacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES ('menus',3,NULL,'UPDATE','descricao','Outras operações','1','2023-04-04 22:37:46'),('menus',3,NULL,'UPDATE','descricao','1','Outras operações','2023-04-04 22:38:20'),('menus',3,NULL,'UPDATE','status','0','1','2023-04-04 22:38:57'),('menus',0,2,'INSERT','id','0',NULL,'2023-04-04 22:49:18'),('menus',0,2,'INSERT','nome','a',NULL,'2023-04-04 22:49:18'),('menus',0,2,'INSERT','descricao','a',NULL,'2023-04-04 22:49:18'),('menus',0,2,'INSERT','status','1',NULL,'2023-04-04 22:49:18'),('menus',0,2,'INSERT','class','a',NULL,'2023-04-04 22:49:18'),('menus',0,2,'INSERT','url','a',NULL,'2023-04-04 22:49:18'),('menus',0,2,'INSERT','image','',NULL,'2023-04-04 22:49:18'),('menus',0,2,'INSERT','icone','a',NULL,'2023-04-04 22:49:18'),('menus',0,2,'INSERT','sistema_id','1',NULL,'2023-04-04 22:49:18'),('menus',0,2,'INSERT','usuario_id','2',NULL,'2023-04-04 22:49:18'),('menus',0,2,'INSERT','id','0',NULL,'2023-04-04 22:50:07'),('menus',0,2,'INSERT','nome','a',NULL,'2023-04-04 22:50:07'),('menus',0,2,'INSERT','descricao','a',NULL,'2023-04-04 22:50:07'),('menus',0,2,'INSERT','status','1',NULL,'2023-04-04 22:50:07'),('menus',0,2,'INSERT','class','a',NULL,'2023-04-04 22:50:07'),('menus',0,2,'INSERT','url','a',NULL,'2023-04-04 22:50:07'),('menus',0,2,'INSERT','image','',NULL,'2023-04-04 22:50:07'),('menus',0,2,'INSERT','icone','a',NULL,'2023-04-04 22:50:07'),('menus',0,2,'INSERT','sistema_id','1',NULL,'2023-04-04 22:50:07'),('menus',0,2,'INSERT','usuario_id','2',NULL,'2023-04-04 22:50:07'),('menus',6,2,'UPDATE','status','1','0','2023-04-04 22:54:22'),('menus',6,2,'DELETE','id','6',NULL,'2023-04-04 22:54:30'),('menus',6,2,'DELETE','nome','a',NULL,'2023-04-04 22:54:30'),('menus',6,2,'DELETE','descricao','a',NULL,'2023-04-04 22:54:30'),('menus',6,2,'DELETE','status','0',NULL,'2023-04-04 22:54:30'),('menus',6,2,'DELETE','class','a',NULL,'2023-04-04 22:54:30'),('menus',6,2,'DELETE','url','a',NULL,'2023-04-04 22:54:30'),('menus',6,2,'DELETE','image','',NULL,'2023-04-04 22:54:30'),('menus',6,2,'DELETE','icone','a',NULL,'2023-04-04 22:54:30'),('menus',6,2,'DELETE','sistema_id','1',NULL,'2023-04-04 22:54:30'),('menus',6,2,'DELETE','usuario_id','2',NULL,'2023-04-04 22:54:30'),('menus',7,2,'UPDATE','status','1','0','2023-04-04 22:54:53'),('menus',7,2,'DELETE','id','7',NULL,'2023-04-04 22:55:00'),('menus',7,2,'DELETE','nome','a',NULL,'2023-04-04 22:55:00'),('menus',7,2,'DELETE','descricao','a',NULL,'2023-04-04 22:55:00'),('menus',7,2,'DELETE','status','0',NULL,'2023-04-04 22:55:00'),('menus',7,2,'DELETE','class','a',NULL,'2023-04-04 22:55:00'),('menus',7,2,'DELETE','url','a',NULL,'2023-04-04 22:55:00'),('menus',7,2,'DELETE','image','',NULL,'2023-04-04 22:55:00'),('menus',7,2,'DELETE','icone','a',NULL,'2023-04-04 22:55:00'),('menus',7,2,'DELETE','sistema_id','1',NULL,'2023-04-04 22:55:00'),('menus',7,2,'DELETE','usuario_id','2',NULL,'2023-04-04 22:55:00'),('usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-04 20:16:35','2023-04-04 23:01:22','2023-04-04 23:01:22'),('menus',0,2,'INSERT','id','0',NULL,'2023-04-04 23:04:03'),('menus',0,2,'INSERT','nome','Itens de Menu',NULL,'2023-04-04 23:04:03'),('menus',0,2,'INSERT','descricao','Cadastro de Itens de Menu',NULL,'2023-04-04 23:04:03'),('menus',0,2,'INSERT','status','1',NULL,'2023-04-04 23:04:03'),('menus',0,2,'INSERT','class','',NULL,'2023-04-04 23:04:03'),('menus',0,2,'INSERT','url','',NULL,'2023-04-04 23:04:03'),('menus',0,2,'INSERT','image','',NULL,'2023-04-04 23:04:03'),('menus',0,2,'INSERT','icone','fas fa-list-dropdown fa-fw',NULL,'2023-04-04 23:04:03'),('menus',0,2,'INSERT','sistema_id','1',NULL,'2023-04-04 23:04:03'),('menus',0,2,'INSERT','usuario_id','2',NULL,'2023-04-04 23:04:03'),('usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-04 23:01:22','2023-04-04 23:05:59','2023-04-04 23:05:59'),('menu_itens',18,1,'INSERT','id','18',NULL,'2023-04-04 23:11:10'),('menu_itens',18,1,'INSERT','nome','Itens de Menu',NULL,'2023-04-04 23:11:10'),('menu_itens',18,1,'INSERT','descricao','Cadastro de Itens de Menu do Sistema',NULL,'2023-04-04 23:11:10'),('menu_itens',18,1,'INSERT','status','1',NULL,'2023-04-04 23:11:10'),('menu_itens',18,1,'INSERT','class',NULL,NULL,'2023-04-04 23:11:10'),('menu_itens',18,1,'INSERT','titulo',NULL,NULL,'2023-04-04 23:11:10'),('menu_itens',18,1,'INSERT','url','?page=ControllerMenuItem&option=listar',NULL,'2023-04-04 23:11:10'),('menu_itens',18,1,'INSERT','image',NULL,NULL,'2023-04-04 23:11:10'),('menu_itens',18,1,'INSERT','icone','fas fa-list-dropdown fa-sm fa-fw mr-2 text-gray-400',NULL,'2023-04-04 23:11:10'),('menu_itens',18,1,'INSERT','menu_item_id',NULL,NULL,'2023-04-04 23:11:10'),('menu_itens',18,1,'INSERT','menu_id','2',NULL,'2023-04-04 23:11:10'),('menu_itens',18,1,'INSERT','usuario_id','1',NULL,'2023-04-04 23:11:10'),('menu_itens',18,1,'UPDATE','icone','fas fa-list-dropdown fa-sm fa-fw mr-2 text-gray-400','fas fa-dropdown fa-sm fa-fw mr-2 text-gray-400','2023-04-05 00:00:54'),('menu_itens',18,1,'UPDATE','icone','fas fa-dropdown fa-sm fa-fw mr-2 text-gray-400','fas fa-list-dropdown fa-sm fa-fw mr-2 text-gray-400','2023-04-05 00:02:48'),('menu_itens',18,1,'UPDATE','icone','fas fa-list-dropdown fa-sm fa-fw mr-2 text-gray-400','fas fa-elementor fa-sm fa-fw mr-2 text-gray-400','2023-04-05 00:09:28'),('menu_itens',18,1,'UPDATE','icone','fas fa-elementor fa-sm fa-fw mr-2 text-gray-400','fas fa-list fa-sm fa-fw mr-2 text-gray-400','2023-04-05 00:12:19'),('menu_itens',12,2,'UPDATE','status','1','0','2023-04-05 01:27:54'),('menu_itens',12,2,'UPDATE','usuario_id','1','2','2023-04-05 01:27:54'),('menu_itens',12,2,'UPDATE','status','0','1','2023-04-05 01:31:00'),('menu_itens',2,2,'UPDATE','status','1','0','2023-04-05 01:31:48'),('menu_itens',2,2,'UPDATE','usuario_id','1','2','2023-04-05 01:31:48'),('menu_itens',0,2,'INSERT','id','0',NULL,'2023-04-05 02:04:06'),('menu_itens',0,2,'INSERT','nome','a',NULL,'2023-04-05 02:04:06'),('menu_itens',0,2,'INSERT','descricao','a',NULL,'2023-04-05 02:04:06'),('menu_itens',0,2,'INSERT','status','0',NULL,'2023-04-05 02:04:06'),('menu_itens',0,2,'INSERT','class','a',NULL,'2023-04-05 02:04:06'),('menu_itens',0,2,'INSERT','titulo','s',NULL,'2023-04-05 02:04:06'),('menu_itens',0,2,'INSERT','url','a',NULL,'2023-04-05 02:04:06'),('menu_itens',0,2,'INSERT','image','',NULL,'2023-04-05 02:04:06'),('menu_itens',0,2,'INSERT','icone','a',NULL,'2023-04-05 02:04:06'),('menu_itens',0,2,'INSERT','menu_item_id','1',NULL,'2023-04-05 02:04:06'),('menu_itens',0,2,'INSERT','menu_id','8',NULL,'2023-04-05 02:04:06'),('menu_itens',0,2,'INSERT','usuario_id','2',NULL,'2023-04-05 02:04:06'),('menu_itens',20,2,'UPDATE','menu_item_id','1','0','2023-04-05 02:14:34'),('menu_itens',20,2,'UPDATE','nome','a','ab','2023-04-05 02:14:46'),('menu_itens',20,2,'UPDATE','descricao','a','ab','2023-04-05 02:14:46'),('menu_itens',20,2,'UPDATE','titulo','s','sb','2023-04-05 02:14:46'),('menu_itens',20,2,'UPDATE','class','a','ab','2023-04-05 02:14:46'),('menu_itens',20,2,'UPDATE','url','a','ab','2023-04-05 02:14:46'),('menu_itens',20,2,'UPDATE','icone','a','ab','2023-04-05 02:14:46'),('menu_itens',20,2,'UPDATE','menu_id','8','1','2023-04-05 02:14:54'),('menu_itens',20,2,'UPDATE','menu_id','1','3','2023-04-05 02:15:02'),('menu_itens',20,2,'UPDATE','menu_item_id','0','18','2023-04-05 02:16:26'),('menu_itens',20,2,'UPDATE','menu_item_id','18','0','2023-04-05 02:16:37'),('menu_itens',2,2,'UPDATE','status','0','1','2023-04-05 02:16:58'),('menu_itens',20,2,'DELETE','id','20',NULL,'2023-04-05 02:17:07'),('menu_itens',20,2,'DELETE','nome','ab',NULL,'2023-04-05 02:17:07'),('menu_itens',20,2,'DELETE','descricao','ab',NULL,'2023-04-05 02:17:07'),('menu_itens',20,2,'DELETE','status','0',NULL,'2023-04-05 02:17:07'),('menu_itens',20,2,'DELETE','titulo','sb',NULL,'2023-04-05 02:17:07'),('menu_itens',20,2,'DELETE','class','ab',NULL,'2023-04-05 02:17:07'),('menu_itens',20,2,'DELETE','url','ab',NULL,'2023-04-05 02:17:07'),('menu_itens',20,2,'DELETE','image','',NULL,'2023-04-05 02:17:07'),('menu_itens',20,2,'DELETE','icone','ab',NULL,'2023-04-05 02:17:07'),('menu_itens',20,2,'DELETE','menu_item_id','0',NULL,'2023-04-05 02:17:07'),('menu_itens',20,2,'DELETE','menu_id','3',NULL,'2023-04-05 02:17:07'),('menu_itens',20,2,'DELETE','usuario_id','2',NULL,'2023-04-05 02:17:07'),('menu_itens',18,2,'UPDATE','status','1','0','2023-04-05 02:21:43'),('menu_itens',18,2,'UPDATE','usuario_id','1','2','2023-04-05 02:21:43'),('menu_itens',18,2,'UPDATE','status','0','1','2023-04-05 02:22:55'),('menus',5,2,'UPDATE','status','1','0','2023-04-05 02:23:08'),('menus',5,2,'UPDATE','usuario_id','1','2','2023-04-05 02:23:08'),('menu_itens',0,2,'INSERT','id','0',NULL,'2023-04-05 02:35:22'),('menu_itens',0,2,'INSERT','nome','Grupos',NULL,'2023-04-05 02:35:22'),('menu_itens',0,2,'INSERT','descricao','Cadastro de grupos',NULL,'2023-04-05 02:35:22'),('menu_itens',0,2,'INSERT','status','0',NULL,'2023-04-05 02:35:22'),('menu_itens',0,2,'INSERT','class','',NULL,'2023-04-05 02:35:22'),('menu_itens',0,2,'INSERT','titulo','',NULL,'2023-04-05 02:35:22'),('menu_itens',0,2,'INSERT','url','',NULL,'2023-04-05 02:35:22'),('menu_itens',0,2,'INSERT','image','',NULL,'2023-04-05 02:35:22'),('menu_itens',0,2,'INSERT','icone','',NULL,'2023-04-05 02:35:22'),('menu_itens',0,2,'INSERT','menu_item_id','0',NULL,'2023-04-05 02:35:22'),('menu_itens',0,2,'INSERT','menu_id','2',NULL,'2023-04-05 02:35:22'),('menu_itens',0,2,'INSERT','usuario_id','2',NULL,'2023-04-05 02:35:22'),('menu_itens',17,2,'UPDATE','status','1','0','2023-04-05 02:36:52'),('menu_itens',17,2,'UPDATE','usuario_id','1','2','2023-04-05 02:36:52'),('menu_itens',21,2,'UPDATE','icone','','fas fa-group fa-sm fa-fw mr-2 text-gray-400','2023-04-05 02:37:34'),('menu_itens',21,2,'UPDATE','status','0','1','2023-04-05 02:37:48'),('menu_itens',21,2,'UPDATE','status','1','0','2023-04-05 02:40:11'),('menu_itens',21,2,'UPDATE','icone','fas fa-group fa-sm fa-fw mr-2 text-gray-400','fas fa-layer-group fa-sm fa-fw mr-2 text-gray-400','2023-04-05 02:40:32'),('menu_itens',21,2,'UPDATE','status','0','1','2023-04-05 02:40:37'),('menu_itens',21,2,'UPDATE','status','1','0','2023-04-05 02:41:18'),('menu_itens',21,2,'UPDATE','url','','?page=ControllerGrupo&option=listar','2023-04-05 02:41:47'),('menu_itens',21,2,'UPDATE','status','0','1','2023-04-05 02:41:49'),('grupos',0,2,'INSERT','id','0',NULL,'2023-04-05 02:54:27'),('grupos',0,2,'INSERT','nome','',NULL,'2023-04-05 02:54:27'),('grupos',0,2,'INSERT','status','1',NULL,'2023-04-05 02:54:27'),('grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-05 02:54:27'),('grupos',0,2,'INSERT','id','0',NULL,'2023-04-05 02:54:38'),('grupos',0,2,'INSERT','nome','a',NULL,'2023-04-05 02:54:38'),('grupos',0,2,'INSERT','status','1',NULL,'2023-04-05 02:54:38'),('grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-05 02:54:38'),('grupos',1,NULL,'UPDATE','status','1','0','2023-04-05 02:56:32'),('grupos',2,NULL,'UPDATE','status','1','0','2023-04-05 02:56:48'),('grupos',1,1,'UPDATE','usuario_id',NULL,'1','2023-04-05 03:00:37'),('grupos',2,1,'UPDATE','usuario_id',NULL,'1','2023-04-05 03:00:37'),('grupos',2,2,'UPDATE','status','0','1','2023-04-05 03:01:41'),('grupos',2,2,'UPDATE','usuario_id','1','2','2023-04-05 03:01:41'),('grupos',2,NULL,'UPDATE','status','1','0','2023-04-05 03:02:08'),('grupos',2,2,'UPDATE','usuario_id',NULL,'2','2023-04-05 03:03:06'),('grupos',2,2,'UPDATE','status','0','1','2023-04-05 03:03:12'),('grupos',2,2,'UPDATE','status','1','0','2023-04-05 03:03:16'),('grupos',1,1,'UPDATE','nome','','a','2023-04-05 03:09:08'),('grupos',1,2,'UPDATE','status','0','1','2023-04-05 03:11:03'),('grupos',1,2,'UPDATE','usuario_id','1','2','2023-04-05 03:11:03'),('grupos',1,2,'UPDATE','status','1','0','2023-04-05 03:11:08'),('grupos',1,2,'DELETE','id','1',NULL,'2023-04-05 03:12:20'),('grupos',1,2,'DELETE','nome','a',NULL,'2023-04-05 03:12:20'),('grupos',1,2,'DELETE','status','0',NULL,'2023-04-05 03:12:20'),('grupos',1,2,'DELETE','usuario_id','2',NULL,'2023-04-05 03:12:20'),('grupos',2,2,'DELETE','id','2',NULL,'2023-04-05 03:12:27'),('grupos',2,2,'DELETE','nome','a',NULL,'2023-04-05 03:12:27'),('grupos',2,2,'DELETE','status','0',NULL,'2023-04-05 03:12:27'),('grupos',2,2,'DELETE','usuario_id','2',NULL,'2023-04-05 03:12:27'),('grupos',0,2,'INSERT','id','0',NULL,'2023-04-05 03:12:33'),('grupos',0,2,'INSERT','nome','a',NULL,'2023-04-05 03:12:33'),('grupos',0,2,'INSERT','status','1',NULL,'2023-04-05 03:12:33'),('grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-05 03:12:33'),('grupos',3,2,'UPDATE','status','1','0','2023-04-05 03:12:36'),('grupos',3,2,'UPDATE','nome','a','aa','2023-04-05 03:15:20'),('grupos',3,2,'UPDATE','nome','aa','ab','2023-04-05 03:15:55'),('grupos',3,2,'UPDATE','nome','ab','aaaa','2023-04-05 03:16:14'),('grupos',3,2,'UPDATE','nome','aaaa','ab','2023-04-05 03:16:18'),('grupos',3,2,'UPDATE','nome','ab','blablabla','2023-04-05 03:17:07'),('grupos',3,2,'UPDATE','status','0','1','2023-04-05 03:17:10'),('grupos',3,2,'UPDATE','status','1','0','2023-04-05 03:17:15'),('grupos',3,2,'DELETE','id','3',NULL,'2023-04-05 03:17:19'),('grupos',3,2,'DELETE','nome','blablabla',NULL,'2023-04-05 03:17:19'),('grupos',3,2,'DELETE','status','0',NULL,'2023-04-05 03:17:19'),('grupos',3,2,'DELETE','usuario_id','2',NULL,'2023-04-05 03:17:19'),('menu_itens',9,2,'UPDATE','status','1','0','2023-04-05 03:19:24'),('menu_itens',9,2,'UPDATE','usuario_id','1','2','2023-04-05 03:19:24'),('usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-04 23:05:59','2023-04-05 09:44:41','2023-04-05 09:44:41'),('menu_itens',17,2,'UPDATE','status','0','1','2023-04-05 09:45:44'),('menu_itens',21,2,'UPDATE','status','1','0','2023-04-05 09:45:59'),('menu_itens',21,2,'UPDATE','nome','Grupos','Grupos de Permissões','2023-04-05 09:46:24'),('menu_itens',21,2,'UPDATE','status','0','1','2023-04-05 09:46:33'),('menu_itens',0,2,'INSERT','id','0',NULL,'2023-04-05 09:51:36'),('menu_itens',0,2,'INSERT','nome','Grupos com Permissões',NULL,'2023-04-05 09:51:36'),('menu_itens',0,2,'INSERT','descricao','Cadastro de grupos a permissões',NULL,'2023-04-05 09:51:36'),('menu_itens',0,2,'INSERT','status','0',NULL,'2023-04-05 09:51:36'),('menu_itens',0,2,'INSERT','class','',NULL,'2023-04-05 09:51:36'),('menu_itens',0,2,'INSERT','titulo','',NULL,'2023-04-05 09:51:36'),('menu_itens',0,2,'INSERT','url','?page=ControllerGurpoPermissao&option=listar',NULL,'2023-04-05 09:51:36'),('menu_itens',0,2,'INSERT','image','',NULL,'2023-04-05 09:51:36'),('menu_itens',0,2,'INSERT','icone','fas fa-file-code fa-sm fa-fw mr-2 text-gray-400',NULL,'2023-04-05 09:51:36'),('menu_itens',0,2,'INSERT','menu_item_id','0',NULL,'2023-04-05 09:51:36'),('menu_itens',0,2,'INSERT','menu_id','2',NULL,'2023-04-05 09:51:36'),('menu_itens',0,2,'INSERT','usuario_id','2',NULL,'2023-04-05 09:51:36'),('menu_itens',22,2,'UPDATE','icone','fas fa-file-code fa-sm fa-fw mr-2 text-gray-400','fas fa-share fa-sm fa-fw mr-2 text-gray-400','2023-04-05 09:54:36'),('menu_itens',22,2,'UPDATE','status','0','1','2023-04-05 09:54:38'),('menu_itens',22,2,'UPDATE','status','1','0','2023-04-05 10:26:29'),('menu_itens',22,2,'UPDATE','url','?page=ControllerGurpoPermissao&option=listar','?page=ControllerGrupoPermissao&option=listar','2023-04-05 10:26:50'),('menu_itens',22,2,'UPDATE','status','0','1','2023-04-05 10:27:30'),('usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-05 09:44:41','2023-04-06 00:05:30','2023-04-06 00:05:30'),('menu_itens',22,2,'UPDATE','status','1','0','2023-04-06 00:12:52'),('menu_itens',22,2,'DELETE','id','22',NULL,'2023-04-06 00:12:59'),('menu_itens',22,2,'DELETE','nome','Grupos com Permissões',NULL,'2023-04-06 00:12:59'),('menu_itens',22,2,'DELETE','descricao','Cadastro de grupos a permissões',NULL,'2023-04-06 00:12:59'),('menu_itens',22,2,'DELETE','status','0',NULL,'2023-04-06 00:12:59'),('menu_itens',22,2,'DELETE','titulo','',NULL,'2023-04-06 00:12:59'),('menu_itens',22,2,'DELETE','class','',NULL,'2023-04-06 00:12:59'),('menu_itens',22,2,'DELETE','url','?page=ControllerGrupoPermissao&option=listar',NULL,'2023-04-06 00:12:59'),('menu_itens',22,2,'DELETE','image','',NULL,'2023-04-06 00:12:59'),('menu_itens',22,2,'DELETE','icone','fas fa-share fa-sm fa-fw mr-2 text-gray-400',NULL,'2023-04-06 00:12:59'),('menu_itens',22,2,'DELETE','menu_item_id','0',NULL,'2023-04-06 00:12:59'),('menu_itens',22,2,'DELETE','menu_id','2',NULL,'2023-04-06 00:12:59'),('menu_itens',22,2,'DELETE','usuario_id','2',NULL,'2023-04-06 00:12:59'),('grupos',0,2,'INSERT','id','0',NULL,'2023-04-06 01:08:25'),('grupos',0,2,'INSERT','nome','teste',NULL,'2023-04-06 01:08:25'),('grupos',0,2,'INSERT','status','1',NULL,'2023-04-06 01:08:25'),('grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-06 01:08:25'),('grupos',0,2,'INSERT','id','0',NULL,'2023-04-06 01:28:56'),('grupos',0,2,'INSERT','nome','asdasdsda',NULL,'2023-04-06 01:28:56'),('grupos',0,2,'INSERT','status','1',NULL,'2023-04-06 01:28:56'),('grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-06 01:28:56'),('grupos',0,2,'INSERT','id','0',NULL,'2023-04-06 01:29:08'),('grupos',0,2,'INSERT','nome','asdasdsda',NULL,'2023-04-06 01:29:08'),('grupos',0,2,'INSERT','status','1',NULL,'2023-04-06 01:29:08'),('grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-06 01:29:08'),('grupos',0,2,'INSERT','id','0',NULL,'2023-04-06 01:29:25'),('grupos',0,2,'INSERT','nome','asdasdsda',NULL,'2023-04-06 01:29:25'),('grupos',0,2,'INSERT','status','1',NULL,'2023-04-06 01:29:25'),('grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-06 01:29:25'),('grupos',0,2,'INSERT','id','0',NULL,'2023-04-06 01:29:30'),('grupos',0,2,'INSERT','nome','asdasdsda',NULL,'2023-04-06 01:29:30'),('grupos',0,2,'INSERT','status','1',NULL,'2023-04-06 01:29:30'),('grupos',0,2,'INSERT','usuario_id','2',NULL,'2023-04-06 01:29:30'),('usuarios',1,NULL,'UPDATE','ultimo_acesso','2023-04-04 20:16:01','2023-04-07 14:00:33','2023-04-07 14:00:33'),('usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-06 00:05:30','2023-04-07 14:05:20','2023-04-07 14:05:20'),('usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-07 14:05:20','2023-04-07 14:34:10','2023-04-07 14:34:10'),('usuarios',2,NULL,'UPDATE','ultimo_acesso','2023-04-07 14:34:10','2023-04-07 14:38:00','2023-04-07 14:38:00'),('usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 15:22:34'),('usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','1',NULL,'2023-04-07 15:22:34'),('usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','4',NULL,'2023-04-07 15:22:34'),('usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','9',NULL,'2023-04-07 15:22:34'),('permissoes',9,1,'UPDATE','status','0','1','2023-04-07 15:23:35'),('permissoes',NULL,1,'INSERT','id','0',NULL,'2023-04-07 15:33:46'),('permissoes',NULL,1,'INSERT','nome','4',NULL,'2023-04-07 15:33:46'),('permissoes',NULL,1,'INSERT','descricao','4',NULL,'2023-04-07 15:33:46'),('permissoes',NULL,1,'INSERT','status','1',NULL,'2023-04-07 15:33:46'),('permissoes',NULL,1,'INSERT','menu_item_id','16',NULL,'2023-04-07 15:33:46'),('permissoes',NULL,1,'INSERT','usuario_id','1',NULL,'2023-04-07 15:33:46'),('permissoes',NULL,1,'INSERT','id','0',NULL,'2023-04-07 15:33:46'),('permissoes',NULL,1,'INSERT','nome','5',NULL,'2023-04-07 15:33:46'),('permissoes',NULL,1,'INSERT','descricao','5',NULL,'2023-04-07 15:33:46'),('permissoes',NULL,1,'INSERT','status','1',NULL,'2023-04-07 15:33:46'),('permissoes',NULL,1,'INSERT','menu_item_id','16',NULL,'2023-04-07 15:33:46'),('permissoes',NULL,1,'INSERT','usuario_id','1',NULL,'2023-04-07 15:33:46'),('usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 15:34:39'),('usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','1',NULL,'2023-04-07 15:34:39'),('usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','4',NULL,'2023-04-07 15:34:39'),('usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','16',NULL,'2023-04-07 15:34:39'),('usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 15:34:39'),('usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','1',NULL,'2023-04-07 15:34:39'),('usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','4',NULL,'2023-04-07 15:34:39'),('usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','17',NULL,'2023-04-07 15:34:39'),('permissoes',NULL,1,'INSERT','id','0',NULL,'2023-04-07 15:35:23'),('permissoes',NULL,1,'INSERT','nome','6',NULL,'2023-04-07 15:35:23'),('permissoes',NULL,1,'INSERT','descricao','6',NULL,'2023-04-07 15:35:23'),('permissoes',NULL,1,'INSERT','status','1',NULL,'2023-04-07 15:35:23'),('permissoes',NULL,1,'INSERT','menu_item_id','1',NULL,'2023-04-07 15:35:23'),('permissoes',NULL,1,'INSERT','usuario_id','1',NULL,'2023-04-07 15:35:23'),('usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 15:36:51'),('usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','1',NULL,'2023-04-07 15:36:51'),('usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','5',NULL,'2023-04-07 15:36:51'),('usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','18',NULL,'2023-04-07 15:36:51'),('grupos_permissoes',1,NULL,'DELETE','usuario_id','1',NULL,'2023-04-07 16:50:45'),('grupos_permissoes',5,NULL,'DELETE','grupo_id','5',NULL,'2023-04-07 16:50:45'),('grupos_permissoes',5,NULL,'DELETE','permissao_id','18',NULL,'2023-04-07 16:50:45'),('grupos_permissoes',1,NULL,'DELETE','status','1',NULL,'2023-04-07 16:50:45'),('grupos_permissoes',1,NULL,'DELETE','usuario_id','1',NULL,'2023-04-07 16:51:48'),('grupos_permissoes',4,NULL,'DELETE','grupo_id','4',NULL,'2023-04-07 16:51:48'),('grupos_permissoes',4,NULL,'DELETE','permissao_id','17',NULL,'2023-04-07 16:51:48'),('grupos_permissoes',1,NULL,'DELETE','status','1',NULL,'2023-04-07 16:51:48'),('usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 16:55:13'),('usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','1',NULL,'2023-04-07 16:55:13'),('usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','4',NULL,'2023-04-07 16:55:13'),('usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','18',NULL,'2023-04-07 16:55:13'),('usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 16:56:00'),('usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','1',NULL,'2023-04-07 16:56:00'),('usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','4',NULL,'2023-04-07 16:56:00'),('usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','17',NULL,'2023-04-07 16:56:00'),('usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 18:54:15'),('usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','2',NULL,'2023-04-07 18:54:15'),('usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','5',NULL,'2023-04-07 18:54:15'),('usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','9',NULL,'2023-04-07 18:54:15'),('usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 18:56:15'),('usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','2',NULL,'2023-04-07 18:56:15'),('usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','5',NULL,'2023-04-07 18:56:15'),('usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','16',NULL,'2023-04-07 18:56:15'),('usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 18:56:15'),('usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','2',NULL,'2023-04-07 18:56:15'),('usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','5',NULL,'2023-04-07 18:56:15'),('usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','17',NULL,'2023-04-07 18:56:15'),('usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 18:56:15'),('usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','2',NULL,'2023-04-07 18:56:15'),('usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','5',NULL,'2023-04-07 18:56:15'),('usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','18',NULL,'2023-04-07 18:56:15'),('usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 18:56:58'),('usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','2',NULL,'2023-04-07 18:56:58'),('usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','6',NULL,'2023-04-07 18:56:58'),('usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','9',NULL,'2023-04-07 18:56:58'),('usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 18:56:58'),('usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','2',NULL,'2023-04-07 18:56:58'),('usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','6',NULL,'2023-04-07 18:56:58'),('usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','16',NULL,'2023-04-07 18:56:58'),('usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 18:56:58'),('usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','2',NULL,'2023-04-07 18:56:58'),('usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','6',NULL,'2023-04-07 18:56:58'),('usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','17',NULL,'2023-04-07 18:56:58'),('usuarios_permissoes',NULL,NULL,'INSERT','status','1',NULL,'2023-04-07 18:56:58'),('usuarios_permissoes',NULL,NULL,'INSERT','usuario_id','2',NULL,'2023-04-07 18:56:58'),('usuarios_permissoes',NULL,NULL,'INSERT','grupo_id','6',NULL,'2023-04-07 18:56:58'),('usuarios_permissoes',NULL,NULL,'INSERT','permissao_id','18',NULL,'2023-04-07 18:56:58'),(NULL,11,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_itens`
--

LOCK TABLES `menu_itens` WRITE;
/*!40000 ALTER TABLE `menu_itens` DISABLE KEYS */;
INSERT INTO `menu_itens` VALUES (1,'Perfil','Perfil do Usuário',1,NULL,NULL,'?page=ControllerUser&option=editProfile&id=usuario_logado_id',NULL,'fas fa-user fa-sm fa-fw mr-2 text-gray-400',NULL,1,1),(2,'Boas vindas','Boas vindas',1,NULL,NULL,'?page=ControllerSystem&option=welcome',NULL,'fas fa-tachometer-alt fa-sm fa-fw mr-2 text-gray-400',NULL,1,2),(3,'Sair','Sair',1,NULL,NULL,'?page=ControllerUser&option=logout',NULL,'fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400',NULL,1,1),(4,'Usuários','Usuários',1,NULL,NULL,'?page=ControllerUser&option=listar',NULL,'fas fa-users-cog fa-sm fa-fw mr-2 text-gray-400',NULL,2,1),(5,'Permissões','Permissões',1,NULL,NULL,'?page=ControllerAuthority&option=listar',NULL,'fas fa-user-lock fa-sm fa-fw mr-2 text-gray-400',NULL,2,1),(6,'Parâmetros','Parâmetros',1,NULL,NULL,'?page=ControllerParameter&option=listar',NULL,'fas fa-tasks fa-sm fa-fw mr-2 text-gray-400',NULL,2,1),(7,'Páginas do Site','Páginas do Site',1,NULL,NULL,'?page=ControllerPage&option=listar',NULL,'fas fa-file-alt fa-sm fa-fw mr-2 text-gray-400',NULL,2,1),(8,'Conteúdo das Páginas','Conteúdo das Páginas',1,NULL,NULL,'?page=ControllerContent&option=listar',NULL,'fas fa-file-code fa-sm fa-fw mr-2 text-gray-400',NULL,2,1),(9,'Teste de Desenvolvimento','Teste de Desenvolvimento',0,NULL,NULL,'?page=ControllerTest&option=listar',NULL,'fas fa-file-code fa-sm fa-fw mr-2 text-gray-400',NULL,2,2),(10,'Endereços','Endereços',1,NULL,NULL,'?page=ControllerEndereco&option=listar',NULL,'fas fa-address-book fa-sm fa-fw mr-2 text-gray-400',NULL,3,1),(11,'Estados','Estados',1,NULL,NULL,'?page=ControllerEstado&option=listar',NULL,'fas fa-city fa-sm fa-fw mr-2 text-gray-400',NULL,3,1),(12,'Países','Países',1,NULL,NULL,'?page=ControllerPais&option=listar',NULL,'fas fa-university fa-sm fa-fw mr-2 text-gray-400',NULL,3,2),(13,'Funcionários','Funcionários',1,NULL,NULL,'?page=ControllerFuncionario&option=listar',NULL,'fas fa-users fa-sm fa-fw mr-2 text-gray-400',NULL,4,1),(14,'Contatos','Contatos',1,NULL,NULL,'?page=ControllerContact&option=listar',NULL,'fas fa-address-book fa-sm fa-fw mr-2 text-gray-400',NULL,4,1),(15,'Folha de Pagamento','Folha de Pagamento',1,NULL,NULL,'?page=ControllerFolhaPagamento&option=listar',NULL,'fas fa-money-check-alt fa-sm fa-fw mr-2 text-gray-400',NULL,4,1),(16,'Todas folhas de pagamento','Lista de contracheques disponíveis',1,'Não existe folha de pagamento lançado',NULL,'?page=ControllerFolhaPagamento&option=listar',NULL,'dropdown-item text-center small text-gray-500',NULL,5,1),(17,'Menus','Cadastro de Menus do Sistema',1,NULL,NULL,'?page=ControllerMenu&option=listar',NULL,'fas fa-bars fa-sm fa-fw mr-2 text-gray-400',NULL,2,2),(18,'Itens de Menu','Cadastro de Itens de Menu do Sistema',1,NULL,NULL,'?page=ControllerMenuItem&option=listar',NULL,'fas fa-list fa-sm fa-fw mr-2 text-gray-400',NULL,2,2),(21,'Grupos de Permissões','Cadastro de grupos',1,'','','?page=ControllerGrupo&option=listar','','fas fa-layer-group fa-sm fa-fw mr-2 text-gray-400',0,2,2);
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
INSERT INTO `menus` VALUES (1,'Perfil','Perfil do usuário',1,NULL,NULL,NULL,'1',1,1),(2,'Sistema','Configurações do Sistema',1,NULL,NULL,NULL,'fas fa-cogs fa-fw',1,2),(3,'Outros','Outras operações',1,'','','','fas fa-arrows-alt fa-fw',1,2),(4,'Recursos Humanos','Operações de RH',1,NULL,NULL,NULL,'fas fa-chalkboard-teacher fa-fw',1,2),(5,'Contra-cheque','Caixa de Menssagens',0,NULL,NULL,NULL,'fas fa-envelope fa-fw',1,2),(8,'Itens de Menu','Cadastro de Itens de Menu',1,'','','','fas fa-list-dropdown fa-fw',1,2);
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
INSERT INTO `parameter` VALUES (1,'nome_fantazia','','Nome como que todos conhecem',1,1),(2,'razao_social','','Nome como está no documento',1,1),(3,'titulo_site','','Nome para o site',1,1),(4,'icone_site','favicon.png','Imagem do Ícone do Site',1,1),(5,'email','paulistensetecnologia@gmail.com','Email para envio automático',0,1),(6,'senha','@G182534','Senha do email para envio automático',0,1),(7,'endereco','1','Endereço do dono/empresa do sistema',1,1),(8,'sobre_titulo','Sobre','',1,1),(9,'contato_titulo','Contato','',1,1),(10,'contato','1','Chave Estrangeira da tabela contatos',1,1),(11,'servicos_titulo','Serviços','Título da página de serviços',1,1),(12,'google_analytics','G-5ZS0PB48KT','Códifo do Google Analytics',1,1),(13,'servidor_email_smtp','smtp.gmail.com','Protocolo de E-mail',0,1),(14,'servidor_email_porta','587','Porta do Servidor de E-mail',0,1),(15,'servidor_email_seguranca','tls','Tipo da Segurança do Envio de E-mail',0,1),(16,'mostrar_error','1','Mostrar erros das páginas PHP',0,1),(17,'servidor_debug_email','0','MOSTRAR ERROR AO ENVIAR EMAIL',1,1),(18,'tempo_sessao_site','60','Tempo de usuário ficar logado',1,1),(19,'autor_site','Geverson Souza','Quem criou o site',1,1),(20,'modulos_sistema','2','Módulo do sistema que está ativo/contratado',1,1),(21,'teste_ambiente_sistema','1','Teste ambiente sistema',1,1),(22,'landing_page','landing_page','landing_page',1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissoes`
--

LOCK TABLES `permissoes` WRITE;
/*!40000 ALTER TABLE `permissoes` DISABLE KEYS */;
INSERT INTO `permissoes` VALUES (9,'admin','admin',1,16,1),(16,'4','4',1,16,1),(17,'5','5',1,16,1),(18,'6','6',1,1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sistemas`
--

LOCK TABLES `sistemas` WRITE;
/*!40000 ALTER TABLE `sistemas` DISABLE KEYS */;
INSERT INTO `sistemas` VALUES (1,'SysSite','Sistema Integrado com Site',1,NULL);
/*!40000 ALTER TABLE `sistemas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `ultimo_acesso` timestamp NULL DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  KEY `fk_usuarios_usuario_idx` (`usuario_id`),
  CONSTRAINT `fk_usuarios_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Administrator','admin@admin.com','$2y$10$IfvfgkG1LLW2jwJKgDueHe6YwJEt5dtUHyru5f7L3.yKSQKuhotOy','2023-04-07 14:00:33',NULL,1,NULL),(2,'Geverson J de Souza','geversonjosedesouza@gmail.com','$2y$10$EAW9YOmIdECWXAhAMUyP9uTitfcl0QRty2AlxeXcg0k2Vn1.plvUO','2023-04-07 14:38:00',NULL,1,NULL),(3,'Geverson Souza','geversonjosedesouza@hotmail.com','$2y$10$SWj6kd3RCpNAn2Alne32Ge0nSU37.GAtkL7SwlwlPAbWsBHIZL9jm',NULL,NULL,1,2),(14,'a','a@gmail.com','$2y$10$RO7D4b41JM1uiZxmZcppbe/.gru0TuWxucIt6zZG6bMs31Azpq0pm','2023-03-29 01:10:54',NULL,0,2);
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `usuarios_BEFORE_INSERT` BEFORE INSERT ON `usuarios` FOR EACH ROW BEGIN
	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `usuarios_BEFORE_UPDATE` BEFORE UPDATE ON `usuarios` FOR EACH ROW BEGIN
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `usuarios_BEFORE_DELETE` BEFORE DELETE ON `usuarios` FOR EACH ROW BEGIN
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
      ('usuarios_grupos', NULL, 'INSERT','status', NEW.status, now(), NEW.usuario),
      ('usuarios_grupos', NULL, 'INSERT','usuario_id', NEW.usuario_id, now(), NEW.usuario),
      ('usuarios_grupos', NULL, 'INSERT','usuario', NEW.usuario, now(), NEW.usuario),
      ('usuarios_grupos', NULL, 'INSERT','grupo_id', NEW.grupo_id, now(), NEW.usuario);
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
        ('usuarios_grupos', OLD.usuario_id, 'DELETE','usuario_id', OLD.usuario_id, now(), OLD.usuario),
        ('usuarios_grupos', OLD.grupo_id, 'DELETE','grupo_id', OLD.grupo_id, now(), OLD.usuario),
        ('usuarios_grupos', OLD.usuario, 'DELETE','usuario', OLD.usuario, now(), OLD.usuario),
        ('usuarios_grupos', OLD.status, 'DELETE','status', OLD.status, now(), OLD.usuario);
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

-- Dump completed on 2023-04-07 16:50:42
