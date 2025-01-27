<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $sql = "
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for fb_base_attachment
-- ----------------------------
DROP TABLE IF EXISTS `fb_base_attachment`;
CREATE TABLE `fb_base_attachment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `driver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '存储位置',
  `upload_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '上传类型',
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件类型',
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '本地路径',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Url地址',
  `md5` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Md5值',
  `size` int(11) NOT NULL DEFAULT '1' COMMENT '文件大小',
  `ext` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '后缀',
  `year` int(11) NOT NULL DEFAULT '0' COMMENT '年份',
  `month` int(11) NOT NULL DEFAULT '0' COMMENT '月份',
  `day` int(11) NOT NULL DEFAULT '0' COMMENT '日',
  `width` int(11) NOT NULL DEFAULT '0' COMMENT '宽度',
  `height` int(11) NOT NULL DEFAULT '0' COMMENT '高度',
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '上传IP',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_attachment_fk2` (`store_id`),
  CONSTRAINT `base_attachment_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='文件';

-- ----------------------------
-- Table structure for fb_base_department
-- ----------------------------
DROP TABLE IF EXISTS `fb_base_department`;
CREATE TABLE `fb_base_department` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父节点',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'backend' COMMENT '子系统',
  `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介',
  `head` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '负责人',
  `vice_head` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '副负责人',
  `level` int(11) NOT NULL DEFAULT '1' COMMENT '层级',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_department_fk2` (`store_id`),
  CONSTRAINT `base_department_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='部门';

-- ----------------------------
-- Table structure for fb_base_dict
-- ----------------------------
DROP TABLE IF EXISTS `fb_base_dict`;
CREATE TABLE `fb_base_dict` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '代码',
  `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_dict_k2` (`store_id`),
  CONSTRAINT `base_dict_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='字典';

-- ----------------------------
-- Table structure for fb_base_dict_data
-- ----------------------------
DROP TABLE IF EXISTS `fb_base_dict_data`;
CREATE TABLE `fb_base_dict_data` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `dict_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '字典',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '代码',
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '值',
  `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_dict_data_k2` (`store_id`),
  KEY `base_dict_data_k1` (`dict_id`),
  CONSTRAINT `base_dict_data_fk1` FOREIGN KEY (`dict_id`) REFERENCES `fb_base_dict` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `base_dict_data_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='字典数据';

-- ----------------------------
-- Table structure for fb_base_log
-- ----------------------------
DROP TABLE IF EXISTS `fb_base_log`;
CREATE TABLE `fb_base_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Url',
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'GET' COMMENT '提交方式',
  `params` text COLLATE utf8mb4_unicode_ci COMMENT '请求数据',
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'UA信息',
  `agent_type` int(11) NOT NULL DEFAULT '200' COMMENT '终端类型',
  `ip` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'IP地址',
  `ip_info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'IP信息',
  `code` int(11) NOT NULL DEFAULT '200' COMMENT '返回码',
  `msg` mediumtext COMMENT '返回信息',
  `data` mediumtext COLLATE utf8mb4_unicode_ci COMMENT '数据',
  `cost_time` decimal(10,6) NOT NULL DEFAULT '1.000000' COMMENT '耗时',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_log_fk2` (`store_id`),
  CONSTRAINT `base_log_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='日志';

-- ----------------------------
-- Table structure for fb_base_message_type
-- ----------------------------
DROP TABLE IF EXISTS `fb_base_message_type`;
CREATE TABLE `fb_base_message_type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `send_type` int(11) NOT NULL DEFAULT '0' COMMENT '发送类型',
  `send_target` int(11) NOT NULL DEFAULT '1' COMMENT '发送对象',
  `send_user` text COLLATE utf8mb4_unicode_ci COMMENT '发送用户',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_message_type_fk2` (`store_id`),
  CONSTRAINT `base_message_type_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='消息类型';

-- ----------------------------
-- Table structure for fb_base_message
-- ----------------------------
DROP TABLE IF EXISTS `fb_base_message`;
CREATE TABLE `fb_base_message` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '用户',
  `from_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '发送用户',
  `message_type_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '消息',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_message_fk0` (`user_id`),
  KEY `base_message_fk9` (`from_id`),
  KEY `base_message_fk1` (`message_type_id`),
  KEY `base_message_fk2` (`store_id`),
  CONSTRAINT `base_message_fk0` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `base_message_fk1` FOREIGN KEY (`message_type_id`) REFERENCES `fb_base_message_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `base_message_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `base_message_fk9` FOREIGN KEY (`from_id`) REFERENCES `fb_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='消息';

-- ----------------------------
-- Table structure for fb_base_permission
-- ----------------------------
DROP TABLE IF EXISTS `fb_base_permission`;
CREATE TABLE `fb_base_permission` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父节点',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'backend' COMMENT '子系统',
  `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介',
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '路径',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '图标',
  `tree` varchar(1022) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '树路径',
  `level` int(11) NOT NULL DEFAULT '1' COMMENT '层级',
  `target` int(11) NOT NULL DEFAULT '0' COMMENT '新窗口打开',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_permission_fk2` (`store_id`),
  CONSTRAINT `base_permission_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6119 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='权限';

-- ----------------------------
-- Table structure for fb_base_role
-- ----------------------------
DROP TABLE IF EXISTS `fb_base_role`;
CREATE TABLE `fb_base_role` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `is_default` int(11) NOT NULL DEFAULT '0' COMMENT '是否为默认',
  `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介',
  `tree` varchar(1022) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '树路径',
  `type` int(11) NOT NULL DEFAULT '60' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_role_fk2` (`store_id`),
  CONSTRAINT `base_role_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='角色';

-- ----------------------------
-- Table structure for fb_base_role_permission
-- ----------------------------
DROP TABLE IF EXISTS `fb_base_role_permission`;
CREATE TABLE `fb_base_role_permission` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `role_id` bigint(20) unsigned NOT NULL COMMENT '角色',
  `permission_id` bigint(20) unsigned NOT NULL COMMENT '权限',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_role_permission_fk2` (`store_id`),
  KEY `base_role_permission_fk0` (`role_id`),
  KEY `base_role_permission_fk1` (`permission_id`),
  CONSTRAINT `base_role_permission_fk0` FOREIGN KEY (`role_id`) REFERENCES `fb_base_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `base_role_permission_fk1` FOREIGN KEY (`permission_id`) REFERENCES `fb_base_permission` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `base_role_permission_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='角色菜单权限';

-- ----------------------------
-- Table structure for fb_base_role_permission
-- ----------------------------
DROP TABLE IF EXISTS `fb_base_role_department`;
CREATE TABLE `fb_base_role_department` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `role_id` bigint(20) unsigned NOT NULL COMMENT '角色',
  `department_id` bigint(20) unsigned NOT NULL COMMENT '部门',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_role_department_fk2` (`store_id`),
  KEY `base_role_department_fk0` (`role_id`),
  KEY `base_role_department_fk1` (`department_id`),
  CONSTRAINT `base_role_department_fk0` FOREIGN KEY (`role_id`) REFERENCES `fb_base_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `base_role_department_fk1` FOREIGN KEY (`department_id`) REFERENCES `fb_base_department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `base_role_department_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='角色数据权限';

-- ----------------------------
-- Table structure for fb_base_schedule
-- ----------------------------
DROP TABLE IF EXISTS `fb_base_schedule`;
CREATE TABLE `fb_base_schedule` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `params` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '参数',
  `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介',
  `cron` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '* * * * *' COMMENT 'Cron表达式',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_schedule_fk2` (`store_id`),
  CONSTRAINT `base_schedule_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='定时任务';

-- ----------------------------
-- Table structure for fb_base_setting
-- ----------------------------
DROP TABLE IF EXISTS `fb_base_setting`;
CREATE TABLE `fb_base_setting` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'backend' COMMENT '子系统',
  `setting_type_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '配置类型',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '代码',
  `value` text COLLATE utf8mb4_unicode_ci COMMENT '值',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_setting_k0` (`store_id`),
  CONSTRAINT `base_setting_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='配置';

-- ----------------------------
-- Table structure for fb_base_setting_type
-- ----------------------------
DROP TABLE IF EXISTS `fb_base_setting_type`;
CREATE TABLE `fb_base_setting_type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父节点',
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'backend' COMMENT '子系统',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `code` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '代码',
  `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介',
  `support_role` int(11) NOT NULL DEFAULT '7' COMMENT '支持角色',
  `support_system` int(11) NOT NULL DEFAULT '1' COMMENT '支持系统',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text' COMMENT '类型',
  `value_range` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '可选值',
  `value_default` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '默认值',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  UNIQUE KEY `base_setting_type_code` (`code`),
  KEY `base_setting_type_k0` (`store_id`),
  CONSTRAINT `base_setting_type_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='配置类型';

-- ----------------------------
-- Table structure for fb_base_user_role
-- ----------------------------
DROP TABLE IF EXISTS `fb_base_user_role`;
CREATE TABLE `fb_base_user_role` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '用户',
  `role_id` bigint(20) unsigned NOT NULL COMMENT '角色',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_user_role_fk2` (`store_id`),
  KEY `base_user_role_fk0` (`user_id`),
  KEY `base_user_role_fk1` (`role_id`),
  CONSTRAINT `base_user_role_fk0` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `base_user_role_fk1` FOREIGN KEY (`role_id`) REFERENCES `fb_base_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `base_user_role_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='角色菜单权限';

-- ----------------------------
-- Table structure for fb_store
-- ----------------------------
DROP TABLE IF EXISTS `fb_store`;
CREATE TABLE `fb_store` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父节点',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '管理员',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介',
  `host_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '域名',
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '代码',
  `qrcode` varchar(255) NOT NULL DEFAULT '' COMMENT '二维码',
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'site' COMMENT '子系统',
  `expired_at` int(11) NOT NULL DEFAULT '0' COMMENT '到期时间',
  `remark` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT '备注',
  `language` int(11) NOT NULL DEFAULT '1' COMMENT '语言',
  `lang_source` varchar(255) NOT NULL DEFAULT 'zh-CN' COMMENT '翻译源语言',
  `lang_frontend` int(11) NOT NULL DEFAULT '3' COMMENT '前端支持语言',
  `lang_frontend_default` varchar(255) NOT NULL DEFAULT '' COMMENT '前端默认语言',
  `lang_backend` int(11) NOT NULL DEFAULT '3' COMMENT '后端支持语言',
  `lang_backend_default` varchar(255) NOT NULL DEFAULT '' COMMENT '后端默认语言',
  `lang_api` int(11) NOT NULL DEFAULT '3' COMMENT 'API支持语言',
  `lang_api_default` varchar(255) NOT NULL DEFAULT '' COMMENT 'API默认语言',
  `consume_count` int(11) NOT NULL DEFAULT '0' COMMENT '消费次数',
  `consume_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '消费金额',
  `history_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '历史金额',
  `param1` varchar(255) NOT NULL DEFAULT '' COMMENT '参数1',
  `param2` varchar(255) NOT NULL DEFAULT '' COMMENT '参数2',
  `param3` varchar(255) NOT NULL DEFAULT '' COMMENT '参数3',
  `param4` int(11) NOT NULL DEFAULT '0' COMMENT '参数4',
  `param5` int(11) NOT NULL DEFAULT '0' COMMENT '参数5',
  `param6` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '参数6',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_store_fk1` (`user_id`),
  CONSTRAINT `base_store_fk1` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='店铺';

-- ----------------------------
-- Table structure for fb_user
-- ----------------------------
DROP TABLE IF EXISTS `fb_user`;
CREATE TABLE `fb_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父节点',
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '帐号',
  `auth_key` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '权限',
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Token',
  `access_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '访问Token',
  `refresh_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '刷新Token',
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '密码',
  `password_reset_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '重置密码',
  `verification_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '校验Token',
  `openid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '微信Id',
  `unionid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '微信唯一Id',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '手机',
  `auth_role` int(11) NOT NULL DEFAULT '1' COMMENT '用户类型',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `avatar` varchar(1022) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '头像',
  `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介',
  `sex` int(11) NOT NULL DEFAULT '0' COMMENT '性别',
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '地区',
  `province_id` int(11) NOT NULL DEFAULT '0' COMMENT '省',
  `city_id` int(11) NOT NULL DEFAULT '0' COMMENT '市',
  `district_id` int(11) NOT NULL DEFAULT '0' COMMENT '区',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '地址',
  `birthday` varchar(255) NOT NULL default '' COMMENT '生日',
  `point` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `login_count` int(11) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `last_login_at` int(11) NOT NULL DEFAULT '1' COMMENT '最近登录时间',
  `last_login_ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '最近登录IP',
  `last_paid_at` int(11) NOT NULL DEFAULT '0' COMMENT '最近消费时间',
  `last_paid_ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '最近消费IP',
  `consume_count` int(11) NOT NULL DEFAULT '0' COMMENT '消费次数',
  `consume_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '消费金额',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  UNIQUE KEY `base_username` (`username`),
  KEY `base_created_at` (`created_at`),
  KEY `base_user_fk2` (`store_id`),
  CONSTRAINT `base_user_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户';

DROP TABLE IF EXISTS `fb_school_student`;
CREATE TABLE `fb_school_student` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `type` int(11) NOT NULL DEFAULT 1 COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT 50 COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` int(11) NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` int(11) NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `school_student_fk2` (`store_id`),
  CONSTRAINT `school_student_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT '学生';

DROP TABLE IF EXISTS `fb_base_lang`;
CREATE TABLE `fb_base_lang` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `source` varchar(255) NOT NULL COMMENT '源语言',
  `target` varchar(255) NOT NULL COMMENT '目标语言',
  `table_code` int(11) NOT NULL DEFAULT 1 COMMENT '表代码',
  `target_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '目标ID',
  `content` text COMMENT '内容',
  `type` int(11) NOT NULL DEFAULT 1 COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT 50 COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` int(11) NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` int(11) NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_lang_fk2` (`store_id`),
  CONSTRAINT `base_lang_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT '多语言';

DROP TABLE IF EXISTS `fb_base_profile`;
CREATE TABLE `fb_base_profile` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `company` varchar(255) NOT NULL DEFAULT '' COMMENT '公司',
  `location` varchar(255) NOT NULL DEFAULT '' COMMENT '城市',
  `topic` int(11) NOT NULL DEFAULT 0 COMMENT '主题数',
  `like` int(11) NOT NULL DEFAULT 0 COMMENT '点赞数',
  `hate` int(11) NOT NULL DEFAULT 0 COMMENT '倒彩数',
  `thanks` int(11) NOT NULL DEFAULT 0 COMMENT '感谢数',
  `follow` int(11) NOT NULL DEFAULT 0 COMMENT '关注数',
  `click` int(11) NOT NULL DEFAULT 0 COMMENT '浏览',
  `type` int(11) NOT NULL DEFAULT 1 COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT 50 COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` int(11) NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` int(11) NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_profile_fk2` (`store_id`),
  CONSTRAINT `base_profile_fk1` FOREIGN KEY (`id`) REFERENCES `fb_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `base_profile_fk2` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT '用户资料';

-- ----------------------------
-- Table structure for fb_base_attachment
-- ----------------------------
DROP TABLE IF EXISTS `fb_base_search_log`;
CREATE TABLE `fb_base_search_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `session_id` varchar(255) NOT NULL DEFAULT '' COMMENT '会话ID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `ip` varchar(255) NOT NULL DEFAULT '' COMMENT 'IP地址',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_log_fk0` (`store_id`),
  CONSTRAINT `base_log_fk0` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='搜索记录';

DROP TABLE IF EXISTS `fb_base_stuff`;
CREATE TABLE `fb_base_stuff` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `code` json default NULL COMMENT '代码',
  `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '值',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Url',
  `position` int(11) NOT NULL DEFAULT '1' COMMENT '位置',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_stuff_k0` (`store_id`),
  CONSTRAINT `base_stuff_fk0` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='物料';

DROP TABLE IF EXISTS `fb_base_balance_log`;
CREATE TABLE `fb_base_balance_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `change` int(11) NOT NULL DEFAULT '0' COMMENT '变动',
  `original` int(11) NOT NULL DEFAULT '0' COMMENT '原值',
  `balance` int(11) NOT NULL DEFAULT '0' COMMENT '余额',
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_balance_log_k0` (`store_id`),
  KEY `base_balance_log_k1` (`user_id`),
  CONSTRAINT `base_balance_log_fk0` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `base_balance_log_fk1` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='余额记录';

DROP TABLE IF EXISTS `fb_base_point_log`;
CREATE TABLE `fb_base_point_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '商家',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '用户',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `change` int(11) NOT NULL DEFAULT '0' COMMENT '变动',
  `original` int(11) NOT NULL DEFAULT '0' COMMENT '原值',
  `balance` int(11) NOT NULL DEFAULT '0' COMMENT '余额',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` int(11) NOT NULL DEFAULT '1' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '1' COMMENT '更新时间',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '创建用户',
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '更新用户',
  PRIMARY KEY (`id`),
  KEY `base_point_log_k0` (`store_id`),
  KEY `base_point_log_k1` (`user_id`),
  CONSTRAINT `base_point_log_fk2` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `base_point_log_fk0` FOREIGN KEY (`store_id`) REFERENCES `fb_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='积分记录';

-- ALTER TABLE `fb_user` change `description` `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介';  
-- ALTER TABLE `fb_store` change `description` `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介';  
-- ALTER TABLE `fb_base_setting_type` change `description` `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介';  
-- ALTER TABLE `fb_base_schedule` change `description` `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介';  
-- ALTER TABLE `fb_base_permission` change `description` `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介';  
-- ALTER TABLE `fb_base_dict_data` change `description` `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介';  
-- ALTER TABLE `fb_base_dict` change `description` `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介';  
-- ALTER TABLE `fb_base_department` change `description` `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介';  
-- ALTER TABLE `fb_base_role` change `description` `brief` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简介';  
-- ALTER TABLE `fb_user` ADD `openid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '微信Id' after `verification_token`;
-- ALTER TABLE `fb_user` ADD `unionid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '微信唯一Id' after `openid`;
-- ALTER TABLE `fb_store` ADD COLUMN `code` varchar(255) NOT NULL DEFAULT '' COMMENT '代码' AFTER `host_name`;  
-- ALTER TABLE `fb_store` ADD COLUMN `lang_source` varchar(255) NOT NULL DEFAULT 'zh-CN' COMMENT '翻译源语言' AFTER `language`;  
-- ALTER TABLE `fb_store` ADD COLUMN `lang_frontend` int(11) NOT NULL DEFAULT '3' COMMENT '前端支持语言' AFTER `lang_source`;  
-- ALTER TABLE `fb_store` ADD COLUMN `lang_frontend_default` varchar(255) NOT NULL DEFAULT '' COMMENT '前端默认语言' AFTER `lang_frontend`;  
-- ALTER TABLE `fb_store` ADD COLUMN `lang_backend` int(11) NOT NULL DEFAULT '3' COMMENT '后端支持语言' AFTER `lang_frontend_default`;  
-- ALTER TABLE `fb_store` ADD COLUMN `lang_backend_default` varchar(255) NOT NULL DEFAULT '' COMMENT '后端默认语言' AFTER `lang_backend`;  
-- ALTER TABLE `fb_store` ADD COLUMN `lang_api` int(11) NOT NULL DEFAULT '3' COMMENT 'API支持语言' AFTER `lang_backend_default`;  
-- ALTER TABLE `fb_store` ADD COLUMN `lang_api_default` varchar(255) NOT NULL DEFAULT '' COMMENT 'API默认语言' AFTER `lang_api`;  
-- ALTER TABLE `fb_store` ADD `consume_count` int(11) NOT NULL DEFAULT '0' COMMENT '消费次数' after `lang_api_default`;
-- ALTER TABLE `fb_store` ADD `consume_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '消费金额' after `consume_count`;
-- ALTER TABLE `fb_store` ADD `history_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '历史金额' after `consume_amount`;
-- ALTER TABLE `fb_store` ADD `param1` varchar(255) NOT NULL DEFAULT '' COMMENT '参数1' after `history_amount`;
-- ALTER TABLE `fb_store` ADD `param2` varchar(255) NOT NULL DEFAULT '' COMMENT '参数2' after `param1`;
-- ALTER TABLE `fb_store` ADD `param3` varchar(255) NOT NULL DEFAULT '' COMMENT '参数3' after `param2`;
-- ALTER TABLE `fb_store` ADD `param4` int(11) NOT NULL DEFAULT '0' COMMENT '参数4' after `param3`;
-- ALTER TABLE `fb_store` ADD `param5` int(11) NOT NULL DEFAULT '0' COMMENT '参数5' after `param4`;
-- ALTER TABLE `fb_store` ADD `param6` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '参数6' after `param5`;
-- ALTER TABLE `fb_base_setting_type` ADD COLUMN `support_role` int(11) NOT NULL DEFAULT '7' COMMENT '支持角色' AFTER `brief`;  
-- ALTER TABLE `fb_base_setting_type` ADD COLUMN `support_system` int(11) NOT NULL DEFAULT '1' COMMENT '支持系统' AFTER `support_role`;  



SET FOREIGN_KEY_CHECKS=1;
        ";

        $this->execute($sql);


        //add user: admin  password: 123456
        $sql = "
SET FOREIGN_KEY_CHECKS=0;

INSERT INTO `fb_store`(`id`, `parent_id`, `user_id`, `name`, `brief`, `host_name`, `code`, `qrcode`, `route`, `expired_at`, `remark`, `language`, `lang_source`, `lang_frontend`, `lang_frontend_default`, `lang_backend`, `lang_backend_default`, `lang_api`, `lang_api_default`, `type`, `sort`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES ('1', '0', '1', 'Funboot', '默认网站', 'www.funboot.com', '', '', 'site', '1634684399', '默认网站', 32767, 'zh-CN', 32767, '', 32767, '', 32767, '', 0, 50, 1, 1, 1619169177, 1, 1);
INSERT INTO `fb_store`(`id`, `parent_id`, `user_id`, `name`, `brief`, `host_name`, `code`, `qrcode`, `route`, `expired_at`, `remark`, `language`, `lang_source`, `lang_frontend`, `lang_frontend_default`, `lang_backend`, `lang_backend_default`, `lang_api`, `lang_api_default`, `type`, `sort`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES ('2', '0', '2', 'Funpay', 'Funpay', 'www.funpay.com', '', '', 'pay', '1634684399', 'Funpay', 32767, 'zh-CN', 32767, '', 32767, '', 32767, '', 0, 50, 1, 1, 1619169177, 1, 1);
INSERT INTO `fb_store`(`id`, `parent_id`, `user_id`, `name`, `brief`, `host_name`, `code`, `qrcode`, `route`, `expired_at`, `remark`, `language`, `lang_source`, `lang_frontend`, `lang_frontend_default`, `lang_backend`, `lang_backend_default`, `lang_api`, `lang_api_default`, `type`, `sort`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES ('4', '0', '4', 'Funcms', 'Funcms', 'www.funcms.com', '', '', 'cms', '1634684399', 'Funcms', 32767, 'zh-CN', 32767, '', 32767, '', 32767, '', 0, 50, 1, 1, 1619169177, 1, 1);
INSERT INTO `fb_store`(`id`, `parent_id`, `user_id`, `name`, `brief`, `host_name`, `code`, `qrcode`, `route`, `expired_at`, `remark`, `language`, `lang_source`, `lang_frontend`, `lang_frontend_default`, `lang_backend`, `lang_backend_default`, `lang_api`, `lang_api_default`, `type`, `sort`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES ('5', '0', '5', 'Funmall', 'Funmall', 'www.funmall.com', '', '', 'mall', '1634684399', 'Funmall', 32767, 'zh-CN', 32767, '', 32767, '', 32767, '', 0, 50, 1, 1, 1619169177, 1, 1);
INSERT INTO `fb_store`(`id`, `parent_id`, `user_id`, `name`, `brief`, `host_name`, `code`, `qrcode`, `route`, `expired_at`, `remark`, `language`, `lang_source`, `lang_frontend`, `lang_frontend_default`, `lang_backend`, `lang_backend_default`, `lang_api`, `lang_api_default`, `type`, `sort`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES ('6', '0', '6', 'Funbbs', 'Funbbs', 'www.funbbs.com', '', '', 'bbs', '1634684399', 'Funbbs', 32767, 'zh-CN', 32767, '', 32767, '', 32767, '', 0, 50, 1, 1, 1619169177, 1, 1);

INSERT INTO `fb_user`(`id`, `store_id`, `parent_id`, `username`, `auth_key`, `token`, `access_token`, `password_hash`, `password_reset_token`, `verification_token`, `email`, `mobile`, `auth_role`, `name`, `avatar`, `brief`, `sex`, `area`, `address`, `birthday`, `remark`, `last_login_at`, `last_login_ip`, `last_paid_at`, `last_paid_ip`, `consume_count`, `consume_amount`, `type`, `sort`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES ('1', '1', '0', 'admin', '', '', '', '$2y$13\$ZsldxLQuw/jaCSDQ76sRO.bISkCtjnniC2ijiV/wakkGaL4hmZhiK', '', '', 'funson86@gmail.com', '', '1', '', '', '', '0', '', '', '', '', '1605143153', '127.0.0.1', '0', '', '0', '0.00', '1', '50', '1', '1', '1606792873', '1', '2');
INSERT INTO `fb_user`(`id`, `store_id`, `parent_id`, `username`, `auth_key`, `token`, `access_token`, `password_hash`, `password_reset_token`, `verification_token`, `email`, `mobile`, `auth_role`, `name`, `avatar`, `brief`, `sex`, `area`, `address`, `birthday`, `remark`, `last_login_at`, `last_login_ip`, `last_paid_at`, `last_paid_ip`, `consume_count`, `consume_amount`, `type`, `sort`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES ('2', '2', '0', 'funpay', '', '', '', '$2y$13\$L58QDefrbiUjyxVXy6P/r.Mz9eeTjJpQEnk/hEN3pqZZRDiw4q7LC', '', '', 'funson86@gmail.com', '', '1', '', '', '', '0', '', '', '', '', '1607395941', '127.0.0.1', '0', '', '0', '0.00', '1', '50', '1', '1599808929', '1607395941', '1', '2');
INSERT INTO `fb_user`(`id`, `store_id`, `parent_id`, `username`, `auth_key`, `token`, `access_token`, `password_hash`, `password_reset_token`, `verification_token`, `email`, `mobile`, `auth_role`, `name`, `avatar`, `brief`, `sex`, `area`, `address`, `birthday`, `remark`, `last_login_at`, `last_login_ip`, `last_paid_at`, `last_paid_ip`, `consume_count`, `consume_amount`, `type`, `sort`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES ('3', '1', '0', 'test', '', '', '', '$2y$13\$ZsldxLQuw/jaCSDQ76sRO.bISkCtjnniC2ijiV/wakkGaL4hmZhiK', '', '', 'funson86@gmail.com', '', '1', '', '', '', '0', '', '', '', '', '1605143153', '127.0.0.1', '0', '', '0', '0.00', '1', '50', '1', '1', '1606792873', '1', '2');
INSERT INTO `fb_user`(`id`, `store_id`, `parent_id`, `username`, `auth_key`, `token`, `access_token`, `password_hash`, `password_reset_token`, `verification_token`, `email`, `mobile`, `auth_role`, `name`, `avatar`, `brief`, `sex`, `area`, `address`, `birthday`, `remark`, `last_login_at`, `last_login_ip`, `last_paid_at`, `last_paid_ip`, `consume_count`, `consume_amount`, `type`, `sort`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES ('4', '4', '0', 'funcms', '', '', '', '$2y$13\$ZsldxLQuw/jaCSDQ76sRO.bISkCtjnniC2ijiV/wakkGaL4hmZhiK', '', '', 'funson86@gmail.com', '', '1', '', '', '', '0', '', '', '', '', '1605143153', '127.0.0.1', '0', '', '0', '0.00', '1', '50', '1', '1', '1606792873', '1', '2');
INSERT INTO `fb_user`(`id`, `store_id`, `parent_id`, `username`, `auth_key`, `token`, `access_token`, `password_hash`, `password_reset_token`, `verification_token`, `email`, `mobile`, `auth_role`, `name`, `avatar`, `brief`, `sex`, `area`, `address`, `birthday`, `remark`, `last_login_at`, `last_login_ip`, `last_paid_at`, `last_paid_ip`, `consume_count`, `consume_amount`, `type`, `sort`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES ('5', '5', '0', 'funmall', '', '', '', '$2y$13\$ZsldxLQuw/jaCSDQ76sRO.bISkCtjnniC2ijiV/wakkGaL4hmZhiK', '', '', 'funson86@gmail.com', '', '1', '', '', '', '0', '', '', '', '', '1605143153', '127.0.0.1', '0', '', '0', '0.00', '1', '50', '1', '1', '1606792873', '1', '2');
INSERT INTO `fb_user`(`id`, `store_id`, `parent_id`, `username`, `auth_key`, `token`, `access_token`, `password_hash`, `password_reset_token`, `verification_token`, `email`, `mobile`, `auth_role`, `name`, `avatar`, `brief`, `sex`, `area`, `address`, `birthday`, `remark`, `last_login_at`, `last_login_ip`, `last_paid_at`, `last_paid_ip`, `consume_count`, `consume_amount`, `type`, `sort`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES ('6', '6', '0', 'funbbs', '', '', '', '$2y$13\$ZsldxLQuw/jaCSDQ76sRO.bISkCtjnniC2ijiV/wakkGaL4hmZhiK', '', '', 'funson86@gmail.com', '', '1', '', '', '', '0', '', '', '', '', '1605143153', '127.0.0.1', '0', '', '0', '0.00', '1', '50', '1', '1', '1606792873', '1', '2');

INSERT INTO `fb_base_message_type` VALUES ('7', '1', 'feedback', null, '0', '2', null, '7', '50', '1', '1', '1', '1', '1');

INSERT INTO `fb_base_dict` VALUES ('3', '1', '消息类型', 'message_type', '消息类型', '1', '50', '1', '1600778636', '1601181269', '1', '1');
INSERT INTO `fb_base_dict_data` VALUES ('9', '1', '3', '发给所有用户公告', '1', '公告', '发给所有用户公告', '1', '50', '1', '1601181323', '1601181323', '1', '1');
INSERT INTO `fb_base_dict_data` VALUES ('10', '1', '3', '定时提醒', '2', '提醒', '定时提醒', '1', '50', '1', '1601181586', '1601181586', '1', '1');
INSERT INTO `fb_base_dict_data` VALUES ('11', '1', '3', '私人信息', '3', '私信', '私人信息', '1', '50', '1', '1601181796', '1601181796', '1', '1');

INSERT INTO `fb_base_department` VALUES ('1', '1', '0', '技术部', 'backend', '技术部门', '1|2', '2|5', '1', '1', '50', '1', '1601024382', '1601032320', '1', '1');
INSERT INTO `fb_base_department` VALUES ('2', '1', '1', '后端开发组', 'backend', '', '', '', '1', '1', '50', '1', '1601024590', '1601030154', '1', '1');
INSERT INTO `fb_base_department` VALUES ('3', '1', '1', '前端开发组', 'backend', '', '', '', '1', '1', '50', '1', '1601030307', '1601030307', '1', '1');

INSERT INTO `fb_base_role` VALUES ('1', '1', 'superadmin', '0', 'Super Admin all permission, controller by programe', '', '60', '55', '1', '1599449404', '1603418473', '1', '1');
INSERT INTO `fb_base_role` VALUES ('2', '1', 'admin', '1', 'Normal admin', '', '60', '50', '1', '1599461439', '1603418493', '1', '1');
INSERT INTO `fb_base_role` VALUES ('3', '1', 'admin demo', '0', 'for view', '', '60', '50', '1', '1599461439', '1603418493', '1', '1');
INSERT INTO `fb_base_role` VALUES ('50', '1', 'store admin', '1', 'For Store Admin Login', '', '60', '50', '1', '1599710877', '1603418515', '1', '1');
INSERT INTO `fb_base_role` VALUES ('54', '1', 'store cms', '1', 'For Store Admin Login', '', '60', '50', '1', '1599710877', '1603418515', '1', '1');
INSERT INTO `fb_base_role` VALUES ('55', '1', 'store mall', '1', 'For Store Admin Login', '', '60', '50', '1', '1599710877', '1603418515', '1', '1');
INSERT INTO `fb_base_role` VALUES ('56', '1', 'store bbs', '1', 'For Store Admin Login', '', '60', '50', '1', '1599710877', '1603418515', '1', '1');
INSERT INTO `fb_base_role` VALUES ('100', '1', 'user frontend', '1', 'Frontend User', '', '60', '50', '1', '1599737332', '1602327113', '1', '1');


INSERT INTO `fb_base_permission` VALUES ('5', '1', '0', '管理系统', 'backend', '', '', 'fas fa-cog', '', '1', '0', '1', '50', '1', '1', '1599358085', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('56', '1', '5', '系统管理', 'backend', '', '', 'fas fa-cogs', '', '2', '0', '1', '50', '1', '1599358163', '1599358163', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('58', '1', '5', '系统监控', 'backend', '', '', 'fas fa-chart-bar', '', '2', '0', '1', '50', '1', '1599358315', '1599358315', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('560', '1', '56', '用户管理', 'backend', '', '/base/user/index', 'fas fa-user', '', '3', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('561', '1', '56', '店铺管理', 'backend', '', '/base/store/index', 'fab fa-internet-explorer', '', '3', '0', '1', '50', '1', '1', '1602322615', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('562', '1', '56', '部门管理', 'backend', '', '/base/department/index', 'fas fa-code-branch', '', '3', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('563', '1', '56', '消息类型', 'backend', '', '/base/message-type/index', 'fas fa-envelope', '', '3', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('564', '1', '56', '文件管理', 'backend', '', '/base/attachment/index', 'fas fa-folder', '', '3', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('565', '1', '56', '角色权限管理', 'backend', '', '/base/role/index', 'fas fa-users', '', '3', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('566', '1', '56', '菜单权限管理', 'backend', '', '/base/permission/index', 'fas fa-list', '', '3', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('567', '1', '56', '系统配置', 'backend', '', '/base/setting/edit-all', 'fas fa-cog', '', '2', '0', '1', '50', '1', '1', '1600945413', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('568', '1', '56', '配置类型管理', 'backend', '', '/base/setting-type/index', 'fas fa-clipboard-check', '', '3', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('569', '1', '56', '数据字典', 'backend', '', '/base/dict-data/index', 'fas fa-book', '', '3', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('581', '1', '58', '日志管理', 'backend', '', '/base/log/index', 'fas fa-copy', '', '3', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('583', '1', '58', '定时任务', 'backend', '', '/base/schedule/index', 'fas fa-clock', '', '3', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('589', '1', '58', '系统信息', 'backend', '', '/system/index', 'fas fa-chart-area', '', '3', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5601', '1', '560', '查看', 'backend', '', '/base/user/view*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5602', '1', '560', '编辑', 'backend', '', '/base/user/edit*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5603', '1', '560', '删除', 'backend', '', '/base/user/delete*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5604', '1', '560', '启禁', 'backend', '', '/base/user/status*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5605', '1', '560', '导出', 'backend', '', '/base/user/export*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5606', '1', '560', '导入', 'backend', '', '/base/user/import*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5611', '1', '561', '查看', 'backend', '', '/base/store/view*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5612', '1', '561', '编辑', 'backend', '', '/base/store/edit*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5613', '1', '561', '删除', 'backend', '', '/base/store/delete*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5614', '1', '561', '启禁', 'backend', '', '/base/store/status*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5615', '1', '561', '导出', 'backend', '', '/base/store/export*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5616', '1', '561', '导入', 'backend', '', '/base/store/import*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5621', '1', '562', '查看', 'backend', '', '/base/department/view*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5622', '1', '562', '编辑', 'backend', '', '/base/department/edit*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5623', '1', '562', '删除', 'backend', '', '/base/department/delete*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5624', '1', '562', '启禁', 'backend', '', '/base/department/status*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5625', '1', '562', '导出', 'backend', '', '/base/department/export*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5626', '1', '562', '导入', 'backend', '', '/base/department/import*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5631', '1', '563', '查看', 'backend', '', '/base/message-type/view*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5632', '1', '563', '编辑', 'backend', '', '/base/message-type/edit*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5633', '1', '563', '删除', 'backend', '', '/base/message-type/delete*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5634', '1', '563', '启禁', 'backend', '', '/base/message-type/status*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5635', '1', '563', '导出', 'backend', '', '/base/message-type/export*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5636', '1', '563', '导入', 'backend', '', '/base/message-type/import*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5641', '1', '564', '查看', 'backend', '', '/base/attachement/view*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5642', '1', '564', '编辑', 'backend', '', '/base/attachement/edit*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5643', '1', '564', '删除', 'backend', '', '/base/attachement/delete*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5644', '1', '564', '启禁', 'backend', '', '/base/attachement/status*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5645', '1', '564', '导出', 'backend', '', '/base/attachement/export*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5646', '1', '564', '导入', 'backend', '', '/base/attachement/import*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5651', '1', '565', '查看', 'backend', '', '/base/role/view*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5652', '1', '565', '编辑', 'backend', '', '/base/role/edit*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5653', '1', '565', '删除', 'backend', '', '/base/role/delete*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5654', '1', '565', '启禁', 'backend', '', '/base/role/status*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5655', '1', '565', '导出', 'backend', '', '/base/role/export*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5656', '1', '565', '导入', 'backend', '', '/base/role/import*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5661', '1', '566', '查看', 'backend', '', '/base/permission/view*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5662', '1', '566', '编辑', 'backend', '', '/base/permission/edit*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5663', '1', '566', '删除', 'backend', '', '/base/permission/delete*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5664', '1', '566', '启禁', 'backend', '', '/base/permission/status*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5665', '1', '566', '导出', 'backend', '', '/base/permission/export*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5666', '1', '566', '导入', 'backend', '', '/base/permission/import*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5671', '1', '567', '查看', 'backend', '', '/base/setting/view*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5672', '1', '567', '编辑', 'backend', '', '/base/setting/edit*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5673', '1', '567', '删除', 'backend', '', '/base/setting/delete*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5674', '1', '567', '启禁', 'backend', '', '/base/setting/status*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5675', '1', '567', '导出', 'backend', '', '/base/setting/export*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5676', '1', '567', '导入', 'backend', '', '/base/setting/import*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5681', '1', '568', '查看', 'backend', '', '/base/setting-type/view*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5682', '1', '568', '编辑', 'backend', '', '/base/setting-type/edit*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5683', '1', '568', '删除', 'backend', '', '/base/setting-type/delete*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5684', '1', '568', '启禁', 'backend', '', '/base/setting-type/status*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5685', '1', '568', '导出', 'backend', '', '/base/setting-type/export*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5686', '1', '568', '导入', 'backend', '', '/base/setting-type/import*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5691', '1', '569', '查看', 'backend', '', '/base/dict-data/view*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5692', '1', '569', '编辑', 'backend', '', '/base/dict-data/edit*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5693', '1', '569', '删除', 'backend', '', '/base/dict-data/delete*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5694', '1', '569', '启禁', 'backend', '', '/base/dict-data/status*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5695', '1', '569', '导出', 'backend', '', '/base/dict-data/export*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5696', '1', '569', '导入', 'backend', '', '/base/dict-data/import*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5811', '1', '581', '查看', 'backend', '', '/base/log/view*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5812', '1', '581', '编辑', 'backend', '', '/base/log/edit*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5813', '1', '581', '删除', 'backend', '', '/base/log/delete*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5814', '1', '581', '启禁', 'backend', '', '/base/log/status*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5815', '1', '581', '导出', 'backend', '', '/base/log/export*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5816', '1', '581', '导入', 'backend', '', '/base/log/import*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5817', '1', '581', '报表', 'backend', '', '/base/log/stat*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5831', '1', '583', '查看', 'backend', '', '/base/schedule/view*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5832', '1', '583', '编辑', 'backend', '', '/base/schedule/edit*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5833', '1', '583', '删除', 'backend', '', '/base/schedule/delete*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5834', '1', '583', '启禁', 'backend', '', '/base/schedule/status*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5835', '1', '583', '导出', 'backend', '', '/base/schedule/export*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_permission` VALUES ('5836', '1', '583', '导入', 'backend', '', '/base/schedule/import*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');


-- INSERT INTO `fb_base_permission` VALUES ('6', '1', '0', '学校管理', 'backend', '', '', 'fas fa-laptop-house', '', '1', '0', '1', '50', '1', '1', '1599358085', '1', '1');
-- INSERT INTO `fb_base_permission` VALUES ('61', '1', '6', '学生', 'backend', '', '', 'fas fa-users', '', '2', '0', '1', '50', '1', '1', '1', '1', '1');
-- INSERT INTO `fb_base_permission` VALUES ('611', '1', '61', '学生管理', 'backend', '', '/school/student/index', 'fas fa-users', '', '3', '0', '1', '50', '1', '1', '1', '1', '1');
-- INSERT INTO `fb_base_permission` VALUES ('6111', '1', '611', '查看', 'backend', '', '/base/student/view*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
-- INSERT INTO `fb_base_permission` VALUES ('6112', '1', '611', '编辑', 'backend', '', '/base/student/edit*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
-- INSERT INTO `fb_base_permission` VALUES ('6113', '1', '611', '删除', 'backend', '', '/base/student/delete*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
-- INSERT INTO `fb_base_permission` VALUES ('6114', '1', '611', '启禁', 'backend', '', '/base/student/status*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
-- INSERT INTO `fb_base_permission` VALUES ('6115', '1', '611', '导出', 'backend', '', '/base/student/export*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');
-- INSERT INTO `fb_base_permission` VALUES ('6116', '1', '611', '导入', 'backend', '', '/base/student/import*', '', '', '4', '0', '1', '50', '1', '1', '1', '1', '1');


INSERT INTO `fb_base_role_permission` VALUES ('1', '1', '', '3', '5601', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('2', '1', '', '3', '560', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('3', '1', '', '3', '56', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('4', '1', '', '3', '5', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('5', '1', '', '3', '5611', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('6', '1', '', '3', '561', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('7', '1', '', '3', '5621', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('8', '1', '', '3', '562', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('9', '1', '', '3', '5631', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('10', '1', '', '3', '563', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('11', '1', '', '3', '5641', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('12', '1', '', '3', '564', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('13', '1', '', '3', '5651', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('14', '1', '', '3', '565', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('15', '1', '', '3', '5661', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('16', '1', '', '3', '566', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('17', '1', '', '3', '5671', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('18', '1', '', '3', '567', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('19', '1', '', '3', '5681', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('20', '1', '', '3', '568', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('21', '1', '', '3', '5691', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('22', '1', '', '3', '569', '1', '50', '1', '1607671710', '1607671710', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('23', '1', '', '3', '5811', '1', '50', '1', '1607671711', '1607671711', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('24', '1', '', '3', '581', '1', '50', '1', '1607671711', '1607671711', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('25', '1', '', '3', '58', '1', '50', '1', '1607671711', '1607671711', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('26', '1', '', '3', '5831', '1', '50', '1', '1607671711', '1607671711', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('27', '1', '', '3', '583', '1', '50', '1', '1607671711', '1607671711', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('28', '1', '', '3', '6111', '1', '50', '1', '1607671711', '1607671711', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('29', '1', '', '3', '611', '1', '50', '1', '1607671711', '1607671711', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('30', '1', '', '3', '61', '1', '50', '1', '1607671711', '1607671711', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('31', '1', '', '3', '6', '1', '50', '1', '1607671711', '1607671711', '1', '1');

INSERT INTO `fb_base_role_permission` VALUES ('128', '1', '', '50', '5', '1', '50', '1', '1608030276', '1608030276', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('129', '1', '', '50', '6', '1', '50', '1', '1608030276', '1608030276', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('130', '1', '', '50', '61', '1', '50', '1', '1608030276', '1608030276', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('131', '1', '', '50', '560', '1', '50', '1', '1608030276', '1608030276', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('132', '1', '', '50', '56', '1', '50', '1', '1608030276', '1608030276', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('133', '1', '', '50', '562', '1', '50', '1', '1608030276', '1608030276', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('134', '1', '', '50', '567', '1', '50', '1', '1608030276', '1608030276', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('135', '1', '', '50', '611', '1', '50', '1', '1608030276', '1608030276', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('136', '1', '', '50', '5601', '1', '50', '1', '1608030276', '1608030276', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('137', '1', '', '50', '5602', '1', '50', '1', '1608030276', '1608030276', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('138', '1', '', '50', '5603', '1', '50', '1', '1608030276', '1608030276', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('139', '1', '', '50', '5604', '1', '50', '1', '1608030276', '1608030276', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('140', '1', '', '50', '5605', '1', '50', '1', '1608030276', '1608030276', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('141', '1', '', '50', '5606', '1', '50', '1', '1608030276', '1608030276', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('142', '1', '', '50', '5621', '1', '50', '1', '1608030276', '1608030276', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('143', '1', '', '50', '5622', '1', '50', '1', '1608030276', '1608030276', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('144', '1', '', '50', '5623', '1', '50', '1', '1608030276', '1608030276', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('145', '1', '', '50', '5624', '1', '50', '1', '1608030276', '1608030276', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('146', '1', '', '50', '5625', '1', '50', '1', '1608030276', '1608030276', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('147', '1', '', '50', '5626', '1', '50', '1', '1608030276', '1608030276', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('148', '1', '', '50', '5671', '1', '50', '1', '1608030276', '1608030276', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('149', '1', '', '50', '5672', '1', '50', '1', '1608030276', '1608030276', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('150', '1', '', '50', '5673', '1', '50', '1', '1608030276', '1608030276', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('151', '1', '', '50', '5674', '1', '50', '1', '1608030276', '1608030276', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('152', '1', '', '50', '5675', '1', '50', '1', '1608030276', '1608030276', '1', '1');
INSERT INTO `fb_base_role_permission` VALUES ('153', '1', '', '50', '5676', '1', '50', '1', '1608030276', '1608030276', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('154', '1', '', '50', '6111', '1', '50', '1', '1608030276', '1608030276', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('155', '1', '', '50', '6112', '1', '50', '1', '1608030276', '1608030276', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('156', '1', '', '50', '6113', '1', '50', '1', '1608030276', '1608030276', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('157', '1', '', '50', '6114', '1', '50', '1', '1608030276', '1608030276', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('158', '1', '', '50', '6115', '1', '50', '1', '1608030276', '1608030276', '1', '1');
-- INSERT INTO `fb_base_role_permission` VALUES ('159', '1', '', '50', '6116', '1', '50', '1', '1608030276', '1608030276', '1', '1');

INSERT INTO `fb_base_role_permission` VALUES (1145, 1, '', 54, 54, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1146, 1, '', 54, 5, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1147, 1, '', 54, 541, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1148, 1, '', 54, 543, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1149, 1, '', 54, 560, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1150, 1, '', 54, 56, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1151, 1, '', 54, 567, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1152, 1, '', 54, 5411, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1153, 1, '', 54, 5412, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1154, 1, '', 54, 5413, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1155, 1, '', 54, 5414, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1156, 1, '', 54, 5415, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1157, 1, '', 54, 5416, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1158, 1, '', 54, 5431, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1159, 1, '', 54, 5432, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1160, 1, '', 54, 5433, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1161, 1, '', 54, 5434, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1162, 1, '', 54, 5435, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1163, 1, '', 54, 5436, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1164, 1, '', 54, 5601, 1, 50, 1, 1634178359, 1634178359, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1165, 1, '', 54, 5602, 1, 50, 1, 1634178360, 1634178360, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1166, 1, '', 54, 5603, 1, 50, 1, 1634178360, 1634178360, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1167, 1, '', 54, 5604, 1, 50, 1, 1634178360, 1634178360, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1168, 1, '', 54, 5605, 1, 50, 1, 1634178360, 1634178360, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1169, 1, '', 54, 5606, 1, 50, 1, 1634178360, 1634178360, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1170, 1, '', 54, 5671, 1, 50, 1, 1634178360, 1634178360, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1171, 1, '', 54, 5672, 1, 50, 1, 1634178360, 1634178360, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1172, 1, '', 54, 5673, 1, 50, 1, 1634178360, 1634178360, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1173, 1, '', 54, 5674, 1, 50, 1, 1634178360, 1634178360, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1174, 1, '', 54, 5675, 1, 50, 1, 1634178360, 1634178360, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1175, 1, '', 54, 5676, 1, 50, 1, 1634178360, 1634178360, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1176, 1, '', 56, 53, 1, 50, 1, 1634178458, 1634178458, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1177, 1, '', 56, 5, 1, 50, 1, 1634178458, 1634178458, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1178, 1, '', 56, 531, 1, 50, 1, 1634178458, 1634178458, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1179, 1, '', 56, 533, 1, 50, 1, 1634178458, 1634178458, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1180, 1, '', 56, 535, 1, 50, 1, 1634178458, 1634178458, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1181, 1, '', 56, 536, 1, 50, 1, 1634178458, 1634178458, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1182, 1, '', 56, 537, 1, 50, 1, 1634178458, 1634178458, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1183, 1, '', 56, 538, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1184, 1, '', 56, 539, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1185, 1, '', 56, 560, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1186, 1, '', 56, 56, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1187, 1, '', 56, 567, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1188, 1, '', 56, 5311, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1189, 1, '', 56, 5312, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1190, 1, '', 56, 5313, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1191, 1, '', 56, 5314, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1192, 1, '', 56, 5315, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1193, 1, '', 56, 5316, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1194, 1, '', 56, 5331, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1195, 1, '', 56, 5332, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1196, 1, '', 56, 5333, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1197, 1, '', 56, 5334, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1198, 1, '', 56, 5335, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1199, 1, '', 56, 5336, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1200, 1, '', 56, 5351, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1201, 1, '', 56, 5352, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1202, 1, '', 56, 5353, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1203, 1, '', 56, 5354, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1204, 1, '', 56, 5355, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1205, 1, '', 56, 5356, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1206, 1, '', 56, 5361, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1207, 1, '', 56, 5362, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1208, 1, '', 56, 5363, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1209, 1, '', 56, 5364, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1210, 1, '', 56, 5365, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1211, 1, '', 56, 5366, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1212, 1, '', 56, 5371, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1213, 1, '', 56, 5372, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1214, 1, '', 56, 5373, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1215, 1, '', 56, 5374, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1216, 1, '', 56, 5375, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1217, 1, '', 56, 5376, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1218, 1, '', 56, 5381, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1219, 1, '', 56, 5382, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1220, 1, '', 56, 5383, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1221, 1, '', 56, 5384, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1222, 1, '', 56, 5385, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1223, 1, '', 56, 5386, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1224, 1, '', 56, 5391, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1225, 1, '', 56, 5392, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1226, 1, '', 56, 5393, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1227, 1, '', 56, 5394, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1228, 1, '', 56, 5395, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1229, 1, '', 56, 5396, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1230, 1, '', 56, 5601, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1231, 1, '', 56, 5602, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1232, 1, '', 56, 5603, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1233, 1, '', 56, 5604, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1234, 1, '', 56, 5605, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1235, 1, '', 56, 5606, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1236, 1, '', 56, 5671, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1237, 1, '', 56, 5672, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1238, 1, '', 56, 5673, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1239, 1, '', 56, 5674, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1240, 1, '', 56, 5675, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1241, 1, '', 56, 5676, 1, 50, 1, 1634178459, 1634178459, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1242, 1, '', 55, 2, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1243, 1, '', 55, 21, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1244, 1, '', 55, 22, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1245, 1, '', 55, 24, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1246, 1, '', 55, 25, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1247, 1, '', 55, 27, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1248, 1, '', 55, 210, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1249, 1, '', 55, 213, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1250, 1, '', 55, 215, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1251, 1, '', 55, 217, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1252, 1, '', 55, 224, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1253, 1, '', 55, 226, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1254, 1, '', 55, 240, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1255, 1, '', 55, 243, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1256, 1, '', 55, 244, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1257, 1, '', 55, 245, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1258, 1, '', 55, 248, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1259, 1, '', 55, 251, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1260, 1, '', 55, 252, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1261, 1, '', 55, 253, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1262, 1, '', 55, 255, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1263, 1, '', 55, 256, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1264, 1, '', 55, 257, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1265, 1, '', 55, 258, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1266, 1, '', 55, 272, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1267, 1, '', 55, 273, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1268, 1, '', 55, 560, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1269, 1, '', 55, 56, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1270, 1, '', 55, 5, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1271, 1, '', 55, 567, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1272, 1, '', 55, 2101, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1273, 1, '', 55, 2102, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1274, 1, '', 55, 2103, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1275, 1, '', 55, 2104, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1276, 1, '', 55, 2105, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1277, 1, '', 55, 2106, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1278, 1, '', 55, 2131, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1279, 1, '', 55, 2132, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1280, 1, '', 55, 2133, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1281, 1, '', 55, 2134, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1282, 1, '', 55, 2135, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1283, 1, '', 55, 2136, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1284, 1, '', 55, 2151, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1285, 1, '', 55, 2152, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1286, 1, '', 55, 2153, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1287, 1, '', 55, 2154, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1288, 1, '', 55, 2155, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1289, 1, '', 55, 2156, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1290, 1, '', 55, 2171, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1291, 1, '', 55, 2172, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1292, 1, '', 55, 2173, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1293, 1, '', 55, 2174, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1294, 1, '', 55, 2175, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1295, 1, '', 55, 2176, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1296, 1, '', 55, 2241, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1297, 1, '', 55, 2242, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1298, 1, '', 55, 2243, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1299, 1, '', 55, 2244, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1300, 1, '', 55, 2245, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1301, 1, '', 55, 2246, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1302, 1, '', 55, 2261, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1303, 1, '', 55, 2262, 1, 50, 1, 1634178503, 1634178503, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1304, 1, '', 55, 2263, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1305, 1, '', 55, 2264, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1306, 1, '', 55, 2265, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1307, 1, '', 55, 2266, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1308, 1, '', 55, 2401, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1309, 1, '', 55, 2402, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1310, 1, '', 55, 2403, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1311, 1, '', 55, 2404, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1312, 1, '', 55, 2405, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1313, 1, '', 55, 2406, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1314, 1, '', 55, 2431, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1315, 1, '', 55, 2432, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1316, 1, '', 55, 2433, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1317, 1, '', 55, 2434, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1318, 1, '', 55, 2435, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1319, 1, '', 55, 2436, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1320, 1, '', 55, 2441, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1321, 1, '', 55, 2442, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1322, 1, '', 55, 2443, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1323, 1, '', 55, 2444, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1324, 1, '', 55, 2445, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1325, 1, '', 55, 2446, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1326, 1, '', 55, 2451, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1327, 1, '', 55, 2452, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1328, 1, '', 55, 2453, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1329, 1, '', 55, 2454, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1330, 1, '', 55, 2455, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1331, 1, '', 55, 2456, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1332, 1, '', 55, 2481, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1333, 1, '', 55, 2482, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1334, 1, '', 55, 2483, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1335, 1, '', 55, 2484, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1336, 1, '', 55, 2485, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1337, 1, '', 55, 2486, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1338, 1, '', 55, 2511, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1339, 1, '', 55, 2512, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1340, 1, '', 55, 2513, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1341, 1, '', 55, 2514, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1342, 1, '', 55, 2515, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1343, 1, '', 55, 2516, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1344, 1, '', 55, 2521, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1345, 1, '', 55, 2522, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1346, 1, '', 55, 2523, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1347, 1, '', 55, 2524, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1348, 1, '', 55, 2525, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1349, 1, '', 55, 2526, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1350, 1, '', 55, 2531, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1351, 1, '', 55, 2532, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1352, 1, '', 55, 2533, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1353, 1, '', 55, 2534, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1354, 1, '', 55, 2535, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1355, 1, '', 55, 2536, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1356, 1, '', 55, 2551, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1357, 1, '', 55, 2552, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1358, 1, '', 55, 2553, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1359, 1, '', 55, 2554, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1360, 1, '', 55, 2555, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1361, 1, '', 55, 2556, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1362, 1, '', 55, 2561, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1363, 1, '', 55, 2562, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1364, 1, '', 55, 2563, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1365, 1, '', 55, 2564, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1366, 1, '', 55, 2565, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1367, 1, '', 55, 2566, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1368, 1, '', 55, 2571, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1369, 1, '', 55, 2572, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1370, 1, '', 55, 2573, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1371, 1, '', 55, 2574, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1372, 1, '', 55, 2575, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1373, 1, '', 55, 2576, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1374, 1, '', 55, 2581, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1375, 1, '', 55, 2582, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1376, 1, '', 55, 2583, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1377, 1, '', 55, 2584, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1378, 1, '', 55, 2585, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1379, 1, '', 55, 2586, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1380, 1, '', 55, 2721, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1381, 1, '', 55, 2722, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1382, 1, '', 55, 2723, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1383, 1, '', 55, 2724, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1384, 1, '', 55, 2725, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1385, 1, '', 55, 2726, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1386, 1, '', 55, 2731, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1387, 1, '', 55, 2732, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1388, 1, '', 55, 2733, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1389, 1, '', 55, 2734, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1390, 1, '', 55, 2735, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1391, 1, '', 55, 2736, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1392, 1, '', 55, 5601, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1393, 1, '', 55, 5602, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1394, 1, '', 55, 5603, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1395, 1, '', 55, 5604, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1396, 1, '', 55, 5605, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1397, 1, '', 55, 5606, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1398, 1, '', 55, 5671, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1399, 1, '', 55, 5672, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1400, 1, '', 55, 5673, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1401, 1, '', 55, 5674, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1402, 1, '', 55, 5675, 1, 50, 1, 1634178504, 1634178504, 1, 1);
INSERT INTO `fb_base_role_permission` VALUES (1403, 1, '', 55, 5676, 1, 50, 1, 1634178505, 1634178505, 1, 1);



INSERT INTO `fb_base_user_role` VALUES ('1', '2', '', '2', '50', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_user_role` VALUES ('2', '1', '', '3', '3', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_user_role` VALUES ('4', '4', '', '4', '54', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_user_role` VALUES ('5', '5', '', '5', '55', '1', '50', '1', '1', '1', '1', '1');
INSERT INTO `fb_base_user_role` VALUES ('6', '6', '', '6', '56', '1', '50', '1', '1', '1', '1', '1');


INSERT INTO `fb_base_setting_type` VALUES ('50', '1', '0', 'backend', '网站设置', 'website', '', 7, 1, 'text', '', '', '50', '1', '1600948343', '1600948343', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('83', '1', '0', 'backend', '联系方式', 'contact', '', 7, 1, 'text', '', '', '50', '1', '1600948360', '1600948360', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('85', '1', '0', 'backend', '邮件设置', 'mail', '', 7, 1, 'text', '', '', '50', '1', '1600948360', '1600948360', '1', '1');

INSERT INTO `fb_base_setting_type` VALUES ('5001', '1', '50', 'backend', '网站标题', 'website_name', '', 7, 1, 'text', '', '', '50', '1', '1600948383', '1600948392', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('5003', '1', '50', 'backend', '网站Logo', 'website_logo', '', 7, 1, 'image', '', '', '50', '1', '1600948430', '1600948430', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('5005', '1', '50', 'backend', '网站favicon', 'website_favicon', '浏览器上小图标', 7, 1, 'image', '', '', '50', '1', '1600948430', '1600948430', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('5007', '1', '50', 'backend', '网站banner', 'website_banner', 'Banner图', 7, 1, 'image', '', '', '50', '1', '1600948430', '1600948430', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('5009', '1', '50', 'backend', 'SEO标题', 'website_seo_title', '浏览器标题栏便于搜索引擎收录', 7, 1, 'text', '', '', '50', '1', '1601008916', '1601008916', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('5010', '1', '50', 'backend', 'SEO关键字', 'website_seo_keywords', '便于搜索引擎收录', 7, 1, 'text', '', '', '50', '1', '1601008916', '1601008916', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('5011', '1', '50', 'backend', 'SEO描述', 'website_seo_description', '便于搜索引擎收录', 7, 1, 'text', '', '', '50', '1', '1601008916', '1601008916', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('5013', '1', '50', 'backend', '主题模板', 'website_theme', '', 7, 1, 'dropDownList', 'default:default,green:green,black:black', 'default', '50', '1', '1600948430', '1600948430', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('5015', '1', '50', 'backend', '网站通告', 'website_brief', '', 7, 1, 'text', '', '', '50', '1', '1600948430', '1600948430', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('5017', '1', '50', 'backend', '版权标识', 'website_copyright', '', 7, 1, 'text', '', 'All rights reserved', '50', '1', '1601003987', '1601003987', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('5021', '1', '50', 'backend', '统计代码', 'website_stat', '加载在底部，支持百度统计cnzz等', 7, 1, 'textarea', '', '', '50', '1', '1601008532', '1601008544', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('5023', '1', '50', 'backend', '地图代码', 'website_map', 'iframe方式', 7, 1, 'text', '', '', '50', '1', '1601008532', '1601008544', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('5031', '1', '50', 'backend', '注册用户需要验证邮箱才能登录', 'website_user_login_need_verify', '', 7, 1, 'radioList', '0:否,1:是', '0', '50', '1', '1601008532', '1601008544', '1', '1');

INSERT INTO `fb_base_setting_type` VALUES ('8301', '1', '83', 'backend', '电话', 'contact_mobile', '', 7, 1, 'text', '', '', '50', '1', '1600948360', '1600948360', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('8303', '1', '83', 'backend', 'Email', 'contact_email', '', 7, 1, 'text', '', '', '50', '1', '1600948360', '1600948360', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('8305', '1', '83', 'backend', '邮编', 'contact_zipcode', '', 7, 1, 'text', '计算距离算运费时非常重要', '', '50', '1', '1600948360', '1600948360', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('8307', '1', '83', 'backend', '地址', 'contact_address', '', 7, 1, 'text', '', '', '50', '1', '1600948360', '1600948360', '1', '1');

INSERT INTO `fb_base_setting_type` VALUES ('8501', '1', '85', 'backend', 'Smtp Host', 'mail_smtp_host', '邮箱smtp主机地址，请申请outlook邮箱，并在设置中开启smtp，发送测试邮件后请在邮箱中确认', 7, 1, 'text', '', '', '50', '1', '1600948360', '1600948360', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('8503', '1', '85', 'backend', 'Smtp Port', 'mail_smtp_port', '端口号', 7, 1, 'text', '', '', '50', '1', '1600948360', '1600948360', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('8505', '1', '85', 'backend', 'Smtp Username', 'mail_smtp_username', '用户名', 7, 1, 'text', '', '', '50', '1', '1600948360', '1600948360', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('8507', '1', '85', 'backend', 'Smtp Password', 'mail_smtp_password', '密码', 7, 1, 'text', '', '', '50', '1', '1600948360', '1600948360', '1', '1');
INSERT INTO `fb_base_setting_type` VALUES ('8509', '1', '85', 'backend', 'Smtp Encryption', 'mail_smtp_encryption', '加密方式', 7, 1, 'text', '', 'tls', '50', '1', '1600948360', '1600948360', '1', '1');

INSERT INTO `fb_base_schedule` VALUES ('1', '1', 'db/backup', '', '数据库备份，每天凌晨执行', '0 3 * * *', '1', '50', '1', '1600251253', '1602205031', '1', '1');
INSERT INTO `fb_base_schedule` VALUES ('2', '1', 'db/delete-log', '', '删除30天前日志，每天凌晨执行', '30 2 * * *', '1', '50', '1', '1600251253', '1602205031', '1', '1');

        ";

        //add user: admin  password: 123456
        $this->execute($sql);

    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
