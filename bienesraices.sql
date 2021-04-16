CREATE DATABASE  IF NOT EXISTS `bienesraices` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bienesraices`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: bienesraices
-- ------------------------------------------------------
-- Server version	5.7.30-log

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
-- Table structure for table `amenidad`
--

DROP TABLE IF EXISTS `amenidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amenidad` (
  `ID_Ame` int(2) NOT NULL AUTO_INCREMENT,
  `Nom_Ame` varchar(60) NOT NULL,
  PRIMARY KEY (`ID_Ame`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amenidad`
--

LOCK TABLES `amenidad` WRITE;
/*!40000 ALTER TABLE `amenidad` DISABLE KEYS */;
INSERT INTO `amenidad` VALUES (4,'BaÃ±os'),(5,'Habitaciones'),(6,'Estacionamiento');
/*!40000 ALTER TABLE `amenidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cantidad`
--

DROP TABLE IF EXISTS `cantidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cantidad` (
  `ID_Inm_Can` int(11) NOT NULL,
  `ID_Ame_Can` int(2) NOT NULL,
  `Valor_Can` int(11) NOT NULL,
  PRIMARY KEY (`ID_Inm_Can`,`ID_Ame_Can`),
  KEY `fk_INMUEBLE_has_AMENIDAD_AMENIDAD1_idx` (`ID_Ame_Can`),
  KEY `fk_INMUEBLE_has_AMENIDAD_INMUEBLE1_idx` (`ID_Inm_Can`),
  CONSTRAINT `fk_INMUEBLE_has_AMENIDAD_AMENIDAD1` FOREIGN KEY (`ID_Ame_Can`) REFERENCES `amenidad` (`ID_Ame`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_INMUEBLE_has_AMENIDAD_INMUEBLE1` FOREIGN KEY (`ID_Inm_Can`) REFERENCES `inmueble` (`ID_Inm`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cantidad`
--

LOCK TABLES `cantidad` WRITE;
/*!40000 ALTER TABLE `cantidad` DISABLE KEYS */;
INSERT INTO `cantidad` VALUES (4,4,7),(4,6,3),(6,4,7),(6,5,5),(6,6,1),(7,4,3),(7,5,2),(7,6,1),(8,4,8),(8,6,3),(10,4,7),(10,6,4);
/*!40000 ALTER TABLE `cantidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudad` (
  `ID_Ciu` int(8) NOT NULL AUTO_INCREMENT,
  `Nom_Ciu` varchar(60) NOT NULL,
  `ID_Est_Ciu` int(8) NOT NULL,
  PRIMARY KEY (`ID_Ciu`),
  KEY `fk_CIUDAD_ESTADO1_idx` (`ID_Est_Ciu`),
  CONSTRAINT `fk_CIUDAD_ESTADO1` FOREIGN KEY (`ID_Est_Ciu`) REFERENCES `estado` (`ID_Est`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudad`
--

LOCK TABLES `ciudad` WRITE;
/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
INSERT INTO `ciudad` VALUES (1,'MÃ©rida',1),(2,'Hunucma',1),(3,'Campeche',3),(4,'Ciudad del Carmen',3),(5,'Cancun',2),(6,'Playa del Carmen',2),(7,'KanasÃ­n',1),(8,'Chetumal',2),(9,'Champoton',3);
/*!40000 ALTER TABLE `ciudad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `ID_Est` int(8) NOT NULL AUTO_INCREMENT,
  `Nom_Est` varchar(60) NOT NULL,
  PRIMARY KEY (`ID_Est`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'YucatÃ¡n'),(2,'Quintana Roo'),(3,'Campeche');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inmueble`
--

DROP TABLE IF EXISTS `inmueble`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inmueble` (
  `ID_Inm` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_Inm` varchar(100) NOT NULL,
  `Catego_Inm` varchar(5) NOT NULL,
  `Precio_Inm` decimal(11,2) NOT NULL,
  `ID_Tipo_Inm` int(2) NOT NULL,
  `Galeria_Inm` varchar(100) NOT NULL,
  `Descripcion_Inm` varchar(300) NOT NULL,
  `ID_Usu_Inm` int(11) NOT NULL,
  `Direccion_Inm` varchar(150) NOT NULL,
  `ID_Loc_Inm` int(8) NOT NULL,
  `Estatus_Inm` varchar(9) NOT NULL,
  PRIMARY KEY (`ID_Inm`),
  KEY `fk_INMUEBLES_TIPO1_idx` (`ID_Tipo_Inm`),
  KEY `fk_INMUEBLE_LOCALIDAD1_idx` (`ID_Loc_Inm`),
  KEY `fk_INMUEBLE_USUARIO1_idx` (`ID_Usu_Inm`),
  CONSTRAINT `fk_INMUEBLES_TIPO1` FOREIGN KEY (`ID_Tipo_Inm`) REFERENCES `tipo` (`ID_Tipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_INMUEBLE_LOCALIDAD1` FOREIGN KEY (`ID_Loc_Inm`) REFERENCES `localidad` (`ID_Loc`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_INMUEBLE_USUARIO1` FOREIGN KEY (`ID_Usu_Inm`) REFERENCES `usuario` (`ID_Usu`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inmueble`
--

LOCK TABLES `inmueble` WRITE;
/*!40000 ALTER TABLE `inmueble` DISABLE KEYS */;
INSERT INTO `inmueble` VALUES (4,'Almacen grande cerca del puerto','Venta',190000.00,3,'imagenes/gg.jpg','AlmacÃ©n de 234m2 con vista al mar cerca del pueblo y en optimas condiciones',3,'1234 Main st',3,'Aceptado'),(6,'Casa del bosque','Venta',2000000.00,1,'imagenes/imagen prueba.jpg','Casa en el bosque magico de vergel',5,'Calle 14 #70 int145 entre 20 Circuito Colonias CP: 97158',1,'Aceptado'),(7,'Casa en ciudad MÃ©rida','Renta',100000.00,1,'imagenes/Carrusel1.png','Casa de 2 pisos, de 107m2 en zona residencial en el norte de la ciudad, fachada color blanco con estacionamiento y un pequeÃ±o JardÃ­n',1,'Calle 14 #70 int145 entre 20 Circuito Colonias CP: 97158',1,'Aceptado'),(8,'Almacen de carga pesada','Renta',130000.00,3,'imagenes/almacen.webp','Almacen de 237m2 en la colonia itzinma de carga pesada con zona de carga y descarga en la calle trasera, calle 82',6,'Calle 80 entre 67 y 69 colonia Itzimna',1,'Aceptado'),(9,'Local en el centro','Renta',7000.00,4,'imagenes/cierran500comercios-focus-0-0-696-423.jpg','Local de 67m2 en el centro de la ciudad, a un costado de Chapur en el pasillo 3 de la calle 58 en el centro de MÃ©rida',5,'Calle 58 #133 entre 59 y 61 colonia Centro, local 11',1,'Pendiente'),(10,'Oficiona en el edificio negro','Renta',200000.00,6,'imagenes/cdn-3.expansion.mx.jfif','Oficina en el edificio en la ciudad de campeche, de 117m2 con vista al mar y parqueamiento',3,'Calle 78 #133 entre 77 y 79 colonia Centro',7,'Aceptado');
/*!40000 ALTER TABLE `inmueble` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `localidad`
--

DROP TABLE IF EXISTS `localidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `localidad` (
  `ID_Loc` int(8) NOT NULL AUTO_INCREMENT,
  `Nom_Loc` varchar(60) NOT NULL,
  `ID_Ciu_Loc` int(8) NOT NULL,
  PRIMARY KEY (`ID_Loc`),
  KEY `fk_LOCALIDAD_CIUDAD1_idx` (`ID_Ciu_Loc`),
  CONSTRAINT `fk_LOCALIDAD_CIUDAD1` FOREIGN KEY (`ID_Ciu_Loc`) REFERENCES `ciudad` (`ID_Ciu`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localidad`
--

LOCK TABLES `localidad` WRITE;
/*!40000 ALTER TABLE `localidad` DISABLE KEYS */;
INSERT INTO `localidad` VALUES (1,'MÃ©rida',1),(2,'Chichi Suarez',1),(3,'Sisal',2),(4,'Cancun',5),(5,'Chetumal',8),(6,'Playa del Carmen',6),(7,'Campeche',3),(8,'Champoton',9),(9,'Ciudad del Carmen',4);
/*!40000 ALTER TABLE `localidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo` (
  `ID_Tipo` int(2) NOT NULL AUTO_INCREMENT,
  `Nom_Tipo` varchar(60) NOT NULL,
  PRIMARY KEY (`ID_Tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo`
--

LOCK TABLES `tipo` WRITE;
/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
INSERT INTO `tipo` VALUES (1,'Casa'),(2,'Departamento'),(3,'Almacen'),(4,'Local'),(5,'Terreno'),(6,'Oficina');
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `ID_Usu` int(11) NOT NULL AUTO_INCREMENT,
  `Email_Usu` varchar(100) NOT NULL,
  `Pass_Usu` varchar(60) NOT NULL,
  `Nom_Usu` varchar(60) NOT NULL,
  `PriApe_Usu` varchar(60) NOT NULL,
  `SegApe_Usu` varchar(60) DEFAULT NULL,
  `Cel_Tel_Usu` bigint(10) NOT NULL,
  `Direccion_Usu` varchar(150) NOT NULL,
  `ID_Loc_Usu` int(8) NOT NULL,
  `Tipo_Usu` varchar(13) NOT NULL,
  PRIMARY KEY (`ID_Usu`),
  UNIQUE KEY `Email_Cli_UNIQUE` (`Email_Usu`),
  KEY `fk_VENDEDOR_LOCALIDAD1_idx` (`ID_Loc_Usu`),
  CONSTRAINT `fk_VENDEDOR_LOCALIDAD1` FOREIGN KEY (`ID_Loc_Usu`) REFERENCES `localidad` (`ID_Loc`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'cap.web12@gmail.com','$2y$10$7YPfU6oz3x.qONs0i.o4s.PW556x5hXKKXvNeqYdDQuErUDiUjuki','Marco Antonio','Pat','Chim',9995289559,'C67 #80 entre 16 y 22 Fraccionamiento Fidel Velazquez',1,'Administrador'),(2,'correo@gmail.edu','$2y$10$F8oYcmCVXjBc.wcTngFj5uXCbdcXkkzC3vnYNFUFBdQBLYY58xFHa','Rosa Ivette','Perez','Rodriguez',9991234567,'1234 Main stsss',2,'Vendedor'),(3,'diegotronix@gmail.com','$2y$10$fv.n6DRwQSah4T7QX4UW.OFYqmc2uSqLMSchDrv.5AeVJTxYmh.B.','Diego','Caballero','',9997654321,'Calle 89a #167a entre 42 y 44',1,'Vendedor'),(5,'javiergurubel11@gmail.com','$2y$10$R3Tx2x1.5P/AT2P0nblVGertNm372dRDaoTxHb8x67DmLiPz.qCG.','Javier Jeremias','Gurubel','Romero',1234567890,'1234 Main st',1,'Vendedor'),(6,'fernandosuarez03@hotmail.com','$2y$10$/HAUEKthbiLm/WjLNwW3.uiP0q4NYshTdCIZi0mXvUyDYG27TI9r2','Fernando','Suarez','Alonso',987654321,'Calle 17 #38 x 16 y 42 colonia centro',1,'Vendedor'),(7,'vladilopez@gmail.com','$2y$10$OWPBAkxxt5mbvG6WWn5tpeRUqqWS4eaHlI/wESKhhsO.OybWvRUU6','Vladimir','Lopez','',1234567890,'1234 Main st',1,'Vendedor');
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

-- Dump completed on 2020-07-20 19:56:07
