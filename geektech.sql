-- MariaDB dump 10.19  Distrib 10.4.19-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: geektech
-- ------------------------------------------------------
-- Server version	10.4.19-MariaDB

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

--
-- Table structure for table `calificaciones`
--

DROP TABLE IF EXISTS `calificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idlibro` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `cali` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idcliente` (`idcliente`),
  KEY `idlibro` (`idlibro`),
  CONSTRAINT `calificaciones_ibfk_3` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`id`),
  CONSTRAINT `calificaciones_ibfk_4` FOREIGN KEY (`idlibro`) REFERENCES `libros` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calificaciones`
--

LOCK TABLES `calificaciones` WRITE;
/*!40000 ALTER TABLE `calificaciones` DISABLE KEYS */;
INSERT INTO `calificaciones` VALUES (8,4,1,4),(9,17,1,3);
/*!40000 ALTER TABLE `calificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descrip` varchar(200) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (5,'Ficción','Simulación de la realidad que realizan las obras como literarias, cinematográficas, historietísticas, de animación u de otro tipo, cuando presentan un mundo imaginario al receptor.','h.png',1),(6,'Novelas','Narración en prosa, generalmente extensa, que cuenta una historia de ficción o con un desarrollo más completo en cuanto al argumento y los personajes, que los relatos breves o cuentos.','novela.jpg',1),(7,'Enasayos','El ensayo es un tipo de texto en prosa que explora, analiza, interpreta o evalúa un tema. Se considera un género literario comprendido dentro del género didáctico. Las características clásicas más rep','en.jpg',1),(8,'Epopeya','La epopeya es un relato épico o narrativo, escrito la mayor parte de las veces en verso largo o prosa, que consiste en la narración extensa de acciones trascendentales o dignas de memoria para un pueb','j.jpg',1),(9,'Narración','Narración es la manera de contar una secuencia o una serie de acciones realizadas por unos personajes determinados a lo largo de un intervalo de tiempo determinado, es decir, se refiere lingüística o ','dasa.jpg',1),(10,'Mangas','Los cómics tradicionales japoneses se denominan manga, una palabra nipona que significa literalmente dibujos irresponsables. Su paternidad se atribuye al artista del siglo XVIII Hokusai, aunque los ma','Manga.jpg',0),(11,'Romance','Historia debe centrarse en la relación y el amor romántico que surge entre dos seres humanos. La asociación estadounidense antes mencionada considera que, actualmente, no debe centrarse sólo en el amo','d.jpg',1),(12,'Tecnología ','Es el área de la ciencia que se encarga de estudiar la administración de métodos, técnicas y procesos con el fin de almacenar, procesar y transmitir información y datos en formato digital.','inn.jpg',1),(13,'Fantasía','Se conoce como literatura fantástica a cualquier relato en que participan fenómenos sobrenaturales y extraordinarios, como la magia o la intervención de criaturas inexistentes.','fan.jpg',1),(14,'Ciencia ficción','La ciencia ficción es un género narrativo que sitúa la acción en unas coordenadas espacio-temporales imaginarias y diferentes a las nuestras, y que especula racionalmente sobre posibles avances cientí','dsads.jpg',1);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `contra` varchar(200) NOT NULL,
  `tipo` int(11) NOT NULL,
  `ban` int(11) NOT NULL,
  `inten` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'miguel','miguel','gonzalez','miguelgr1019@gmail.com','defecto.png','$2y$10$Ff6az/b.3kedByqECzJ/ZO0LnnprZl6a86b74mFf924FfOS1Hw9N.',1,0,0),(2,'juan','juan','perez','j@g.com','defecto.png','$2y$10$uGnY5LC4yEWcpqer/Yil9OGRDsvR/bHkEfa4cAKH37u6jdATpnjYu',1,0,0),(4,'messi','messi','messi','me@gmail.com','defecto.png','$2y$10$M3gZYiLzVYh4lHq06wvPD.h9b2GZKTwR4ex.eBCUq2pLQ72wekKXq',1,0,0),(7,'xavi','xavi','hernandez','xa@gmail.com','xa.jpg','$2y$10$01jjpLHWpxWDVaLep7aAzO2M6nnYHRktHURk3T5UCFQZgLl4LpLlW',0,0,5),(8,'holaa','holaa','hola','h@g.com','xaa.jpg','$2y$10$Jj63L9wSJqBD/dQGoHR7ouTOM0PWZtem753CjmDv.X4vRKhGmlc8.',0,0,0),(10,'pedri','pedri','gonzalez','pe@g.com','16433631736458.jpg','$2y$10$bOBNY25/cuwcQTAO5aOveuLc9l4eTqc3H5jyaGEdkzxArjRsAah.q',0,0,0),(12,'aaaaa','aaaaa','aaaaa','aa@g.com','defecto.png','$2y$10$avuMAfqPoat1iMHQbMGy3ujWfiEOwjRDnQ.scPWtDVLjyFrxJvWdi',1,0,0),(13,'David','David','Romero','d@g.co','defecto.png','$2y$10$0Mfc/i/SMlCM6Cu5r8M4juluiHCUxKVZXwwEW5r308OfnkX5ZWafi',1,0,0);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `idlibro` int(11) NOT NULL,
  `comen` varchar(200) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idcliente` (`idcliente`),
  KEY `idlibro` (`idlibro`),
  CONSTRAINT `comentarios_ibfk_3` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`id`),
  CONSTRAINT `comentarios_ibfk_4` FOREIGN KEY (`idlibro`) REFERENCES `libros` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentarios`
--

LOCK TABLES `comentarios` WRITE;
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
INSERT INTO `comentarios` VALUES (18,1,4,'Que buen libro ','2022-06-01'),(19,1,17,'visca barca','2022-06-01');
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favoritos`
--

DROP TABLE IF EXISTS `favoritos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idlibro` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idcliente` (`idcliente`),
  KEY `idlibro` (`idlibro`),
  CONSTRAINT `favoritos_ibfk_3` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`id`),
  CONSTRAINT `favoritos_ibfk_4` FOREIGN KEY (`idlibro`) REFERENCES `libros` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favoritos`
--

LOCK TABLES `favoritos` WRITE;
/*!40000 ALTER TABLE `favoritos` DISABLE KEYS */;
INSERT INTO `favoritos` VALUES (39,4,1),(41,17,1),(42,4,2);
/*!40000 ALTER TABLE `favoritos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libros`
--

DROP TABLE IF EXISTS `libros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `nomar` varchar(150) NOT NULL,
  `sinopsis` varchar(500) NOT NULL,
  `numpa` int(11) NOT NULL,
  `imagen` varchar(150) NOT NULL,
  `premiun` int(11) NOT NULL,
  `idiomas` varchar(100) NOT NULL,
  `edicion` varchar(100) NOT NULL,
  `fechala` date NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idcategoria` (`idcategoria`),
  CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libros`
--

LOCK TABLES `libros` WRITE;
/*!40000 ALTER TABLE `libros` DISABLE KEYS */;
INSERT INTO `libros` VALUES (4,5,'Paulo Coelho','El alquimista','El_Alquimista_Cohelo_Paulo_z-lib.org (1).pdf','Considerado ya un clásico de nuestros días, El Alquimista relata las aventuras de Santiago, un joven pastor andaluz que un día emprende un viaje por las arenas del desierto en busca de un tesoro. Lo que empieza como la búsqueda de bienes mundanos se convertirá en el descubrimiento del tesoro interior.',106,'j.png',0,'Español','Primera edición ','1988-12-14',1),(5,6,'Miguel de Cervantes Saavedra','Don Quijote de la Mancha','Don_Quijote_de_la_Mancha_Cervantes_Saavedra_Miguel_de_z-lib.org.pdf','El ingenioso hidalgo don Quijote de la Mancha narra las aventuras de Alonso Quijano, un hidalgo pobre que de tanto leer novelas de caballería acaba enloqueciendo y creyendo ser un caballero andante, nombrándose a sí mismo como don Quijote de la Mancha.',950,'don.png',1,'Español','Primera Edición ','1605-01-01',1),(6,5,'Dan Brown','El Código Da Vinci','El_Codigo_Da_Vinci_Brown_Dan_z-lib.org.pdf','La mayor conspiración de los últimos 2000 años está a punto de ser desvelada. Robert Langdon recibe una llamada en mitad de la noche: el conservador del museo del Louvre ha sido asesinado en extrañas circunstancias y junto a su cadáver ha aparecido un desconcertante mensaje cifrado.',519,'da.png',1,'Español ','Primera edición ','2003-03-18',1),(7,7,'Karl Marx y Friedrich Engels','Manifiesto del Partido Comunista','Manifiesto_del_Partido_Comunista_Marx_Karl_Engels_Friedrich_z-lib.org.pdf','El manifiesto comunista es el documento base del pensamiento comunista, conformado por los pensamientos de Marx y Engels en materia política, económica y sociológica. En él se plasman los pilares tanto del socialismo originario como del marxismo.',62,'adsa.png',0,'Español ','Primera edición ','1848-02-21',1),(8,8,'Dante Alighieri','Divina comedia','La_Divina_Comedia_Dante_Alighieri_z-lib.org_1.pdf','Es una obra humana que refleja el peregrinaje del ser humano en busca de “la Luz”, es el descubrimiento del hombre hacia Dios, con la ayuda de la razón (Virgilio) y de la fe (Beatriz). El poema es una epopeya religiosa que narra con realismo un viaje, es un canto a la humanidad.',392,'dsd.png',1,'Español','Primera edición ','1307-01-01',1),(9,9,'Gabriel García Márquez','Cien años de soledad','Cien_anos_de_soledad_edicion_ilustrada_Gabriel_Garcia_Marquez_Luisa_Rivera_z-lib.org.pdf','Entre la boda de José Arcadio Buendía con Amelia Iguarán hasta la maldición de Aureliano Babilonia transcurre todo un siglo. Cien años de soledad para una estirpe única, fantástica, capaz de fundar una ciudad tan especial como Macondo y de engendrar niños con cola de cerdo.',438,'nn.png',1,'Español','Primera edición ','1967-03-05',1),(10,6,'George Orwell','1984','1984_George_Orwell_z-lib.org.pdf','Basada en la novela de Orwell, un hombre intenta conservar la esperanza en una sociedad totalitaria y represiva. Después de enamorarse de una joven, intentan mantener su amor vivo pero oculto del Gran Hermano que todo lo sabe. Este dictador oscuro y virtual pareciera conocer hasta lo que cada uno piensa en los rincones de la mente.',299,'dd.png',1,'Español','Primera Edición ','0000-00-00',1),(11,6,'Antoine de Saint-Exupéry','El principito','El_principito_Antoine_de_Saint-Exupery_z-lib.org.pdf','Narración corta del escritor francés Antoine de Saint-Exupéry, que trata de la historia de un pequeño príncipe que parte de su asteroide a una travesía por el universo, en la cual descubre la extraña forma en que los adultos ven la vida y comprende el valor del amor y la amistad.',64,'p.png',0,'Español ','Primera Edición ','1943-04-06',1),(12,9,'Franz Kafka','La metamorfosis','La_metamorfosis_Kafka_Franz_z-lib.org.pdf','La metamorfosis es un relato dividido en tres partes, donde se narra la transformación de Gregorio Samsa, un viajante de comercio de telas, en un monstruoso insecto, y el impacto que tendrá este acontecimiento no solo en su vida, sino en la de su familia.',56,'sdas.png',1,'Español ','Primera edición ','1915-10-01',1),(13,5,'Elísabet Benavent','Un cuento perfecto','Un_cuento_perfecto_Elisabet_Benavent_z-lib.org.pdf','Un ataque de pánico en un día bastante señalado hará que Margot (como la llaman sus hermanas Candela y Patricia) se calce sus Nike y salga corriendo.',570,'ccvx.png',0,'Español','Primera edición ','2020-02-20',1),(14,12,'Richard M. Stallman','Software libre para una sociedad libre','sl.pdf','es una colección de ensayos en los que, precisamente, se proponen y se analizan esos asuntos sociales y políticos que habitualmente quedan al margen del ámbito de la producción técnica.',318,'6630437.png',0,'Español ','Primera edición ','2004-01-01',1),(15,13,'V.E. Schwab','La vida invisible de Addie LaRue','La_vida_invisible_de_Addie_LaRue_Umbriel_narrativa_Spanish_Edition_V.E._Schwab_z-lib.org.pdf','Addie abandona su pequeño pueblo natal en la Francia del siglo xviii y comienza un viaje que la lleva por todo el mundo, mientras aprende a vivir una vida en la que nadie la recuerda y todo lo que posee acaba perdido o roto.',596,'lll.png',0,'Español ','Primera edición ','2020-10-06',1),(16,13,'Leigh Bardugo','Sombra y hueso','Sombra_y_hueso_Leigh_Bardugo_z-lib.org.pdf','Se quedó huérfana después de la guerra y lo único que tiene en el mundo es a su amigo Mal. A raíz de un ataque que recibe Mal al entrar en La Sombra, una oscuridad antinatural repleta de monstruos que ha aislado el país, Alina revela un poder latente que ni ella misma sabía que tenía.',287,'s.png',1,'Español','Primera edición ','2012-06-05',1),(17,5,'Marissa Meyer','Renegados','Renegados_Spanish_Edition_Marissa_Meyer_z-lib.org_1.pdf','Los Renegados son un sindicato de prodigios, humanos con habilidades extraordinarias, quienes surgieron de las ruinas de una sociedad destrozada y establecieron paz y orden donde reinaba el caos.Como campeones de la justicia, ellos son un símbolo de esperanza y coraje para todos... excepto para los villanos que alguna vez derrocaron.',639,'adsdsa.png',1,'Español ','Primera edición ','2015-12-14',1),(18,5,'Marissa Meyer','Archienemigos','Archienemigos_Marissa_Meyer_Marissa_Meyer_z-lib.org.pdf','La doble vida de Nova está a punto de volverse mucho más complicada. Como Insomnia, es una integrante de pleno derecho de los Renegados, un sindicato de poderosos y venerados superheroes.',405,'asdsa.png',1,'Español','Primera edición ','2015-12-14',1),(19,14,'Marissa Meyer','Supernova','Supernova_Marissa_Meyer_z-lib.org.pdf','Adrian y Nova deben luchar por mantener sus identidades en secreto. Mientras la batalla entre sus alter egos y sus aliados continúa, una amenaza aún mayor se eleva sobre Gatlon City: El peor enemigo de los Renegados ha regresado y amenaza con recuperar la ciudad',559,'vxcxc.png',1,'Español','Primera edición ','2019-10-29',1);
/*!40000 ALTER TABLE `libros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monto` float NOT NULL,
  `idcliente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `vence` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idcliente` (`idcliente`),
  CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (1,10,1,'2022-03-31','2022-03-31'),(2,10,7,'2022-04-04','2022-04-04'),(3,10,7,'2022-04-04','2022-04-04'),(4,10,7,'2022-04-04','2022-04-04'),(5,10,7,'2022-04-04','2022-04-04'),(6,10,7,'2022-04-04','2022-04-04'),(7,10,7,'2022-04-04','2022-04-04'),(8,10,7,'2022-04-04','2022-04-04'),(9,10,7,'2022-04-04','2022-04-04'),(10,10,7,'2022-04-04','2022-04-04'),(11,10,7,'2022-04-04','2022-04-04'),(12,10,7,'2022-04-04','2022-04-04'),(13,10,7,'2022-04-04','2022-04-04'),(14,10,8,'2022-04-04','2022-04-04'),(15,10,8,'2022-04-04','2022-04-04'),(16,10,8,'2022-04-04','2022-04-04'),(17,10,8,'2022-04-04','2022-04-04'),(18,10,8,'2022-04-04','2022-04-04'),(19,10,7,'2022-04-04','2022-04-04'),(20,10,7,'2022-04-04','2022-04-04'),(21,10,7,'2022-04-04','2022-04-04'),(22,10,7,'2022-04-04','2022-04-04'),(23,10,7,'2022-04-04','2022-04-04'),(24,10,8,'2022-04-04','2022-04-04'),(25,10,7,'2022-04-04','2022-04-04'),(26,10,7,'2022-04-04','2022-04-04'),(27,10,7,'2022-04-04','2022-04-04'),(28,10,12,'2022-04-05','2022-04-05'),(29,10,7,'2022-04-05','2022-04-05'),(30,10,12,'2022-04-06','2022-04-06'),(31,10,13,'2022-04-07','2022-04-07'),(32,10,1,'2022-05-30','2022-05-30'),(33,10,1,'2022-06-01','2022-06-01'),(34,10,1,'2022-06-01','2022-06-01'),(35,10,1,'2022-06-01','2022-07-01');
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promedio`
--

DROP TABLE IF EXISTS `promedio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promedio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_libro` int(11) NOT NULL,
  `pro` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_libro` (`id_libro`),
  CONSTRAINT `promedio_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promedio`
--

LOCK TABLES `promedio` WRITE;
/*!40000 ALTER TABLE `promedio` DISABLE KEYS */;
INSERT INTO `promedio` VALUES (5,4,4),(6,5,0),(7,6,0),(8,7,0),(9,8,0),(10,9,0),(11,10,0),(12,11,0),(13,12,0),(14,13,0),(15,14,0),(16,15,0),(17,16,0),(18,17,3),(19,18,0),(20,19,0);
/*!40000 ALTER TABLE `promedio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suscripcion`
--

DROP TABLE IF EXISTS `suscripcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suscripcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `costo` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suscripcion`
--

LOCK TABLES `suscripcion` WRITE;
/*!40000 ALTER TABLE `suscripcion` DISABLE KEYS */;
INSERT INTO `suscripcion` VALUES (1,10);
/*!40000 ALTER TABLE `suscripcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contra` varchar(200) NOT NULL,
  `tipo` int(11) NOT NULL,
  `inten` int(11) NOT NULL,
  `ban` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'miguel','miguel','gonzalez','miguelgr1019@gmail.com','$2y$10$.CVaEwMUfjwv8asIiNLZrO92oAz3ynU9BI2sov62BF5XknMy8sutq',1,0,0),(2,'juan','juan','perezz','j@g.com','$2y$10$wyflhXNj2t9bzyAVW5Bxm.q4lk70biOo35lVh.jyPrEbdxfUe/Zwq',0,0,0),(3,'angel','angel','romero','a@g.com','$2y$10$kZUgoCWD.OxofR1/0cxALOM7VNsInD9nFjswlsXphRjXrYme1EXpG',1,0,1),(5,'miguelgr','miguel','gonzalez','ma@gmail.com','$2y$10$0L2B/8YrGWWOtttlfjKqUecD599um/6xUHu6qUm/1KD678AMhBwiK',0,0,0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-02 15:49:43
