SET NAMES 'UTF8';

-- training

ALTER TABLE `hs_hr_td_tarining_plan` DROP `td_plan_training_name`, DROP `td_plan_training_name_si`, DROP `td_plan_training_name_ta`;

ALTER TABLE `hs_hr_td_tarining_plan`  ADD `td_course_id` INT(6) NULL DEFAULT NULL AFTER `td_inst_id`;


-- admin



INSERT INTO `hs_hr_empstat` (`estat_code`, `estat_name`, `estat_name_si`, `estat_name_ta`) VALUES
('EST007', 'Probation', 'පරිවාසය', 'நசறஙநச'),
('EST008', 'Contract', 'කොන්තරාත්', 'றநஙச'),
('EST009', 'Expatriate', 'ප්‍රවාසික', NULL),
('EST010', 'Outsourced', 'පිටත', NULL),
('EST011', 'Others', 'වෙනත්', NULL);

UPDATE `hs_hr_compstructtree` SET `parnt` = '12733185' WHERE `hs_hr_compstructtree`.`id` = 10554;
UPDATE `hs_hr_compstructtree` SET `parnt` = '12733185' WHERE `hs_hr_compstructtree`.`id` =10555;
UPDATE `hs_hr_compstructtree` SET `parnt` = '12733185' WHERE `hs_hr_compstructtree`.`id` =10556;
UPDATE `hs_hr_compstructtree` SET `parnt` = '12733204' WHERE `hs_hr_compstructtree`.`id` =10557;
