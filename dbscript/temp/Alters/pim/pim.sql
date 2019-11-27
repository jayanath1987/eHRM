UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_webpage_url` = './symfony/web/index.php/pim/SaveLanguages' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2017;

ALTER TABLE  `hs_hr_employee` ADD  `emp_ispaydownload` INT( 1 ) NULL AFTER  `act_hie_code_10`;

--20120131
ALTER TABLE `hs_hr_employee`  ADD `emp_resign_date` DATE NULL DEFAULT NULL AFTER `emp_pension_no`,  ADD `emp_retirement_date` DATE NULL DEFAULT NULL AFTER `emp_resign_date`;

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

UPDATE`hs_hr_employee` SET `hs_hr_employee`.`emp_retirement_date` = (SELECT DATE_ADD(`hs_hr_employee`.`emp_birthday`, INTERVAL 55 YEAR)); 

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'personalDetail,addEmployee,personalDetails,employeeList,Delete,list,deleteEmployee,Jpagination' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2001;

-- Alters Payroll Attendace 2012-03-13
ALTER TABLE hs_hr_atn_dailyattendance DROP INDEX xif3hs_hr_atn_dailyattendance;

ALTER TABLE hs_hr_employee DROP INDEX xif3hs_hr_employee;


-- UAT bug fixing Jayanath 2012-03-14
SET NAMES 'UTF8';
UPDATE `hs_hr_religion` SET `rlg_name_si` = 'රෝමානු කතෝලික' WHERE `hs_hr_religion`.`rlg_code` = 5;

ALTER TABLE `hs_hr_employee` CHANGE `emp_personal_file_no` `emp_personal_file_no` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;




---------------UAT bug fixing ---------------

SET NAMES 'UTF8';

UPDATE `hs_hr_ethnic_race` SET `ethnic_race_desc` = 'Sri Lankan Muslim',
`ethnic_race_desc_si` = 'ශ්‍රී ලංකා මුස්ලිම් ' WHERE `hs_hr_ethnic_race`.`ethnic_race_code` = 'ETH4';

UPDATE `hs_hr_ethnic_race` SET `ethnic_race_desc` = 'Sinhalese' WHERE `hs_hr_ethnic_race`.`ethnic_race_code` = 'ETH1';

-- LDAP Audit table
CREATE TABLE `hs_hr_ldap_audit` (`ldap_adt_employeeid` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_firstname` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_firstnamesi` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_firstnameta` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_lastname` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_lastnamesi` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_lastnameta` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_designationcode` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_districtcode` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_divisioncode` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_zonecode` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_wasamcode` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_employeeactiveflag` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_departmentcode` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_email` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_cn` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_sn` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_emp_number` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_userid` VARCHAR(200) NULL DEFAULT NULL,
 `ldap_adt_datetime` VARCHAR(200) NULL DEFAULT NULL) ENGINE = InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `hs_hr_ldap_audit` CHANGE `ldap_adt_datetime` `ldap_adt_datetime` DATETIME NULL DEFAULT NULL;

ALTER TABLE `hs_hr_ldap_audit` ADD PRIMARY KEY ( `ldap_adt_emp_number` , `ldap_adt_userid` , `ldap_adt_datetime` ) ; 
