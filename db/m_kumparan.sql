/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100132
 Source Host           : localhost:3306
 Source Schema         : m_kumparan

 Target Server Type    : MySQL
 Target Server Version : 100132
 File Encoding         : 65001

 Date: 13/01/2019 21:23:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for keys
-- ----------------------------
DROP TABLE IF EXISTS `keys`;
CREATE TABLE `keys`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `date_created` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of keys
-- ----------------------------
INSERT INTO `keys` VALUES (1, 0, 'putra@123', 0, 0, 0, NULL, '2017-10-12 13:34:33');

-- ----------------------------
-- Table structure for map_news
-- ----------------------------
DROP TABLE IF EXISTS `map_news`;
CREATE TABLE `map_news`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_topic` int(255) NULL DEFAULT NULL,
  `id_news` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of map_news
-- ----------------------------
INSERT INTO `map_news` VALUES (50, 23, 28);
INSERT INTO `map_news` VALUES (51, 23, 29);
INSERT INTO `map_news` VALUES (52, 24, 29);

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `summary` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `date_created` datetime(0) NULL DEFAULT NULL,
  `status` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '1= draft,2=publish,3=deleted',
  `date_updated` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `date_published` datetime(0) NULL DEFAULT NULL,
  `date_deleted` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES (28, 'Kisah Obin, Anak Petani Kopi yang Lulus dari Columbia University', 'Kontaria Sijabat bersama suaminya, Nelson Sinuarit, tak pernah bermimpi bisa menginjakkan kaki di New York, Amerika Serikat. Keduanya merupakan petani kopi lulusan SD yang berasal dari Desa Barisan Nauli, Sumbul,  Kabupaten Dairi, Sumatera Utara. Sebuah d', '<p><span style=\"font-family: &quot;PT Serif&quot;, Georgia, serif; font-size: 16px; white-space: pre-wrap;\">Kontaria Sijabat bersama suaminya, Nelson Sinuarit, tak pernah bermimpi bisa menginjakkan kaki di New York, Amerika Serikat. Keduanya merupakan petani kopi lulusan SD yang berasal dari Desa Barisan Nauli, Sumbul,  Kabupaten Dairi, Sumatera Utara. Sebuah desa terpencil yang berjarak 139 km dari pusat Kota Medan. </span></p><p><span style=\"font-family: &quot;PT Serif&quot;, Georgia, serif; font-size: 16px; white-space: pre-wrap;\">Kedatangan keduanya ke negeri Paman Sam tentu bukanlah tanpa alasan. Keduanya mendarat di sana dalam rangka menghadiri wisuda buah hatinya, Robinson Sinurat, yang lulus dari Columbia University. </span></p><p><span style=\"font-family: &quot;PT Serif&quot;, Georgia, serif; font-size: 16px; white-space: pre-wrap;\">\"Bah, nungga di Amerika Serikat hami ate (wah, sudah tiba kita di Amerika),\" ucap Kontaria dalam bahasa batak saat pertama kali tiba di Bandara La Guardia, New York.</span><span style=\"font-family: &quot;PT Serif&quot;, Georgia, serif; font-size: 16px; white-space: pre-wrap;\"><br></span><br></p><p><br></p>', '2019-01-13 20:19:22', 'draft', NULL, NULL, NULL);
INSERT INTO `news` VALUES (29, 'Bak Cerita Sinetron, Romantisnya Ammar Zoni Lamar Irish Bella', 'Bak Cerita Sinetron, Romantisnya Ammar Zoni Lamar Irish Bella', '<p><span data-key=\"1689\" style=\"font-family: &quot;PT Serif&quot;, Georgia, serif; font-size: 16px; white-space: pre-wrap;\"><span data-slate-leaf=\"true\" data-offset-key=\"1689:0\"><span data-slate-content=\"true\">Ammar Zoni tampaknya tidak ingin berlama-lama pacaran dengan </span></span></span><a href=\"https://kumparan.com/topic/irish-bella\" target=\"_blank\" rel=\"noopener noreferrer\" class=\"renderNode__Link-luzk0j-0 brfThx LabelLinkweb-g6i50g-0 cujMCf\" to=\"https://kumparan.com/topic/irish-bella\" data-key=\"1690\" style=\"background-color: rgb(255, 255, 255); color: rgb(0, 165, 175); outline: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0.08); font-family: &quot;PT Serif&quot;, Georgia, serif; font-size: 16px; white-space: pre-wrap;\"><span data-key=\"1691\"><span data-slate-leaf=\"true\" data-offset-key=\"1691:0\"><span data-slate-content=\"true\">Irish Bella</span></span></span></a><span data-key=\"1692\" style=\"font-family: &quot;PT Serif&quot;, Georgia, serif; font-size: 16px; white-space: pre-wrap;\"><span data-slate-leaf=\"true\" data-offset-key=\"1692:0\"><span data-slate-content=\"true\">. Aktor 25 tahun itu langsung menunjukkan keseriusannya pada Irish Bella dan berniat menjadikan wanita pujaan hatinya itu sebagai pendamping hidupnya.</span></span></span></p><p><span class=\"track_paragraph components__TextParagraph-s1de2sbe-0 SXPvF Textweb__StyledText-sc-2upo8d-0 dABVaj\" color=\"regular\" style=\"-webkit-font-smoothing: antialiased; font-family: &quot;PT Serif&quot;, Georgia, serif; font-size: 1.6rem; margin: 0px; padding-bottom: 15px; width: 640px; display: block; white-space: pre-wrap;\"><span data-key=\"1695\"><span data-slate-leaf=\"true\" data-offset-key=\"1695:0\"><span data-slate-content=\"true\">Dalam video yang diunggah akun YouTube Cinta Suci Channel, Sabtu (12/1) kemarin, Ammar Zoni akhirnya melamar Irish Bella. Adegan romantis sekaligus mengharukan itu benar-benar terjadi di kehidupan nyata, bukan sebagai bagian dari sinetron </span></span><span data-slate-leaf=\"true\" data-offset-key=\"1695:1\"><em data-slate-mark=\"true\"><span data-slate-content=\"true\">Cinta Suci</span></em></span><span data-slate-leaf=\"true\" data-offset-key=\"1695:2\"><span data-slate-content=\"true\"> yang mereka bintangi bersama.</span></span></span></span></p><div style=\"color: rgb(51, 51, 51); font-family: &quot;PT Serif&quot;, Georgia, serif; font-size: 18px; white-space: pre-wrap;\"></div><p><span class=\"track_paragraph components__TextParagraph-s1de2sbe-0 SXPvF Textweb__StyledText-sc-2upo8d-0 dABVaj\" color=\"regular\" style=\"-webkit-font-smoothing: antialiased; font-family: &quot;PT Serif&quot;, Georgia, serif; font-size: 1.6rem; margin: 0px; padding-bottom: 15px; width: 640px; display: block; white-space: pre-wrap;\"><span data-key=\"1698\"><span data-slate-leaf=\"true\" data-offset-key=\"1698:0\"><span data-slate-content=\"true\">Di menit awal, tampak beberapa pemain sinetron </span></span><span data-slate-leaf=\"true\" data-offset-key=\"1698:1\"><em data-slate-mark=\"true\"><span data-slate-content=\"true\">Cinta Suci</span></em></span><span data-slate-leaf=\"true\" data-offset-key=\"1698:2\"><span data-slate-content=\"true\"> seperti Dinda Hauw, Sheila Rizkyana dan Renald Ramadhan menanti kedatangan Irish Bella di sebuah ruangan. Mereka mengaku ikut gugup jelang momen romantis lamaran Ammar Zoni dengan Irish Bella.</span></span></span></span></p><p><br></p>', '2019-01-13 20:28:42', 'publish', '2019-01-13 21:22:02', '2019-01-13 21:22:02', NULL);

-- ----------------------------
-- Table structure for topic
-- ----------------------------
DROP TABLE IF EXISTS `topic`;
CREATE TABLE `topic`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_created` timestamp(0) NULL DEFAULT NULL,
  `date_updated` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of topic
-- ----------------------------
INSERT INTO `topic` VALUES (23, 'Politik', '2019-01-12 17:15:22', '2019-01-12 18:21:39');
INSERT INTO `topic` VALUES (24, 'Startup Digital', '2019-01-12 18:21:26', '2019-01-12 20:24:12');

SET FOREIGN_KEY_CHECKS = 1;
