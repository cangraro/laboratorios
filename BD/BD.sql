CREATE DATABASE  IF NOT EXISTS `laboratorios` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `laboratorios`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: laboratorios
-- ------------------------------------------------------
-- Server version	5.6.21

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
-- Table structure for table `actividades`
--

DROP TABLE IF EXISTS `actividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actividades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) DEFAULT NULL,
  `id_tipos_equipos` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `tipos_equipo_fk_idx` (`id_tipos_equipos`),
  CONSTRAINT `tipos_equipo_fk` FOREIGN KEY (`id_tipos_equipos`) REFERENCES `tipos_equipos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividades`
--

LOCK TABLES `actividades` WRITE;
/*!40000 ALTER TABLE `actividades` DISABLE KEYS */;
INSERT INTO `actividades` VALUES (5,'Verificar el funcionamiento del equipo',1,1),(6,'Chequeo de estado de la plataforma de carga',1,1),(7,'Verificacion mediante prueba de peso con juego de masas',1,1),(8,'Ajuste a cero',1,1),(9,'Lubricación de poleas, tensores, desplazador de medicion de estatura',1,1),(10,'Limpieza general',1,1),(11,'Verificar el funcionamiento del equipo',3,1),(12,'Revisión de partes y accesorios',3,1),(13,'Limpieza general del equipo',3,1),(14,'Lubricación de partes móviles',3,1),(15,'Verificar el funcionamiento del equipo',5,1),(16,'Revisión de partes y accesorios (estado del mango, posibles rayones, partículas de polvo o indicios de hongos en sistema óptico de oftalmoscopio y otoscopio)',5,1),(17,'Limpieza interna de sistema óptico de oftalmoscopio',5,1),(18,'Inspección de estado de la bombilla de otoscopio y oftalmoscopio',5,1),(19,'Inspección de carga de baterías',5,1),(20,'Verificar el funcionamiento del equipo',6,1),(21,'Revisión de partes y accesorios (estado del diafragma, orring´s, olivas y cable siliconado)',6,1),(22,'Despiece del equipo',6,1),(23,'Limpieza general del equipo',6,1),(24,'Lubricación de partes móviles',6,1),(25,'Verificar el funcionamiento del equipo',7,1),(26,'Revisión de partes y accesorios (plumón)',7,1),(27,'Despiece del equipo',7,1),(28,'Limpieza general del equipo',7,1),(29,'Verificar el funcionamiento del equipo',8,1),(30,'Revisión de partes y accesorios',8,1),(31,'Despiece del equipo',8,1),(32,'Inspección de bombilla 110 VAC',8,1),(33,'Limpieza general del equipo',8,1),(34,'Verificar el funcionamiento del equipo',9,1),(35,'Revisión de partes y accesorios (Valvas y mango)',9,1),(36,'Despiece del equipo',9,1),(37,'Inspección de bombilla halógena',9,1),(38,'Inspección de carga de baterías',9,1),(39,'Limpieza general del equipo',9,1),(40,'Verificar el funcionamiento del equipo',10,1),(41,'Revisión de partes y accesorios',10,1),(42,'Despiece del equipo',10,1),(43,'Lubricación de partes móviles',10,1),(44,'Limpieza general del equipo',10,1),(45,'Verificar el funcionamiento del equipo',11,1),(46,'Revisión de partes y accesorios',11,1),(47,'Despiece del equipo',11,1),(48,'Limpieza general del equipo',11,1),(49,'Verificar el funcionamiento del equipo',12,1),(50,'Revisión de partes y accesorios (manómetro, perillas)',12,1),(51,'Chequeo de fugas en conexiones',12,1),(52,'Limpieza general del equipo',12,1),(53,'Verificar el funcionamiento del equipo',13,1),(54,'Revisión de partes y accesorios (manómetro, brazalete, cámara y pera)',13,1),(55,'Inspección de fugas en el sistema neumático',13,1),(56,'Limpieza general del equipo',13,1),(57,'Verificar el funcionamiento del equipo',14,1),(58,'Revisión de partes y accesorios',14,1),(59,'Inspección de programación de hora y fecha',14,1),(60,'Chequeo de carga de batería',14,1),(61,'Limpieza general del equipo',14,1),(62,'Verificar el funcionamiento del equipo',4,1),(63,'Revisión de partes y accesorios (funcionamiento de transductor)',4,1),(64,'Limpieza general del equipo',4,1),(65,'Inspección de carga de baterías',4,1),(66,'Verificar el funcionamiento del equipo',2,1),(67,'Revisión de partes y accesorios (electrodos-batería)',2,1),(68,'Despiece del equipo',2,1),(69,'Limpieza general del equipo',2,1),(70,'Cambiar llantas',3,0),(71,'PRotocolo 1',1,1);
/*!40000 ALTER TABLE `actividades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actividades_procedimientos`
--

DROP TABLE IF EXISTS `actividades_procedimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actividades_procedimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_procedimiento` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `id_resultado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_procedimiento_fk_idx` (`id_procedimiento`),
  KEY `id_actividad_fk_idx` (`id_actividad`),
  KEY `id_resultado_fk_idx` (`id_resultado`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividades_procedimientos`
--

LOCK TABLES `actividades_procedimientos` WRITE;
/*!40000 ALTER TABLE `actividades_procedimientos` DISABLE KEYS */;
INSERT INTO `actividades_procedimientos` VALUES (25,1,5,1),(26,1,6,1),(27,1,7,2),(28,1,8,2),(29,1,9,3),(30,1,10,3),(31,2,5,2),(32,2,6,1),(33,2,7,3),(34,2,8,2),(35,2,9,1),(36,2,10,1),(37,12,5,1),(38,12,6,2),(39,12,7,3),(40,12,8,1),(41,12,9,1),(42,12,10,1),(43,13,66,1),(44,13,67,1),(45,13,68,2),(46,13,69,2),(47,14,5,2),(48,14,6,1),(49,14,7,2),(50,14,8,2),(51,14,9,1),(52,14,10,1),(53,15,5,1),(54,15,6,1),(55,15,7,1),(56,15,8,1),(57,15,9,1),(58,15,10,1),(61,16,5,0),(62,16,6,0),(63,16,7,0),(64,16,8,0),(65,16,9,0),(66,16,10,0),(67,29,5,0),(68,29,6,0),(69,29,7,0),(70,29,8,0),(71,29,9,0),(72,29,10,0),(73,30,5,0),(74,30,6,0),(75,30,7,0),(76,30,8,0),(77,30,9,0),(78,30,10,0),(79,31,5,0),(80,31,6,0),(81,31,7,0),(82,31,8,0),(83,31,9,0),(84,31,10,0),(85,32,5,1),(86,32,6,1),(87,32,7,1),(88,32,8,1),(89,32,9,1),(90,32,10,1),(91,34,5,1),(92,34,6,3),(93,34,7,2),(94,34,8,1),(95,34,9,1),(96,34,10,1),(97,39,45,1),(98,39,46,1),(99,39,47,1),(100,39,48,1),(101,42,5,1),(102,42,6,2),(103,42,7,2),(104,42,8,1),(105,42,9,3),(106,42,10,1),(107,42,71,1);
/*!40000 ALTER TABLE `actividades_procedimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_menu`
--

DROP TABLE IF EXISTS `categoria_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `icon` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_menu`
--

LOCK TABLES `categoria_menu` WRITE;
/*!40000 ALTER TABLE `categoria_menu` DISABLE KEYS */;
INSERT INTO `categoria_menu` VALUES (1,'Equipos',1,'microchip'),(3,'Procedimientos',1,'gears'),(4,'Proveedores',1,'address-card'),(5,'Consultas',1,'search'),(6,'Administracion',1,'user');
/*!40000 ALTER TABLE `categoria_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_departamentos_idx` (`id_departamento`),
  CONSTRAINT `fk_departamentos` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1121 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudades`
--

LOCK TABLES `ciudades` WRITE;
/*!40000 ALTER TABLE `ciudades` DISABLE KEYS */;
INSERT INTO `ciudades` VALUES (1,'Medellin',2,1),(2,'Abejorral',2,1),(3,'Abriaqui',2,1),(4,'Alejandria',2,1),(5,'Amaga',2,1),(6,'Amalfi',2,1),(7,'Andes',2,1),(8,'Angelopolis',2,1),(9,'Angostura',2,1),(10,'Anori',2,1),(11,'Santafe De Antioquia',2,1),(12,'Anza',2,1),(13,'Apartado',2,1),(14,'Arboletes',2,1),(15,'Argelia',2,1),(16,'Armenia',2,1),(17,'Barbosa',2,1),(18,'Belmira',2,1),(19,'Bello',2,1),(20,'Betania',2,1),(21,'Betulia',2,1),(22,'Ciudad Bolivar',2,1),(23,'Briceño',2,1),(24,'Buritica',2,1),(25,'Caceres',2,1),(26,'Caicedo',2,1),(27,'Caldas',2,1),(28,'Campamento',2,1),(29,'Cañasgordas',2,1),(30,'Caracoli',2,1),(31,'Caramanta',2,1),(32,'Carepa',2,1),(33,'El Carmen De Viboral',2,1),(34,'Carolina',2,1),(35,'Caucasia',2,1),(36,'Chigorodo',2,1),(37,'Cisneros',2,1),(38,'Cocorna',2,1),(39,'Concepcion',2,1),(40,'Concordia',2,1),(41,'Copacabana',2,1),(42,'Dabeiba',2,1),(43,'Don Matias',2,1),(44,'Ebejico',2,1),(45,'El Bagre',2,1),(46,'Entrerrios',2,1),(47,'Envigado',2,1),(48,'Fredonia',2,1),(49,'Frontino',2,1),(50,'Giraldo',2,1),(51,'Girardota',2,1),(52,'Gomez Plata',2,1),(53,'Granada',2,1),(54,'Guadalupe',2,1),(55,'Guarne',2,1),(56,'Guatape',2,1),(57,'Heliconia',2,1),(58,'Hispania',2,1),(59,'Itagui',2,1),(60,'Ituango',2,1),(61,'Jardin',2,1),(62,'Jerico',2,1),(63,'La Ceja',2,1),(64,'La Estrella',2,1),(65,'La Pintada',2,1),(66,'La Union',2,1),(67,'Liborina',2,1),(68,'Maceo',2,1),(69,'Marinilla',2,1),(70,'Montebello',2,1),(71,'Murindo',2,1),(72,'Mutata',2,1),(73,'Nariño',2,1),(74,'Necocli',2,1),(75,'Nechi',2,1),(76,'Olaya',2,1),(77,'Peðol',2,1),(78,'Peque',2,1),(79,'Pueblorrico',2,1),(80,'Puerto Berrio',2,1),(81,'Puerto Nare',2,1),(82,'Puerto Triunfo',2,1),(83,'Remedios',2,1),(84,'Retiro',2,1),(85,'Rionegro',2,1),(86,'Sabanalarga',2,1),(87,'Sabaneta',2,1),(88,'Salgar',2,1),(89,'San Andres De Cuerquia',2,1),(90,'San Carlos',2,1),(91,'San Francisco',2,1),(92,'San Jeronimo',2,1),(93,'San Jose De La Montaña',2,1),(94,'San Juan De Uraba',2,1),(95,'San Luis',2,1),(96,'San Pedro',2,1),(97,'San Pedro De Uraba',2,1),(98,'San Rafael',2,1),(99,'San Roque',2,1),(100,'San Vicente',2,1),(101,'Santa Barbara',2,1),(102,'Santa Rosa De Osos',2,1),(103,'Santo Domingo',2,1),(104,'El Santuario',2,1),(105,'Segovia',2,1),(106,'Sonson',2,1),(107,'Sopetran',2,1),(108,'Tamesis',2,1),(109,'Taraza',2,1),(110,'Tarso',2,1),(111,'Titiribi',2,1),(112,'Toledo',2,1),(113,'Turbo',2,1),(114,'Uramita',2,1),(115,'Urrao',2,1),(116,'Valdivia',2,1),(117,'Valparaiso',2,1),(118,'Vegachi',2,1),(119,'Venecia',2,1),(120,'Vigia Del Fuerte',2,1),(121,'Yali',2,1),(122,'Yarumal',2,1),(123,'Yolombo',2,1),(124,'Yondo',2,1),(125,'Zaragoza',2,1),(126,'Barranquilla',3,1),(127,'Baranoa',3,1),(128,'Campo De La Cruz',3,1),(129,'Candelaria',3,1),(130,'Galapa',3,1),(131,'Juan De Acosta',3,1),(132,'Luruaco',3,1),(133,'Malambo',3,1),(134,'Manati',3,1),(135,'Palmar De Varela',3,1),(136,'Piojo',3,1),(137,'Polonuevo',3,1),(138,'Ponedera',3,1),(139,'Puerto Colombia',3,1),(140,'Repelon',3,1),(141,'Sabanagrande',3,1),(142,'Sabanalarga',3,1),(143,'Santa Lucia',3,1),(144,'Santo Tomas',3,1),(145,'Soledad',3,1),(146,'Suan',3,1),(147,'Tubara',3,1),(148,'Usiacuri',3,1),(149,'Bogota, D.C.',4,1),(150,'Cartagena',5,1),(151,'Achi',5,1),(152,'Altos Del Rosario',5,1),(153,'Arenal',5,1),(154,'Arjona',5,1),(155,'Arroyohondo',5,1),(156,'Barranco De Loba',5,1),(157,'Calamar',5,1),(158,'Cantagallo',5,1),(159,'Cicuco',5,1),(160,'Cordoba',5,1),(161,'Clemencia',5,1),(162,'El Carmen De Bolivar',5,1),(163,'El Guamo',5,1),(164,'El Peñon',5,1),(165,'Hatillo De Loba',5,1),(166,'Magangue',5,1),(167,'Mahates',5,1),(168,'Margarita',5,1),(169,'Maria La Baja',5,1),(170,'Montecristo',5,1),(171,'Mompos',5,1),(172,'Norosi',5,1),(173,'Morales',5,1),(174,'Pinillos',5,1),(175,'Regidor',5,1),(176,'Rio Viejo',5,1),(177,'San Cristobal',5,1),(178,'San Estanislao',5,1),(179,'San Fernando',5,1),(180,'San Jacinto',5,1),(181,'San Jacinto Del Cauca',5,1),(182,'San Juan Nepomuceno',5,1),(183,'San Martin De Loba',5,1),(184,'San Pablo',5,1),(185,'Santa Catalina',5,1),(186,'Santa Rosa',5,1),(187,'Santa Rosa Del Sur',5,1),(188,'Simiti',5,1),(189,'Soplaviento',5,1),(190,'Talaigua Nuevo',5,1),(191,'Tiquisio',5,1),(192,'Turbaco',5,1),(193,'Turbana',5,1),(194,'Villanueva',5,1),(195,'Zambrano',5,1),(196,'Tunja',6,1),(197,'Almeida',6,1),(198,'Aquitania',6,1),(199,'Arcabuco',6,1),(200,'Belen',6,1),(201,'Berbeo',6,1),(202,'Beteitiva',6,1),(203,'Boavita',6,1),(204,'Boyaca',6,1),(205,'Briceño',6,1),(206,'Buenavista',6,1),(207,'Busbanza',6,1),(208,'Caldas',6,1),(209,'Campohermoso',6,1),(210,'Cerinza',6,1),(211,'Chinavita',6,1),(212,'Chiquinquira',6,1),(213,'Chiscas',6,1),(214,'Chita',6,1),(215,'Chitaraque',6,1),(216,'Chivata',6,1),(217,'Cienega',6,1),(218,'Combita',6,1),(219,'Coper',6,1),(220,'Corrales',6,1),(221,'Covarachia',6,1),(222,'Cubara',6,1),(223,'Cucaita',6,1),(224,'Cuitiva',6,1),(225,'Chiquiza',6,1),(226,'Chivor',6,1),(227,'Duitama',6,1),(228,'El Cocuy',6,1),(229,'El Espino',6,1),(230,'Firavitoba',6,1),(231,'Floresta',6,1),(232,'Gachantiva',6,1),(233,'Gameza',6,1),(234,'Garagoa',6,1),(235,'Guacamayas',6,1),(236,'Guateque',6,1),(237,'Guayata',6,1),(238,'Gsican',6,1),(239,'Iza',6,1),(240,'Jenesano',6,1),(241,'Jerico',6,1),(242,'Labranzagrande',6,1),(243,'La Capilla',6,1),(244,'La Victoria',6,1),(245,'La Uvita',6,1),(246,'Villa De Leyva',6,1),(247,'Macanal',6,1),(248,'Maripi',6,1),(249,'Miraflores',6,1),(250,'Mongua',6,1),(251,'Mongui',6,1),(252,'Moniquira',6,1),(253,'Motavita',6,1),(254,'Muzo',6,1),(255,'Nobsa',6,1),(256,'Nuevo Colon',6,1),(257,'Oicata',6,1),(258,'Otanche',6,1),(259,'Pachavita',6,1),(260,'Paez',6,1),(261,'Paipa',6,1),(262,'Pajarito',6,1),(263,'Panqueba',6,1),(264,'Pauna',6,1),(265,'Paya',6,1),(266,'Paz De Rio',6,1),(267,'Pesca',6,1),(268,'Pisba',6,1),(269,'Puerto Boyaca',6,1),(270,'Quipama',6,1),(271,'Ramiriqui',6,1),(272,'Raquira',6,1),(273,'Rondon',6,1),(274,'Saboya',6,1),(275,'Sachica',6,1),(276,'Samaca',6,1),(277,'San Eduardo',6,1),(278,'San Jose De Pare',6,1),(279,'San Luis De Gaceno',6,1),(280,'San Mateo',6,1),(281,'San Miguel De Sema',6,1),(282,'San Pablo De Borbur',6,1),(283,'Santana',6,1),(284,'Santa Maria',6,1),(285,'Santa Rosa De Viterbo',6,1),(286,'Santa Sofia',6,1),(287,'Sativanorte',6,1),(288,'Sativasur',6,1),(289,'Siachoque',6,1),(290,'Soata',6,1),(291,'Socota',6,1),(292,'Socha',6,1),(293,'Sogamoso',6,1),(294,'Somondoco',6,1),(295,'Sora',6,1),(296,'Sotaquira',6,1),(297,'Soraca',6,1),(298,'Susacon',6,1),(299,'Sutamarchan',6,1),(300,'Sutatenza',6,1),(301,'Tasco',6,1),(302,'Tenza',6,1),(303,'Tibana',6,1),(304,'Tibasosa',6,1),(305,'Tinjaca',6,1),(306,'Tipacoque',6,1),(307,'Toca',6,1),(308,'Togsi',6,1),(309,'Topaga',6,1),(310,'Tota',6,1),(311,'Tunungua',6,1),(312,'Turmeque',6,1),(313,'Tuta',6,1),(314,'Tutaza',6,1),(315,'Umbita',6,1),(316,'Ventaquemada',6,1),(317,'Viracacha',6,1),(318,'Zetaquira',6,1),(319,'Manizales',7,1),(320,'Aguadas',7,1),(321,'Anserma',7,1),(322,'Aranzazu',7,1),(323,'Belalcazar',7,1),(324,'Chinchina',7,1),(325,'Filadelfia',7,1),(326,'La Dorada',7,1),(327,'La Merced',7,1),(328,'Manzanares',7,1),(329,'Marmato',7,1),(330,'Marquetalia',7,1),(331,'Marulanda',7,1),(332,'Neira',7,1),(333,'Norcasia',7,1),(334,'Pacora',7,1),(335,'Palestina',7,1),(336,'Pensilvania',7,1),(337,'Riosucio',7,1),(338,'Risaralda',7,1),(339,'Salamina',7,1),(340,'Samana',7,1),(341,'San Jose',7,1),(342,'Supia',7,1),(343,'Victoria',7,1),(344,'Villamaria',7,1),(345,'Viterbo',7,1),(346,'Florencia',8,1),(347,'Albania',8,1),(348,'Belen De Los Andaquies',8,1),(349,'Cartagena Del Chaira',8,1),(350,'Curillo',8,1),(351,'El Doncello',8,1),(352,'El Paujil',8,1),(353,'La Montañita',8,1),(354,'Milan',8,1),(355,'Morelia',8,1),(356,'Puerto Rico',8,1),(357,'San Jose Del Fragua',8,1),(358,'San Vicente Del Caguan',8,1),(359,'Solano',8,1),(360,'Solita',8,1),(361,'Valparaiso',8,1),(362,'Popayan',9,1),(363,'Almaguer',9,1),(364,'Argelia',9,1),(365,'Balboa',9,1),(366,'Bolivar',9,1),(367,'Buenos Aires',9,1),(368,'Cajibio',9,1),(369,'Caldono',9,1),(370,'Caloto',9,1),(371,'Corinto',9,1),(372,'El Tambo',9,1),(373,'Florencia',9,1),(374,'Guachene',9,1),(375,'Guapi',9,1),(376,'Inza',9,1),(377,'Jambalo',9,1),(378,'La Sierra',9,1),(379,'La Vega',9,1),(380,'Lopez',9,1),(381,'Mercaderes',9,1),(382,'Miranda',9,1),(383,'Morales',9,1),(384,'Padilla',9,1),(385,'Paez',9,1),(386,'Patia',9,1),(387,'Piamonte',9,1),(388,'Piendamo',9,1),(389,'Puerto Tejada',9,1),(390,'Purace',9,1),(391,'Rosas',9,1),(392,'San Sebastian',9,1),(393,'Santander De Quilichao',9,1),(394,'Santa Rosa',9,1),(395,'Silvia',9,1),(396,'Sotara',9,1),(397,'Suarez',9,1),(398,'Sucre',9,1),(399,'Timbio',9,1),(400,'Timbiqui',9,1),(401,'Toribio',9,1),(402,'Totoro',9,1),(403,'Villa Rica',9,1),(404,'Valledupar',10,1),(405,'Aguachica',10,1),(406,'Agustin Codazzi',10,1),(407,'Astrea',10,1),(408,'Becerril',10,1),(409,'Bosconia',10,1),(410,'Chimichagua',10,1),(411,'Chiriguana',10,1),(412,'Curumani',10,1),(413,'El Copey',10,1),(414,'El Paso',10,1),(415,'Gamarra',10,1),(416,'Gonzalez',10,1),(417,'La Gloria',10,1),(418,'La Jagua De Ibirico',10,1),(419,'Manaure',10,1),(420,'Pailitas',10,1),(421,'Pelaya',10,1),(422,'Pueblo Bello',10,1),(423,'Rio De Oro',10,1),(424,'La Paz',10,1),(425,'San Alberto',10,1),(426,'San Diego',10,1),(427,'San Martin',10,1),(428,'Tamalameque',10,1),(429,'Monteria',11,1),(430,'Ayapel',11,1),(431,'Buenavista',11,1),(432,'Canalete',11,1),(433,'Cerete',11,1),(434,'Chima',11,1),(435,'Chinu',11,1),(436,'Cienaga De Oro',11,1),(437,'Cotorra',11,1),(438,'La Apartada',11,1),(439,'Lorica',11,1),(440,'Los Cordobas',11,1),(441,'Momil',11,1),(442,'Montelibano',11,1),(443,'Moñitos',11,1),(444,'Planeta Rica',11,1),(445,'Pueblo Nuevo',11,1),(446,'Puerto Escondido',11,1),(447,'Puerto Libertador',11,1),(448,'Purisima',11,1),(449,'Sahagun',11,1),(450,'San Andres Sotavento',11,1),(451,'San Antero',11,1),(452,'San Bernardo Del Viento',11,1),(453,'San Carlos',11,1),(454,'San Pelayo',11,1),(455,'Tierralta',11,1),(456,'Valencia',11,1),(457,'Agua De Dios',12,1),(458,'Alban',12,1),(459,'Anapoima',12,1),(460,'Anolaima',12,1),(461,'Arbelaez',12,1),(462,'Beltran',12,1),(463,'Bituima',12,1),(464,'Bojaca',12,1),(465,'Cabrera',12,1),(466,'Cachipay',12,1),(467,'Cajica',12,1),(468,'Caparrapi',12,1),(469,'Caqueza',12,1),(470,'Carmen De Carupa',12,1),(471,'Chaguani',12,1),(472,'Chia',12,1),(473,'Chipaque',12,1),(474,'Choachi',12,1),(475,'Choconta',12,1),(476,'Cogua',12,1),(477,'Cota',12,1),(478,'Cucunuba',12,1),(479,'El Colegio',12,1),(480,'El Peñon',12,1),(481,'El Rosal',12,1),(482,'Facatativa',12,1),(483,'Fomeque',12,1),(484,'Fosca',12,1),(485,'Funza',12,1),(486,'Fuquene',12,1),(487,'Fusagasuga',12,1),(488,'Gachala',12,1),(489,'Gachancipa',12,1),(490,'Gacheta',12,1),(491,'Gama',12,1),(492,'Girardot',12,1),(493,'Granada',12,1),(494,'Guacheta',12,1),(495,'Guaduas',12,1),(496,'Guasca',12,1),(497,'Guataqui',12,1),(498,'Guatavita',12,1),(499,'Guayabal De Siquima',12,1),(500,'Guayabetal',12,1),(501,'Gutierrez',12,1),(502,'Jerusalen',12,1),(503,'Junin',12,1),(504,'La Calera',12,1),(505,'La Mesa',12,1),(506,'La Palma',12,1),(507,'La Peña',12,1),(508,'La Vega',12,1),(509,'Lenguazaque',12,1),(510,'Macheta',12,1),(511,'Madrid',12,1),(512,'Manta',12,1),(513,'Medina',12,1),(514,'Mosquera',12,1),(515,'Nariño',12,1),(516,'Nemocon',12,1),(517,'Nilo',12,1),(518,'Nimaima',12,1),(519,'Nocaima',12,1),(520,'Venecia',12,1),(521,'Pacho',12,1),(522,'Paime',12,1),(523,'Pandi',12,1),(524,'Paratebueno',12,1),(525,'Pasca',12,1),(526,'Puerto Salgar',12,1),(527,'Puli',12,1),(528,'Quebradanegra',12,1),(529,'Quetame',12,1),(530,'Quipile',12,1),(531,'Apulo',12,1),(532,'Ricaurte',12,1),(533,'San Antonio Del Tequendama',12,1),(534,'San Bernardo',12,1),(535,'San Cayetano',12,1),(536,'San Francisco',12,1),(537,'San Juan De Rio Seco',12,1),(538,'Sasaima',12,1),(539,'Sesquile',12,1),(540,'Sibate',12,1),(541,'Silvania',12,1),(542,'Simijaca',12,1),(543,'Soacha',12,1),(544,'Sopo',12,1),(545,'Subachoque',12,1),(546,'Suesca',12,1),(547,'Supata',12,1),(548,'Susa',12,1),(549,'Sutatausa',12,1),(550,'Tabio',12,1),(551,'Tausa',12,1),(552,'Tena',12,1),(553,'Tenjo',12,1),(554,'Tibacuy',12,1),(555,'Tibirita',12,1),(556,'Tocaima',12,1),(557,'Tocancipa',12,1),(558,'Topaipi',12,1),(559,'Ubala',12,1),(560,'Ubaque',12,1),(561,'Villa De San Diego De Ubate',12,1),(562,'Une',12,1),(563,'Utica',12,1),(564,'Vergara',12,1),(565,'Viani',12,1),(566,'Villagomez',12,1),(567,'Villapinzon',12,1),(568,'Villeta',12,1),(569,'Viota',12,1),(570,'Yacopi',12,1),(571,'Zipacon',12,1),(572,'Zipaquira',12,1),(573,'Quibdo',13,1),(574,'Acandi',13,1),(575,'Alto Baudo',13,1),(576,'Atrato',13,1),(577,'Bagado',13,1),(578,'Bahia Solano',13,1),(579,'Bajo Baudo',13,1),(580,'Bojaya',13,1),(581,'El Canton Del San Pablo',13,1),(582,'Carmen Del Darien',13,1),(583,'Certegui',13,1),(584,'Condoto',13,1),(585,'El Carmen De Atrato',13,1),(586,'El Litoral Del San Juan',13,1),(587,'Istmina',13,1),(588,'Jurado',13,1),(589,'Lloro',13,1),(590,'Medio Atrato',13,1),(591,'Medio Baudo',13,1),(592,'Medio San Juan',13,1),(593,'Novita',13,1),(594,'Nuqui',13,1),(595,'Rio Iro',13,1),(596,'Rio Quito',13,1),(597,'Riosucio',13,1),(598,'San Jose Del Palmar',13,1),(599,'Sipi',13,1),(600,'Tado',13,1),(601,'Unguia',13,1),(602,'Union Panamericana',13,1),(603,'Neiva',14,1),(604,'Acevedo',14,1),(605,'Agrado',14,1),(606,'Aipe',14,1),(607,'Algeciras',14,1),(608,'Altamira',14,1),(609,'Baraya',14,1),(610,'Campoalegre',14,1),(611,'Colombia',14,1),(612,'Elias',14,1),(613,'Garzon',14,1),(614,'Gigante',14,1),(615,'Guadalupe',14,1),(616,'Hobo',14,1),(617,'Iquira',14,1),(618,'Isnos',14,1),(619,'La Argentina',14,1),(620,'La Plata',14,1),(621,'Nataga',14,1),(622,'Oporapa',14,1),(623,'Paicol',14,1),(624,'Palermo',14,1),(625,'Palestina',14,1),(626,'Pital',14,1),(627,'Pitalito',14,1),(628,'Rivera',14,1),(629,'Saladoblanco',14,1),(630,'San Agustin',14,1),(631,'Santa Maria',14,1),(632,'Suaza',14,1),(633,'Tarqui',14,1),(634,'Tesalia',14,1),(635,'Tello',14,1),(636,'Teruel',14,1),(637,'Timana',14,1),(638,'Villavieja',14,1),(639,'Yaguara',14,1),(640,'Riohacha',15,1),(641,'Albania',15,1),(642,'Barrancas',15,1),(643,'Dibulla',15,1),(644,'Distraccion',15,1),(645,'El Molino',15,1),(646,'Fonseca',15,1),(647,'Hatonuevo',15,1),(648,'La Jagua Del Pilar',15,1),(649,'Maicao',15,1),(650,'Manaure',15,1),(651,'San Juan Del Cesar',15,1),(652,'Uribia',15,1),(653,'Urumita',15,1),(654,'Villanueva',15,1),(655,'Santa Marta',16,1),(656,'Algarrobo',16,1),(657,'Aracataca',16,1),(658,'Ariguani',16,1),(659,'Cerro San Antonio',16,1),(660,'Chibolo',16,1),(661,'Cienaga',16,1),(662,'Concordia',16,1),(663,'El Banco',16,1),(664,'El Piñon',16,1),(665,'El Reten',16,1),(666,'Fundacion',16,1),(667,'Guamal',16,1),(668,'Nueva Granada',16,1),(669,'Pedraza',16,1),(670,'Pijiño Del Carmen',16,1),(671,'Pivijay',16,1),(672,'Plato',16,1),(673,'Puebloviejo',16,1),(674,'Remolino',16,1),(675,'Sabanas De San Angel',16,1),(676,'Salamina',16,1),(677,'San Sebastian De Buenavista',16,1),(678,'San Zenon',16,1),(679,'Santa Ana',16,1),(680,'Santa Barbara De Pinto',16,1),(681,'Sitionuevo',16,1),(682,'Tenerife',16,1),(683,'Zapayan',16,1),(684,'Zona Bananera',16,1),(685,'Villavicencio',17,1),(686,'Acacias',17,1),(687,'Barranca De Upia',17,1),(688,'Cabuyaro',17,1),(689,'Castilla La Nueva',17,1),(690,'Cubarral',17,1),(691,'Cumaral',17,1),(692,'El Calvario',17,1),(693,'El Castillo',17,1),(694,'El Dorado',17,1),(695,'Fuente De Oro',17,1),(696,'Granada',17,1),(697,'Guamal',17,1),(698,'Mapiripan',17,1),(699,'Mesetas',17,1),(700,'La Macarena',17,1),(701,'Uribe',17,1),(702,'Lejanias',17,1),(703,'Puerto Concordia',17,1),(704,'Puerto Gaitan',17,1),(705,'Puerto Lopez',17,1),(706,'Puerto Lleras',17,1),(707,'Puerto Rico',17,1),(708,'Restrepo',17,1),(709,'San Carlos De Guaroa',17,1),(710,'San Juan De Arama',17,1),(711,'San Juanito',17,1),(712,'San Martin',17,1),(713,'Vistahermosa',17,1),(714,'Pasto',18,1),(715,'Alban',18,1),(716,'Aldana',18,1),(717,'Ancuya',18,1),(718,'Arboleda',18,1),(719,'Barbacoas',18,1),(720,'Belen',18,1),(721,'Buesaco',18,1),(722,'Colon',18,1),(723,'Consaca',18,1),(724,'Contadero',18,1),(725,'Cordoba',18,1),(726,'Cuaspud',18,1),(727,'Cumbal',18,1),(728,'Cumbitara',18,1),(729,'Chachagsi',18,1),(730,'El Charco',18,1),(731,'El Peñol',18,1),(732,'El Rosario',18,1),(733,'El Tablon De Gomez',18,1),(734,'El Tambo',18,1),(735,'Funes',18,1),(736,'Guachucal',18,1),(737,'Guaitarilla',18,1),(738,'Gualmatan',18,1),(739,'Iles',18,1),(740,'Imues',18,1),(741,'Ipiales',18,1),(742,'La Cruz',18,1),(743,'La Florida',18,1),(744,'La Llanada',18,1),(745,'La Tola',18,1),(746,'La Union',18,1),(747,'Leiva',18,1),(748,'Linares',18,1),(749,'Los Andes',18,1),(750,'Magsi',18,1),(751,'Mallama',18,1),(752,'Mosquera',18,1),(753,'Nariño',18,1),(754,'Olaya Herrera',18,1),(755,'Ospina',18,1),(756,'Francisco Pizarro',18,1),(757,'Policarpa',18,1),(758,'Potosi',18,1),(759,'Providencia',18,1),(760,'Puerres',18,1),(761,'Pupiales',18,1),(762,'Ricaurte',18,1),(763,'Roberto Payan',18,1),(764,'Samaniego',18,1),(765,'Sandona',18,1),(766,'San Bernardo',18,1),(767,'San Lorenzo',18,1),(768,'San Pablo',18,1),(769,'San Pedro De Cartago',18,1),(770,'Santa Barbara',18,1),(771,'Santacruz',18,1),(772,'Sapuyes',18,1),(773,'Taminango',18,1),(774,'Tangua',18,1),(775,'San Andres De Tumaco',18,1),(776,'Tuquerres',18,1),(777,'Yacuanquer',18,1),(778,'Cucuta',19,1),(779,'Abrego',19,1),(780,'Arboledas',19,1),(781,'Bochalema',19,1),(782,'Bucarasica',19,1),(783,'Cacota',19,1),(784,'Cachira',19,1),(785,'Chinacota',19,1),(786,'Chitaga',19,1),(787,'Convencion',19,1),(788,'Cucutilla',19,1),(789,'Durania',19,1),(790,'El Carmen',19,1),(791,'El Tarra',19,1),(792,'El Zulia',19,1),(793,'Gramalote',19,1),(794,'Hacari',19,1),(795,'Herran',19,1),(796,'Labateca',19,1),(797,'La Esperanza',19,1),(798,'La Playa',19,1),(799,'Los Patios',19,1),(800,'Lourdes',19,1),(801,'Mutiscua',19,1),(802,'Ocaña',19,1),(803,'Pamplona',19,1),(804,'Pamplonita',19,1),(805,'Puerto Santander',19,1),(806,'Ragonvalia',19,1),(807,'Salazar',19,1),(808,'San Calixto',19,1),(809,'San Cayetano',19,1),(810,'Santiago',19,1),(811,'Sardinata',19,1),(812,'Silos',19,1),(813,'Teorama',19,1),(814,'Tibu',19,1),(815,'Toledo',19,1),(816,'Villa Caro',19,1),(817,'Villa Del Rosario',19,1),(818,'Armenia',20,1),(819,'Buenavista',20,1),(820,'Calarca',20,1),(821,'Circasia',20,1),(822,'Cordoba',20,1),(823,'Filandia',20,1),(824,'Genova',20,1),(825,'La Tebaida',20,1),(826,'Montenegro',20,1),(827,'Pijao',20,1),(828,'Quimbaya',20,1),(829,'Salento',20,1),(830,'Pereira',21,1),(831,'Apia',21,1),(832,'Balboa',21,1),(833,'Belen De Umbria',21,1),(834,'Dosquebradas',21,1),(835,'Guatica',21,1),(836,'La Celia',21,1),(837,'La Virginia',21,1),(838,'Marsella',21,1),(839,'Mistrato',21,1),(840,'Pueblo Rico',21,1),(841,'Quinchia',21,1),(842,'Santa Rosa De Cabal',21,1),(843,'Santuario',21,1),(844,'Bucaramanga',22,1),(845,'Aguada',22,1),(846,'Albania',22,1),(847,'Aratoca',22,1),(848,'Barbosa',22,1),(849,'Barichara',22,1),(850,'Barrancabermeja',22,1),(851,'Betulia',22,1),(852,'Bolivar',22,1),(853,'Cabrera',22,1),(854,'California',22,1),(855,'Capitanejo',22,1),(856,'Carcasi',22,1),(857,'Cepita',22,1),(858,'Cerrito',22,1),(859,'Charala',22,1),(860,'Charta',22,1),(861,'Chima',22,1),(862,'Chipata',22,1),(863,'Cimitarra',22,1),(864,'Concepcion',22,1),(865,'Confines',22,1),(866,'Contratacion',22,1),(867,'Coromoro',22,1),(868,'Curiti',22,1),(869,'El Carmen De Chucuri',22,1),(870,'El Guacamayo',22,1),(871,'El Peñon',22,1),(872,'El Playon',22,1),(873,'Encino',22,1),(874,'Enciso',22,1),(875,'Florian',22,1),(876,'Floridablanca',22,1),(877,'Galan',22,1),(878,'Gambita',22,1),(879,'Giron',22,1),(880,'Guaca',22,1),(881,'Guadalupe',22,1),(882,'Guapota',22,1),(883,'Guavata',22,1),(884,'Gsepsa',22,1),(885,'Hato',22,1),(886,'Jesus Maria',22,1),(887,'Jordan',22,1),(888,'La Belleza',22,1),(889,'Landazuri',22,1),(890,'La Paz',22,1),(891,'Lebrija',22,1),(892,'Los Santos',22,1),(893,'Macaravita',22,1),(894,'Malaga',22,1),(895,'Matanza',22,1),(896,'Mogotes',22,1),(897,'Molagavita',22,1),(898,'Ocamonte',22,1),(899,'Oiba',22,1),(900,'Onzaga',22,1),(901,'Palmar',22,1),(902,'Palmas Del Socorro',22,1),(903,'Paramo',22,1),(904,'Piedecuesta',22,1),(905,'Pinchote',22,1),(906,'Puente Nacional',22,1),(907,'Puerto Parra',22,1),(908,'Puerto Wilches',22,1),(909,'Rionegro',22,1),(910,'Sabana De Torres',22,1),(911,'San Andres',22,1),(912,'San Benito',22,1),(913,'San Gil',22,1),(914,'San Joaquin',22,1),(915,'San Jose De Miranda',22,1),(916,'San Miguel',22,1),(917,'San Vicente De Chucuri',22,1),(918,'Santa Barbara',22,1),(919,'Santa Helena Del Opon',22,1),(920,'Simacota',22,1),(921,'Socorro',22,1),(922,'Suaita',22,1),(923,'Sucre',22,1),(924,'Surata',22,1),(925,'Tona',22,1),(926,'Valle De San Jose',22,1),(927,'Velez',22,1),(928,'Vetas',22,1),(929,'Villanueva',22,1),(930,'Zapatoca',22,1),(931,'Sincelejo',23,1),(932,'Buenavista',23,1),(933,'Caimito',23,1),(934,'Coloso',23,1),(935,'Corozal',23,1),(936,'Coveñas',23,1),(937,'Chalan',23,1),(938,'El Roble',23,1),(939,'Galeras',23,1),(940,'Guaranda',23,1),(941,'La Union',23,1),(942,'Los Palmitos',23,1),(943,'Majagual',23,1),(944,'Morroa',23,1),(945,'Ovejas',23,1),(946,'Palmito',23,1),(947,'Sampues',23,1),(948,'San Benito Abad',23,1),(949,'San Juan De Betulia',23,1),(950,'San Marcos',23,1),(951,'San Onofre',23,1),(952,'San Pedro',23,1),(953,'San Luis De Since',23,1),(954,'Sucre',23,1),(955,'Santiago De Tolu',23,1),(956,'Tolu Viejo',23,1),(957,'Ibague',24,1),(958,'Alpujarra',24,1),(959,'Alvarado',24,1),(960,'Ambalema',24,1),(961,'Anzoategui',24,1),(962,'Armero',24,1),(963,'Ataco',24,1),(964,'Cajamarca',24,1),(965,'Carmen De Apicala',24,1),(966,'Casabianca',24,1),(967,'Chaparral',24,1),(968,'Coello',24,1),(969,'Coyaima',24,1),(970,'Cunday',24,1),(971,'Dolores',24,1),(972,'Espinal',24,1),(973,'Falan',24,1),(974,'Flandes',24,1),(975,'Fresno',24,1),(976,'Guamo',24,1),(977,'Herveo',24,1),(978,'Honda',24,1),(979,'Icononzo',24,1),(980,'Lerida',24,1),(981,'Libano',24,1),(982,'Mariquita',24,1),(983,'Melgar',24,1),(984,'Murillo',24,1),(985,'Natagaima',24,1),(986,'Ortega',24,1),(987,'Palocabildo',24,1),(988,'Piedras',24,1),(989,'Planadas',24,1),(990,'Prado',24,1),(991,'Purificacion',24,1),(992,'Rioblanco',24,1),(993,'Roncesvalles',24,1),(994,'Rovira',24,1),(995,'Saldaña',24,1),(996,'San Antonio',24,1),(997,'San Luis',24,1),(998,'Santa Isabel',24,1),(999,'Suarez',24,1),(1000,'Valle De San Juan',24,1),(1001,'Venadillo',24,1),(1002,'Villahermosa',24,1),(1003,'Villarrica',24,1),(1004,'Cali',25,1),(1005,'Alcala',25,1),(1006,'Andalucia',25,1),(1007,'Ansermanuevo',25,1),(1008,'Argelia',25,1),(1009,'Bolivar',25,1),(1010,'Buenaventura',25,1),(1011,'Guadalajara De Buga',25,1),(1012,'Bugalagrande',25,1),(1013,'Caicedonia',25,1),(1014,'Calima',25,1),(1015,'Candelaria',25,1),(1016,'Cartago',25,1),(1017,'Dagua',25,1),(1018,'El Aguila',25,1),(1019,'El Cairo',25,1),(1020,'El Cerrito',25,1),(1021,'El Dovio',25,1),(1022,'Florida',25,1),(1023,'Ginebra',25,1),(1024,'Guacari',25,1),(1025,'Jamundi',25,1),(1026,'La Cumbre',25,1),(1027,'La Union',25,1),(1028,'La Victoria',25,1),(1029,'Obando',25,1),(1030,'Palmira',25,1),(1031,'Pradera',25,1),(1032,'Restrepo',25,1),(1033,'Riofrio',25,1),(1034,'Roldanillo',25,1),(1035,'San Pedro',25,1),(1036,'Sevilla',25,1),(1037,'Toro',25,1),(1038,'Trujillo',25,1),(1039,'Tulua',25,1),(1040,'Ulloa',25,1),(1041,'Versalles',25,1),(1042,'Vijes',25,1),(1043,'Yotoco',25,1),(1044,'Yumbo',25,1),(1045,'Zarzal',25,1),(1046,'Arauca',26,1),(1047,'Arauquita',26,1),(1048,'Cravo Norte',26,1),(1049,'Fortul',26,1),(1050,'Puerto Rondon',26,1),(1051,'Saravena',26,1),(1052,'Tame',26,1),(1053,'Yopal',27,1),(1054,'Aguazul',27,1),(1055,'Chameza',27,1),(1056,'Hato Corozal',27,1),(1057,'La Salina',27,1),(1058,'Mani',27,1),(1059,'Monterrey',27,1),(1060,'Nunchia',27,1),(1061,'Orocue',27,1),(1062,'Paz De Ariporo',27,1),(1063,'Pore',27,1),(1064,'Recetor',27,1),(1065,'Sabanalarga',27,1),(1066,'Sacama',27,1),(1067,'San Luis De Palenque',27,1),(1068,'Tamara',27,1),(1069,'Tauramena',27,1),(1070,'Trinidad',27,1),(1071,'Villanueva',27,1),(1072,'Mocoa',28,1),(1073,'Colon',28,1),(1074,'Orito',28,1),(1075,'Puerto Asis',28,1),(1076,'Puerto Caicedo',28,1),(1077,'Puerto Guzman',28,1),(1078,'Leguizamo',28,1),(1079,'Sibundoy',28,1),(1080,'San Francisco',28,1),(1081,'San Miguel',28,1),(1082,'Santiago',28,1),(1083,'Valle Del Guamuez',28,1),(1084,'Villagarzon',28,1),(1085,'San Andres',29,1),(1086,'Providencia',29,1),(1087,'Leticia',30,1),(1088,'El Encanto',30,1),(1089,'La Chorrera',30,1),(1090,'La Pedrera',30,1),(1091,'La Victoria',30,1),(1092,'Miriti - Parana',30,1),(1093,'Puerto Alegria',30,1),(1094,'Puerto Arica',30,1),(1095,'Puerto Nariño',30,1),(1096,'Puerto Santander',30,1),(1097,'Tarapaca',30,1),(1098,'Inirida',31,1),(1099,'Barranco Minas',31,1),(1100,'Mapiripana',31,1),(1101,'San Felipe',31,1),(1102,'Puerto Colombia',31,1),(1103,'La Guadalupe',31,1),(1104,'Cacahual',31,1),(1105,'Pana Pana',31,1),(1106,'Morichal',31,1),(1107,'San Jose Del Guaviare',32,1),(1108,'Calamar',32,1),(1109,'El Retorno',32,1),(1110,'Miraflores',32,1),(1111,'Mitu',33,1),(1112,'Caruru',33,1),(1113,'Pacoa',33,1),(1114,'Taraira',33,1),(1115,'Papunaua',33,1),(1116,'Yavarate',33,1),(1117,'Puerto Carreño',34,1),(1118,'La Primavera',34,1),(1119,'Santa Rosalia',34,1),(1120,'Cumaribo',34,1);
/*!40000 ALTER TABLE `ciudades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `controller`
--

DROP TABLE IF EXISTS `controller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `controller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controller`
--

LOCK TABLES `controller` WRITE;
/*!40000 ALTER TABLE `controller` DISABLE KEYS */;
INSERT INTO `controller` VALUES (1,'administracion',1),(2,'auth',1),(3,'consultas',1),(4,'equipos',1),(5,'menu',1),(6,'procedimientos',1),(7,'proveedores',1);
/*!40000 ALTER TABLE `controller` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(150) DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES (2,'Antioquia',1),(3,'Atlantico',1),(4,'Bogota',1),(5,'Bolivar',1),(6,'Boyaca',1),(7,'Caldas',1),(8,'Caqueta',1),(9,'Cauca',1),(10,'Cesar',1),(11,'Cordoba',1),(12,'Cundinamarca',1),(13,'Choco',1),(14,'Huila',1),(15,'La Guajira',1),(16,'Magdalena',1),(17,'Meta',1),(18,'Nariño',1),(19,'Norte De Santander',1),(20,'Quindio',1),(21,'Risaralda',1),(22,'Santander',1),(23,'Sucre',1),(24,'Tolima',1),(25,'Valle Del Cauca',1),(26,'Arauca',1),(27,'Casanare',1),(28,'Putumayo',1),(29,'San Andres',1),(30,'Amazonas',1),(31,'Guainia',1),(32,'Guaviare',1),(33,'Vaupes',1),(34,'Vichada',1);
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipos`
--

DROP TABLE IF EXISTS `equipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `marcas_id` int(11) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `ubicacion_id` int(11) DEFAULT NULL,
  `no_serie` varchar(100) DEFAULT NULL,
  `fecha_compra` date DEFAULT NULL,
  `placa_inventario` varchar(100) DEFAULT NULL,
  `periodicidad_mantenimiento` int(11) DEFAULT NULL,
  `voltaje` varchar(100) DEFAULT NULL,
  `corriente` varchar(100) DEFAULT NULL,
  `frecuencia` varchar(100) DEFAULT NULL,
  `peso` varchar(100) DEFAULT NULL,
  `largo` varchar(100) DEFAULT NULL,
  `ancho` varchar(100) DEFAULT NULL,
  `alto` varchar(100) DEFAULT NULL,
  `rangos_id` varchar(100) DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `ubicacion_foto` varchar(255) DEFAULT NULL,
  `fecha_fin_garantia` date DEFAULT NULL,
  `id_tipos_equipos` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  `id_manuales` int(11) DEFAULT '0',
  `ubicacion_guia` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `marcas_fk_idx` (`marcas_id`),
  KEY `ubicacion_fk_idx` (`ubicacion_id`),
  KEY `rangos_fk_idx` (`rangos_id`),
  KEY `tipos_equipos_fk_idx` (`id_tipos_equipos`),
  KEY `proveedor_fk_idx` (`id_proveedor`),
  KEY `estados_fk_idx` (`estado`),
  CONSTRAINT `estados_fk_equip` FOREIGN KEY (`estado`) REFERENCES `estados_equipos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `marcas_fk` FOREIGN KEY (`marcas_id`) REFERENCES `marcas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `proveedor_fk` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tipos_equipos_fk` FOREIGN KEY (`id_tipos_equipos`) REFERENCES `tipos_equipos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ubicacion_fk` FOREIGN KEY (`ubicacion_id`) REFERENCES `ubicacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipos`
--

LOCK TABLES `equipos` WRITE;
/*!40000 ALTER TABLE `equipos` DISABLE KEYS */;
INSERT INTO `equipos` VALUES (2,'Bascula 1',1,'X45',2,'102030','2018-01-07','X4584',12,'110','110','0','50','10','20','40','2','obs','adj_equipos/X4584/X4584_imagen.jpg','2017-11-08',1,2,1,1,'adj_equipos/X4584/X4584_guia.pdf'),(3,'Báscula tallímetro',1,'339',2,'E23708011','2018-01-08','5056590',6,'0','0','0','20','30','40','50','1','Consultorio 2','adj_equipos/5056590/5056590_imagen.JPG',NULL,1,1,1,0,NULL),(7,'Báscula tallímetro',1,'339',3,'E32606-0145','2017-11-08','5027373',6,'0','0','0','40','30','20','30','1','Observacion','adj_equipos/5027373/5027373_imagen.jpg',NULL,1,1,1,0,NULL),(8,'Tensiómetro de reloj',18,'NA',2,'9508101127','2017-11-07','980209',6,'110','110','0','20','30','30','30','1','consultorio 2\r\n',NULL,NULL,13,1,1,0,NULL),(9,'Desfribilidador',13,'X41',2,'102050','2017-11-10','x4182',5,'110','110','10','40','50','30','20','1','Nuevo equipo',NULL,'2017-11-10',2,1,1,0,NULL),(10,'Bascula',1,'x4454',2,'4adasd45','2017-11-07','X458',2,'0 asdsad','0 asdsads','0 asdas','41 cm ','100 cm','10 cm','100 metros','2ad asd dsa','bla bla bala asdajsklfja jkadjfla jsfijas fauisfl jasfj añsjasj fklasnf jaskfjsakjf jask','adj_equipos/X458/X458_imagen.jpg','2018-02-19',1,4,2,0,NULL),(11,'Bascula',1,'2018',2,'144515-6','2018-01-15','11445515',2,'30','40','50','10','15','20','30','1','Este equipo es nuevo','adj_equipos/11445515/11445515_imagen.jpg','2018-01-15',1,1,1,0,'adj_equipos/11445515/11445515_guia.pdf'),(12,'Oximetro',18,'4445-6',2,'4545-5','2018-01-15','1111',12,'0','0','0','40','50','50','50','1','Este equipo es nuevo','adj_equipos/1111/1111_imagen.JPG',NULL,11,1,1,0,'adj_equipos/1111/1111_guia.pdf');
/*!40000 ALTER TABLE `equipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_procedimientos`
--

DROP TABLE IF EXISTS `estado_procedimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_procedimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_procedimientos`
--

LOCK TABLES `estado_procedimientos` WRITE;
/*!40000 ALTER TABLE `estado_procedimientos` DISABLE KEYS */;
INSERT INTO `estado_procedimientos` VALUES (1,'Pendiente'),(2,'Legalización'),(3,'Terminado');
/*!40000 ALTER TABLE `estado_procedimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados_equipos`
--

DROP TABLE IF EXISTS `estados_equipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados_equipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados_equipos`
--

LOCK TABLES `estados_equipos` WRITE;
/*!40000 ALTER TABLE `estados_equipos` DISABLE KEYS */;
INSERT INTO `estados_equipos` VALUES (1,'Activo',1),(2,'Inactivo',1);
/*!40000 ALTER TABLE `estados_equipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_controller`
--

DROP TABLE IF EXISTS `group_controller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_controller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned DEFAULT NULL,
  `controller_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_fk_idx` (`group_id`),
  KEY `controller_fk_idx` (`controller_id`),
  CONSTRAINT `controller_fk` FOREIGN KEY (`controller_id`) REFERENCES `controller` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `group_fk` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_controller`
--

LOCK TABLES `group_controller` WRITE;
/*!40000 ALTER TABLE `group_controller` DISABLE KEYS */;
INSERT INTO `group_controller` VALUES (3,2,3),(4,2,6),(5,2,4);
/*!40000 ALTER TABLE `group_controller` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_menu`
--

DROP TABLE IF EXISTS `group_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_fk_idx` (`menu_id`),
  KEY `groups_fk_idx` (`group_id`),
  CONSTRAINT `groups_fk` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `menu_fk` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_menu`
--

LOCK TABLES `group_menu` WRITE;
/*!40000 ALTER TABLE `group_menu` DISABLE KEYS */;
INSERT INTO `group_menu` VALUES (3,2,6),(4,2,7),(5,2,5),(6,2,9);
/*!40000 ALTER TABLE `group_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'admin','Administrator'),(2,'general','General User');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
INSERT INTO `login_attempts` VALUES (1,'::1','1044503052',1519073364);
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marcas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES (1,'DETECTO',1),(2,'BBG',1),(3,'SPORTFITNES',1),(4,'KALLEY',1),(5,'TANITA',1),(6,'SCHILLER',1),(7,'PROMEL',1),(8,'EDAN',1),(9,'MEDIANA',1),(10,'WELLCH ALLYN',1),(11,'LITTMANN',1),(12,'NIPRO DIAGNOSTIC',1),(13,'ACCU-CHEK',1),(14,'LEVITON',1),(15,'DEBILVISS',1),(16,'MEDQUIP',1),(17,'WESTERM MÉDICA',1),(18,'TYCOS',1),(19,'ACCUMED',1),(20,'FORECAST',1),(21,'SAMSUNG',1);
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(20) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `icono` varchar(50) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_menu_fk_idx` (`categoria_id`),
  CONSTRAINT `categoria_menu_fk` FOREIGN KEY (`categoria_id`) REFERENCES `categoria_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Ingreso',1,'equipos','pencil',1),(2,'Selectores',1,'administracion/selectores','pencil',6),(3,'Sedes',1,'administracion/sedes','pencil',6),(4,'Gestion',1,'procedimientos','gavel',3),(5,'Crear',1,'procedimientos/crear_procedimientos','pencil',3),(6,'Consulta',1,'equipos/consulta_equipos','search',1),(7,'Consulta',1,'procedimientos/consulta_procedimientos','search',3),(8,'Gestion',1,'proveedores','pencil',4),(9,'Descargas',1,'consultas','download',5),(10,'Editar fechas',1,'procedimientos/editar_fechas','pencil',3),(11,'Protocolos',1,'administracion/protocolos','pencil',6),(12,'Calibracion',1,'procedimientos/calibraciones','pencil',3),(13,'Asociar guias',1,'equipos/guias','pencil',1),(14,'Legalización',1,'procedimientos/legalizacion','file',3),(15,'Listar usuarios',1,'auth','user',6),(16,'Crear usuarios',1,'auth/create_user','user',6),(17,'Crear grupo',1,'auth/create_group','group',6),(18,'Gestion roles',1,'auth/gestion_roles_permisos','group',6);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procedimientos`
--

DROP TABLE IF EXISTS `procedimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `procedimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipos_procedimientos_id` int(11) DEFAULT NULL,
  `fecha_programada` date DEFAULT NULL,
  `fecha_ejecucion` date DEFAULT NULL,
  `users_id_sol` int(11) unsigned DEFAULT NULL,
  `users_id_ejec` int(11) unsigned DEFAULT NULL,
  `tipo_servicios_id` int(11) DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `id_equipo` int(11) DEFAULT NULL,
  `observacion_cierre` varchar(255) DEFAULT NULL,
  `ruta_documento` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_procedimientos_fk_idx` (`tipos_procedimientos_id`),
  KEY `users_sol_fk_idx` (`users_id_sol`,`users_id_ejec`),
  KEY `users_ejec_fk_idx` (`users_id_ejec`),
  KEY `equipo_id_fk_idx` (`id_equipo`),
  KEY `estado_fk_idx` (`estado`),
  KEY `tipo_servicio_fk_idx` (`tipo_servicios_id`),
  CONSTRAINT `equipo_id_fk` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `estado_fk` FOREIGN KEY (`estado`) REFERENCES `estado_procedimientos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tipo_procedimientos_fk` FOREIGN KEY (`tipos_procedimientos_id`) REFERENCES `tipos_procedimientos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tipo_servicio_fk` FOREIGN KEY (`tipo_servicios_id`) REFERENCES `tipo_servicios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `users_ejec_fk` FOREIGN KEY (`users_id_ejec`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `users_sol_fk` FOREIGN KEY (`users_id_sol`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procedimientos`
--

LOCK TABLES `procedimientos` WRITE;
/*!40000 ALTER TABLE `procedimientos` DISABLE KEYS */;
INSERT INTO `procedimientos` VALUES (1,1,'2017-11-25','2017-11-09',2,2,1,'Obs1',3,2,'OBservacion Cierre','adj_procedimientos/1/1_legalizacion.docx'),(2,2,'2017-11-30','2017-11-09',2,2,1,'Obs2',3,2,'Observacion','adj_procedimientos/2/2_legalizacion.pdf'),(6,1,'2018-05-08',NULL,2,NULL,1,'Primer procedimiento programado.',1,7,NULL,NULL),(7,1,'2017-11-23',NULL,2,NULL,1,'El equipo no calibra bien',1,NULL,NULL,NULL),(8,2,'2017-11-23',NULL,2,NULL,1,'Error con la bascula',1,2,NULL,NULL),(9,2,'2017-11-23',NULL,2,NULL,1,'Calibrar',1,2,NULL,NULL),(10,2,'2018-07-03',NULL,2,NULL,2,'Oser',1,2,NULL,NULL),(11,1,'2018-05-10',NULL,2,NULL,1,'Primer procedimiento programado.',1,8,NULL,NULL),(12,2,'2017-11-15','2017-11-10',2,2,2,'El equipo no funciona correctamente',3,2,'Se calibra y queda funcionando correctamente','adj_procedimientos/12/12_legalizacion.pdf'),(13,1,'2018-04-10','2017-11-28',2,2,1,'Primer procedimiento programado.',2,9,'Todo bien',NULL),(14,2,'2017-12-03','2017-11-28',2,2,2,'El equipo no funciona',3,2,'Equipo se repara y se deja conforme al solicitante','adj_procedimientos/14/14_legalizacion.docx'),(15,1,'2018-02-03','2017-12-03',2,2,1,'Primer procedimiento programado.',3,10,'observacion','adj_procedimientos/15/15_legalizacion.pdf'),(16,1,'2018-02-03','2018-01-08',2,2,1,'Procedimiento programado automatico.',3,10,'obs 1','adj_procedimientos/16/16_legalizacion.pdf'),(17,3,'2017-12-03','2017-12-03',2,NULL,NULL,NULL,2,NULL,NULL,''),(18,3,'2017-12-03','2017-12-03',2,NULL,NULL,NULL,2,NULL,NULL,''),(19,3,'2017-12-03','2017-12-03',2,NULL,NULL,NULL,2,NULL,NULL,''),(20,3,'2017-12-03','2017-12-03',2,NULL,NULL,NULL,2,NULL,NULL,''),(21,3,'2017-12-03','2017-12-03',2,NULL,NULL,NULL,2,NULL,NULL,''),(22,3,'2017-12-03','2017-12-03',2,NULL,NULL,NULL,2,NULL,NULL,''),(23,3,'2017-12-03','2017-12-03',2,NULL,NULL,NULL,2,NULL,NULL,''),(24,3,'2017-12-03','2017-12-03',2,NULL,1,'addas',2,NULL,NULL,''),(25,3,'2017-12-03','2017-12-03',2,NULL,1,'addas',2,NULL,NULL,NULL),(26,3,'2017-12-03','2017-12-03',2,NULL,1,'adsadsdas',2,NULL,NULL,NULL),(27,3,'2017-12-03','2017-12-03',2,NULL,1,'adsdsa',2,NULL,NULL,NULL),(28,3,'2017-12-03','2017-12-03',2,NULL,1,'asdasd',2,NULL,NULL,'adj_procedimientos/28/28_formato_legalizacion.docx'),(29,1,'2018-03-08','2018-01-08',2,2,1,'Procedimiento programado automatico.',2,10,'obs1',NULL),(30,1,'2018-03-08','2018-01-08',2,2,1,'Procedimiento programado automatico.',2,10,'obs1 2',NULL),(31,1,'2018-03-08','2018-01-08',2,2,1,'Procedimiento programado automatico.',3,10,'obs1','adj_procedimientos/31/31_legalizacion.pdf'),(32,1,'2018-03-08','2018-01-08',2,2,1,'Procedimiento programado automatico.',2,10,'asdadssad',NULL),(33,1,'2018-03-08',NULL,2,NULL,1,'Procedimiento programado automatico.',1,10,NULL,NULL),(34,1,'2018-03-15','2018-01-15',2,2,1,'Primer procedimiento programado.',2,11,'Se entrega el equipo en perfecto funcionamiento',NULL),(35,1,'2018-07-19',NULL,2,NULL,1,'Procedimiento programado automatico.',1,11,NULL,NULL),(36,3,'2018-01-15','2018-01-15',2,NULL,1,'La calibracion semestral',3,NULL,NULL,NULL),(37,3,'2018-01-15','2018-01-15',2,NULL,1,'obs',3,NULL,NULL,NULL),(38,3,'2018-01-15','2018-01-15',2,NULL,1,'preventivo',3,NULL,NULL,NULL),(39,1,'2018-03-15','2018-01-15',2,2,1,'Primer procedimiento programado.',3,12,'se entrega funcional','adj_procedimientos/39/39_legalizacion.pdf'),(40,1,'2019-01-15',NULL,2,NULL,1,'Procedimiento programado automatico.',1,12,NULL,NULL),(41,3,'2018-01-15','2018-01-15',2,NULL,1,'Calibracion semestral',3,NULL,NULL,NULL),(42,2,'2018-01-20','2018-01-15',2,2,2,'La bascula esta rota',2,10,'Procedimiento',NULL),(43,2,'2018-03-06',NULL,2,NULL,1,'asdasd',1,10,NULL,NULL);
/*!40000 ALTER TABLE `procedimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `documento` int(11) DEFAULT NULL,
  `nombre_cliente` varchar(255) DEFAULT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `celular` varchar(10) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `tipo_documento` int(11) DEFAULT NULL,
  `digito_verificacion` int(11) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ciudad_id_idx` (`ciudad_id`),
  KEY `fk_tipo_documentos_idx` (`tipo_documento`),
  CONSTRAINT `fk_ciudad_id` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipo_documentos` FOREIGN KEY (`tipo_documento`) REFERENCES `tipos_documentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,911111111,'prueba',18,'3280035','3043280035','cagr2145@gmail.com',1,0,'clle 84 # 71 A 29 888'),(2,922222222,'Prueba2',1,'3280034','3043280034','cagr215@gmail.com',1,6,'clle 84 # 71 A 29'),(3,933333333,'Prueba3',701,'3280034','3043280034','cagr215@gmail.com',1,1,'clle 84 # 71 A 29'),(4,955555555,'Proveeedor 1',1,'3280034','3043280034','cagr215@gmail.com',1,1,'Direccion');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repuestos_procedimientos`
--

DROP TABLE IF EXISTS `repuestos_procedimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repuestos_procedimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `procedimiento_id` int(11) NOT NULL,
  `descripcion_repuesto` varchar(255) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `repuestos_fk_idx` (`descripcion_repuesto`),
  KEY `procedimientos_fk_idx` (`procedimiento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repuestos_procedimientos`
--

LOCK TABLES `repuestos_procedimientos` WRITE;
/*!40000 ALTER TABLE `repuestos_procedimientos` DISABLE KEYS */;
INSERT INTO `repuestos_procedimientos` VALUES (3,16,'repuesto',10),(4,29,'repuesto1',10),(5,30,'repuesto',10),(6,30,'repuesto2',12),(7,34,'rueda 2',3),(8,39,'rueda',10),(9,42,'Rueda',4);
/*!40000 ALTER TABLE `repuestos_procedimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultados`
--

DROP TABLE IF EXISTS `resultados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultados`
--

LOCK TABLES `resultados` WRITE;
/*!40000 ALTER TABLE `resultados` DISABLE KEYS */;
INSERT INTO `resultados` VALUES (1,'C',1),(2,'NC',1),(3,'NA',1);
/*!40000 ALTER TABLE `resultados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sedes`
--

DROP TABLE IF EXISTS `sedes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sedes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sedes`
--

LOCK TABLES `sedes` WRITE;
/*!40000 ALTER TABLE `sedes` DISABLE KEYS */;
INSERT INTO `sedes` VALUES (1,'Robledo',1),(2,'Fraternidad',1);
/*!40000 ALTER TABLE `sedes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tablas`
--

DROP TABLE IF EXISTS `tablas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tablas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tablas`
--

LOCK TABLES `tablas` WRITE;
/*!40000 ALTER TABLE `tablas` DISABLE KEYS */;
INSERT INTO `tablas` VALUES (1,'tipos_procedimientos'),(2,'tipo_servicios'),(3,'tipos_documentos_procedimiento'),(4,'sedes'),(5,'resultados'),(6,'marcas'),(7,'accesorios');
/*!40000 ALTER TABLE `tablas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_servicios`
--

DROP TABLE IF EXISTS `tipo_servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `ans` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_servicios`
--

LOCK TABLES `tipo_servicios` WRITE;
/*!40000 ALTER TABLE `tipo_servicios` DISABLE KEYS */;
INSERT INTO `tipo_servicios` VALUES (1,'Preventivo',15,1),(2,'Correctivo',5,1);
/*!40000 ALTER TABLE `tipo_servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_documentos`
--

DROP TABLE IF EXISTS `tipos_documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_documentos`
--

LOCK TABLES `tipos_documentos` WRITE;
/*!40000 ALTER TABLE `tipos_documentos` DISABLE KEYS */;
INSERT INTO `tipos_documentos` VALUES (1,'NIT',1),(2,'Cédula de ciudadanía',1),(3,'Cédula verificada',1);
/*!40000 ALTER TABLE `tipos_documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_equipos`
--

DROP TABLE IF EXISTS `tipos_equipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_equipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(150) DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_equipos`
--

LOCK TABLES `tipos_equipos` WRITE;
/*!40000 ALTER TABLE `tipos_equipos` DISABLE KEYS */;
INSERT INTO `tipos_equipos` VALUES (1,'Bascula',1),(2,'Desfribilador',1),(3,'Camilla',1),(4,'Ecotone',1),(5,'Equipo de organos',1),(6,'Fonendoscopio',1),(7,'Glucometro',1),(8,'Lampara',1),(9,'Laringoscopio',1),(10,'Nebulizador',1),(11,'Oximetro',1),(12,'Regulador de oxigeno',1),(13,'Tensiometro',1),(14,'Termohigrometro',1);
/*!40000 ALTER TABLE `tipos_equipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_procedimientos`
--

DROP TABLE IF EXISTS `tipos_procedimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_procedimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_procedimientos`
--

LOCK TABLES `tipos_procedimientos` WRITE;
/*!40000 ALTER TABLE `tipos_procedimientos` DISABLE KEYS */;
INSERT INTO `tipos_procedimientos` VALUES (1,'Programados',1),(2,'Solicitados',1),(3,'Calibracion',1);
/*!40000 ALTER TABLE `tipos_procedimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ubicacion`
--

DROP TABLE IF EXISTS `ubicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ubicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sedes_id` int(11) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sedes_fk_idx` (`sedes_id`),
  CONSTRAINT `sedes_fk` FOREIGN KEY (`sedes_id`) REFERENCES `sedes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ubicacion`
--

LOCK TABLES `ubicacion` WRITE;
/*!40000 ALTER TABLE `ubicacion` DISABLE KEYS */;
INSERT INTO `ubicacion` VALUES (1,1,'Salon 1',0),(2,1,'Salon1',1),(3,1,'Salon 2',0),(4,2,'Salon3',1),(5,2,'Salon4',1),(6,1,'Salon H204',0);
/*!40000 ALTER TABLE `ubicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `ultimo_cambio_clave` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'127.0.0.1','administrator','$2y$08$E/VzISQe69/EpDDBv.fjBuJXtErPZC7RSEp.QJAVjsKnQakgQxFW2','','admin@admin.com','',NULL,NULL,NULL,1268889823,1268889823,1,'Admin','istrator','ADMIN','0','0000-00-00 00:00:00'),(2,'127.0.0.1','cgrandar','$2y$08$UOgv4kEynzIHAsbCdNhePOX.ltZQvT2I9OJ700ggjTZZs3HYDQPWG',NULL,'cagr215@gmail.com','',NULL,NULL,NULL,1268889823,1519073538,1,'Carlos Andres','Granda Rojas','ADMIN','3043280034','2018-01-21 22:24:47'),(3,'::1','coco','$2y$08$oevBDIBL8oGY9H6Zo1kFK.LK5ocTFwD9kc6rmm4qneUAilApNnDHi',NULL,'cagr215@hotmail.com',NULL,NULL,NULL,NULL,1516582184,1516588191,1,'Carlos Andres','Rojas',NULL,NULL,NULL),(4,'::1','asdf','$2y$08$U5X0wpid5DTucWCYZq77eehoRBULEY/MvHd/y25rxqkc1j79SN3La',NULL,'cagr215@gmail.com',NULL,NULL,NULL,NULL,1516583845,1516583845,1,'sadasd','asdasdas',NULL,NULL,NULL),(5,'::1','dchicaz','$2y$08$aCKaGManRRqHw.y9yWJ18OcmoaTuRIBp/mdUWtv/daUCKr.4BbU0W',NULL,'dchicaz@gmail.com',NULL,NULL,NULL,NULL,1516583954,1516583954,1,'Diana','Marcela',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_groups`
--

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` VALUES (12,1,1),(13,1,2),(3,2,1),(4,2,2),(8,3,2),(11,4,2),(10,5,2);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-19 16:37:57
