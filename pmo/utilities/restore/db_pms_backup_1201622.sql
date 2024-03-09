

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `activity` varchar(500) NOT NULL,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

INSERT INTO audit_logs VALUES("1","2022-12-15","Logged In","Property Management Officer");
INSERT INTO audit_logs VALUES("2","2022-12-15","Added Particular for Stockroom Supplies","Property Management Officer");
INSERT INTO audit_logs VALUES("3","2022-12-15","Added Stock for Stockroom Supplies","Property Management Officer");
INSERT INTO audit_logs VALUES("4","2022-12-15","Logged Out","Property Management Officer");
INSERT INTO audit_logs VALUES("5","2022-12-15","Logged In","Property Management Officer");
INSERT INTO audit_logs VALUES("6","2022-12-15","Added Particular for Janitorial Supplies","Property Management Officer");
INSERT INTO audit_logs VALUES("7","2022-12-15","Added Stock for Janitorial Supplies","Property Management Officer");
INSERT INTO audit_logs VALUES("8","2022-12-15","Released Issuance for Stockroom Supplies","Property Management Officer");
INSERT INTO audit_logs VALUES("9","2022-12-15","Released Issuance for Janitorial Supplies","Property Management Officer");
INSERT INTO audit_logs VALUES("10","2022-12-15","Generated Purchase Order for Stockroom Supplies","Property Management Officer");
INSERT INTO audit_logs VALUES("11","2022-12-15","Logged In","Property Management Officer");
INSERT INTO audit_logs VALUES("12","2022-12-16","Logged Out","Property Management Officer");
INSERT INTO audit_logs VALUES("13","2022-12-16","Logged Out","Auditor");
INSERT INTO audit_logs VALUES("14","2022-12-16","Logged In","Property Management Officer");
INSERT INTO audit_logs VALUES("15","2022-12-16","Logged In","Property Management Officer");



CREATE TABLE `janitorial_issuance_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO janitorial_issuance_report VALUES("1","December","2022");



CREATE TABLE `janitorial_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO janitorial_report VALUES("1","December","2022");



CREATE TABLE `memorandum_receipt` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `mr_no` int(255) DEFAULT NULL,
  `particulars` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `locID` int(255) NOT NULL,
  `locations` varchar(255) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

INSERT INTO memorandum_receipt VALUES("1","4000","Computer Monitor Led 24.5 AOC Led","5","Pcs","4900","13","MIS/ICT","Austin Andaya","2022-11-24");
INSERT INTO memorandum_receipt VALUES("2","4001","Computer Monitor Led 18.5 AOC Led","5","Pcs","4900","13","MIS/ICT","Austin Andaya","2022-11-29");
INSERT INTO memorandum_receipt VALUES("3","4002","Printer Epson FX 2175 sn GLX015979","2","Pcs","21900","13","MIS/ICT","Austin Andaya","2022-12-06");
INSERT INTO memorandum_receipt VALUES("4","4003","Computer Monitor Led 18.5 AOC Led","5","Pcs","4900","13","MIS/ICT","Austin Andaya","2022-11-29");
INSERT INTO memorandum_receipt VALUES("5","4004","Printer Epson FX 2175 sn GLX015979","1","Pcs","21900","13","MIS/ICT","Austin Andaya","2022-12-06");
INSERT INTO memorandum_receipt VALUES("6","4005","Kingston Flash Drive 16gb","2","Pcs","299","16","Printing Office ","Novem Quilop","2022-12-01");
INSERT INTO memorandum_receipt VALUES("7","4006","Computer Monitor Led 24.5 AOC Led","1","Pcs","4900","16","Printing Office ","Jayson Manzano","2022-11-24");
INSERT INTO memorandum_receipt VALUES("8","4007","Computer Monitor Led 18.5 AOC Led","2","Pcs","4900","1","Accounting Office/Auditor","Norlita Lopez","2022-11-29");
INSERT INTO memorandum_receipt VALUES("9","4008","Printer Epson FX 2175 sn GLX015979","1","Pcs","21900","32","Bookstore","Austin Andaya","2022-12-06");
INSERT INTO memorandum_receipt VALUES("10","4009","UPS Abierey 500 VA, black","1","Pcs","1650","38","Marketing Office","Edriane Mina","2022-12-01");
INSERT INTO memorandum_receipt VALUES("11","4010","Kingston Flash Drive 16gb","5","Pcs","299","38","Marketing Office","Edriane Mina","2022-12-01");
INSERT INTO memorandum_receipt VALUES("12","4011","UPS Abierey 500 VA, black","1","Pcs","1650","1","Accounting Office/Auditor","Edriane Mina","2022-12-01");
INSERT INTO memorandum_receipt VALUES("13","4012","Kingston Flash Drive 16gb","4","Pcs","299","1","Accounting Office/Auditor","Edriane Mina","2022-12-01");
INSERT INTO memorandum_receipt VALUES("14","4013","Computer Monitor Led 24.5 AOC Led","1","Pcs","4900","6","CICM Residence","Anyone","2022-11-24");
INSERT INTO memorandum_receipt VALUES("15","4014","Printer Epson FX 2175 sn GLX015979","1","Pcs","21900","13","MIS/ICT","Novem Quilop","2022-12-06");
INSERT INTO memorandum_receipt VALUES("16","4015","Printer Epson FX 2175 sn GLX015979","1","Pcs","21900","41","BEdS Cashier","Edriane Mina","2022-12-06");
INSERT INTO memorandum_receipt VALUES("17","4016","UPS APC 625VA","1","Pcs","3150","41","BEdS Cashier","Edriane Mina","2022-12-08");
INSERT INTO memorandum_receipt VALUES("18","4017","Office Table","1","Pcs","2500","41","BEdS Cashier","Edriane Mina","2022-12-09");
INSERT INTO memorandum_receipt VALUES("19","4018","Office Table","1","Pcs","2500","6","CICM Residence","Austin Andaya","2022-12-09");
INSERT INTO memorandum_receipt VALUES("20","4019","UPS Abierey 500 VA, black","1","Pcs","1650","31","Alumni Office","Edriane Mina","2022-12-01");
INSERT INTO memorandum_receipt VALUES("21","4020","Fan Desk 16","1","Pcs","780","31","Alumni Office","Edriane Mina","2022-12-08");
INSERT INTO memorandum_receipt VALUES("22","4021","Office Table","1","Pcs","2500","31","Alumni Office","Edriane Mina","2022-12-09");
INSERT INTO memorandum_receipt VALUES("23","4022","Fan Desk 16","1","Pcs","780","36","HR Office","Austin Andaya","2022-12-08");



CREATE TABLE `sample_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `particulars` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL DEFAULT 0,
  `unit` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO sample_order VALUES("1","Pencil Mongol 2","50","Pcs");



CREATE TABLE `stockroom_issuance_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO stockroom_issuance_report VALUES("2","December","2022");



CREATE TABLE `stockroom_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO stockroom_report VALUES("1","December","2022");



CREATE TABLE `summary_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO summary_report VALUES("1","December","2022");



CREATE TABLE `surrender_equip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surr_id` int(255) NOT NULL,
  `mr_no` int(255) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `surrendered_by` varchar(255) NOT NULL,
  `locations` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO surrender_equip VALUES("1","21","4012","Kingston Flash Drive 16gb","2","Pcs","2022-12-15","Edriane Mina","Accounting Office/Auditor","Surrendered");
INSERT INTO surrender_equip VALUES("2","12","4004","Printer Epson FX 2175 sn GLX015979","1","Pcs","2022-12-15","Austin Andaya","MIS/ICT","For Repair");
INSERT INTO surrender_equip VALUES("3","17","4009","UPS Abierey 500 VA, black","1","Pcs","2022-12-15","Edriane Mina","Marketing Office","For Disposal");
INSERT INTO surrender_equip VALUES("4","23","4018","Office Table","1","Pcs","2022-12-16","Austin Andaya","CICM Residence","For Repair");
INSERT INTO surrender_equip VALUES("5","25","4022","Fan Desk 16","1","Pcs","2022-12-16","Austin Andaya","HR Office","For Repair");



CREATE TABLE `tbl_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mr_no` int(255) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `po` int(255) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `quantity` int(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `locID` int(255) NOT NULL,
  `locations` varchar(255) NOT NULL DEFAULT 'Not Assigned',
  `recipient` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'OK',
  `date_moved` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_inventory VALUES("1","4000","CI 1990","20119","Computer Monitor Led 24.5 AOC Led","SKM Comp. Trade","2022-11-24","4","Pcs","4900","13","MIS/ICT","Austin Andaya","OK","2022-12-09");
INSERT INTO tbl_inventory VALUES("2","4003","CI 1980","20109","Computer Monitor Led 18.5 AOC Led","SKM Comp. Trade","2022-11-29","5","Pcs","4900","13","MIS/ICT","Austin Andaya","OK","2022-12-10");
INSERT INTO tbl_inventory VALUES("3","4015","CI 14990","2210","Printer Epson FX 2175 sn GLX015979","Bitstop","2022-12-06","1","Pcs","21900","41","BEdS Cashier","Edriane Mina","OK","2022-12-16");
INSERT INTO tbl_inventory VALUES("4","0","CI 0226","17718","UPS Abierey 500 VA, black","New Gate Comp","2022-12-01","17","Pcs","1650","0","Not Assigned","","OK","0000-00-00");
INSERT INTO tbl_inventory VALUES("5","0","CSI 0055","17718","Kingston Flash Drive 16gb","SKM Comp. Trade","2022-12-01","4","Pcs","299","0","Not Assigned","","OK","0000-00-00");
INSERT INTO tbl_inventory VALUES("6","0","CI 2194","17718","UPS APC 625VA","SKM Comp. Trade","2022-12-08","4","Pcs","3150","0","Not Assigned","","OK","0000-00-00");
INSERT INTO tbl_inventory VALUES("7","0","CI 45629","17718","Fan Desk 16","National Bazaar","2022-12-08","9","Pcs","780","0","Not Assigned","","OK","0000-00-00");
INSERT INTO tbl_inventory VALUES("8","0","SI 15992","18284","Calculator","LU Morning Star","2022-12-07","10","Pcs","800","0","Not Assigned","","OK","0000-00-00");
INSERT INTO tbl_inventory VALUES("9","0","CSI 123","17745","Office Table","CSI","2022-12-09","3","Pcs","2500","0","Not Assigned","","OK","0000-00-00");
INSERT INTO tbl_inventory VALUES("10","4001","CI 1980","20109","Computer Monitor Led 18.5 AOC Led","SKM Comp. Trade","2022-11-29","3","Pcs","4900","13","MIS/ICT","Austin Andaya","OK","2022-12-09");
INSERT INTO tbl_inventory VALUES("11","4002","CI 14990","2210","Printer Epson FX 2175 sn GLX015979","Bitstop","2022-12-06","2","Pcs","21900","13","MIS/ICT","Austin Andaya","OK","2022-12-14");
INSERT INTO tbl_inventory VALUES("12","4004","CI 14990","2210","Printer Epson FX 2175 sn GLX015979","Bitstop","2022-12-06","1","Pcs","21900","0","","Austin Andaya","For Repair","2022-12-15");
INSERT INTO tbl_inventory VALUES("13","4005","CSI 0055","17718","Kingston Flash Drive 16gb","SKM Comp. Trade","2022-12-01","2","Pcs","299","16","Printing Office ","Novem Quilop","OK","2022-12-14");
INSERT INTO tbl_inventory VALUES("14","4013","CI 1990","20119","Computer Monitor Led 24.5 AOC Led","SKM Comp. Trade","2022-11-24","1","Pcs","4900","6","CICM Residence","Anyone","OK","2022-12-15");
INSERT INTO tbl_inventory VALUES("15","4007","CI 1980","20109","Computer Monitor Led 18.5 AOC Led","SKM Comp. Trade","2022-11-29","2","Pcs","4900","1","Accounting Office/Auditor","Norlita Lopez","OK","2022-12-14");
INSERT INTO tbl_inventory VALUES("16","4014","CI 14990","2210","Printer Epson FX 2175 sn GLX015979","Bitstop","2022-12-06","1","Pcs","21900","13","MIS/ICT","Novem Quilop","OK","2022-12-15");
INSERT INTO tbl_inventory VALUES("17","4009","CI 0226","17718","UPS Abierey 500 VA, black","New Gate Comp","2022-12-01","1","Pcs","1650","0","","Edriane Mina","For Disposal","2022-12-15");
INSERT INTO tbl_inventory VALUES("18","4010","CSI 0055","17718","Kingston Flash Drive 16gb","SKM Comp. Trade","2022-12-01","5","Pcs","299","38","Marketing Office","Edriane Mina","OK","2022-12-06");
INSERT INTO tbl_inventory VALUES("19","4011","CI 0226","17718","UPS Abierey 500 VA, black","New Gate Comp","2022-12-01","1","Pcs","1650","1","Accounting Office/Auditor","Edriane Mina","OK","2022-12-06");
INSERT INTO tbl_inventory VALUES("20","4012","CSI 0055","17718","Kingston Flash Drive 16gb","SKM Comp. Trade","2022-12-01","2","Pcs","299","1","Accounting Office/Auditor","Edriane Mina","OK","2022-12-09");
INSERT INTO tbl_inventory VALUES("21","4012","CSI 0055","17718","Kingston Flash Drive 16gb","SKM Comp. Trade","2022-12-01","2","Pcs","299","0","","Edriane Mina","Surrendered","2022-12-15");
INSERT INTO tbl_inventory VALUES("22","4016","CI 2194","17718","UPS APC 625VA","SKM Comp. Trade","2022-12-08","1","Pcs","3150","41","BEdS Cashier","Edriane Mina","OK","2022-12-16");
INSERT INTO tbl_inventory VALUES("23","4018","CSI 123","17745","Office Table","CSI","2022-12-09","1","Pcs","2500","0","","Austin Andaya","For Repair","2022-12-16");
INSERT INTO tbl_inventory VALUES("24","4019","CI 0226","17718","UPS Abierey 500 VA, black","New Gate Comp","2022-12-01","1","Pcs","1650","31","Alumni Office","Edriane Mina","OK","2022-12-16");
INSERT INTO tbl_inventory VALUES("25","4022","CI 45629","17718","Fan Desk 16","National Bazaar","2022-12-08","1","Pcs","780","0","","Austin Andaya","For Repair","2022-12-16");
INSERT INTO tbl_inventory VALUES("26","4021","CSI 123","17745","Office Table","CSI","2022-12-09","1","Pcs","2500","31","Alumni Office","Edriane Mina","OK","2022-12-16");



CREATE TABLE `tbl_location` (
  `locID` int(11) NOT NULL AUTO_INCREMENT,
  `locations` varchar(255) NOT NULL,
  PRIMARY KEY (`locID`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_location VALUES("1","Accounting Office/Auditor");
INSERT INTO tbl_location VALUES("2","CASTE-IT, Dean's Office");
INSERT INTO tbl_location VALUES("3","CCSA, Dean's Office");
INSERT INTO tbl_location VALUES("4","CEA, Dean's Office");
INSERT INTO tbl_location VALUES("5","CCAH/Social Science");
INSERT INTO tbl_location VALUES("6","CICM Residence");
INSERT INTO tbl_location VALUES("7","College Library Basement");
INSERT INTO tbl_location VALUES("8","College Library 1st Floor");
INSERT INTO tbl_location VALUES("9","College Library 2nd Floor");
INSERT INTO tbl_location VALUES("10","Conference Room");
INSERT INTO tbl_location VALUES("11","HRM Custodian Office");
INSERT INTO tbl_location VALUES("12","General Services Office");
INSERT INTO tbl_location VALUES("13","MIS/ICT");
INSERT INTO tbl_location VALUES("14","North Gate");
INSERT INTO tbl_location VALUES("15","President's Office");
INSERT INTO tbl_location VALUES("16","Printing Office ");
INSERT INTO tbl_location VALUES("17","Property Management Office ");
INSERT INTO tbl_location VALUES("18","Purchasing Office");
INSERT INTO tbl_location VALUES("19","Registrar's Office ");
INSERT INTO tbl_location VALUES("20","Research Office");
INSERT INTO tbl_location VALUES("21","SAS, Dean's Office");
INSERT INTO tbl_location VALUES("22","School Clinic");
INSERT INTO tbl_location VALUES("23","Secretary, College President");
INSERT INTO tbl_location VALUES("24","Secretary, VPAA");
INSERT INTO tbl_location VALUES("25","Secretary, VPAdmin");
INSERT INTO tbl_location VALUES("26","Student Affairs Office");
INSERT INTO tbl_location VALUES("27","Social Center (Technician)");
INSERT INTO tbl_location VALUES("28","Treasurer's Office");
INSERT INTO tbl_location VALUES("29","VP for Academic Affairs");
INSERT INTO tbl_location VALUES("30","VP for Administration ");
INSERT INTO tbl_location VALUES("31","Alumni Office");
INSERT INTO tbl_location VALUES("32","Bookstore");
INSERT INTO tbl_location VALUES("33","Campus Ministry Office");
INSERT INTO tbl_location VALUES("34","College Guidance Center");
INSERT INTO tbl_location VALUES("35","Extension Office");
INSERT INTO tbl_location VALUES("36","HR Office");
INSERT INTO tbl_location VALUES("37","IDQA Office");
INSERT INTO tbl_location VALUES("38","Marketing Office");
INSERT INTO tbl_location VALUES("39","APPA, Elementary");
INSERT INTO tbl_location VALUES("40","Asst. to the BEdS Principal ");
INSERT INTO tbl_location VALUES("41","BEdS Cashier");
INSERT INTO tbl_location VALUES("42","BEdS Principal");
INSERT INTO tbl_location VALUES("43","BEdS Record's Office");
INSERT INTO tbl_location VALUES("44","Elem. Coor's Office");
INSERT INTO tbl_location VALUES("45","Elementary Library");
INSERT INTO tbl_location VALUES("46","Guidance (HS & Elem)");
INSERT INTO tbl_location VALUES("47","High School Library");
INSERT INTO tbl_location VALUES("48","HS Dep't, Heads Office");
INSERT INTO tbl_location VALUES("49","SAO-Senior & Junior High School");



CREATE TABLE `tbl_memo_receipt` (
  `mr_number` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `recipient` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  PRIMARY KEY (`mr_number`)
) ENGINE=InnoDB AUTO_INCREMENT=4023 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_memo_receipt VALUES("4000","2022-12-14","Austin Andaya","Staff");
INSERT INTO tbl_memo_receipt VALUES("4001","2022-12-14","Austin Andaya","Staff");
INSERT INTO tbl_memo_receipt VALUES("4002","2022-12-14","Austin Andaya","Staff");
INSERT INTO tbl_memo_receipt VALUES("4003","2022-12-14","Austin Andaya","Staff");
INSERT INTO tbl_memo_receipt VALUES("4004","2022-12-14","Austin Andaya","Staff");
INSERT INTO tbl_memo_receipt VALUES("4005","2022-12-14","Novem Quilop","Staff");
INSERT INTO tbl_memo_receipt VALUES("4006","2022-12-14","Jayson Manzano","Staff");
INSERT INTO tbl_memo_receipt VALUES("4007","2022-12-14","Norlita Lopez","Head");
INSERT INTO tbl_memo_receipt VALUES("4008","2022-12-14","Austin Andaya","Staff");
INSERT INTO tbl_memo_receipt VALUES("4009","2022-12-14","Edriane Mina","Staff");
INSERT INTO tbl_memo_receipt VALUES("4010","2022-12-14","Edriane Mina","Staff");
INSERT INTO tbl_memo_receipt VALUES("4011","2022-12-14","Edriane Mina","Staff");
INSERT INTO tbl_memo_receipt VALUES("4012","2022-12-14","Edriane Mina","Staff");
INSERT INTO tbl_memo_receipt VALUES("4013","2022-12-15","Anyone","Staff");
INSERT INTO tbl_memo_receipt VALUES("4014","2022-12-15","Novem Quilop","Staff");
INSERT INTO tbl_memo_receipt VALUES("4015","2022-12-16","Edriane Mina","Staff");
INSERT INTO tbl_memo_receipt VALUES("4016","2022-12-16","Edriane Mina","Staff");
INSERT INTO tbl_memo_receipt VALUES("4017","2022-12-16","Edriane Mina","Staff");
INSERT INTO tbl_memo_receipt VALUES("4018","2022-12-16","Austin Andaya","Staff");
INSERT INTO tbl_memo_receipt VALUES("4019","2022-12-16","Edriane Mina","Staff");
INSERT INTO tbl_memo_receipt VALUES("4020","2022-12-16","Edriane Mina","Staff");
INSERT INTO tbl_memo_receipt VALUES("4021","2022-12-16","Edriane Mina","Staff");
INSERT INTO tbl_memo_receipt VALUES("4022","2022-12-16","Austin Andaya","Staff");



CREATE TABLE `tbl_particulars_janitorial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_code` varchar(255) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `stock_type` varchar(255) NOT NULL,
  `order_level` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `particulars` (`particulars`),
  KEY `item_code` (`item_code`,`unit`),
  KEY `unit` (`unit`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_particulars_janitorial VALUES("1","BYG00","Baygon","Cans","Janitorial","5");
INSERT INTO tbl_particulars_janitorial VALUES("2","DP00","Dustpan","Pcs","Janitorial","5");
INSERT INTO tbl_particulars_janitorial VALUES("3","GBM00","Garbage Bag M","Pcs","Janitorial","10");
INSERT INTO tbl_particulars_janitorial VALUES("4","LYSL00","Lysol","Pcs","Janitorial","5");



CREATE TABLE `tbl_particulars_stockroom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_code` varchar(255) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `stock_type` varchar(255) NOT NULL,
  `order_level` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `particulars` (`particulars`),
  KEY `particulars_2` (`particulars`),
  KEY `item_code` (`item_code`,`stock_type`,`unit`),
  KEY `unit` (`unit`),
  KEY `stock_type` (`stock_type`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_particulars_stockroom VALUES("5","BP00","Bond Paper","Packs","Stockroom","5");
INSERT INTO tbl_particulars_stockroom VALUES("8","A0006A","Pencil Mongol 2","Pcs","Stockroom","25");



CREATE TABLE `tbl_purchase_janitorial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(255) NOT NULL,
  `year` int(255) NOT NULL,
  `stock_type` varchar(255) NOT NULL DEFAULT 'stockroom',
  `date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3005 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_purchase_janitorial VALUES("3003","November","2022","stockroom","2022-11-28");
INSERT INTO tbl_purchase_janitorial VALUES("3004","December","2022","stockroom","2022-12-05");



CREATE TABLE `tbl_purchase_stockroom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(255) NOT NULL,
  `year` int(255) NOT NULL,
  `stock_type` varchar(255) NOT NULL DEFAULT 'stockroom',
  `date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3004 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_purchase_stockroom VALUES("3001","November","2022","stockroom","2022-11-23");
INSERT INTO tbl_purchase_stockroom VALUES("3002","December","2022","stockroom","2022-12-13");
INSERT INTO tbl_purchase_stockroom VALUES("3003","December","2022","stockroom","2022-12-15");



CREATE TABLE `tbl_purchaseitems_janitorial` (
  `uid` int(255) NOT NULL AUTO_INCREMENT,
  `id` int(255) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `unit` varchar(255) NOT NULL,
  `stock_type` varchar(255) NOT NULL DEFAULT 'stockroom',
  `month` varchar(255) NOT NULL,
  `year` int(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_purchaseitems_janitorial VALUES("4","3003","Baygon","60","Cans","stockroom","November","2022");
INSERT INTO tbl_purchaseitems_janitorial VALUES("5","3003","Dustpan","40","Pcs","stockroom","November","2022");
INSERT INTO tbl_purchaseitems_janitorial VALUES("6","3004","Baygon","60","Cans","stockroom","December","2022");
INSERT INTO tbl_purchaseitems_janitorial VALUES("7","3004","Dustpan","20","Pcs","stockroom","December","2022");



CREATE TABLE `tbl_purchaseitems_stockroom` (
  `uid` int(255) NOT NULL AUTO_INCREMENT,
  `id` int(255) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `unit` varchar(255) NOT NULL,
  `stock_type` varchar(255) NOT NULL DEFAULT 'stockroom',
  `month` varchar(255) NOT NULL,
  `year` int(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_purchaseitems_stockroom VALUES("1","3001","Ballpen Black HBW","45","Pcs","stockroom","November","2022");
INSERT INTO tbl_purchaseitems_stockroom VALUES("2","3001","Pencil Mongol 2","40","Pcs","stockroom","November","2022");
INSERT INTO tbl_purchaseitems_stockroom VALUES("3","3001","Ballpen Red HBW","50","Pcs","stockroom","November","2022");
INSERT INTO tbl_purchaseitems_stockroom VALUES("4","3002","Bond Paper","20","Packs","stockroom","December","2022");
INSERT INTO tbl_purchaseitems_stockroom VALUES("5","3003","Pencil Mongol 2","50","Pcs","stockroom","December","2022");



CREATE TABLE `tbl_request_janitorial` (
  `iss_no` int(255) NOT NULL AUTO_INCREMENT,
  `recipient` varchar(255) NOT NULL,
  `office` varchar(255) NOT NULL,
  `req_date` date NOT NULL,
  `rcv_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`iss_no`)
) ENGINE=InnoDB AUTO_INCREMENT=1004 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_request_janitorial VALUES("1000","John Wall","MIS","2022-11-19","2022-11-19","Issued");
INSERT INTO tbl_request_janitorial VALUES("1001","John Doe","SAO","2022-11-28","2022-11-28","Issued");
INSERT INTO tbl_request_janitorial VALUES("1002","Edriane Mina","Printing Office ","2022-12-10","2022-12-10","Issued");
INSERT INTO tbl_request_janitorial VALUES("1003","Edriane Mina","CICM Residence","2022-12-12","2022-12-15","Issued");



CREATE TABLE `tbl_request_stockroom` (
  `iss_no` int(255) NOT NULL AUTO_INCREMENT,
  `recipient` varchar(255) NOT NULL,
  `office` varchar(255) NOT NULL,
  `req_date` date NOT NULL,
  `rcv_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`iss_no`)
) ENGINE=InnoDB AUTO_INCREMENT=1008 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_request_stockroom VALUES("1001","John Doe","MIS","2022-11-18","2022-11-19","Issued");
INSERT INTO tbl_request_stockroom VALUES("1002","John Doe","Registrar","2022-11-19","2022-11-19","Issued");
INSERT INTO tbl_request_stockroom VALUES("1003","John Doe","Accounting Office","2022-11-19","2022-11-19","Issued");
INSERT INTO tbl_request_stockroom VALUES("1004","John Doe","Accounting Office","2022-11-20","2022-11-28","Issued");
INSERT INTO tbl_request_stockroom VALUES("1005","Norlita Lopez","Accounting Office","2022-12-05","2022-12-10","Issued");
INSERT INTO tbl_request_stockroom VALUES("1006","Edriane Mina","MIS/ICT","2022-12-06","2022-12-10","Issued");
INSERT INTO tbl_request_stockroom VALUES("1007","Edriane Mina","CICM Residence","2022-12-12","2022-12-15","Issued");



CREATE TABLE `tbl_ris_janitorial` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `iss_no` int(11) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `quantityReq` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `stock_type` varchar(255) NOT NULL DEFAULT 'Janitorial',
  PRIMARY KEY (`id`),
  KEY `iss_no` (`iss_no`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_ris_janitorial VALUES("9","1000","Baygon","BYG00","5","Cans","305.49","Janitorial");
INSERT INTO tbl_ris_janitorial VALUES("11","1000","Dustpan","DP00","5","Pcs","53.34","Janitorial");
INSERT INTO tbl_ris_janitorial VALUES("12","1001","Baygon","BYG00","25","Cans","305.49","Janitorial");
INSERT INTO tbl_ris_janitorial VALUES("13","1001","Baygon","BYG001","33","Cans","305.49","Janitorial");
INSERT INTO tbl_ris_janitorial VALUES("14","1001","Dustpan","DP00","33","Pcs","53.34","Janitorial");
INSERT INTO tbl_ris_janitorial VALUES("15","1002","Garbage Bag M","GBM00","5","Pcs","50.4","Janitorial");
INSERT INTO tbl_ris_janitorial VALUES("16","1002","Baygon","BYG001","2","Cans","305.49","Janitorial");
INSERT INTO tbl_ris_janitorial VALUES("17","1002","Baygon","BYG002","5","Cans","313.2","Janitorial");
INSERT INTO tbl_ris_janitorial VALUES("18","1003","Lysol","LYSL00","5","Pcs","250.37","Janitorial");



CREATE TABLE `tbl_ris_stockroom` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `iss_no` int(11) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `quantityReq` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `stock_type` varchar(255) NOT NULL DEFAULT 'Stockroom',
  PRIMARY KEY (`id`),
  KEY `iss_no` (`iss_no`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_ris_stockroom VALUES("4","1001","Ballpen Black HBW","A0032","10","Pcs","12.07","Stockroom");
INSERT INTO tbl_ris_stockroom VALUES("5","1001","Pencil Mongol 2","A0006A","10","Pcs","12.04","Stockroom");
INSERT INTO tbl_ris_stockroom VALUES("6","1002","Ballpen Black HBW","A0032","5","Pcs","12.07","Stockroom");
INSERT INTO tbl_ris_stockroom VALUES("7","1002","Pencil Mongol 2","A0006A","10","Pcs","12.04","Stockroom");
INSERT INTO tbl_ris_stockroom VALUES("8","1002","Ballpen Red HBW","A0022","15","Pcs","13.67","Stockroom");
INSERT INTO tbl_ris_stockroom VALUES("9","1003","Ballpen Red HBW","A0022","10","Pcs","13.67","Stockroom");
INSERT INTO tbl_ris_stockroom VALUES("10","1004","Pencil Mongol 2","A0006A","50","Pcs","12.04","Stockroom");
INSERT INTO tbl_ris_stockroom VALUES("11","1004","Ballpen Black HBW","A0032","30","Pcs","12.07","Stockroom");
INSERT INTO tbl_ris_stockroom VALUES("12","1004","Ballpen Black HBW","A00321","40","Pcs","12","Stockroom");
INSERT INTO tbl_ris_stockroom VALUES("13","1005","Bond Paper","BP00","5","Packs","300.12","Stockroom");
INSERT INTO tbl_ris_stockroom VALUES("14","1005","Ballpen Black HBW","A00322","20","Pcs","12","Stockroom");
INSERT INTO tbl_ris_stockroom VALUES("15","1006","Bond Paper","BP00","40","Packs","300.12","Stockroom");
INSERT INTO tbl_ris_stockroom VALUES("16","1007","Pencil Mongol 2","A0006A","20","Pcs","12.02","Stockroom");



CREATE TABLE `tbl_stock_janitorial` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `stock_type` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `price` float NOT NULL,
  `amount` int(255) NOT NULL,
  `issuance_qty` int(255) NOT NULL,
  `issuance_amt` int(255) NOT NULL,
  `rem_qty` int(255) NOT NULL,
  `rem_amt` int(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `particulars` (`particulars`),
  KEY `particulars_2` (`particulars`),
  KEY `particulars_3` (`particulars`),
  KEY `unit` (`unit`,`stock_type`),
  KEY `item_code` (`item_code`),
  KEY `id` (`id`),
  CONSTRAINT `tbl_stock_janitorial_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_particulars_janitorial` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_stock_janitorial_ibfk_3` FOREIGN KEY (`particulars`) REFERENCES `tbl_particulars_janitorial` (`particulars`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_stock_janitorial_ibfk_4` FOREIGN KEY (`unit`) REFERENCES `tbl_particulars_janitorial` (`unit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_stock_janitorial VALUES("1","1","","Baygon","Cans","Janitorial","0","0","0","0","0","0","0","0000-00-00");
INSERT INTO tbl_stock_janitorial VALUES("2","1","BYG00","Baygon","Cans","Janitorial","30","312.45","0","30","0","0","0","2022-11-17");
INSERT INTO tbl_stock_janitorial VALUES("3","1","BYG001","Baygon","Cans","Janitorial","35","305.49","0","35","0","0","0","2022-11-17");
INSERT INTO tbl_stock_janitorial VALUES("4","2","","Dustpan","Pcs","Janitorial","0","0","0","0","0","0","0","0000-00-00");
INSERT INTO tbl_stock_janitorial VALUES("5","2","DP00","Dustpan","Pcs","Janitorial","40","53.34","0","38","0","2","0","2022-11-17");
INSERT INTO tbl_stock_janitorial VALUES("6","3","","Garbage Bag M","Pcs","Janitorial","0","0","0","0","0","0","0","0000-00-00");
INSERT INTO tbl_stock_janitorial VALUES("7","3","GBM00","Garbage Bag M","Pcs","Janitorial","200","50.4","0","5","0","195","0","2022-12-10");
INSERT INTO tbl_stock_janitorial VALUES("8","1","BYG002","Baygon","Cans","Janitorial","20","313.2","0","5","0","15","0","2022-12-10");
INSERT INTO tbl_stock_janitorial VALUES("9","4","","Lysol","Pcs","Janitorial","0","0","0","0","0","0","0","0000-00-00");
INSERT INTO tbl_stock_janitorial VALUES("10","4","LYSL00","Lysol","Pcs","Janitorial","40","250.37","0","5","0","35","0","2022-12-15");



CREATE TABLE `tbl_stock_stockroom` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `stock_type` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL DEFAULT 0,
  `price` float NOT NULL,
  `amount` int(255) NOT NULL,
  `issuance_qty` int(255) NOT NULL DEFAULT 0,
  `issuance_amt` int(255) NOT NULL,
  `rem_qty` int(255) NOT NULL DEFAULT 0,
  `rem_amt` int(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `particulars` (`particulars`),
  KEY `particulars_2` (`particulars`),
  KEY `particulars_3` (`particulars`),
  KEY `unit` (`unit`,`stock_type`),
  KEY `item_code` (`item_code`),
  KEY `id` (`id`),
  CONSTRAINT `tbl_stock_stockroom_ibfk_2` FOREIGN KEY (`particulars`) REFERENCES `tbl_particulars_stockroom` (`particulars`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_stock_stockroom_ibfk_3` FOREIGN KEY (`id`) REFERENCES `tbl_particulars_stockroom` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_stock_stockroom_ibfk_5` FOREIGN KEY (`unit`) REFERENCES `tbl_particulars_stockroom` (`unit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_stock_stockroom VALUES("9","5","","Bond Paper","Packs","Stockroom","0","0","0","0","0","0","0","0000-00-00");
INSERT INTO tbl_stock_stockroom VALUES("10","5","BP00","Bond Paper","Packs","Stockroom","50","300.12","0","45","0","5","0","2022-12-10");
INSERT INTO tbl_stock_stockroom VALUES("14","8","","Pencil Mongol 2","Pcs","Stockroom","0","0","0","0","0","0","0","0000-00-00");
INSERT INTO tbl_stock_stockroom VALUES("15","8","A0006A","Pencil Mongol 2","Pcs","Stockroom","40","12.02","0","20","0","20","0","2022-12-15");



CREATE TABLE `tbl_users` (
  `emp_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_lvl` varchar(255) NOT NULL,
  `ulvl_code` varchar(255) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO tbl_users VALUES("0","","","","","","","PMO","");
INSERT INTO tbl_users VALUES("12001","Christian","Sam","Newman","admin","admin","admin@slc.com","Admin","");
INSERT INTO tbl_users VALUES("12002","Christian Dominique","B.","Calderon","pmo","pmo","pmo@slc.com","Property Management Officer","pmo");
INSERT INTO tbl_users VALUES("12003","Chris","Ross","Brown","auditor","auditor","auditor@slc.com","Auditor","auditor");
INSERT INTO tbl_users VALUES("12004","Jayme Francis","Estabillo","Ramos","jayme","jayme","jayme@slc.com","Admin","");



CREATE TABLE `trans_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_id` int(255) NOT NULL,
  `mr_no` int(255) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `trans_date` date NOT NULL,
  `date_moved` date DEFAULT NULL,
  `locations` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO trans_history VALUES("1","14","4013","Computer Monitor Led 24.5 AOC Led","1","Pcs","2022-12-14","2022-12-15","Printing Office ");
INSERT INTO trans_history VALUES("2","16","4014","Printer Epson FX 2175 sn GLX015979","1","Pcs","2022-12-06","2022-12-15","Bookstore");
INSERT INTO trans_history VALUES("3","23","4018","Office Table","1","Pcs","2022-12-16","2022-12-16","BEdS Cashier");
INSERT INTO trans_history VALUES("4","25","4022","Fan Desk 16","1","Pcs","2022-12-16","2022-12-16","Alumni Office");

