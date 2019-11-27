delimiter //

drop procedure if exists rpt_bank_transfer_summary;
//
CREATE PROCEDURE `rpt_bank_transfer_summary`(param VARCHAR(255))
BEGIN
SET @empNumber=param;
SELECT * FROM  hs_pr_bank_transfers bt
INNER JOIN hs_hr_bank b ON b.bank_code = bt.bank_code
INNER JOIN hs_hr_branch br ON br.bbranch_code = bt.bbranch_code;

END
//
delimiter ;
