-- CREATE DATABASE ecoplus;
USE k5413684_ecoplus;

--
-- Table structure for table `bonus_history`
--

DROP TABLE IF EXISTS `bonus_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bonus_history` (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(7) NOT NULL,
  `tanggal` date NOT NULL,
  `sponsor` int(11) NOT NULL,
  `pasangan` int(11) NOT NULL,
  `matching` int(11) NOT NULL,
  `titik` int(11) NOT NULL,
  `idsponsor` varchar(100) NOT NULL,
  PRIMARY KEY (`history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=567 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `data_id`
--

DROP TABLE IF EXISTS `data_id`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_id` (
  `id` char(7) NOT NULL,
  `pin` char(6) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `id` varchar(10) NOT NULL,
  `sponsor` char(7) NOT NULL DEFAULT '0000000',
  `upline` char(7) NOT NULL DEFAULT '0000000',
  `posisi` char(5) NOT NULL,
  `downline_kiri` char(7) NOT NULL,
  `downline_kanan` char(7) NOT NULL,
  `tanggal_aktif` date NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `ktp` varchar(20) NOT NULL,
  `npwp` varchar(25) NOT NULL,
  `tanggal_lahir` varchar(20) NOT NULL,
  `kelamin` char(9) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kota` varchar(40) NOT NULL,
  `propinsi` varchar(15) NOT NULL,
  `kodepos` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `handphone` varchar(15) NOT NULL,
  `bank` varchar(60) NOT NULL,
  `atas_nama` varchar(25) NOT NULL,
  `no_rekening` varchar(60) NOT NULL,
  `nama_ahli_waris` varchar(25) NOT NULL,
  `hubungan_ahli_waris` varchar(15) NOT NULL,
  `volume_kiri` int(11) NOT NULL,
  `volume_kanan` int(11) NOT NULL,
  `jumlah_sponsor_akhir` int(11) NOT NULL,
  `jumlah_pasangan_akhir` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

-- Dump completed on 2018-05-26 11:58:07
