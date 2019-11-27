DROP PROCEDURE rpt_bank_disket;

DELIMITER $$

CREATE PROCEDURE `rpt_bank_disket`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT p.*, bd.bank_code,vw.*,
c4.title as c4title,c4.id as c4id,c4.parnt as c4parnt,c4.title_si as c4title_si,c4.title_ta as c4title_ta,c4.def_level as c4def_level,
c3.title as c3title,c3.id as c3id,c3.parnt as c3parnt,c3.title_si as c3title_si,c3.title_ta as c3title_ta,c3.def_level as c3def_level,
c2.title as c2title,c2.id as c2id,c2.parnt as c2parnt,c2.title_si as c2title_si,c2.title_ta as c2title_ta,c2.def_level as c2def_level,
pbe.*
FROM hs_pr_bank_diskette_process p
INNER JOIN hs_hr_compstructtree c4 ON p.id=c4.id 
INNER JOIN hs_hr_compstructtree c3 ON c4.parnt=c3.id 
INNER JOIN hs_hr_compstructtree c2 ON c3.parnt=c2.id 
INNER JOIN hs_pr_bank_diskette_process_employee pbe ON  pbe.bdp_id = p.bdp_id
INNER JOIN hs_pr_bank_diskette bd ON  bd.dsk_id = p.dsk_id
INNER JOIN vw_pr_bd_bankdata vw ON  vw.EmployeeNo = pbe.emp_number AND vw.BankCode = bd.bank_code
GROUP BY vw.AccountNo;

END
