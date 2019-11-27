SET NAMES 'UTF8';

-- Givantha Recruitment Module Alters 2011-07-12

-- -------------------- Recruitment Module ----------------------------------------

-- -------------------- Vacancy Request Table -------------------------------------

CREATE TABLE IF NOT EXISTS `hs_hr_rec_vacancy_request` (
  `rec_vac_req_id` int(10) NOT NULL AUTO_INCREMENT,
  `emp_number` int(7) NOT NULL,
  `rec_vac_vacancy_title` varchar(100) NOT NULL,
  `rec_vac_vacancy_title_si` varchar(100) ,
  `rec_vac_vacancy_title_ta` varchar(100) ,
  `rec_vac_year` int(3) NOT NULL,
  `rec_vac_no_of_vacancies` int(7) NOT NULL,
  `rec_vac_no_of_vacancies_by_hr` int(7),
  `rec_vac_no_of_vacancies_by_dg` int(7),
  `rec_vac_is_submit` int(2) DEFAULT NULL,
  PRIMARY KEY (`rec_vac_req_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


ALTER TABLE `hs_hr_rec_vacancy_request`
ADD CONSTRAINT `hs_hr_rec_vacancy_request_ibfk_1`
FOREIGN KEY (`emp_number`)
REFERENCES `hs_hr_employee`(`emp_number`)
ON DELETE RESTRICT
ON UPDATE RESTRICT;


-- -------------------- Vacancy Requisition Table ---------------------------------

CREATE TABLE IF NOT EXISTS `hs_hr_rec_vacancy_requisition` (
  `rec_req_id` int(10) NOT NULL AUTO_INCREMENT,
  `rec_req_ref_number` varchar (15) NOT NULL,
  `rec_req_vacancy_title` varchar(100) NOT NULL,
  `rec_req_vacancy_title_si` varchar(100) DEFAULT NULL,
  `rec_req_vacancy_title_ta` varchar(100) DEFAULT NULL,
  `rec_req_year` int(3) NOT NULL,
  `cmp_stur_id` int(6) NOT NULL,
  `grade_code` int(4) NOT NULL,
  `jobtit_code` varchar(13) NOT NULL,
  `report_to` varchar(100) NOT NULL,
  `estat_code` varchar(13) NOT NULL,
  `rec_req_Recruitment_type` varchar(100) NOT NULL,
  `rec_req_qualification` varchar(300) NOT NULL,
  `rec_req_qualification_si` varchar(300),
  `rec_req_qualification_ta` varchar(300),
  `rec_req_opening_date` DATE NOT NULL,
  `rec_req_closing_date` DATE NOT NULL,
  `rec_req_requested_vacancies` int(4) NOT NULL,
  `rec_req_approved_vacancies` int(4) NOT NULL,
  PRIMARY KEY (`rec_req_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE INDEX `xif1hs_hr_rec_vacancy_requisition` ON `hs_hr_rec_vacancy_requisition`
(
       `rec_req_id`
);

ALTER TABLE  `hs_hr_rec_vacancy_requisition` ADD UNIQUE (
`rec_req_ref_number`
);

ALTER TABLE `hs_hr_rec_vacancy_requisition`
ADD CONSTRAINT `hs_hr_rec_vacancy_requisition_ibfk_1`
FOREIGN KEY(`cmp_stur_id`)
REFERENCES `hs_hr_compstructtree`(`id`)
ON DELETE RESTRICT
ON UPDATE RESTRICT;

ALTER TABLE `hs_hr_rec_vacancy_requisition`
ADD CONSTRAINT `hs_hr_rec_vacancy_requisition_ibfk_2`
FOREIGN KEY (`grade_code`)
REFERENCES `hs_hr_grade`(`grade_code`)
ON DELETE RESTRICT
ON UPDATE RESTRICT;

ALTER TABLE `hs_hr_rec_vacancy_requisition`
ADD CONSTRAINT `hs_hr_rec_vacancy_requisition_ibfk_3`
FOREIGN KEY (`jobtit_code`)
REFERENCES `hs_hr_job_title`(`jobtit_code`)
ON DELETE RESTRICT
ON UPDATE RESTRICT;

ALTER TABLE `hs_hr_rec_vacancy_requisition`
ADD CONSTRAINT `hs_hr_rec_vacancy_requisition_ibfk_4`
FOREIGN KEY (`estat_code`)
REFERENCES `hs_hr_empstat`(`estat_code`)
ON DELETE RESTRICT
ON UPDATE RESTRICT;

-- -------------------- Advertisement Table -----------------------------------

CREATE TABLE IF NOT EXISTS `hs_hr_rec_advertisement` (
  `rec_adv_id` int(7) NOT NULL AUTO_INCREMENT,
  `rec_req_id` int(10) NOT NULL,
  `rec_adv_desc` varchar(400) NOT NULL,
  `rec_adv_desc_si` varchar(400) DEFAULT NULL,
  `rec_adv_desc_ta` varchar(400) DEFAULT NULL,
  `rec_adv_opening_date` DATE NOT NULL,
  `rec_adv_closing_date` DATE NOT NULL, 
  PRIMARY KEY (`rec_adv_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


ALTER TABLE `hs_hr_rec_advertisement`
ADD CONSTRAINT `hs_hr_rec_rec_advertisement_ibfk`
FOREIGN KEY (`rec_req_id`)
REFERENCES `hs_hr_rec_vacancy_requisition`(`rec_req_id`)
ON DELETE RESTRICT
ON UPDATE RESTRICT;

CREATE INDEX `xif1hs_hr_rec_advertisement` ON `hs_hr_rec_advertisement`
(
       `rec_adv_id`
);

-- -------------------- Advertisement Attachment Table -----------------------------------

CREATE TABLE `hs_hr_rec_adv_attachment`  ( 
	`rec_adv_attach_id`        	int(20) NOT NULL AUTO_INCREMENT,
	`rec_adv_attach_filename`  	varchar(200) NULL,
	`rec_adv_attach_size`      	varchar(11) NULL,
	`rec_adv_attach_attachment`	mediumblob NULL,
	`rec_adv_attach_type`      	varchar(50) NULL,
	`rec_adv_id`               	int(4) NOT NULL,
	PRIMARY KEY(`rec_adv_attach_id`,`rec_adv_id`)
)engine=innodb default charset=utf8;

    ALTER TABLE `hs_hr_rec_adv_attachment`
    ADD CONSTRAINT `hs_hr_rec_adv_attachment_ibfk`
    FOREIGN KEY (`rec_adv_id`)
    REFERENCES `hs_hr_rec_advertisement`(`rec_adv_id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT ;

-- -------------------- Candidate Table -------------------------------------------------

CREATE TABLE `hs_hr_rec_candidate`  (
    `rec_can_id` int(7) NOT NULL AUTO_INCREMENT,
    `rec_req_id` int(10) NOT NULL,
    `rec_can_reference_no` int(7) NOT NULL,
    `rec_can_nic_number` int(10) NOT NULL,
    `rec_can_candidate_name` varchar(100) NOT NULL,
    `rec_can_tel_number` varchar(20) NOT NULL,
    `rec_can_address` varchar(100) NOT NULL,
    `gender_code` int(2) NOT NULL,
    `rec_can_birthday` date NOT NULL,
    `rec_can_edu_qualification` varchar(200) NOT NULL,
    `rec_can_work_experiences`  varchar(200) NOT NULL,   
    `lang_code`  varchar(13) NOT NULL,
    `rec_can_interview_marks` varchar(5) NOT NULL,
    `rec_can_interview_status`  int(2) DEFAULT NULL,
    `rec_can_interview_status_hr`  int(2) DEFAULT NULL,
    `rec_can_interview_status_dg`  int(2) DEFAULT NULL,
     PRIMARY KEY(`rec_can_id`)
)engine=innodb default charset=utf8;

ALTER TABLE `hs_hr_rec_candidate`
ADD CONSTRAINT `hs_hr_rec_candidate_ibfk_1`
FOREIGN KEY (`gender_code`)
REFERENCES `hs_hr_gender`(`gender_code`)
ON DELETE RESTRICT
ON UPDATE RESTRICT;

ALTER TABLE `hs_hr_rec_candidate`
ADD CONSTRAINT `hs_hr_rec_candidate_ibfk_2`
FOREIGN KEY(`lang_code`)
REFERENCES `hs_hr_language`(`lang_code`)
ON DELETE RESTRICT
ON UPDATE RESTRICT;

ALTER TABLE  `hs_hr_rec_candidate` ADD UNIQUE (
`rec_can_reference_no`
);
ALTER TABLE  `hs_hr_rec_candidate` ADD UNIQUE (
`rec_can_nic_number`
);

-- -------------------- Candidate Attachment Table --------------------------------------

CREATE TABLE `hs_hr_rec_cv_attachment`  ( 
	`rec_cv_attach_id`        	int(20) NOT NULL AUTO_INCREMENT,
	`rec_cv_attach_filename`  	varchar(200) NULL,
	`rec_cv_attach_size`      	varchar(11) NULL,
	`rec_cv_attach_attachment`	mediumblob NULL,
	`rec_cv_attach_type`      	varchar(50) NULL,
	`rec_can_id`               	int(4) NOT NULL,
	PRIMARY KEY(`rec_cv_attach_id`,`rec_can_id`)
)engine=innodb default charset=utf8;


ALTER TABLE `hs_hr_rec_cv_attachment`
ADD CONSTRAINT `hs_hr_rec_cv_attachment_ibfk`
FOREIGN KEY (`rec_can_id`)
REFERENCES `hs_hr_rec_candidate`(`rec_can_id`)
ON DELETE RESTRICT
ON UPDATE RESTRICT ;

CREATE INDEX `xif1hs_hr_rec_cv_attachment` ON `hs_hr_rec_cv_attachment`
(
       `rec_cv_attach_id`
);

-- -------------------- Recruitment Menu Data ------------------------------------------

INSERT INTO `hs_hr_module` (`mod_id`, `name`, `module_name_si`, `module_name_ta`, `owner`, `owner_email`, `version`, `description`, `module_display_order`) VALUES
('MOD018', 'Recruitment', ' අලුතෙන් බඳවා ගැනීම් ','Recruitment ta', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `hs_hr_sm_mnuitem` (`sm_mnuitem_id`, `sm_mnuitem_name`, `sm_mnuitem_name_si`, `sm_mnuitem_name_ta`, `sm_mnuitem_parent`, `sm_mnuitem_level`, `sm_mnuitem_webpage_url`, `sm_mnuitem_position`, `mod_id`, `sm_mnuitem_dependency`) VALUES
(18000, 'Recruitment', 'අලුතෙන් බඳවා ගැනීම්', 'Recruitment_TA', 0, 0, '#', '16.00', 'MOD018', NULL),

(18001, 'Define Vacancy Request', 'පුරප්පාඩු ඉල්ලුම් කිරීමේ සාරාංශය', 'Request Summary - HR_TA', 18000, 1, './symfony/web/index.php/recruitment/VacancyRequest', '18.01', 'MOD018', 'SaveVacancyRequest,DeleteVacancyRequest,UpdateVacancyRequest,UpdateVacancyRequestStatus'),

(18002, 'Vacancy Request Summary - HR', 'පුරප්පාඩු ඉල්ලුම් කිරීමේ සාරාංශය - මානව සම්පත්', 'Request Summary - HR_TA', 18000, 1, './symfony/web/index.php/recruitment/HRVacancyRequest', '18.02', 'MOD018', 'UpdateHRVacancyRequest,ajaxTableLockCandidate,UpdateHRInterviewRequest,SubmitHRVacancyRequest'),

(18003, 'Vacancy Request Summary - DG', 'පුරප්පාඩු ඉල්ලුම් කිරීමේ සාරාංශය - අධ්‍යක්ෂ ජනරාල්', 'Request Summary - DG_TA', 18000, 1, './symfony/web/index.php/recruitment/DGVacancyRequest', '18.03', 'MOD018', 'SubmitDGVacancyRequest,ajaxTableLockCandidate,UpdateDGVacancyRequest'),

(18004, 'Overall Vacancy Request Summary', 'පුරප්පාඩු ඉල්ලුම් කිරීමේ සමස්ත සාරාංශය', 'Overall Request Summary_TA', 18000, 1, './symfony/web/index.php/recruitment/OverallVacancyRequest', '18.04', 'MOD018', 'UpdateOverallVacancyRequest,OverallVacancyRequest,SubmitOverallVacancyRequest'),

(18005, 'Define Vacancy Requisition', 'පුරප්පාඩු නිර්වචන සාරාංශය', 'Define Vacancy Requisition_TA', 18000, 1, './symfony/web/index.php/recruitment/VacancyRequisition', '18.05', 'MOD018', 'SaveVacancyRequisition,DeleteVacancyRequisition'),

(18006, 'Define Advertisement', 'දැන්වීම නිර්වචනය', 'Define Advertisement_TA', 18000, 1, './symfony/web/index.php/recruitment/Advertisement', '18.06', 'MOD018', 'SaveAdvertisement,DeleteAdvertisement'),

(18007, 'Finalized Vacancy Summary', 'අවසන්වූ දැන්වීම සාරාංශය', 'Finalized Vacancy Summary_TA', 18000, 1, './symfony/web/index.php/recruitment/FinalizedVacancy', '18.07', 'MOD018', 'Candidate,SaveCandidate,DeleteCandidate'),

(18008, 'Define Candidate Interview ', 'සම්මුඛ පරීක්ෂණ සාරාංශය', 'Define Candidate Interview_TA', 18000, 1, './symfony/web/index.php/recruitment/CandidateInterview', '18.08', 'MOD018', 'SaveCandidateInterview,DeleteCandidateInterview,UpdateCandidateInterview'),

(18009, 'Interview Summary – HR', 'සම්මුඛ පරීක්ෂණ සාරාංශය - මානව සම්පත්', 'Interview Summary – HR_TA', 18000, 1, './symfony/web/index.php/recruitment/HRCandidateInterview', '18.09', 'MOD018', 'SaveCandidateInterview,DeleteCandidate,UpdateCandidateInterview'),

(18010,  'Selected Candidate Summary – Approved by DG ',  'සම්මුඛ පරීක්ෂණ සාරාංශය - අධ්‍යක්ෂ ජනරාල්',  'Selected Candidate Summary – Approved by DG ',  '18000',  '1', './symfony/web/index.php/recruitment/DGCandidateInterview',  '18.10',  'MOD018',  'SaveCandidateInterview,DeleteCandidate,UpdateCandidateInterview,ajaxTableLockCandidate,UpdateDGCandidateRequest'),

(18011,'Selected Candidate Summary',  'තෝරාගත් ඉල්ලුම්කාරුවන් සාරාංශය',  'Selected Candi date Summary_TA ',  '18000',  '1', './symfony/web/index.php/recruitment/CandidatePIMRegistation',  '18.11',  'MOD018',  'CandidatePIMRegistation');

-- -------------------- Recruitment Report Data ------------------------------------------

INSERT INTO `hs_hr_rn_report`(`rn_rpt_id`,`rn_rpt_name`,`rn_rpt_name_si`,`rn_rpt_name_ta`,`rn_rpt_path` ,`mod_id`)
VALUES 
('29', 'Individual Candidate Interview Summary Report', 'ඉල්ලුම්කරුවන් ගේ පුද්ගලික සම්මුඛ පරීක්ෂණ සාරාංශ වාර්තාව ', 'Individual Candidate Interview Summary Report', 'Individual_Candidate_Interview_Report.rptdesign', 'MOD018'),
('30', 'Candidate Finalization Summary Report', 'සම්මුඛ පරීක්ෂණ අවසන් කල ඉල්ලුම්කරුවන් ගේ සාරාංශ වාර්තාව', 'Candidate Finalization Summary Report', 'Candidate_Finalization_Report.rptdesign', 'MOD018'),
('31', 'Approved Vacancy Count Summary Report', 'අනුමත කල අබර්තු ගණනයන්ගේ සාරාංශ වාර්තාව', 'Approved Vacancy Count Summary Report', 'Approved_Vacancy_Count_Report.rptdesign', 'MOD018'),
('32', 'Employees Who Have Taken Appointments for a Given Period Summary Report', 'කාල සීමාව අනුව පත්වීම ලැබූ සේවක සාරාංශ වාර්තාව', 'Employees Who Have Taken Appointments for a Given Period Report', 'Employees_Appointments_Summary.rptdesign', 'MOD018'),
('32', 'Short Listed Candidate Summary Report', 'ඉල්ලුම්කරුවන්ගේ  සාරාංශ වාර්තාව', 'Short Listed Candidate Summary Report', 'Short_Listed_Candidate_Report.rptdesign', 'MOD018');

-- -------------------- Recruitment Form Lock -------------------------------------------
-- bugsfixed release
ALTER TABLE `hs_hr_rec_cv_attachment` CHANGE `rec_cv_attach_type` `rec_cv_attach_type` VARCHAR( 1000 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'UpdateHRVacancyRequest,ajaxTableLockCandidate,UpdateHRInterviewRequest,SubmitHRVacancyRequest,ajaxTableLock' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18002;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_dependency` = 'SaveCandidateInterview,DeleteCandidate,UpdateCandidateInterview,ajaxTableLockCandidate,UpdateDGCandidateRequest,UpdateDGInterviewRequest' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18010;

ALTER TABLE `hs_hr_rec_cv_attachment` CHANGE `rec_cv_attach_type` `rec_cv_attach_type` VARCHAR( 1000 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL; 


INSERT INTO `hs_hr_formlock_details` ( `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`) VALUES ( 'MOD018', ' hs_hr_rec_vacancy_request', '1', 'Vacancy Request');
INSERT INTO `hs_hr_formlock_details` ( `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`) VALUES ('MOD018', ' hs_hr_rec_vacancy_requisition', '1', 'Vacancy Requisition');
INSERT INTO `hs_hr_formlock_details` ( `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`) VALUES ( 'MOD018', ' hs_hr_rec_candidate', '1', 'Candidate');
INSERT INTO `hs_hr_formlock_details` ( `mod_id`, `con_table_name`, `con_activity_id`, `frmlock_form_name`) VALUES ('MOD018', ' hs_hr_rec_advertisement', '1', 'Advertisement');

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Vacancy Request' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 18001; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Vacancy Requisition' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 18005; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Advertisement' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 18006; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Candidate Interview ' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 18008;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_parent` = '18000', `sm_mnuitem_position` = '18.01', `mod_id` = 'MOD018 ' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1014; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_position` = '18.01.01', `mod_id` = 'MOD018' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1015;
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_position` = '18.02' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18001;

ALTER TABLE `hs_hr_rec_adv_attachment` CHANGE `rec_adv_attach_type` `rec_adv_attach_type` VARCHAR( 1000 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL; 

ALTER TABLE `hs_hr_rec_candidate` CHANGE `rec_can_nic_number` `rec_can_nic_number` VARCHAR( 10 ) NULL;

SET NAMES 'UTF8';
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Carder Plan' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1014; 
UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_position` = '18.02' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18001;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_webpage_url` = './symfony/web/index.php/recruitment/VacancyRequestWork' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 18001;


-- UAT Bug fixing 

DELETE FROM `hs_hr_sm_mnucapability` WHERE `hs_hr_sm_mnucapability`.`sm_capability_id` =1 AND `hs_hr_sm_mnucapability`.`sm_mnuitem_id` =1014;

DELETE FROM `hs_hr_sm_mnucapability` WHERE `hs_hr_sm_mnucapability`.`sm_capability_id` =1 AND `hs_hr_sm_mnucapability`.`sm_mnuitem_id` =1015;

DELETE FROM `hs_hr_sm_mnucapability` WHERE `hs_hr_sm_mnucapability`.`sm_capability_id` =2 AND `hs_hr_sm_mnucapability`.`sm_mnuitem_id` =1014;

DELETE FROM `hs_hr_sm_mnucapability` WHERE `hs_hr_sm_mnucapability`.`sm_capability_id` =2 AND `hs_hr_sm_mnucapability`.`sm_mnuitem_id` =1015;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_position` = '18.01' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1015;

DELETE FROM `hs_hr_sm_mnucapability` WHERE `sm_capability_id` = 53;

DELETE FROM `hs_hr_sm_mnuitem` WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` = 1014

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_webpage_url` = './symfony/web/index.php/admin/carderPlan',
`mod_id` = '',
`sm_mnuitem_dependency` = 'listCompanyStructure' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1014 


UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_parent` = '18000' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1015;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_level` = '1' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =1015;



-- UAT bug Fixing -----------
SET NAMES 'UTF8';

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Vacancies',
`sm_mnuitem_name_si` = 'පුරප්පාඩු ' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18001;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'வகான்சீஸ்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18001;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Vacancies - Admin',
`sm_mnuitem_name_si` = 'පුරප්පාඩු - පාලන ' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18002;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'வகான்சீஸ் - அலுவலக' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18002;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = ' Vacancies - DG',
`sm_mnuitem_name_si` = 'පුරප්පාඩු - අධ්‍යක්ෂ ජනරාල් ',
`sm_mnuitem_name_ta` = 'வகான்சீஸ் - DG' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18003;


UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Vacancies - Summary',
`sm_mnuitem_name_si` = 'පුරප්පාඩු සාරාංශය ',
`sm_mnuitem_name_ta` = 'வகான்சீஸ் - சும்மேரி ' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18004;


-- UAT Bug fixing 5705

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Applicants Summary',
`sm_mnuitem_name_si` = 'අයදුම්කරුවන්ගේ සාරාංශය ' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18007;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'அப்ப்ளிகான்த்ஸ் சும்மேரி ' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18007;


-- UAT Bug fixing 5710

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Interview Summary - DG' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18010;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name` = 'Interview Summary – Admin',
`sm_mnuitem_name_si` = 'සම්මුඛ පරීක්ෂණ සාරාංශය - පාලන' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18009;

UPDATE `hs_hr_sm_mnuitem` SET `sm_mnuitem_name_ta` = 'பேட்டியின் சுருக்கம் - அட்மின்' WHERE `hs_hr_sm_mnuitem`.`sm_mnuitem_id` =18009;