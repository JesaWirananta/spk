/*
SQLyog Ultimate v9.50 
MySQL - 5.5.5-10.4.22-MariaDB : Database - ahp_crisp_ci4
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ahp_crisp_ci4` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `ahp_crisp_ci4`;

/*Table structure for table `tb_alternatif` */

DROP TABLE IF EXISTS `tb_alternatif`;

CREATE TABLE `tb_alternatif` (
  `kode_alternatif` varchar(16) NOT NULL,
  `nama_alternatif` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `total` double DEFAULT NULL,
  PRIMARY KEY (`kode_alternatif`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tb_alternatif` */

insert  into `tb_alternatif`(`kode_alternatif`,`nama_alternatif`,`alamat`,`keterangan`,`total`) values ('A03','Alternatif 3','',NULL,0.3220290556954),('A01','Alternatif 1','','',0.46139756489914),('A02','Alternatif 2','',NULL,0.094791007381371),('A04','Alternatif 4','',NULL,0.39917510542008),('A05','Alternatif 5','',NULL,0.36631705162534),('A06','Alternatif 6','',NULL,0.10430914529904);

/*Table structure for table `tb_crisp` */

DROP TABLE IF EXISTS `tb_crisp`;

CREATE TABLE `tb_crisp` (
  `kode_crisp` varchar(16) NOT NULL,
  `kode_kriteria` varchar(16) DEFAULT NULL,
  `nama_crisp` varchar(255) DEFAULT NULL,
  `nilai_crisp` double DEFAULT NULL,
  PRIMARY KEY (`kode_crisp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_crisp` */

insert  into `tb_crisp`(`kode_crisp`,`kode_kriteria`,`nama_crisp`,`nilai_crisp`) values ('JA1','C05','<2 orang',0.63334572036725),('JA2','C05','>2-5 orang',0.26049795609934),('JA3','C05','>5 orang',0.10615632353341),('JP1','C03','<500.000/bln',0.72350605738496),('JP2','C03','1jt - 1.500.000/bln',0.19318605996184),('JP3','C03','>1.500.000/bln',0.083307882653203),('KR1','C02','Sangat Tidak Layak Huni',0.69653133430131),('KR2','C02','Tidak Layak Huni',0.23161395916795),('KR3','C02','Layak Huni',0.071854706530739),('PK1','C01','Petani',0.58195488726237),('PK2','C01','Buruh',0.31620718457284),('PK3','C01','Wiraswasta',0.1018379281648),('SP1','C04','Janda',0.66886446893547),('SP2','C04','Duda',0.26739926734601),('SP3','C04','Kawin',0.063736263718512);

/*Table structure for table `tb_kriteria` */

DROP TABLE IF EXISTS `tb_kriteria`;

CREATE TABLE `tb_kriteria` (
  `kode_kriteria` varchar(16) NOT NULL,
  `nama_kriteria` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`kode_kriteria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tb_kriteria` */

insert  into `tb_kriteria`(`kode_kriteria`,`nama_kriteria`) values ('C04','Status Pernikahan'),('C03','Jml. Penghasilan'),('C02','Kondisi Rumah'),('C01','Pekerjaan'),('C05','Jml Anggota Keluarga');

/*Table structure for table `tb_rel_alternatif` */

DROP TABLE IF EXISTS `tb_rel_alternatif`;

CREATE TABLE `tb_rel_alternatif` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode_alternatif` varchar(16) DEFAULT NULL,
  `kode_kriteria` varchar(16) DEFAULT NULL,
  `kode_crisp` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

/*Data for the table `tb_rel_alternatif` */

insert  into `tb_rel_alternatif`(`ID`,`kode_alternatif`,`kode_kriteria`,`kode_crisp`) values (1,'A01','C01','PK1'),(2,'A01','C02','KR2'),(4,'A01','C04','SP3'),(5,'A02','C01','PK3'),(6,'A02','C02','KR3'),(7,'A02','C03','JP3'),(8,'A02','C04','SP3'),(9,'A03','C01','PK2'),(10,'A03','C02','KR3'),(11,'A03','C03','JP1'),(12,'A03','C04','SP2'),(13,'A04','C01','PK1'),(14,'A04','C02','KR3'),(15,'A04','C03','JP1'),(16,'A04','C04','SP3'),(17,'A05','C01','PK2'),(18,'A05','C02','KR2'),(19,'A05','C03','JP1'),(20,'A05','C04','SP2'),(21,'A06','C01','PK3'),(22,'A06','C02','KR3'),(23,'A06','C03','JP2'),(24,'A06','C04','SP3'),(25,'A01','C05','JA1'),(26,'A02','C05','JA2'),(27,'A03','C05','JA1'),(28,'A04','C05','JA2'),(29,'A05','C05','JA1'),(30,'A06','C05','JA3'),(47,'A01','C03','JP1');

/*Table structure for table `tb_rel_crisp` */

DROP TABLE IF EXISTS `tb_rel_crisp`;

CREATE TABLE `tb_rel_crisp` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID1` varchar(255) DEFAULT NULL,
  `ID2` varchar(255) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=791 DEFAULT CHARSET=latin1;

/*Data for the table `tb_rel_crisp` */

insert  into `tb_rel_crisp`(`ID`,`ID1`,`ID2`,`nilai`) values (557,'SP1','KR3',1),(503,'PK3','KR3',1),(502,'PK2','KR3',1),(573,'SP2','JP3',1),(568,'PK1','SP1',1),(562,'JP1','SP1',1),(530,'KR2','JP2',1),(531,'KR3','JP2',1),(486,'PK3','KR2',1),(572,'SP2','JP2',1),(567,'KR3','SP1',1),(543,'JP3','PK3',1),(528,'JP1','JP2',5),(529,'KR1','JP2',1),(499,'KR1','KR3',7),(500,'KR2','KR3',5),(501,'PK1','KR3',1),(525,'JP2','PK1',1),(526,'JP2','PK2',1),(527,'JP2','PK3',1),(441,'PK1','PK2',3),(523,'JP2','KR2',1),(524,'JP2','KR3',1),(483,'KR1','KR2',5),(484,'PK1','KR2',1),(485,'PK2','KR2',1),(556,'SP1','KR2',1),(522,'JP2','KR1',1),(554,'SP1','JP3',1),(555,'SP1','KR1',1),(458,'PK2','PK3',5),(553,'SP1','JP2',1),(519,'PK3','JP1',1),(520,'JP2','JP1',0.2),(521,'JP2','JP2',1),(495,'KR3','PK3',1),(566,'KR2','SP1',1),(561,'SP1','SP1',1),(552,'SP1','JP1',1),(478,'KR2','PK2',1),(479,'KR2','PK3',1),(541,'JP3','PK1',1),(542,'JP3','PK2',1),(539,'JP3','KR2',1),(540,'JP3','KR3',1),(494,'KR3','PK2',1),(517,'PK1','JP1',1),(518,'PK2','JP1',1),(457,'PK1','PK3',4),(477,'KR2','PK1',1),(516,'KR3','JP1',1),(420,'PK1','PK1',1),(560,'SP1','PK3',1),(538,'JP3','KR1',1),(475,'KR2','KR1',0.2),(476,'KR2','KR2',1),(559,'SP1','PK2',1),(493,'KR3','PK1',1),(547,'KR2','JP3',1),(548,'KR3','JP3',1),(549,'PK1','JP3',1),(550,'PK2','JP3',1),(551,'PK3','JP3',1),(512,'JP1','PK2',1),(513,'JP1','PK3',1),(514,'KR1','JP1',1),(515,'KR2','JP1',1),(434,'PK2','PK2',1),(558,'SP1','PK1',1),(537,'JP3','JP3',1),(490,'KR3','KR1',0.142857142),(491,'KR3','KR2',0.2),(492,'KR3','KR3',1),(536,'JP3','JP2',0.333333333),(469,'PK1','KR1',1),(470,'PK2','KR1',1),(471,'PK3','KR1',1),(511,'JP1','PK1',1),(450,'PK3','PK3',1),(449,'PK3','PK2',0.2),(571,'SP2','JP1',1),(565,'KR1','SP1',1),(448,'PK3','PK1',0.25),(465,'KR1','PK3',1),(546,'KR1','JP3',1),(509,'JP1','KR2',1),(510,'JP1','KR3',1),(464,'KR1','PK2',1),(570,'PK3','SP1',1),(564,'JP3','SP1',1),(508,'JP1','KR1',1),(433,'PK2','PK1',0.333333333),(507,'JP1','JP1',1),(535,'JP3','JP1',0.142857142),(534,'PK3','JP2',1),(545,'JP2','JP3',3),(463,'KR1','PK1',1),(569,'PK2','SP1',1),(563,'JP2','SP1',1),(533,'PK2','JP2',1),(462,'KR1','KR1',1),(544,'JP1','JP3',7),(532,'PK1','JP2',1),(574,'SP2','KR1',1),(575,'SP2','KR2',1),(576,'SP2','KR3',1),(577,'SP2','PK1',1),(578,'SP2','PK2',1),(579,'SP2','PK3',1),(580,'SP2','SP1',0.333333333),(581,'SP2','SP2',1),(582,'JP1','SP2',1),(583,'JP2','SP2',1),(584,'JP3','SP2',1),(585,'KR1','SP2',1),(586,'KR2','SP2',1),(587,'KR3','SP2',1),(588,'PK1','SP2',1),(589,'PK2','SP2',1),(590,'PK3','SP2',1),(591,'SP1','SP2',3),(592,'SP3','JP1',1),(593,'SP3','JP2',1),(594,'SP3','JP3',1),(595,'SP3','KR1',1),(596,'SP3','KR2',1),(597,'SP3','KR3',1),(598,'SP3','PK1',1),(599,'SP3','PK2',1),(600,'SP3','PK3',1),(601,'SP3','SP1',0.111111111),(602,'SP3','SP2',0.2),(603,'SP3','SP3',1),(604,'JP1','SP3',1),(605,'JP2','SP3',1),(606,'JP3','SP3',1),(607,'KR1','SP3',1),(608,'KR2','SP3',1),(609,'KR3','SP3',1),(610,'PK1','SP3',1),(611,'PK2','SP3',1),(612,'PK3','SP3',1),(613,'SP1','SP3',9),(614,'SP2','SP3',5),(615,'JA1','JA1',1),(616,'JA1','JP1',1),(617,'JA1','JP2',1),(618,'JA1','JP3',1),(619,'JA1','KR1',1),(620,'JA1','KR2',1),(621,'JA1','KR3',1),(622,'JA1','PK1',1),(623,'JA1','PK2',1),(624,'JA1','PK3',1),(625,'JA1','SP1',1),(626,'JA1','SP2',1),(627,'JA1','SP3',1),(628,'JP1','JA1',1),(629,'JP2','JA1',1),(630,'JP3','JA1',1),(631,'KR1','JA1',1),(632,'KR2','JA1',1),(633,'KR3','JA1',1),(634,'PK1','JA1',1),(635,'PK2','JA1',1),(636,'PK3','JA1',1),(637,'SP1','JA1',1),(638,'SP2','JA1',1),(639,'SP3','JA1',1),(640,'JA2','JA1',0.333333333),(641,'JA2','JA2',1),(642,'JA2','JP1',1),(643,'JA2','JP2',1),(644,'JA2','JP3',1),(645,'JA2','KR1',1),(646,'JA2','KR2',1),(647,'JA2','KR3',1),(648,'JA2','PK1',1),(649,'JA2','PK2',1),(650,'JA2','PK3',1),(651,'JA2','SP1',1),(652,'JA2','SP2',1),(653,'JA2','SP3',1),(654,'JA1','JA2',3),(655,'JP1','JA2',1),(656,'JP2','JA2',1),(657,'JP3','JA2',1),(658,'KR1','JA2',1),(659,'KR2','JA2',1),(660,'KR3','JA2',1),(661,'PK1','JA2',1),(662,'PK2','JA2',1),(663,'PK3','JA2',1),(664,'SP1','JA2',1),(665,'SP2','JA2',1),(666,'SP3','JA2',1),(667,'JA3','JA1',0.2),(668,'JA3','JA2',0.333333333),(669,'JA3','JA3',1),(670,'JA3','JP1',1),(671,'JA3','JP2',1),(672,'JA3','JP3',1),(673,'JA3','KR1',1),(674,'JA3','KR2',1),(675,'JA3','KR3',1),(676,'JA3','PK1',1),(677,'JA3','PK2',1),(678,'JA3','PK3',1),(679,'JA3','SP1',1),(680,'JA3','SP2',1),(681,'JA3','SP3',1),(682,'JA1','JA3',5),(683,'JA2','JA3',3),(684,'JP1','JA3',1),(685,'JP2','JA3',1),(686,'JP3','JA3',1),(687,'KR1','JA3',1),(688,'KR2','JA3',1),(689,'KR3','JA3',1),(690,'PK1','JA3',1),(691,'PK2','JA3',1),(692,'PK3','JA3',1),(693,'SP1','JA3',1),(694,'SP2','JA3',1),(695,'SP3','JA3',1);

/*Table structure for table `tb_rel_kriteria` */

DROP TABLE IF EXISTS `tb_rel_kriteria`;

CREATE TABLE `tb_rel_kriteria` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID1` varchar(16) DEFAULT NULL,
  `ID2` varchar(16) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=171 DEFAULT CHARSET=latin1;

/*Data for the table `tb_rel_kriteria` */

insert  into `tb_rel_kriteria`(`ID`,`ID1`,`ID2`,`nilai`) values (106,'C03','C03',1),(114,'C02','C04',3),(109,'C04','C01',0.2),(113,'C01','C04',5),(115,'C03','C04',3),(112,'C04','C04',1),(108,'C02','C03',3),(111,'C04','C03',0.333333333),(110,'C04','C02',0.333333333),(107,'C01','C03',3),(103,'C01','C02',2),(104,'C03','C01',0.333333333),(105,'C03','C02',0.333333333),(100,'C01','C01',1),(101,'C02','C01',0.5),(102,'C02','C02',1),(116,'C05','C01',0.142857142),(117,'C05','C02',0.2),(118,'C05','C03',0.333333333),(119,'C05','C04',0.333333333),(120,'C05','C05',1),(121,'C01','C05',7),(122,'C02','C05',5),(123,'C03','C05',3),(124,'C04','C05',3);

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(16) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `level` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id_user`,`user`,`pass`,`level`) values (1,'admin','$2y$10$d7mlmv.6mFJc7tKOo385zugn.wfF1OraEbho1NbS2uIswQVpVgJoi','admin'),(2,'user','user','user');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
