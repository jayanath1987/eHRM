SET NAMES 'UTF8';

update  `hs_hr_wf_approvel` set wfapper_iscompulsory_flg=1;


INSERT INTO `hs_hr_wf_type` (`wftype_description`, `wftype_code`, `wftype_table_name`, `wftype_view_name`, `wfmod_id`, `wftype_update_field`, `wftype_class`, `wftype_method_name`, `wftype_redirect_url`, `wftype_canclemain_field`, `wftype_canclestatus_field`, `wftype_appmain_field`, `wftype_bulk_app_flg`, `wftype_sort_field_name`) VALUES ('Transfer Wasam district', '20', 'hs_hr_transfer_request', NULL, 'MOD010', 'trans_req_isapproved', NULL, NULL, 'transfer/SaveWorkFlowApprove', NULL, NULL, NULL, NULL, NULL);



INSERT INTO `hs_hr_wf_approvel` (`wftype_code`, `wfa_sequence`, `wfapper_code`, `wfapper_iscompulsory_flg`, `wfapper_lastlevel`, `wfapper_allowchange`) VALUES
(20, 1, '008', 1, 0, ''),
(20, 2, '009', 1, 0, ''),
(20, 3, '013', 1, 0, ''),
(20, 4, '014', 1, 1, '');

-- UAT bug Fixing 5780

ALTER TABLE `hs_hr_wf_module` ADD `wfmod_name_si` VARCHAR( 100 ) NOT NULL AFTER `wfmod_name`; 

ALTER TABLE `hs_hr_wf_module` ADD `wfmod_name_ta` VARCHAR( 100 ) NOT NULL AFTER `wfmod_name_si`; 

ALTER TABLE `hs_hr_wf_module` CHANGE `wfmod_name_si` `wfmod_name_si` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE `wfmod_name_ta` `wfmod_name_ta` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

SET NAMES 'UTF8';

UPDATE `hs_hr_wf_module` SET `wfmod_name_si` = 'පුහුණුව හා සංවර්ධනය',
`wfmod_name_ta` = 'ட்ரைனிங் ' WHERE `hs_hr_wf_module`.`wfmod_id` = 'MOD005';

SET NAMES 'UTF8';

UPDATE  `hs_hr_wf_module` SET `wfmod_name_si` = 'මාරුවීම්',
`wfmod_name_ta` = 'ற்றன்ச்பிர் ' WHERE `hs_hr_wf_module`.`wfmod_id` = 'MOD010';


drop view if exists   vw_hs_hr_wf_main_data;
CREATE VIEW 
    vw_hs_hr_wf_main_data
    AS select 
          mo.wfmod_id, mo.wfmod_name,mo.wfmod_name_si,mo.wfmod_name_ta, mo.wfmod_view_name, ty.wftype_code,ma.wfmain_iscomplete_flg,
          ty.wftype_description, ty.wftype_table_name, ty.wftype_view_name,
          ma.wfmain_id,ma.wfmain_sequence, 
		CASE
             WHEN ap.wf_main_app_employee IS NULL
                THEN ma.wfmain_approving_emp_number
             ELSE ap.wf_main_app_employee
        END  AS wfmain_approving_emp_number,
		ma.wfmain_flow_id, ty.wftype_update_field, ty.wftype_class,
          ty.wftype_method_name, ma.wfmain_previous_id,
          ma.wfmain_application_date,
          ty.wftype_appmain_field,
          ty.wftype_bulk_app_flg, ty.wftype_sort_field_name
		 FROM hs_hr_wf_module mo INNER JOIN hs_hr_wf_type ty
          ON mo.wfmod_id = ty.wfmod_id
          INNER JOIN hs_hr_wf_main ma ON ty.wftype_code = ma.wftype_code
          LEFT JOIN hs_hr_wf_main_app_person ap
          ON ma.wfmain_id = ap.wfmain_id
        AND ma.wfmain_sequence = ap.wfmain_sequence
    WHERE (ma.wfmain_iscomplete_flg = 0);

drop view if exists  vw_hs_hr_wf_transfer_data;

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

