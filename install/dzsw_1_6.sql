-- 
-- 数据库: ``
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_address_book`
-- 

DROP TABLE IF EXISTS `dzsw_address_book`;
CREATE TABLE `dzsw_address_book` (
  `abid` mediumint(8) NOT NULL auto_increment,
  `cid` mediumint(8) unsigned NOT NULL default '0',
  `gender` tinyint(1) unsigned NOT NULL default '0',
  `name` varchar(32) NOT NULL default '',
  `street_address` varchar(64) NOT NULL default '',
  `suburb` varchar(32) default NULL,
  `postcode` mediumint(6) unsigned NOT NULL default '0',
  `city` varchar(32) NOT NULL default '',
  `province` varchar(32) default NULL,
  `country` varchar(32) NOT NULL default '0',
  `tel_regular` varchar(32) NOT NULL default '',
  `tel_mobile` varchar(32) NOT NULL default '',
  `qq` varchar(15) NOT NULL default '',
  `msn` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`abid`),
  KEY `idx_ab_cid` (`cid`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_address_book`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_admingroups`
-- 

DROP TABLE IF EXISTS `dzsw_admingroups`;
CREATE TABLE `dzsw_admingroups` (
  `admingroupsid` smallint(6) unsigned NOT NULL auto_increment,
  `classes` enum('admin','operator') NOT NULL default 'admin',
  `grouptitle` varchar(30) NOT NULL default '',
  `allow_class_see` tinyint(1) unsigned NOT NULL default '0',
  `allow_class_edit` tinyint(1) unsigned NOT NULL default '0',
  `allow_class_add` tinyint(1) unsigned NOT NULL default '0',
  `allow_class_delete` tinyint(1) unsigned NOT NULL default '0',
  `allow_product_see` tinyint(1) unsigned NOT NULL default '0',
  `allow_product_edit` tinyint(1) unsigned NOT NULL default '0',
  `allow_product_add` tinyint(1) unsigned NOT NULL default '0',
  `allow_product_delete` tinyint(1) unsigned NOT NULL default '0',
  `allow_order_see` tinyint(1) unsigned NOT NULL default '0',
  `allow_customer_see` tinyint(1) unsigned NOT NULL default '0',
  `allow_customer_edit` tinyint(1) unsigned NOT NULL default '0',
  `allow_customer_add` tinyint(1) unsigned NOT NULL default '0',
  `allow_customer_delete` tinyint(1) unsigned NOT NULL default '0',
  `allow_news_edit` tinyint(1) unsigned NOT NULL default '0',
  `allow_news_add` tinyint(1) unsigned NOT NULL default '0',
  `allow_news_delete` tinyint(1) unsigned NOT NULL default '0',
  `allow_gbook_edit` tinyint(1) unsigned NOT NULL default '0',
  `allow_gbook_delete` tinyint(1) unsigned NOT NULL default '0',
  `allow_gbook_reply` tinyint(1) unsigned NOT NULL default '0',
  `allow_links_edit` tinyint(1) unsigned NOT NULL default '0',
  `allow_links_add` tinyint(1) unsigned NOT NULL default '0',
  `allow_links_delete` tinyint(1) unsigned NOT NULL default '0',
  `allow_sendmail` tinyint(1) unsigned NOT NULL default '0',
  `allow_orderstatus` varchar(200) NOT NULL default '',
  `allow_orderstatus_g` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`admingroupsid`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_admingroups`
-- 

INSERT INTO `dzsw_admingroups` VALUES (1, 'admin', '管理员', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'noauditing,auditing,waitforpay,partpay,allpay,makesurepay,cancel,shipping,waitforsend,partsend,allsend,sendsuccess,sendfail,over,getexchange,payback', 'noauditing,auditing,cancel,shipping,waitforsend,partsend,allsend,sendsuccess,sendfail,allpay,makesurepay,over,getexchange,payback');
INSERT INTO `dzsw_admingroups` VALUES (2, 'operator', '副管理员', 0, 1, 1, 1, 0, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'noauditing,auditing,waitforpay,partpay,allpay,makesurepay,cancel,shipping,waitforsend,partsend,allsend,sendsuccess,sendfail,over,getexchange,payback', 'noauditing,auditing,cancel,shipping,waitforsend,partsend,allsend,sendsuccess,sendfail,allpay,makesurepay,over,getexchange,payback');
INSERT INTO `dzsw_admingroups` VALUES (3, 'operator', '会计', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'waitforpay,partpay,allpay,makesurepay,payback', 'makesurepay,payback');
INSERT INTO `dzsw_admingroups` VALUES (4, 'operator', '客服人员', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'getexchange', 'getexchange');
INSERT INTO `dzsw_admingroups` VALUES (5, 'operator', '送货人员', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'shipping,waitforsend,partsend,allsend,sendsuccess,sendfail', 'shipping,waitforsend,allsend,sendsuccess,sendfail,allpay');
INSERT INTO `dzsw_admingroups` VALUES (6, 'operator', '订单审核人员', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'noauditing,auditing,cancel,over', 'noauditing,auditing,cancel,over');

-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_admins`
-- 

DROP TABLE IF EXISTS `dzsw_admins`;
CREATE TABLE `dzsw_admins` (
  `adminid` smallint(4) unsigned NOT NULL auto_increment,
  `email` varchar(96) NOT NULL default '',
  `password` varchar(40) NOT NULL default '',
  `admingroupsid` smallint(4) unsigned NOT NULL default '0',
  `createdate` int(10) unsigned NOT NULL default '0',
  `lastvisit` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`adminid`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_admins`
-- 

INSERT INTO `dzsw_admins` VALUES (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1, 1144512000, 1144512000);

-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_area`
-- 

DROP TABLE IF EXISTS `dzsw_area`;
CREATE TABLE `dzsw_area` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `type` tinytext NOT NULL,
  `parentid` mediumint(8) unsigned NOT NULL default '0',
  `name` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_area`
-- 

INSERT INTO `dzsw_area` VALUES (1, '0', 0, '中国');
INSERT INTO `dzsw_area` VALUES (2, '1', 1, '安徽');
INSERT INTO `dzsw_area` VALUES (3, '2', 2, '安庆');
INSERT INTO `dzsw_area` VALUES (4, '2', 2, '蚌埠');
INSERT INTO `dzsw_area` VALUES (5, '2', 2, '巢湖');
INSERT INTO `dzsw_area` VALUES (6, '2', 2, '池州');
INSERT INTO `dzsw_area` VALUES (7, '2', 2, '滁州');
INSERT INTO `dzsw_area` VALUES (8, '2', 2, '阜阳');
INSERT INTO `dzsw_area` VALUES (9, '2', 2, '合肥');
INSERT INTO `dzsw_area` VALUES (10, '2', 2, '淮北');
INSERT INTO `dzsw_area` VALUES (11, '2', 2, '淮南');
INSERT INTO `dzsw_area` VALUES (12, '2', 2, '黄山');
INSERT INTO `dzsw_area` VALUES (13, '2', 2, '六安');
INSERT INTO `dzsw_area` VALUES (14, '2', 2, '马鞍山');
INSERT INTO `dzsw_area` VALUES (15, '2', 2, '宿州');
INSERT INTO `dzsw_area` VALUES (16, '2', 2, '铜陵');
INSERT INTO `dzsw_area` VALUES (17, '2', 2, '芜湖');
INSERT INTO `dzsw_area` VALUES (18, '2', 2, '宣城');
INSERT INTO `dzsw_area` VALUES (19, '2', 2, '亳州');
INSERT INTO `dzsw_area` VALUES (20, '1', 1, '北京');
INSERT INTO `dzsw_area` VALUES (21, '2', 20, '北京市区');
INSERT INTO `dzsw_area` VALUES (22, '2', 20, '北京效区');
INSERT INTO `dzsw_area` VALUES (23, '1', 1, '福建');
INSERT INTO `dzsw_area` VALUES (24, '2', 23, '福州');
INSERT INTO `dzsw_area` VALUES (25, '2', 23, '龙岩');
INSERT INTO `dzsw_area` VALUES (26, '2', 23, '南平');
INSERT INTO `dzsw_area` VALUES (27, '2', 23, '宁德');
INSERT INTO `dzsw_area` VALUES (28, '2', 23, '莆田');
INSERT INTO `dzsw_area` VALUES (29, '2', 23, '泉州');
INSERT INTO `dzsw_area` VALUES (30, '2', 23, '三明');
INSERT INTO `dzsw_area` VALUES (31, '2', 23, '厦门');
INSERT INTO `dzsw_area` VALUES (32, '2', 23, '漳州');
INSERT INTO `dzsw_area` VALUES (33, '1', 1, '甘肃');
INSERT INTO `dzsw_area` VALUES (34, '2', 33, '白银');
INSERT INTO `dzsw_area` VALUES (35, '2', 33, '定西');
INSERT INTO `dzsw_area` VALUES (36, '2', 33, '甘南藏族自治州');
INSERT INTO `dzsw_area` VALUES (37, '2', 33, '嘉峪关');
INSERT INTO `dzsw_area` VALUES (38, '2', 33, '金昌');
INSERT INTO `dzsw_area` VALUES (39, '2', 33, '酒泉');
INSERT INTO `dzsw_area` VALUES (40, '2', 33, '兰州');
INSERT INTO `dzsw_area` VALUES (41, '2', 33, '临夏回族自治州');
INSERT INTO `dzsw_area` VALUES (42, '2', 33, '陇南');
INSERT INTO `dzsw_area` VALUES (43, '2', 33, '平凉');
INSERT INTO `dzsw_area` VALUES (44, '2', 33, '庆阳');
INSERT INTO `dzsw_area` VALUES (45, '2', 33, '天水');
INSERT INTO `dzsw_area` VALUES (46, '2', 33, '武威');
INSERT INTO `dzsw_area` VALUES (47, '2', 33, '张掖');
INSERT INTO `dzsw_area` VALUES (48, '1', 1, '广东');
INSERT INTO `dzsw_area` VALUES (49, '2', 48, '潮州');
INSERT INTO `dzsw_area` VALUES (50, '2', 48, '东莞');
INSERT INTO `dzsw_area` VALUES (51, '2', 48, '佛山');
INSERT INTO `dzsw_area` VALUES (52, '2', 48, '广州');
INSERT INTO `dzsw_area` VALUES (53, '2', 48, '河源');
INSERT INTO `dzsw_area` VALUES (54, '2', 48, '惠州');
INSERT INTO `dzsw_area` VALUES (55, '2', 48, '江门');
INSERT INTO `dzsw_area` VALUES (56, '2', 48, '揭阳');
INSERT INTO `dzsw_area` VALUES (57, '2', 48, '茂名');
INSERT INTO `dzsw_area` VALUES (58, '2', 48, '梅州');
INSERT INTO `dzsw_area` VALUES (59, '2', 48, '清远');
INSERT INTO `dzsw_area` VALUES (60, '2', 48, '汕头');
INSERT INTO `dzsw_area` VALUES (61, '2', 48, '汕尾');
INSERT INTO `dzsw_area` VALUES (62, '2', 48, '韶关');
INSERT INTO `dzsw_area` VALUES (63, '2', 48, '深圳');
INSERT INTO `dzsw_area` VALUES (64, '2', 48, '阳江');
INSERT INTO `dzsw_area` VALUES (65, '2', 48, '云浮');
INSERT INTO `dzsw_area` VALUES (66, '2', 48, '湛江');
INSERT INTO `dzsw_area` VALUES (67, '2', 48, '肇庆');
INSERT INTO `dzsw_area` VALUES (68, '2', 48, '中山');
INSERT INTO `dzsw_area` VALUES (69, '2', 48, '珠海');
INSERT INTO `dzsw_area` VALUES (70, '1', 1, '广西');
INSERT INTO `dzsw_area` VALUES (71, '2', 70, '百色');
INSERT INTO `dzsw_area` VALUES (72, '2', 70, '北海');
INSERT INTO `dzsw_area` VALUES (73, '2', 70, '崇左');
INSERT INTO `dzsw_area` VALUES (74, '2', 70, '防城港');
INSERT INTO `dzsw_area` VALUES (75, '2', 70, '桂林');
INSERT INTO `dzsw_area` VALUES (76, '2', 70, '贵港');
INSERT INTO `dzsw_area` VALUES (77, '2', 70, '河池');
INSERT INTO `dzsw_area` VALUES (78, '2', 70, '贺州');
INSERT INTO `dzsw_area` VALUES (79, '2', 70, '来宾');
INSERT INTO `dzsw_area` VALUES (80, '2', 70, '柳州');
INSERT INTO `dzsw_area` VALUES (81, '2', 70, '南宁');
INSERT INTO `dzsw_area` VALUES (82, '2', 70, '钦州');
INSERT INTO `dzsw_area` VALUES (83, '2', 70, '梧州');
INSERT INTO `dzsw_area` VALUES (84, '2', 70, '玉林');
INSERT INTO `dzsw_area` VALUES (85, '1', 1, '贵州');
INSERT INTO `dzsw_area` VALUES (86, '2', 85, '安顺');
INSERT INTO `dzsw_area` VALUES (87, '2', 85, '毕节');
INSERT INTO `dzsw_area` VALUES (88, '2', 85, '贵阳');
INSERT INTO `dzsw_area` VALUES (89, '2', 85, '六盘水');
INSERT INTO `dzsw_area` VALUES (90, '2', 85, '黔东南苗族侗族自治州');
INSERT INTO `dzsw_area` VALUES (91, '2', 85, '黔南布依族苗族自治州');
INSERT INTO `dzsw_area` VALUES (92, '2', 85, '黔西南布依族苗族自治州');
INSERT INTO `dzsw_area` VALUES (93, '2', 85, '铜仁');
INSERT INTO `dzsw_area` VALUES (94, '2', 85, '遵义');
INSERT INTO `dzsw_area` VALUES (95, '1', 1, '海南');
INSERT INTO `dzsw_area` VALUES (96, '2', 95, '白沙黎族自治县');
INSERT INTO `dzsw_area` VALUES (97, '2', 95, '保亭黎族苗族自治县');
INSERT INTO `dzsw_area` VALUES (98, '2', 95, '昌江黎族自治县');
INSERT INTO `dzsw_area` VALUES (99, '2', 95, '澄迈县');
INSERT INTO `dzsw_area` VALUES (100, '2', 95, '定安县');
INSERT INTO `dzsw_area` VALUES (101, '2', 95, '东方');
INSERT INTO `dzsw_area` VALUES (102, '2', 95, '海口');
INSERT INTO `dzsw_area` VALUES (103, '2', 95, '乐东黎族自治县');
INSERT INTO `dzsw_area` VALUES (104, '2', 95, '临高县');
INSERT INTO `dzsw_area` VALUES (105, '2', 95, '陵水黎族自治县');
INSERT INTO `dzsw_area` VALUES (106, '2', 95, '琼海');
INSERT INTO `dzsw_area` VALUES (107, '2', 95, '琼中黎族苗族自治县');
INSERT INTO `dzsw_area` VALUES (108, '2', 95, '三亚');
INSERT INTO `dzsw_area` VALUES (109, '2', 95, '屯昌县');
INSERT INTO `dzsw_area` VALUES (110, '2', 95, '万宁');
INSERT INTO `dzsw_area` VALUES (111, '2', 95, '文昌');
INSERT INTO `dzsw_area` VALUES (112, '2', 95, '五指山');
INSERT INTO `dzsw_area` VALUES (113, '2', 95, '儋州');
INSERT INTO `dzsw_area` VALUES (114, '1', 1, '河北');
INSERT INTO `dzsw_area` VALUES (115, '2', 114, '保定');
INSERT INTO `dzsw_area` VALUES (116, '2', 114, '沧州');
INSERT INTO `dzsw_area` VALUES (117, '2', 114, '承德');
INSERT INTO `dzsw_area` VALUES (118, '2', 114, '邯郸');
INSERT INTO `dzsw_area` VALUES (119, '2', 114, '衡水');
INSERT INTO `dzsw_area` VALUES (120, '2', 114, '廊坊');
INSERT INTO `dzsw_area` VALUES (121, '2', 114, '秦皇岛');
INSERT INTO `dzsw_area` VALUES (122, '2', 114, '石家庄');
INSERT INTO `dzsw_area` VALUES (123, '2', 114, '唐山');
INSERT INTO `dzsw_area` VALUES (124, '2', 114, '邢台');
INSERT INTO `dzsw_area` VALUES (125, '2', 114, '张家口');
INSERT INTO `dzsw_area` VALUES (126, '1', 1, '河南');
INSERT INTO `dzsw_area` VALUES (127, '2', 126, '安阳');
INSERT INTO `dzsw_area` VALUES (128, '2', 126, '鹤壁');
INSERT INTO `dzsw_area` VALUES (129, '2', 126, '济源');
INSERT INTO `dzsw_area` VALUES (130, '2', 126, '焦作');
INSERT INTO `dzsw_area` VALUES (131, '2', 126, '开封');
INSERT INTO `dzsw_area` VALUES (132, '2', 126, '洛阳');
INSERT INTO `dzsw_area` VALUES (133, '2', 126, '南阳');
INSERT INTO `dzsw_area` VALUES (134, '2', 126, '平顶山');
INSERT INTO `dzsw_area` VALUES (135, '2', 126, '三门峡');
INSERT INTO `dzsw_area` VALUES (136, '2', 126, '商丘');
INSERT INTO `dzsw_area` VALUES (137, '2', 126, '新乡');
INSERT INTO `dzsw_area` VALUES (138, '2', 126, '信阳');
INSERT INTO `dzsw_area` VALUES (139, '2', 126, '许昌');
INSERT INTO `dzsw_area` VALUES (140, '2', 126, '郑州');
INSERT INTO `dzsw_area` VALUES (141, '2', 126, '周口');
INSERT INTO `dzsw_area` VALUES (142, '2', 126, '驻马店');
INSERT INTO `dzsw_area` VALUES (143, '2', 126, '漯河');
INSERT INTO `dzsw_area` VALUES (144, '2', 126, '濮阳');
INSERT INTO `dzsw_area` VALUES (145, '1', 1, '黑龙江');
INSERT INTO `dzsw_area` VALUES (146, '2', 145, '大庆');
INSERT INTO `dzsw_area` VALUES (147, '2', 145, '大兴安岭');
INSERT INTO `dzsw_area` VALUES (148, '2', 145, '哈尔滨');
INSERT INTO `dzsw_area` VALUES (149, '2', 145, '鹤岗');
INSERT INTO `dzsw_area` VALUES (150, '2', 145, '黑河');
INSERT INTO `dzsw_area` VALUES (151, '2', 145, '鸡西');
INSERT INTO `dzsw_area` VALUES (152, '2', 145, '佳木斯');
INSERT INTO `dzsw_area` VALUES (153, '2', 145, '牡丹江');
INSERT INTO `dzsw_area` VALUES (154, '2', 145, '七台河');
INSERT INTO `dzsw_area` VALUES (155, '2', 145, '齐齐哈尔');
INSERT INTO `dzsw_area` VALUES (156, '2', 145, '双鸭山');
INSERT INTO `dzsw_area` VALUES (157, '2', 145, '绥化');
INSERT INTO `dzsw_area` VALUES (158, '2', 145, '伊春');
INSERT INTO `dzsw_area` VALUES (159, '1', 1, '湖北');
INSERT INTO `dzsw_area` VALUES (160, '2', 159, '鄂州');
INSERT INTO `dzsw_area` VALUES (161, '2', 159, '恩施土家族苗族自治州');
INSERT INTO `dzsw_area` VALUES (162, '2', 159, '黄冈');
INSERT INTO `dzsw_area` VALUES (163, '2', 159, '黄石');
INSERT INTO `dzsw_area` VALUES (164, '2', 159, '荆门');
INSERT INTO `dzsw_area` VALUES (165, '2', 159, '荆州');
INSERT INTO `dzsw_area` VALUES (166, '2', 159, '潜江');
INSERT INTO `dzsw_area` VALUES (167, '2', 159, '神农架林区');
INSERT INTO `dzsw_area` VALUES (168, '2', 159, '十堰');
INSERT INTO `dzsw_area` VALUES (169, '2', 159, '随州');
INSERT INTO `dzsw_area` VALUES (170, '2', 159, '天门');
INSERT INTO `dzsw_area` VALUES (171, '2', 159, '武汉');
INSERT INTO `dzsw_area` VALUES (172, '2', 159, '仙桃');
INSERT INTO `dzsw_area` VALUES (173, '2', 159, '咸宁');
INSERT INTO `dzsw_area` VALUES (174, '2', 159, '襄樊');
INSERT INTO `dzsw_area` VALUES (175, '2', 159, '孝感');
INSERT INTO `dzsw_area` VALUES (176, '2', 159, '宜昌');
INSERT INTO `dzsw_area` VALUES (177, '1', 1, '湖南');
INSERT INTO `dzsw_area` VALUES (178, '2', 177, '常德');
INSERT INTO `dzsw_area` VALUES (179, '2', 177, '长沙');
INSERT INTO `dzsw_area` VALUES (180, '2', 177, '郴州');
INSERT INTO `dzsw_area` VALUES (181, '2', 177, '衡阳');
INSERT INTO `dzsw_area` VALUES (182, '2', 177, '怀化');
INSERT INTO `dzsw_area` VALUES (183, '2', 177, '娄底');
INSERT INTO `dzsw_area` VALUES (184, '2', 177, '邵阳');
INSERT INTO `dzsw_area` VALUES (185, '2', 177, '湘潭');
INSERT INTO `dzsw_area` VALUES (186, '2', 177, '湘西土家族苗族自治州');
INSERT INTO `dzsw_area` VALUES (187, '2', 177, '益阳');
INSERT INTO `dzsw_area` VALUES (188, '2', 177, '永州');
INSERT INTO `dzsw_area` VALUES (189, '2', 177, '岳阳');
INSERT INTO `dzsw_area` VALUES (190, '2', 177, '张家界');
INSERT INTO `dzsw_area` VALUES (191, '2', 177, '株洲');
INSERT INTO `dzsw_area` VALUES (192, '1', 1, '吉林');
INSERT INTO `dzsw_area` VALUES (193, '2', 192, '白城');
INSERT INTO `dzsw_area` VALUES (194, '2', 192, '白山');
INSERT INTO `dzsw_area` VALUES (195, '2', 192, '长春');
INSERT INTO `dzsw_area` VALUES (196, '2', 192, '吉林');
INSERT INTO `dzsw_area` VALUES (197, '2', 192, '辽源');
INSERT INTO `dzsw_area` VALUES (198, '2', 192, '四平');
INSERT INTO `dzsw_area` VALUES (199, '2', 192, '松原');
INSERT INTO `dzsw_area` VALUES (200, '2', 192, '通化');
INSERT INTO `dzsw_area` VALUES (201, '2', 192, '延边朝鲜族自治州');
INSERT INTO `dzsw_area` VALUES (202, '1', 1, '江苏');
INSERT INTO `dzsw_area` VALUES (203, '2', 202, '常州');
INSERT INTO `dzsw_area` VALUES (204, '2', 202, '淮安');
INSERT INTO `dzsw_area` VALUES (205, '2', 202, '连云港');
INSERT INTO `dzsw_area` VALUES (206, '2', 202, '南京');
INSERT INTO `dzsw_area` VALUES (207, '2', 202, '南通');
INSERT INTO `dzsw_area` VALUES (208, '2', 202, '苏州');
INSERT INTO `dzsw_area` VALUES (209, '2', 202, '宿迁');
INSERT INTO `dzsw_area` VALUES (210, '2', 202, '泰州');
INSERT INTO `dzsw_area` VALUES (211, '2', 202, '无锡');
INSERT INTO `dzsw_area` VALUES (212, '2', 202, '徐州');
INSERT INTO `dzsw_area` VALUES (213, '2', 202, '盐城');
INSERT INTO `dzsw_area` VALUES (214, '2', 202, '扬州');
INSERT INTO `dzsw_area` VALUES (215, '2', 202, '镇江');
INSERT INTO `dzsw_area` VALUES (216, '1', 1, '江西');
INSERT INTO `dzsw_area` VALUES (217, '2', 216, '抚州');
INSERT INTO `dzsw_area` VALUES (218, '2', 216, '赣州');
INSERT INTO `dzsw_area` VALUES (219, '2', 216, '吉安');
INSERT INTO `dzsw_area` VALUES (220, '2', 216, '景德镇');
INSERT INTO `dzsw_area` VALUES (221, '2', 216, '九江');
INSERT INTO `dzsw_area` VALUES (222, '2', 216, '南昌');
INSERT INTO `dzsw_area` VALUES (223, '2', 216, '萍乡');
INSERT INTO `dzsw_area` VALUES (224, '2', 216, '上饶');
INSERT INTO `dzsw_area` VALUES (225, '2', 216, '新余');
INSERT INTO `dzsw_area` VALUES (226, '2', 216, '宜春');
INSERT INTO `dzsw_area` VALUES (227, '2', 216, '鹰潭');
INSERT INTO `dzsw_area` VALUES (228, '1', 1, '辽宁');
INSERT INTO `dzsw_area` VALUES (229, '2', 228, '鞍山');
INSERT INTO `dzsw_area` VALUES (230, '2', 228, '本溪');
INSERT INTO `dzsw_area` VALUES (231, '2', 228, '朝阳');
INSERT INTO `dzsw_area` VALUES (232, '2', 228, '大连');
INSERT INTO `dzsw_area` VALUES (233, '2', 228, '丹东');
INSERT INTO `dzsw_area` VALUES (234, '2', 228, '抚顺');
INSERT INTO `dzsw_area` VALUES (235, '2', 228, '阜新');
INSERT INTO `dzsw_area` VALUES (236, '2', 228, '葫芦岛');
INSERT INTO `dzsw_area` VALUES (237, '2', 228, '锦州');
INSERT INTO `dzsw_area` VALUES (238, '2', 228, '辽阳');
INSERT INTO `dzsw_area` VALUES (239, '2', 228, '盘锦');
INSERT INTO `dzsw_area` VALUES (240, '2', 228, '沈阳');
INSERT INTO `dzsw_area` VALUES (241, '2', 228, '铁岭');
INSERT INTO `dzsw_area` VALUES (242, '2', 228, '营口');
INSERT INTO `dzsw_area` VALUES (243, '1', 1, '内蒙古');
INSERT INTO `dzsw_area` VALUES (244, '2', 243, '阿拉善盟');
INSERT INTO `dzsw_area` VALUES (245, '2', 243, '巴彦淖尔盟');
INSERT INTO `dzsw_area` VALUES (246, '2', 243, '包头');
INSERT INTO `dzsw_area` VALUES (247, '2', 243, '赤峰');
INSERT INTO `dzsw_area` VALUES (248, '2', 243, '鄂尔多斯');
INSERT INTO `dzsw_area` VALUES (249, '2', 243, '呼和浩特');
INSERT INTO `dzsw_area` VALUES (250, '2', 243, '呼伦贝尔');
INSERT INTO `dzsw_area` VALUES (251, '2', 243, '通辽');
INSERT INTO `dzsw_area` VALUES (252, '2', 243, '乌海');
INSERT INTO `dzsw_area` VALUES (253, '2', 243, '乌兰察布盟');
INSERT INTO `dzsw_area` VALUES (254, '2', 243, '锡林郭勒盟');
INSERT INTO `dzsw_area` VALUES (255, '2', 243, '兴安盟');
INSERT INTO `dzsw_area` VALUES (256, '1', 1, '宁夏');
INSERT INTO `dzsw_area` VALUES (257, '2', 256, '固原');
INSERT INTO `dzsw_area` VALUES (258, '2', 256, '石嘴山');
INSERT INTO `dzsw_area` VALUES (259, '2', 256, '吴忠');
INSERT INTO `dzsw_area` VALUES (260, '2', 256, '银川');
INSERT INTO `dzsw_area` VALUES (261, '1', 1, '青海');
INSERT INTO `dzsw_area` VALUES (262, '2', 261, '果洛藏族自治州');
INSERT INTO `dzsw_area` VALUES (263, '2', 261, '海北藏族自治州');
INSERT INTO `dzsw_area` VALUES (264, '2', 261, '海东');
INSERT INTO `dzsw_area` VALUES (265, '2', 261, '海南藏族自治州');
INSERT INTO `dzsw_area` VALUES (266, '2', 261, '海西蒙古族藏族自治州');
INSERT INTO `dzsw_area` VALUES (267, '2', 261, '黄南藏族自治州');
INSERT INTO `dzsw_area` VALUES (268, '2', 261, '西宁');
INSERT INTO `dzsw_area` VALUES (269, '2', 261, '玉树藏族自治州');
INSERT INTO `dzsw_area` VALUES (270, '1', 1, '山东');
INSERT INTO `dzsw_area` VALUES (271, '2', 270, '滨州');
INSERT INTO `dzsw_area` VALUES (272, '2', 270, '德州');
INSERT INTO `dzsw_area` VALUES (273, '2', 270, '东营');
INSERT INTO `dzsw_area` VALUES (274, '2', 270, '菏泽');
INSERT INTO `dzsw_area` VALUES (275, '2', 270, '济南');
INSERT INTO `dzsw_area` VALUES (276, '2', 270, '济宁');
INSERT INTO `dzsw_area` VALUES (277, '2', 270, '莱芜');
INSERT INTO `dzsw_area` VALUES (278, '2', 270, '聊城');
INSERT INTO `dzsw_area` VALUES (279, '2', 270, '临沂');
INSERT INTO `dzsw_area` VALUES (280, '2', 270, '青岛');
INSERT INTO `dzsw_area` VALUES (281, '2', 270, '日照');
INSERT INTO `dzsw_area` VALUES (282, '2', 270, '泰安');
INSERT INTO `dzsw_area` VALUES (283, '2', 270, '威海');
INSERT INTO `dzsw_area` VALUES (284, '2', 270, '潍坊');
INSERT INTO `dzsw_area` VALUES (285, '2', 270, '烟台');
INSERT INTO `dzsw_area` VALUES (286, '2', 270, '枣庄');
INSERT INTO `dzsw_area` VALUES (287, '2', 270, '淄博');
INSERT INTO `dzsw_area` VALUES (288, '1', 1, '山西');
INSERT INTO `dzsw_area` VALUES (289, '2', 288, '长治');
INSERT INTO `dzsw_area` VALUES (290, '2', 288, '大同');
INSERT INTO `dzsw_area` VALUES (291, '2', 288, '晋城');
INSERT INTO `dzsw_area` VALUES (292, '2', 288, '晋中');
INSERT INTO `dzsw_area` VALUES (293, '2', 288, '临汾');
INSERT INTO `dzsw_area` VALUES (294, '2', 288, '吕梁');
INSERT INTO `dzsw_area` VALUES (295, '2', 288, '朔州');
INSERT INTO `dzsw_area` VALUES (296, '2', 288, '太原');
INSERT INTO `dzsw_area` VALUES (297, '2', 288, '忻州');
INSERT INTO `dzsw_area` VALUES (298, '2', 288, '阳泉');
INSERT INTO `dzsw_area` VALUES (299, '2', 288, '运城');
INSERT INTO `dzsw_area` VALUES (300, '1', 1, '陕西');
INSERT INTO `dzsw_area` VALUES (301, '2', 300, '安康');
INSERT INTO `dzsw_area` VALUES (302, '2', 300, '宝鸡');
INSERT INTO `dzsw_area` VALUES (303, '2', 300, '汉中');
INSERT INTO `dzsw_area` VALUES (304, '2', 300, '商洛');
INSERT INTO `dzsw_area` VALUES (305, '2', 300, '铜川');
INSERT INTO `dzsw_area` VALUES (306, '2', 300, '渭南');
INSERT INTO `dzsw_area` VALUES (307, '2', 300, '西安');
INSERT INTO `dzsw_area` VALUES (308, '2', 300, '咸阳');
INSERT INTO `dzsw_area` VALUES (309, '2', 300, '延安');
INSERT INTO `dzsw_area` VALUES (310, '2', 300, '榆林');
INSERT INTO `dzsw_area` VALUES (311, '1', 1, '上海');
INSERT INTO `dzsw_area` VALUES (312, '2', 311, '上海市区');
INSERT INTO `dzsw_area` VALUES (313, '2', 311, '上海效区');
INSERT INTO `dzsw_area` VALUES (314, '1', 1, '四川');
INSERT INTO `dzsw_area` VALUES (315, '2', 314, '阿坝藏族羌族自治州');
INSERT INTO `dzsw_area` VALUES (316, '2', 314, '巴中');
INSERT INTO `dzsw_area` VALUES (317, '2', 314, '成都');
INSERT INTO `dzsw_area` VALUES (318, '2', 314, '达州');
INSERT INTO `dzsw_area` VALUES (319, '2', 314, '德阳');
INSERT INTO `dzsw_area` VALUES (320, '2', 314, '甘孜藏族自治州');
INSERT INTO `dzsw_area` VALUES (321, '2', 314, '广安');
INSERT INTO `dzsw_area` VALUES (322, '2', 314, '广元');
INSERT INTO `dzsw_area` VALUES (323, '2', 314, '乐山');
INSERT INTO `dzsw_area` VALUES (324, '2', 314, '凉山彝族自治州');
INSERT INTO `dzsw_area` VALUES (325, '2', 314, '眉山');
INSERT INTO `dzsw_area` VALUES (326, '2', 314, '绵阳');
INSERT INTO `dzsw_area` VALUES (327, '2', 314, '南充');
INSERT INTO `dzsw_area` VALUES (328, '2', 314, '内江');
INSERT INTO `dzsw_area` VALUES (329, '2', 314, '攀枝花');
INSERT INTO `dzsw_area` VALUES (330, '2', 314, '遂宁');
INSERT INTO `dzsw_area` VALUES (331, '2', 314, '雅安');
INSERT INTO `dzsw_area` VALUES (332, '2', 314, '宜宾');
INSERT INTO `dzsw_area` VALUES (333, '2', 314, '资阳');
INSERT INTO `dzsw_area` VALUES (334, '2', 314, '自贡');
INSERT INTO `dzsw_area` VALUES (335, '2', 314, '泸州');
INSERT INTO `dzsw_area` VALUES (336, '1', 1, '天津');
INSERT INTO `dzsw_area` VALUES (337, '2', 336, '天津市区');
INSERT INTO `dzsw_area` VALUES (338, '2', 336, '天津效区');
INSERT INTO `dzsw_area` VALUES (339, '1', 1, '西藏');
INSERT INTO `dzsw_area` VALUES (340, '2', 339, '阿里');
INSERT INTO `dzsw_area` VALUES (341, '2', 339, '昌都');
INSERT INTO `dzsw_area` VALUES (342, '2', 339, '拉萨');
INSERT INTO `dzsw_area` VALUES (343, '2', 339, '林芝');
INSERT INTO `dzsw_area` VALUES (344, '2', 339, '那曲');
INSERT INTO `dzsw_area` VALUES (345, '2', 339, '日喀则');
INSERT INTO `dzsw_area` VALUES (346, '2', 339, '山南');
INSERT INTO `dzsw_area` VALUES (347, '1', 1, '新疆');
INSERT INTO `dzsw_area` VALUES (348, '2', 347, '阿克苏');
INSERT INTO `dzsw_area` VALUES (349, '2', 347, '阿拉尔');
INSERT INTO `dzsw_area` VALUES (350, '2', 347, '巴音郭楞蒙古自治州');
INSERT INTO `dzsw_area` VALUES (351, '2', 347, '博尔塔拉蒙古自治州');
INSERT INTO `dzsw_area` VALUES (352, '2', 347, '昌吉回族自治州');
INSERT INTO `dzsw_area` VALUES (353, '2', 347, '哈密');
INSERT INTO `dzsw_area` VALUES (354, '2', 347, '和田');
INSERT INTO `dzsw_area` VALUES (355, '2', 347, '喀什');
INSERT INTO `dzsw_area` VALUES (356, '2', 347, '克拉玛依');
INSERT INTO `dzsw_area` VALUES (357, '2', 347, '克孜勒苏柯尔克孜自治州');
INSERT INTO `dzsw_area` VALUES (358, '2', 347, '石河子');
INSERT INTO `dzsw_area` VALUES (359, '2', 347, '图木舒克');
INSERT INTO `dzsw_area` VALUES (360, '2', 347, '吐鲁番');
INSERT INTO `dzsw_area` VALUES (361, '2', 347, '乌鲁木齐');
INSERT INTO `dzsw_area` VALUES (362, '2', 347, '五家渠');
INSERT INTO `dzsw_area` VALUES (363, '2', 347, '伊犁哈萨克自治州');
INSERT INTO `dzsw_area` VALUES (364, '1', 1, '云南');
INSERT INTO `dzsw_area` VALUES (365, '2', 364, '保山');
INSERT INTO `dzsw_area` VALUES (366, '2', 364, '楚雄彝族自治州');
INSERT INTO `dzsw_area` VALUES (367, '2', 364, '大理白族自治州');
INSERT INTO `dzsw_area` VALUES (368, '2', 364, '德宏傣族景颇族自治州');
INSERT INTO `dzsw_area` VALUES (369, '2', 364, '迪庆藏族自治州');
INSERT INTO `dzsw_area` VALUES (370, '2', 364, '红河哈尼族彝族自治州');
INSERT INTO `dzsw_area` VALUES (371, '2', 364, '昆明');
INSERT INTO `dzsw_area` VALUES (372, '2', 364, '丽江');
INSERT INTO `dzsw_area` VALUES (373, '2', 364, '临沧');
INSERT INTO `dzsw_area` VALUES (374, '2', 364, '怒江傈傈族自治州');
INSERT INTO `dzsw_area` VALUES (375, '2', 364, '曲靖');
INSERT INTO `dzsw_area` VALUES (376, '2', 364, '思茅');
INSERT INTO `dzsw_area` VALUES (377, '2', 364, '文山壮族苗族自治州');
INSERT INTO `dzsw_area` VALUES (378, '2', 364, '西双版纳傣族自治州');
INSERT INTO `dzsw_area` VALUES (379, '2', 364, '玉溪');
INSERT INTO `dzsw_area` VALUES (380, '2', 364, '昭通');
INSERT INTO `dzsw_area` VALUES (381, '1', 1, '浙江');
INSERT INTO `dzsw_area` VALUES (382, '2', 381, '杭州');
INSERT INTO `dzsw_area` VALUES (383, '2', 381, '湖州');
INSERT INTO `dzsw_area` VALUES (384, '2', 381, '嘉兴');
INSERT INTO `dzsw_area` VALUES (385, '2', 381, '金华');
INSERT INTO `dzsw_area` VALUES (386, '2', 381, '丽水');
INSERT INTO `dzsw_area` VALUES (387, '2', 381, '宁波');
INSERT INTO `dzsw_area` VALUES (388, '2', 381, '绍兴');
INSERT INTO `dzsw_area` VALUES (389, '2', 381, '台州');
INSERT INTO `dzsw_area` VALUES (390, '2', 381, '温州');
INSERT INTO `dzsw_area` VALUES (391, '2', 381, '舟山');
INSERT INTO `dzsw_area` VALUES (392, '2', 381, '衢州');
INSERT INTO `dzsw_area` VALUES (393, '1', 1, '重庆');
INSERT INTO `dzsw_area` VALUES (394, '2', 393, '重庆市区');
INSERT INTO `dzsw_area` VALUES (395, '2', 393, '重庆效区');
INSERT INTO `dzsw_area` VALUES (396, '1', 1, '港，澳');
INSERT INTO `dzsw_area` VALUES (397, '2', 396, '香港');
INSERT INTO `dzsw_area` VALUES (398, '2', 396, '澳门');
INSERT INTO `dzsw_area` VALUES (399, '1', 1, '台湾');
INSERT INTO `dzsw_area` VALUES (400, '2', 399, '台湾');
INSERT INTO `dzsw_area` VALUES (401, '0', 0, '美国');
INSERT INTO `dzsw_area` VALUES (402, '1', 401, '美国');
INSERT INTO `dzsw_area` VALUES (403, '2', 402, '美国');
INSERT INTO `dzsw_area` VALUES (404, '0', 0, '其它国家');
INSERT INTO `dzsw_area` VALUES (405, '1', 404, '其它国家');
INSERT INTO `dzsw_area` VALUES (406, '2', 405, '其它国家');

-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_classes`
-- 

DROP TABLE IF EXISTS `dzsw_classes`;
CREATE TABLE `dzsw_classes` (
  `classes_id` mediumint(8) unsigned NOT NULL auto_increment,
  `classes` tinyint(1) NOT NULL default '1',
  `title` varchar(100) NOT NULL default '',
  `parent_id` smallint(6) unsigned NOT NULL default '0',
  `showinheader` tinyint(2) NOT NULL default '0',
  `status` tinyint(1) NOT NULL default '1',
  `sort_order` tinyint(3) default '0',
  PRIMARY KEY  (`classes_id`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_classes`
-- 

INSERT INTO `dzsw_classes` VALUES (3, 2, '默认子分类1', 9, 1, 1, 5);
INSERT INTO `dzsw_classes` VALUES (5, 2, '默认子分类2', 9, 34, 1, 7);
INSERT INTO `dzsw_classes` VALUES (9, 1, '默认分类', 0, 0, 1, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_customers`
-- 

DROP TABLE IF EXISTS `dzsw_customers`;
CREATE TABLE `dzsw_customers` (
  `customers_id` mediumint(11) unsigned NOT NULL auto_increment,
  `email` varchar(96) NOT NULL default '',
  `groupid` smallint(6) unsigned NOT NULL default '0',
  `shipto` mediumint(8) unsigned NOT NULL default '0',
  `billto` mediumint(8) unsigned NOT NULL default '0',
  `deli_s_bill` tinyint(1) NOT NULL default '1',
  `shipping_method` varchar(32) NOT NULL default '0',
  `payment_method` varchar(32) NOT NULL default '0',
  `password` varchar(40) NOT NULL default '',
  `regdate` int(10) unsigned NOT NULL default '0',
  `lastvisit` int(10) unsigned NOT NULL default '0',
  `order_total` smallint(6) unsigned NOT NULL default '0',
  `comment` text NOT NULL,
  `credit` int(11) NOT NULL default '0',
  `money` decimal(15,2) NOT NULL default '0.00',
  `qq` varchar(20) NOT NULL default '',
  `msn` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`customers_id`),
  UNIQUE KEY `email_address` (`email`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_customers`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_gbook`
-- 

DROP TABLE IF EXISTS `dzsw_gbook`;
CREATE TABLE `dzsw_gbook` (
  `gid` mediumint(8) unsigned NOT NULL auto_increment,
  `cid` mediumint(8) NOT NULL default '0',
  `text` text NOT NULL,
  `date_added` int(10) unsigned NOT NULL default '0',
  `last_modified` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`gid`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_gbook`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_gbookreply`
-- 

DROP TABLE IF EXISTS `dzsw_gbookreply`;
CREATE TABLE `dzsw_gbookreply` (
  `grid` mediumint(8) unsigned NOT NULL auto_increment,
  `parent_id` mediumint(8) unsigned NOT NULL default '0',
  `adminid` mediumint(8) NOT NULL default '0',
  `text` text NOT NULL,
  `date_added` int(10) unsigned NOT NULL default '0',
  `last_modified` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`grid`),
  UNIQUE KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_gbookreply`
-- 

-- 
-- 表的结构 `dzsw_links`
-- 

DROP TABLE IF EXISTS `dzsw_links`;
CREATE TABLE `dzsw_links` (
  `id` smallint(6) unsigned NOT NULL auto_increment,
  `ordernum` tinyint(3) unsigned NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  `url` varchar(200) NOT NULL default '',
  `logo` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_links`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_lossremark`
-- 

DROP TABLE IF EXISTS `dzsw_lossremark`;
CREATE TABLE `dzsw_lossremark` (
  `id` int(10) NOT NULL auto_increment,
  `email` varchar(200) NOT NULL default '',
  `product_name` varchar(200) NOT NULL default '',
  `description` text NOT NULL,
  `date_add` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_lossremark`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_news`
-- 

DROP TABLE IF EXISTS `dzsw_news`;
CREATE TABLE `dzsw_news` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `subject` varchar(200) NOT NULL default '',
  `editer` varchar(100) NOT NULL default '',
  `date_add` int(10) unsigned NOT NULL default '0',
  `last_edit` int(10) unsigned NOT NULL default '0',
  `text` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_news`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_orders`
-- 

DROP TABLE IF EXISTS `dzsw_orders`;
CREATE TABLE `dzsw_orders` (
  `orders_id` int(10) unsigned NOT NULL auto_increment,
  `cid` mediumint(8) unsigned NOT NULL default '0',
  `c_email` varchar(64) NOT NULL default '',
  `d_name` varchar(64) NOT NULL default '',
  `d_street_address` varchar(160) NOT NULL default '',
  `d_suburb` varchar(32) NOT NULL default '',
  `d_city` varchar(32) NOT NULL default '',
  `d_postcode` mediumint(6) unsigned NOT NULL default '0',
  `d_tel_regular` varchar(32) NOT NULL default '',
  `d_tel_mobile` varchar(32) NOT NULL default '',
  `d_qq` varchar(20) NOT NULL default '',
  `d_msn` varchar(100) NOT NULL default '',
  `d_province` varchar(32) NOT NULL default '',
  `d_country` varchar(32) NOT NULL default '',
  `b_name` varchar(64) NOT NULL default '',
  `b_street_address` varchar(160) NOT NULL default '',
  `b_suburb` varchar(32) NOT NULL default '',
  `b_city` varchar(32) NOT NULL default '',
  `b_postcode` mediumint(6) unsigned NOT NULL default '0',
  `b_province` varchar(32) NOT NULL default '',
  `b_country` varchar(32) NOT NULL default '',
  `b_tel_mobile` varchar(32) NOT NULL default '',
  `b_tel_regular` varchar(32) NOT NULL default '',
  `b_qq` varchar(20) NOT NULL default '',
  `b_msn` varchar(100) NOT NULL default '',
  `comment` varchar(255) NOT NULL default '',
  `deli_s_bill` tinyint(1) unsigned NOT NULL default '1',
  `last_modified` int(10) unsigned NOT NULL default '0',
  `date_purchased` int(10) unsigned NOT NULL default '0',
  `ordersd_status` tinyint(3) unsigned NOT NULL default '0',
  `orders_date_finished` int(10) unsigned NOT NULL default '0',
  `payment_method` varchar(32) NOT NULL default '',
  `shipping_method` varchar(32) NOT NULL default '',
  `do_mark` tinyint(1) unsigned NOT NULL default '0',
  `orders_status` varchar(100) NOT NULL default 'noauditing',
  PRIMARY KEY  (`orders_id`),
  KEY `c_id` (`cid`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_orders`
-- 


-- 
-- 表的结构 `dzsw_orders_history`
-- 

DROP TABLE IF EXISTS `dzsw_orders_history`;
CREATE TABLE `dzsw_orders_history` (
  `ohid` int(10) unsigned NOT NULL auto_increment,
  `orders_id` int(10) unsigned NOT NULL default '0',
  `orders_status` varchar(100) NOT NULL default 'noauditing',
  `date_added` int(10) unsigned NOT NULL default '0',
  `notified` tinyint(1) unsigned default '0',
  `operator` varchar(150) default NULL,
  `total_mark` tinyint(1) unsigned NOT NULL default '0',
  `paidnum` decimal(15,2) unsigned NOT NULL default '0.00',
  `paid_type` char(1) NOT NULL default '',
  `payment_type` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`ohid`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_orders_history`
-- 


-- 
-- 表的结构 `dzsw_orders_products`
-- 

DROP TABLE IF EXISTS `dzsw_orders_products`;
CREATE TABLE `dzsw_orders_products` (
  `opid` int(10) unsigned NOT NULL auto_increment,
  `orders_id` int(10) unsigned NOT NULL default '0',
  `products_id` int(10) unsigned NOT NULL default '0',
  `model` varchar(32) default NULL,
  `name` varchar(64) NOT NULL default '',
  `price` decimal(15,2) NOT NULL default '0.00',
  `final_price` decimal(15,2) NOT NULL default '0.00',
  `quantity` smallint(6) unsigned NOT NULL default '1',
  PRIMARY KEY  (`opid`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_orders_products`
-- 


-- 
-- 表的结构 `dzsw_orders_total`
-- 

DROP TABLE IF EXISTS `dzsw_orders_total`;
CREATE TABLE `dzsw_orders_total` (
  `otid` int(10) unsigned NOT NULL auto_increment,
  `orders_id` int(11) NOT NULL default '0',
  `value` decimal(15,2) unsigned NOT NULL default '0.00',
  `classes` enum('product','shipping','total','leaverpay','mustpay','paid','othor') NOT NULL default 'product',
  PRIMARY KEY  (`otid`),
  KEY `idx_otid_oid` (`orders_id`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_orders_total`
-- 


-- 
-- 表的结构 `dzsw_payback`
-- 

DROP TABLE IF EXISTS `dzsw_payback`;
CREATE TABLE `dzsw_payback` (
  `id` int(10) NOT NULL auto_increment,
  `cid` int(10) NOT NULL default '0',
  `payreturn` varchar(100) NOT NULL default '',
  `payback` varchar(100) NOT NULL default '',
  `name` varchar(100) NOT NULL default '',
  `cartnum` varchar(100) NOT NULL default '',
  `bankname` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `cid` (`cid`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_payback`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_payment`
-- 

DROP TABLE IF EXISTS `dzsw_payment`;
CREATE TABLE `dzsw_payment` (
  `id` int(11) NOT NULL auto_increment,
  `parentid` int(11) NOT NULL default '0',
  `pay_key` varchar(100) NOT NULL default '',
  `title` varchar(200) NOT NULL default '',
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  `sort_order` tinyint(3) NOT NULL default '0',
  `showchild` tinyint(1) NOT NULL default '1',
  `type` enum('system','define') NOT NULL default 'system',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `pay_key` (`pay_key`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_payment`
-- 

INSERT INTO `dzsw_payment` VALUES (1, 0, 'goodsarrivepay', '货到付款', '如果您所在的地区支持送货上门服务，而且您选择了送货上门的送货方式，那么您可以使用货到付款的服务。', 1, 0, 0, 'system');
INSERT INTO `dzsw_payment` VALUES (2, 0, 'postpay', '邮局汇款', '邮政汇款适用于全国邮政范围所能覆盖的国内地区，您可以直接到邮局填写汇款单。我们会在您寄出之后2－5天收到汇款。', 1, 1, 1, 'system');
INSERT INTO `dzsw_payment` VALUES (3, 0, 'banktransfer', '银行转账', '即：个人对个人支付', 1, 2, 0, 'system');
INSERT INTO `dzsw_payment` VALUES (4, 0, 'online', '在线支付', '银行卡网上在线支付包括国际、国内信用卡、借记卡等。如：建行、工行、招行、农行、 VISA、 万事达MasterCard、美国运通卡AE等等。 您可以通过“提交订单”后的“提交成功” 页下方银行卡支付入口进行网上支付。', 1, 3, 0, 'system');
INSERT INTO `dzsw_payment` VALUES (5, 4, 'westpay', '西部支付', '已经接入近 20 家国内银行，支持 60 多种国内银行卡、信用卡实时在线支付，正在接入外币支付、手机支付、电话支付等多种支付手段，是国内为数不多的有独立支付体系和自主银行接入的支付平台之一。', 1, 0, 1, 'system');
INSERT INTO `dzsw_payment` VALUES (6, 4, 'chinabank', '网银在线', '与工商银行、招商银行、建设银行、农业银行、民生银行等数十家金融机构达成协议，全面支持全国19家银行的信用卡及借记卡实现网上支付。', 1, 0, 1, 'system');
INSERT INTO `dzsw_payment` VALUES (7, 3, 'construction', '建设银行储蓄卡', '', 1, 0, 1, 'system');
INSERT INTO `dzsw_payment` VALUES (9, 4, 'alipay', '支付宝', '支付宝，是支付宝公司针对网上交易而特别推出的安全付款服务，其运作的实质是以支付宝为信用中介，在买家确认收到商品前，由支付宝替买卖双方暂时保管货款的一种增值服务。', 1, 0, 1, 'system');
INSERT INTO `dzsw_payment` VALUES (20, 3, 'icbc', '工商银行储绪卡', '', 1, 0, 1, 'system');
INSERT INTO `dzsw_payment` VALUES (21, 3, 'merchants', '招商银行储绪卡', '', 1, 0, 1, 'system');

-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_payment_a`
-- 

DROP TABLE IF EXISTS `dzsw_payment_a`;
CREATE TABLE `dzsw_payment_a` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  `pakey` varchar(200) NOT NULL default '',
  `pvalue` text NOT NULL,
  `sort_order` tinyint(3) NOT NULL default '0',
  `type` enum('system','define') NOT NULL default 'system',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_payment_a`
-- 

INSERT INTO `dzsw_payment_a` VALUES (2, 5, '', 'account', 'www.soobic.com', 0, 'system');
INSERT INTO `dzsw_payment_a` VALUES (3, 7, '卡号：', 'cartnum', '1234 5678 1234 1234 567', 1, 'system');
INSERT INTO `dzsw_payment_a` VALUES (4, 7, '持卡人姓名：', 'manname', 'dzsw', 2, 'system');
INSERT INTO `dzsw_payment_a` VALUES (6, 2, '汇款地址：', 'address', '*****************', 1, 'system');
INSERT INTO `dzsw_payment_a` VALUES (7, 2, '邮政编码：', 'postcode', '100000', 2, 'system');
INSERT INTO `dzsw_payment_a` VALUES (8, 2, '收款人姓名：', 'manname', 'dzsw', 3, 'system');
INSERT INTO `dzsw_payment_a` VALUES (9, 9, '', 'account', 'dzsw@dzsw.com', 0, 'system');
INSERT INTO `dzsw_payment_a` VALUES (10, 9, '', 'safenum', 'ib8no1mg1l6rk1khkeetw8nvsngs7fdu', 0, 'system');
INSERT INTO `dzsw_payment_a` VALUES (14, 6, '会员账号：', 'v_mid', '41383', 0, 'system');
INSERT INTO `dzsw_payment_a` VALUES (15, 6, '网关模式：', 'style', '0', 0, 'system');
INSERT INTO `dzsw_payment_a` VALUES (17, 6, '币种', 'v_moneytype', '0', 0, 'system');
INSERT INTO `dzsw_payment_a` VALUES (18, 6, '数字签名', 'md5key', 'chinabank353638773', 0, 'system');
INSERT INTO `dzsw_payment_a` VALUES (34, 21, '卡号：', 'cartnum', '1234 5678 1234 1234 567', 0, 'define');
INSERT INTO `dzsw_payment_a` VALUES (35, 21, '持卡人姓名：', 'manname', 'dzsw', 0, 'define');
INSERT INTO `dzsw_payment_a` VALUES (30, 20, '卡号：', 'cartnum', '1234 5678 1234 1234 567', 0, 'define');
INSERT INTO `dzsw_payment_a` VALUES (31, 20, '持卡人姓名：', 'manname', 'dzsw', 0, 'define');

-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_products`
-- 

DROP TABLE IF EXISTS `dzsw_products`;
CREATE TABLE `dzsw_products` (
  `products_id` mediumint(8) unsigned NOT NULL auto_increment,
  `classes_id` mediumint(8) unsigned NOT NULL default '0',
  `type22` enum('common','specials','good') NOT NULL default 'common',
  `name` varchar(64) NOT NULL default '',
  `quantity` smallint(6) unsigned NOT NULL default '0',
  `model` varchar(12) NOT NULL default '',
  `image` mediumint(8) NOT NULL default '0',
  `price` decimal(15,2) unsigned NOT NULL default '0.00',
  `s_p` enum('2','1','0') NOT NULL default '0',
  `weight` decimal(5,2) unsigned NOT NULL default '0.00',
  `available` enum('1','0') NOT NULL default '1',
  `status` enum('1','0') NOT NULL default '1',
  `base_info` text NOT NULL,
  `description` text NOT NULL,
  `manufacturer` varchar(200) NOT NULL default '',
  `mid` smallint(6) unsigned NOT NULL default '0',
  `ordered` mediumint(8) unsigned NOT NULL default '0',
  `viewed` mediumint(8) unsigned NOT NULL default '0',
  `date_added` int(10) unsigned NOT NULL default '0',
  `last_modified` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`products_id`),
  KEY `s_pa` (`s_p`,`available`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_products`
-- 

INSERT INTO `dzsw_products` VALUES (8, 0, 'common', '默认商品1', 10, 'v1.6.0', 28, 24.00, '1', 0.50, '', '1', '规格：默认商品的规格', '<P>默认商品的详细说明</P>', 'dzsw', 0, 107, 224, 1136186718, 1146443007);
INSERT INTO `dzsw_products` VALUES (21, 0, 'common', '默认商品2', 10, 'v1.6.0', 0, 24.00, '0', 0.50, '', '1', '规格：默认商品的规格', '<P>默认商品的详细说明</P>', 'dzsw', 0, 0, 0, 1146443307, 1146443316);

-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_ptoc`
-- 

DROP TABLE IF EXISTS `dzsw_ptoc`;
CREATE TABLE `dzsw_ptoc` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `pid` mediumint(8) NOT NULL default '0',
  `cid` mediumint(8) NOT NULL default '0',
  `dateadd` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_ptoc`
-- 

INSERT INTO `dzsw_ptoc` VALUES (27, 8, 5, 1146443204);
INSERT INTO `dzsw_ptoc` VALUES (5, 7, 3, 1136186745);
INSERT INTO `dzsw_ptoc` VALUES (29, 21, 3, 1146443372);
INSERT INTO `dzsw_ptoc` VALUES (28, 21, 5, 1146443307);
INSERT INTO `dzsw_ptoc` VALUES (26, 8, 3, 1146443195);

-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_reviews`
-- 

DROP TABLE IF EXISTS `dzsw_reviews`;
CREATE TABLE `dzsw_reviews` (
  `rid` mediumint(8) unsigned NOT NULL auto_increment,
  `products_id` int(10) unsigned NOT NULL default '0',
  `email` varchar(128) NOT NULL default '',
  `review` text NOT NULL,
  `rating` tinyint(1) unsigned default '1',
  `date_added` int(10) unsigned NOT NULL default '0',
  `last_modified` int(10) unsigned NOT NULL default '0',
  `viewed` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`rid`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_reviews`
-- 

INSERT INTO `dzsw_reviews` VALUES (1, 8, '', '默认评论1', 5, 1142309502, 1142309502, 0);
INSERT INTO `dzsw_reviews` VALUES (2, 8, '', '默认评论2', 4, 1142309517, 1142309517, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_settings`
-- 

DROP TABLE IF EXISTS `dzsw_settings`;
CREATE TABLE `dzsw_settings` (
  `settings_id` smallint(6) unsigned NOT NULL auto_increment,
  `settings_key` varchar(64) NOT NULL default '',
  `value` varchar(255) NOT NULL default '',
  `group_id` tinyint(3) unsigned NOT NULL default '0',
  `sort_order` tinyint(3) unsigned NOT NULL default '0',
  `set_function` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`settings_id`),
  UNIQUE KEY `settings_key` (`settings_key`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_settings`
-- 

INSERT INTO `dzsw_settings` VALUES (1, 'store_version', 'V1.6', 0, 0, '');
INSERT INTO `dzsw_settings` VALUES (2, 'default_discount', '9.2', 6, 0, '');
INSERT INTO `dzsw_settings` VALUES (3, 'store_name', 'dzsw', 1, 1, '');
INSERT INTO `dzsw_settings` VALUES (4, 'storeurl', '', 1, 3, '');
INSERT INTO `dzsw_settings` VALUES (5, 'server_email', '', 1, 5, '');
INSERT INTO `dzsw_settings` VALUES (6, 'server_tel', '0716 - 4305182', 1, 7, '');
INSERT INTO `dzsw_settings` VALUES (7, 'server_address', '*********************', 1, 9, '');
INSERT INTO `dzsw_settings` VALUES (8, 'server_postcode', '434000', 1, 11, '');
INSERT INTO `dzsw_settings` VALUES (9, 'server_manname', 'dzsw', 1, 13, '');
INSERT INTO `dzsw_settings` VALUES (10, 'gzip_compression', 'false', 2, 1, 'settings_radio(array(''true'', ''false''),');
INSERT INTO `dzsw_settings` VALUES (11, 'display_pageparseinfo', 'false', 2, 3, 'settings_radio(array(''true'', ''false''),');
INSERT INTO `dzsw_settings` VALUES (12, 'stock_check', 'true', 2, 5, 'settings_radio(array(''true'', ''false''),');
INSERT INTO `dzsw_settings` VALUES (13, 'stock_limitshow', 'true', 2, 7, 'settings_radio(array(''true'', ''false''),');
INSERT INTO `dzsw_settings` VALUES (14, 'create_smallimage', 'false', 2, 9, 'settings_radio(array(''true'', ''false''),');
INSERT INTO `dzsw_settings` VALUES (15, 'orders_savetime', '200', 2, 11, '');
INSERT INTO `dzsw_settings` VALUES (16, 'user_checknum_inheader', 'true', 2, 13, 'settings_radio(array(''true'', ''false''),');
INSERT INTO `dzsw_settings` VALUES (17, 'user_checknum_infooter', 'false', 2, 15, 'settings_radio(array(''true'', ''false''),');
INSERT INTO `dzsw_settings` VALUES (18, 'sendmail_createorder', 'false', 3, 1, 'settings_radio(array(''true'', ''false''),');
INSERT INTO `dzsw_settings` VALUES (19, 'sendmail_createaccount', 'true', 3, 3, 'settings_radio(array(''true'', ''false''),');
INSERT INTO `dzsw_settings` VALUES (20, 'email_adminer', '', 3, 5, '');
INSERT INTO `dzsw_settings` VALUES (21, 'email_from', '', 3, 7, '');
INSERT INTO `dzsw_settings` VALUES (22, 'email_transport', 'sendmail', 3, 9, 'settings_radio(array(''sendmail'', ''smtp'', ''other''),');
INSERT INTO `dzsw_settings` VALUES (23, 'email_smtp_host', 'mail.yoursite.com', 3, 11, '');
INSERT INTO `dzsw_settings` VALUES (24, 'email_smtp_port', '25', 3, 13, '');
INSERT INTO `dzsw_settings` VALUES (25, 'email_othor_host', 'smtp.163.com', 3, 14, '');
INSERT INTO `dzsw_settings` VALUES (26, 'email_othor_port', '25', 3, 15, '');
INSERT INTO `dzsw_settings` VALUES (27, 'email_othor_auth', 'true', 3, 17, 'settings_radio(array(''true'', ''false''),');
INSERT INTO `dzsw_settings` VALUES (28, 'email_othor_username', 'account', 3, 19, '');
INSERT INTO `dzsw_settings` VALUES (29, 'email_othor_password', 'password', 3, 21, '');
INSERT INTO `dzsw_settings` VALUES (30, 'store_style', '1', 4, 1, 'settings_styles(');
INSERT INTO `dzsw_settings` VALUES (31, 'stock_limitsign', '***', 4, 3, '');
INSERT INTO `dzsw_settings` VALUES (32, 'index_new_productid', '', 4, 5, '');
INSERT INTO `dzsw_settings` VALUES (33, 'index_s_productid', '', 4, 7, '');
INSERT INTO `dzsw_settings` VALUES (34, 'header_classnum', '10', 4, 9, '');
INSERT INTO `dzsw_settings` VALUES (35, 'date_format', 'Y-m-d', 4, 11, '');
INSERT INTO `dzsw_settings` VALUES (36, 'time_ofset', '0', 4, 13, '');
INSERT INTO `dzsw_settings` VALUES (37, 'show_country', 'true', 4, 15, 'settings_radio(array(''true'', ''false''),');
INSERT INTO `dzsw_settings` VALUES (38, 'country_default', '1', 4, 17, 'settings_country_default(');
INSERT INTO `dzsw_settings` VALUES (39, 'show_qq', 'true', 4, 19, 'settings_radio(array(''true'', ''false''),');
INSERT INTO `dzsw_settings` VALUES (40, 'show_msn', 'true', 4, 21, 'settings_radio(array(''true'', ''false''),');
INSERT INTO `dzsw_settings` VALUES (41, 'smallimage_width', '138', 5, 1, '');
INSERT INTO `dzsw_settings` VALUES (43, 'smallimage_width2', '150', 5, 11, '');
INSERT INTO `dzsw_settings` VALUES (44, 'reviews_shownum', '10', 5, 15, '');
INSERT INTO `dzsw_settings` VALUES (45, 'index_productnumarow', '5', 5, 17, '');
INSERT INTO `dzsw_settings` VALUES (46, 'index_newproductnumofrow', '3', 5, 19, '');
INSERT INTO `dzsw_settings` VALUES (47, 'index_sproductnumofrow', '1', 5, 29, '');
INSERT INTO `dzsw_settings` VALUES (49, 'index_newsshownum', '4', 5, 37, '');
INSERT INTO `dzsw_settings` VALUES (50, 'productlist_numofrow', '16', 5, 39, '');
INSERT INTO `dzsw_settings` VALUES (51, 'gbook_numofrow', '16', 5, 59, '');
INSERT INTO `dzsw_settings` VALUES (52, 'customer_mark', 'true', 6, 1, 'settings_radio(array(''true'', ''false''),');
INSERT INTO `dzsw_settings` VALUES (53, 'nt_tomark', '10', 6, 3, '');
INSERT INTO `dzsw_settings` VALUES (54, 'user_leavepay', 'true', 6, 5, 'settings_radio(array(''true'', ''false''),');
INSERT INTO `dzsw_settings` VALUES (56, 'renzheng_code', '', 0, 0, '');
INSERT INTO `dzsw_settings` VALUES (58, 'email_othor_from', '', 3, 18, '');
INSERT INTO `dzsw_settings` VALUES (59, 'sendmail_cancelorder', 'true', 3, 2, 'settings_radio(array(''true'', ''false''),');
INSERT INTO `dzsw_settings` VALUES (60, 'picture_savepath', 'default', 2, 0, '');
INSERT INTO `dzsw_settings` VALUES (61, 'user_lossremark', 'true', 6, 66, 'settings_radio(array(''true'', ''false''),');
INSERT INTO `dzsw_settings` VALUES (62, 'seo_title', '', 7, 1, '');
INSERT INTO `dzsw_settings` VALUES (63, 'seo_keywords', '', 7, 6, '');
INSERT INTO `dzsw_settings` VALUES (64, 'seo_othor', '', 7, 8, '');
INSERT INTO `dzsw_settings` VALUES (65, 'seo_description', '', 7, 7, '');

-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_shipping`
-- 

DROP TABLE IF EXISTS `dzsw_shipping`;
CREATE TABLE `dzsw_shipping` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `filename` varchar(100) NOT NULL default '',
  `type` enum('system','define') NOT NULL default 'system',
  `areatype` tinyint(1) NOT NULL default '0',
  `title` varchar(200) NOT NULL default '',
  `description` text NOT NULL,
  `sortorder` tinyint(3) NOT NULL default '0',
  `status` tinyint(1) NOT NULL default '1',
  `desc_faq` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_shipping`
-- 

INSERT INTO `dzsw_shipping` VALUES (1, 'goodsself', 'system', 2, '送货上门', '目前我们开通了北京地区和武汉两个地区的送货上门服务。', 1, 1, '');
INSERT INTO `dzsw_shipping` VALUES (2, 'commonpost', 'system', 1, '普通邮递', '如果您对送货的时间没有要求，建议您选择此咱送货方式。', 2, 1, '');
INSERT INTO `dzsw_shipping` VALUES (3, 'quick', 'system', 1, '国内快递', '中国国内快递包裹，速度较快', 3, 1, '');
INSERT INTO `dzsw_shipping` VALUES (4, 'chinapostems', 'system', 1, '中国邮政ems', '速度较快，推荐使用。', 4, 1, '');

-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_shipping_fee`
-- 

DROP TABLE IF EXISTS `dzsw_shipping_fee`;
CREATE TABLE `dzsw_shipping_fee` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `shippingid` tinytext NOT NULL,
  `area` text NOT NULL,
  `fee` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_shipping_fee`
-- 

INSERT INTO `dzsw_shipping_fee` VALUES (1, '1', '21,22', '8');
INSERT INTO `dzsw_shipping_fee` VALUES (22, '1', '171', '6');
INSERT INTO `dzsw_shipping_fee` VALUES (27, '3', '300,33,256,216,159', '1:5:0.5:8:3.5:2');
INSERT INTO `dzsw_shipping_fee` VALUES (13, '4', '2,20,23,33,48,70,85,95,114,126,159,177,202,216,228,243,256,261,270,288,300,311,314,336,364,381,393', '0.5:0.5:20:6');
INSERT INTO `dzsw_shipping_fee` VALUES (14, '4', '192,339,145', '0.5:0.5:20:9');
INSERT INTO `dzsw_shipping_fee` VALUES (16, '3', '314,85', '1:5:0.5:9:4:2');
INSERT INTO `dzsw_shipping_fee` VALUES (17, '4', '347', '0.5:0.5:20:15');
INSERT INTO `dzsw_shipping_fee` VALUES (26, '3', '126', '1:5:0.5:6:2.5:1.5');
INSERT INTO `dzsw_shipping_fee` VALUES (28, '3', '20,114,336,288', '1:5:0.5:5:2:1');
INSERT INTO `dzsw_shipping_fee` VALUES (29, '3', '243,270,228', '1:5:0.5:6:2.5:1.2');
INSERT INTO `dzsw_shipping_fee` VALUES (30, '3', '202,311,2,192', '1:5:0.5:7:2.6:1.5');
INSERT INTO `dzsw_shipping_fee` VALUES (31, '3', '381,177', '1:5:0.5:8:3.5:2');
INSERT INTO `dzsw_shipping_fee` VALUES (32, '3', '23,261,95,70,48', '1:5:0.5:10:4.5:2.5');
INSERT INTO `dzsw_shipping_fee` VALUES (34, '3', '347,339,364', '1:5:0.5:12:6:3.5');
INSERT INTO `dzsw_shipping_fee` VALUES (33, '3', '145', '1:5:0.5:7:3:1.8');
INSERT INTO `dzsw_shipping_fee` VALUES (35, '4', '396', '0.5:0.5:20:30');
INSERT INTO `dzsw_shipping_fee` VALUES (36, '4', '399', '0.5:0.5:20:40');
INSERT INTO `dzsw_shipping_fee` VALUES (37, '4', '401,404', '0.5:0.5:20:45');
INSERT INTO `dzsw_shipping_fee` VALUES (38, '3', '396', '1:5:0.5:25:15:10');
INSERT INTO `dzsw_shipping_fee` VALUES (39, '3', '399', '1:5:0.5:30:15:10');
INSERT INTO `dzsw_shipping_fee` VALUES (40, '2', '300,33,256,216,159', '2.5');
INSERT INTO `dzsw_shipping_fee` VALUES (41, '2', '314,85', '3.8');
INSERT INTO `dzsw_shipping_fee` VALUES (42, '2', '126', '1.6');
INSERT INTO `dzsw_shipping_fee` VALUES (43, '2', '20,114,336,288', '0.7');
INSERT INTO `dzsw_shipping_fee` VALUES (44, '2', '243,270,228', '1.3');
INSERT INTO `dzsw_shipping_fee` VALUES (45, '2', '202,311,2,192', '2');
INSERT INTO `dzsw_shipping_fee` VALUES (46, '2', '381,177', '2.8');
INSERT INTO `dzsw_shipping_fee` VALUES (47, '2', '23,261,95,70,48', '4');
INSERT INTO `dzsw_shipping_fee` VALUES (48, '2', '347,339,364', '5.1');
INSERT INTO `dzsw_shipping_fee` VALUES (49, '2', '145', '2.6');
INSERT INTO `dzsw_shipping_fee` VALUES (50, '2', '396', '6');
INSERT INTO `dzsw_shipping_fee` VALUES (51, '2', '399', '7');

-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_source`
-- 

DROP TABLE IF EXISTS `dzsw_source`;
CREATE TABLE `dzsw_source` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `type` enum('1','0') NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  `extension` varchar(10) NOT NULL default '',
  `path` varchar(100) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `pid` mediumint(6) unsigned NOT NULL default '0',
  `dateadd` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_source`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_specials`
-- 

DROP TABLE IF EXISTS `dzsw_specials`;
CREATE TABLE `dzsw_specials` (
  `pid` smallint(6) unsigned NOT NULL default '0',
  `s_price` decimal(15,2) unsigned NOT NULL default '0.00',
  `endtime` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`pid`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_specials`
-- 

INSERT INTO `dzsw_specials` VALUES (8, 1.00, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_styles`
-- 

DROP TABLE IF EXISTS `dzsw_styles`;
CREATE TABLE `dzsw_styles` (
  `styleid` smallint(6) unsigned NOT NULL auto_increment,
  `title` varchar(22) NOT NULL default '',
  `tid` smallint(6) unsigned NOT NULL default '0',
  `imagedir` varchar(100) NOT NULL default '',
  `cssfilename` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`styleid`),
  KEY `themename` (`title`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_styles`
-- 

INSERT INTO `dzsw_styles` VALUES (1, 'Default', 1, 'images/default', 'default.css');

-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_templates`
-- 

DROP TABLE IF EXISTS `dzsw_templates`;
CREATE TABLE `dzsw_templates` (
  `tid` smallint(6) unsigned NOT NULL auto_increment,
  `title` varchar(40) NOT NULL default '',
  `directory` varchar(100) NOT NULL default '',
  `copyright` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`tid`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_templates`
-- 

INSERT INTO `dzsw_templates` VALUES (1, 'Default', 'default', '');

-- --------------------------------------------------------

-- 
-- 表的结构 `dzsw_usergroups`
-- 

DROP TABLE IF EXISTS `dzsw_usergroups`;
CREATE TABLE `dzsw_usergroups` (
  `groupid` smallint(6) unsigned NOT NULL auto_increment,
  `classes` enum('Guest','Member','Specials') NOT NULL default 'Member',
  `grouptitle` varchar(30) NOT NULL default '',
  `creditshigher` int(10) NOT NULL default '0',
  `creditslower` int(10) NOT NULL default '0',
  `groupdiscount` float NOT NULL default '0',
  PRIMARY KEY  (`groupid`),
  KEY `status` (`classes`),
  KEY `creditshigher` (`creditshigher`),
  KEY `creditslower` (`creditslower`)
) ENGINE=InnoDB;

-- 
-- 导出表中的数据 `dzsw_usergroups`
-- 

INSERT INTO `dzsw_usergroups` VALUES (1, 'Guest', '游客', 0, 0, 10);
INSERT INTO `dzsw_usergroups` VALUES (2, 'Member', '普通会员', 0, 999, 9.2);
INSERT INTO `dzsw_usergroups` VALUES (3, 'Member', '正式会员', 1000, 2999, 9);
INSERT INTO `dzsw_usergroups` VALUES (4, 'Member', '黄金会员', 3000, 9999, 8.5);
INSERT INTO `dzsw_usergroups` VALUES (5, 'Specials', 'VIP会员', 0, 0, 8);
