SET NAMES 'UTF8';


-- security sql alters uploaded to cloud 28092011

CREATE  FUNCTION `getUser`() RETURNS CHAR(7) DETERMINISTIC
RETURN (@empNumber);


ALTER TABLE  `hs_hr_users` ADD  `def_level` INT( 20 ) NULL AFTER  `user_prefered_language`;



CREATE TABLE IF NOT EXISTS `hs_hr_emp_level` (
  `emp_number` int(50) NOT NULL,
  `hie_code_1` int(50) DEFAULT NULL,
  `hie_code_2` int(50) DEFAULT NULL,
  `hie_code_3` int(50) DEFAULT NULL,
  `hie_code_4` int(50) DEFAULT NULL,
  `hie_code_5` int(50) DEFAULT NULL,
  `hie_code_6` int(50) DEFAULT NULL,
  `hie_code_7` int(50) DEFAULT NULL,
  `hie_code_8` int(50) DEFAULT NULL,
  `hie_code_9` int(50) DEFAULT NULL,
  `hie_code_10` int(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE  `hs_hr_employee` ADD  `emp_ldap_flag` INT( 2 ) NULL AFTER  `emp_pension_no`;

INSERT INTO  `hs_hr_formlock_details` (
`frmlock_id` ,
`mod_id` ,
`con_table_name` ,
`con_activity_id` ,
`frmlock_form_name`
)
VALUES (
NULL ,  'MOD013',  'hs_hr_sm_mnucapability',  '2',  'Employee Capability'
);

UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_position` =  '02.03.04' WHERE  `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2006;

UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_position` =  '02.03.03' WHERE  `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2007;

UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_position` =  '02.03.05' WHERE  `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2008;


drop view if exists  vw_hs_hr_employee;
CREATE VIEW vw_hs_hr_employee  as
select * from hs_hr_employee e where CASE WHEN getUser()=''
	THEN
	 e.emp_number is not null
	ELSE
hie_code_1 in ( select hie_code_1 from hs_hr_emp_level L,hs_hr_users U   where L.emp_number=U.emp_number and L.emp_number=getUser() and  ( U.def_level=1 or U.def_level=4 )   )
or
 hie_code_3 in ( select hie_code_3 from hs_hr_emp_level L,hs_hr_users U   where L.emp_number=U.emp_number and L.emp_number=getUser() and  U.def_level=2   )
or
  hie_code_4 in ( select hie_code_4 from hs_hr_emp_level L,hs_hr_users U   where L.emp_number=U.emp_number and L.emp_number=getUser() and  U.def_level=3 )

end;

UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_position` =  '01.02.05' WHERE  `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =15002;

UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_position` =  '01.02.06' WHERE  `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =15003;


-- training sql scripted to clould on 28092011

DELETE FROM `hs_hr_sm_mnucapability` WHERE `hs_hr_sm_mnucapability`.`sm_capability_id` = 1 AND `hs_hr_sm_mnucapability`.`sm_mnuitem_id` = 5004;
DELETE FROM `hs_hr_sm_mnucapability` WHERE `hs_hr_sm_mnucapability`.`sm_capability_id` = 1 AND `hs_hr_sm_mnucapability`.`sm_mnuitem_id` = 5008;


DELETE FROM `hs_hr_sm_mnuitem` WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5004;
DELETE FROM `hs_hr_sm_mnuitem` WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5008;

-- workflow sql scripted on 28092011

ALTER TABLE  `hs_hr_wf_main` ADD PRIMARY KEY (  `wfmain_sequence` ,  `wfmain_id` ) ;

-- admin sql scripted on 28092011

CREATE TABLE  `hs_hr_district` (
`district_id` INT( 20 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`district_name` VARCHAR( 100 ) NULL ,
`district_name_si` VARCHAR( 100 ) NULL ,
`district_name_ta` VARCHAR( 100 ) NULL
) ENGINE = INNODB;

ALTER TABLE  `hs_hr_district` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `hs_hr_district` CHANGE `district_name` `district_name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `district_name_si` `district_name_si` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `district_name_ta` `district_name_ta` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

INSERT INTO `hs_hr_district` (`district_id`, `district_name`, `district_name_si`, `district_name_ta`) VALUES
(42, 'Colombo', 'කොළඹ', '‎கொழும்பு'),
(43, 'Gampaha', 'ගම්පහ', 'கம்‍‍‎ப‍‍ஹ'),
(44, 'Kalutara', 'කළුතර', 'களுத்து‍றை'),
(45, 'Kandy', 'මහනුවර', 'கண்டி'),
(46, 'Matale', 'මාතලේ', 'மாத்த‍‍‍ளை'),
(47, 'Nuwara Eliya', 'නුවරඑළිය', 'நுவ‎ரெளியா'),
(48, 'Galle', 'ගාල්ල', 'காலி'),
(49, 'Matara', 'මාතර', 'மாத்தறை'),
(50, 'Hambantota', 'හම්බන්තොට', 'ஹம்பாந்தோட்‍டை'),
(51, 'Jaffna', 'යාපනය', 'யாழ்பாணம்'),
(52, 'Mannar', 'මන්නාරම', 'மன்னார்'),
(53, 'Vavuniya', 'වව්නියාව', 'வவுனியா'),
(54, 'Mullaitivu', 'මුලතිව්', 'முள்ளைத்தீவு'),
(55, 'Kilinochchi', 'කිලිනොච්චි', 'கிளி‎‎நொச்சி'),
(56, 'Batticaloa', 'මඩකලපුව', 'மட்டக்களப்பு'),
(57, 'Ampara', 'අම්පාර', 'அம்பா‍‍றை'),
(58, 'Trincomalee', 'ත්‍රිකුණාමලය', 'திரு‍கோண‍மலை'),
(59, 'Kurunegala', 'කුරුණෑගල', 'குருணாக‍லை'),
(60, 'Puttalam', 'පුත්තලම', 'புத்தளம்'),
(61, 'Anuradhapura', 'අනුරාධපුරය', 'அநுராதபுரம்'),
(62, 'Polonnaruwa', 'පොළොන්නරුව', '‎பொலண்ணரு‍வை'),
(63, 'Badulla', 'බදුල්ල', 'பது‍ளை'),
(64, 'Moneragala', 'මොනරාගල', '‎மொணராக‍லை'),
(65, 'Ratnapura', 'රත්නපුර', 'இரத்திணபுரி'),
(66, 'Kegalle', 'කෑගල්ල', '‍‎‍‍‍கேகா‍லை');

ALTER TABLE `hs_hr_emp_service_history` DROP `esh_district_si`, DROP `esh_district_ta`;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'personalDetail,addEmployee,personalDetails,employeeList,Delete,list,deleteEmployee' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2001;

--
-- Alter service_code to hs_hr_emp_job_role table
--
ALTER TABLE `hs_hr_emp_job_role` ADD `service_code` INT( 4 ) NULL AFTER `level_code`;

--
-- ADD CONSTRAINT service_code to hs_hr_emp_job_role table
--
ALTER TABLE `hs_hr_emp_job_role`
  ADD CONSTRAINT `hs_hr_emp_job_role_service_code` FOREIGN KEY (`service_code`) REFERENCES `hs_hr_service` (`service_code`)
ON DELETE RESTRICT
ON UPDATE RESTRICT ;



--  Disciplinary alters  Jayanath Reinstatement table create 2011-09-14



CREATE TABLE IF NOT EXISTS `hs_hr_reinstatement` (
  `rei_id` int(10) NOT NULL AUTO_INCREMENT,
  `emp_number` int(7) DEFAULT NULL,
  `emp_epf_number` varchar(25) DEFAULT NULL,
  `rei_date` date DEFAULT NULL,
  `job_title_code` varchar(13) DEFAULT NULL,
  `grade_code` int(4) DEFAULT NULL,
  `slt_id` int(10) DEFAULT NULL,
  `work_station` int(6) DEFAULT NULL,
  `rei_reason` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`rei_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `hs_hr_reinstatement`
	ADD CONSTRAINT `hs_hr_employee_hs_hr_reinstatement`
	FOREIGN KEY(`emp_number`)
	REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_reinstatement`
	ADD CONSTRAINT `hs_hr_reinstatement_jobtit_code`
	FOREIGN KEY(`job_title_code`)
	REFERENCES `hs_hr_job_title`(`jobtit_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_reinstatement`
	ADD CONSTRAINT `hs_hr_reinstatement_grade_code`
	FOREIGN KEY(`grade_code`)
	REFERENCES `hs_hr_grade`(`grade_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_reinstatement`
	ADD CONSTRAINT `hs_hr_reinstatement_work_station`
	FOREIGN KEY(`work_station`)
	REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_reinstatement`
	ADD CONSTRAINT `hs_hr_reinstatement_hs_hr_grade_slot`
	FOREIGN KEY (`slt_id`)
	REFERENCES `hs_hr_grade_slot` (`slt_id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;




UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_name` =  'Disciplinary Type' WHERE  `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =4001;




--  PIM alters  Jayanath Job Titles Data 2011-09-22
CREATE TABLE IF NOT EXISTS `hs_hr_empacting_workstation` (
  `emp_number` int(7) NOT NULL,
  `act_job_title_code` varchar(13) DEFAULT NULL,
  `act_workstation_no` int(7) DEFAULT NULL,
  `act_hie_code_1` int(6) DEFAULT NULL,
  `act_hie_code_2` int(6) DEFAULT NULL,
  `act_hie_code_3` int(6) DEFAULT NULL,
  `act_hie_code_4` int(6) DEFAULT NULL,
  `act_hie_code_5` int(6) DEFAULT NULL,
  `act_hie_code_6` int(6) DEFAULT NULL,
  `act_hie_code_7` int(6) DEFAULT NULL,
  `act_hie_code_8` int(6) DEFAULT NULL,
  `act_hie_code_9` int(6) DEFAULT NULL,
  `act_hie_code_10` int(6) DEFAULT NULL,
  `act_work_satation` int(6) DEFAULT NULL,
  PRIMARY KEY (`emp_number`,`act_workstation_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `hs_hr_empacting_workstation`
       	ADD CONSTRAINT `employee_hs_hr_empacting_workstation`
	FOREIGN KEY (`emp_number`)
        REFERENCES `hs_hr_employee`(`emp_number`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_empacting_workstation`
	ADD CONSTRAINT `hs_hr_empacting_workstation_job_title_code`
	FOREIGN KEY(`act_job_title_code`)
	REFERENCES `hs_hr_job_title`(`jobtit_code`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_empacting_workstation`
       	ADD CONSTRAINT `act_hie_code_1_id_1`
	FOREIGN KEY (`act_hie_code_1`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_empacting_workstation`
       	ADD CONSTRAINT `act_hie_code_2_id_2`
	FOREIGN KEY (`act_hie_code_2`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_empacting_workstation`
       	ADD CONSTRAINT `act_hie_code_3_id_3`
	FOREIGN KEY (`act_hie_code_3`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_empacting_workstation`
       	ADD CONSTRAINT `act_hie_code_4_id_4`
	FOREIGN KEY (`act_hie_code_4`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_empacting_workstation`
       	ADD CONSTRAINT `act_hie_code_5_id_5`
	FOREIGN KEY (`act_hie_code_5`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_empacting_workstation`
       	ADD CONSTRAINT `act_hie_code_6_id_6`
	FOREIGN KEY (`act_hie_code_6`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_empacting_workstation`
       	ADD CONSTRAINT `act_hie_code_7_id_7`
	FOREIGN KEY (`act_hie_code_7`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_empacting_workstation`
       	ADD CONSTRAINT `act_hie_code_8_id_8`
	FOREIGN KEY (`act_hie_code_8`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_empacting_workstation`
       	ADD CONSTRAINT `act_hie_code_9_id_9`
	FOREIGN KEY (`act_hie_code_9`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_empacting_workstation`
       	ADD CONSTRAINT `act_hie_code_10_id_10`
	FOREIGN KEY (`act_hie_code_10`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;
ALTER TABLE `hs_hr_empacting_workstation`
       	ADD CONSTRAINT `act_hie_code_hs_hr_empacting_workstation`
	FOREIGN KEY (`act_work_satation`)
        REFERENCES `hs_hr_compstructtree`(`id`)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT ;


delete from hs_hr_sm_mnuitem where mod_id not in('MOD001','MOD002','MOD004','MOD005','MOD006','MOD010','MOD013','MOD017','MOD014','MOD016','MOD018');


UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'listCompanyStructure,ActingWorkStation' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2010;