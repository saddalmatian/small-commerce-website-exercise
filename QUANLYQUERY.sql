-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: quanlydathang
-- ------------------------------------------------------
-- Server version	8.0.26

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
-- Table structure for table `chitietdathang`
--
DROP TABLE IF EXISTS `chitietdathang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chitietdathang` (
  `SoDonDH` char(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `SoLuong` int NOT NULL,
  `GiaDatHang` int NOT NULL,
  `GiamGia` int NOT NULL,
  `MSHH` char(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  KEY `fkmshh_idx` (`MSHH`),
  KEY `fksodondh_idx` (`SoDonDH`),
  CONSTRAINT `fkmshh` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fksodondh` FOREIGN KEY (`SoDonDH`) REFERENCES `dathang` (`SoDonDH`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `checksoluong` CHECK ((`SoLuong` <= `SoLuong`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chitietdathang`
--

LOCK TABLES `chitietdathang` WRITE;
/*!40000 ALTER TABLE `chitietdathang` DISABLE KEYS */;
/*!40000 ALTER TABLE `chitietdathang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dathang`
--

DROP TABLE IF EXISTS `dathang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dathang` (
  `SoDonDH` char(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `MSKH` char(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `MSNV` char(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `NgayDH` date NOT NULL,
  `NgayGH` date NOT NULL,
  `TrangThaiDH` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `DiaChi` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`SoDonDH`),
  KEY `fkmsnv` (`MSNV`),
  KEY `fkmskhdh_idx` (`MSKH`),
  CONSTRAINT `fkmskhdh` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkmsnv` FOREIGN KEY (`MSNV`) REFERENCES `nhanvien` (`MSNV`),
  CONSTRAINT `checkngay` CHECK ((`NgayDH` <= `NgayGH`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dathang`
--

LOCK TABLES `dathang` WRITE;
/*!40000 ALTER TABLE `dathang` DISABLE KEYS */;
/*!40000 ALTER TABLE `dathang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diachikh`
--

DROP TABLE IF EXISTS `diachikh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diachikh` (
  `MaDC` char(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `DiaChi` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `MSKH` char(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`MaDC`),
  KEY `fkmskhdc_idx` (`MSKH`),
  CONSTRAINT `fkmskhdc` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diachikh`
--

LOCK TABLES `diachikh` WRITE;
/*!40000 ALTER TABLE `diachikh` DISABLE KEYS */;
INSERT INTO `diachikh` VALUES ('CucLoanDC1','Thới Xuân, Cần Thơ','CucLoan'),('aaaDC1','zzzzz','aaa');
/*!40000 ALTER TABLE `diachikh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hanghoa`
--

DROP TABLE IF EXISTS `hanghoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hanghoa` (
  `MSHH` char(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `TenHH` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `QuyCach` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Gia` int NOT NULL,
  `SoLuongHang` int NOT NULL,
  `MaLoaiHang` char(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`MSHH`),
  KEY `fkmlh` (`MaLoaiHang`),
  CONSTRAINT `fkmlh` FOREIGN KEY (`MaLoaiHang`) REFERENCES `loaihanghoa` (`MaLoaiHang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hanghoa`
--

LOCK TABLES `hanghoa` WRITE;
/*!40000 ALTER TABLE `hanghoa` DISABLE KEYS */;
INSERT INTO `hanghoa` VALUES ('TD1','999 lá thư gửi cho chính mình','“999 lá thư gửi cho chính mình” là một tác phẩm đặc biệt đầy cảm hứng đến từ tác giả văn học mạng nổi tiếng Miêu Công Tử, mang một màu sắc riêng biệt qua những lời thư nhỏ nhắn nhủ đến người đọc về giá trị cuộc sống, tình yêu, tuổi trẻ, tương lai… đã làm lay động trái tim của hàng vạn độc giả trẻ.',25000,250,'TD'),('TD2','Mắt biếc','\"Mắt Biếc\" là câu chuyện kể về cuộc đời của nhân vật Ngạn. Sinh ra và lớn lên ở một ngôi làn tên Đo Đo (cũng là nguyên quán của Nguyễn Nhật Ánh - tác giả), Ngạn thầm yêu từ nhỏ cô nàng cùng xóm có đôi mắt tuyệt đẹp - Hà Lan. Tuổi thơ ở nơi làng xóm bình yên giản dị thật là đẹp, nhưng rồi cũng đến lúc kết thúc khi cả hai đều phải lên thành phố tiếp tục việc học, và tấm bi kịch bắt đầu từ đây.\n                    ',25000,245,'TD'),('TT1','Boku no hero Academy','Vào tương lai, lúc mà con người với những sức mạnh siêu nhiên là điều thường thấy quanh thế giới. Đây là câu chuyện về Izuku Midoriya, từ một kẻ bất tài trở thành một siêu anh hùng. Tất cả ta cần là mơ ước.',25000,247,'TT'),('TT2','Thám tử lừng danh Conan - Tập 86','Mở đầu câu truyện, cậu học sinh trung học 16 tuổi Shinichi Kudo bị biến thành cậu bé Conan Edogawa. Shinichi trong phần đầu của Thám tử lừng danh Conan được miêu tả là một thám tử học đường',25000,250,'TT'),('TT3','Shin cậu bé bút chì - Tập 19','Truyện tranh Shin cậu bé bút chì là truyện tranh của tác giả Usui Yoshito là câu chuyện của cậu bé năm tuổi Shinosuke trong một gia đình trung lưu Nhật Bản thông thường. Gia đình gồm có ba, mẹ, Shin, em gái và một chú chó. Cách vẽ và kể câu chuyện của Shin – Cậu bé bút chì vừa gần gũi, vui vẻ lại mang lại cách nhìn con trẻ vô cùng độc đáo.',35000,250,'TT'),('TT4','Black Clover','Aster và Yuno là hai đứa trẻ bị bỏ rơi ở nhà thờ và cùng nhau lớn lên tại đó. Khi còn nhỏ, chúng đã hứa với nhau xem ai sẽ trở thành Ma pháp vương tiếp theo. Thế nhưng, khi cả hai lớn lên, mọi sô chuyện đã thay đổi. Yuno là thiên tài ma pháp với sức mạnh tuyệt đỉnh trong khi Aster lại không thể sử dụng ma pháp và cố gắng bù đắp bằng thể lực.',35000,35,'TT'),('TT5','One punch man','Một Manga thể loại siêu anh hùng với đặc trưng phồng tôm đấm phát chết luôn... và mang đậm tính chất troll của tác giả.\r\nOnepunch-man là câu chuyện của 1 chàng thanh niên 23 tuổi, đang là một nhân viên văn phòng điển trai nghiêm túc và tất nhiên là ế. Không hiểu vì biến cố gì mà tự nhiên lông tóc trên người của anh trụi lủi, sau đó anh mang trong mình khả năng siêu đặc biệt \"Đấm phát chết luôn\" nhằm bảo vệ trái đất và thành phố nơi anh sinh sống khỏi các sinh vật ngoài không gian (nhưng phá hoại cũng không kém).',36000,36,'TT'),('TieuThuyet1','HÔN TRỘM 55 LẦN','Bạn đang đọc truyện Hôn Trộm 55 Lần của tác giả Diệp Phi Dạ. Lục Cẩn Niên và An Hảo kết hôn dưới sự thúc ép của cha mẹ hai bên. An Hảo cho rằng mặc dù bọn họ thờ ơ nhau ở trước mặt mọi người nhưng sau lưng rồi cũng sẽ quấn quít. Vì vậy vào đêm tân hôn, cô vừa mở miệng liền tuôn một tràng \"3 KHÔNG\".',35000,20,'TieuThuyet'),('TieuThuyet2','[Thập niên 70] Phúc Bảo','Thể loại: Ngôn tình, Điền Văn, Cận đại, Xuyên thư, Tình cảm, Ngọt sủng, Trọng sinh, Song khiết, Làm ruộng, Thanh mai trúc mã, Thiên chi kiêu tử, Tiểu bạch, 1v1.',25000,25,'TieuThuyet');
/*!40000 ALTER TABLE `hanghoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hinhhanghoa`
--

DROP TABLE IF EXISTS `hinhhanghoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hinhhanghoa` (
  `mahinh` char(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tenhinh` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `MSHH` char(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`mahinh`),
  KEY `fkmshh_hinhhanghoa_idx` (`MSHH`),
  CONSTRAINT `fkmshh_hinhhanghoa` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hinhhanghoa`
--

LOCK TABLES `hinhhanghoa` WRITE;
/*!40000 ALTER TABLE `hinhhanghoa` DISABLE KEYS */;
INSERT INTO `hinhhanghoa` VALUES ('MatBiec.jpg','MatBiec.jpg','TD2'),('black-clover_1552555341.jpg','black-clover_1552555341.jpg','TT4'),('boku-no-hero-academia_1552459650.jpg','boku-no-hero-academia_1552459650.jpg','TT1'),('conan.jpg','conan.jpg','TT2'),('hontrom55landJZglmVD17.jpg','hontrom55landJZglmVD17.jpg','TieuThuyet1'),('lathu.jpg','lathu.jpg','TD1'),('onepunch-man_1552232163.jpg','onepunch-man_1552232163.jpg','TT5'),('shin-19.jpg','shin-19.jpg','TT3'),('thapnien70phucbao1wx2KSmeAr.jpg','thapnien70phucbao1wx2KSmeAr.jpg','TieuThuyet2');
/*!40000 ALTER TABLE `hinhhanghoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `khachhang`
--

DROP TABLE IF EXISTS `khachhang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `khachhang` (
  `MSKH` char(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `HoTenKH` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `TenCongTy` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `SoDienThoai` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `SoFax` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Pass` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`MSKH`),
  UNIQUE KEY `SoDienThoai_UNIQUE` (`SoDienThoai`),
  UNIQUE KEY `HoTenKH_UNIQUE` (`HoTenKH`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `khachhang`
--

LOCK TABLES `khachhang` WRITE;
/*!40000 ALTER TABLE `khachhang` DISABLE KEYS */;
INSERT INTO `khachhang` VALUES ('CucLoan','Cúc Loan','Công ty cổ phần Sunlight','0914764104','1555124','123'),('aaa','aaa','','0123456789','','123');
/*!40000 ALTER TABLE `khachhang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loaihanghoa`
--

DROP TABLE IF EXISTS `loaihanghoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loaihanghoa` (
  `MaLoaiHang` char(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `TenLoaiHang` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`MaLoaiHang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loaihanghoa`
--

LOCK TABLES `loaihanghoa` WRITE;
/*!40000 ALTER TABLE `loaihanghoa` DISABLE KEYS */;
INSERT INTO `loaihanghoa` VALUES ('TD','Truyện đọc'),('TT','Truyện Tranh'),('TieuThuyet','Tiểu Thuyết');
/*!40000 ALTER TABLE `loaihanghoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nhanvien`
--

DROP TABLE IF EXISTS `nhanvien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nhanvien` (
  `MSNV` char(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `HoTenNV` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ChucVu` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `DiaChi` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `SoDienThoai` int NOT NULL,
  `Pass` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`MSNV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nhanvien`
--

LOCK TABLES `nhanvien` WRITE;
/*!40000 ALTER TABLE `nhanvien` DISABLE KEYS */;
INSERT INTO `nhanvien` VALUES ('NV001','Trần Đăng Giang Hòa','Nhân Viên','Tân Hiệp, Kiên Giang',914764104,'123456'),('NV002','Võ Khánh Quí','Nhân Viên','Ô Môn, Cần Thơ',945745681,'123457');
/*!40000 ALTER TABLE `nhanvien` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-21  8:06:44
