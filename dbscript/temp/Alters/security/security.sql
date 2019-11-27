INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES ('13007', 'Payroll process capability ', 'පඩිපත සැකසීමේ ශක්‍යතාව', 'Payroll process capability ', '13000', '1', './symfony/web/index.php/security/PayprocessCapability', '13.07', 'MOD013', NULL);

CREATE TABLE  `hs_hr_sm_payproccapbility` (
`emp_number` INT( 7 ) NOT NULL ,
`prl_type_code` INT( 4 ) NOT NULL ,
PRIMARY KEY (  `emp_number` ,  `prl_type_code` )
) ENGINE = INNODB;


-- INSERT INTO `hs_hr_sm_capability` (`sm_capability_id`, `sm_capability_name`, `sm_capability_name_si`, `sm_capability_name_ta`, `sm_capability_enable_flag`) VALUES
-- (1, 'HR User', NULL, NULL, '1'),
-- (2, 'HR Admin', NULL, NULL, '1');


-- To Release to QA

ALTER TABLE  `hs_hr_sm_payproccapbility` ADD  `prl_disc_code` INT( 10 ) NULL AFTER  `prl_type_code`;

ALTER TABLE  `hs_hr_sm_payproccapbility` ADD  `prl_process_type` INT( 4 ) NULL AFTER  `prl_disc_code`;

ALTER TABLE `hs_hr_sm_payproccapbility`
  DROP PRIMARY KEY,
   ADD PRIMARY KEY(
     `emp_number`,
     `prl_type_code`,
     `prl_disc_code`);

INSERT INTO `hs_hr_formlock_details` (`frmlock_id`, `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`, `frmlock_form_name_si`, `frmlock_form_name_ta`) VALUES (NULL, 'MOD019', 'hs_pr_transaction_type', '1', 'Transaction Type Information (Detail View)', 'Transaction Type Information (Detail View)', 'Transaction Type Information (Detail View)');

INSERT INTO `hs_hr_formlock_details` (`frmlock_id`, `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`, `frmlock_form_name_si`, `frmlock_form_name_ta`) VALUES
(null, 'MOD019', 'hs_pr_transaction_details', 1, 'TransAction Details', 'TransAction Details', 'TransAction Details');

INSERT INTO `hs_hr_formlock_details` (`frmlock_id`, `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`, `frmlock_form_name_si`, `frmlock_form_name_ta`) VALUES (NULL, 'MOD019', 'hs_hr_sm_payproccapbility', '2', 'Payroll process capability', 'Payroll process capability', 'Payroll process capability');

-- after payroll

ALTER TABLE hs_hr_sm_payproccapbility DROP PRIMARY KEY;

ALTER TABLE  `hs_hr_sm_payproccapbility` ADD PRIMARY KEY (  `emp_number` ,  `prl_type_code` ) ;

-- to release

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(15000, 'Reports', 'වාර්තා', 'Reports_TA', 0, 0, '#', '15.00', 'MOD015', NULL),
(15001, 'View Reports', 'වාර්තා බැලීම', 'View Reports_TA', 15000, 1, './symfony/web/index.php/report/viewReportList', '15.01', 'MOD015', 'viewReportData');


-- change view with security performance
delete FROM `hs_hr_emp_level`;

ALTER TABLE `hs_hr_emp_level` ADD INDEX(`hie_code_1`);
ALTER TABLE `hs_hr_emp_level` ADD INDEX(`hie_code_3`);
ALTER TABLE `hs_hr_emp_level` ADD INDEX(`hie_code_4`);

ALTER TABLE `hs_hr_emp_level` ADD PRIMARY KEY ( `emp_number` ) ;
INSERT INTO `hs_hr_emp_level` (`emp_number`, `hie_code_1`, `hie_code_2`, `hie_code_3`, `hie_code_4`, `hie_code_5`, `hie_code_6`, `hie_code_7`, `hie_code_8`, `hie_code_9`, `hie_code_10`) select `emp_number`, `hie_code_1`, `hie_code_2`, `hie_code_3`, `hie_code_4`, `hie_code_5`, `hie_code_6`, `hie_code_7`, `hie_code_8`, `hie_code_9`, `hie_code_10` from hs_hr_employee;


CREATE  FUNCTION `getUser`() CHAR(7) DETERMINISTIC
RETURN (@empNumber);



drop view if exists  vw_hs_hr_employee;
CREATE VIEW vw_hs_hr_employee  as
select * from hs_hr_employee e where 
hie_code_1 in ( select hie_code_1 from hs_hr_emp_level L,hs_hr_users U   where L.emp_number=U.emp_number and L.emp_number=getUser() and  ( U.def_level=1 or U.def_level=4 )   )
or
 hie_code_3 in ( select hie_code_3 from hs_hr_emp_level L,hs_hr_users U   where L.emp_number=U.emp_number and L.emp_number=getUser() and  U.def_level=2   )
or
  hie_code_4 in ( select hie_code_4 from hs_hr_emp_level L,hs_hr_users U   where L.emp_number=U.emp_number and L.emp_number=getUser() and  U.def_level=3 )

;

-- Payroll process capability 2012-03-13
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_webpage_url` = './symfony/web/index.php/security/PayprocessCapabilityList' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 13007;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'PayprocessCapability' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 13007;



-- Menu Alters Givatha -----2012 -03 - 16------

SET NAMES 'UTF8';

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'நிர்வாகம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1000;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'அமைப்பு தகவல்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1001;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பொதுவான' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1002;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'நிறுவன கட்டமைப்பு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1003;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'வேலை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1004;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'சேவை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1005;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'கிரேடு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1006;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'வர்க்கம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1007;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பதவி' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1008;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'தகுதிகள்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1009;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'கல்வி' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1010;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'EB தேர்வு வரையறுத்து' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1011;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'திறன்கள்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1012;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'மொழிகள்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1013;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'Carder திட்டம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1014;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'Carder திட்டம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1015;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'அறிவிப்பு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1016;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'PIM' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2000;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பணியாளர் பட்டியல்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2001;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'தனிப்பட்ட' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2003;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'தனிப்பட்ட விவரங்கள்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2004;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'விபரங்கள்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2005;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'அவசர தொடர்பு (கள்)' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2006;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'சார்ந்தவைகளை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2007;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'புகைப்படம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2008;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'வேலை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2009;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'வேலை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2010;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'அறிக்கை வேண்டும்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2011;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'சேவை பதிவு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2012;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'தகுதிகள்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2013;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'அனுபவம் வேலை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2014;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'கல்வி' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2015;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'திறன்கள்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2016;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'மொழிகள்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2017;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'உரிமம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2018;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'EB தேர்வு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2019;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'வேறு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2020;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'இணைப்புகள்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2021;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'ஒழுங்கு நடவடிக்கை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =2022;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'ஒழுங்கு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =4000;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'ஒழுங்குமுறை அமைப்பு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =4001;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'ஒழுங்கு உட்பிரிவு வகை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =4002;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'சம்பவம் அறிக்கை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =4003;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'சம்பவம் சுருக்கம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =4004;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'நிலுவையில் விசாரணை சுருக்கம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =4005;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'மூடிய சம்பவம் சுருக்கம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =4006;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'இறுதி அதிரடி' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =4007;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'மறுநியமனம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =4008;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பயிற்சி மற்றும் அபிவிருத்தி' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =5000;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பயிற்சி நிறுவனங்கள்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =5001;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பயிற்சி வகுப்புகள்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =5002;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பயிற்சி ஒதுக்க' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =5003;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பயிற்சி பங்கேற்பு சுருக்கம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =5006;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பயிற்சி சுருக்கம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =5007;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பயிற்சி பதிவு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =5007;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = '	பயிற்சி பதிவு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =5010;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பயிற்சி பதிவு உங்கள் கருத்து' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =5011;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பயிற்சி அடைவு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =5012;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பயிற்சி திட்டம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =5013;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'என் பயிற்சி வரலாறு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =5014;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பயிற்சி Calander' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =5015;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'உயர்வு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =6000;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'உயர்வு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =6001;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'ஊக்குவிப்பு முறை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =6002;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'Probationers பட்டியல் பாருங்கள்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =6003;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'Probationers' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =6004;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = '	மற்ற நிறுவனங்கள்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =6005;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = '	பதவி உயர்வு வரலாறு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =6006;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'இடமாற்றம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10000;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பரிமாற்ற காரணம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10001;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'கோரிக்கை நிர்வாகம் பரிமாற்றம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10002;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'இடமாற்றங்கள் விவரம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10003;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'கோரிக்கை பரிமாற்றம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10005;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பாதுகாப்பு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =13000;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பயனர்கள்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =13001;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'செயல்திறன் ' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =13002;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பட்டி செயல்வல்லமை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =13003;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பணியாளர் திறன்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =13004;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'ரெக்கார்ட்ஸ்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =13005;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'அறிக்கை செயல்வல்லமை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =13006;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'சம்பள செயலாக்க திறன்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =13007;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'ESS' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =14000;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'அறிக்கைகள்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =15000;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'அறிக்கைகள் காண்க' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =15001;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'நிலை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =15002;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'வேலை பாத்திரம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =15003;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'செயல்திறன்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =16000;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'கடமை குழு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =16001;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'கடமை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =16002;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'மதிப்பீடு முறை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =16003;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'நிறுவனம் மதிப்பீடு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =16004;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'மதிப்பாய்வு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =16005;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பணியாளர் ஒதுக்க' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =16006;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'மேற்பார்வையாளர் ஒதுக்க' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =16007;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'மதிப்பீடு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =16008;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பரிமாற்ற வேலை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =17000;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'ஒப்புதல் குழுக்கள்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =17001;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'ஒப்புதல் சுருக்கம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =17002;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'குழு பொறுத்தவரை ஒதுக்க' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =17003;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'ஆட்சேர்ப்பு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18000;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'காலியிடம் வேண்டுகோள்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18001;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'காலியிடம் வேண்டுகோள் சுருக்கம் - அலுவலக' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18002;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'காலியிடம் வேண்டுகோள் சுருக்கம் - DG' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18003;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'ஒட்டுமொத்த காலியிடம் வேண்டுகோள் சுருக்கம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18004;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'காலியிடம் கோரிக்கை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18005;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'விளம்பரம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18006;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'இறுதி காலியிடம் சுருக்கம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18007;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'வேட்பாளர் நேர்காணல்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18008;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பேட்டியின் சுருக்கம் - அலுவலக' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18009;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'தேர்ந்தெடுக்கப்பட்ட வேட்பாளர் சுருக்கம் - DG ஒப்புதல்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18010;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'தேர்ந்தெடுக்கப்பட்ட வேட்பாளர் சுருக்கம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18011;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'சம்பள' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19000;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பணியாளர் சம்பளப்பட்டியல்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19001;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'நிர்வாகம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19002;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பரிவர்த்தனை அமைப்பு தகவல்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19003;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பரிவர்த்தனை விரிவாக தகவல்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19004;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'கட்டமைப்பு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19005;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பரிமாற்ற பணியாளர் பரிவர்த்தனை விவரம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19007;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பணியாளர் சம்பளம் உயர்ச்சி' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19008;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'சம்பளம் உயர்ச்சி செயல்முறை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19009;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'சம்பளம் உயர்ச்சி சுருக்கம் ரத்து' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19010;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'சம்பள செயல்முறை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19012;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'வங்கி விவரங்கள்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19013;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'வங்கி' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19014;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'கிளை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19015;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'ஊழியர் ஓட்டு தகவல்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19016;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பணியாளர் வங்கி விவரம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19017;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'வங்கி வட்டு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19018;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'வங்கி வட்டு செயல்முறை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =19019;																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'கடன்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =20000;																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																										
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'கடன் வகை' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =20001;	
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'விண்ணப்பம்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =20002;	
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'கடன் தீர்வு' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =20003;	
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'கடன் வரலாறு மற்றும் தகுதி' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =20004;	


																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				




 