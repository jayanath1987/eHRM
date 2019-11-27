CREATE  FUNCTION `getUser`(s CHAR(20)) RETURNS char(50) CHARSET latin1
RETURN  @user;


-- Security Module

ALTER TABLE  `hs_hr_sm_mnuitem` CHANGE  `sm_mnuitem_position`  `sm_mnuitem_position` VARCHAR( 100 ) NOT NULL


UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '01.00'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1000;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '01.01'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1001;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '01.01.01'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1002;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '01.01.02'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1003;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '01.02'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1004;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '01.02.01'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1005;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '01.02.02'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1006;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '01.02.03'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1007;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '01.02.04'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1008;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '01.03'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1009;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '01.03.01'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1010;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '01.03.02'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1011;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '01.03.03'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1012;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '01.03.04'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1013;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '01.04'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1014;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '01.04.01'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1015;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.00'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2000;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.01'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2001;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.03'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2003;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.03.01'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2004;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.03.02'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2005;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.03.04'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2006;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.03.03'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2007;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.03.05'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2008;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.04'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2009;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.04.01'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2010;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.04.02'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2011;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.04.03'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2012;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.05'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2013;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.05.01'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2014;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.05.02'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2015;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.05.03'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2016;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.05.04'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2017;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.05.05'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2018;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.05.06'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2019;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.06'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2020;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.06.01'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2021;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '02.06.02'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 2022;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '04.00'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 4000;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '04.01'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 4001;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '04.02'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 4002;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '04.03'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 4003;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '04.04'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 4004;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '04.05'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 4005;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '04.06'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 4006;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '04.07'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 4007;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '05.00'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5000;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '05.01'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5001;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '05.02'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5002;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '05.03'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5003;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '05.04'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5004;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '05.05'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5005;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '05.06'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5006;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '05.07'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5007;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '05.08'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5008;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '05.09'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5009;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '05.10'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5010;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '05.11'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5011;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '05.12'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5012;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '05.13'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5013;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '05.14'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 5014;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '13.00'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 13000;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '13.01'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 13001;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '13.02'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 13002;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '13.03'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 13003;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '13.04'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 13004;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '13.05'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 13005;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '13.06'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 13006;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '14.00'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 14000;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '01.02.05'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 15002;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '01.02.06'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 15003;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '17.00'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 17000;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '17.01'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 17001;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '17.02'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 17002;

UPDATE `live_esm`.`hs_hr_sm_mnuitem`
SET `sm_mnuitem_position` = '17.03'
WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 17003;


INSERT INTO `hr_mysql_esamurdhi`.`hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES (NULL, 'Employee Information Report', 'සේවක තොරතුරු වාර්තාව ', 'சீவக தொரதுரு வார்தவா', NULL, 'MOD002');

INSERT INTO `hr_mysql_esamurdhi`.`hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES (NULL, 'Service extension report', 'සේවය දීර්ඝ කිරීමේ  වාර්තාව ', NULL, 'Emp_service_extesion.rptdesign', 'MOD002');


INSERT INTO `hr_mysql_esamurdhi`.`hs_hr_rn_report` (`rn_rpt_id`, `rn_rpt_name`, `rn_rpt_name_si`, `rn_rpt_name_ta`, `rn_rpt_path`, `mod_id`) VALUES (NULL, 'Confirmation Report', 'ස්ථිර සේවක ලැය්ස්තුව ', NULL, 'Emp_confirmation.rptdesign', 'MOD001');