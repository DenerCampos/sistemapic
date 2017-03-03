CREATE DATABASE  IF NOT EXISTS `sistemapic` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sistemapic`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: sistemapic
-- ------------------------------------------------------
-- Server version	5.6.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area` (
  `idarea` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Area de atendimento.',
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `idestado` int(11) NOT NULL,
  PRIMARY KEY (`idarea`),
  KEY `fk_area_estado1_idx` (`idestado`),
  CONSTRAINT `fk_area_estado1` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area`
--

LOCK TABLES `area` WRITE;
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
INSERT INTO `area` VALUES (1,'Tecnologia da informação PIC PAMPULHA','ti@pic-clube.com.br',1),(2,'Tecnologia da informação PIC CIDADE','ti@pic-clube.com.br',1),(3,'Elétrica PIC PAMPULHA','eletricapp@pic-clube.com',1),(4,'Elétrica PIC CIDADE','eletricapc@pic-clube.com',1),(5,'Manutenção PIC CIDADE','manutencaopc@pic-clube.com.br',1),(6,'Manutenção PIC PAMPULHA','manutencaopp@pic-clube.com.br',1);
/*!40000 ALTER TABLE `area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentario`
--

DROP TABLE IF EXISTS `comentario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentario` (
  `idcomentario` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(500) NOT NULL,
  `data` datetime NOT NULL,
  `idocorrencia` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idcomentario`),
  KEY `fk_comentario_ocorrencia1_idx` (`idocorrencia`),
  KEY `fk_comentario_usuario1_idx` (`idusuario`),
  CONSTRAINT `fk_comentario_ocorrencia1` FOREIGN KEY (`idocorrencia`) REFERENCES `ocorrencia` (`idocorrencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentario_usuario1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentario`
--

LOCK TABLES `comentario` WRITE;
/*!40000 ALTER TABLE `comentario` DISABLE KEYS */;
/*!40000 ALTER TABLE `comentario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_conf`
--

DROP TABLE IF EXISTS `email_conf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_conf` (
  `idemail_conf` int(11) NOT NULL AUTO_INCREMENT,
  `useragent` varchar(45) NOT NULL,
  `protocol` varchar(45) NOT NULL,
  `smtp_host` varchar(45) NOT NULL,
  `smtp_user` varchar(45) NOT NULL,
  `smtp_pass` varchar(45) NOT NULL,
  `smtp_port` varchar(45) NOT NULL,
  `smtp_crypto` varchar(45) NOT NULL,
  `idestado` int(11) NOT NULL,
  PRIMARY KEY (`idemail_conf`),
  KEY `fk_email_conf_estado1_idx` (`idestado`),
  CONSTRAINT `fk_email_conf_estado1` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_conf`
--

LOCK TABLES `email_conf` WRITE;
/*!40000 ALTER TABLE `email_conf` DISABLE KEYS */;
INSERT INTO `email_conf` VALUES (1,'Help-Desk PIC','smtp','email-ssl.com.br','dcampos@pic-clube.com.br','d19m08co','465','SSL',1);
/*!40000 ALTER TABLE `email_conf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `idestado` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Estado das tabelas',
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idestado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'Ativo','Ativo'),(2,'Desativado','Desativado');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `local`
--

DROP TABLE IF EXISTS `local`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `local` (
  `idlocal` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Local das maquinas',
  `nome` varchar(100) NOT NULL,
  `shape` varchar(45) DEFAULT NULL COMMENT 'Propriedade do image map html',
  `coords` varchar(200) DEFAULT NULL COMMENT 'Propriedade do image map html',
  PRIMARY KEY (`idlocal`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `local`
--

LOCK TABLES `local` WRITE;
/*!40000 ALTER TABLE `local` DISABLE KEYS */;
INSERT INTO `local` VALUES (1,'TI','poly','585,178,586,210,624,207,621,178'),(2,'Restaurante Self´s','poly','218,76,217,93,238,93,239,103,258,104,258,116,278,112,275,93,234,78'),(3,'Bar Praça','poly','208,97,209,116,232,115,231,99'),(4,'Bar Molhado','poly','74,259,77,248,88,244,101,249,105,258,101,267'),(5,'Bar Infantil','poly','198,239,197,265,217,266,217,239'),(6,'Bar Centro Esportivo','poly','223,368,226,388,248,388,248,370'),(7,'Sauna Feminina','poly','354,177,357,208,369,208,369,177'),(8,'Sauna Masculina','poly','354,136,354,170,371,171,369,138'),(9,'Bar Ipanema','poly','388,126,388,149,410,149,407,125'),(10,'Bar Social','poly','510,171,514,209,561,206,560,169'),(11,'Secretaria','poly','337,232,338,257,356,256,356,233');
/*!40000 ALTER TABLE `local` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `idlog` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idlog`)
) ENGINE=InnoDB AUTO_INCREMENT=450 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (2,'acesso','acesso ao home do sistema','2017-01-16 18:49:15','192.168.2.200',0),(3,'acesso','acesso ao home do sistema','2017-01-16 18:53:33','192.168.2.200',0),(4,'acesso','acesso ao home do sistema','2017-01-16 15:55:05','192.168.2.200',0),(5,'acesso','acesso ao home do sistema','2017-01-16 15:55:38','192.168.2.200',1),(6,'acesso','acesso ao caixa do sistema','2017-01-16 16:06:30','192.168.2.200',1),(7,'acesso','acesso ao caixa do sistema','2017-01-16 16:06:49','192.168.2.200',1),(8,'acesso','acesso ao caixa do sistema','2017-01-16 16:06:57','192.168.2.200',1),(9,'acesso','acesso ao caixa do sistema','2017-01-16 16:07:04','192.168.2.200',1),(10,'altera','alterou dados do caixa Caixa antigo:CAIXA57','2017-01-16 16:07:04','192.168.2.200',1),(11,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:12:05','192.168.2.200',1),(12,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:12:28','192.168.2.200',1),(13,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:12:30','192.168.2.200',1),(14,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:12:33','192.168.2.200',1),(15,'alteração','alterou dados do caixa. Caixa antigo: CAIXA57 - 3. Novo local: TI','2017-01-16 16:12:33','192.168.2.200',1),(16,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:13:49','192.168.2.200',1),(17,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:13:51','192.168.2.200',1),(18,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:13:53','192.168.2.200',1),(19,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:14:02','192.168.2.200',1),(20,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:14:06','192.168.2.200',1),(21,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:14:06','192.168.2.200',1),(22,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:14:37','192.168.2.200',1),(23,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:14:37','192.168.2.200',1),(24,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:14:42','192.168.2.200',1),(25,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:15:02','192.168.2.200',1),(26,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:15:04','192.168.2.200',1),(27,'acesso','acesso ao controlador Home.php','2017-01-16 16:15:19','192.168.2.200',1),(28,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:15:21','192.168.2.200',1),(29,'acesso','acesso ao controlador Home.php','2017-01-16 16:15:35','192.168.2.200',0),(30,'acesso','acesso ao controlador Home.php','2017-01-16 16:15:41','192.168.2.200',1),(31,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:15:46','192.168.2.200',1),(32,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:16:00','192.168.2.200',1),(33,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:16:02','192.168.2.200',1),(34,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:16:26','192.168.2.200',1),(35,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:16:32','192.168.2.200',1),(36,'alteração','alterou dados do caixa. Caixa antigo: CAIXA57 - 1. Novo local: Bar Social','2017-01-16 16:16:32','192.168.2.200',1),(37,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:16:49','192.168.2.200',1),(38,'acesso','acesso ao controlador Caixa.php','2017-01-16 16:16:53','192.168.2.200',1),(39,'alteração','alterou dados do caixa. Caixa antigo: CAIXA34 - 1. Novo local: Bar Infantil','2017-01-16 16:16:53','192.168.2.200',1),(40,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:55:13','192.168.2.200',0),(41,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:55:14','192.168.2.200',0),(42,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:55:18','192.168.2.200',0),(43,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:55:26','192.168.2.200',0),(44,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:55:30','192.168.2.200',0),(45,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:55:39','192.168.2.200',0),(46,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:55:43','192.168.2.200',0),(47,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:55:49','192.168.2.200',0),(48,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:56:36','192.168.2.200',0),(49,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:56:40','192.168.2.200',0),(50,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:56:40','192.168.2.200',0),(51,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:56:45','192.168.2.200',0),(52,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:56:55','192.168.2.200',0),(53,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:56:59','192.168.2.200',0),(54,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:57:03','192.168.2.200',0),(55,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:57:06','192.168.2.200',0),(56,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:57:10','192.168.2.200',0),(57,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:57:14','192.168.2.200',0),(58,'acesso','acesso ao controlador Caixa.php','2017-01-17 09:57:25','192.168.2.200',0),(59,'acesso','acesso ao controlador Caixa.php','2017-01-17 11:23:23','192.168.2.200',0),(60,'acesso','acesso ao controlador Home.php','2017-01-17 12:05:40','192.168.2.200',0),(61,'acesso','acesso ao controlador Caixa.php','2017-01-17 13:05:08','192.168.2.200',0),(62,'acesso','acesso ao controlador Home.php','2017-01-17 15:24:35','192.168.2.200',0),(63,'acesso','acesso ao controlador Home.php','2017-01-17 15:58:56','192.168.2.200',0),(64,'acesso','acesso ao controlador Home.php','2017-01-17 16:15:47','192.168.2.200',0),(65,'acesso','acesso ao controlador Home.php','2017-01-17 16:16:22','192.168.2.200',0),(66,'erro login','usuario dcampos@pic-clube.com.br tentou entrar no sistema com login invalido','2017-01-17 16:25:03','192.168.2.200',0),(67,'acesso','acesso ao controlador Home.php','2017-01-17 16:26:13','192.168.2.200',0),(68,'acesso','acesso ao controlador Home.php','2017-01-17 16:28:15','192.168.2.200',0),(69,'acesso','acesso ao controlador Home.php','2017-01-17 16:29:35','192.168.2.200',0),(70,'criação usuario','usuario criado: Dener Campos Email: dcampos@pic-clube.com.br','2017-01-17 16:29:48','192.168.2.200',0),(71,'acesso','acesso ao controlador Home.php','2017-01-17 16:29:49','192.168.2.200',0),(72,'login','usuario dcampos@pic-clube.com.br entrou no sistema','2017-01-17 16:31:03','192.168.2.200',2),(73,'acesso','acesso ao controlador Home.php','2017-01-17 16:31:04','192.168.2.200',2),(74,'acesso','acesso ao controlador Ocorrencia.php','2017-01-17 17:15:20','192.168.2.200',2),(75,'acesso','acesso ao controlador Ocorrencia.php','2017-01-17 17:15:28','192.168.2.200',2),(76,'acesso','acesso ao controlador Ocorrencia.php','2017-01-17 17:15:41','192.168.2.200',2),(77,'acesso','acesso ao controlador Home.php','2017-01-17 19:23:11','192.168.2.200',0),(78,'acesso','acesso ao controlador Caixa.php','2017-01-17 19:23:32','192.168.2.200',0),(79,'acesso','acesso ao controlador Caixa.php','2017-01-17 19:24:05','192.168.2.200',0),(80,'acesso','acesso ao controlador Caixa.php','2017-01-17 19:24:19','192.168.2.200',0),(81,'acesso','acesso ao controlador Caixa.php','2017-01-17 19:24:31','192.168.2.200',0),(82,'acesso','acesso ao controlador Caixa.php','2017-01-17 19:24:35','192.168.2.200',0),(83,'acesso','acesso ao controlador Home.php','2017-01-18 10:14:35','192.168.2.200',0),(84,'acesso','acesso ao controlador Ocorrencia.php','2017-01-18 10:30:32','192.168.2.200',0),(85,'acesso','acesso ao controlador Ocorrencia.php','2017-01-18 10:50:12','192.168.2.200',0),(86,'acesso','acesso ao controlador Home.php','2017-01-18 10:54:12','192.168.2.200',0),(87,'criação usuario','usuario criado: usuario Email: usuario@pic-clube.com.br','2017-01-18 11:08:17','192.168.2.200',0),(88,'acesso','acesso ao controlador Home.php','2017-01-18 11:08:18','192.168.2.200',0),(89,'acesso','acesso ao controlador Home.php','2017-01-18 11:19:38','192.168.2.200',0),(90,'acesso','acesso ao controlador Home.php','2017-01-18 11:46:27','192.168.2.200',0),(91,'criação usuario','usuario criado: teste Email: teste@gmail.com','2017-01-18 11:48:55','192.168.2.200',0),(92,'acesso','acesso ao controlador Home.php','2017-01-18 11:48:56','192.168.2.200',0),(93,'acesso','acesso ao controlador Home.php','2017-01-18 11:49:57','192.168.2.200',0),(94,'ADMIN erro criação usuario','tentativa de criar usuario: teste Email: teste@gmail.com','2017-01-18 11:50:34','192.168.2.200',0),(95,'ADMIN erro criação usuario','tentativa de criar usuario: teste2 Email: teste2@gmail.com','2017-01-18 11:51:37','192.168.2.200',0),(96,'ADMIN criação usuario','usuario criado: teste2 Email: teste2@gmail.com','2017-01-18 11:52:34','192.168.2.200',0),(97,'acesso','acesso ao controlador Ocorrencia.php','2017-01-18 12:15:20','192.168.2.200',0),(98,'acesso','acesso ao controlador Home.php','2017-01-18 15:03:38','192.168.2.200',0),(99,'acesso','acesso ao controlador Home.php','2017-01-18 15:03:40','192.168.2.200',0),(100,'acesso','acesso ao controlador Home.php','2017-01-18 15:59:43','192.168.2.200',0),(101,'ADMIN criação usuario','usuario criado: teste3 Email: teste3@gmail.com','2017-01-18 16:16:17','192.168.2.200',0),(102,'ADMIN erro criação usuario','tentativa de criar usuario: teste3 Email: teste3@gmail.com','2017-01-18 16:16:40','192.168.2.200',0),(103,'ADMIN criação usuario','usuario criado: teste4 Email: teste4@gmail.com','2017-01-18 16:16:59','192.168.2.200',0),(104,'ADMIN criação usuario','usuario criado: teste5 Email: teste5@gmail.com','2017-01-18 16:18:15','192.168.2.200',0),(105,'ADMIN criação usuario','usuario criado: teste6 Email: teste6@gmail.com','2017-01-18 16:19:48','192.168.2.200',0),(106,'acesso','acesso ao controlador Ocorrencia.php','2017-01-18 16:43:58','192.168.2.200',0),(107,'acesso','acesso ao controlador Home.php','2017-01-18 17:14:13','192.168.2.200',0),(108,'acesso','acesso ao controlador Home.php','2017-01-18 17:27:01','192.168.2.200',0),(109,'acesso','acesso ao controlador Home.php','2017-01-18 17:29:27','192.168.2.200',0),(110,'acesso','acesso ao controlador Home.php','2017-01-18 17:29:51','192.168.2.200',0),(111,'acesso','acesso ao controlador Home.php','2017-01-18 17:31:11','192.168.2.200',0),(112,'acesso','acesso ao controlador Caixa.php','2017-01-18 17:34:36','192.168.2.200',0),(113,'acesso','acesso ao controlador Caixa.php','2017-01-18 17:34:45','192.168.2.200',0),(114,'acesso','acesso ao controlador Caixa.php','2017-01-18 17:34:56','192.168.2.200',0),(115,'acesso','acesso ao controlador Ocorrencia.php','2017-01-18 17:35:08','192.168.2.200',0),(116,'acesso','acesso ao controlador Caixa.php','2017-01-18 17:40:32','192.168.2.205',0),(117,'acesso','acesso ao controlador Caixa.php','2017-01-18 17:41:03','192.168.2.205',0),(118,'acesso','acesso ao controlador Caixa.php','2017-01-18 17:41:09','192.168.2.205',0),(119,'acesso','acesso ao controlador Caixa.php','2017-01-18 17:41:12','192.168.2.205',0),(120,'acesso','acesso ao controlador Caixa.php','2017-01-18 17:41:20','192.168.2.205',0),(121,'acesso','acesso ao controlador Caixa.php','2017-01-18 17:42:15','192.168.2.205',0),(122,'acesso','acesso ao controlador Caixa.php','2017-01-18 17:45:27','192.168.2.205',0),(123,'acesso','acesso ao controlador Caixa.php','2017-01-18 17:45:29','192.168.2.205',0),(124,'acesso','acesso ao controlador Caixa.php','2017-01-18 17:46:16','192.168.2.205',0),(125,'acesso','acesso ao controlador Caixa.php','2017-01-18 17:46:32','192.168.2.205',0),(126,'acesso','acesso ao controlador Ocorrencia.php','2017-01-18 17:46:35','192.168.2.205',0),(127,'acesso','acesso ao controlador Caixa.php','2017-01-18 17:46:55','192.168.2.205',0),(128,'acesso','acesso ao controlador Caixa.php','2017-01-18 17:47:18','192.168.2.205',0),(129,'acesso','acesso ao controlador Caixa.php','2017-01-18 17:48:08','192.168.2.205',0),(130,'ADMIN erro alteração usuario','tentativa de alterar usuario: teste6 Email: teste@gmail.com','2017-01-19 10:45:25','192.168.2.200',0),(131,'acesso','acesso ao controlador Home.php','2017-01-19 11:10:01','192.168.2.200',0),(132,'ADMIN alteração usuario','usuario alterado: teste Email: teste@gmail.com','2017-01-19 11:13:25','192.168.2.200',0),(133,'ADMIN alteração usuario','usuario alterado: teste6 Email: teste@gmail.com','2017-01-19 11:13:46','192.168.2.200',0),(134,'ADMIN alteração usuario','usuario alterado: teste6 Email: teste1@gmail.com','2017-01-19 11:14:10','192.168.2.200',0),(135,'ADMIN alteração usuario','usuario alterado: teste6 Email: teste1@gmail.com','2017-01-19 11:15:11','192.168.2.200',0),(136,'acesso','acesso ao controlador Home.php','2017-01-19 13:32:47','192.168.2.200',0),(137,'ADMIN erro alteração usuario','tentativa de alterar usuario: teste10 Email: teste1@gmail.com','2017-01-19 13:34:15','192.168.2.200',0),(138,'acesso','acesso ao controlador Home.php','2017-01-19 13:35:16','192.168.2.200',0),(139,'ADMIN alteração usuario','usuario alterado: teste10 Email: teste1@gmail.com','2017-01-19 13:36:33','192.168.2.200',0),(140,'ADMIN erro alteração usuario','tentativa de alterar usuario: teste Email: teste@gmail.com','2017-01-19 13:37:08','192.168.2.200',0),(141,'ADMIN erro alteração usuario','tentativa de alterar usuario: teste Email: teste@gmail.com','2017-01-19 13:38:41','192.168.2.200',0),(142,'ADMIN erro alteração usuario','tentativa de alterar usuario: teste Email: teste@gmail.com','2017-01-19 13:39:33','192.168.2.200',0),(143,'ADMIN erro alteração usuario','tentativa de alterar usuario: teste Email: teste@gmail.com','2017-01-19 13:40:31','192.168.2.200',0),(144,'acesso','acesso ao controlador Home.php','2017-01-19 13:40:52','192.168.2.200',0),(145,'ADMIN alteração usuario','usuario alterado: teste Email: teste@gmail.com','2017-01-19 13:41:41','192.168.2.200',0),(146,'acesso','acesso ao controlador Home.php','2017-01-19 13:44:02','192.168.2.200',0),(147,'ADMIN desabilita usuario','usuario desabilitado id: 4','2017-01-19 14:00:51','192.168.2.200',0),(148,'ADMIN desabilita usuario','usuario desabilitado id: 3','2017-01-19 14:00:59','192.168.2.200',0),(149,'ADMIN ativar usuario','usuario ativado id: 3','2017-01-19 14:12:56','192.168.2.200',0),(150,'ADMIN ativar usuario','usuario ativado id: 4','2017-01-19 14:13:05','192.168.2.200',0),(151,'ADMIN ativar usuario','usuario ativado id: 5','2017-01-19 14:13:07','192.168.2.200',0),(152,'ADMIN ativar usuario','usuario ativado id: 6','2017-01-19 14:13:11','192.168.2.200',0),(153,'ADMIN alteração usuario','usuario alterado: teste2 Email: teste2@gmail.com','2017-01-19 14:13:18','192.168.2.200',0),(154,'ADMIN alteração usuario','usuario alterado: teste3 Email: teste3@gmail.com','2017-01-19 14:13:25','192.168.2.200',0),(155,'ADMIN desabilita usuario','usuario desabilitado id: 4','2017-01-19 14:13:32','192.168.2.200',0),(156,'ADMIN ativar usuario','usuario ativado id: 9','2017-01-19 14:14:19','192.168.2.200',0),(157,'ADMIN criação usuario','usuario criado: abobora Email: abobora@teste.com','2017-01-19 14:20:43','192.168.2.200',0),(158,'ADMIN desabilita usuario','usuario desabilitado id: 10','2017-01-19 14:25:36','192.168.2.200',0),(159,'acesso','acesso ao controlador Home.php','2017-01-19 14:52:07','192.168.2.200',0),(160,'acesso','acesso ao controlador Home.php','2017-01-19 14:52:29','192.168.2.200',0),(161,'ADMIN erro criação area','tentativa de criar area: Tecnologia da informação PIC PAMPULHA Email: ti@pic-clube.com.br','2017-01-19 15:41:07','192.168.2.200',0),(162,'ADMIN criação area','area criada: Tecnologia da informação PIC PAMPULHA Email: ti@pic-clube.com.br','2017-01-19 15:42:04','192.168.2.200',0),(163,'ADMIN criação area','area criada: Tecnologia da informação PIC CIDADE Email: ti@pic-clube.com.br','2017-01-19 15:43:52','192.168.2.200',0),(164,'ADMIN criação area','area criada: Elétrica PIC PAMPULHA Email: eletricapp@pic-clube.com','2017-01-19 15:44:32','192.168.2.200',0),(165,'ADMIN criação area','area criada: Elétrica PIC CIDADE Email: eletricapc@pic-clube.com','2017-01-19 15:44:54','192.168.2.200',0),(166,'ADMIN erro criação area','tentativa de criar area: Elétrica PIC CIDADE Email: eletricapc@pic-clube.com','2017-01-19 15:45:30','192.168.2.200',0),(167,'acesso','acesso ao controlador Home.php','2017-01-19 15:54:55','192.168.2.200',0),(168,'acesso','acesso ao controlador Home.php','2017-01-19 16:18:58','192.168.2.200',0),(169,'acesso','acesso ao controlador Home.php','2017-01-19 16:21:27','192.168.2.200',0),(170,'acesso','acesso ao controlador Home.php','2017-01-19 16:23:16','192.168.2.200',0),(171,'ADMIN desabilita area','area desabilitada id: 4','2017-01-19 17:09:56','192.168.2.200',0),(172,'ADMIN ativa area','area ativada id: 4','2017-01-19 17:10:00','192.168.2.200',0),(173,'ADMIN alteração area','area alterada: Elétrica PIC CIDADE Email: eletricapc@pic-clube.com','2017-01-19 17:10:11','192.168.2.200',0),(174,'ADMIN ativa area','area ativada id: 4','2017-01-19 17:10:14','192.168.2.200',0),(175,'acesso','acesso ao controlador Ocorrencia.php','2017-01-19 17:12:15','192.168.2.200',0),(176,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:12:26','192.168.2.200',0),(177,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:12:53','192.168.2.200',0),(178,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:14:29','192.168.2.200',0),(179,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:14:37','192.168.2.200',0),(180,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:14:39','192.168.2.200',0),(181,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:14:40','192.168.2.200',0),(182,'acesso','acesso ao controlador Ocorrencia.php','2017-01-19 17:15:08','192.168.2.200',0),(183,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:15:19','192.168.2.200',0),(184,'acesso','acesso ao controlador Home.php','2017-01-19 17:15:20','192.168.2.200',0),(185,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:15:24','192.168.2.200',0),(186,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:15:46','192.168.2.200',0),(187,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:15:52','192.168.2.200',0),(188,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:15:54','192.168.2.200',0),(189,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:15:56','192.168.2.200',0),(190,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:15:59','192.168.2.200',0),(191,'acesso','acesso ao controlador Home.php','2017-01-19 17:16:08','192.168.2.200',0),(192,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:21:18','192.168.2.200',0),(193,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:21:40','192.168.2.200',0),(194,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:22:06','192.168.2.200',0),(195,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:22:15','192.168.2.200',0),(196,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:23:00','192.168.2.200',0),(197,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:23:39','192.168.2.200',0),(198,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:23:43','192.168.2.200',0),(199,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:24:09','192.168.2.200',0),(200,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:24:27','192.168.2.200',0),(201,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:25:04','192.168.2.200',0),(202,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:25:12','192.168.2.200',0),(203,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:25:44','192.168.2.200',0),(204,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:25:59','192.168.2.200',0),(205,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:26:07','192.168.2.200',0),(206,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:26:30','192.168.2.200',0),(207,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:26:38','192.168.2.200',0),(208,'ADMIN desabilita area','area desabilitada id: 4','2017-01-19 17:27:11','192.168.2.200',0),(209,'ADMIN ativa area','area ativada id: 4','2017-01-19 17:27:14','192.168.2.200',0),(210,'acesso','acesso ao controlador Home.php','2017-01-19 17:30:49','192.168.2.206',0),(211,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:30:52','192.168.2.206',0),(212,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:31:08','192.168.2.206',0),(213,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:31:14','192.168.2.206',0),(214,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:31:14','192.168.2.206',0),(215,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:31:18','192.168.2.206',0),(216,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:31:30','192.168.2.206',0),(217,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:31:37','192.168.2.206',0),(218,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:32:04','192.168.2.206',0),(219,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:32:41','192.168.2.206',0),(220,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:32:47','192.168.2.206',0),(221,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:33:05','192.168.2.206',0),(222,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:33:14','192.168.2.206',0),(223,'acesso','acesso ao controlador Ocorrencia.php','2017-01-19 17:33:55','192.168.2.206',0),(224,'acesso','acesso ao controlador Ocorrencia.php','2017-01-19 17:34:11','192.168.2.206',0),(225,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:34:18','192.168.2.206',0),(226,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:35:53','192.168.2.206',0),(227,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:35:58','192.168.2.206',0),(228,'alteração','alterou dados do caixa. Caixa antigo: CAIXA49 - 6. Novo local: TI','2017-01-19 17:35:58','192.168.2.206',0),(229,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:36:05','192.168.2.206',0),(230,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:36:09','192.168.2.206',0),(231,'alteração','alterou dados do caixa. Caixa antigo: CAIXA49 - 1. Novo local: Bar Centro Esportivo','2017-01-19 17:36:09','192.168.2.206',0),(232,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:52:13','192.168.2.206',0),(233,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:53:31','192.168.2.206',0),(234,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:55:28','192.168.2.206',0),(235,'acesso','acesso ao controlador Caixa.php','2017-01-19 17:55:29','192.168.2.206',0),(236,'acesso','acesso ao controlador Caixa.php','2017-01-20 09:38:52','192.168.2.200',0),(237,'acesso','acesso ao controlador Caixa.php','2017-01-20 09:49:34','192.168.2.200',0),(238,'acesso','acesso ao controlador Caixa.php','2017-01-20 09:49:44','192.168.2.200',0),(239,'ADMIN criação area','area criada: Manutenção PIC CIDADE Email: manutencaopc@pic-clube.com.br','2017-01-20 09:52:29','192.168.2.200',0),(240,'ADMIN criação area','area criada: Manutenção PIC PAMPULHA Email: manutencaopp@pic-clube.com.br','2017-01-20 09:52:49','192.168.2.200',0),(241,'acesso','acesso ao controlador Caixa.php','2017-01-20 10:20:10','192.168.2.200',0),(242,'acesso','acesso ao controlador Caixa.php','2017-01-20 10:20:20','192.168.2.200',0),(243,'ADMIN criação setor','setor criado: Tecnologia da informação PP','2017-01-20 11:12:50','192.168.2.200',0),(244,'ADMIN alteração setor','setor alterado: Tecnologia da informação PP','2017-01-20 11:21:33','192.168.2.200',0),(245,'ADMIN alteração setor','setor alterado: Tecnologia da informação PP','2017-01-20 11:21:45','192.168.2.200',0),(246,'ADMIN ativa setor','setor ativado id: 1','2017-01-20 11:21:50','192.168.2.200',0),(247,'ADMIN desabilita setor','setor desabilitado id: 1','2017-01-20 11:22:01','192.168.2.200',0),(248,'ADMIN ativa setor','setor ativado id: 1','2017-01-20 11:22:04','192.168.2.200',0),(249,'ADMIN criação setor','setor criado: Tecnologia da informação PC','2017-01-20 11:36:08','192.168.2.200',0),(250,'ADMIN criação setor','setor criado: Fiscal','2017-01-20 11:46:35','192.168.2.200',0),(251,'ADMIN criação setor','setor criado: Tesouraria','2017-01-20 11:46:47','192.168.2.200',0),(252,'ADMIN criação setor','setor criado: Compras','2017-01-20 11:47:04','192.168.2.200',0),(253,'ADMIN criação setor','setor criado: Patrimonio ','2017-01-20 11:47:56','192.168.2.200',0),(254,'ADMIN criação setor','setor criado: Estoque','2017-01-20 11:48:03','192.168.2.200',0),(255,'ADMIN criação setor','setor criado: Almoxarifado','2017-01-20 11:48:14','192.168.2.200',0),(256,'ADMIN criação setor','setor criado: Restaurante','2017-01-20 11:48:27','192.168.2.200',0),(257,'ADMIN criação setor','setor criado: Recursos Humanos','2017-01-20 11:49:10','192.168.2.200',0),(258,'ADMIN criação setor','setor criado: Contabilidade','2017-01-20 11:49:19','192.168.2.200',0),(259,'ADMIN criação setor','setor criado: Secretaria','2017-01-20 11:49:27','192.168.2.200',0),(260,'ADMIN criação setor','setor criado: Comunicação','2017-01-20 11:49:37','192.168.2.200',0),(261,'ADMIN criação setor','setor criado: Marketing','2017-01-20 11:49:44','192.168.2.200',0),(262,'ADMIN criação setor','setor criado: Diretoria','2017-01-20 11:49:51','192.168.2.200',0),(263,'ADMIN criação setor','setor criado: Jurídico ','2017-01-20 11:50:08','192.168.2.200',0),(264,'ADMIN criação setor','setor criado: Bar social','2017-01-20 11:50:44','192.168.2.200',0),(265,'ADMIN criação setor','setor criado: Bar ipanema','2017-01-20 11:50:54','192.168.2.200',0),(266,'ADMIN criação setor','setor criado: Bar infantil','2017-01-20 11:51:06','192.168.2.200',0),(267,'ADMIN criação setor','setor criado: Bar praça esportes','2017-01-20 11:51:23','192.168.2.200',0),(268,'ADMIN criação setor','setor criado: Bar molhado','2017-01-20 11:51:37','192.168.2.200',0),(269,'ADMIN criação setor','setor criado: Selv´s','2017-01-20 11:52:04','192.168.2.200',0),(270,'ADMIN criação setor','setor criado: Bar centro esportivo','2017-01-20 11:52:16','192.168.2.200',0),(271,'ADMIN criação setor','setor criado: Sauna masculina','2017-01-20 11:52:27','192.168.2.200',0),(272,'ADMIN criação setor','setor criado: sauna feminina','2017-01-20 11:52:34','192.168.2.200',0),(273,'ADMIN erro criação setor','tentativa de criar setor: Sauna masculina','2017-01-20 11:52:44','192.168.2.200',0),(274,'ADMIN criação setor','setor criado: Esportes','2017-01-20 11:53:28','192.168.2.200',0),(275,'ADMIN criação setor','setor criado: Academia','2017-01-20 11:53:33','192.168.2.200',0),(276,'ADMIN alteração setor','setor alterado: Sauna feminina','2017-01-20 11:54:45','192.168.2.200',0),(277,'ADMIN criação setor','setor criado: Portaria','2017-01-20 11:55:11','192.168.2.200',0),(278,'acesso','acesso ao controlador Home.php','2017-01-20 13:48:32','192.168.2.200',0),(279,'ADMIN desabilita setor','setor desabilitado id: 27','2017-01-20 13:55:21','192.168.2.200',0),(280,'ADMIN ativa setor','setor ativado id: 27','2017-01-20 13:55:25','192.168.2.200',0),(281,'ADMIN criação problema','problema criado: Redes Descrição: Acesso as pastas publicas, acesso a pasta do scaner e implementação de um novo ponto de rede','2017-01-20 14:39:36','192.168.2.200',0),(282,'ADMIN criação problema','problema criado: Hardware Descrição: Computador não liga ou não inicia. Monitor não liga. Teclado ou mouse não funciona.','2017-01-20 14:40:56','192.168.2.200',0),(283,'ADMIN criação problema','problema criado: Sistema Descrição: Instalar um software especifico. Não consigo abrir um sistema. Erro ao abrir um sistema.','2017-01-20 14:41:19','192.168.2.200',0),(284,'ADMIN criação problema','problema criado: RM Descrição: Erro ao acessar o RM. Criação de usuário e erros dentro do RM.','2017-01-20 14:41:31','192.168.2.200',0),(285,'ADMIN criação problema','problema criado: Chart Descrição: Erro ao acessar o CHART. Criação de usuários e erros dentro da CHART.','2017-01-20 14:41:43','192.168.2.200',0),(286,'ADMIN criação problema','problema criado: Impressora Descrição: Erro ao imprimir. Instalação de impressoras.','2017-01-20 14:47:03','192.168.2.200',0),(287,'ADMIN criação problema','problema criado: Catracas Descrição: Erros da catraca. Travar ou liberar catracas.','2017-01-20 14:47:19','192.168.2.200',0),(288,'ADMIN criação problema','problema criado: GPIC Descrição: Erro ao acessar o GPIC. Criação de usuários e erros dentro do GPIC.','2017-01-20 14:47:30','192.168.2.200',0),(289,'ADMIN criação problema','problema criado: Email Descrição: Erro ao enviar ou receber e-mail. Criação de usuários.','2017-01-20 14:47:43','192.168.2.200',0),(290,'ADMIN criação problema','problema criado: DataShow Descrição: Instalação do datashow e tela.','2017-01-20 14:47:55','192.168.2.200',0),(291,'ADMIN criação problema','problema criado: Telefonia Descrição: Erro ao realizar ou receber uma ligação. Criação de um novo ramal ou ponto de telefone.','2017-01-20 14:48:06','192.168.2.200',0),(292,'ADMIN criação problema','problema criado: Elétrico Descrição: Falta de energia ou criação de um novo ponto de energia.','2017-01-20 14:48:19','192.168.2.200',0),(293,'ADMIN criação problema','problema criado: Iluminação Descrição: Troca de lampadas e outros.','2017-01-20 14:48:30','192.168.2.200',0),(294,'ADMIN criação problema','problema criado: Internet Descrição: Problemas com conexão a internet, navegação lenta e bloqueio de sites','2017-01-20 14:48:46','192.168.2.200',0),(295,'ADMIN alteração problema','problema alterado: DataShow Descrição: Instalação do datashow e tela.','2017-01-20 14:49:02','192.168.2.200',0),(296,'ADMIN ativa problema','problema ativado id: 10','2017-01-20 14:49:53','192.168.2.200',0),(297,'ADMIN desabilita problema','problema desabilitado id: 9','2017-01-20 14:49:58','192.168.2.200',0),(298,'ADMIN ativa problema','problema ativado id: 9','2017-01-20 14:50:02','192.168.2.200',0),(299,'ADMIN alteração problema','problema alterado: Email Descrição: Erro ao enviar ou receber e-mail. Criação de usuários.','2017-01-20 14:50:10','192.168.2.200',0),(300,'ADMIN ativa problema','problema ativado id: 9','2017-01-20 14:50:14','192.168.2.200',0),(301,'acesso','acesso ao controlador Home.php','2017-01-20 14:57:27','192.168.2.200',0),(302,'ADMIN alteração setor','setor alterado: Academia','2017-01-20 15:04:53','192.168.2.200',0),(303,'ADMIN ativa setor','setor ativado id: 27','2017-01-20 15:04:56','192.168.2.200',0),(304,'ADMIN criação setor','setor criado: Contas a pagar','2017-01-20 15:09:41','192.168.2.200',0),(305,'ADMIN criação setor','setor criado: Contas a receber','2017-01-20 15:10:10','192.168.2.200',0),(306,'ADMIN criação setor','setor criado: Engenharia','2017-01-20 15:10:32','192.168.2.200',0),(307,'ADMIN desabilita usuario','usuario desabilitado id: 5','2017-01-20 15:11:07','192.168.2.200',0),(308,'ADMIN desabilita usuario','usuario desabilitado id: 6','2017-01-20 15:11:11','192.168.2.200',0),(309,'ADMIN desabilita usuario','usuario desabilitado id: 9','2017-01-20 15:11:17','192.168.2.200',0),(310,'acesso','acesso ao controlador Caixa.php','2017-01-20 15:18:26','192.168.2.200',0),(311,'acesso','acesso ao controlador Home.php','2017-01-20 15:28:58','192.168.2.200',0),(312,'acesso','acesso ao controlador Caixa.php','2017-01-20 15:29:00','192.168.2.200',0),(313,'acesso','acesso ao controlador Home.php','2017-01-20 15:29:02','192.168.2.200',0),(314,'acesso','acesso ao controlador Ocorrencia.php','2017-01-20 15:29:04','192.168.2.200',0),(315,'acesso','acesso ao controlador Ocorrencia.php','2017-01-20 15:29:18','192.168.2.200',0),(316,'acesso','acesso ao controlador Ocorrencia.php','2017-01-20 15:29:45','192.168.2.200',0),(317,'acesso','acesso ao controlador Home.php','2017-01-20 15:29:47','192.168.2.200',0),(318,'acesso','acesso ao controlador Caixa.php','2017-01-20 15:29:49','192.168.2.200',0),(319,'acesso','acesso ao controlador Home.php','2017-01-20 15:29:52','192.168.2.200',0),(320,'acesso','acesso ao controlador Ocorrencia.php','2017-01-20 15:41:04','192.168.2.200',0),(321,'ADMIN criação unidade','unidade criada: PIC PAMPULHA','2017-01-20 16:00:01','192.168.2.200',0),(322,'ADMIN alteração unidade','unidade alteradA: PIC PAMPULHA','2017-01-20 16:02:15','192.168.2.200',0),(323,'ADMIN ativa unidade','unidade ativada id: 1','2017-01-20 16:02:45','192.168.2.200',0),(324,'ADMIN criação unidade','unidade criada: PIC CIDADE','2017-01-20 16:02:58','192.168.2.200',0),(325,'ADMIN criação estado de ocorrencia','estado criado: Aberto','2017-01-20 17:21:13','192.168.2.200',0),(326,'ADMIN criação estado de ocorrencia','estado criado: Atendimento','2017-01-20 17:24:02','192.168.2.200',0),(327,'ADMIN criação estado de ocorrencia','estado criado: Fechado','2017-01-20 17:24:48','192.168.2.200',0),(328,'ADMIN alteração estado de ocorrencia','estado alterado: Atendimento','2017-01-20 17:26:51','192.168.2.200',0),(329,'ADMIN alteração estado de ocorrencia','estado alterado: Atendimento','2017-01-20 17:26:56','192.168.2.200',0),(330,'acesso','acesso ao controlador Home.php','2017-01-20 17:29:07','192.168.2.200',0),(331,'acesso','acesso ao controlador Caixa.php','2017-01-20 17:29:08','192.168.2.200',0),(332,'acesso','acesso ao controlador Home.php','2017-01-20 17:29:10','192.168.2.200',0),(333,'acesso','acesso ao controlador Ocorrencia.php','2017-01-20 17:29:11','192.168.2.200',0),(334,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA48 IP: 192.168.2.122\r\n','2017-01-21 15:00:05','0.0.0.0',0),(335,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA37 IP: 192.168.2.111\r\n','2017-01-21 15:00:05','0.0.0.0',0),(336,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA42 IP: 192.168.2.112\r\n','2017-01-21 15:00:05','0.0.0.0',0),(337,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA54 IP: 192.168.2.100\r\n','2017-01-21 15:00:05','0.0.0.0',0),(338,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA33 IP: 192.168.2.134\r\n','2017-01-21 15:00:05','0.0.0.0',0),(339,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA59 IP: 192.168.2.127\r\n','2017-01-21 15:00:05','0.0.0.0',0),(340,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA35 IP: 192.168.2.128\r\n','2017-01-21 15:00:05','0.0.0.0',0),(341,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA49 IP: 192.168.2.132\r\n','2017-01-21 15:00:05','0.0.0.0',0),(342,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA50 IP: 192.168.2.106\r\n','2017-01-21 15:00:05','0.0.0.0',0),(343,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA40 IP: 192.168.2.107\r\n','2017-01-21 15:00:05','0.0.0.0',0),(344,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA44 IP: 192.168.2.101\r\n','2017-01-21 15:00:05','0.0.0.0',0),(345,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA41 IP: 192.168.2.108\r\n','2017-01-21 15:00:06','0.0.0.0',0),(346,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA44 IP: 192.168.2.101\r\n','2017-01-21 15:00:06','0.0.0.0',0),(347,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA45 IP: 192.168.2.102\r\n','2017-01-21 15:00:06','0.0.0.0',0),(348,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA44 IP: 192.168.2.101\r\n','2017-01-21 15:00:06','0.0.0.0',0),(349,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA46 IP: 192.168.2.118\r\n','2017-01-21 15:00:06','0.0.0.0',0),(350,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA38 IP: 192.168.2.115\r\n','2017-01-21 15:00:06','0.0.0.0',0),(351,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA55 IP: 192.168.2.116\r\n','2017-01-21 15:00:06','0.0.0.0',0),(352,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA51 IP: 192.168.2.129\r\n','2017-01-21 15:00:06','0.0.0.0',0),(353,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA38 IP: 192.168.2.115\r\n','2017-01-21 15:00:06','0.0.0.0',0),(354,'ARQUIVO fim carregamento do arquivo','local do arquivo: Resource id #43','2017-01-21 15:00:06','0.0.0.0',0),(355,'acesso','acesso ao controlador Home.php','2017-01-21 17:24:10','192.168.2.200',0),(356,'acesso','acesso ao controlador Ocorrencia.php','2017-01-21 17:24:13','192.168.2.200',0),(357,'acesso','acesso ao controlador Home.php','2017-01-21 17:24:23','192.168.2.200',0),(358,'acesso','acesso ao controlador Caixa.php','2017-01-21 17:24:24','192.168.2.200',0),(359,'acesso','acesso ao controlador Caixa.php','2017-01-21 17:24:32','192.168.2.200',0),(360,'acesso','acesso ao controlador Caixa.php','2017-01-21 17:24:33','192.168.2.200',0),(361,'acesso','acesso ao controlador Caixa.php','2017-01-21 17:24:36','192.168.2.200',0),(362,'acesso','acesso ao controlador Caixa.php','2017-01-21 17:24:39','192.168.2.200',0),(363,'acesso','acesso ao controlador Caixa.php','2017-01-21 17:24:42','192.168.2.200',0),(364,'acesso','acesso ao controlador Caixa.php','2017-01-21 17:24:46','192.168.2.200',0),(365,'acesso','acesso ao controlador Caixa.php','2017-01-21 17:24:53','192.168.2.200',0),(366,'acesso','acesso ao controlador Caixa.php','2017-01-21 17:24:55','192.168.2.200',0),(367,'acesso','acesso ao controlador Caixa.php','2017-01-21 17:24:56','192.168.2.200',0),(368,'acesso','acesso ao controlador Caixa.php','2017-01-21 17:24:57','192.168.2.200',0),(369,'acesso','acesso ao controlador Caixa.php','2017-01-21 17:24:59','192.168.2.200',0),(370,'acesso','acesso ao controlador Caixa.php','2017-01-21 17:25:03','192.168.2.200',0),(371,'acesso','acesso ao controlador Home.php','2017-01-21 17:25:07','192.168.2.200',0),(372,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA37 IP: 192.168.2.111\r\n','2017-01-22 15:00:05','0.0.0.0',0),(373,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA37 IP: 192.168.2.111\r\n','2017-01-22 15:00:05','0.0.0.0',0),(374,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA54 IP: 192.168.2.100\r\n','2017-01-22 15:00:05','0.0.0.0',0),(375,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA37 IP: 192.168.2.111\r\n','2017-01-22 15:00:05','0.0.0.0',0),(376,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA45 IP: 192.168.2.102\r\n','2017-01-22 15:00:05','0.0.0.0',0),(377,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA45 IP: 192.168.2.102\r\n','2017-01-22 15:00:05','0.0.0.0',0),(378,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA45 IP: 192.168.2.102\r\n','2017-01-22 15:00:05','0.0.0.0',0),(379,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA37 IP: 192.168.2.111\r\n','2017-01-22 15:00:05','0.0.0.0',0),(380,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA42 IP: 192.168.2.112\r\n','2017-01-22 15:00:05','0.0.0.0',0),(381,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA37 IP: 192.168.2.111\r\n','2017-01-22 15:00:05','0.0.0.0',0),(382,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA48 IP: 192.168.2.122\r\n','2017-01-22 15:00:05','0.0.0.0',0),(383,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA50 IP: 192.168.2.106\r\n','2017-01-22 15:00:05','0.0.0.0',0),(384,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA54 IP: 192.168.2.100\r\n','2017-01-22 15:00:05','0.0.0.0',0),(385,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA45 IP: 192.168.2.102\r\n','2017-01-22 15:00:05','0.0.0.0',0),(386,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA41 IP: 192.168.2.108\r\n','2017-01-22 15:00:05','0.0.0.0',0),(387,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA54 IP: 192.168.2.100\r\n','2017-01-22 15:00:05','0.0.0.0',0),(388,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA59 IP: 192.168.2.127\r\n','2017-01-22 15:00:05','0.0.0.0',0),(389,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA35 IP: 192.168.2.128\r\n','2017-01-22 15:00:05','0.0.0.0',0),(390,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA44 IP: 192.168.2.101\r\n','2017-01-22 15:00:05','0.0.0.0',0),(391,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA33 IP: 192.168.2.134\r\n','2017-01-22 15:00:05','0.0.0.0',0),(392,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA49 IP: 192.168.2.132\r\n','2017-01-22 15:00:05','0.0.0.0',0),(393,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA55 IP: 192.168.2.116\r\n','2017-01-22 15:00:05','0.0.0.0',0),(394,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA38 IP: 192.168.2.115\r\n','2017-01-22 15:00:05','0.0.0.0',0),(395,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA46 IP: 192.168.2.118\r\n','2017-01-22 15:00:05','0.0.0.0',0),(396,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA36 IP: 192.168.2.130\r\n','2017-01-22 15:00:05','0.0.0.0',0),(397,'ARQUIVO maquina atualizada gravada no banco d','Nome: CAIXA51 IP: 192.168.2.129\r\n','2017-01-22 15:00:05','0.0.0.0',0),(398,'ARQUIVO fim carregamento do arquivo','local do arquivo: Resource id #43','2017-01-22 15:00:05','0.0.0.0',0),(399,'acesso','acesso ao controlador Home.php','2017-01-22 17:34:00','::1',0),(400,'acesso','acesso ao controlador Caixa.php','2017-01-22 17:34:02','192.168.2.200',0),(401,'acesso','acesso ao controlador Caixa.php','2017-01-22 17:34:10','192.168.2.200',0),(402,'acesso','acesso ao controlador Ocorrencia.php','2017-01-22 17:35:58','192.168.2.200',0),(403,'acesso','acesso ao controlador Caixa.php','2017-01-22 17:36:00','192.168.2.200',0),(404,'acesso','acesso ao controlador Caixa.php','2017-01-22 17:36:05','192.168.2.200',0),(405,'acesso','acesso ao controlador Caixa.php','2017-01-22 17:36:09','192.168.2.200',0),(406,'acesso','acesso ao controlador Caixa.php','2017-01-23 11:13:14','192.168.2.200',0),(407,'acesso','acesso ao controlador Home.php','2017-01-23 11:40:15','192.168.2.200',0),(408,'ARQUIVO maquina atualizada no BD','Nome: CAIXA54 IP: 192.168.2.100\r\n','2017-01-23 15:00:15','0.0.0.0',0),(409,'ARQUIVO maquina atualizada no BD','Nome: CAIXA37 IP: 192.168.2.111\r\n','2017-01-23 15:00:16','0.0.0.0',0),(410,'ARQUIVO maquina atualizada no BD','Nome: CAIXA40 IP: 192.168.2.107\r\n','2017-01-23 15:00:16','0.0.0.0',0),(411,'ARQUIVO maquina atualizada no BD','Nome: CAIXA55 IP: 192.168.2.116\r\n','2017-01-23 15:00:16','0.0.0.0',0),(412,'ARQUIVO maquina atualizada no BD','Nome: CAIXA51 IP: 192.168.2.129\r\n','2017-01-23 15:00:16','0.0.0.0',0),(413,'ARQUIVO fim carregamento do arquivo','local do arquivo: \\\\JAGUAR\\Parametros_ECF\\IpSistemaPic\\IP.TXT','2017-01-23 15:00:16','0.0.0.0',0),(414,'ADMIN criação email conf','email conf criada: Help-Desk PIC','2017-01-23 16:14:39','192.168.2.200',0),(415,'acesso','acesso ao controlador Home.php','2017-01-23 16:18:13','192.168.2.200',0),(416,'acesso','acesso ao controlador Home.php','2017-01-23 16:31:45','192.168.2.200',0),(417,'acesso','acesso ao controlador Home.php','2017-01-23 16:35:24','192.168.2.200',0),(418,'acesso','acesso ao controlador Home.php','2017-01-23 16:35:26','192.168.2.200',0),(419,'ADMIN desabilita email conf','email desabilitado id: 1','2017-01-23 16:36:22','192.168.2.200',0),(420,'ADMIN ativa email conf','email ativado id: 1','2017-01-23 16:38:42','192.168.2.200',0),(421,'acesso','acesso ao controlador Ocorrencia.php','2017-01-23 17:32:30','192.168.2.200',0),(422,'acesso','acesso ao controlador Home.php','2017-01-23 17:32:32','192.168.2.200',0),(423,'acesso','acesso ao controlador Caixa.php','2017-01-23 17:32:33','192.168.2.200',0),(424,'acesso','acesso ao controlador Caixa.php','2017-01-23 17:32:45','192.168.2.200',0),(425,'acesso','acesso ao controlador Caixa.php','2017-01-23 17:32:50','192.168.2.200',0),(426,'acesso','acesso ao controlador Caixa.php','2017-01-23 17:32:54','192.168.2.200',0),(427,'acesso','acesso ao controlador Caixa.php','2017-01-23 17:33:07','192.168.2.200',0),(428,'acesso','acesso ao controlador Caixa.php','2017-01-23 17:33:11','192.168.2.200',0),(429,'acesso','acesso ao controlador Caixa.php','2017-01-23 17:33:15','192.168.2.200',0),(430,'acesso','acesso ao controlador Home.php','2017-01-23 17:34:11','192.168.2.200',0),(431,'erro login','usuario denerjcampos@gmail.com tentou entrar no sistema com senha invalida','2017-01-23 17:34:29','192.168.2.200',0),(432,'login','usuario denerjcampos@gmail.com entrou no sistema','2017-01-23 17:34:39','192.168.2.200',1),(433,'acesso','acesso ao controlador Home.php','2017-01-23 17:34:39','192.168.2.200',1),(434,'acesso','acesso ao controlador Home.php','2017-01-23 17:34:42','192.168.2.200',0),(435,'ARQUIVO maquina atualizada no BD','Nome: CAIXA48 IP: 192.168.2.122\r\n','2017-01-24 15:00:05','0.0.0.0',0),(436,'ARQUIVO maquina atualizada no BD','Nome: CAIXA50 IP: 192.168.2.106\r\n','2017-01-24 15:00:05','0.0.0.0',0),(437,'ARQUIVO maquina atualizada no BD','Nome: CAIXA40 IP: 192.168.2.107\r\n','2017-01-24 15:00:05','0.0.0.0',0),(438,'ARQUIVO maquina atualizada no BD','Nome: CAIXA59 IP: 192.168.2.127\r\n','2017-01-24 15:00:05','0.0.0.0',0),(439,'ARQUIVO maquina atualizada no BD','Nome: CAIXA48 IP: 192.168.2.122\r\n','2017-01-24 15:00:05','0.0.0.0',0),(440,'ARQUIVO maquina atualizada no BD','Nome: CAIXA55 IP: 192.168.2.116\r\n','2017-01-24 15:00:05','0.0.0.0',0),(441,'ARQUIVO maquina atualizada no BD','Nome: CAIXA38 IP: 192.168.2.115\r\n','2017-01-24 15:00:05','0.0.0.0',0),(442,'ARQUIVO fim carregamento do arquivo','local do arquivo: \\\\JAGUAR\\Parametros_ECF\\IpSistemaPic\\IP.TXT','2017-01-24 15:00:05','0.0.0.0',0),(443,'acesso','acesso ao controlador Home.php','2017-01-25 10:40:36','192.168.2.200',0),(444,'acesso','acesso ao controlador Ocorrencia.php','2017-01-25 10:45:05','192.168.2.200',0),(445,'acesso','acesso ao controlador Home.php','2017-01-25 10:45:16','192.168.2.200',0),(446,'acesso','acesso ao controlador Caixa.php','2017-01-25 10:45:17','192.168.2.200',0),(447,'acesso','acesso ao controlador Home.php','2017-01-25 10:45:22','192.168.2.200',0),(448,'acesso','acesso ao controlador Home.php','2017-01-25 10:45:25','192.168.2.200',0),(449,'acesso','acesso ao controlador Home.php','2017-01-25 11:01:19','192.168.2.200',0);
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maquina`
--

DROP TABLE IF EXISTS `maquina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maquina` (
  `idmaquina` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Ips das maquinas no PIC',
  `nome` varchar(45) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `idlocal` int(11) NOT NULL,
  PRIMARY KEY (`idmaquina`),
  KEY `fk_maquina_local_idx` (`idlocal`),
  CONSTRAINT `fk_maquina_local` FOREIGN KEY (`idlocal`) REFERENCES `local` (`idlocal`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maquina`
--

LOCK TABLES `maquina` WRITE;
/*!40000 ALTER TABLE `maquina` DISABLE KEYS */;
INSERT INTO `maquina` VALUES (1,'CAIXA59','192.168.2.127\r\n',NULL,9),(2,'CAIXA35','192.168.2.128\r\n',NULL,9),(3,'CAIXA56','192.168.2.114\r\n',NULL,9),(4,'CAIXA49','192.168.2.132\r\n',NULL,6),(5,'CAIXA36','192.168.2.130\r\n',NULL,2),(6,'CAIXA46','192.168.2.118\r\n',NULL,2),(7,'CAIXA45','192.168.2.102\r\n',NULL,10),(8,'CAIXA37','192.168.2.111\r\n',NULL,3),(9,'CAIXA54','192.168.2.100\r\n',NULL,8),(10,'CAIXA57','192.168.2.109\r\n',NULL,10),(11,'CAIXA51','192.168.2.129\r\n',NULL,7),(12,'CAIXA40','192.168.2.107\r\n',NULL,5),(13,'CAIXA50','192.168.2.106\r\n',NULL,5),(14,'CAIXA48','192.168.2.122\r\n',NULL,8),(15,'CAIXA42','192.168.2.112\r\n',NULL,3),(16,'CAIXA38','192.168.2.115\r\n',NULL,2),(17,'CAIXA55','192.168.2.116\r\n',NULL,2),(18,'CAIXA33','192.168.2.134\r\n',NULL,11),(19,'CAIXA44','192.168.2.101\r\n',NULL,10),(20,'CAIXA41','192.168.2.108\r\n',NULL,4),(21,'CAIXA53','192.168.2.135\r\n',NULL,11),(22,'CAIXA34','192.168.2.105\r\n',NULL,5);
/*!40000 ALTER TABLE `maquina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensagem`
--

DROP TABLE IF EXISTS `mensagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensagem` (
  `idmensagem` int(11) NOT NULL AUTO_INCREMENT,
  `assunto` varchar(45) NOT NULL,
  `corpo` varchar(500) DEFAULT NULL,
  `data` datetime NOT NULL,
  `data_lida` datetime DEFAULT NULL,
  `usuario_recebe` int(11) NOT NULL,
  `usuario_envia` int(11) NOT NULL,
  PRIMARY KEY (`idmensagem`),
  KEY `fk_mensagem_usuario1_idx` (`usuario_envia`),
  CONSTRAINT `fk_mensagem_usuario1` FOREIGN KEY (`usuario_envia`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensagem`
--

LOCK TABLES `mensagem` WRITE;
/*!40000 ALTER TABLE `mensagem` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocorrencia`
--

DROP TABLE IF EXISTS `ocorrencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ocorrencia` (
  `idocorrencia` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(500) NOT NULL,
  `vnc` int(11) DEFAULT NULL,
  `ramal` int(11) DEFAULT NULL,
  `data_abertura` datetime NOT NULL,
  `data_fechamento` datetime DEFAULT NULL,
  `data_alteracao` datetime DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `usuario_atende` int(11) DEFAULT NULL,
  `usuario_fecha` int(11) DEFAULT NULL,
  `usuario_abre` int(11) NOT NULL,
  `idunidade` int(11) NOT NULL,
  `idarea` int(11) NOT NULL,
  `idsetor` int(11) NOT NULL,
  `idproblema` int(11) NOT NULL,
  `idestado` int(11) NOT NULL,
  `idocorrencia_estado` int(11) NOT NULL,
  PRIMARY KEY (`idocorrencia`),
  KEY `fk_ocorrencia_unidade1_idx` (`idunidade`),
  KEY `fk_ocorrencia_area1_idx` (`idarea`),
  KEY `fk_ocorrencia_Setor1_idx` (`idsetor`),
  KEY `fk_ocorrencia_problema1_idx` (`idproblema`),
  KEY `fk_ocorrencia_usuario1_idx` (`usuario_abre`),
  KEY `fk_ocorrencia_estado1_idx` (`idestado`),
  KEY `fk_ocorrencia_ocorrencia_estado1_idx` (`idocorrencia_estado`),
  CONSTRAINT `fk_ocorrencia_area1` FOREIGN KEY (`idarea`) REFERENCES `area` (`idarea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ocorrencia_estado1` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ocorrencia_ocorrencia_estado1` FOREIGN KEY (`idocorrencia_estado`) REFERENCES `ocorrencia_estado` (`idocorrencia_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ocorrencia_problema1` FOREIGN KEY (`idproblema`) REFERENCES `problema` (`idproblema`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ocorrencia_Setor1` FOREIGN KEY (`idsetor`) REFERENCES `setor` (`idSetor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ocorrencia_unidade1` FOREIGN KEY (`idunidade`) REFERENCES `unidade` (`idunidade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ocorrencia_usuario1` FOREIGN KEY (`usuario_abre`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocorrencia`
--

LOCK TABLES `ocorrencia` WRITE;
/*!40000 ALTER TABLE `ocorrencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `ocorrencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocorrencia_estado`
--

DROP TABLE IF EXISTS `ocorrencia_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ocorrencia_estado` (
  `idocorrencia_estado` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Estado da ocorrencia',
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idocorrencia_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocorrencia_estado`
--

LOCK TABLES `ocorrencia_estado` WRITE;
/*!40000 ALTER TABLE `ocorrencia_estado` DISABLE KEYS */;
INSERT INTO `ocorrencia_estado` VALUES (1,'Aberto','Chamado em aberto no sistema'),(2,'Atendimento','Chamados em atendimento no sistema'),(3,'Fechado','Chamados fechado no sistema');
/*!40000 ALTER TABLE `ocorrencia_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problema`
--

DROP TABLE IF EXISTS `problema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `problema` (
  `idproblema` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Problemas das ocorrencias',
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `idestado` int(11) NOT NULL,
  PRIMARY KEY (`idproblema`),
  KEY `fk_problema_estado1_idx` (`idestado`),
  CONSTRAINT `fk_problema_estado1` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problema`
--

LOCK TABLES `problema` WRITE;
/*!40000 ALTER TABLE `problema` DISABLE KEYS */;
INSERT INTO `problema` VALUES (1,'Redes','Acesso as pastas publicas, acesso a pasta do scaner e implementação de um novo ponto de rede',1),(2,'Hardware','Computador não liga ou não inicia. Monitor não liga. Teclado ou mouse não funciona.',1),(3,'Sistema','Instalar um software especifico. Não consigo abrir um sistema. Erro ao abrir um sistema.',1),(4,'RM','Erro ao acessar o RM. Criação de usuário e erros dentro do RM.',1),(5,'Chart','Erro ao acessar o CHART. Criação de usuários e erros dentro da CHART.',1),(6,'Impressora','Erro ao imprimir. Instalação de impressoras.',1),(7,'Catracas','Erros da catraca. Travar ou liberar catracas.',1),(8,'GPIC','Erro ao acessar o GPIC. Criação de usuários e erros dentro do GPIC.',1),(9,'Email','Erro ao enviar ou receber e-mail. Criação de usuários.',1),(10,'DataShow','Instalação do datashow e tela.',1),(11,'Telefonia','Erro ao realizar ou receber uma ligação. Criação de um novo ramal ou ponto de telefone.',1),(12,'Elétrico','Falta de energia ou criação de um novo ponto de energia.',1),(13,'Iluminação','Troca de lampadas e outros.',1),(14,'Internet','Problemas com conexão a internet, navegação lenta e bloqueio de sites',1);
/*!40000 ALTER TABLE `problema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setor`
--

DROP TABLE IF EXISTS `setor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setor` (
  `idsetor` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Setores do PIC.',
  `nome` varchar(45) NOT NULL,
  `idestado` int(11) NOT NULL,
  PRIMARY KEY (`idsetor`),
  KEY `fk_setor_estado1_idx` (`idestado`),
  CONSTRAINT `fk_setor_estado1` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setor`
--

LOCK TABLES `setor` WRITE;
/*!40000 ALTER TABLE `setor` DISABLE KEYS */;
INSERT INTO `setor` VALUES (1,'Tecnologia da informação PP',1),(2,'Tecnologia da informação PC',1),(3,'Fiscal',1),(4,'Tesouraria',1),(5,'Compras',1),(6,'Patrimonio ',1),(7,'Estoque',1),(8,'Almoxarifado',1),(9,'Restaurante',1),(10,'Recursos Humanos',1),(11,'Contabilidade',1),(12,'Secretaria',1),(13,'Comunicação',1),(14,'Marketing',1),(15,'Diretoria',1),(16,'Jurídico ',1),(17,'Bar social',1),(18,'Bar ipanema',1),(19,'Bar infantil',1),(20,'Bar praça esportes',1),(21,'Bar molhado',1),(22,'Selv´s',1),(23,'Bar centro esportivo',1),(24,'Sauna masculina',1),(25,'Sauna feminina',1),(26,'Esportes',1),(27,'Academia',1),(28,'Portaria',1),(29,'Contas a pagar',1),(30,'Contas a receber',1),(31,'Engenharia',1);
/*!40000 ALTER TABLE `setor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidade`
--

DROP TABLE IF EXISTS `unidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidade` (
  `idunidade` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unidades do PIC',
  `nome` varchar(45) NOT NULL,
  `idestado` int(11) NOT NULL,
  PRIMARY KEY (`idunidade`),
  KEY `fk_unidade_estado1_idx` (`idestado`),
  CONSTRAINT `fk_unidade_estado1` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidade`
--

LOCK TABLES `unidade` WRITE;
/*!40000 ALTER TABLE `unidade` DISABLE KEYS */;
INSERT INTO `unidade` VALUES (1,'PIC PAMPULHA',1),(2,'PIC CIDADE',1);
/*!40000 ALTER TABLE `unidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Usuarios do sistema',
  `nome` varchar(100) NOT NULL,
  `login` varchar(45) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nivel` int(11) NOT NULL COMMENT '0: admin',
  `idestado` int(11) NOT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `fk_usuario_estado1_idx` (`idestado`),
  CONSTRAINT `fk_usuario_estado1` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Dener Junio Andrade Novaes Campos','denerjcampos@gmail.com','$2y$10$YrJAYSPhC5N/F4C888nCNuvB9USxWwjcwG0SNAXFpzY1vVjsPVs0i',0,1),(2,'Dener Campos','dcampos@pic-clube.com.br','$2y$10$E4WAC.Ytu6qev6cLijacMe4wzMU2DrnPhf1Q1SEuaU3gCw2CjhlBO',1,1),(3,'usuario','usuario@pic-clube.com.br','$2y$10$4ND0D0KXIjFpI/8o9MoL8.QqNRqHjDbxbV6k.2QHIXnTQsHwcK0GG',2,1),(4,'teste','teste@gmail.com','$2y$10$0fDJ8zse5lu8aIw/9HhPh./7gc9qaWnORJjjfY7VjRB3O/8SLMivu',2,2),(5,'teste2','teste2@gmail.com','$2y$10$9rKm0wjevTREgGccn9D5yODnHDMI00O0eze0eNCU.kh2NlNLzDDUe',2,2),(6,'teste3','teste3@gmail.com','$2y$10$fWuvHXXih0NM3Xwg73Gj5OCyMMIjWtlWTOIQlWnXA7EY2baBsQwnK',2,2),(7,'teste4','teste4@gmail.com','$2y$10$nI81F92nHbX9aACkvbaCeOD74OhQK3jxyctypMPqFJE2Ch489k0YO',1,2),(8,'teste5','teste5@gmail.com','$2y$10$W5.FrYIHRr7gyJfATMIHFed18AR7q9ALzxEpzNJYJbiPlcUsL7cGa',1,2),(9,'teste6','teste6@gmail.com','$2y$10$/nz3e2ueVD95Vnc5gTGOUu30vembbvi/JMsJk.h7YA8ZctzPdCD0m',2,2),(10,'abobora','abobora@teste.com','$2y$10$mcinE7PdIJQ250s9yi0Swuo2tgUKyEU/ZnEnyhy1NrI/hwtBtPCSu',1,2);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-25 11:12:31
