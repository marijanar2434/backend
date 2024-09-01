-- MySQL dump 10.19  Distrib 10.3.36-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: vehicle-app
-- ------------------------------------------------------
-- Server version       10.3.36-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE DATABASE `vehicle-app`;

USE `vehicle-app`;
--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20220920143307','2022-09-20 16:33:12',3497);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_store`
--

DROP TABLE IF EXISTS `event_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` int(11) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `occurred_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_store`
--

LOCK TABLES `event_store` WRITE;
/*!40000 ALTER TABLE `event_store` DISABLE KEYS */;
INSERT INTO `event_store` VALUES (1,'7d154961-a1ac-48e5-b8ef-95c1b901c92a','ClientCreated',1,'{\"domainEventType\":\"ClientCreated\",\"entityId\":\"7d154961-a1ac-48e5-b8ef-95c1b901c92a\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(2,'018be199-41c5-4f8a-90de-9b4a46d84b5f','BrandCreated',1,'{\"domainEventType\":\"BrandCreated\",\"name\":\"Audi\",\"changes\":[],\"entityId\":\"018be199-41c5-4f8a-90de-9b4a46d84b5f\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(3,'1be9b276-a434-4140-86ff-006d2a1c150f','BrandCreated',1,'{\"domainEventType\":\"BrandCreated\",\"name\":\"BMW\",\"changes\":[],\"entityId\":\"1be9b276-a434-4140-86ff-006d2a1c150f\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(4,'f5fa98fd-51d1-42ad-80d5-f7ceb7245b6b','BrandCreated',1,'{\"domainEventType\":\"BrandCreated\",\"name\":\"VW\",\"changes\":[],\"entityId\":\"f5fa98fd-51d1-42ad-80d5-f7ceb7245b6b\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(5,'00522c24-0212-409c-9b6f-162cd7056251','BrandCreated',1,'{\"domainEventType\":\"BrandCreated\",\"name\":\"VW Caddy\",\"changes\":[],\"entityId\":\"00522c24-0212-409c-9b6f-162cd7056251\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(6,'4ed87b26-b8a6-4bd9-af5a-129c84608de9','RoleCreated',1,'{\"domainEventType\":\"RoleCreated\",\"entityId\":\"4ed87b26-b8a6-4bd9-af5a-129c84608de9\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(7,'ff6aa32c-5f70-4995-8a10-5ee9ab541a2f','RoleCreated',1,'{\"domainEventType\":\"RoleCreated\",\"entityId\":\"ff6aa32c-5f70-4995-8a10-5ee9ab541a2f\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(8,'44fa4d6b-ad37-4d1b-be07-7ef537939bab','RoleCreated',1,'{\"domainEventType\":\"RoleCreated\",\"entityId\":\"44fa4d6b-ad37-4d1b-be07-7ef537939bab\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(9,'e4e9aeca-3858-4629-9f06-d2c2654633c9','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"System\",\"username\":\"system\",\"email\":\"system@dev-vehicle.com\",\"avatar\":\"\",\"entityId\":\"e4e9aeca-3858-4629-9f06-d2c2654633c9\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(10,'ba5d0304-cdc0-4c63-bf1f-52ba3b576b3e','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Administrator\",\"username\":\"admin\",\"email\":\"admin@dev-vehicle.com\",\"avatar\":\"\",\"entityId\":\"ba5d0304-cdc0-4c63-bf1f-52ba3b576b3e\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(11,'9b1cb4f8-b374-4814-aa78-8183202ee8d0','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Adriel Muller\",\"username\":\"rozella86\",\"email\":\"vmitchell@gmail.com\",\"avatar\":\"\",\"entityId\":\"9b1cb4f8-b374-4814-aa78-8183202ee8d0\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(12,'2ad72a05-2382-4a1b-97ff-b8e41a71af71','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Prof. Florian Boehm Sr.\",\"username\":\"torphy.ena\",\"email\":\"dedric70@mcclure.com\",\"avatar\":\"\",\"entityId\":\"2ad72a05-2382-4a1b-97ff-b8e41a71af71\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(13,'6c8d1a7c-5c18-4b55-98d2-31a1e0db5f25','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Eldridge Zboncak\",\"username\":\"bmurray\",\"email\":\"crooks.laury@homenick.com\",\"avatar\":\"\",\"entityId\":\"6c8d1a7c-5c18-4b55-98d2-31a1e0db5f25\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(14,'4f38c771-ffa2-4f95-8af4-232e8d95a340','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Furman Rodriguez\",\"username\":\"bethel03\",\"email\":\"don.hettinger@yahoo.com\",\"avatar\":\"\",\"entityId\":\"4f38c771-ffa2-4f95-8af4-232e8d95a340\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(15,'1682c4cc-c8ed-4280-99be-6389cfaaa8a9','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Raymundo Braun\",\"username\":\"molson\",\"email\":\"shudson@swaniawski.com\",\"avatar\":\"\",\"entityId\":\"1682c4cc-c8ed-4280-99be-6389cfaaa8a9\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(16,'31eee63a-18c6-4cb9-9d97-03cdbca30e45','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Quinn Volkman\",\"username\":\"roob.kaylie\",\"email\":\"rkemmer@gmail.com\",\"avatar\":\"\",\"entityId\":\"31eee63a-18c6-4cb9-9d97-03cdbca30e45\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(17,'a8e76571-750a-4b21-a7ed-d0e1ef7c6d05','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Weldon Hagenes\",\"username\":\"muller.josh\",\"email\":\"dicki.lukas@huels.com\",\"avatar\":\"\",\"entityId\":\"a8e76571-750a-4b21-a7ed-d0e1ef7c6d05\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(18,'a86a7c56-f84d-4094-9388-b40fc4f8dac3','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Lupe Conn\",\"username\":\"sipes.rubye\",\"email\":\"hrenner@hills.com\",\"avatar\":\"\",\"entityId\":\"a86a7c56-f84d-4094-9388-b40fc4f8dac3\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(19,'ff2811f7-b229-4075-a7ec-d6fe146e501f','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Shawn Ondricka\",\"username\":\"hoppe.lacy\",\"email\":\"anderson.cathy@yahoo.com\",\"avatar\":\"\",\"entityId\":\"ff2811f7-b229-4075-a7ec-d6fe146e501f\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:20+02:00\"}','2022-09-20 16:33:20'),(20,'c4d32951-795d-48d6-a032-d54ed0338216','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Prof. Westley Towne\",\"username\":\"predovic.anissa\",\"email\":\"brown.domenic@kemmer.com\",\"avatar\":\"\",\"entityId\":\"c4d32951-795d-48d6-a032-d54ed0338216\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(21,'ade597d7-3de4-4b95-9a5e-2e88d192952c','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Clarabelle Langworth\",\"username\":\"remington26\",\"email\":\"casper.eliseo@ernser.com\",\"avatar\":\"\",\"entityId\":\"ade597d7-3de4-4b95-9a5e-2e88d192952c\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(22,'46a7d952-a851-4dc6-a924-070c1b4a90e4','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Lane Oberbrunner MD\",\"username\":\"audreanne.greenfelder\",\"email\":\"marc.hand@brakus.org\",\"avatar\":\"\",\"entityId\":\"46a7d952-a851-4dc6-a924-070c1b4a90e4\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(23,'395559da-646a-4b08-b0dc-9e086b87a45c','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Katelin Crona\",\"username\":\"bobby39\",\"email\":\"cordia.auer@rolfson.com\",\"avatar\":\"\",\"entityId\":\"395559da-646a-4b08-b0dc-9e086b87a45c\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(24,'f5af89e1-5d27-423f-9705-fff8c729ace5','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Letitia Orn\",\"username\":\"moshe01\",\"email\":\"mmohr@hotmail.com\",\"avatar\":\"\",\"entityId\":\"f5af89e1-5d27-423f-9705-fff8c729ace5\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(25,'3aeff7d8-e26f-4e07-bf46-cc21bb2497d6','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Karlee Dickinson\",\"username\":\"bechtelar.renee\",\"email\":\"kenna.olson@weissnat.com\",\"avatar\":\"\",\"entityId\":\"3aeff7d8-e26f-4e07-bf46-cc21bb2497d6\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(26,'7be40f06-6d5c-4c69-b5ee-f12b5af6bec2','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Marjory Bernhard\",\"username\":\"ckertzmann\",\"email\":\"adelia67@nitzsche.com\",\"avatar\":\"\",\"entityId\":\"7be40f06-6d5c-4c69-b5ee-f12b5af6bec2\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(27,'4eacdb44-40b1-4317-9f34-8041cf35e07c','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Rahul Becker\",\"username\":\"huels.prudence\",\"email\":\"cremin.mae@medhurst.com\",\"avatar\":\"\",\"entityId\":\"4eacdb44-40b1-4317-9f34-8041cf35e07c\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(28,'656e8c9a-5843-4d20-8c64-968f718e4f27','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Ana Nienow PhD\",\"username\":\"hmayer\",\"email\":\"carrie47@gmail.com\",\"avatar\":\"\",\"entityId\":\"656e8c9a-5843-4d20-8c64-968f718e4f27\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(29,'e97f4507-0070-4958-9200-acaf23757acc','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Jewel Gibson\",\"username\":\"kenyatta.cruickshank\",\"email\":\"bkuhn@morar.com\",\"avatar\":\"\",\"entityId\":\"e97f4507-0070-4958-9200-acaf23757acc\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(30,'74bd9c6d-6f69-49be-8ffb-5d8d3fbd9c8c','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Waldo Hansen\",\"username\":\"london.lind\",\"email\":\"cole.ryann@hintz.com\",\"avatar\":\"\",\"entityId\":\"74bd9c6d-6f69-49be-8ffb-5d8d3fbd9c8c\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(31,'cbe6e6f7-e1ba-4dab-aa60-8063c3d4593c','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Clarabelle Satterfield\",\"username\":\"icole\",\"email\":\"oberbrunner.adah@wilderman.com\",\"avatar\":\"\",\"entityId\":\"cbe6e6f7-e1ba-4dab-aa60-8063c3d4593c\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(32,'c790c392-096b-403f-a092-fef810bb0ebd','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Ms. Valentina Johns\",\"username\":\"pouros.reta\",\"email\":\"kihn.zelma@yahoo.com\",\"avatar\":\"\",\"entityId\":\"c790c392-096b-403f-a092-fef810bb0ebd\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(33,'a740785b-e618-4e93-b839-9c1c801c9899','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Blanca Treutel\",\"username\":\"vkutch\",\"email\":\"lubowitz.yasmine@kub.net\",\"avatar\":\"\",\"entityId\":\"a740785b-e618-4e93-b839-9c1c801c9899\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(34,'c36c79f1-c9b9-4d70-865d-56a9fad33690','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Caitlyn Nikolaus MD\",\"username\":\"hane.andreane\",\"email\":\"derrick.schaefer@harris.net\",\"avatar\":\"\",\"entityId\":\"c36c79f1-c9b9-4d70-865d-56a9fad33690\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(35,'e376cc5b-b230-46ca-9d0d-d1a8a9203f5f','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Cordia Nader DVM\",\"username\":\"sanford.cummerata\",\"email\":\"schaden.ivy@gmail.com\",\"avatar\":\"\",\"entityId\":\"e376cc5b-b230-46ca-9d0d-d1a8a9203f5f\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(36,'c412c901-a93e-40db-acfa-ece214eb46f8','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Alanna Bashirian\",\"username\":\"fjohnson\",\"email\":\"pkautzer@considine.net\",\"avatar\":\"\",\"entityId\":\"c412c901-a93e-40db-acfa-ece214eb46f8\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(37,'bd0e9760-02c4-4c19-88b1-5023820182f8','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Tara Haley DDS\",\"username\":\"pwillms\",\"email\":\"walter.susana@gmail.com\",\"avatar\":\"\",\"entityId\":\"bd0e9760-02c4-4c19-88b1-5023820182f8\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(38,'7c54d3d0-750a-4f08-935d-b22d86e3c90b','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Walker McKenzie\",\"username\":\"cormier.reginald\",\"email\":\"aniya.wisozk@yahoo.com\",\"avatar\":\"\",\"entityId\":\"7c54d3d0-750a-4f08-935d-b22d86e3c90b\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(39,'df495cbb-2d1e-427e-9446-fdc02c19146f','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Dr. Abbey Zieme MD\",\"username\":\"bmorissette\",\"email\":\"schmitt.sarah@hotmail.com\",\"avatar\":\"\",\"entityId\":\"df495cbb-2d1e-427e-9446-fdc02c19146f\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:21+02:00\"}','2022-09-20 16:33:21'),(40,'9a0124f1-a052-4cc7-a4ab-2025ce9a27c2','UserCreated',1,'{\"domainEventType\":\"UserCreated\",\"fullName\":\"Fern Turner I\",\"username\":\"jefferey57\",\"email\":\"ralph11@gmail.com\",\"avatar\":\"\",\"entityId\":\"9a0124f1-a052-4cc7-a4ab-2025ce9a27c2\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:22+02:00\"}','2022-09-20 16:33:22'),(41,'fecbd00e-5d4b-4009-88dd-9f419967425b','VehicleCreated',1,'{\"domainEventType\":\"VehicleCreated\",\"chassisNumber\":\"28103373N\",\"engineNumber\":\"SDA021312332N\",\"type\":\"Audi A4\",\"entityId\":\"fecbd00e-5d4b-4009-88dd-9f419967425b\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:22+02:00\"}','2022-09-20 16:33:22'),(42,'fa6acc18-fb80-45c9-876f-60f0271fcd12','VehicleCreated',1,'{\"domainEventType\":\"VehicleCreated\",\"chassisNumber\":\"OASDJOASDDASDLASDKL\",\"engineNumber\":\"WAUZZZ4BZWN049087\",\"type\":\"BMW 320D\",\"entityId\":\"fa6acc18-fb80-45c9-876f-60f0271fcd12\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:22+02:00\"}','2022-09-20 16:33:22'),(43,'9c77a2d2-8123-4fe5-8fd3-2102416ce195','VehicleCreated',1,'{\"domainEventType\":\"VehicleCreated\",\"chassisNumber\":\"OASM90PASKDPASDAS0D90213\",\"engineNumber\":\"WAUYSZZ3DSWN04SD39\",\"type\":\"Audi A4\",\"entityId\":\"9c77a2d2-8123-4fe5-8fd3-2102416ce195\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:22+02:00\"}','2022-09-20 16:33:22'),(44,'a46c5a62-7a5a-417c-a812-f15e5b4ee53b','VehicleCreated',1,'{\"domainEventType\":\"VehicleCreated\",\"chassisNumber\":\"ODHJSOJOASJASDASDPOASJADSOAS\",\"engineNumber\":\"WVWZZZ1JZ3W386752\",\"type\":\"BMW 320D\",\"entityId\":\"a46c5a62-7a5a-417c-a812-f15e5b4ee53b\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:22+02:00\"}','2022-09-20 16:33:22'),(45,'a1ecd0dc-121b-4659-84e1-de5b3ac35a32','VehicleCreated',1,'{\"domainEventType\":\"VehicleCreated\",\"chassisNumber\":\"ASDPOASDPOASJUDASDDA1231LJASD\",\"engineNumber\":\"WVGPDS8SP4S5SDZ52\",\"type\":\"BMW 320D\",\"entityId\":\"a1ecd0dc-121b-4659-84e1-de5b3ac35a32\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:22+02:00\"}','2022-09-20 16:33:22'),(46,'67294cea-164f-48bb-89c4-25febbfca7ed','RegistrationCreated',1,'{\"domainEventType\":\"RegistrationCreated\",\"message\":\"New registration added.\",\"user\":\"Fern Turner I\",\"entityId\":\"67294cea-164f-48bb-89c4-25febbfca7ed\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:22+02:00\"}','2022-09-20 16:33:22'),(47,'9289fd62-7712-4a58-9159-119fd21242ce','RegistrationCreated',1,'{\"domainEventType\":\"RegistrationCreated\",\"message\":\"New registration added.\",\"user\":\"Clarabelle Langworth\",\"entityId\":\"9289fd62-7712-4a58-9159-119fd21242ce\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:22+02:00\"}','2022-09-20 16:33:22'),(48,'863128d1-b1f4-43e9-ae50-4a787d28f01d','RegistrationCreated',1,'{\"domainEventType\":\"RegistrationCreated\",\"message\":\"New registration added.\",\"user\":\"Karlee Dickinson\",\"entityId\":\"863128d1-b1f4-43e9-ae50-4a787d28f01d\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:22+02:00\"}','2022-09-20 16:33:22'),(49,'7c5873b9-6f0a-4ec1-9da3-ed62b3aaa0ab','RegistrationCreated',1,'{\"domainEventType\":\"RegistrationCreated\",\"message\":\"New registration added.\",\"user\":\"Karlee Dickinson\",\"entityId\":\"7c5873b9-6f0a-4ec1-9da3-ed62b3aaa0ab\",\"domainEventVersion\":1,\"occurredOn\":\"2022-09-20T16:33:22+02:00\"}','2022-09-20 16:33:22');
/*!40000 ALTER TABLE `event_store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `identity_access_access_tokens`
--

DROP TABLE IF EXISTS `identity_access_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `identity_access_access_tokens` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `identifier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `scopes` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:array)',
  `revoked` tinyint(1) NOT NULL,
  `created_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `identity_access_access_tokens`
--

LOCK TABLES `identity_access_access_tokens` WRITE;
/*!40000 ALTER TABLE `identity_access_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `identity_access_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `identity_access_clients`
--

DROP TABLE IF EXISTS `identity_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `identity_access_clients` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect_uri` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `confidential` tinyint(1) NOT NULL,
  `used_for_general_purpose_authentication` tinyint(1) NOT NULL,
  `created_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `identity_access_clients`
--

LOCK TABLES `identity_access_clients` WRITE;
/*!40000 ALTER TABLE `identity_access_clients` DISABLE KEYS */;
INSERT INTO `identity_access_clients` VALUES ('7d154961-a1ac-48e5-b8ef-95c1b901c92a','Resource owner password credentials grant','$2y$10$QzGBFET1oat1Aa.jlfOhBeb6dgGZlvmDCIQwuExpgWjtkecEpNogG','',1,1,1,'2022-09-20 16:33:20','2022-09-20 16:33:20');
/*!40000 ALTER TABLE `identity_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `identity_access_refresh_tokens`
--

DROP TABLE IF EXISTS `identity_access_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `identity_access_refresh_tokens` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `identifier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_identifier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `identity_access_refresh_tokens`
--

LOCK TABLES `identity_access_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `identity_access_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `identity_access_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `identity_access_roles`
--

DROP TABLE IF EXISTS `identity_access_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `identity_access_roles` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `identity_access_roles`
--

LOCK TABLES `identity_access_roles` WRITE;
/*!40000 ALTER TABLE `identity_access_roles` DISABLE KEYS */;
INSERT INTO `identity_access_roles` VALUES ('44fa4d6b-ad37-4d1b-be07-7ef537939bab','System','ROLE_SYSTEM',1,'2022-09-20 16:33:20','2022-09-20 16:33:20'),('4ed87b26-b8a6-4bd9-af5a-129c84608de9','User','ROLE_USER',1,'2022-09-20 16:33:20','2022-09-20 16:33:20'),('ff6aa32c-5f70-4995-8a10-5ee9ab541a2f','Administrator','ROLE_ADMINISTRATOR',1,'2022-09-20 16:33:20','2022-09-20 16:33:20');
/*!40000 ALTER TABLE `identity_access_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `identity_access_users`
--

DROP TABLE IF EXISTS `identity_access_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `identity_access_users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `full_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `avatar_file` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_extension` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_size` int(11) DEFAULT NULL,
  `password_reset_request_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_reset_request_occurred_on` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C1AA95EFF85E0677` (`username`),
  UNIQUE KEY `UNIQ_C1AA95EFE7927C74` (`email`),
  KEY `IDX_C1AA95EFF85E0677` (`username`),
  KEY `IDX_C1AA95EFE7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `identity_access_users`
--

LOCK TABLES `identity_access_users` WRITE;
/*!40000 ALTER TABLE `identity_access_users` DISABLE KEYS */;
INSERT INTO `identity_access_users` VALUES ('1682c4cc-c8ed-4280-99be-6389cfaaa8a9','Raymundo Braun','molson','shudson@swaniawski.com','$2y$10$oHblY82aA2RZ5HK.gej9se6AmFw9eeic1emI5zho0T5taGV3dWfpW',0,'2022-09-20 16:33:20','2022-09-20 16:33:20',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('2ad72a05-2382-4a1b-97ff-b8e41a71af71','Prof. Florian Boehm Sr.','torphy.ena','dedric70@mcclure.com','$2y$10$0Ar/qcly7ImjJwY8gn8useOkrMAIZMgjoCeA8nBepiQ38HdqU2p76',1,'2022-09-20 16:33:20','2022-09-20 16:33:20',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('31eee63a-18c6-4cb9-9d97-03cdbca30e45','Quinn Volkman','roob.kaylie','rkemmer@gmail.com','$2y$10$/gICEQMcs7.cmk85jiOve.afP7hjfpaXmEtNFTdKvmhINFTgfIu3m',1,'2022-09-20 16:33:20','2022-09-20 16:33:20',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('395559da-646a-4b08-b0dc-9e086b87a45c','Katelin Crona','bobby39','cordia.auer@rolfson.com','$2y$10$VYqGyRfBJS0MHRZmM6cVquxf.UaDDJIdtZPwGOSq6FbQ68Rzv1Seu',0,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('3aeff7d8-e26f-4e07-bf46-cc21bb2497d6','Karlee Dickinson','bechtelar.renee','kenna.olson@weissnat.com','$2y$10$rWFLxzqJdcKnDiAdmTmH0OVBLN7VMmL9FlPQPV8Scmoj2WDztplPu',1,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('46a7d952-a851-4dc6-a924-070c1b4a90e4','Lane Oberbrunner MD','audreanne.greenfelder','marc.hand@brakus.org','$2y$10$pfdgwuL5sJ3WnNERnqKaJu8wXMeqkSIaUb6B3CCwpQNRIKKEzBIza',1,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('4eacdb44-40b1-4317-9f34-8041cf35e07c','Rahul Becker','huels.prudence','cremin.mae@medhurst.com','$2y$10$Qe27nfiqran4oHKQmUFK7.atn7XWnJS39qj0gJnT88LTp82eYN.8a',1,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('4f38c771-ffa2-4f95-8af4-232e8d95a340','Furman Rodriguez','bethel03','don.hettinger@yahoo.com','$2y$10$zqgUJ8hnGyyDs3Vj3GUCCO8rrqJFx70uyy3.nZ3uJGLA.8vQZ0MSK',1,'2022-09-20 16:33:20','2022-09-20 16:33:20',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('656e8c9a-5843-4d20-8c64-968f718e4f27','Ana Nienow PhD','hmayer','carrie47@gmail.com','$2y$10$vEj0buMCNngcNPp3ujNujO1k4NOk3nR.kXE5p3XDAta38w3n0YYoO',1,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('6c8d1a7c-5c18-4b55-98d2-31a1e0db5f25','Eldridge Zboncak','bmurray','crooks.laury@homenick.com','$2y$10$ZWS7jaO6XomHChKUwfW/IuYPBImnqPQOBwVZK4X5hLUMNTTYNZWLy',0,'2022-09-20 16:33:20','2022-09-20 16:33:20',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('74bd9c6d-6f69-49be-8ffb-5d8d3fbd9c8c','Waldo Hansen','london.lind','cole.ryann@hintz.com','$2y$10$AGkBfU/s3Zj7P9krlE2.sOfbTTtL3rxrPUWhY1lzkhJkFU4tvY0CS',1,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('7be40f06-6d5c-4c69-b5ee-f12b5af6bec2','Marjory Bernhard','ckertzmann','adelia67@nitzsche.com','$2y$10$TwG2TKQkiOV0VmxT4MCV9ex.KcU1rMdtAL/aZcdxxWtvP95jtkTcO',0,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('7c54d3d0-750a-4f08-935d-b22d86e3c90b','Walker McKenzie','cormier.reginald','aniya.wisozk@yahoo.com','$2y$10$ZuncCCeLmVgmXi3n/zXPHONJ8x5ItxNJ8joB.8BIRFxMDxcPFgL4.',1,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('9a0124f1-a052-4cc7-a4ab-2025ce9a27c2','Fern Turner I','jefferey57','ralph11@gmail.com','$2y$10$TBz0L824zTsSlTvy35jNJuig3OVW4uqpC0nibScZAMRGzHaF/tufK',0,'2022-09-20 16:33:22','2022-09-20 16:33:22',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('9b1cb4f8-b374-4814-aa78-8183202ee8d0','Adriel Muller','rozella86','vmitchell@gmail.com','$2y$10$bcMj9g4O1TTLieTp8VUHqeOIED2Ws3DYonjBIY7mWP685iwLgQFDm',0,'2022-09-20 16:33:20','2022-09-20 16:33:20',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('a740785b-e618-4e93-b839-9c1c801c9899','Blanca Treutel','vkutch','lubowitz.yasmine@kub.net','$2y$10$CSPvcY3Ebgp7.1.EgKTmt.uhr6thja/ghMiNWRg6jkeDONVCxjHDG',1,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('a86a7c56-f84d-4094-9388-b40fc4f8dac3','Lupe Conn','sipes.rubye','hrenner@hills.com','$2y$10$HX498nKPbE9scXigAepsA.D9kx7lBTFJn7h0VmTaXMNuaWTsNn1ke',0,'2022-09-20 16:33:20','2022-09-20 16:33:20',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('a8e76571-750a-4b21-a7ed-d0e1ef7c6d05','Weldon Hagenes','muller.josh','dicki.lukas@huels.com','$2y$10$YMVrZNCAN5wzbjFXzTXAHej.fevaD9RxJVtddggQKg4.S.Pva7fgO',1,'2022-09-20 16:33:20','2022-09-20 16:33:20',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('ade597d7-3de4-4b95-9a5e-2e88d192952c','Clarabelle Langworth','remington26','casper.eliseo@ernser.com','$2y$10$nsiB.BWgZJZBfTjjcqS3/uSyLl0vdS/ISN0IdU11va62k9m6/0xfy',0,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('ba5d0304-cdc0-4c63-bf1f-52ba3b576b3e','Administrator','admin','admin@dev-vehicle.com','$2y$10$oE2csMt3eFNjC7fF6AQATO6YdZ5Svt2I9zuvB.k3hWtg/U2Pgs3Im',1,'2022-09-20 16:33:20','2022-09-20 16:33:20',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('bd0e9760-02c4-4c19-88b1-5023820182f8','Tara Haley DDS','pwillms','walter.susana@gmail.com','$2y$10$Bo13x7snljhYiO5UsdoBk.904j/tTgIkdc3iV7sDsStg1C/V/Z7Ri',0,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('c36c79f1-c9b9-4d70-865d-56a9fad33690','Caitlyn Nikolaus MD','hane.andreane','derrick.schaefer@harris.net','$2y$10$dTf723XIqmkfqV.5Yl6fNezCl2tmOK.aQXHVy3dgMpbTd6mDT3oXy',0,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('c412c901-a93e-40db-acfa-ece214eb46f8','Alanna Bashirian','fjohnson','pkautzer@considine.net','$2y$10$wukN.rPc919E3Tft7LJIw.LGNmssiZYJNylbfyvLct0PV41axMQWq',0,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('c4d32951-795d-48d6-a032-d54ed0338216','Prof. Westley Towne','predovic.anissa','brown.domenic@kemmer.com','$2y$10$Sbyn3V7l2vrNtWqrEUkvAOhWwNxycF5/XKuEpYxsFWbPBFQWD.PQS',1,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('c790c392-096b-403f-a092-fef810bb0ebd','Ms. Valentina Johns','pouros.reta','kihn.zelma@yahoo.com','$2y$10$PiNUPEGjyeCYW7IsdxOB8uTAXFJAD6xAEe6vLQxu.WONJ4rPWcuby',1,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('cbe6e6f7-e1ba-4dab-aa60-8063c3d4593c','Clarabelle Satterfield','icole','oberbrunner.adah@wilderman.com','$2y$10$wQPMIAMpt9Mzw9txKHtqW.w/jSTKl5h7U.Rxdjq68uq0pG2JRCIUi',1,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('df495cbb-2d1e-427e-9446-fdc02c19146f','Dr. Abbey Zieme MD','bmorissette','schmitt.sarah@hotmail.com','$2y$10$PKkGpfnfzDWJhxuSjGUiqODjEcMrPDA3yP/J30U7DeCRsp0OhUu5K',1,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('e376cc5b-b230-46ca-9d0d-d1a8a9203f5f','Cordia Nader DVM','sanford.cummerata','schaden.ivy@gmail.com','$2y$10$2oSqac0Kou80pfF9Dl7nnueinRfGKlS.opWSKOo3I9Ro00jjCEnnu',0,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('e4e9aeca-3858-4629-9f06-d2c2654633c9','System','system','system@dev-vehicle.com','$2y$10$y2stqAXfZ.Y8Tnj67OqiguvxYeh.kTjpfFvaevLrvnoO8Ej1muH6G',1,'2022-09-20 16:33:20','2022-09-20 16:33:20',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('e97f4507-0070-4958-9200-acaf23757acc','Jewel Gibson','kenyatta.cruickshank','bkuhn@morar.com','$2y$10$zqCshB8Otxn9956QcivKI.u.rJK8KMvkKwGXxYoUnFY8Arp01yYTS',0,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('f5af89e1-5d27-423f-9705-fff8c729ace5','Letitia Orn','moshe01','mmohr@hotmail.com','$2y$10$uA6q6.iI6buIYJtfkfZH3.w.pdKoFFh3GM19S2eBBubi/8Sp459le',1,'2022-09-20 16:33:21','2022-09-20 16:33:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('ff2811f7-b229-4075-a7ec-d6fe146e501f','Shawn Ondricka','hoppe.lacy','anderson.cathy@yahoo.com','$2y$10$sZdateZqBuhZ5kkEsH7N9eQ.CNoDwsov51S6r4hhL8E2zmwHYf5W2',0,'2022-09-20 16:33:20','2022-09-20 16:33:20',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `identity_access_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `identity_access_users_roles`
--

DROP TABLE IF EXISTS `identity_access_users_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `identity_access_users_roles` (
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `role_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_7049C67AA76ED395` (`user_id`),
  KEY `IDX_7049C67AD60322AC` (`role_id`),
  CONSTRAINT `FK_7049C67AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `identity_access_users` (`id`),
  CONSTRAINT `FK_7049C67AD60322AC` FOREIGN KEY (`role_id`) REFERENCES `identity_access_roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `identity_access_users_roles`
--

LOCK TABLES `identity_access_users_roles` WRITE;
/*!40000 ALTER TABLE `identity_access_users_roles` DISABLE KEYS */;
INSERT INTO `identity_access_users_roles` VALUES ('ba5d0304-cdc0-4c63-bf1f-52ba3b576b3e','ff6aa32c-5f70-4995-8a10-5ee9ab541a2f'),('e4e9aeca-3858-4629-9f06-d2c2654633c9','44fa4d6b-ad37-4d1b-be07-7ef537939bab');
/*!40000 ALTER TABLE `identity_access_users_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registration_documentations`
--

DROP TABLE IF EXISTS `registration_documentations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registration_documentations` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `registration_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `file_file` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_extension` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8DE81DD4833D8F43` (`registration_id`),
  CONSTRAINT `FK_8DE81DD4833D8F43` FOREIGN KEY (`registration_id`) REFERENCES `vehicles_registrations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registration_documentations`
--

LOCK TABLES `registration_documentations` WRITE;
/*!40000 ALTER TABLE `registration_documentations` DISABLE KEYS */;
/*!40000 ALTER TABLE `registration_documentations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_brands`
--

DROP TABLE IF EXISTS `vehicles_brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_brands` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_363B89C15E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_brands`
--

LOCK TABLES `vehicles_brands` WRITE;
/*!40000 ALTER TABLE `vehicles_brands` DISABLE KEYS */;
INSERT INTO `vehicles_brands` VALUES ('00522c24-0212-409c-9b6f-162cd7056251','VW Caddy','2022-09-20 16:33:20','2022-09-20 16:33:20'),('018be199-41c5-4f8a-90de-9b4a46d84b5f','Audi','2022-09-20 16:33:20','2022-09-20 16:33:20'),('1be9b276-a434-4140-86ff-006d2a1c150f','BMW','2022-09-20 16:33:20','2022-09-20 16:33:20'),('f5fa98fd-51d1-42ad-80d5-f7ceb7245b6b','VW','2022-09-20 16:33:20','2022-09-20 16:33:20');
/*!40000 ALTER TABLE `vehicles_brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_changes`
--

DROP TABLE IF EXISTS `vehicles_changes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_changes` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `history_of_change_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `vehicle_changes_change` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EDBF276322A8D809` (`history_of_change_id`),
  CONSTRAINT `FK_EDBF276322A8D809` FOREIGN KEY (`history_of_change_id`) REFERENCES `vehicles_history_of_changes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_changes`
--

LOCK TABLES `vehicles_changes` WRITE;
/*!40000 ALTER TABLE `vehicles_changes` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicles_changes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_clients`
--

DROP TABLE IF EXISTS `vehicles_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_clients` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `vehicle_client_fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_client_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_client_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_client_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_client_webiste` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_clients`
--

LOCK TABLES `vehicles_clients` WRITE;
/*!40000 ALTER TABLE `vehicles_clients` DISABLE KEYS */;
INSERT INTO `vehicles_clients` VALUES ('4d2d27f6-8e54-43a3-9a5c-b6b0197fb0fa','Pera Peric','Omladinskih brigada 90A, Novi Beograd','info.serbia@omv.com','011 2071500','www.omv.co.rs','2022-09-20 16:33:20','2022-09-20 16:33:20'),('860d641e-0170-4e39-957d-599d60cf278b','Bojan Mirković','Abebe Bikile 4b','info@autolimar.rs','065 2 51 51 60','www.autolimar.rs','2022-09-20 16:33:20','2022-09-20 16:33:20'),('99f0d5f1-1509-4313-a44f-0cd17526932f','Mira Mirić','Cara Dusana 209, Zemun','servis@akkole.','060 70 10 396','www.akkole.rs','2022-09-20 16:33:20','2022-09-20 16:33:20'),('a2195277-68bb-4506-91af-844d0f2fbd2f','Jovan Jovanović','Tošin bunar 179, Novi Beograd','thule@lavauto.','011 713 88 48     ','lavauto.rs','2022-09-20 16:33:20','2022-09-20 16:33:20');
/*!40000 ALTER TABLE `vehicles_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_collab_types`
--

DROP TABLE IF EXISTS `vehicles_collab_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_collab_types` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1E0063575E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_collab_types`
--

LOCK TABLES `vehicles_collab_types` WRITE;
/*!40000 ALTER TABLE `vehicles_collab_types` DISABLE KEYS */;
INSERT INTO `vehicles_collab_types` VALUES ('7932e49f-e3ba-4a3d-9592-b515b1a80d27','Car body'),('9fd6c1fa-9f97-4a64-92fb-2e98b23a06d9','Car parts'),('a01d9ddb-fa49-484b-8f3c-c26b1944ccb5','Electricity'),('127b8f69-1833-49fb-be87-53cb178b5cd6','Mechanics'),('42223e7a-18b6-402e-8e09-164ba2d2ff2e','Painting'),('daed8498-5a1e-4f9c-8cbd-0a057e79b4bd','Pump');
/*!40000 ALTER TABLE `vehicles_collab_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_collaborators`
--

DROP TABLE IF EXISTS `vehicles_collaborators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_collaborators` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `client_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `company_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  PRIMARY KEY (`id`),
  KEY `IDX_5B5BB2F319EB6921` (`client_id`),
  KEY `IDX_5B5BB2F3979B1AD6` (`company_id`),
  CONSTRAINT `FK_5B5BB2F319EB6921` FOREIGN KEY (`client_id`) REFERENCES `vehicles_clients` (`id`),
  CONSTRAINT `FK_5B5BB2F3979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `vehicles_companies` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_collaborators`
--

LOCK TABLES `vehicles_collaborators` WRITE;
/*!40000 ALTER TABLE `vehicles_collaborators` DISABLE KEYS */;
INSERT INTO `vehicles_collaborators` VALUES ('11e62112-d146-4928-8886-0152584b04df','860d641e-0170-4e39-957d-599d60cf278b','c417639f-ce8b-4332-9a20-4df7c5c9f67b'),('121ae63b-203b-4937-820d-be82f3d876ad','4d2d27f6-8e54-43a3-9a5c-b6b0197fb0fa','a30a4b2b-3b7d-4975-948a-9e24298759a4'),('b21b8c9b-76cc-4d68-9902-d9c6538468b7','99f0d5f1-1509-4313-a44f-0cd17526932f','ea511432-f7b6-4a88-8238-560f04c348f8'),('c2f85715-af96-4688-bbeb-2aeaeff98065','a2195277-68bb-4506-91af-844d0f2fbd2f','f8ac17d3-4c82-44ef-bc5e-1a1a7c64af5e');
/*!40000 ALTER TABLE `vehicles_collaborators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_collaborators_types`
--

DROP TABLE IF EXISTS `vehicles_collaborators_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_collaborators_types` (
  `collaborator_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `type_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  PRIMARY KEY (`collaborator_id`,`type_id`),
  KEY `IDX_56EC1C9D30098C8C` (`collaborator_id`),
  KEY `IDX_56EC1C9DC54C8C93` (`type_id`),
  CONSTRAINT `FK_56EC1C9D30098C8C` FOREIGN KEY (`collaborator_id`) REFERENCES `vehicles_collaborators` (`id`),
  CONSTRAINT `FK_56EC1C9DC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `vehicles_collab_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_collaborators_types`
--

LOCK TABLES `vehicles_collaborators_types` WRITE;
/*!40000 ALTER TABLE `vehicles_collaborators_types` DISABLE KEYS */;
INSERT INTO `vehicles_collaborators_types` VALUES ('11e62112-d146-4928-8886-0152584b04df','a01d9ddb-fa49-484b-8f3c-c26b1944ccb5'),('121ae63b-203b-4937-820d-be82f3d876ad','daed8498-5a1e-4f9c-8cbd-0a057e79b4bd'),('b21b8c9b-76cc-4d68-9902-d9c6538468b7','42223e7a-18b6-402e-8e09-164ba2d2ff2e'),('c2f85715-af96-4688-bbeb-2aeaeff98065','7932e49f-e3ba-4a3d-9592-b515b1a80d27'),('c2f85715-af96-4688-bbeb-2aeaeff98065','9fd6c1fa-9f97-4a64-92fb-2e98b23a06d9');
/*!40000 ALTER TABLE `vehicles_collaborators_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_colors`
--

DROP TABLE IF EXISTS `vehicles_colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_colors` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8A270E6A5E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_colors`
--

LOCK TABLES `vehicles_colors` WRITE;
/*!40000 ALTER TABLE `vehicles_colors` DISABLE KEYS */;
INSERT INTO `vehicles_colors` VALUES ('e2c49b55-dbcc-4376-be53-b10309ce8c0e','BLACK'),('0e8955a4-2ff5-45c4-b39c-7a66ab7551e2','BLUE'),('dc23c324-1d3b-48f4-bcaa-9174d2f9762b','CYAN'),('2da56106-46be-4940-859f-8f33345d590b','GRAY'),('5ad37e93-a80d-4c12-8b95-d4c6751e6901','GREEN');
/*!40000 ALTER TABLE `vehicles_colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_companies`
--

DROP TABLE IF EXISTS `vehicles_companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_companies` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `vehicles_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicles_company_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_companies`
--

LOCK TABLES `vehicles_companies` WRITE;
/*!40000 ALTER TABLE `vehicles_companies` DISABLE KEYS */;
INSERT INTO `vehicles_companies` VALUES ('a30a4b2b-3b7d-4975-948a-9e24298759a4','OMV SRBIJA DOO','CLIDOM2016101471156'),('c417639f-ce8b-4332-9a20-4df7c5c9f67b','LAV AUTO DOO BEOGRAD','CLIDOM2020021888378'),('ea511432-f7b6-4a88-8238-560f04c348f8','SZR BOKI LIMAR','CLIDOM2020243232232'),('f8ac17d3-4c82-44ef-bc5e-1a1a7c64af5e','AUTO KUCA-KOLE DOO','CLIDOM2016101471048');
/*!40000 ALTER TABLE `vehicles_companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_damage_coverages`
--

DROP TABLE IF EXISTS `vehicles_damage_coverages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_damage_coverages` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F8EE884F5E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_damage_coverages`
--

LOCK TABLES `vehicles_damage_coverages` WRITE;
/*!40000 ALTER TABLE `vehicles_damage_coverages` DISABLE KEYS */;
INSERT INTO `vehicles_damage_coverages` VALUES ('4238c58a-0a8b-4012-a92a-5844c562d571','Company'),('eefd76ba-3aa9-4c92-8ab7-2f945ba4ff8c','Employee'),('5baf32bd-33ab-48bf-be18-eb6069bc8b88','Insurance'),('f0089ea4-442b-4599-89c5-edf1d2684ce3','Other persons');
/*!40000 ALTER TABLE `vehicles_damage_coverages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_damages`
--

DROP TABLE IF EXISTS `vehicles_damages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_damages` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `damage_coverage_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `vehicle_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `vehicle_damages_date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `vehicle_damages_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_damages_fee` double NOT NULL,
  `vehicle_damages_time_of_user` int(11) DEFAULT NULL,
  `created_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_9284B572A76ED395` (`user_id`),
  KEY `IDX_9284B572F40B82AD` (`damage_coverage_id`),
  KEY `IDX_9284B572545317D1` (`vehicle_id`),
  CONSTRAINT `FK_9284B572545317D1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles_vehicles` (`id`),
  CONSTRAINT `FK_9284B572A76ED395` FOREIGN KEY (`user_id`) REFERENCES `vehicles_users` (`id`),
  CONSTRAINT `FK_9284B572F40B82AD` FOREIGN KEY (`damage_coverage_id`) REFERENCES `vehicles_damage_coverages` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_damages`
--

LOCK TABLES `vehicles_damages` WRITE;
/*!40000 ALTER TABLE `vehicles_damages` DISABLE KEYS */;
INSERT INTO `vehicles_damages` VALUES ('1cfa436f-d92b-43ce-977a-46d6b4a95253','020129ba-8175-440d-83f4-bbeea9ea9a4a','4238c58a-0a8b-4012-a92a-5844c562d571','9c77a2d2-8123-4fe5-8fd3-2102416ce195','2019-08-19 00:00:00','Damaged left wing and bumper',18343,100,'2022-09-20 16:33:22','2022-09-20 16:33:22'),('9309ab53-07ae-429d-9d5d-ad3404aab0fd',NULL,'eefd76ba-3aa9-4c92-8ab7-2f945ba4ff8c','9c77a2d2-8123-4fe5-8fd3-2102416ce195','2020-05-20 00:00:00','Damaged left rearview mirror and door',5600,NULL,'2022-09-20 16:33:22','2022-09-20 16:33:22'),('c99f8002-a74b-4622-8b9e-33e57f357121','0fe0f30c-a19b-4397-b574-83cd0b127ad4','5baf32bd-33ab-48bf-be18-eb6069bc8b88','9c77a2d2-8123-4fe5-8fd3-2102416ce195','2021-04-04 00:00:00','Damaged  left wheel, wing and door',20600,180,'2022-09-20 16:33:22','2022-09-20 16:33:22');
/*!40000 ALTER TABLE `vehicles_damages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_damages_parts`
--

DROP TABLE IF EXISTS `vehicles_damages_parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_damages_parts` (
  `damage_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `part_and_service_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  PRIMARY KEY (`damage_id`,`part_and_service_id`),
  KEY `IDX_E1192D3E6CE425B7` (`damage_id`),
  KEY `IDX_E1192D3EE09297D9` (`part_and_service_id`),
  CONSTRAINT `FK_E1192D3E6CE425B7` FOREIGN KEY (`damage_id`) REFERENCES `vehicles_damages` (`id`),
  CONSTRAINT `FK_E1192D3EE09297D9` FOREIGN KEY (`part_and_service_id`) REFERENCES `vehicles_part_services` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_damages_parts`
--

LOCK TABLES `vehicles_damages_parts` WRITE;
/*!40000 ALTER TABLE `vehicles_damages_parts` DISABLE KEYS */;
INSERT INTO `vehicles_damages_parts` VALUES ('1cfa436f-d92b-43ce-977a-46d6b4a95253','769988d1-6653-4060-95b9-0f185a858765'),('1cfa436f-d92b-43ce-977a-46d6b4a95253','955edf40-8ff1-4b15-aeaa-94e4fa8d8bad'),('9309ab53-07ae-429d-9d5d-ad3404aab0fd','769988d1-6653-4060-95b9-0f185a858765'),('9309ab53-07ae-429d-9d5d-ad3404aab0fd','955edf40-8ff1-4b15-aeaa-94e4fa8d8bad'),('c99f8002-a74b-4622-8b9e-33e57f357121','769988d1-6653-4060-95b9-0f185a858765');
/*!40000 ALTER TABLE `vehicles_damages_parts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_documentations`
--

DROP TABLE IF EXISTS `vehicles_documentations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_documentations` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `vehicle_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `file_file` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_extension` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E2DD43E0545317D1` (`vehicle_id`),
  CONSTRAINT `FK_E2DD43E0545317D1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles_vehicles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_documentations`
--

LOCK TABLES `vehicles_documentations` WRITE;
/*!40000 ALTER TABLE `vehicles_documentations` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicles_documentations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_expense_types`
--

DROP TABLE IF EXISTS `vehicles_expense_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_expense_types` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `vehicle_ex_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_expense_types`
--

LOCK TABLES `vehicles_expense_types` WRITE;
/*!40000 ALTER TABLE `vehicles_expense_types` DISABLE KEYS */;
INSERT INTO `vehicles_expense_types` VALUES ('100917df-b6a9-47d8-89ef-770f867125f2','Wash'),('16a66182-683f-4276-aa5c-3a5e36bee8e7','Fuel'),('68b35163-0fd0-4cb1-b799-0eab989f1ef6','Tag');
/*!40000 ALTER TABLE `vehicles_expense_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_fuel_and_expenses`
--

DROP TABLE IF EXISTS `vehicles_fuel_and_expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_fuel_and_expenses` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `vehicle_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `expense_type_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `vehicle_fae_date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `vehicle_fae_mileage` int(11) NOT NULL,
  `vehicle_fae_expense` double DEFAULT NULL,
  `vehicle_fae_price` double NOT NULL,
  `vehicle_fae_time_of_user` int(11) DEFAULT NULL,
  `created_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_2DF78058A76ED395` (`user_id`),
  KEY `IDX_2DF78058545317D1` (`vehicle_id`),
  KEY `IDX_2DF78058A857C7A9` (`expense_type_id`),
  CONSTRAINT `FK_2DF78058545317D1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles_vehicles` (`id`),
  CONSTRAINT `FK_2DF78058A76ED395` FOREIGN KEY (`user_id`) REFERENCES `vehicles_users` (`id`),
  CONSTRAINT `FK_2DF78058A857C7A9` FOREIGN KEY (`expense_type_id`) REFERENCES `vehicles_expense_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_fuel_and_expenses`
--

LOCK TABLES `vehicles_fuel_and_expenses` WRITE;
/*!40000 ALTER TABLE `vehicles_fuel_and_expenses` DISABLE KEYS */;
INSERT INTO `vehicles_fuel_and_expenses` VALUES ('1eb83c05-825b-4b05-9594-12f0997ba394',NULL,'9c77a2d2-8123-4fe5-8fd3-2102416ce195','16a66182-683f-4276-aa5c-3a5e36bee8e7','2020-08-28 00:00:00',144222,40.23,144.23,NULL,'2022-09-20 16:33:22','2022-09-20 16:33:22'),('354b3b5a-da65-4e01-8678-aae4bca6dec4',NULL,'9c77a2d2-8123-4fe5-8fd3-2102416ce195','16a66182-683f-4276-aa5c-3a5e36bee8e7','2020-09-28 00:00:00',146123,35.53,145.23,NULL,'2022-09-20 16:33:22','2022-09-20 16:33:22'),('3989e8dd-c2ee-45ca-adc3-5b73258ec58e',NULL,'9c77a2d2-8123-4fe5-8fd3-2102416ce195','16a66182-683f-4276-aa5c-3a5e36bee8e7','2020-08-14 00:00:00',143000,33.13,142.52,NULL,'2022-09-20 16:33:22','2022-09-20 16:33:22'),('66c4b042-04b1-45fd-b192-5028cf8db4f2','0048ea0f-1a7a-47f9-8f30-2d75e842de1d','9c77a2d2-8123-4fe5-8fd3-2102416ce195','68b35163-0fd0-4cb1-b799-0eab989f1ef6','2020-08-30 00:00:00',145443,100,2500,60,'2022-09-20 16:33:22','2022-09-20 16:33:22'),('b015e214-7fe0-4b68-9e0f-5cc58767e714',NULL,'9c77a2d2-8123-4fe5-8fd3-2102416ce195','16a66182-683f-4276-aa5c-3a5e36bee8e7','2020-09-28 00:00:00',147565,38.46,146.01,NULL,'2022-09-20 16:33:22','2022-09-20 16:33:22'),('cdaf5673-c8bb-416d-9a64-9c3d04193d45','0048ea0f-1a7a-47f9-8f30-2d75e842de1d','9c77a2d2-8123-4fe5-8fd3-2102416ce195','100917df-b6a9-47d8-89ef-770f867125f2','2020-09-28 00:00:00',145443,20.25,360,30,'2022-09-20 16:33:22','2022-09-20 16:33:22');
/*!40000 ALTER TABLE `vehicles_fuel_and_expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_history_of_changes`
--

DROP TABLE IF EXISTS `vehicles_history_of_changes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_history_of_changes` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  PRIMARY KEY (`id`),
  KEY `IDX_7D2079C4A76ED395` (`user_id`),
  CONSTRAINT `FK_7D2079C4A76ED395` FOREIGN KEY (`user_id`) REFERENCES `vehicles_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_history_of_changes`
--

LOCK TABLES `vehicles_history_of_changes` WRITE;
/*!40000 ALTER TABLE `vehicles_history_of_changes` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicles_history_of_changes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_images`
--

DROP TABLE IF EXISTS `vehicles_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_images` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `vehicle_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `image_file` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_extension` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_size` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A886739F545317D1` (`vehicle_id`),
  CONSTRAINT `FK_A886739F545317D1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles_vehicles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_images`
--

LOCK TABLES `vehicles_images` WRITE;
/*!40000 ALTER TABLE `vehicles_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicles_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_maintenance_parts`
--

DROP TABLE IF EXISTS `vehicles_maintenance_parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_maintenance_parts` (
  `maintenance_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `part_and_service_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  PRIMARY KEY (`maintenance_id`,`part_and_service_id`),
  KEY `IDX_12C65907F6C202BC` (`maintenance_id`),
  KEY `IDX_12C65907E09297D9` (`part_and_service_id`),
  CONSTRAINT `FK_12C65907E09297D9` FOREIGN KEY (`part_and_service_id`) REFERENCES `vehicles_part_services` (`id`),
  CONSTRAINT `FK_12C65907F6C202BC` FOREIGN KEY (`maintenance_id`) REFERENCES `vehicles_maintenances` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_maintenance_parts`
--

LOCK TABLES `vehicles_maintenance_parts` WRITE;
/*!40000 ALTER TABLE `vehicles_maintenance_parts` DISABLE KEYS */;
INSERT INTO `vehicles_maintenance_parts` VALUES ('080b7078-6343-4ab7-b3e0-2631ac2b46fd','86856dff-4fac-496e-9917-a37ec63992a4'),('080b7078-6343-4ab7-b3e0-2631ac2b46fd','9b2fb0cf-ad1b-4a07-964f-16b6a92e6a24'),('59a83ccf-cd79-4011-9dfc-52576f16405c','86856dff-4fac-496e-9917-a37ec63992a4'),('59a83ccf-cd79-4011-9dfc-52576f16405c','955edf40-8ff1-4b15-aeaa-94e4fa8d8bad'),('8021464b-81bd-424e-984d-7e23338c32c8','955edf40-8ff1-4b15-aeaa-94e4fa8d8bad'),('8021464b-81bd-424e-984d-7e23338c32c8','9b2fb0cf-ad1b-4a07-964f-16b6a92e6a24'),('930c0e01-ec13-40f5-aeba-812ef49adf54','86856dff-4fac-496e-9917-a37ec63992a4'),('930c0e01-ec13-40f5-aeba-812ef49adf54','9ca35af8-9545-46bf-ad29-40c856f7baf7'),('a4726bba-7df5-4c35-8091-2b2ba23b7968','955edf40-8ff1-4b15-aeaa-94e4fa8d8bad'),('a4726bba-7df5-4c35-8091-2b2ba23b7968','9b2fb0cf-ad1b-4a07-964f-16b6a92e6a24'),('bd83f5fb-1227-45bc-8610-c3224510ebaf','9b2fb0cf-ad1b-4a07-964f-16b6a92e6a24');
/*!40000 ALTER TABLE `vehicles_maintenance_parts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_maintenance_types`
--

DROP TABLE IF EXISTS `vehicles_maintenance_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_maintenance_types` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `vehicle_mt_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_maintenance_types`
--

LOCK TABLES `vehicles_maintenance_types` WRITE;
/*!40000 ALTER TABLE `vehicles_maintenance_types` DISABLE KEYS */;
INSERT INTO `vehicles_maintenance_types` VALUES ('4443b0d2-bdfe-4854-a594-373af7cc61a2','Tires'),('6d4dbba3-bd3e-4bb2-b9b2-396ee5b2e5ab','Hygiene'),('c2734392-1cfd-4377-a9e3-5a16c672720b','Not regular'),('e5e29b82-94eb-4551-8f04-14485e78c910','Regular');
/*!40000 ALTER TABLE `vehicles_maintenance_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_maintenances`
--

DROP TABLE IF EXISTS `vehicles_maintenances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_maintenances` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `type_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `vehicle_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `vehicle_maintenance_date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `vehicle_maintenance_mileage` int(11) NOT NULL,
  `vehicle_maintenance_fee` double NOT NULL,
  `vehicle_maintenance_time_of_user` int(11) DEFAULT NULL,
  `created_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_28ECC7B9A76ED395` (`user_id`),
  KEY `IDX_28ECC7B9C54C8C93` (`type_id`),
  KEY `IDX_28ECC7B9545317D1` (`vehicle_id`),
  CONSTRAINT `FK_28ECC7B9545317D1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles_vehicles` (`id`),
  CONSTRAINT `FK_28ECC7B9A76ED395` FOREIGN KEY (`user_id`) REFERENCES `vehicles_users` (`id`),
  CONSTRAINT `FK_28ECC7B9C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `vehicles_maintenance_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_maintenances`
--

LOCK TABLES `vehicles_maintenances` WRITE;
/*!40000 ALTER TABLE `vehicles_maintenances` DISABLE KEYS */;
INSERT INTO `vehicles_maintenances` VALUES ('080b7078-6343-4ab7-b3e0-2631ac2b46fd','0048ea0f-1a7a-47f9-8f30-2d75e842de1d','4443b0d2-bdfe-4854-a594-373af7cc61a2','9c77a2d2-8123-4fe5-8fd3-2102416ce195','2020-10-10 00:00:00',161223,2547,60,'2022-09-20 16:33:22','2022-09-20 16:33:22'),('59a83ccf-cd79-4011-9dfc-52576f16405c','0048ea0f-1a7a-47f9-8f30-2d75e842de1d','c2734392-1cfd-4377-a9e3-5a16c672720b','9c77a2d2-8123-4fe5-8fd3-2102416ce195','2020-08-16 00:00:00',156343,56232,320,'2022-09-20 16:33:22','2022-09-20 16:33:22'),('8021464b-81bd-424e-984d-7e23338c32c8','0048ea0f-1a7a-47f9-8f30-2d75e842de1d','e5e29b82-94eb-4551-8f04-14485e78c910','9c77a2d2-8123-4fe5-8fd3-2102416ce195','2020-10-17 00:00:00',163000,17454,120,'2022-09-20 16:33:22','2022-09-20 16:33:22'),('930c0e01-ec13-40f5-aeba-812ef49adf54','0048ea0f-1a7a-47f9-8f30-2d75e842de1d','e5e29b82-94eb-4551-8f04-14485e78c910','9c77a2d2-8123-4fe5-8fd3-2102416ce195','2019-08-19 00:00:00',143000,18343,160,'2022-09-20 16:33:22','2022-09-20 16:33:22'),('a4726bba-7df5-4c35-8091-2b2ba23b7968','0048ea0f-1a7a-47f9-8f30-2d75e842de1d','e5e29b82-94eb-4551-8f04-14485e78c910','9c77a2d2-8123-4fe5-8fd3-2102416ce195','2020-03-12 00:00:00',153000,19223,180,'2022-09-20 16:33:22','2022-09-20 16:33:22'),('bd83f5fb-1227-45bc-8610-c3224510ebaf','0048ea0f-1a7a-47f9-8f30-2d75e842de1d','6d4dbba3-bd3e-4bb2-b9b2-396ee5b2e5ab','9c77a2d2-8123-4fe5-8fd3-2102416ce195','2020-08-28 00:00:00',158232,5624,60,'2022-09-20 16:33:22','2022-09-20 16:33:22');
/*!40000 ALTER TABLE `vehicles_maintenances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_part_services`
--

DROP TABLE IF EXISTS `vehicles_part_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_part_services` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FDE649B15E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_part_services`
--

LOCK TABLES `vehicles_part_services` WRITE;
/*!40000 ALTER TABLE `vehicles_part_services` DISABLE KEYS */;
INSERT INTO `vehicles_part_services` VALUES ('9ca35af8-9545-46bf-ad29-40c856f7baf7','Accumulator'),('86856dff-4fac-496e-9917-a37ec63992a4','Car oil'),('9b2fb0cf-ad1b-4a07-964f-16b6a92e6a24','Filters'),('955edf40-8ff1-4b15-aeaa-94e4fa8d8bad','Painting'),('769988d1-6653-4060-95b9-0f185a858765','Parts replacement'),('6a02f5dd-d3ad-4cc0-8686-160b29558178','Replacement of the air conditioner'),('57ffbfa8-95be-4be7-97a1-81531aee4236','Replacing winter tires with summer tires'),('3566ac55-3437-40ea-bb1d-9ada8a35d834','Tiles');
/*!40000 ALTER TABLE `vehicles_part_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_registrations`
--

DROP TABLE IF EXISTS `vehicles_registrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_registrations` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `vehicle_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `user_vehicle_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `vehicle_registration_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_registration_start_date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `vehicle_registration_expire` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `vehicle_registration_fee` int(11) NOT NULL,
  `vehicle_time_of_user` int(11) NOT NULL,
  `vehicle_registration_active` tinyint(1) NOT NULL,
  `created_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_4A587C40545317D1` (`vehicle_id`),
  KEY `IDX_4A587C40F334D13D` (`user_vehicle_id`),
  CONSTRAINT `FK_4A587C40545317D1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles_vehicles` (`id`),
  CONSTRAINT `FK_4A587C40F334D13D` FOREIGN KEY (`user_vehicle_id`) REFERENCES `vehicles_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_registrations`
--

LOCK TABLES `vehicles_registrations` WRITE;
/*!40000 ALTER TABLE `vehicles_registrations` DISABLE KEYS */;
INSERT INTO `vehicles_registrations` VALUES ('67294cea-164f-48bb-89c4-25febbfca7ed','9c77a2d2-8123-4fe5-8fd3-2102416ce195','0048ea0f-1a7a-47f9-8f30-2d75e842de1d','AR-1045-IJ','2019-11-06 00:00:00','2020-11-06 00:00:00',20540,120,0,'2022-09-20 16:33:22','2022-09-20 16:33:22'),('7c5873b9-6f0a-4ec1-9da3-ed62b3aaa0ab','a1ecd0dc-121b-4659-84e1-de5b3ac35a32','115ce5e3-a3b7-409f-9c70-a01acea2be0d','GM-1661-MH','2021-05-20 00:00:00','2022-05-20 00:00:00',44040,45,0,'2022-09-20 16:33:22','2022-09-20 16:33:22'),('863128d1-b1f4-43e9-ae50-4a787d28f01d','fa6acc18-fb80-45c9-876f-60f0271fcd12','115ce5e3-a3b7-409f-9c70-a01acea2be0d','NS-1414-IJ','2022-01-07 00:00:00','2023-01-07 00:00:00',40654,180,1,'2022-09-20 16:33:22','2022-09-20 16:33:22'),('9289fd62-7712-4a58-9159-119fd21242ce','9c77a2d2-8123-4fe5-8fd3-2102416ce195','34d8b2c5-a3d4-46d4-876b-a565279e8d24','BG-4021-PP','2020-12-25 00:00:00','2021-12-25 00:00:00',30500,90,0,'2022-09-20 16:33:22','2022-09-20 16:33:22');
/*!40000 ALTER TABLE `vehicles_registrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_types`
--

DROP TABLE IF EXISTS `vehicles_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_types` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `brand_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_72CB379744F5D008` (`brand_id`),
  CONSTRAINT `FK_72CB379744F5D008` FOREIGN KEY (`brand_id`) REFERENCES `vehicles_brands` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_types`
--

LOCK TABLES `vehicles_types` WRITE;
/*!40000 ALTER TABLE `vehicles_types` DISABLE KEYS */;
INSERT INTO `vehicles_types` VALUES ('1bf16a24-d9ca-414d-ba0d-11056c6a1bd8','018be199-41c5-4f8a-90de-9b4a46d84b5f','A4','2022-09-20 16:33:22','2022-09-20 16:33:22'),('3ab768a3-d125-47da-8704-9ce14cac4be8','00522c24-0212-409c-9b6f-162cd7056251','Plavi stari','2022-09-20 16:33:22','2022-09-20 16:33:22'),('449bbac3-b263-42d7-86db-8c96fce2d50d','1be9b276-a434-4140-86ff-006d2a1c150f','X5','2022-09-20 16:33:22','2022-09-20 16:33:22'),('806f265b-57f1-4e47-b3bc-e47c21f6bc01','1be9b276-a434-4140-86ff-006d2a1c150f','320D','2022-09-20 16:33:22','2022-09-20 16:33:22'),('8281a7d8-d883-473a-b9f8-df43463133b2','018be199-41c5-4f8a-90de-9b4a46d84b5f','A6','2022-09-20 16:33:22','2022-09-20 16:33:22'),('8e851e58-f3d0-4122-8cc7-b7c0345bc11e','00522c24-0212-409c-9b6f-162cd7056251','Plavi novi','2022-09-20 16:33:22','2022-09-20 16:33:22'),('a5137a25-6313-4231-8eb2-fcb265f125d5','018be199-41c5-4f8a-90de-9b4a46d84b5f','A8','2022-09-20 16:33:22','2022-09-20 16:33:22'),('e5afd98c-5a78-4ea8-9fe9-552761c12699','1be9b276-a434-4140-86ff-006d2a1c150f','M3','2022-09-20 16:33:22','2022-09-20 16:33:22');
/*!40000 ALTER TABLE `vehicles_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_users`
--

DROP TABLE IF EXISTS `vehicles_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `vehicle_user_fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_user_username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_users`
--

LOCK TABLES `vehicles_users` WRITE;
/*!40000 ALTER TABLE `vehicles_users` DISABLE KEYS */;
INSERT INTO `vehicles_users` VALUES ('0048ea0f-1a7a-47f9-8f30-2d75e842de1d','Fern Turner I','jefferey57','ralph11@gmail.com'),('020129ba-8175-440d-83f4-bbeea9ea9a4a','Shawn Ondricka','hoppe.lacy','anderson.cathy@yahoo.com'),('02af49c0-ef20-4548-9db1-96c355973a25','Ms. Valentina Johns','pouros.reta','kihn.zelma@yahoo.com'),('0fe0f30c-a19b-4397-b574-83cd0b127ad4','Walker McKenzie','cormier.reginald','aniya.wisozk@yahoo.com'),('115ce5e3-a3b7-409f-9c70-a01acea2be0d','Karlee Dickinson','bechtelar.renee','kenna.olson@weissnat.com'),('34d8b2c5-a3d4-46d4-876b-a565279e8d24','Clarabelle Langworth','remington26','casper.eliseo@ernser.com'),('37b65607-b0bd-4d05-a6c9-89374eb519d3','System','system','system@dev-vehicle.com'),('38b817f7-1800-4811-be7c-5d2403966352','Dr. Abbey Zieme MD','bmorissette','schmitt.sarah@hotmail.com'),('478320a2-cda1-414d-bac2-acfbeda88bbd','Tara Haley DDS','pwillms','walter.susana@gmail.com'),('4ee2d320-0d5f-48c7-beaa-c537df93d751','Waldo Hansen','london.lind','cole.ryann@hintz.com'),('57658b86-a1e6-4172-8bed-1caf58ff241b','Raymundo Braun','molson','shudson@swaniawski.com'),('5952f5ad-ef99-49b2-b54f-68e73f2374cc','Administrator','admin','admin@dev-vehicle.com'),('5baefbae-8ecb-4e4b-ab6f-c3bf67e3cf32','Caitlyn Nikolaus MD','hane.andreane','derrick.schaefer@harris.net'),('5f46851d-ab24-45b3-b7ee-e70c04e6c443','Prof. Westley Towne','predovic.anissa','brown.domenic@kemmer.com'),('6217f9f2-fb30-4b83-bcb9-443d027f054c','Lane Oberbrunner MD','audreanne.greenfelder','marc.hand@brakus.org'),('69a498e7-ccc8-4c91-98df-104fa7a71a66','Furman Rodriguez','bethel03','don.hettinger@yahoo.com'),('7b39b6b0-57e2-44b9-ab73-72da2779a4b6','Marjory Bernhard','ckertzmann','adelia67@nitzsche.com'),('7cead9cb-4a5b-42e4-abf4-cf8d745909a9','Quinn Volkman','roob.kaylie','rkemmer@gmail.com'),('8d974062-7c5c-41ed-9136-945a2dd0314d','Alanna Bashirian','fjohnson','pkautzer@considine.net'),('9060c3b7-aee6-45fc-a9a5-b265e8791247','Letitia Orn','moshe01','mmohr@hotmail.com'),('91295475-77be-4ee6-9b59-e5fe6fdd978b','Lupe Conn','sipes.rubye','hrenner@hills.com'),('a7da0d62-e428-4166-8a31-1ec5fc9b3a7d','Jewel Gibson','kenyatta.cruickshank','bkuhn@morar.com'),('b00ede63-c1d6-4401-b912-b17eafc86e64','Ana Nienow PhD','hmayer','carrie47@gmail.com'),('bd789b7d-068d-438d-b815-75acb304a40f','Eldridge Zboncak','bmurray','crooks.laury@homenick.com'),('c4586436-f7f3-4674-8432-d5c21cb1c7ef','Blanca Treutel','vkutch','lubowitz.yasmine@kub.net'),('c9e865f4-5fba-47d3-b624-0e5bbd37df89','Prof. Florian Boehm Sr.','torphy.ena','dedric70@mcclure.com'),('e5629311-091b-49bf-80c6-aabf517ef9d6','Cordia Nader DVM','sanford.cummerata','schaden.ivy@gmail.com'),('e6827452-356d-4f70-8626-eb61b247ba7d','Katelin Crona','bobby39','cordia.auer@rolfson.com'),('f30817ce-4e88-47e1-9642-f4b49f158728','Adriel Muller','rozella86','vmitchell@gmail.com'),('fe5554c7-e249-48d4-8489-b4c5f436de49','Weldon Hagenes','muller.josh','dicki.lukas@huels.com'),('fef60133-715e-4d99-ad07-2a89428ca30b','Rahul Becker','huels.prudence','cremin.mae@medhurst.com'),('ff43934e-aef0-4cd0-831f-fd34cba9eabe','Clarabelle Satterfield','icole','oberbrunner.adah@wilderman.com');
/*!40000 ALTER TABLE `vehicles_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_vehicles`
--

DROP TABLE IF EXISTS `vehicles_vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_vehicles` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `type_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `color_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:uuid)',
  `vehicle_price` int(11) NOT NULL,
  `vehicle_engine_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_chasiss_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_year_of_production` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_active_to` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `vehicle_active_from` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `created_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_on` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_93D08A96C54C8C93` (`type_id`),
  KEY `IDX_93D08A967ADA1FB5` (`color_id`),
  CONSTRAINT `FK_93D08A967ADA1FB5` FOREIGN KEY (`color_id`) REFERENCES `vehicles_colors` (`id`),
  CONSTRAINT `FK_93D08A96C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `vehicles_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_vehicles`
--

LOCK TABLES `vehicles_vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles_vehicles` DISABLE KEYS */;
INSERT INTO `vehicles_vehicles` VALUES ('9c77a2d2-8123-4fe5-8fd3-2102416ce195','1bf16a24-d9ca-414d-ba0d-11056c6a1bd8','0e8955a4-2ff5-45c4-b39c-7a66ab7551e2',5650720,'WAUYSZZ3DSWN04SD39','OASM90PASKDPASDAS0D90213','2011','2021-10-15 00:00:00','2019-10-05 00:00:00','2022-09-20 16:33:22','2022-09-20 16:33:22'),('a1ecd0dc-121b-4659-84e1-de5b3ac35a32','806f265b-57f1-4e47-b3bc-e47c21f6bc01','5ad37e93-a80d-4c12-8b95-d4c6751e6901',14250130,'WVGPDS8SP4S5SDZ52','ASDPOASDPOASJUDASDDA1231LJASD','2020',NULL,'2021-05-05 00:00:00','2022-09-20 16:33:22','2022-09-20 16:33:22'),('a46c5a62-7a5a-417c-a812-f15e5b4ee53b','806f265b-57f1-4e47-b3bc-e47c21f6bc01','2da56106-46be-4940-859f-8f33345d590b',22950830,'WVWZZZ1JZ3W386752','ODHJSOJOASJASDASDPOASJADSOAS','2022',NULL,'2022-06-02 00:00:00','2022-09-20 16:33:22','2022-09-20 16:33:22'),('fa6acc18-fb80-45c9-876f-60f0271fcd12','806f265b-57f1-4e47-b3bc-e47c21f6bc01','0e8955a4-2ff5-45c4-b39c-7a66ab7551e2',9150100,'WAUZZZ4BZWN049087','OASDJOASDDASDLASDKL','2014','2022-10-15 00:00:00','2019-10-05 00:00:00','2022-09-20 16:33:22','2022-09-20 16:33:22'),('fecbd00e-5d4b-4009-88dd-9f419967425b','1bf16a24-d9ca-414d-ba0d-11056c6a1bd8','2da56106-46be-4940-859f-8f33345d590b',20200130,'SDA021312332N','28103373N','2019',NULL,'2017-10-05 00:00:00','2022-09-20 16:33:22','2022-09-20 16:33:22');
/*!40000 ALTER TABLE `vehicles_vehicles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_vehicles_users`
--

DROP TABLE IF EXISTS `vehicles_vehicles_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_vehicles_users` (
  `vehicle_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:uuid)',
  PRIMARY KEY (`vehicle_id`,`user_id`),
  KEY `IDX_77D3AB28545317D1` (`vehicle_id`),
  KEY `IDX_77D3AB28A76ED395` (`user_id`),
  CONSTRAINT `FK_77D3AB28545317D1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles_vehicles` (`id`),
  CONSTRAINT `FK_77D3AB28A76ED395` FOREIGN KEY (`user_id`) REFERENCES `vehicles_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_vehicles_users`
--

LOCK TABLES `vehicles_vehicles_users` WRITE;
/*!40000 ALTER TABLE `vehicles_vehicles_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicles_vehicles_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-21  9:42:51