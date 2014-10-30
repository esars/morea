-- MySQL dump 10.15  Distrib 10.0.14-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: landare
-- ------------------------------------------------------
-- Server version	10.0.14-MariaDB-log

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
-- Table structure for table `produktu`
--

DROP TABLE IF EXISTS `produktu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produktu` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `izena` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `deskripzioa` text COLLATE utf8_spanish_ci NOT NULL,
  `prezioa` float(7,2) NOT NULL,
  `stock` int(5) NOT NULL,
  `kategoria` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produktu`
--

LOCK TABLES `produktu` WRITE;
/*!40000 ALTER TABLE `produktu` DISABLE KEYS */;
INSERT INTO `produktu` VALUES (1,'Alkatxofa','Alkatxifa haziak. 2tik 3 urtera artako hazkuntza',2.00,100,NULL),(2,'Baratxuria','Baratxuri haziak, zure errezetei zapore bizi bat emateko',4.00,200,NULL),(3,'Kiwia','Kiwi zuhaitzaren haziak, fruitu tropikal',20.00,50,NULL),(4,'Kalabazina','Kalabazina Euskal Herrian oso oparoa den barazkia da.',3.00,300,NULL),(5,'Estragoia','El estragón tiene propiedades medicinales: en cataplasma, se ponen hojas y flores frescas y trituradas dentro de una gasa para aliviar el dolor de muelas; en infusión, ayuda a mejorar la digestión; tomar baños de pies y manos de agua con un puñado de hojas frescas de estragón alivia la artrosis.',5.00,700,NULL),(6,'Albahaka','Gozotzaile naturala, entsaladari botatzeko oso aproposa.',1.00,30,NULL),(7,'Kamelia','Etxe barruko landare polita eta bizia.',40.00,50,NULL),(8,'Geranioa','Al final de invierno o principios de primavera haz una poda severa cerca del suelo. Aprovecha el material cortado para hacer esquejes. También se debe despuntar con frecuencia para que emita brotes laterales; cuantos más tallos, más flores.\r\n',3.50,400,NULL),(9,'Sativa Jack Herer','Jack Herer is a sativa-dominant cannabis strain that has gained as much renown as its namesake, the marijuana activist and author of The Emperor Wears No Clothes. Combining a Haze hybrid with a Northern Lights #5 and Shiva Skunk cross, Sensi Seeds created Jack Herer hoping to capture both the cerebral elevation associated with sativas and the heavy resin production of indicas. Its rich genetic background gives rise to several different variations of Jack Herer, each phenotype bearing its own unique features and effects. However, consumers typically describe this 55% sativa hybrid as blissful, clear-headed, and creative.',10.50,420,NULL),(10,'Indica White Rhino','White Rhino is a hybrid of White Widow and an unknown North American indica strain, creating a bushy and stout plant. The buds give off a strong and heady high. The plant\'s parentage hails from Afghanistan, Brazil, and India. White Rhino is one of the best types of marijuana for medicinal use since it has such a high THC content.',16.50,300,NULL),(11,'Peyote','Xamanek aintzinatik erabili izan duten kaktus haluzinogenoa',25.75,300,NULL),(13,'Orkidea','La palabra orquídea deriva del griego ορχις (orchis = testículo), vocablo que se encontró por primera vez en los manuscritos de la obra De causis plantarum del filósofo griego Teofrasto y que datan aproximadamente del año 375 antes de Cristo.10 Tal vocablo hace referencia a la forma de los tubérculos de las especies del género Orchis, orquídeas de hábito terrestre cuyos tubérculos dobles parecen testículos,20 como puede apreciarse en la imagen de la derecha.',20.65,350,'Erramuak');
/*!40000 ALTER TABLE `produktu` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-30  9:45:56
