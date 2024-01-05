-- -------------------------------------------------------------
-- TablePlus 5.6.2(516)
--
-- https://tableplus.com/
--
-- Database: indotehnik
-- Generation Time: 2023-11-15 13:02:25.7610
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `master_permissions`;
CREATE TABLE `master_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;;

INSERT INTO `master_permissions` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'informasi_dashboard', '2023-11-14 15:15:21', '2023-11-14 15:15:21'),
(2, 'master_role', '2023-11-14 15:15:21', '2023-11-14 15:15:21'),
(3, 'master_permission_role', '2023-11-14 15:15:21', '2023-11-14 15:15:21'),
(4, 'master_pegawai', '2023-11-14 15:15:21', '2023-11-14 15:15:21'),
(5, 'master_operator', '2023-11-14 15:15:21', '2023-11-14 15:15:21'),
(6, 'master_mesin', '2023-11-14 15:15:21', '2023-11-14 15:15:21'),
(7, 'master_nomor_order', '2023-11-14 15:15:21', '2023-11-14 15:15:21'),
(8, 'qr', '2023-11-14 15:15:21', '2023-11-14 15:15:21'),
(9, 'laporan_detail_pengerjaan', '2023-11-14 15:15:21', '2023-11-14 15:15:21'),
(10, 'laporan_poin_karyawan', '2023-11-14 15:15:21', '2023-11-14 15:15:21'),
(11, 'laporan_reject', '2023-11-14 15:15:21', '2023-11-14 15:15:21'),
(12, 'laporan_reject_customer', '2023-11-14 15:15:21', '2023-11-14 15:15:21');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;