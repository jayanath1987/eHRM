SET NAMES 'UTF8';

-- Givantha Transfer Alters 2011-08-11

-- -------------------- Transfer Module ----------------------------------------

DROP TABLE IF EXISTS hs_hr_transfer_request;

--
-- Table structure for table `hs_hr_transfer_request`
--

CREATE TABLE IF NOT EXISTS `hs_hr_transfer_request` (
  `trans_req_id` int(6) NOT NULL AUTO_INCREMENT,
  `emp_number` int(7) DEFAULT NULL,
  `trans_req_location_pref1` varchar(75) DEFAULT NULL,
  `trans_req_location_pref2` varchar(75) DEFAULT NULL,
  `trans_req_location_pref3` varchar(75) DEFAULT NULL,
  `trans_req_admincommnet` varchar(200) DEFAULT NULL,
  `trans_req_usercommnet` varchar(200) DEFAULT NULL,
  `trans_req_adminiscomment` varchar(8) NOT NULL,
  `id` int(7) DEFAULT NULL,
  `trans_req_status` varchar(1) DEFAULT NULL,
  `def_level` int(4) DEFAULT NULL,
  `wfmain_id` int(50) DEFAULT NULL,
  `wfmain_sequence` int(50) DEFAULT NULL,
  `trans_req_isapproved` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`trans_req_id`),
  KEY `xif1hs_hr_transfer_request` (`emp_number`),
  KEY `hs_hr_transfer_request_ibfk_1` (`id`),
  KEY `hs_hr_transfer_request_ibfk_2` (`wfmain_id`),
  KEY `hs_hr_transfer_request_ibfk_3` (`def_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
--
-- Constraints for table `hs_hr_transfer_request`
--
ALTER TABLE `hs_hr_transfer_request`
  ADD CONSTRAINT `hs_hr_transfer_request_ibfk_1` FOREIGN KEY (`id`) REFERENCES `hs_hr_compstructtree` (`id`),
  ADD CONSTRAINT `hs_hr_transfer_request_ibfk_2` FOREIGN KEY (`wfmain_id`) REFERENCES `hs_hr_wf_main` (`wfmain_id`),
  ADD CONSTRAINT `hs_hr_transfer_request_ibfk_3` FOREIGN KEY (`def_level`) REFERENCES `hs_hr_company_structure_def` (`def_level`);

DELETE FROM `hs_hr_wf_approval_group` WHERE `hs_hr_wf_approval_group`.`wfappgrp_code` > 6;


-- -------------------- Transfer Approval Group Data ----------------------------------------------

INSERT INTO `hs_hr_wf_approval_group` (`wfappgrp_code`, `wfappgrp_description`, `wfappgrp_description_si`, `wfappgrp_description_ta`) VALUES
(7, 'Transfer Divisional Secretariat Office Group', 'Transfer Divisional Secretariat Office_si', 'Transfer Divisional Secretariat Office_ta'),
(8, 'Transfer Zonal Manager Group', 'Transfer Zonal Manager Group_si', 'Transfer Zonal Manager Group_ta'),
(9, 'Transfer Division Secretary Group', 'Transfer Division Secretary Group_si', 'Transfer Division Secretary Group_ta'),
(10, 'Transfer District Secretary Group', 'Transfer District Secretary Group_si', 'Transfer District Secretary Group_ta'),
(11, 'Transfer Assistant Commissioner (Deputy Samurdhi Director) Group', 'Transfer Assistant Commissioner (Deputy Samurdhi Director) Group_si', 'Transfer Assistant Commissioner (Deputy Samurdhi Director) Group_ta'),
(12, 'Transfer District Secretariat Samurdhi Office Group', 'Transfer District Secretariat Samurdhi Office Group_si', 'Transfer District Secretariat Samurdhi Office Group_ta'),
(13, 'Transfer Director General Group', 'Transfer Director General Group_si', 'Transfer Director General Group_ta'),
(14, 'Transfer Director Establishment Group', 'Transfer Director Establishment Group_si', 'Transfer Director Establishment Group_ta'),
(15, 'Transfer Head Office HR Department Group', 'Transfer HR Department Group_si', 'Transfer HR Department Group_ta'),
(16, 'Transfer Manager Group', 'Transfer Manager Group_si', 'Transfer Manager Group_ta'),
(17, 'Transfer Samurdhi Development Officer Group', 'Transfer Samurdhi Development Officer Group_si', 'Transfer Samurdhi Development Officer Group_ta'),
(18, 'Transfer Director Administration Group', 'Transfer Director Administration Group_si', 'Transfer Director Administration Group_ta');

-- -------------------- Transfer Approval Person Data ----------------------------------------------

INSERT INTO `hs_hr_wf_approval_person` (`wfapper_decription`, `wfapper_code`, `wfapper_sqlquery`, `wfapper_is_group_flg`) VALUES
('Transfer Divisional Secretariat Office ', '007', 'SELECT wf_main_app_employee AS EMP_NUMBER FROM hs_hr_wf_group_app_person  WHERE wfappgrp_code=''7'' AND wf_main_app_employee != @Emp_Number', 1),
('Transfer Zonal Manager', '008', 'SELECT wf_main_app_employee AS EMP_NUMBER FROM hs_hr_wf_group_app_person  WHERE wfappgrp_code=''8'' AND wf_main_app_employee != @Emp_Number', 1),
('Transfer Division Secretariat', '009', 'SELECT wf_main_app_employee AS EMP_NUMBER FROM hs_hr_wf_group_app_person  WHERE wfappgrp_code=''9'' AND wf_main_app_employee != @Emp_Number', 1),
('Transfer District Secretary', '010', 'SELECT wf_main_app_employee AS EMP_NUMBER FROM hs_hr_wf_group_app_person  WHERE wfappgrp_code=''10'' AND wf_main_app_employee != @Emp_Number', 1),
('Transfer Assistant Commissioner', '011', 'SELECT wf_main_app_employee AS EMP_NUMBER FROM hs_hr_wf_group_app_person  WHERE wfappgrp_code=''11'' AND wf_main_app_employee != @Emp_Number', 1),
('Transfer District Secretariat Samurdhi Office', '012', 'SELECT wf_main_app_employee AS EMP_NUMBER FROM hs_hr_wf_group_app_person  WHERE wfappgrp_code=''12'' AND wf_main_app_employee != @Emp_Number', 1),
('Transfer Director General', '013', 'SELECT wf_main_app_employee AS EMP_NUMBER FROM hs_hr_wf_group_app_person  WHERE wfappgrp_code=''13'' AND wf_main_app_employee != @Emp_Number', 1),
('Transfer Director Establishment', '014', 'SELECT wf_main_app_employee AS EMP_NUMBER FROM hs_hr_wf_group_app_person  WHERE wfappgrp_code=''14'' AND wf_main_app_employee != @Emp_Number', 1),
('Transfer Head Office HR department', '015', 'SELECT wf_main_app_employee AS EMP_NUMBER FROM hs_hr_wf_group_app_person  WHERE wfappgrp_code=''15'' AND wf_main_app_employee != @Emp_Number', 1),
('Transfer Manager', '016', 'SELECT wf_main_app_employee AS EMP_NUMBER FROM hs_hr_wf_group_app_person  WHERE wfappgrp_code=''16'' AND wf_main_app_employee != @Emp_Number', 1),
('Transfer Samurdhi Development Officer', '017', 'SELECT wf_main_app_employee AS EMP_NUMBER FROM hs_hr_wf_group_app_person  WHERE wfappgrp_code=''17'' AND wf_main_app_employee != @Emp_Number', 1),
('Transfer Director Administration', '018', 'SELECT wf_main_app_employee AS EMP_NUMBER FROM hs_hr_wf_group_app_person  WHERE wfappgrp_code=''18'' AND wf_main_app_employee != @Emp_Number', 1);

INSERT INTO `hs_hr_wf_module` (`wfmod_id`, `wfmod_name`, `wfmod_view_name`, `wfmod_approve_reject`) VALUES
('MOD010', 'Transfer', 'vw_hs_hr_wf_transfer_data', 'vw_hs_hr_wf_transfer_data');

drop view if exists   vw_hs_hr_wf_transfer_data;

CREATE VIEW vw_hs_hr_wf_transfer_data
   AS select ma.wfmain_id AS ID,wtf.wfmod_id AS `Module ID`,ma.wfmain_flow_id
   AS `APPROVAL LEVEL`,ma.wftype_code AS `WorkFlow Type Code`,ma.wfmain_approving_emp_number 
   AS `Approving_Employee`,e.emp_number AS `Employee Number`,e.emp_display_name 
   AS `Employee Name` 
   from hs_hr_td_assignlist td join vw_hs_hr_wf_main_data ma on ma.wfmain_id = td.wfmain_id 
   left join hs_hr_employee e on e.emp_number = td.emp_number 
   left join hs_hr_wf_type wtf on ma.wftype_code = wtf.wftype_code 
   left join hs_hr_module m on m.mod_id =wtf.wfmod_id  
   where ma.wfmain_iscomplete_flg = 0 and ma.wftype_code = 7 
   union all select ma.wfmain_id AS `ID`,wtf.wfmod_id AS 'Module ID',ma.wfmain_flow_id AS 'APPROVAL LEVEL',ma.wftype_code AS   'WorkFlow Type Code',ma.wfmain_approving_emp_number 
  AS 'Approving_Employee',e.emp_number AS 'Employee Number',e.emp_display_name AS 'Employee Name'
  from hs_hr_td_assignlist td join vw_hs_hr_wf_main_data ma on ma.wfmain_id = td.wfmain_id 
  left join hs_hr_employee e on e.emp_number = td.emp_number 
  left join hs_hr_wf_type wtf on ma.wftype_code = wtf.wftype_code 
  left join hs_hr_module m on m.mod_id = wtf.wfmod_id 
  where ma.wfmain_iscomplete_flg = 0 and ma.wftype_code = 5
  union all select ma.wfmain_id AS `ID`,wtf.wfmod_id AS 'Module ID',ma.wfmain_flow_id AS 'APPROVAL LEVEL',ma.wftype_code AS 'WorkFlow Type Code',ma.wfmain_approving_emp_number AS 'Approving_Employee',e.emp_number AS 'Employee Number',e.emp_display_name AS 'Employee Name' 
  from hs_hr_td_assignlist td join vw_hs_hr_wf_main_data ma on  ma.wfmain_id = td.wfmain_id 
  left join hs_hr_employee e on e.emp_number = td.emp_number 
  left join hs_hr_wf_type wtf on ma.wftype_code = wtf.wftype_code 
  left join hs_hr_module m on m.mod_id = wtf.wfmod_id  where ma.wfmain_iscomplete_flg = 0 and            ma.wftype_code = 4
  union all select ma.wfmain_id AS 'ID',wtf.wfmod_id AS 'Module ID',ma.wfmain_flow_id AS 'APPROVAL LEVEL',ma.wftype_code AS 'WorkFlow Type Code',ma.wfmain_approving_emp_number AS 'Approving_Employee',e.emp_number AS `Employee Number`,e.emp_display_name AS 'Employee Name' 
  from hs_hr_td_assignlist td join vw_hs_hr_wf_main_data ma on ma.wfmain_id = td.wfmain_id 
  left join hs_hr_employee e on e.emp_number = td.emp_number 
  left join hs_hr_wf_type wtf on ma.wftype_code = wtf.wftype_code 
  left join hs_hr_module m on m.mod_id = wtf.wfmod_id  where ma.wfmain_iscomplete_flg and  ma.wftype_code = 3;


INSERT INTO `hs_hr_wf_type` (`wftype_description`, `wftype_code`, `wftype_table_name`, `wftype_view_name`, `wfmod_id`, `wftype_update_field`, `wftype_class`, `wftype_method_name`, `wftype_redirect_url`, `wftype_canclemain_field`, `wftype_canclestatus_field`, `wftype_appmain_field`, `wftype_bulk_app_flg`, `wftype_sort_field_name`) VALUES
('Intra Wasam Transfers', 7, 'hs_hr_transfer_request', '', 'MOD010', 'trans_req_isapproved', NULL, NULL, 'transfer/SaveWorkFlowApprove', NULL, NULL, NULL, NULL, NULL),
('Transfer Division Secretary', 8, 'hs_hr_transfer_request', '', 'MOD010', 'trans_req_isapproved', NULL, NULL, 'transfer/SaveWorkFlowApprove', NULL, NULL, NULL, NULL, NULL),
('Transfer District Secretary', 9, 'hs_hr_transfer_request', '', 'MOD010', 'trans_req_isapproved', NULL, NULL, 'transfer/SaveWorkFlowApprove', NULL, NULL, NULL, NULL, NULL),
('Transfer Assistant Commissioner', 10, 'hs_hr_transfer_request', '', 'MOD010', 'trans_req_isapproved', NULL, NULL, 'transfer/SaveWorkFlowApprove', NULL, NULL, NULL, NULL, NULL),
('Transfer Director General', 11, 'hs_hr_transfer_request', '', 'MOD010', 'trans_req_isapproved', NULL, NULL, 'transfer/SaveWorkFlowApprove', NULL, NULL, NULL, NULL, NULL),
('Transfer Director Establishment', 12, 'hs_hr_transfer_request', '', 'MOD010', 'trans_req_isapproved', NULL, NULL, 'transfer/SaveWorkFlowApprove', NULL, NULL, NULL, NULL, NULL),
('Transfer HR Department', 13, 'hs_hr_transfer_request', '', 'MOD010', 'trans_req_isapproved', NULL, NULL, 'transfer/SaveWorkFlowApprove', NULL, NULL, NULL, NULL, NULL),
('Transfer Director Administration', 14, 'hs_hr_transfer_request', '', 'MOD010', 'trans_req_isapproved', NULL, NULL, 'transfer/SaveWorkFlowApprove', NULL, NULL, NULL, NULL, NULL);

-- -------------------- Transfer Workflow Appruval --------------------------------------------
INSERT INTO `hs_hr_wf_approvel` (`wftype_code`, `wfa_sequence`, `wfapper_code`, `wfapper_iscompulsory_flg`, `wfapper_lastlevel`, `wfapper_allowchange`) VALUES
(7, 1, '008', 0, 0, ''),
(7, 2, '009', 0, 1, ''),
(8, 1, '009', 0, 1, ''),
(9, 1, '010', 0, 0, ''),
(9, 2, '011', 1, 1, ''),
(10, 1, '011', 1, 1, ''),
(11, 1, '013', 1, 0, ''),
(11, 2, '014', 1, 1, ''),
(12, 1, '014', 1, 1, ''),
(13, 1, '013', 1, 0, ''),
(13, 2, '018', 1, 1, ''),
(14, 1, '018', 1, 1, '');

-- -------------------- Transfer Module Workflow View --------------------------------------------

DROP VIEW IF EXISTS vw_hs_hr_wf_transfer_data;


CREATE VIEW vw_hs_hr_wf_transfer_data AS
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 7
UNION ALL
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 8
UNION ALL
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 9
UNION ALL
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 10
UNION ALL
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 11
UNION ALL
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 12
UNION ALL
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 13
UNION ALL
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 14
UNION ALL
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Title_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 15;

INSERT INTO `hs_hr_emp_role_group` (`role_group_id`, `role_group_name`, `role_group_name_si`, `role_group_name_ta`) VALUES
(13, 'Zonal Manager', 'Zonal Manager_si', 'Zonal Manager_ta'),			
(14, ' Samurdhi Development Officer', ' Samurdhi Development Officer_si', ' Samurdhi Development Officer_ta'),
(15, ' Assistant Commissioner (Deputy Samurdhi Director)', 'Assistant Commissioner (Deputy Samurdhi Director)_si', 'Assistant Commissioner (Deputy Samurdhi Director)_ta'),
(16, ' District Secretariat ', 'District Secretariat _si', 'District Secretariat_ta'),
(17, ' Director Establishment', ' Director Establishment_si', 'Director Establishment_ta'),
(18, ' Director General', ' Director General_si', 'Director General_ta'),
(19, ' Manager', ' Manager_si', 'Manager_ta');

-- -------------------- Transfer Module Menu Data  --------------------------------------------
DELETE FROM hs_hr_sm_mnuitem where mod_id = 'MOD010';

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(10000, 'Transfer', 'මාරුවීම', 'Transfer_ta', 0, 0, '#', '10.00', 'MOD010', NULL),
(10001, 'Transfer Reason', 'මාරුවීම වර්ග', 'Trans Reason_ta', 10000, 1, './symfony/web/index.php/transfer/TransferReason', '10.01', 'MOD010', 'SaveTransferReason,DeleteTransferReason'),
(10002, 'Transfer Request Admin', 'මාරුවීම ඉල්ලීම පරිපාලන', 'Transfer Request Admin_ta', 10000, 1, './symfony/web/index.php/transfer/TransferRequestAdmin', '10.02', 'MOD010', 'TransferRequestAdmin,SaveTransferRequestAdmin,listCompanyStructure,searchEmployee'),
(10003, 'Transfers Details ', 'නව මාරුවීම', 'New Transfer_ta', 10000, 1, './symfony/web/index.php/transfer/TransferDetail', '10.03', 'MOD010', 'TransferDetail,SaveTransferDetail,AjaxCall,DateValidation,imagepop,searchEmployee,listCompanyStructure,deleteTransfer,RecordCheck'),
(10004, 'Transfer Request', 'මාරුවීම ඉල්ලීම', 'Transfer Request_ta', 10000, 1, './symfony/web/index.php/transfer/TransferRequest', '10.02', 'MOD010', 'TransferRequest,SaveTransferRequest,listCompanyStructure,searchEmployee');

ALTER TABLE `hs_hr_transfer_request` CHANGE `wfmain_id` `wfmain_id` INT( 50 ) NULL; 


UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_webpage_url` = './symfony/web/index.php/transfer/transferReason',
`sm_mnuitem_dependency` = 'UpdateTransReason,saveTransferReason,DeleteTransReason' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10001;



UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_webpage_url` = './symfony/web/index.php/transfer/transferRequest',
`sm_mnuitem_dependency` = 'UpdateTransferRequest,SaveTransferRequest,DeleteTransferRequest' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10003;


UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_webpage_url` = './symfony/web/index.php/transfer/TransferRequest',
`sm_mnuitem_dependency` = ' TransferRequest,listCompanyStructure,searchEmployee' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10005;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_webpage_url` = './symfony/web/index.php/transfer/TransferReason',
`sm_mnuitem_dependency` = 'SaveTransferReason,DeleteTransferReason' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10001;


UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_webpage_url` = './symfony/web/index.php/transfer/TransferDetail',
`sm_mnuitem_dependency` = 'TransferDetail,SaveTransferDetail,AjaxCall,DateValidation,imagepop,searchEmployee,listCompanyStructure,deleteTransfer,RecordCheck' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10002;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_webpage_url` = './symfony/web/index.php/transfer/NewTransferRequest/user/Ess' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10004;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_webpage_url` = './symfony/web/index.php/transfer/NewTransferRequestAdmin' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10003;

-- --------------------  Transfer Module Report Menu Data ------------------------------------------

INSERT INTO `hs_hr_rn_report`(`rn_rpt_id`,`rn_rpt_name`,`rn_rpt_name_si`,`rn_rpt_name_ta`,`rn_rpt_path` ,`mod_id`)
VALUES 
('null', 'Transfer Details Summary Report', 'ස්ථාන මාරුවීම් පිළිබද සාරාංශ වාර්තාව  ', 'Transfer Details Summary Report', 'Transfer_details.rptdesign', 'MOD010'),
('null', 'Transfer List Report', 'ස්ථාන මාරුවීම් ලැයිස්තුව', 'Transfer List Report', 'Transfer_details.rptdesign', 'MOD010');

UPDATE  `hs_hr_sm_mnuitem` SET  `sm_mnuitem_dependency` = 'TransferRequest,SaveTransferRequest,listCompanyStructure,searchEmployee,DeleteTransferRequestAdmin' WHERE  `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10005;


INSERT INTO `hs_hr_emp_role_group` (`role_group_id`, `role_group_name`, `role_group_name_si`, `role_group_name_ta`) VALUES (NULL, 'Zonal Manager', 'Zonal Manager', 'Zonal Manager');

INSERT INTO `hs_hr_wf_type` (`wftype_description`, `wftype_code`, `wftype_table_name`, `wftype_view_name`, `wfmod_id`, `wftype_update_field`, `wftype_class`, `wftype_method_name`, `wftype_redirect_url`, `wftype_canclemain_field`, `wftype_canclestatus_field`, `wftype_appmain_field`, `wftype_bulk_app_flg`, `wftype_sort_field_name`) VALUES ('Transfer National Level', '15', 'hs_hr_transfer_request', NULL, 'MOD010', 'trans_req_isapproved', NULL, NULL, 'transfer/SaveWorkFlowApprove', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `hs_hr_wf_approvel` (`wftype_code`, `wfa_sequence`, `wfapper_code`, `wfapper_iscompulsory_flg`, `wfapper_lastlevel`, `wfapper_allowchange`) VALUES ('15', '1', '013', '0', '1', '');

ALTER TABLE  `hs_hr_transfer_request` CHANGE  `trans_req_isapproved`  `trans_req_isapproved` INT( 1 ) NULL DEFAULT NULL;

delete from hs_hr_sm_mnuitem where mod_id='MOD010';


INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(10000, 'Transfer', 'මාරුවීම', 'Transfer_ta', 0, 0, '#', '10.00', 'MOD010', NULL),
(10001, 'Transfer Reason', 'මාරුවීම වර්ග', 'Trans Reason_ta', 10000, 1, './symfony/web/index.php/transfer/TransferReason', '10.01', 'MOD010', 'SaveTransferReason,DeleteTransferReason'),
(10002, 'Transfer Request Admin', 'මාරුවීම ඉල්ලීම පරිපාලන', 'Transfer Request Admin_ta', 10000, 1, './symfony/web/index.php/transfer/TransferRequestAdmin', '10.02', 'MOD010', 'TransferRequestAdmin,SaveTransferRequestAdmin,listCompanyStructure,searchEmployee'),
(10003, 'Transfers Details ', 'නව මාරුවීම', 'New Transfer_ta', 10000, 1, './symfony/web/index.php/transfer/TransferDetail', '10.03', 'MOD010', 'TransferDetail,SaveTransferDetail,AjaxCall,DateValidation,imagepop,searchEmployee,listCompanyStructure,DeleteTransfer,RecordCheck'),
(10005, 'Transfer Request', 'මාරුවීම ඉල්ලීම', 'Transfer Request_ta', 10000, 1, './symfony/web/index.php/transfer/TransferRequest', '10.02', 'MOD010', 'TransferRequest,SaveTransferRequest,listCompanyStructure,searchEmployee,DeleteTransferRequestAdmin');


ALTER TABLE `hs_hr_transfer` ADD `trans_prefer_div_id` INT( 6 ) NULL DEFAULT NULL; 

ALTER TABLE `hs_hr_transfer`
  ADD CONSTRAINT `hs_hr_transfer_prefer_div_id` FOREIGN KEY (`trans_prefer_div_id`) 
  REFERENCES `hs_hr_compstructtree` (`id`)	
        ON DELETE RESTRICT
	ON UPDATE RESTRICT ;

ALTER TABLE `hs_hr_transfer` CHANGE `trans_mu_name` `trans_mu_name` INT( 6 ) NULL DEFAULT NULL;


DROP VIEW IF EXISTS vw_hs_hr_wf_transfer_data;


CREATE VIEW vw_hs_hr_wf_transfer_data AS
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 7
UNION ALL
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 8
UNION ALL
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 9
UNION ALL
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 10
UNION ALL
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 11
UNION ALL
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 12
UNION ALL
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 13
UNION ALL
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 14
UNION ALL
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 15
UNION ALL
SELECT ma.wfmain_id AS ID,
       wtf.wfmod_id AS `Module ID`,
       ma.wfmain_flow_id AS `APPROVAL LEVEL`,
       ma.wftype_code AS `WorkFlow Type Code`,
       ma.wfmain_approving_emp_number AS `Approving_Employee`,
       e.emp_number AS `Employee Number`,
       e.emp_display_name AS `Employee Name_en`,
       e.emp_display_name_si AS `Employee Name_si`,
       e.emp_display_name_ta AS `Employee Name_ta`,

  (SELECT j.jobtit_name
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_en`,

  (SELECT j.jobtit_name_si
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_si`,

  (SELECT j.jobtit_name_ta
   FROM hs_hr_job_title j
   WHERE j.jobtit_code = e.job_title_code) AS `Job Title_ta`,

  (SELECT c.title
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_en`,

  (SELECT c.title_si
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_si`,

  (SELECT c.title_ta
   FROM hs_hr_compstructtree c
   WHERE c.id = e.work_station) AS `Division_ta`
FROM hs_hr_transfer_request tr
JOIN vw_hs_hr_wf_main_data ma ON ma.wfmain_id = tr.wfmain_id
LEFT JOIN hs_hr_employee e ON e.emp_number = tr.emp_number
LEFT JOIN hs_hr_wf_type wtf ON ma.wftype_code = wtf.wftype_code
LEFT JOIN hs_hr_module m ON m.mod_id =wtf.wfmod_id
WHERE ma.wfmain_iscomplete_flg = 0
  AND ma.wftype_code = 20;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'TransferDetail,SaveTransferDetail,AjaxCall,DateValidation,imagepop,searchEmployee,listCompanyStructure,DeleteTransfer,RecordCheck,Imagepop,DeleteImage' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10003;


-- UAT bug fixing 2012 -03 -26  - number 5641
SET NAMES 'UTF8';
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_si` = 'මාරුවීම්' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10000;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_si` = 'මාරුවීම් වර්ග' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10001;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_si` = 'මාරුවීම් ඉල්ලීම පරිපාලන' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10002;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_si` = 'නව මාරුවීම්' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10003;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_si` = 'මාරුවීම් ඉල්ලීම' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10005;

-- bug Fixing 
SET NAMES 'UTF8';
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_si` = 'මාරුවීම් හේතු' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =10001;