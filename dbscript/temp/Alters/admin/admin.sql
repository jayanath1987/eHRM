SET NAMES 'UTF8';

CREATE TABLE IF NOT EXISTS `hs_hr_notice` (
  `notice_code` int(4) NOT NULL AUTO_INCREMENT,
  `notice_name` varchar(50) NOT NULL,
  `notice_name_si` varchar(50) DEFAULT NULL,
  `notice_name_ta` varchar(50) DEFAULT NULL,
  `notice_desc` varchar(250) NOT NULL,
  `notice_desc_si` varchar(250) DEFAULT NULL,
  `notice_desc_ta` varchar(250) DEFAULT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  PRIMARY KEY (`notice_code`),
  UNIQUE KEY `notice_code` (`notice_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `hs_hr_notice`
	ADD CONSTRAINT `notice_name`
	UNIQUE (`notice_name`);

ALTER TABLE `hs_hr_notice`
	ADD CONSTRAINT `notice_name_si`
	UNIQUE (`notice_name_si`);

ALTER TABLE `hs_hr_notice`
	ADD CONSTRAINT `notice_name_ta`
	UNIQUE (`notice_name_ta`);


INSERT INTO `hs_hr_sm_mnuitem` (
`sm_mnuitem_id` ,
`sm_mnuitem_name` ,
`sm_mnuitem_name_si` ,
`sm_mnuitem_name_ta` ,
`sm_mnuitem_parent` ,
`sm_mnuitem_level` ,
`sm_mnuitem_webpage_url` ,
`sm_mnuitem_position` ,
`mod_id` ,
`sm_mnuitem_dependency`
)
VALUES (
'1016',  'Notice ',  'දැන්වීම්',  'நோட்டீஸ்',  '1000',  '1',  './symfony/web/index.php/admin/listNotice',  '01.05',  'MOD001',  'listNotice,saveNotice,deleteNotice'
);

UPDATE `hs_hr_religion` SET `rlg_name` = 'Christian',
`rlg_name_si` = 'ක්‍රිස්තියානි' WHERE `hs_hr_religion`.`rlg_code` =4;


INSERT INTO `hs_hr_empstat` (`estat_code`, `estat_name`, `estat_name_si`, `estat_name_ta`) VALUES
('EST012', 'Temporary', 'තාවකාලික', 'நசறஙநச'),
('EST013', 'Permanent', 'ස්ථීර', 'றநஙச'),
('EST014', 'Secondment', 'අනුයුක්ත', NULL);

UPDATE `hs_hr_unique_id` SET `last_id` = '4' WHERE `hs_hr_unique_id`.`id` =2;

ALTER TABLE `hs_hr_formlock_details` ADD `frmlock_form_name_si` VARCHAR( 200 ) NULL DEFAULT NULL ,
ADD `frmlock_form_name_ta` VARCHAR( 200 ) NULL DEFAULT NULL; 

ALTER TABLE  `hs_hr_compstructtree` ADD  `comp_isfunctional` INT( 1 ) NOT NULL AFTER  `comp_reference_code`;


delete from hs_hr_company_structure_def where def_level>6;

UPDATE `hs_hr_company_structure_def` SET `def_name_si` = 'කලාප මට්ටම' WHERE `hs_hr_company_structure_def`.`def_level` =5;

UPDATE `hs_hr_emp_attachment_type` SET `eattach_type_name_si` = 'ක්‍රීඩා සහතික' WHERE `hs_hr_emp_attachment_type`.`eattach_type_id` = 1;

ALTER TABLE `hs_hr_emp_level` ENGINE = InnoDB;

ALTER TABLE `hs_hr_emp_level` CHANGE `emp_number` `emp_number` INT( 4 ) NOT NULL; 
