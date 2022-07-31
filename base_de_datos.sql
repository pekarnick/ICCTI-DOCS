CREATE DATABASE  IF NOT EXISTS `c3_fontech` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `c3_fontech`;
-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: 190.7.30.27    Database: c3_fontech
-- ------------------------------------------------------
-- Server version	5.5.37-0+wheezy1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `documentos`
--

DROP TABLE IF EXISTS `documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postulante_id` int(11) NOT NULL,
  `proyecto_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `detalles` text,
  `file` text NOT NULL,
  `observaciones` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `localidades`
--

DROP TABLE IF EXISTS `localidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `localidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `localidad` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localidades`
--

LOCK TABLES `localidades` WRITE;
/*!40000 ALTER TABLE `localidades` DISABLE KEYS */;
INSERT INTO `localidades` VALUES (1,'Aviá Teraí'),(2,'Barranqueras'),(3,'Basail'),(4,'Campo Largo'),(5,'Capital'),(6,'Capitán Solari'),(7,'Charadai'),(8,'Charata'),(9,'Chorotis'),(10,'Ciervo Petiso'),(11,'Cnel. Du Graty'),(12,'Col. Benítez'),(13,'Col. Elisa'),(14,'Col. Popular'),(15,'Colonias Unidas'),(16,'Concepción'),(17,'Corzuela'),(18,'Cote Lai'),(19,'El Sauzalito'),(20,'Enrique Urien'),(21,'Fontana'),(22,'Fte. Esperanza'),(23,'Gancedo'),(24,'Gral. Capdevila'),(25,'Gral. Pinero'),(26,'Gral. San Martín'),(27,'Gral. Vedia'),(28,'Hermoso Campo'),(29,'I. del Cerrito'),(30,'J.J. Castelli'),(31,'La Clotilde'),(32,'La Eduvigis'),(33,'La Escondida'),(34,'La Leonesa'),(35,'La Tigra'),(36,'La Verde'),(37,'Laguna Blanca'),(38,'Laguna Limpia'),(39,'Lapachito'),(40,'Las Breñas'),(41,'Las Garcitas'),(42,'Las Palmas'),(43,'Los Frentones'),(44,'Machagai'),(45,'Makallé'),(46,'Margarita Belén'),(47,'Miraflores'),(48,'Misión N. Pompeya'),(49,'Napenay'),(50,'Pampa Almirón'),(51,'Pampa del Indio'),(52,'Pampa del Infierno'),(53,'Pdcia. de La Plaza'),(54,'Pdcia. Roca'),(55,'Pdcia. Roque Sáenz Peña'),(56,'Pto. Bermejo'),(57,'Pto. Eva Perón'),(58,'Puero Tirol'),(59,'Puerto Vilelas'),(60,'Quitilipi'),(61,'Resistencia'),(62,'Sáenz Peña'),(63,'Samuhú'),(64,'San Bernardo'),(65,'Santa Sylvina'),(66,'Taco Pozo'),(67,'Tres Isletas'),(68,'Villa Ángela'),(69,'Villa Berthet'),(70,'Villa R. Bermejito'),(71,'--Otra Jurisdicción--');
/*!40000 ALTER TABLE `localidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `miscelaneas`
--

DROP TABLE IF EXISTS `miscelaneas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `miscelaneas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(200) DEFAULT NULL,
  `valor` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `miscelaneas`
--

LOCK TABLES `miscelaneas` WRITE;
/*!40000 ALTER TABLE `miscelaneas` DISABLE KEYS */;
INSERT INTO `miscelaneas` VALUES (3,'fecha_limite','2022-07-24');
/*!40000 ALTER TABLE `miscelaneas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postulantes`
--

DROP TABLE IF EXISTS `postulantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `postulantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cuit` varchar(13) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postulantes`
--

LOCK TABLES `postulantes` WRITE;
/*!40000 ALTER TABLE `postulantes` DISABLE KEYS */;
INSERT INTO `postulantes` VALUES (1,'11-11111111-1','Administrador','FONTECH','111111111111111','11111@gmail.com','2022-04-27 12:49:47','2022-04-30 21:02:58');
/*!40000 ALTER TABLE `postulantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyectos`
--

DROP TABLE IF EXISTS `proyectos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(255) NOT NULL,
  `cuit` varchar(13) NOT NULL,
  `domicilio_fiscal` text NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `localidad` varchar(255) NOT NULL,
  `actividad_principal` varchar(150) NOT NULL,
  `cantidad_total_de_empleados` int(6) NOT NULL,
  `categoria_mypyme` varchar(3) NOT NULL,
  `representante_legal_nombre` varchar(255) NOT NULL,
  `representante_legal_cuit_cuil` varchar(13) NOT NULL,
  `representante_legal_telefono` varchar(20) NOT NULL,
  `proyecto_titulo` varchar(255) NOT NULL,
  `proyecto_tipo` varchar(45) NOT NULL,
  `proyecto_localidad` varchar(255) NOT NULL,
  `proyecto_nombre_director` varchar(25) NOT NULL,
  `proyecto_monto_solicitado` decimal(15,2) NOT NULL,
  `reportado` varchar(2) DEFAULT NULL,
  `postulante_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `bloqueado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyectos`
--

LOCK TABLES `proyectos` WRITE;
/*!40000 ALTER TABLE `proyectos` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyectos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos`
--

DROP TABLE IF EXISTS `tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text,
  `obligatorio` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos`
--

LOCK TABLES `tipos` WRITE;
/*!40000 ALTER TABLE `tipos` DISABLE KEYS */;
INSERT INTO `tipos` VALUES (1,'1 - Memoria Técnica','SI','2022-06-13 00:00:00','2022-07-26 11:10:22'),(2,'2 - Plan de Ejecución Física (Solo para ANR)','NO','2022-06-13 00:00:00','2022-07-26 11:12:09'),(3,'3 - Formulario de Costos','SI','2022-06-28 00:00:00','2022-06-28 00:00:00'),(4,'4 - Formulario de Actividades de Innovación','SI','2022-06-13 00:00:00','2022-06-13 00:00:00'),(5,'5 - Formulario de proyecciones (Solo para AR)','NO','2022-06-14 00:00:00','2022-06-14 00:00:00'),(6,'6 - 7 - 8 - Declaraciones Juradas','SI','2022-06-15 00:00:00','2022-06-15 00:00:00'),(7,'9 - Certificado PYME','SI','2022-06-16 00:00:00','2022-06-16 00:00:00'),(8,'10 - Constancia de calificación crediticia BCRA','SI','2022-06-17 00:00:00','2022-06-17 00:00:00'),(9,'11 - Constancia de inscripción en AFIP','SI','2022-06-13 00:00:00','2022-06-13 00:00:00'),(10,'12 - Estatuto y acta de designación de autoridades o en el caso de ser Monotributista DNI','SI','2022-06-13 00:00:00','2022-07-21 17:16:36'),(11,'13 - Cotizaciones de Referencia para montos mayores a $100.000','SI','2022-06-13 00:00:00','2022-06-13 00:00:00'),(12,'14 - CVs RRHH','SI','2022-06-13 00:00:00','2022-06-13 00:00:00');
/*!40000 ALTER TABLE `tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos3`
--

DROP TABLE IF EXISTS `tipos3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipos3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos3`
--

LOCK TABLES `tipos3` WRITE;
/*!40000 ALTER TABLE `tipos3` DISABLE KEYS */;
INSERT INTO `tipos3` VALUES (1,'1 - Memoria Técnica','2022-06-13','2022-06-13'),(2,'2 - Plan de Ejecución Física','2022-06-13','2022-06-13'),(3,'4 - Formulario de Actividades de Innovación','2022-06-13','2022-06-13'),(4,'6 - 7 - 8 - Declaraciones Juradas','2022-06-13','2022-06-13'),(5,'Constancia de inscripción en AFIP','2022-06-13','2022-06-13'),(6,'Certificado PYME','2022-06-13','2022-06-13'),(7,'Constancia de calificación crediticia BCRA','2022-06-13','2022-06-13'),(8,'Estatuto y acta de designación de autoridades','2022-06-13','2022-06-13'),(9,'Cotizaciones de Referencia para montos mayores a $100.000','2022-06-13','2022-06-13'),(10,'CVs RRHH','2022-06-13','2022-06-13'),(11,'Formulario de Costos','2022-06-28','2022-06-28');
/*!40000 ALTER TABLE `tipos3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postulante_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `rol` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'correo@gmail.com','admin','$2y$10$CGY8AOLhps8PFy6aF5sD6.Gl5NQoGJFok7tlGmNsH4gHAxOcSh8xS','0','2022-04-27 17:36:57','2022-04-27 17:36:57');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-31 15:17:54
