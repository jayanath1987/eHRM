
-- --COMMON HRM complete Database --------------------------------[MY SQL]---------------------------------------------------------

CREATE TABLE IF NOT EXISTS `hs_hr_atn_fieldformat` (
  `aff_id` int(4) NOT NULL AUTO_INCREMENT,
  `aff_fieldname` varchar(200) DEFAULT NULL,
  `aff_fieldstartposition` varchar(3) DEFAULT NULL,
  `aff_fieldendposition` varchar(3) DEFAULT NULL,
  `aff_fielddatatype` varchar(20) DEFAULT NULL,
  `aff_fieldformat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`aff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `hs_hr_atn_clockdown`  ( 
	`clk_no`    	varchar(20) NOT NULL,
	`clk_date`  	date NOT NULL DEFAULT '0000-00-00',
	`clk_time`  	time NOT NULL DEFAULT '00:00:00',
	`clk_status`	varchar(2) NULL,
	`clk_move`  	varchar(5) NULL,
	PRIMARY KEY(`clk_no`,`clk_date`,`clk_time`)
)engine=innodb default charset=utf8;

CREATE TABLE `hs_hr_atn_dailyattendance`  ( 
	`clk_no`          	varchar(20) NOT NULL,
	`emp_number`      	int(7) NOT NULL DEFAULT '0',
	`atn_date`        	date NOT NULL DEFAULT '0000-00-00',
	`atn_intime`      	time NULL,
	`atn_outtime`     	time NULL,
	`atn_latetime`    	time NULL,
	`atn_earlydeptime`	time NULL,
	`dt_id`           	int(4) NULL,
	PRIMARY KEY(`clk_no`,`atn_date`,`emp_number`)
)engine=innodb default charset=utf8;


CREATE INDEX `xif1hs_hr_atn_dailyattendance` ON `hs_hr_atn_dailyattendance`
(
       `dt_id`
);

CREATE INDEX `xif2hs_hr_atn_dailyattendance` ON `hs_hr_atn_dailyattendance`
(
       `emp_number`
);

CREATE INDEX `xif3hs_hr_atn_dailyattendance` ON `hs_hr_atn_dailyattendance`
(
       `clk_no`
);

CREATE TABLE `hs_hr_atn_day`  ( 
	`adt_day`    	varchar(10) NOT NULL,
	`dt_id`      	int(4) NULL,
	`adt_intime` 	time NULL,
	`adt_outtime`	time NULL,
	PRIMARY KEY(`adt_day`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_atn_day` ON `hs_hr_atn_day`
(
       `dt_id`
);

CREATE TABLE `hs_hr_atn_day_type`  ( 
	`dt_id`     	int(4) AUTO_INCREMENT NOT NULL,
	`dt_name`   	varchar(200) NULL,
	`dt_name_si`	varchar(200) NULL,
	`dt_name_ta`	varchar(200) NULL,
	PRIMARY KEY(`dt_id`)
)engine=innodb default charset=utf8;


ALTER TABLE `hs_hr_atn_day_type`
	ADD CONSTRAINT `dt_name_ta`
	UNIQUE (`dt_name_ta`);

ALTER TABLE `hs_hr_atn_day_type`
	ADD CONSTRAINT `dt_name_si`
	UNIQUE (`dt_name_si`);

ALTER TABLE `hs_hr_atn_day_type`
	ADD CONSTRAINT `dt_name`
	UNIQUE (`dt_name`);

CREATE TABLE `hs_hr_attendance`  ( 
	`attendance_id` 	int(11) NOT NULL,
	`employee_id`   	int(11) NOT NULL,
	`punchin_time`  	datetime NULL,
	`punchout_time` 	datetime NULL,
	`in_note`       	varchar(250) NULL,
	`out_note`      	varchar(250) NULL,
	`timestamp_diff`	int(11) NOT NULL,
	`status`        	enum('0','1') NULL,
	PRIMARY KEY(`attendance_id`)
)engine=innodb default charset=utf8;

CREATE TABLE `hs_hr_ckecklist_detail`  ( 
	`emp_number`      	int(7) NOT NULL DEFAULT '0',
	`prm_checklist_id`	int(4) NOT NULL DEFAULT '0',
	`value`           	varchar(10) NULL,
	PRIMARY KEY(`emp_number`,`prm_checklist_id`)
)engine=innodb default charset=utf8;


CREATE INDEX `xif1hs_hr_ckecklist_detail` ON `hs_hr_ckecklist_detail`
(
       `prm_checklist_id`
);

CREATE INDEX `xif2hs_hr_ckecklist_detail` ON `hs_hr_ckecklist_detail`
(
       `emp_number`
);


CREATE TABLE `hs_hr_class`  ( 
	`class_code`   	int(4) AUTO_INCREMENT NOT NULL,
	`class_name`   	varchar(100) NOT NULL,
	`class_name_si`	varchar(100) NULL,
	`class_name_ta`	varchar(100) NULL,
	PRIMARY KEY(`class_code`)
)engine=innodb default charset=utf8;


ALTER TABLE `hs_hr_class`
	ADD CONSTRAINT `class_name_ta`
	UNIQUE (`class_name_ta`);

ALTER TABLE `hs_hr_class`
	ADD CONSTRAINT `class_name_si`
	UNIQUE (`class_name_si`);

ALTER TABLE `hs_hr_class`
	ADD CONSTRAINT `class_name`
	UNIQUE (`class_name`);

CREATE TABLE `hs_hr_compstructtree`  (
        `comp_code`             varchar(10) DEFAULT NULL,
	`title`            	varchar(200) NOT NULL,
	`id`               	int(6) NOT NULL,
	`parnt`            	int(6) NOT NULL DEFAULT '0',
	`title_si`         	varchar(200) NULL,
	`title_ta`         	varchar(200) NULL,
	`comp_address`        	varchar(200) NULL,
	`comp_address_si`      	varchar(200) NULL,
	`comp_address_ta`      	varchar(200) NULL,
	`comp_fax`             	varchar(30) NULL,
	`comp_email`           	varchar(100) NULL,
	`emp_number`       	int(7) NULL,
	`comp_phone_intercom`  	varchar(30) NULL,
	`comp_phone_extension` 	varchar(30) NULL,
	`comp_phone_vip`       	varchar(30) NULL,
	`comp_phone_direct_line` varchar(30) NULL,
	`comp_url`             	varchar(200) NULL,
	`def_level`		int(4) default null,
	PRIMARY KEY(`id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_compstructtree` ON `hs_hr_compstructtree`
(
       `emp_number`
);

CREATE INDEX `xif2hs_hr_compstructtree` ON `hs_hr_compstructtree`
(
       `def_level`
);

create table `hs_hr_company_structure_def` (
	`def_level` int(4) not null,
	`def_name` varchar(100) not null,
	`def_name_si` varchar(100) default null,
	`def_name_ta` varchar(100) default null,
	primary key(def_level)
) engine=innodb default charset=utf8;





CREATE TABLE `hs_hr_concurrency_control`  ( 
	`con_table_name`  	varchar(100) NOT NULL,
	`con_table_key`   	varchar(100) NOT NULL,
	`con_activity_id` 	int(4) NOT NULL,
	`con_created_date`	datetime NULL,
	`con_created_by`  	varchar(36) NULL,
	PRIMARY KEY(`con_table_name`,`con_table_key`,`con_activity_id`)
)engine=innodb default charset=utf8;

CREATE TABLE `hs_hr_config`  ( 
	`key`  	varchar(100) NOT NULL,
	`value`	varchar(100) NOT NULL,
	PRIMARY KEY(`key`)
);

CREATE TABLE `hs_hr_country`  ( 
	`cou_code`   	char(2) NOT NULL,
	`name`       	varchar(80) NOT NULL,
	`cou_name`   	varchar(80) NOT NULL,
	`cou_name_si`	varchar(80) NULL,
	`cou_name_ta`	varchar(80) NULL,
	`iso3`       	char(3) NULL,
	`numcode`    	smallint(6) NULL,
	PRIMARY KEY(`cou_code`)
)engine=innodb default charset=utf8;

CREATE TABLE `hs_hr_currency_type`  ( 
	`code`         	int(11) NOT NULL DEFAULT '0',
	`currency_id`  	char(3) NOT NULL,
	`currency_name`	varchar(70) NOT NULL,
	PRIMARY KEY(`currency_id`)
)engine=innodb default charset=utf8;

CREATE TABLE `hs_hr_customer`  ( 
	`customer_id`	int(11) NOT NULL,
	`name`       	varchar(100) NULL,
	`description`	varchar(250) NULL,
	`deleted`    	tinyint(1) NULL DEFAULT '0',
	PRIMARY KEY(`customer_id`)
)engine=innodb default charset=utf8;

CREATE TABLE `hs_hr_db_version`  ( 
	`id`           	varchar(36) NOT NULL,
	`name`         	varchar(45) NULL,
	`description`  	varchar(100) NULL,
	`entered_date` 	datetime NULL,
	`modified_date`	datetime NULL,
	`entered_by`   	varchar(36) NULL,
	`modified_by`  	varchar(36) NULL,
	PRIMARY KEY(`id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_db_version` ON `hs_hr_db_version`
(
       `entered_by`
);

CREATE INDEX `xif2hs_hr_db_version` ON `hs_hr_db_version`
(
       `modified_by`
);


CREATE TABLE `hs_hr_dis_action_type`  ( 
	`dis_acttype_id`     	int(8) AUTO_INCREMENT NOT NULL,
	`dis_acttype_name`   	varchar(100) NULL,
	`dis_acttype_name_si`	varchar(100) NULL,
	`dis_acttype_name_ta`	varchar(100) NULL,
	PRIMARY KEY(`dis_acttype_id`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_dis_action_type`
	ADD CONSTRAINT `dis_acttype_name_ta`
	UNIQUE (`dis_acttype_name_ta`);

ALTER TABLE `hs_hr_dis_action_type`
	ADD CONSTRAINT `dis_acttype_name_si`
	UNIQUE (`dis_acttype_name_si`);

ALTER TABLE `hs_hr_dis_action_type`
	ADD CONSTRAINT `dis_acttype_name`
	UNIQUE (`dis_acttype_name`);

CREATE TABLE `hs_hr_dis_attachment`  ( 
	`dis_attach_id`     	int(20) AUTO_INCREMENT NOT NULL,
	`dis_attach_name`   	varchar(50) NULL,
	`dis_attach_type`   	varchar(50) NULL,
	`dis_attach_content`	mediumblob NULL,
	`dis_inc_id`        	int(20) NOT NULL DEFAULT '0',
	`dis_attach_category`	varchar(20) NOT NULL ,
	PRIMARY KEY(`dis_attach_id`,`dis_inc_id`)
)engine=innodb default charset=utf8 AUTO_INCREMENT=1;


CREATE INDEX `xif1hs_hr_dis_attachment` ON `hs_hr_dis_attachment`
(
       `dis_inc_id`
);


CREATE TABLE `hs_hr_dis_incidents`  ( 
  `dis_inc_id` int(20) NOT NULL AUTO_INCREMENT,
  `dis_acttype_id` int(8) DEFAULT NULL,
  `dis_inc_level` int(6) DEFAULT NULL,
  `dis_inc_isclosed` int(4) DEFAULT NULL,
  `dis_inc_inq_officer` varchar(100)  DEFAULT NULL,
  `dis_inc_pro_officer` varchar(100)  DEFAULT NULL,
  `dis_inc_defe_officer` varchar(100) DEFAULT NULL,
  `dis_inc_filedate` date DEFAULT NULL,
  `dis_inc_date` date DEFAULT NULL,
  `dis_inc_time` time DEFAULT NULL,
  `dis_inc_incident` varchar(1000) DEFAULT NULL,
  `dis_inc_incident_si` varchar(200) DEFAULT NULL,
  `dis_inc_incident_ta` varchar(200) DEFAULT NULL,
  `dis_inc_reportedby` varchar(100) DEFAULT NULL,
  `dis_inc_prelim_com` varchar(200) DEFAULT NULL,
  `dis_inc_finact_tknby` varchar(100) DEFAULT NULL,
  `dis_inc_finact_tkn` varchar(100) DEFAULT NULL,
  `dis_inc_finact_tkndate` date DEFAULT NULL,
  `dis_inc_type` varchar(100) DEFAULT NULL,
  `dis_inc_prim_summary` varchar(200) DEFAULT NULL,
	PRIMARY KEY(`dis_inc_id`)
)engine=innodb default charset=utf8 AUTO_INCREMENT=1;

CREATE INDEX `xif1hs_hr_dis_incidents` ON `hs_hr_dis_incidents`
(
       `dis_acttype_id`
);




CREATE TABLE `hs_hr_dis_offence`  ( 
	`dis_offence_id`     	int(8) AUTO_INCREMENT NOT NULL,
	`dis_acttype_id`     	int(8) NOT NULL,
	`dis_offence_name`   	varchar(100) NOT NULL,
	`dis_offence_name_si`	varchar(100) NULL,
	`dis_offence_name_ta`	varchar(100) NULL,
	PRIMARY KEY(`dis_offence_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_dis_offence` ON `hs_hr_dis_offence`
(
       `dis_acttype_id`
);

ALTER TABLE `hs_hr_dis_offence`
	ADD CONSTRAINT `dis_offence_name_ta`
	UNIQUE (`dis_offence_name_ta`);

ALTER TABLE `hs_hr_dis_offence`
	ADD CONSTRAINT `dis_offence_name_si`
	UNIQUE (`dis_offence_name_si`);

ALTER TABLE `hs_hr_dis_offence`
	ADD CONSTRAINT `dis_offence_name`
	UNIQUE (`dis_offence_name`);

CREATE TABLE `hs_hr_dis_offence_list`  ( 
	`dis_inc_id`    	int(20) NOT NULL DEFAULT '0',
	`dis_offence_id`	int(8) NOT NULL DEFAULT '0',
	PRIMARY KEY(`dis_inc_id`,`dis_offence_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_dis_offence_list` ON `hs_hr_dis_offence_list`
(
       `dis_offence_id`
);

CREATE INDEX `xif2hs_hr_dis_offence_list` ON `hs_hr_dis_offence_list`
(
       `dis_inc_id`
);


CREATE TABLE `hs_hr_dis_involved_emp` (
  `emp_number`	 int(7) NOT NULL,
  `dis_inc_id`	 int(20) NOT NULL,
  `dis_inv_type` varchar(10) DEFAULT NULL,
  `dis_inv_finalaction` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`emp_number`,`dis_inc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE INDEX `xif1hs_hr_dis_involved_emp` ON `hs_hr_dis_involved_emp`
(
       `dis_inc_id`
);

CREATE TABLE `hs_hr_ebexam`  ( 
  `ebexam_id` int(25) NOT NULL AUTO_INCREMENT,
  `service_code` int(4) DEFAULT NULL,
  `grade_code` int(4) DEFAULT NULL,
  `ebexam_name` varchar(200) DEFAULT NULL,
  `ebexam_name_si` varchar(200) DEFAULT NULL,
  `ebexam_name_ta` varchar(200) DEFAULT NULL,
  `ebexam_description` varchar(200) DEFAULT NULL,
	PRIMARY KEY(`ebexam_id`)
)engine=innodb default charset=utf8 AUTO_INCREMENT=15;

CREATE INDEX `xif1hs_hr_ebexam` ON `hs_hr_ebexam`
(
       `service_code`
);

CREATE INDEX `xif2hs_hr_ebexam` ON `hs_hr_ebexam`
(
       `grade_code`
);

CREATE TABLE `hs_hr_education`  ( 
	`edu_code`   	varchar(13) NOT NULL,
	`edu_name`   	varchar(100) NULL,
	`edu_name_si`	varchar(100) NULL,
	`edu_name_ta`	varchar(100) NULL,
	PRIMARY KEY(`edu_code`)
)engine=innodb default charset=utf8;


ALTER TABLE `hs_hr_education`
	ADD CONSTRAINT `edu_name_ta`
	UNIQUE (`edu_name_ta`);

ALTER TABLE `hs_hr_education`
	ADD CONSTRAINT `edu_name_si`
	UNIQUE (`edu_name_si`);

ALTER TABLE `hs_hr_education`
	ADD CONSTRAINT `edu_name`
	UNIQUE (`edu_name`);

CREATE TABLE `hs_hr_eec`  ( 
	`eec_code`	varchar(13) NOT NULL,
	`eec_desc`	varchar(50) NULL,
	PRIMARY KEY(`eec_code`)
)engine=innodb default charset=utf8;

CREATE TABLE `hs_hr_emp_attachment`  ( 
	`emp_number`        	int(7) NOT NULL DEFAULT '0',
	`eattach_id`        	decimal(10,0) NOT NULL DEFAULT '0',
	`eattach_type_id`   	int(10) NOT NULL,
	`eattach_desc`      	varchar(200) NULL,
	`eattach_filename`  	varchar(100) NULL,
	`eattach_size`      	int(11) NULL DEFAULT '0',
	`eattach_attachment`	mediumblob NULL,
	`eattach_type`      	varchar(50) NULL,
	PRIMARY KEY(`emp_number`,`eattach_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_emp_attachment` ON `hs_hr_emp_attachment`
(
       `eattach_type_id`
);

CREATE INDEX `xif2hs_hr_emp_attachment` ON `hs_hr_emp_attachment`
(
       `emp_number`
);


CREATE TABLE `hs_hr_emp_attachment_type`  ( 
	`eattach_type_id`     	int(10) NOT NULL,
	`eattach_type_name`   	varchar(100) NOT NULL,
	`eattach_type_name_si`	varchar(100) NOT NULL,
	`eattach_type_name_ta`	varchar(100) NOT NULL,
	PRIMARY KEY(`eattach_type_id`)
)engine=innodb default charset=utf8;

CREATE TABLE `hs_hr_emp_children`  ( 
	`emp_number`      	int(7) NOT NULL DEFAULT '0',
	`ec_seqno`        	decimal(2,0) NOT NULL DEFAULT '0',
	`ec_name`         	varchar(100) NULL,
	`ec_date_of_birth`	date NULL,
	PRIMARY KEY(`emp_number`,`ec_seqno`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_emp_children` ON `hs_hr_emp_children`
(
       `emp_number`
);

CREATE TABLE `hs_hr_emp_contact`  ( 
	`emp_number`                 	int(7) NOT NULL,
	`con_off_addLine1`           	varchar(100) NULL,
	`con_off_addLine1_si`        	varchar(100) NULL,
	`con_off_addLine1_ta`        	varchar(100) NULL,
	`con_off_addLine2`           	varchar(100) NULL,
	`con_off_addLine2_si`        	varchar(100) NULL,
	`con_off_addLine2_ta`        	varchar(100) NULL,
	`con_off_del_postoffice`     	varchar(100) NULL,
	`con_off_del_postoffice_si`  	varchar(100) NULL,
	`con_off_del_postoffice_ta`  	varchar(100) NULL,
	`con_off_postal_code`        	varchar(50) NULL,
	`con_off_country`            	varchar(100) NULL,
	`con_off_intercom`           	varchar(20) NULL,
	`con_off_vip`                	varchar(20) NULL,
	`con_off_direct`             	varchar(20) NULL,
	`con_off_ext`                	varchar(20) NULL,
	`con_off_fax`                	varchar(20) NULL,
	`con_off_email`              	varchar(100) NULL,
	`con_off_url`                	varchar(100) NULL,
	`con_res_addLine1`           	varchar(100) NULL,
	`con_res_addLine1_si`        	varchar(100) NULL,
	`con_res_addLine1_ta`        	varchar(100) NULL,
	`con_res_addLine2`           	varchar(100) NULL,
	`con_res_addLine2_si`        	varchar(100) NULL,
	`con_res_addLine2_ta`        	varchar(100) NULL,
	`con_res_del_postoffice`     	varchar(100) NULL,
	`con_res_del_postoffice_si`  	varchar(100) NULL,
	`con_res_del_postoffice_ta`  	varchar(100) NULL,
	`con_res_postal_code`        	varchar(10) NULL,
	`con_res_div_sectretariat`   	varchar(100) NULL,
	`con_res_div_sectretariat_si`	varchar(100) NULL,
	`con_res_div_sectretariat_ta`	varchar(100) NULL,
	`con_res_policesation`       	varchar(100) NULL,
	`con_res_policesation_si`    	varchar(100) NULL,
	`con_res_policesation_ta`    	varchar(100) NULL,
	`con_res_district`           	varchar(100) NULL,
	`con_res_district_si`        	varchar(100) NULL,
	`con_res_district_ta`        	varchar(100) NULL,
	`con_res_phone`              	varchar(20) NULL,
	`con_res_fax`                	varchar(20) NULL,
	`con_res_mobile`             	varchar(20) NULL,
	`con_res_email`              	varchar(100) NULL,
	`con_per_addLine1`           	varchar(100) NULL,
	`con_per_addLine1_si`        	varchar(100) NULL,
	`con_per_addLine1_ta`        	varchar(100) NULL,
	`con_per_addLine2`           	varchar(100) NULL,
	`con_per_addLine2_si`        	varchar(100) NULL,
	`con_per_addLine2_ta`        	varchar(100) NULL,
	`con_per_del_postoffice`     	varchar(100) NULL,
	`con_per_del_postoffice_si`  	varchar(100) NULL,
	`con_per_del_postoffice_ta`  	varchar(100) NULL,
	`con_per_postal_code`        	varchar(10) NULL,
	`con_per_div_sectretariat`   	varchar(100) NULL,
	`con_per_div_sectretariat_si`	varchar(100) NULL,
	`con_per_div_sectretariat_ta`	varchar(100) NULL,
	`con_per_policesation`       	varchar(100) NULL,
	`con_per_policesation_si`    	varchar(100) NULL,
	`con_per_policesation_ta`    	varchar(100) NULL,
	`con_per_district`           	varchar(100) NULL,
	`con_per_district_si`        	varchar(100) NULL,
	`con_per_district_ta`        	varchar(100) NULL,
	`con_per_phone`              	varchar(20) NULL,
	`con_per_fax`                	varchar(20) NULL,
	`con_per_mobile`             	varchar(20) NULL,
	`con_per_email`              	varchar(100) NULL,
	`con_oth_addLine1`           	varchar(100) NULL,
	`con_oth_addLine2`           	varchar(100) NULL,
	`con_oth_addLine2_si`        	varchar(100) NULL,
	`con_oth_addLine2_ta`        	varchar(100) NULL,
	`con_oth_addLine1_si`        	varchar(100) NULL,
	`con_oth_addLine1_ta`        	varchar(100) NULL,
	`con_oth_postal_code`        	varchar(10) NULL,
	`con_oth_del_postoffice`     	varchar(100) NULL,
	`con_oth_del_postoffice_si`  	varchar(100) NULL,
	`con_oth_del_postoffice_ta`  	varchar(100) NULL,
	`con_oth_div_sectretariat`   	varchar(100) NULL,
	`con_oth_div_sectretariat_si`	varchar(100) NULL,
	`con_oth_div_sectretariat_ta`	varchar(100) NULL,
	`con_oth_policesation`       	varchar(100) NULL,
	`con_oth_phone`              	varchar(20) NULL,
	`con_oth_policesation_si`    	varchar(100) NULL,
	`con_oth_policesation_ta`    	varchar(100) NULL,
	`con_oth_district`           	varchar(100) NULL,
	`con_oth_district_si`        	varchar(100) NULL,
	`con_oth_district_ta`        	varchar(100) NULL,
	`con_oth_fax`                	varchar(20) NULL,
	`con_oth_mobile`             	varchar(20) NULL,
	`con_oth_email`              	varchar(100) NULL,
	PRIMARY KEY(`emp_number`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_emp_contact` ON `hs_hr_emp_contact`
(
       `emp_number`
);

CREATE TABLE `hs_hr_emp_dependents`  ( 
	`emp_number`            	int(7) NOT NULL DEFAULT '0',
	`ed_seqno`              	decimal(2,0) NOT NULL DEFAULT '0',
	`ed_name`               	varchar(100) NULL,
	`ed_name_si`            	varchar(100) NULL,
	`ed_name_ta`            	varchar(100) NULL,
	`rel_code`              	int(4) NULL,
	`ed_birthday`           	date NULL,
	`ed_workplace`          	varchar(200) NULL,
	`ed_workplace_si`       	varchar(200) NULL,
	`ed_workplace_ta`       	varchar(200) NULL,
	`ed_education_center`   	varchar(100) NULL,
	`ed_education_center_si`	varchar(100) NULL,
	`ed_education_center_ta`	varchar(100) NULL,
	`ed_address`            	varchar(200) NULL,
	`ed_address_si`         	varchar(200) NULL,
	`ed_address_ta`         	varchar(200) NULL,
	`ed_comments`           	varchar(200) NULL,
	`ed_comments_si`        	varchar(200) NULL,
	`ed_comments_ta`        	varchar(200) NULL,
	PRIMARY KEY(`emp_number`,`ed_seqno`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_emp_dependents` ON `hs_hr_emp_dependents`
(
       `rel_code`
);

CREATE INDEX `xif2hs_hr_emp_dependents` ON `hs_hr_emp_dependents`
(
       `emp_number`
);

CREATE TABLE `hs_hr_emp_education`  ( 
	`emp_number`       	int(7) NOT NULL DEFAULT '0',
	`edu_code`         	varchar(13) NOT NULL,
	`edu_institute`    	varchar(100) NULL,
	`edu_institute_si` 	varchar(100) NULL,
	`edu_institute_ta` 	varchar(100) NULL,
	`edu_stream`       	varchar(100) NULL,
	`edu_stream_si`    	varchar(100) NULL,
	`edu_stream_ta`    	varchar(100) NULL,
	`edu_index_no`     	varchar(50) NULL,
	`edu_start_date`   	datetime NULL,
	`edu_end_date`     	datetime NULL,
	`edu_year`         	decimal(4,0) NULL,
	`edu_confirmed_flg`	int(1) NULL,
	PRIMARY KEY(`edu_code`,`emp_number`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_emp_education` ON `hs_hr_emp_education`
(
       `emp_number`
);

CREATE INDEX `xif2hs_hr_emp_education` ON `hs_hr_emp_education`
(
       `edu_code`
);


CREATE TABLE `hs_hr_emp_emergency_contacts`  ( 
	`emp_number`         	int(7) NOT NULL DEFAULT '0',
	`eec_seqno`          	decimal(2,0) NOT NULL DEFAULT '0',
	`eec_name`           	varchar(100) NULL,
	`eec_name_si`        	varchar(100) NULL,
	`eec_name_ta`        	varchar(100) NULL,
	`eec_relationship`   	varchar(100) NULL,
	`eec_relationship_si`	varchar(100) NULL,
	`eec_relationship_ta`	varchar(100) NULL,
	`eec_address`        	varchar(200) NULL,
	`eec_address_si`     	varchar(200) NULL,
	`eec_address_ta`     	varchar(200) NULL,
	`eec_home_no`        	varchar(100) NULL,
	`eec_mobile_no`      	varchar(100) NULL,
	`eec_office_no`      	varchar(100) NULL,
	PRIMARY KEY(`emp_number`,`eec_seqno`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_emp_emergency_contacts` ON `hs_hr_emp_emergency_contacts`
(
       `emp_number`
);

CREATE TABLE `hs_hr_emp_history_of_ealier_pos`  ( 
	`emp_number`     	int(7) NOT NULL DEFAULT '0',
	`emp_seqno`      	decimal(2,0) NOT NULL DEFAULT '0',
	`ehoep_job_title`	varchar(100) NULL,
	`ehoep_years`    	varchar(100) NULL,
	PRIMARY KEY(`emp_number`,`emp_seqno`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_emp_history_of_ealier_pos` ON `hs_hr_emp_history_of_ealier_pos`
(
       `emp_number`
);

CREATE TABLE `hs_hr_emp_jobtitle_history`  ( 
	`id`        	int(11) AUTO_INCREMENT NOT NULL,
	`emp_number`	int(7) NOT NULL,
	`code`      	varchar(15) NOT NULL,
	`name`      	varchar(250) NULL,
	`start_date`	datetime NULL,
	`end_date`  	datetime NULL,
	PRIMARY KEY(`id`)
)engine=innodb default charset=utf8;


CREATE INDEX `xif1hs_hr_emp_jobtitle_history` ON `hs_hr_emp_jobtitle_history`
(
       `emp_number`
);


CREATE TABLE `hs_hr_emp_language`  ( 
	`emp_number`        	int(7) NOT NULL DEFAULT '0',
	`lang_code`         	varchar(13) NOT NULL,
	`emplang_type`      	smallint(6) NOT NULL DEFAULT '0',
	`emplang_competency`	smallint(6) NULL DEFAULT '0',
	PRIMARY KEY(`emp_number`,`lang_code`,`emplang_type`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_emp_language` ON `hs_hr_emp_language`
(
       `lang_code`
);

CREATE INDEX `xif2hs_hr_emp_language` ON `hs_hr_emp_language`
(
       `emp_number`
);

CREATE TABLE `hs_hr_emp_licenses`  ( 
	`emp_number`     	int(7) NOT NULL DEFAULT '0',
	`lic_seqno`      	decimal(2,0) NOT NULL DEFAULT '0',
	`lic_number`     	varchar(50) NOT NULL,
	`lic_type`       	varchar(100) NULL,
	`lic_type_si`    	varchar(100) NULL,
	`lic_type_ta`    	varchar(100) NULL,
	`lic_issue_date` 	date NULL,
	`lic_expiry_date`	date NULL,
	PRIMARY KEY(`emp_number`,`lic_seqno`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_emp_licenses` ON `hs_hr_emp_licenses`
(
       `emp_number`
);

CREATE TABLE `hs_hr_emp_location_history`  ( 
	`id`        	int(11) AUTO_INCREMENT NOT NULL,
	`emp_number`	int(7) NOT NULL,
	`code`      	varchar(15) NOT NULL,
	`name`      	varchar(250) NULL,
	`start_date`	datetime NULL,
	`end_date`  	datetime NULL,
	PRIMARY KEY(`id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_emp_location_history` ON `hs_hr_emp_location_history`
(
       `emp_number`
);

CREATE TABLE `hs_hr_emp_locations`  ( 
	`emp_number`	int(7) NOT NULL,
	`loc_code`  	varchar(13) NOT NULL,
	PRIMARY KEY(`emp_number`,`loc_code`)
)engine=innodb default charset=utf8;

CREATE TABLE `hs_hr_emp_picture`  ( 
	`emp_number`    	int(7) NOT NULL DEFAULT '0',
	`epic_picture`  	mediumblob NULL,
	`epic_filename` 	varchar(100) NULL,
	`epic_type`     	varchar(50) NULL,
	`epic_file_size`	varchar(20) NULL,
	PRIMARY KEY(`emp_number`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_emp_picture` ON `hs_hr_emp_picture`
(
       `emp_number`
);

CREATE TABLE `hs_hr_emp_quicklink`  ( 
	`qlk_id`     	int(20) AUTO_INCREMENT NOT NULL,
	`qlk_name`   	varchar(200) NULL,
	`qlk_name_si`	varchar(200) NULL,
	`qlk_name_ta`	varchar(200) NULL,
	`qlk_link`   	varchar(500) NULL,
	`qlk_order`  	int(4) NULL,
	`qlk_active` 	varchar(1) NULL,
	PRIMARY KEY(`qlk_id`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_emp_quicklink`
	ADD CONSTRAINT `qlk_order`
	UNIQUE (`qlk_order`);

ALTER TABLE `hs_hr_emp_quicklink`
	ADD CONSTRAINT `qlk_name_ta`
	UNIQUE (`qlk_name_ta`);

ALTER TABLE `hs_hr_emp_quicklink`
	ADD CONSTRAINT `qlk_name_si`
	UNIQUE (`qlk_name_si`);

ALTER TABLE `hs_hr_emp_quicklink`
	ADD CONSTRAINT `qlk_name`
	UNIQUE (`qlk_name`);

CREATE TABLE `hs_hr_emp_reportto`  ( 
	`erep_sup_emp_number`	int(7) NOT NULL DEFAULT '0',
	`erep_sub_emp_number`	int(7) NOT NULL DEFAULT '0',
	`erep_reporting_mode`	smallint(6) NOT NULL DEFAULT '0',
	PRIMARY KEY(`erep_sup_emp_number`,`erep_sub_emp_number`,`erep_reporting_mode`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_emp_reportto` ON `hs_hr_emp_reportto`
(
       `erep_sub_emp_number`
);

CREATE INDEX `xif2hs_hr_emp_reportto` ON `hs_hr_emp_reportto`
(
       `erep_sup_emp_number`
);

CREATE TABLE `hs_hr_emp_service_history`  ( 
	`esh_code`          	int(11) AUTO_INCREMENT NOT NULL,
	`emp_number`        	int(7) NOT NULL,
	`esh_name`          	varchar(100) NOT NULL,
	`esh_name_si`       	varchar(100) NULL,
	`esh_name_ta`       	varchar(100) NULL,
	`esh_designation`   	varchar(100) NOT NULL,
	`esh_designation_si`	varchar(100) NULL,
	`esh_designation_ta`	varchar(100) NULL,
	`esh_district`      	varchar(50) NOT NULL,
	`esh_district_si`   	varchar(50) NULL,
	`esh_district_ta`   	varchar(50) NULL,
	`esh_from_date`     	date NOT NULL,
	`esh_to_date`       	date NOT NULL,
	PRIMARY KEY(`esh_code`,`emp_number`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_emp_service_history` ON `hs_hr_emp_service_history`
(
       `emp_number`
);

CREATE TABLE `hs_hr_emp_skill`  ( 
	`emp_number`        	int(7) NOT NULL DEFAULT '0',
	`skill_code`        	varchar(13) NOT NULL,
	`eskill_years`      	varchar(150) NOT NULL,
	`eskill_comments`   	varchar(200) NOT NULL,
	`eskill_comments_si`	varchar(200) NOT NULL,
	`eskill_comments_ta`	varchar(200) NOT NULL,
	PRIMARY KEY(`emp_number`,`skill_code`)
)engine=innodb default charset=utf8;


CREATE INDEX `xif1hs_hr_emp_skill` ON `hs_hr_emp_skill`
(
       `skill_code`
);

CREATE INDEX `xif2hs_hr_emp_skill` ON `hs_hr_emp_skill`
(
       `emp_number`
);

CREATE TABLE `hs_hr_emp_subdivision_history`  ( 
	`id`        	int(11) AUTO_INCREMENT NOT NULL,
	`emp_number`	int(7) NOT NULL,
	`code`      	varchar(15) NOT NULL,
	`name`      	varchar(250) NULL,
	`start_date`	datetime NULL,
	`end_date`  	datetime NULL,
	PRIMARY KEY(`id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_emp_subdivision_history` ON `hs_hr_emp_subdivision_history`
(
       `emp_number`
);


CREATE TABLE `hs_hr_emp_work_experience`  ( 
	`emp_number`       	int(7) NOT NULL DEFAULT '0',
	`eexp_seqno`       	decimal(10,0) NOT NULL DEFAULT '0',
	`eexp_company`     	varchar(100) NULL,
	`eexp_company_si`  	varchar(100) NULL,
	`eexp_company_ta`  	varchar(100) NULL,
	`eexp_jobtitle`    	varchar(100) NULL,
	`eexp_jobtitle_si` 	varchar(100) NULL,
	`eexp_jobtitle_ta` 	varchar(100) NULL,
	`eexp_from_date`   	datetime NULL,
	`eexp_to_date`     	datetime NULL,
	`eexp_comments`    	varchar(200) NULL,
	`eexp_comments_si` 	varchar(200) NULL,
	`eexp_comments_ta` 	varchar(200) NULL,
	`eexp_internal_flg`	int(1) NULL,
	`eexp_years`       	int(3) NULL,
	PRIMARY KEY(`emp_number`,`eexp_seqno`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_emp_work_experience` ON `hs_hr_emp_work_experience`
(
       `emp_number`
);

CREATE TABLE `hs_hr_emp_disciaction` (
  `emp_dis_id` int(20) NOT NULL AUTO_INCREMENT,
  `emp_number` int(7) NOT NULL,
  `emp_dis_effectfrom` date  NULL,
  `emp_dis_effectto` date  NULL,
  `emp_dis_action` varchar(100)  NULL,
  `emp_dis_comment` varchar(200)  NULL,
  PRIMARY KEY (`emp_dis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE INDEX `xif1hs_hr_emp_disciaction` ON `hs_hr_emp_disciaction`
(
       `emp_number`
);


CREATE TABLE `hs_hr_employee`  ( 
  `emp_number` 			int(7) NOT NULL DEFAULT '0',
  `employee_id` 		varchar(50) DEFAULT NULL,
  `emp_lastname` 		varchar(100) NOT NULL DEFAULT '',
  `emp_firstname` 		varchar(100) NOT NULL DEFAULT '',
  `ethnic_race_code` 		varchar(13) DEFAULT NULL,
  `emp_birthday` 		date DEFAULT NULL,
  `nation_code` 		varchar(13) DEFAULT NULL,
  `emp_status` 			varchar(13) DEFAULT NULL,
  `job_title_code` 		varchar(13) DEFAULT NULL,
  `work_station` 		int(6) DEFAULT NULL,
  `terminated_date` 		date DEFAULT NULL,
  `termination_reason` 		varchar(256) DEFAULT NULL,
  `service_code` int(4) DEFAULT NULL,
  `grade_code` int(4) DEFAULT NULL,
  `emp_app_letter_no` varchar(20) DEFAULT NULL,
  `emp_personal_file_no` varchar(20) DEFAULT NULL,
  `title_code` int(2) DEFAULT NULL,
  `emp_initials` varchar(30) DEFAULT NULL,
  `emp_initials_si` varchar(30) DEFAULT NULL,
  `emp_initials_ta` varchar(30) DEFAULT NULL,
  `emp_names_of_initials` varchar(120) DEFAULT NULL,
  `emp_names_of_initials_si` varchar(120) DEFAULT NULL,
  `emp_names_of_initials_ta` varchar(120) DEFAULT NULL,
  `emp_firstname_si` varchar(100) DEFAULT NULL,
  `emp_firstname_ta` varchar(100) DEFAULT NULL,
  `emp_lastname_si` varchar(100) DEFAULT NULL,
  `emp_lastname_ta` varchar(100) DEFAULT NULL,
  `gender_code` int(2) DEFAULT NULL,
  `emp_birth_location` varchar(50) DEFAULT NULL,
  `emp_birth_location_si` varchar(50) DEFAULT NULL,
  `emp_birth_location_ta` varchar(50) DEFAULT NULL,
  `marst_code` int(2) DEFAULT NULL,
  `emp_married_date` date DEFAULT NULL,
  `emp_nic_no` varchar(20) DEFAULT NULL,
  `emp_nic_date` date DEFAULT NULL,
  `rlg_code` int(2) DEFAULT NULL,
  `lang_code` varchar(13) DEFAULT NULL,
  `cou_code` char(2) DEFAULT NULL,
  `emp_passport_no` varchar(20) DEFAULT NULL,
  `emp_attendance_no` varchar(20) DEFAULT NULL,
  `emp_other_file_no` varchar(20) DEFAULT NULL,
  `emp_salary_no` varchar(20) DEFAULT NULL,
  `emp_barcode_no` varchar(20) DEFAULT NULL,
  `emp_public_app_date` date DEFAULT NULL,
  `emp_public_com_date` date DEFAULT NULL,
  `emp_app_date` date DEFAULT NULL,
  `emp_com_date` date DEFAULT NULL,
  `emp_rec_method` int(2) DEFAULT NULL,
  `emp_rec_method_desc` varchar(100) DEFAULT NULL,
  `emp_rec_method_desc_si` varchar(100) DEFAULT NULL,
  `emp_rec_method_desc_ta` varchar(100) DEFAULT NULL,
  `emp_rec_medium` int(2) DEFAULT NULL,
  `emp_active_hrm_flg` int(2) DEFAULT NULL,
  `emp_active_att_flg` int(2) DEFAULT NULL,
  `emp_wop_flg` int(2) DEFAULT NULL,
  `emp_wop_no` varchar(20) DEFAULT NULL,
  `emp_confirm_flg` int(2) DEFAULT NULL,
  `emp_confirm_date` date DEFAULT NULL,
  `emp_prob_ext_flg` int(2) DEFAULT NULL,
  `emp_prob_from_date` date DEFAULT NULL,
  `emp_prob_to_date` date DEFAULT NULL,
  `class_code` int(4) DEFAULT NULL,
  `emp_salary_scale` varchar(100) DEFAULT NULL,
  `emp_salary_scale_si` varchar(100) DEFAULT NULL,
  `emp_salary_scale_ta` varchar(100) DEFAULT NULL,
  `emp_basic_salary` double DEFAULT NULL,
  `emp_salary_inc_date` date DEFAULT NULL,
  `emp_display_name` varchar(200) DEFAULT NULL,
  `emp_display_name_si` varchar(200) DEFAULT NULL,
  `emp_display_name_ta` varchar(200) DEFAULT NULL,
  `emp_pension_no` varchar(25) DEFAULT NULL,
  `hie_code_1` int(6) default null,
  `hie_code_2` int(6) default null,
  `hie_code_3` int(6) default null,
  `hie_code_4` int(6) default null,
  `hie_code_5` int(6) default null,
  `hie_code_6` int(6) default null,
  `hie_code_7` int(6) default null,
  `hie_code_8` int(6) default null,
  `hie_code_9` int(6) default null,
  `hie_code_10` int(6) default null,
	PRIMARY KEY(`emp_number`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_employee` ON `hs_hr_employee`
(
       `class_code`
);

CREATE INDEX `xif2hs_hr_employee` ON `hs_hr_employee`
(
       `cou_code`
);

CREATE INDEX `xif3hs_hr_employee` ON `hs_hr_employee`
(
       `emp_attendance_no`
);

CREATE INDEX `xif4hs_hr_employee` ON `hs_hr_employee`
(
       `emp_status`
);

CREATE INDEX `xif5hs_hr_employee` ON `hs_hr_employee`
(
       `ethnic_race_code`
);

CREATE INDEX `xif6hs_hr_employee` ON `hs_hr_employee`
(
       `gender_code`
);

CREATE INDEX `xif7hs_hr_employee` ON `hs_hr_employee`
(
       `grade_code`
);

CREATE INDEX `xif8hs_hr_employee` ON `hs_hr_employee`
(
       `job_title_code`
);

CREATE INDEX `xif9hs_hr_employee` ON `hs_hr_employee`
(
       `lang_code`
);

CREATE INDEX `xif10hs_hr_employee` ON `hs_hr_employee`
(
       `marst_code`
);

CREATE INDEX `xif11hs_hr_employee` ON `hs_hr_employee`
(
       `nation_code`
);

CREATE INDEX `xif12hs_hr_employee` ON `hs_hr_employee`
(
       `rlg_code`
);

CREATE INDEX `xif13hs_hr_employee` ON `hs_hr_employee`
(
       `service_code`
);

CREATE INDEX `xif14hs_hr_employee` ON `hs_hr_employee`
(
       `title_code`
);

CREATE INDEX `xif15hs_hr_employee` ON `hs_hr_employee`
(
       `work_station`
);

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `employee_id`
	UNIQUE (`employee_id`);


CREATE TABLE `hs_hr_empstat`  ( 
	`estat_code`   	varchar(13) NOT NULL,
	`estat_name`   	varchar(100) NULL,
	`estat_name_si`	varchar(100) NULL,
	`estat_name_ta`	varchar(100) NULL,
	PRIMARY KEY(`estat_code`)
)engine=innodb default charset=utf8;

CREATE TABLE `hs_hr_emp_ebexam` (
  `ebexam_id` int(25) NOT NULL,
  `employee_id` int(7) NOT NULL DEFAULT '0',
  `emp_ebexam_duedate` date DEFAULT NULL,
  `emp_ebexam_completedate` date DEFAULT NULL,
  `emp_ebexam_status` varchar(10) DEFAULT NULL,
  `emp_ebexam_remarks` varchar(200) DEFAULT NULL,
  `emp_ebexam_genaralcomment` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ebexam_id`,`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE INDEX `xif1hs_hr_emp_ebexam` ON `hs_hr_emp_ebexam`
(
       `employee_id`
);


CREATE INDEX `xif2hs_hr_emp_ebexam` ON `hs_hr_emp_ebexam`
(
       `ebexam_id`
);


CREATE TABLE `hs_hr_ethnic_race`  ( 
	`ethnic_race_code`   	varchar(13) NOT NULL,
	`ethnic_race_desc`   	varchar(50) NULL,
	`ethnic_race_desc_si`	varchar(50) NULL,
	`ethnic_race_desc_ta`	varchar(50) NULL,
	PRIMARY KEY(`ethnic_race_code`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_ethnic_race`
	ADD CONSTRAINT `ethnic_race_desc_ta`
	UNIQUE (`ethnic_race_desc_ta`);

ALTER TABLE `hs_hr_ethnic_race`
	ADD CONSTRAINT `ethnic_race_desc_si`
	UNIQUE (`ethnic_race_desc_si`);

ALTER TABLE `hs_hr_ethnic_race`
	ADD CONSTRAINT `ethnic_race_desc`
	UNIQUE (`ethnic_race_desc`);

CREATE TABLE `hs_hr_formlock_details`  ( 
	`frmlock_id`       	int(255) AUTO_INCREMENT NOT NULL,
	`mod_id`           	varchar(36) NOT NULL,
	`con_table_name`   	varchar(200) NOT NULL,
	`con_activity_id`  	int(4) NOT NULL,
	`frmlock_form_name`	varchar(200) NULL,
	PRIMARY KEY(`frmlock_id`)
)engine=innodb default charset=utf8;

CREATE TABLE `hs_hr_gender`  ( 
	`gender_code`   	int(2) AUTO_INCREMENT NOT NULL,
	`gender_name`   	varchar(30) NOT NULL,
	`gender_name_si`	varchar(30) NULL,
	`gender_name_ta`	varchar(30) NULL,
	PRIMARY KEY(`gender_code`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_gender`
	ADD CONSTRAINT `gender_name`
	UNIQUE (`gender_name`);

CREATE TABLE `hs_hr_geninfo`  ( 
	`code`          	varchar(13) NOT NULL,
	`geninfo_keys`  	varchar(200) NULL,
	`geninfo_values`	varchar(800) NULL,
	PRIMARY KEY(`code`)
)engine=innodb default charset=utf8;

CREATE TABLE `hs_hr_grade`  ( 
	`grade_code`   	int(4) AUTO_INCREMENT NOT NULL,
	`grade_name`   	varchar(100) NOT NULL,
	`grade_name_si`	varchar(100) NULL,
	`grade_name_ta`	varchar(100) NULL,
	PRIMARY KEY(`grade_code`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_grade`
	ADD CONSTRAINT `grade_name`
	UNIQUE (`grade_name`);

CREATE TABLE `hs_hr_job_application_events`  ( 
	`id`            	int(11) NOT NULL,
	`application_id`	int(11) NOT NULL,
	`created_time`  	datetime NULL,
	`created_by`    	varchar(36) NULL,
	`owner`         	int(7) NULL,
	`event_time`    	datetime NULL,
	`event_type`    	smallint(2) NULL,
	`status`        	smallint(2) NULL DEFAULT '0',
	`notes`         	text NULL,
	PRIMARY KEY(`id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_job_application_events` ON `hs_hr_job_application_events`
(
       `application_id`
);

CREATE INDEX `xif2hs_hr_job_application_events` ON `hs_hr_job_application_events`
(
       `created_by`
);

CREATE INDEX `xif3hs_hr_job_application_events` ON `hs_hr_job_application_events`
(
       `owner`
);

CREATE TABLE `hs_hr_job_spec`  ( 
	`jobspec_id`    	int(11) NOT NULL DEFAULT '0',
	`jobspec_name`  	varchar(50) NULL,
	`jobspec_desc`  	text NULL,
	`jobspec_duties`	text NULL,
	PRIMARY KEY(`jobspec_id`)
)engine=innodb default charset=utf8;

CREATE TABLE `hs_hr_job_title`  ( 
	`jobtit_code`   	varchar(13) NOT NULL,
	`jobtit_name`   	varchar(100) NULL,
	`jobtit_name_si`	varchar(100) NULL,
	`jobtit_name_ta`	varchar(100) NULL,
	PRIMARY KEY(`jobtit_code`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_job_title`
	ADD CONSTRAINT `jobtit_name_ta`
	UNIQUE (`jobtit_name_ta`);

ALTER TABLE `hs_hr_job_title`
	ADD CONSTRAINT `jobtit_name_si`
	UNIQUE (`jobtit_name_si`);

ALTER TABLE `hs_hr_job_title`
	ADD CONSTRAINT `jobtit_name`
	UNIQUE (`jobtit_name`);

CREATE TABLE `hs_hr_job_vacancy`  ( 
	`vacancy_id` 	int(11) NOT NULL,
	`jobtit_code`	varchar(13) NULL,
	`manager_id` 	int(7) NULL,
	`active`     	tinyint(1) NOT NULL DEFAULT '0',
	`description`	text NULL,
	PRIMARY KEY(`vacancy_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_job_vacancy` ON `hs_hr_job_vacancy`
(
       `jobtit_code`
);

CREATE INDEX `xif2hs_hr_job_vacancy` ON `hs_hr_job_vacancy`
(
       `manager_id`
);


CREATE TABLE `hs_hr_jobtit_empstat`  ( 
	`jobtit_code`	varchar(13) NOT NULL,
	`estat_code` 	varchar(13) NOT NULL,
	PRIMARY KEY(`jobtit_code`,`estat_code`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_jobtit_empstat` ON `hs_hr_jobtit_empstat`
(
       `jobtit_code`
)
;

CREATE INDEX `xif2hs_hr_jobtit_empstat` ON `hs_hr_jobtit_empstat`
(
       `estat_code`
)
;

CREATE TABLE `hs_hr_knw_attach_details`  ( 
	`knw_atd_id`         	int(20) AUTO_INCREMENT NOT NULL,
	`knw_doc_id`         	int(20) NOT NULL,
	`knw_atd_title`      	varchar(100) NULL,
	`knw_atd_title_si`   	varchar(100) NULL,
	`knw_atd_title_ta`   	varchar(100) NULL,
	`knw_atd_keyword`    	varchar(1000) NULL,
	`knw_atd_keyword_si` 	varchar(1000) NULL,
	`knw_atd_keyword_ta` 	varchar(1000) NULL,
	`knw_atd_post_date`  	date NULL,
	`knw_atd_update_date`	date NULL,
	PRIMARY KEY(`knw_atd_id`,`knw_doc_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_knw_attach_details` ON `hs_hr_knw_attach_details`
(
       `knw_doc_id`
)
;

ALTER TABLE `hs_hr_knw_attach_details`
	ADD CONSTRAINT `knw_atd_title_ta`
	UNIQUE (`knw_atd_title_ta`);

ALTER TABLE `hs_hr_knw_attach_details`
	ADD CONSTRAINT `knw_atd_title_si`
	UNIQUE (`knw_atd_title_si`);

ALTER TABLE `hs_hr_knw_attach_details`
	ADD CONSTRAINT `knw_atd_title`
	UNIQUE (`knw_atd_title`);

CREATE TABLE `hs_hr_knw_attachment`  ( 
	`knw_atd_id`        	int(20) NOT NULL,
	`knw_doc_id`        	int(20) NOT NULL,
	`knw_att_filename`  	varchar(200) NULL,
	`knw_att_type`      	varchar(100) NULL,
	`knw_att_size`      	int(11) NULL,
	`knw_att_attachment`	mediumblob NULL,
	`knw_att_article`   	mediumblob NULL,
	PRIMARY KEY(`knw_atd_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_knw_attachment` ON `hs_hr_knw_attachment`
(
       `knw_atd_id`
)
;

CREATE TABLE `hs_hr_knw_doctype`  ( 
	`knw_doc_id`     	int(20) AUTO_INCREMENT NOT NULL,
	`knw_doc_name`   	varchar(200) NOT NULL,
	`knw_doc_name_si`	varchar(200) NULL,
	`knw_doc_name_ta`	varchar(200) NULL,
	PRIMARY KEY(`knw_doc_id`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_knw_doctype`
	ADD CONSTRAINT `knw_doc_name_ta`
	UNIQUE (`knw_doc_name_ta`);

ALTER TABLE `hs_hr_knw_doctype`
	ADD CONSTRAINT `knw_doc_name_si`
	UNIQUE (`knw_doc_name_si`);

ALTER TABLE `hs_hr_knw_doctype`
	ADD CONSTRAINT `knw_doc_name`
	UNIQUE (`knw_doc_name`);

CREATE TABLE `hs_hr_language`  ( 
	`lang_code`   	varchar(13) NOT NULL,
	`lang_name`   	varchar(120) NULL,
	`lang_name_si`	varchar(120) NULL,
	`lang_name_ta`	varchar(120) NULL,
	PRIMARY KEY(`lang_code`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_language`
	ADD CONSTRAINT `lang_name_ta`
	UNIQUE (`lang_name_ta`);

ALTER TABLE `hs_hr_language`
	ADD CONSTRAINT `lang_name_si`
	UNIQUE (`lang_name_si`);

ALTER TABLE `hs_hr_language`
	ADD CONSTRAINT `lang_name`
	UNIQUE (`lang_name`);

CREATE TABLE `hs_hr_leave_application`  ( 
	`leave_app_id`           	int(20) AUTO_INCREMENT NOT NULL,
	`leave_app_applied_date` 	date NULL,
	`emp_number`             	int(7) NULL,
	`leave_app_start_date`   	date NULL,
	`leave_app_end_date`     	date NULL,
	`leave_app_status`       	varchar(1) NULL,
	`leave_type_id`          	int(4) NULL,
	`leave_app_reason`       	int(4) NULL,
	`leave_app_comment`      	varchar(200) NULL,
	`leave_app_covemp_number`	int(7) NULL,
	`leave_type_wf_id`       	varchar(200) NULL,
	`leave_app_workdays`     	float NULL,
	PRIMARY KEY(`leave_app_id`)
)engine=innodb default charset=utf8;


CREATE INDEX `xif1hs_hr_leave_application` ON `hs_hr_leave_application`
(
       `emp_number`
)
;

CREATE INDEX `xif2hs_hr_leave_application` ON `hs_hr_leave_application`
(
       `leave_app_covemp_number`
)
;

CREATE INDEX `xif3hs_hr_leave_application` ON `hs_hr_leave_application`
(
       `leave_type_id`
)
;

CREATE INDEX `xif4hs_hr_leave_application` ON `hs_hr_leave_application`
(
       `leave_type_wf_id`
)
;

CREATE TABLE `hs_hr_leave_entitlement`  ( 
	`emp_number`        	int(7) NOT NULL,
	`leave_type_id`     	int(4) NOT NULL DEFAULT '0',
	`leave_ent_day`     	float NULL,
	`leave_ent_taken`   	float NULL,
	`leave_ent_sheduled`	float NULL,
	`leave_ent_remain`  	float NULL,
	`leave_ent_year`    	varchar(4) NOT NULL,
	PRIMARY KEY(`emp_number`,`leave_type_id`,`leave_ent_year`)
)engine=innodb default charset=utf8;


CREATE INDEX `xif1hs_hr_leave_entitlement` ON `hs_hr_leave_entitlement`
(
       `leave_type_id`
)
;

CREATE INDEX `xif2hs_hr_leave_entitlement` ON `hs_hr_leave_entitlement`
(
       `emp_number`
)
;

CREATE TABLE `hs_hr_leave_holiday`  ( 
	`leave_holiday_id`       	int(4) AUTO_INCREMENT NOT NULL,
	`leave_holiday_name`     	varchar(200) NULL,
	`leave_holiday_name_si`  	varchar(200) NULL,
	`leave_holiday_name_ta`  	varchar(200) NULL,
	`leave_holiday_date`     	date NULL,
	`leave_holiday_annual`   	int(1) NULL,
	`leave_holiday_fulorhalf`	int(1) NULL,
	PRIMARY KEY(`leave_holiday_id`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_leave_holiday`
	ADD CONSTRAINT `leave_holiday_name_ta`
	UNIQUE (`leave_holiday_name_ta`);

ALTER TABLE `hs_hr_leave_holiday`
	ADD CONSTRAINT `leave_holiday_name_si`
	UNIQUE (`leave_holiday_name_si`);

ALTER TABLE `hs_hr_leave_holiday`
	ADD CONSTRAINT `leave_holiday_name`
	UNIQUE (`leave_holiday_name`);

ALTER TABLE `hs_hr_leave_holiday`
	ADD CONSTRAINT `leave_holiday_date`
	UNIQUE (`leave_holiday_date`);

CREATE TABLE `hs_hr_leave_type`  ( 
	`leave_type_id`     	int(4) AUTO_INCREMENT NOT NULL,
	`leave_type_name`   	varchar(200) NULL,
	`leave_type_name_si`	varchar(200) NULL,
	`leave_type_name_ta`	varchar(200) NULL,
	PRIMARY KEY(`leave_type_id`)
)engine=innodb default charset=utf8;


ALTER TABLE `hs_hr_leave_type`
	ADD CONSTRAINT `leave_type_name_ta`
	UNIQUE (`leave_type_name_ta`);

ALTER TABLE `hs_hr_leave_type`
	ADD CONSTRAINT `leave_type_name_si`
	UNIQUE (`leave_type_name_si`);

ALTER TABLE `hs_hr_leave_type`
	ADD CONSTRAINT `leave_type_name`
	UNIQUE (`leave_type_name`);

CREATE TABLE `hs_hr_leave_type_config`  ( 
	`leave_type_id`                   	int(4) NOT NULL DEFAULT '0',
	`leave_type_description`          	varchar(200) NULL,
	`leave_type_active_flg`           	varchar(1) NULL,
	`leave_type_covering_employee_flg`	varchar(1) NULL,
	`leave_type_allow_halfday_flg`    	varchar(1) NULL,
	`leave_type_maternity_leave_flg`  	varchar(1) NULL,
	`leave_type_need_approval_flg`    	varchar(1) NULL,
	`leave_type_entitle_days`         	float NULL,
	`leave_type_max_days_without_medi`	float NULL,
	`leave_type_need_to_apply_before` 	float NULL,
	`leave_type_wf_id`                	varchar(200) NULL,
	`leave_type_comment`              	varchar(200) NULL,
	PRIMARY KEY(`leave_type_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_leave_type_config` ON `hs_hr_leave_type_config`
(
       `leave_type_wf_id`
);

CREATE INDEX `xif2hs_hr_leave_type_config` ON `hs_hr_leave_type_config`
(
       `leave_type_id`
);


CREATE TABLE `hs_hr_leave_type_config_detail`  ( 
	`leave_type_id`	int(4) NOT NULL DEFAULT '0',
	`estat_code`   	varchar(13) NOT NULL,
	PRIMARY KEY(`leave_type_id`,`estat_code`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_leave_type_config_detail` ON `hs_hr_leave_type_config_detail`
(
       `estat_code`
);

CREATE INDEX `xif2hs_hr_leave_type_config_detail` ON `hs_hr_leave_type_config_detail`
(
       `leave_type_id`
);

CREATE TABLE IF NOT EXISTS `hs_hr_leave_details` (
      `leave_app_id` int(20) NOT NULL ,
      `leave_app_applied_date` date DEFAULT NULL,
      `leave_dtl_amount` FLOAT(10) DEFAULT NULL,
      `leave_dtl_type` varchar(1) DEFAULT NULL,
      PRIMARY KEY (`leave_app_id`,`leave_app_applied_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE `hs_hr_licenses`  ( 
	`licenses_code`	varchar(13) NOT NULL,
	`licenses_desc`	varchar(50) NULL,
	PRIMARY KEY(`licenses_code`)
)engine=innodb default charset=utf8;

CREATE TABLE `hs_hr_marital_status`  ( 
	`marst_code`   	int(2) AUTO_INCREMENT NOT NULL,
	`marst_name`   	varchar(30) NOT NULL,
	`marst_name_si`	varchar(30) NULL,
	`marst_name_ta`	varchar(30) NULL,
	PRIMARY KEY(`marst_code`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_marital_status`
	ADD CONSTRAINT `marst_name`
	UNIQUE (`marst_name`);

CREATE TABLE `hs_hr_module`  ( 
	`mod_id`              	varchar(36) NOT NULL,
	`name`                	varchar(45) NULL,
	`module_name_si`      	varchar(100) NULL,
	`module_name_ta`      	varchar(100) NULL,
	`owner`               	varchar(45) NULL,
	`owner_email`         	varchar(100) NULL,
	`version`             	varchar(36) NULL,
	`description`         	text NULL,
	`module_display_order`	int(20) NULL,
	PRIMARY KEY(`mod_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_module` ON `hs_hr_module`
(
       `version`
);


CREATE TABLE `hs_hr_nationality`  ( 
	`nat_code`   	varchar(13) NOT NULL,
	`nat_name`   	varchar(120) NULL,
	`nat_name_si`	varchar(120) NULL,
	`nat_name_ta`	varchar(120) NULL,
	PRIMARY KEY(`nat_code`)
)engine=innodb default charset=utf8;

CREATE TABLE `hs_hr_prm_attachment`  ( 
	`prm_attach_id`        	int(20) AUTO_INCREMENT NOT NULL,
	`prm_attach_filename`  	varchar(200) NULL,
	`prm_attach_size`      	int(11) NULL,
	`prm_attach_attachment`	mediumblob NULL,
	`prm_attach_type`      	varchar(50) NULL,
	`prm_id`               	int(20) NOT NULL,
	PRIMARY KEY(`prm_attach_id`,`prm_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_prm_attachment` ON `hs_hr_prm_attachment`
(
       `prm_id`
);

CREATE TABLE `hs_hr_prm_cnf_attachment`  ( 
	`prm_cnf_attach_id`        	int(20) AUTO_INCREMENT NOT NULL,
	`prm_cnf_attach_filename`  	varchar(200) NULL,
	`prm_cnf_attach_size`      	int(11) NULL,
	`prm_cnf_attach_attachment`	mediumblob NULL,
	`prm_cnf_attach_type`      	varchar(50) NULL,
	`prm_id`                   	int(20) NOT NULL,
	PRIMARY KEY(`prm_cnf_attach_id`,`prm_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_prm_cnf_attachment` ON `hs_hr_prm_cnf_attachment`
(
       `prm_id`
);

CREATE TABLE `hs_hr_prm_conf_method`  ( 
	`prm_conf_method_id`        	int(4) AUTO_INCREMENT NOT NULL,
	`prm_conf_method_comment_en`	varchar(200) NULL,
	`prm_conf_method_comment_si`	varchar(200) NULL,
	`prm_conf_method_comment_ta`	varchar(200) NULL,
	PRIMARY KEY(`prm_conf_method_id`)
)engine=innodb default charset=utf8;

CREATE TABLE `hs_hr_project`  ( 
	`project_id` 	int(11) NOT NULL,
	`customer_id`	int(11) NOT NULL,
	`name`       	varchar(100) NULL,
	`description`	varchar(250) NULL,
	`deleted`    	tinyint(1) NULL DEFAULT '0',
	PRIMARY KEY(`project_id`,`customer_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_project` ON `hs_hr_project`
(
       `customer_id`
);

CREATE TABLE `hs_hr_project_activity`  ( 
	`activity_id`	int(11) NOT NULL,
	`project_id` 	int(11) NOT NULL,
	`name`       	varchar(100) NULL,
	`deleted`    	tinyint(1) NULL DEFAULT '0',
	PRIMARY KEY(`activity_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_project_activity` ON `hs_hr_project_activity`
(
       `project_id`
);


CREATE TABLE `hs_hr_project_admin`  ( 
	`project_id`	int(11) NOT NULL,
	`emp_number`	int(11) NOT NULL,
	PRIMARY KEY(`project_id`,`emp_number`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_project_admin` ON `hs_hr_project_admin`
(
       `emp_number`
);

CREATE INDEX `xif2hs_hr_project_admin` ON `hs_hr_project_admin`
(
       `project_id`
);

CREATE TABLE `hs_hr_promotion`  ( 
	`prm_id`               	int(20) AUTO_INCREMENT NOT NULL,
	`emp_number`           	int(7) NOT NULL,
	`prm_my_number`        	varchar(50) NOT NULL,
	`service_code`         	int(4) NULL,
	`grade_code`           	int(4) NULL,
	`jobtit_code`          	varchar(13) NULL,
	`estat_code`           	varchar(13) NULL,
	`prm_effective_date`   	date NULL,
	`prm_divition`         	int(6) NULL,
	`prm_location`         	varchar(100) NULL,
	`prm_new_sal`          	varchar(50) NULL,
	`prm_prev_grade`       	int(4) NULL,
	`prm_prev_jobtit_code` 	varchar(13) NULL,
	`prm_prev_emp_status`  	varchar(13) NULL,
	`prm_prev_work_station`	int(6) NULL,
	`prm_comment`          	varchar(200) NULL,
	`prm_dhscomment`       	varchar(200) NULL,
	`prm_method_id`        	int(4) NULL,
	`prm_conf_method_id`   	int(4) NULL,
	PRIMARY KEY(`prm_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_promotion` ON `hs_hr_promotion`
(
       `emp_number`
);

CREATE INDEX `xif2hs_hr_promotion` ON `hs_hr_promotion`
(
       `estat_code`
);

CREATE INDEX `xif3hs_hr_promotion` ON `hs_hr_promotion`
(
       `grade_code`
);

CREATE INDEX `xif4hs_hr_promotion` ON `hs_hr_promotion`
(
       `jobtit_code`
);

CREATE INDEX `xif5hs_hr_promotion` ON `hs_hr_promotion`
(
       `prm_conf_method_id`
);

CREATE INDEX `xif6hs_hr_promotion` ON `hs_hr_promotion`
(
       `prm_divition`
);

CREATE INDEX `xif7hs_hr_promotion` ON `hs_hr_promotion`
(
       `prm_method_id`
);

CREATE INDEX `xif8hs_hr_promotion` ON `hs_hr_promotion`
(
       `prm_prev_emp_status`
);

CREATE INDEX `xif9hs_hr_promotion` ON `hs_hr_promotion`
(
       `prm_prev_grade`
);

CREATE INDEX `xif10hs_hr_promotion` ON `hs_hr_promotion`
(
       `prm_prev_jobtit_code`
);

CREATE INDEX `xif11hs_hr_promotion` ON `hs_hr_promotion`
(
       `prm_prev_work_station`
);

CREATE INDEX `xif12hs_hr_promotion` ON `hs_hr_promotion`
(
       `service_code`
);

ALTER TABLE `hs_hr_promotion`
	ADD CONSTRAINT `prm_my_number`
	UNIQUE (`prm_my_number`);

CREATE TABLE `hs_hr_promotion_ckecklist`  ( 
	`prm_checklist_id`     	int(4) AUTO_INCREMENT NOT NULL,
	`prm_checklist_name_en`	varchar(200) NULL,
	`prm_checklist_name_si`	varchar(200) NULL,
	`prm_checklist_name_ta`	varchar(200) NULL,
	PRIMARY KEY(`prm_checklist_id`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_promotion_ckecklist`
	ADD CONSTRAINT `prm_checklist_name_ta`
	UNIQUE (`prm_checklist_name_ta`);

ALTER TABLE `hs_hr_promotion_ckecklist`
	ADD CONSTRAINT `prm_checklist_name_si`
	UNIQUE (`prm_checklist_name_si`);

ALTER TABLE `hs_hr_promotion_ckecklist`
	ADD CONSTRAINT `prm_checklist_name_en`
	UNIQUE (`prm_checklist_name_en`);

CREATE TABLE `hs_hr_promotion_ckecklist_detail`  ( 
	`prm_id`          	int(20) NOT NULL DEFAULT '0',
	`prm_checklist_id`	int(4) NOT NULL DEFAULT '0',
	`value`           	varchar(10) NULL,
	PRIMARY KEY(`prm_id`,`prm_checklist_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_promotion_ckecklist_detail` ON `hs_hr_promotion_ckecklist_detail`
(
       `prm_id`
);

CREATE INDEX `xif2hs_hr_promotion_ckecklist_detail` ON `hs_hr_promotion_ckecklist_detail`
(
       `prm_checklist_id`
);

CREATE TABLE `hs_hr_promotion_method`  ( 
	`prm_method_id`        	int(4) AUTO_INCREMENT NOT NULL,
	`prm_method_comment_en`	varchar(200) NULL,
	`prm_method_comment_si`	varchar(200) NULL,
	`prm_method_comment_ta`	varchar(200) NULL,
	PRIMARY KEY(`prm_method_id`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_promotion_method`
	ADD CONSTRAINT `prm_method_comment_ta`
	UNIQUE (`prm_method_comment_ta`);

ALTER TABLE `hs_hr_promotion_method`
	ADD CONSTRAINT `prm_method_comment_si`
	UNIQUE (`prm_method_comment_si`);

ALTER TABLE `hs_hr_promotion_method`
	ADD CONSTRAINT `prm_method_comment_en`
	UNIQUE (`prm_method_comment_en`);

CREATE TABLE `hs_hr_relationship`  ( 
	`rel_code`   	int(4) AUTO_INCREMENT NOT NULL,
	`rel_name`   	varchar(50) NOT NULL,
	`rel_name_si`	varchar(50) NULL,
	`rel_name_ta`	varchar(50) NULL,
	PRIMARY KEY(`rel_code`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_relationship`
	ADD CONSTRAINT `rel_name`
	UNIQUE (`rel_name`);

CREATE TABLE `hs_hr_religion`  ( 
	`rlg_code`   	int(2) AUTO_INCREMENT NOT NULL,
	`rlg_name`   	varchar(30) NOT NULL,
	`rlg_name_si`	varchar(30) NULL,
	`rlg_name_ta`	varchar(30) NULL,
	PRIMARY KEY(`rlg_code`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_religion`
	ADD CONSTRAINT `rlg_name`
	UNIQUE (`rlg_name`);

CREATE TABLE `hs_hr_ret_retirement`  ( 
	`emp_number`	int(7) NOT NULL,
	`ret_id`    	int(20) NOT NULL,
	`from_date` 	date NULL,
	`to_date`   	date NULL,
	`clause`    	varchar(20) NOT NULL,
	`comment`   	varchar(200) NULL,
	PRIMARY KEY(`emp_number`,`ret_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_ret_retirement` ON `hs_hr_ret_retirement`
(
       `emp_number`
);

CREATE TABLE `hs_hr_service`  ( 
	`service_code`   	int(4) AUTO_INCREMENT NOT NULL,
	`service_name`   	varchar(100) NOT NULL,
	`service_name_si`	varchar(100) NULL,
	`service_name_ta`	varchar(100) NULL,
	PRIMARY KEY(`service_code`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_service`
	ADD CONSTRAINT `service_name`
	UNIQUE (`service_name`);

CREATE TABLE `hs_hr_skill`  ( 
	`skill_code`   	varchar(13) NOT NULL,
	`skill_name`   	varchar(120) NULL,
	`skill_name_si`	varchar(120) NULL,
	`skill_name_ta`	varchar(120) NULL,
	PRIMARY KEY(`skill_code`)
)engine=innodb default charset=utf8;


ALTER TABLE `hs_hr_skill`
	ADD CONSTRAINT `skill_name_ta`
	UNIQUE (`skill_name_ta`);

ALTER TABLE `hs_hr_skill`
	ADD CONSTRAINT `skill_name_si`
	UNIQUE (`skill_name_si`);

ALTER TABLE `hs_hr_skill`
	ADD CONSTRAINT `skill_name`
	UNIQUE (`skill_name`);

CREATE TABLE `hs_hr_sm_capability`  ( 
	`sm_capability_id`         	int(50) AUTO_INCREMENT NOT NULL,
	`sm_capability_name`       	varchar(100) NOT NULL,
	`sm_capability_name_si`    	varchar(100) NULL,
	`sm_capability_name_ta`    	varchar(100) NULL,
	`sm_capability_enable_flag`	varchar(10) NULL,
	PRIMARY KEY(`sm_capability_id`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_sm_capability`
	ADD CONSTRAINT `sm_capability_name_ta`
	UNIQUE (`sm_capability_name_ta`);

ALTER TABLE `hs_hr_sm_capability`
	ADD CONSTRAINT `sm_capability_name_si`
	UNIQUE (`sm_capability_name_si`);

ALTER TABLE `hs_hr_sm_capability`
	ADD CONSTRAINT `sm_capability_name`
	UNIQUE (`sm_capability_name`);

CREATE TABLE IF NOT EXISTS `hs_hr_sm_mnucapability` (
  `sm_capability_id` int(50) NOT NULL,
  `sm_mnuitem_id` int(50) NOT NULL,
  `sm_mnucapa_save` varchar(25) DEFAULT NULL,
  `sm_mnucapa_add` varchar(25) DEFAULT NULL,
  `sm_mnucapa_edit` varchar(25) DEFAULT NULL,
  `sm_mnucapa_delete` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`sm_capability_id`,`sm_mnuitem_id`),
  KEY `sm_mnuitem_id` (`sm_mnuitem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE INDEX `xif1hs_hr_sm_mnucapability` ON `hs_hr_sm_mnucapability`
(
       `sm_mnuitem_id`
);

CREATE INDEX `xif2hs_hr_sm_mnucapability` ON `hs_hr_sm_mnucapability`
(
       `sm_capability_id`
);



CREATE TABLE `hs_hr_sm_mnuitem`  ( 
	`sm_mnuitem_id`         	int(50) AUTO_INCREMENT NOT NULL,
	`sm_mnuitem_name`       	varchar(100) NOT NULL,
	`sm_mnuitem_name_si`    	varchar(100) NULL,
	`sm_mnuitem_name_ta`    	varchar(100) NULL,
	`sm_mnuitem_parent`     	int(20) NOT NULL,
	`sm_mnuitem_level`      	int(20) NOT NULL,
	`sm_mnuitem_webpage_url`	varchar(300) NOT NULL,
	`sm_mnuitem_position`   	varchar(100) NOT NULL,
	`mod_id`                	varchar(36) NOT NULL,
	`sm_mnuitem_dependency` 	varchar(1000) NULL,
	PRIMARY KEY(`sm_mnuitem_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_sm_mnuitem` ON `hs_hr_sm_mnuitem`
(
       `mod_id`
);


CREATE TABLE `hs_hr_sm_rptcapability`  ( 
	`sm_rpt_capability_id`        	int(20) AUTO_INCREMENT NOT NULL,
	`sm_rpt_capability_name`      	varchar(100) NULL,
	`sm_rpt_capability_enable_flg`	int(20) NULL,
	PRIMARY KEY(`sm_rpt_capability_id`)
)engine=innodb default charset=utf8;


create table `hs_hr_sm_rpt_capability` (
	`sm_capability_id` 	int(10) not null ,
	`rn_rpt_id` 		int(10) not null ,
primary key (`sm_capability_id`,`rn_rpt_id`)
) engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_sm_rpt_capability` ON `hs_hr_sm_rpt_capability`
(
       `sm_capability_id`
);

CREATE INDEX `xif2hs_hr_sm_rpt_capability` ON `hs_hr_sm_rpt_capability`
(
       `rn_rpt_id`
);

CREATE TABLE `hs_hr_td_assignlist`  ( 
	`emp_number`          	int(7) NOT NULL,
	`td_course_id`        	int(7) NOT NULL DEFAULT '0',
	`td_asl_isattend`     	varchar(10) NULL,
	`td_asl_isapproved`   	varchar(10) NULL,
	`td_asl_ispending`    	varchar(10) NULL,
	`td_asl_conductperson`	varchar(75) NULL,
	`td_asl_duration`     	varchar(50) NULL,
	`td_asl_conductdate`  	varchar(50) NULL,
	`td_asl_remarks`      	varchar(200) NULL,
	`td_asl_effectiveness`	varchar(200) NULL,
	`td_asl_adminremarks` 	varchar(200) NULL,
	`td_asl_isempfb`      	varchar(10) NULL,
	`td_asl_isadcommented`	varchar(10) NULL,
	`td_asl_content`      	varchar(200) NULL,
	`td_asl_comment`      	varchar(200) NULL,
	`td_asl_year`         	varchar(20) NULL,
	`td_asl_admincomment` 	varchar(200) NULL,
	PRIMARY KEY(`emp_number`,`td_course_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_td_assignlist` ON `hs_hr_td_assignlist`
(
       `td_course_id`
);

CREATE INDEX `xif2hs_hr_td_assignlist` ON `hs_hr_td_assignlist`
(
       `emp_number`
);

CREATE TABLE `hs_hr_td_course`  ( 
	`td_course_id`          	int(6) AUTO_INCREMENT NOT NULL,
	`td_inst_id`            	int(6) NOT NULL,
	`td_course_code`        	varchar(10) NOT NULL,
	`td_course_year`        	int(10) NOT NULL,
	`td_course_name_en`     	varchar(100) NULL,
	`td_course_name_si`     	varchar(100) NULL,
	`td_course_name_ta`     	varchar(100) NULL,
	`lang_code`             	varchar(13) NOT NULL,
	`td_course_venue_en`    	varchar(200) NULL,
	`td_course_venue_si`    	varchar(200) NULL,
	`td_course_venue_ta`    	varchar(200) NULL,
	`td_course_fromdate`    	date NULL,
	`td_course_todate`      	date NULL,
	`td_course_fromtime`    	varchar(25) NULL,
	`td_course_totime`      	varchar(25) NULL,
	`td_course_objective_en`	varchar(200) NULL,
	`td_course_objective_si`	varchar(200) NULL,
	`td_course_objective_ta`	varchar(200) NULL,
	`td_course_whom_en`     	varchar(200) NULL,
	`td_course_whom_si`     	varchar(200) NULL,
	`td_course_whom_ta`     	varchar(200) NULL,
	`td_course_content_en`  	varchar(200) NULL,
	`td_course_content_si`  	varchar(200) NULL,
	`td_course_content_ta`  	varchar(200) NULL,
	`td_course_gencom_en`   	varchar(200) NULL,
	`td_course_gencom_si`   	varchar(200) NULL,
	`td_course_gencom_ta`   	varchar(200) NULL,
	`td_course_fees`        	varchar(20) NULL,
	PRIMARY KEY(`td_course_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_td_course` ON `hs_hr_td_course`
(
       `lang_code`
);

CREATE INDEX `xif2hs_hr_td_course` ON `hs_hr_td_course`
(
       `td_inst_id`
);

ALTER TABLE `hs_hr_td_course`
	ADD CONSTRAINT `td_course_name_ta`
	UNIQUE (`td_course_name_ta`);

ALTER TABLE `hs_hr_td_course`
	ADD CONSTRAINT `td_course_name_si`
	UNIQUE (`td_course_name_si`);

ALTER TABLE `hs_hr_td_course`
	ADD CONSTRAINT `td_course_name_en`
	UNIQUE (`td_course_name_en`);

ALTER TABLE hs_hr_td_course CHANGE lang_code lang_code VARCHAR(13) NULL;

CREATE TABLE `hs_hr_td_institute`  ( 
	`td_inst_id`     	int(6) AUTO_INCREMENT NOT NULL,
	`td_inst_name_en`	varchar(75) NULL,
	`td_inst_name_si`	varchar(75) NULL,
	`td_inst_name_ta`	varchar(75) NULL,
	PRIMARY KEY(`td_inst_id`)
)engine=innodb default charset=utf8;


ALTER TABLE `hs_hr_td_institute`
	ADD CONSTRAINT `td_inst_name_ta`
	UNIQUE (`td_inst_name_ta`);

ALTER TABLE `hs_hr_td_institute`
	ADD CONSTRAINT `td_inst_name_si`
	UNIQUE (`td_inst_name_si`);

ALTER TABLE `hs_hr_td_institute`
	ADD CONSTRAINT `td_inst_name_en`
	UNIQUE (`td_inst_name_en`);

CREATE TABLE `hs_hr_td_tarining_plan` (
  `td_plan_id` int(25) NOT NULL AUTO_INCREMENT,
  `td_plan_month` varchar(50)  NULL,
  `td_plan_year` varchar(4) DEFAULT NULL,
  `td_plan_institute_name` varchar(100) NOT NULL,
  `td_plan_institute_name_si` varchar(100) DEFAULT NULL,
  `td_plan_institute_name_ta` varchar(100) DEFAULT NULL,
  `td_plan_training_name` varchar(100)  NULL,
  `td_plan_training_name_si` varchar(100) DEFAULT NULL,
  `td_plan_training_name_ta` varchar(100) DEFAULT NULL,
  `td_plan_training_summery` varchar(200)  NULL,
  `td_plan_training_frowhom` varchar(200)  NULL,
  PRIMARY KEY (`td_plan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;




CREATE TABLE `hs_hr_title`  ( 
	`title_code`   	int(2) AUTO_INCREMENT NOT NULL,
	`title_name`   	varchar(30) NOT NULL,
	`title_name_si`	varchar(30) NULL,
	`title_name_ta`	varchar(30) NULL,
	PRIMARY KEY(`title_code`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_title`
	ADD CONSTRAINT `title_name`
	UNIQUE (`title_name`);

CREATE TABLE `hs_hr_trans_attach`  ( 
	`trans_attach_id`     	int(10) AUTO_INCREMENT NOT NULL,
	`trans_attach_name`   	varchar(50) NOT NULL,
	`trans_attach_type`   	varchar(50) NOT NULL,
	`trans_attach_content`	mediumblob NULL,
	`trans_id`            	int(8) NOT NULL,
	PRIMARY KEY(`trans_attach_id`,`trans_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_trans_attach` ON `hs_hr_trans_attach`
(
       `trans_id`
);

CREATE TABLE `hs_hr_trans_reason`  ( 
	`trans_reason_id`	int(8) AUTO_INCREMENT NOT NULL,
	`trans_reason_en`	varchar(100) NULL,
	`trans_reason_si`	varchar(100) NULL,
	`trans_reason_ta`	varchar(100) NULL,
	PRIMARY KEY(`trans_reason_id`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_trans_reason`
	ADD CONSTRAINT `trans_reason_ta`
	UNIQUE (`trans_reason_ta`);

ALTER TABLE `hs_hr_trans_reason`
	ADD CONSTRAINT `trans_reason_si`
	UNIQUE (`trans_reason_si`);

ALTER TABLE `hs_hr_trans_reason`
	ADD CONSTRAINT `trans_reason_en`
	UNIQUE (`trans_reason_en`);

CREATE TABLE `hs_hr_transfer`  ( 
	`trans_id`           	int(8) AUTO_INCREMENT NOT NULL,
	`trans_letter_ld`    	varchar(100) NULL DEFAULT '0',
	`trans_emp_number`   	int(7) NULL,
	`trans_currentdiv_id`	int(6) NOT NULL,
	`trans_div_id`       	int(4) NULL,
	`trans_location`     	varchar(100) NULL,
	`trans_mutual`       	varchar(10) NULL,
	`trans_mu_name`      	varchar(100) NULL,
	`trans_effect_date`  	date NULL,
	`trans_reason_id`    	int(4) NULL,
	`trans_comment`      	varchar(200) NULL,
	PRIMARY KEY(`trans_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_transfer` ON `hs_hr_transfer`
(
       `trans_currentdiv_id`
);

CREATE INDEX `xif2hs_hr_transfer` ON `hs_hr_transfer`
(
       `trans_div_id`
);

CREATE INDEX `xif3hs_hr_transfer` ON `hs_hr_transfer`
(
       `trans_emp_number`
);

CREATE INDEX `xif4hs_hr_transfer` ON `hs_hr_transfer`
(
       `trans_reason_id`
);


CREATE TABLE `hs_hr_transfer_request`  ( 
	`trans_req_id`            	int(6) AUTO_INCREMENT NOT NULL,
	`emp_number`              	int(7) NULL,
	`trans_req_division`      	varchar(75) NULL,
	`trans_req_location_pref1`	varchar(75) NULL,
	`trans_req_location_pref2`	varchar(75) NULL,
	`trans_req_location_pref3`	varchar(75) NULL,
	`trans_req_admincommnet`  	varchar(200) NULL,
	`trans_req_usercommnet`   	varchar(200) NULL,
	`trans_req_adminiscomment`	varchar(8) NOT NULL,
	PRIMARY KEY(`trans_req_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_transfer_request` ON `hs_hr_transfer_request`
(
       `emp_number`
);

CREATE TABLE `hs_hr_unique_id`  ( 
	`id`        	int(11) AUTO_INCREMENT NOT NULL,
	`last_id`   	int(10) UNSIGNED NOT NULL,
	`table_name`	varchar(50) NOT NULL,
	`field_name`	varchar(50) NOT NULL,
	PRIMARY KEY(`id`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_unique_id`
	ADD CONSTRAINT `table_field`
	UNIQUE (`table_name`, `field_name`);

CREATE TABLE `hs_hr_user_group`  ( 
	`userg_id`    	varchar(36) NOT NULL,
	`userg_name`  	varchar(45) NULL,
	`userg_repdef`	smallint(5) UNSIGNED NULL DEFAULT '0',
	PRIMARY KEY(`userg_id`)
)engine=innodb default charset=utf8;

CREATE TABLE IF NOT EXISTS `hs_hr_audit` ( 
  `audit_table_name` varchar(255) DEFAULT NULL,
  `audit_row_pk` varchar(50) DEFAULT NULL,
  `audit_field_name` varchar(255) DEFAULT NULL,
  `audit_old_value` blob,
  `audit_new_value` blob,
  `audit_datetime` datetime NOT NULL,
  `audit_user` varchar(255) DEFAULT NULL,
  `audit_description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `hs_hr_users`  ( 
  `id` varchar(36) NOT NULL DEFAULT '',
  `user_name` varchar(40) DEFAULT '',
  `user_password` varchar(40) DEFAULT NULL,
  `emp_number` int(7) DEFAULT NULL,
  `is_admin` char(3) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` varchar(36) DEFAULT NULL,
  `created_by` varchar(36) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,  
  `userg_id` varchar(36) DEFAULT NULL,
  `sm_capability_id` int(50) DEFAULT NULL,
  `sm_rpt_capability_id` int(20) DEFAULT NULL,
  `user_prefered_language` varchar(25) DEFAULT NULL,
	PRIMARY KEY(`id`)
)engine=innodb default charset=utf8;


CREATE INDEX `xif1hs_hr_users` ON `hs_hr_users`
(
       `created_by`
);


CREATE INDEX `xif2hs_hr_users` ON `hs_hr_users`
(
       `emp_number`
);


CREATE INDEX `xif3hs_hr_users` ON `hs_hr_users`
(
       `modified_user_id`
);


CREATE INDEX `xif4hs_hr_users` ON `hs_hr_users`
(
       `sm_capability_id`
);


CREATE INDEX `xif5hs_hr_users` ON `hs_hr_users`
(
       `sm_rpt_capability_id`
);

CREATE INDEX `xif6hs_hr_users` ON `hs_hr_users`
(
       `userg_id`
);

ALTER TABLE `hs_hr_users`
	ADD CONSTRAINT `user_name`
	UNIQUE (`user_name`);


CREATE TABLE `hs_hr_versions`  ( 
	`id`           	varchar(36) NOT NULL,
	`name`         	varchar(45) NULL,
	`entered_date` 	datetime NULL,
	`modified_date`	datetime NULL,
	`modified_by`  	varchar(36) NULL,
	`created_by`   	varchar(36) NULL,
	`deleted`      	tinyint(4) NOT NULL DEFAULT '0',
	`db_version`   	varchar(36) NULL,
	`file_version` 	varchar(36) NULL,
	`description`  	text NULL,
	PRIMARY KEY(`id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_versions` ON `hs_hr_versions`
(
       `created_by`
);

CREATE INDEX `xif2hs_hr_versions` ON `hs_hr_versions`
(
       `db_version`
);

CREATE INDEX `xif3hs_hr_versions` ON `hs_hr_versions`
(
       `modified_by`
);

CREATE TABLE `hs_hr_wbm_benifit`  ( 
	`ben_id`     	int(20) AUTO_INCREMENT NOT NULL,
	`emp_number` 	int(7) NOT NULL,
	`bt_id`      	int(4) NOT NULL,
	`bst_id`     	int(4) NOT NULL,
	`ben_date`   	date NULL,
	`ben_comment`	varchar(200) NULL,
	PRIMARY KEY(`ben_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_wbm_benifit` ON `hs_hr_wbm_benifit`
(
       `bst_id`
);


CREATE INDEX `xif2hs_hr_wbm_benifit` ON `hs_hr_wbm_benifit`
(
       `bt_id`
);


CREATE INDEX `xif3hs_hr_wbm_benifit` ON `hs_hr_wbm_benifit`
(
       `emp_number`
);

CREATE TABLE `hs_hr_wbm_benifit_sub_type`  ( 
	`bst_id`     	int(4) AUTO_INCREMENT NOT NULL,
	`bt_id`      	int(4) NOT NULL,
	`bst_name`   	varchar(200) NULL,
	`bst_name_si`	varchar(200) NULL,
	`bst_name_ta`	varchar(200) NULL,
	PRIMARY KEY(`bst_id`)
)engine=innodb default charset=utf8;

CREATE INDEX `xif1hs_hr_wbm_benifit_sub_type` ON `hs_hr_wbm_benifit_sub_type`
(
       `bt_id`
);


CREATE TABLE `hs_hr_wbm_benifit_type`  ( 
	`bt_id`     	int(4) AUTO_INCREMENT NOT NULL,
	`bt_name`   	varchar(200) NULL,
	`bt_name_si`	varchar(200) NULL,
	`bt_name_ta`	varchar(200) NULL,
	PRIMARY KEY(`bt_id`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_wbm_benifit_type`
	ADD CONSTRAINT `bt_name_ta`
	UNIQUE (`bt_name_ta`);

ALTER TABLE `hs_hr_wbm_benifit_type`
	ADD CONSTRAINT `bt_name_si`
	UNIQUE (`bt_name_si`);

ALTER TABLE `hs_hr_wbm_benifit_type`
	ADD CONSTRAINT `bt_name`
	UNIQUE (`bt_name`);

CREATE TABLE IF NOT EXISTS `hs_hr_carderplan` (
  `id` int(7) NOT NULL,
  `jobtit_code` varchar(13) NOT NULL,
  `carder_actual` int(10) DEFAULT NULL,
  `carder_approved` int(10) DEFAULT NULL,
  `carder_excess` int(10) DEFAULT NULL,
  `carder_vacancies` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`,`jobtit_code`),
  KEY `jobtit_code` (`jobtit_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE INDEX `xif1hs_hr_carderplan` ON `hs_hr_carderplan`
(
       `jobtit_code`
);



create table `hs_hr_rn_report` (
`rn_rpt_id` int(10) not null auto_increment ,
`rn_rpt_name` varchar(100) not null unique ,
`rn_rpt_name_si` varchar(100) default null ,
`rn_rpt_name_ta` VARCHAR(100) default null ,
`rn_rpt_path` varchar(100) default null ,
`mod_id` varchar(36) not null ,
primary key (`rn_rpt_id`)
) engine=innodb default charset=utf8;


CREATE INDEX `xif1hs_hr_rn_report` ON `hs_hr_rn_report`
(
       `mod_id`
);



-- --COMMON HRM complete Database --------------------------------[MY SQL]---------------------------------------------------------

ALTER TABLE `hs_hr_atn_dailyattendance`
	ADD CONSTRAINT `hs_hr_atn_dailyattendance_ibfk_4`
	FOREIGN KEY(`clk_no`)
	REFERENCES `hs_hr_employee`(`emp_attendance_no`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_atn_dailyattendance`
	ADD CONSTRAINT `hs_hr_atn_dailyattendance_ibfk_3`
	FOREIGN KEY(`clk_no`)
	REFERENCES `hs_hr_atn_clockdown`(`clk_no`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_atn_dailyattendance`
	ADD CONSTRAINT `hs_hr_atn_dailyattendance_ibfk_2`
	FOREIGN KEY(`dt_id`)
	REFERENCES `hs_hr_atn_day_type`(`dt_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_atn_dailyattendance`
	ADD CONSTRAINT `hs_hr_atn_dailyattendance_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_atn_day`
	ADD CONSTRAINT `hs_hr_atn_day_ibfk_1`
	FOREIGN KEY(`dt_id`)
	REFERENCES `hs_hr_atn_day_type`(`dt_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_ckecklist_detail`
	ADD CONSTRAINT `hs_hr_ckecklist_detail_ibfk_2`
	FOREIGN KEY(`prm_checklist_id`)
	REFERENCES `hs_hr_promotion_ckecklist`(`prm_checklist_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_ckecklist_detail`
	ADD CONSTRAINT `hs_hr_ckecklist_detail_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_compstructtree`
	ADD CONSTRAINT `hs_hr_compstructtree_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_db_version`
	ADD CONSTRAINT `hs_hr_db_version_ibfk_2`
	FOREIGN KEY(`modified_by`)
	REFERENCES `hs_hr_users`(`id`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_db_version`
	ADD CONSTRAINT `hs_hr_db_version_ibfk_1`
	FOREIGN KEY(`entered_by`)
	REFERENCES `hs_hr_users`(`id`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_dis_attachment`
	ADD CONSTRAINT `hs_hr_dis_attachment_ibfk_1`
	FOREIGN KEY(`dis_inc_id`)
	REFERENCES `hs_hr_dis_incidents`(`dis_inc_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_dis_incidents`
	ADD CONSTRAINT `hs_hr_dis_incidents_ibfk_2`
	FOREIGN KEY(`dis_acttype_id`)
	REFERENCES `hs_hr_dis_action_type`(`dis_acttype_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;


ALTER TABLE `hs_hr_dis_offence`
	ADD CONSTRAINT `hs_hr_dis_offence_ibfk_1`
	FOREIGN KEY(`dis_acttype_id`)
	REFERENCES `hs_hr_dis_action_type`(`dis_acttype_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_dis_offence_list`
	ADD CONSTRAINT `hs_hr_dis_offence_list_ibfk_2`
	FOREIGN KEY(`dis_offence_id`)
	REFERENCES `hs_hr_dis_offence`(`dis_offence_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_dis_offence_list`
	ADD CONSTRAINT `hs_hr_dis_offence_list_ibfk_1`
	FOREIGN KEY(`dis_inc_id`)
	REFERENCES `hs_hr_dis_incidents`(`dis_inc_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_attachment`
	ADD CONSTRAINT `hs_hr_emp_attachment_ibfk_2`
	FOREIGN KEY(`eattach_type_id`)
	REFERENCES `hs_hr_emp_attachment_type`(`eattach_type_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_attachment`
	ADD CONSTRAINT `hs_hr_emp_attachment_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_children`
	ADD CONSTRAINT `hs_hr_emp_children_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_contact`
	ADD CONSTRAINT `hs_hr_emp_contact_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_dependents`
	ADD CONSTRAINT `hs_hr_emp_dependents_ibfk_2`
	FOREIGN KEY(`rel_code`)
	REFERENCES `hs_hr_relationship`(`rel_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_dependents`
	ADD CONSTRAINT `hs_hr_emp_dependents_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_education`
	ADD CONSTRAINT `hs_hr_emp_education_ibfk_2`
	FOREIGN KEY(`edu_code`)
	REFERENCES `hs_hr_education`(`edu_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_education`
	ADD CONSTRAINT `hs_hr_emp_education_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_emergency_contacts`
	ADD CONSTRAINT `hs_hr_emp_emergency_contacts_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_history_of_ealier_pos`
	ADD CONSTRAINT `hs_hr_emp_history_of_ealier_pos_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_jobtitle_history`
	ADD CONSTRAINT `hs_hr_emp_jobtitle_history_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_language`
	ADD CONSTRAINT `hs_hr_emp_language_ibfk_2`
	FOREIGN KEY(`lang_code`)
	REFERENCES `hs_hr_language`(`lang_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_language`
	ADD CONSTRAINT `hs_hr_emp_language_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_licenses`
	ADD CONSTRAINT `hs_hr_emp_licenses_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_picture`
	ADD CONSTRAINT `hs_hr_emp_picture_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_reportto`
	ADD CONSTRAINT `hs_hr_emp_reportto_ibfk_2`
	FOREIGN KEY(`erep_sub_emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_reportto`
	ADD CONSTRAINT `hs_hr_emp_reportto_ibfk_1`
	FOREIGN KEY(`erep_sup_emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_service_history`
	ADD CONSTRAINT `hs_hr_emp_service_history_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_skill`
	ADD CONSTRAINT `hs_hr_emp_skill_ibfk_2`
	FOREIGN KEY(`skill_code`)
	REFERENCES `hs_hr_skill`(`skill_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_skill`
	ADD CONSTRAINT `hs_hr_emp_skill_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_subdivision_history`
	ADD CONSTRAINT `hs_hr_emp_subdivision_history_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_work_experience`
	ADD CONSTRAINT `hs_hr_emp_work_experience_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_employee_ibfk_9`
	FOREIGN KEY(`rlg_code`)
	REFERENCES `hs_hr_religion`(`rlg_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_employee_ibfk_8`
	FOREIGN KEY(`marst_code`)
	REFERENCES `hs_hr_marital_status`(`marst_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_employee_ibfk_7`
	FOREIGN KEY(`gender_code`)
	REFERENCES `hs_hr_gender`(`gender_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_employee_ibfk_6`
	FOREIGN KEY(`title_code`)
	REFERENCES `hs_hr_title`(`title_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_employee_ibfk_5`
	FOREIGN KEY(`emp_status`)
	REFERENCES `hs_hr_empstat`(`estat_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_employee_ibfk_4`
	FOREIGN KEY(`job_title_code`)
	REFERENCES `hs_hr_job_title`(`jobtit_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_employee_ibfk_3`
	FOREIGN KEY(`nation_code`)
	REFERENCES `hs_hr_nationality`(`nat_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_employee_ibfk_2`
	FOREIGN KEY(`ethnic_race_code`)
	REFERENCES `hs_hr_ethnic_race`(`ethnic_race_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_employee_ibfk_14`
	FOREIGN KEY(`grade_code`)
	REFERENCES `hs_hr_grade`(`grade_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_employee_ibfk_13`
	FOREIGN KEY(`service_code`)
	REFERENCES `hs_hr_service`(`service_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_employee_ibfk_12`
	FOREIGN KEY(`class_code`)
	REFERENCES `hs_hr_class`(`class_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_employee_ibfk_11`
	FOREIGN KEY(`cou_code`)
	REFERENCES `hs_hr_country`(`cou_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_employee_ibfk_10`
	FOREIGN KEY(`lang_code`)
	REFERENCES `hs_hr_language`(`lang_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_employee`
	ADD CONSTRAINT `hs_hr_employee_ibfk_1`
	FOREIGN KEY(`work_station`)
	REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_jobtit_empstat`
	ADD CONSTRAINT `hs_hr_jobtit_empstat_ibfk_2`
	FOREIGN KEY(`estat_code`)
	REFERENCES `hs_hr_empstat`(`estat_code`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_jobtit_empstat`
	ADD CONSTRAINT `hs_hr_jobtit_empstat_ibfk_1`
	FOREIGN KEY(`jobtit_code`)
	REFERENCES `hs_hr_job_title`(`jobtit_code`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_knw_attach_details`
	ADD CONSTRAINT `hs_hr_knw_attach_details_ibfk_1`
	FOREIGN KEY(`knw_doc_id`)
	REFERENCES `hs_hr_knw_doctype`(`knw_doc_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_knw_attachment`
	ADD CONSTRAINT `hs_hr_knw_attachment_ibfk_1`
	FOREIGN KEY(`knw_atd_id`)
	REFERENCES `hs_hr_knw_attach_details`(`knw_atd_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_leave_application`
	ADD CONSTRAINT `hs_hr_leave_application_ibfk_4`
	FOREIGN KEY(`leave_type_wf_id`)
	REFERENCES `hs_hr_leave_type_config`(`leave_type_wf_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_leave_application`
	ADD CONSTRAINT `hs_hr_leave_application_ibfk_3`
	FOREIGN KEY(`leave_app_covemp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_leave_application`
	ADD CONSTRAINT `hs_hr_leave_application_ibfk_2`
	FOREIGN KEY(`leave_type_id`)
	REFERENCES `hs_hr_leave_type`(`leave_type_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_leave_application`
	ADD CONSTRAINT `hs_hr_leave_application_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_leave_entitlement`
	ADD CONSTRAINT `hs_hr_leave_entitlement_ibfk_2`
	FOREIGN KEY(`leave_type_id`)
	REFERENCES `hs_hr_leave_type`(`leave_type_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_leave_entitlement`
	ADD CONSTRAINT `hs_hr_leave_entitlement_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_leave_type_config`
	ADD CONSTRAINT `hs_hr_leave_type_config_ibfk_1`
	FOREIGN KEY(`leave_type_id`)
	REFERENCES `hs_hr_leave_type`(`leave_type_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_leave_type_config_detail`
	ADD CONSTRAINT `hs_hr_leave_type_config_detail_ibfk_2`
	FOREIGN KEY(`estat_code`)
	REFERENCES `hs_hr_empstat`(`estat_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_leave_type_config_detail`
	ADD CONSTRAINT `hs_hr_leave_type_config_detail_ibfk_1`
	FOREIGN KEY(`leave_type_id`)
	REFERENCES `hs_hr_leave_type_config`(`leave_type_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_module`
	ADD CONSTRAINT `hs_hr_module_ibfk_1`
	FOREIGN KEY(`version`)
	REFERENCES `hs_hr_versions`(`id`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_prm_attachment`
	ADD CONSTRAINT `hs_hr_prm_attachment_ibfk_1`
	FOREIGN KEY(`prm_id`)
	REFERENCES `hs_hr_promotion`(`prm_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_prm_cnf_attachment`
	ADD CONSTRAINT `hs_hr_prm_cnf_attachment_ibfk_1`
	FOREIGN KEY(`prm_id`)
	REFERENCES `hs_hr_promotion`(`prm_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_project`
	ADD CONSTRAINT `hs_hr_project_ibfk_1`
	FOREIGN KEY(`customer_id`)
	REFERENCES `hs_hr_customer`(`customer_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_project_activity`
	ADD CONSTRAINT `hs_hr_project_activity_ibfk_1`
	FOREIGN KEY(`project_id`)
	REFERENCES `hs_hr_project`(`project_id`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_project_admin`
	ADD CONSTRAINT `hs_hr_project_admin_ibfk_2`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_project_admin`
	ADD CONSTRAINT `hs_hr_project_admin_ibfk_1`
	FOREIGN KEY(`project_id`)
	REFERENCES `hs_hr_project`(`project_id`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_promotion`
	ADD CONSTRAINT `hs_hr_promotion_ibfk_9`
	FOREIGN KEY(`prm_prev_emp_status`)
	REFERENCES `hs_hr_empstat`(`estat_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_promotion`
	ADD CONSTRAINT `hs_hr_promotion_ibfk_8`
	FOREIGN KEY(`prm_prev_jobtit_code`)
	REFERENCES `hs_hr_job_title`(`jobtit_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_promotion`
	ADD CONSTRAINT `hs_hr_promotion_ibfk_7`
	FOREIGN KEY(`prm_prev_grade`)
	REFERENCES `hs_hr_grade`(`grade_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_promotion`
	ADD CONSTRAINT `hs_hr_promotion_ibfk_6`
	FOREIGN KEY(`prm_divition`)
	REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_promotion`
	ADD CONSTRAINT `hs_hr_promotion_ibfk_5`
	FOREIGN KEY(`estat_code`)
	REFERENCES `hs_hr_empstat`(`estat_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_promotion`
	ADD CONSTRAINT `hs_hr_promotion_ibfk_4`
	FOREIGN KEY(`jobtit_code`)
	REFERENCES `hs_hr_job_title`(`jobtit_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_promotion`
	ADD CONSTRAINT `hs_hr_promotion_ibfk_3`
	FOREIGN KEY(`grade_code`)
	REFERENCES `hs_hr_grade`(`grade_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_promotion`
	ADD CONSTRAINT `hs_hr_promotion_ibfk_2`
	FOREIGN KEY(`service_code`)
	REFERENCES `hs_hr_service`(`service_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_promotion`
	ADD CONSTRAINT `hs_hr_promotion_ibfk_12`
	FOREIGN KEY(`prm_conf_method_id`)
	REFERENCES `hs_hr_prm_conf_method`(`prm_conf_method_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_promotion`
	ADD CONSTRAINT `hs_hr_promotion_ibfk_11`
	FOREIGN KEY(`prm_method_id`)
	REFERENCES `hs_hr_promotion_method`(`prm_method_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_promotion`
	ADD CONSTRAINT `hs_hr_promotion_ibfk_10`
	FOREIGN KEY(`prm_prev_work_station`)
	REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_promotion`
	ADD CONSTRAINT `hs_hr_promotion_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_promotion_ckecklist_detail`
	ADD CONSTRAINT `hs_hr_promotion_ckecklist_detail_ibfk_2`
	FOREIGN KEY(`prm_checklist_id`)
	REFERENCES `hs_hr_promotion_ckecklist`(`prm_checklist_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_promotion_ckecklist_detail`
	ADD CONSTRAINT `hs_hr_promotion_ckecklist_detail_ibfk_1`
	FOREIGN KEY(`prm_id`)
	REFERENCES `hs_hr_promotion`(`prm_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_ret_retirement`
	ADD CONSTRAINT `hs_hr_ret_retirement_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_sm_mnucapability`
	ADD CONSTRAINT `hs_hr_sm_mnucapability_ibfk_2`
	FOREIGN KEY(`sm_capability_id`)
	REFERENCES `hs_hr_sm_capability`(`sm_capability_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_sm_mnucapability`
	ADD CONSTRAINT `hs_hr_sm_mnucapability_ibfk_1`
	FOREIGN KEY(`sm_mnuitem_id`)
	REFERENCES `hs_hr_sm_mnuitem`(`sm_mnuitem_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_sm_mnuitem`
	ADD CONSTRAINT `hs_hr_sm_mnuitem_ibfk_1`
	FOREIGN KEY(`mod_id`)
	REFERENCES `hs_hr_module`(`mod_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_td_assignlist`
	ADD CONSTRAINT `hs_hr_td_assignlist_ibfk_2`
	FOREIGN KEY(`td_course_id`)
	REFERENCES `hs_hr_td_course`(`td_course_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_td_assignlist`
	ADD CONSTRAINT `hs_hr_td_assignlist_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_td_course`
	ADD CONSTRAINT `hs_hr_td_course_ibfk_2`
	FOREIGN KEY(`lang_code`)
	REFERENCES `hs_hr_language`(`lang_code`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_td_course`
	ADD CONSTRAINT `hs_hr_td_course_ibfk_1`
	FOREIGN KEY(`td_inst_id`)
	REFERENCES `hs_hr_td_institute`(`td_inst_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_trans_attach`
	ADD CONSTRAINT `hs_hr_trans_attach_ibfk_1`
	FOREIGN KEY(`trans_id`)
	REFERENCES `hs_hr_transfer`(`trans_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_transfer`
	ADD CONSTRAINT `hs_hr_transfer_ibfk_4`
	FOREIGN KEY(`trans_emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_transfer`
	ADD CONSTRAINT `hs_hr_transfer_ibfk_3`
	FOREIGN KEY(`trans_reason_id`)
	REFERENCES `hs_hr_trans_reason`(`trans_reason_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_transfer`
	ADD CONSTRAINT `hs_hr_transfer_ibfk_2`
	FOREIGN KEY(`trans_div_id`)
	REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_transfer`
	ADD CONSTRAINT `hs_hr_transfer_ibfk_1`
	FOREIGN KEY(`trans_currentdiv_id`)
	REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_transfer_request`
	ADD CONSTRAINT `hs_hr_transfer_request_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_users`
	ADD CONSTRAINT `hs_hr_users_ibfk_5`
	FOREIGN KEY(`sm_capability_id`)
	REFERENCES `hs_hr_sm_capability`(`sm_capability_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_users`
	ADD CONSTRAINT `hs_hr_users_ibfk_4`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_users`
	ADD CONSTRAINT `hs_hr_users_ibfk_3`
	FOREIGN KEY(`userg_id`)
	REFERENCES `hs_hr_user_group`(`userg_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_users`
	ADD CONSTRAINT `hs_hr_users_ibfk_2`
	FOREIGN KEY(`created_by`)
	REFERENCES `hs_hr_users`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_users`
	ADD CONSTRAINT `hs_hr_users_ibfk_1`
	FOREIGN KEY(`modified_user_id`)
	REFERENCES `hs_hr_users`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_versions`
	ADD CONSTRAINT `hs_hr_versions_ibfk_3`
	FOREIGN KEY(`db_version`)
	REFERENCES `hs_hr_db_version`(`id`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_versions`
	ADD CONSTRAINT `hs_hr_versions_ibfk_2`
	FOREIGN KEY(`created_by`)
	REFERENCES `hs_hr_users`(`id`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_versions`
	ADD CONSTRAINT `hs_hr_versions_ibfk_1`
	FOREIGN KEY(`modified_by`)
	REFERENCES `hs_hr_users`(`id`)
	ON DELETE CASCADE 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_wbm_benifit`
	ADD CONSTRAINT `hs_hr_wbm_benifit_ibfk_3`
	FOREIGN KEY(`bst_id`)
	REFERENCES `hs_hr_wbm_benifit_sub_type`(`bst_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_wbm_benifit`
	ADD CONSTRAINT `hs_hr_wbm_benifit_ibfk_2`
	FOREIGN KEY(`bt_id`)
	REFERENCES `hs_hr_wbm_benifit_type`(`bt_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_wbm_benifit`
	ADD CONSTRAINT `hs_hr_wbm_benifit_ibfk_1`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_wbm_benifit_sub_type`
	ADD CONSTRAINT `hs_hr_wbm_benifit_sub_type_ibfk_1`
	FOREIGN KEY(`bt_id`)
	REFERENCES `hs_hr_wbm_benifit_type`(`bt_id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;





ALTER TABLE `hs_hr_dis_involved_emp`
	ADD CONSTRAINT `hs_hr_dis_involved_emp_ibfk_1`
	FOREIGN KEY (`dis_inc_id`)
	REFERENCES  `hs_hr_dis_incidents`(`dis_inc_id`) 
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_ebexam`
	ADD CONSTRAINT `hs_hr_ebexam_ibfk_2`
	FOREIGN KEY (`service_code`)
	REFERENCES  `hs_hr_service`(`service_code`)
 	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_ebexam`
	ADD CONSTRAINT `hs_hr_emp_ebexam_ibfk_1`
	FOREIGN KEY (`ebexam_id`)
	REFERENCES  hs_hr_ebexam (`ebexam_id`) 
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_ebexam`
	ADD CONSTRAINT `hs_hr_emp_ebexam_ibfk_2`
	FOREIGN KEY (`employee_id`)
	REFERENCES  `hs_hr_employee` (`emp_number`)
 	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_emp_disciaction`
	ADD CONSTRAINT `hs_hr_emp_disciaction_ibfk_1`
	FOREIGN KEY (`emp_number`)
	REFERENCES  `hs_hr_employee` (`emp_number`) 
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;





ALTER TABLE `hs_hr_carderplan`
	ADD CONSTRAINT `hs_hr_carderplan_ibfk_2`
	FOREIGN KEY (`jobtit_code`)
	REFERENCES  `hs_hr_job_title` (`jobtit_code`) 
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_rn_report` 
       	ADD CONSTRAINT `hs_hr_rn_report_ibfk_1`
	FOREIGN KEY (`mod_id`)
        REFERENCES `hs_hr_module`(`mod_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_sm_rpt_capability` 
       	ADD CONSTRAINT `hs_hr_sm_rpt_capability_ibfk_1`
	FOREIGN KEY (`rn_rpt_id`)
	REFERENCES `hs_hr_rn_report`(`rn_rpt_id`) 
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_sm_rpt_capability` 
       	ADD CONSTRAINT `hs_hr_sm_rpt_capability_ibfk_2`
	FOREIGN KEY (`sm_capability_id`)
	REFERENCES `hs_hr_sm_capability`(`sm_capability_id`)	
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_compstructtree`
       	ADD CONSTRAINT `hs_hr_compstructtree_ibfk_2`
	FOREIGN KEY (`def_level`)
        REFERENCES `hs_hr_company_structure_def`(`def_level`) 	
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;




-- --COMMON HRM complete Database --------------------------------[MY SQL]---------------------------------------------------------

-- -------------------- Field HIE_CODE_1 creation in HS_HR_EMPLOYEE table ----------------------------------------

ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `hie_code_1_ibfk_1`
	FOREIGN KEY (`hie_code_1`)
       	REFERENCES `hs_hr_compstructtree`(`id`)
 	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

CREATE INDEX `hie_code_1` ON `hs_hr_employee`
(
       `hie_code_1`
);

-- -------------------- Field HIE_CODE_2 creation in HS_HR_EMPLOYEE table ----------------------------------------

ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `hie_code_2_ibfk_2`
	FOREIGN KEY (`hie_code_2`)
	REFERENCES `hs_hr_compstructtree`(`id`) 
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

CREATE INDEX `hie_code_2` ON `hs_hr_employee`
(
       `hie_code_2`
);

-- -------------------- Field HIE_CODE_3 creation in HS_HR_EMPLOYEE table ----------------------------------------

ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `hie_code_3_ibfk_3`
	FOREIGN KEY (`hie_code_3`)
        REFERENCES `hs_hr_compstructtree`(`id`) 
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

CREATE INDEX `hie_code_3` ON `hs_hr_employee`
(
       `hie_code_3`
);

-- -------------------- Field HIE_CODE_4 creation in HS_HR_EMPLOYEE table ----------------------------------------

ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `hie_code_4_ibfk_4`
	FOREIGN KEY (`hie_code_4`)
        REFERENCES `hs_hr_compstructtree`(`id`) 
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

CREATE INDEX `hie_code_4` ON `hs_hr_employee`
(
       `hie_code_4`
);

-- -------------------- Field HIE_CODE_5 creation in HS_HR_EMPLOYEE table ----------------------------------------

ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `hie_code_5_ibfk_5`
	FOREIGN KEY (`hie_code_5`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

CREATE INDEX `hie_code_5` ON `hs_hr_employee`
(
       `hie_code_5`
);

-- -------------------- Field HIE_CODE_6 creation in HS_HR_EMPLOYEE table ----------------------------------------

ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `hie_code_6_ibfk_6`
	FOREIGN KEY (`hie_code_6`)
        REFERENCES `hs_hr_compstructtree`(`id`) 
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

CREATE INDEX `hie_code_6` ON `hs_hr_employee`
(
       `hie_code_6`
);

-- -------------------- Field HIE_CODE_7 creation in HS_HR_EMPLOYEE table ----------------------------------------

ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `hie_code_7_ibfk_7` 
	FOREIGN KEY (`hie_code_7`)
        REFERENCES `hs_hr_compstructtree`(`id`) 
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

CREATE INDEX `hie_code_7` ON `hs_hr_employee`
(
       `hie_code_7`
);

-- -------------------- Field HIE_CODE_8 creation in HS_HR_EMPLOYEE table ----------------------------------------

ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `hie_code_8_ibfk_8`
	FOREIGN KEY (`hie_code_8`)
        REFERENCES `hs_hr_compstructtree`(`id`) 
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

CREATE INDEX `hie_code_8` ON `hs_hr_employee`
(
       `hie_code_8`
);

-- -------------------- Field HIE_CODE_9 creation in HS_HR_EMPLOYEE table ----------------------------------------

ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `hie_code_9_ibfk_9`
	FOREIGN KEY (`hie_code_9`)
        REFERENCES `hs_hr_compstructtree`(`id`) 
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

CREATE INDEX `hie_code_9` ON `hs_hr_employee`
(
       `hie_code_9`
);

-- -------------------- Field HIE_CODE_10 creation in HS_HR_EMPLOYEE table ----------------------------------------

ALTER TABLE `hs_hr_employee`
       	ADD CONSTRAINT `hie_code_10_ibfk_10`
	FOREIGN KEY (`hie_code_10`)
        REFERENCES `hs_hr_compstructtree`(`id`) 
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT ;

CREATE INDEX `hie_code_10` ON `hs_hr_employee`
(
       `hie_code_10`
);

Alter table hs_hr_leave_details
        add constraint foreign key (leave_app_id)
        references  hs_hr_leave_application(leave_app_id)
        on delete RESTRICT;





