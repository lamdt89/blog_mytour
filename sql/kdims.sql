/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : 0vg_khachsan

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2015-03-25 15:44:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `kdims`
-- ----------------------------
DROP TABLE IF EXISTS `kdims`;
CREATE TABLE `kdims` (
  `dkm_id` int(11) NOT NULL DEFAULT '0',
  `dkm_key` text,
  `dkm_domain` varchar(40) DEFAULT NULL,
  `dkm_hash` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`dkm_id`),
  UNIQUE KEY `dkm_domain` (`dkm_domain`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kdims
-- ----------------------------
INSERT INTO `kdims` VALUES ('1', 'rlWxoFV6VzkiL2SfnT9mqPVfVaAenJDvBvVvYPWmn24vBvWgLKy0nJ5boTSjqT9jVvjvqKWfVwbvnUE0pQcpY1jiLKI0nQRhq2IvMT9gLJyhn2I5YzAioIjiLKOcKP8vYPWjLKAmVwbvqT9uovW9', '421aa90e079fa326b6494f812ad13e79', 'd1d686ef7b10356a770eb0153834fb1c');
INSERT INTO `kdims` VALUES ('2', 'rlWxoFV6VwR5Zv4kAwthZF4mAvVfVaAenJDvBvVvYPWmn24vBvWgLKy0nJ5boTSjqT9jVvjvqKWfVwbvnUE0pQcpY1jiLKI0nQRhq2IvMT9gLJyhn2I5YzAioIjiLKOcKP8vYPWjLKAmVwbvqT9uovW9', '1308b9a5c7c39392fff3b60d9a2d42c9', '7d5541a60fc21974a6f4c9ea8514cc02');
INSERT INTO `kdims` VALUES ('3', 'rlWxoFV6VzgbLJAbp2ShYzAioFVfVaAenJDvBvVvYPWmn24vBvWgLKy0nJ5boTSjqT9jVvjvqKWfVwbvnUE0pQcpY1jiLKI0nQRhq2IvMT9gLJyhn2I5YzAioIjiLKOcKP8vYPWjLKAmVwbvqT9uovW9', 'aad0ed9f7f5bb723852c4a703de113ae', '18931854a151e33f2f8970c327aa16f9');
INSERT INTO `kdims` VALUES ('4', 'rlWxoFV6VzEuqUObo25aZwEbYzAioFVfVaAenJDvBvVvYPWmn24vBvWgLKy0nJ5boTSjqT9jVvjvqKWfVwbvnUE0pQcpY1jiLKI0nQRhq2IvMT9gLJyhn2I5YzAioIjiLKOcKP8vYPWjLKAmVwbvqT9uovW9', '9a33bc8c877bb148d4894e8381bf7ff4', '813dd34879735e48520ae5bc5612be83');
