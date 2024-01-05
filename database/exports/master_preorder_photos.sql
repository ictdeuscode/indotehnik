-- -------------------------------------------------------------
-- TablePlus 5.6.8(524)
--
-- https://tableplus.com/
--
-- Database: indotehnik
-- Generation Time: 2023-12-19 09:15:47.5080
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `master_preorder_photos`;
CREATE TABLE `master_preorder_photos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_master_preorder` int DEFAULT NULL,
  `url` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `master_preorder_photos` (`id`, `id_master_preorder`, `url`) VALUES
(1, 250, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-nomor-order/AnpOW.jpg'),
(2, 250, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-nomor-order/F1gnh.jpg'),
(3, 250, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-nomor-order/xWiLp.jpg'),
(4, 249, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-nomor-order/38qei.jpg'),
(5, 249, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-nomor-order/I1qTE.jpg'),
(7, 246, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-nomor-order/RXXao.jpg'),
(8, 248, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-nomor-order/5SkzK.jpg'),
(9, 248, 'https://indotehnik-proses.nos.wjv-1.neo.id/foto-nomor-order/VteG2.jpg');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;