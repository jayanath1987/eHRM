drop procedure rpt_prl_cross_entris;
DELIMITER $$

CREATE PROCEDURE `rpt_prl_cross_entris`(param VARCHAR(255))
BEGIN
  SET @empNumber=param;
SELECT lt.ln_ty_code,lt.ln_ty_name,lt.ln_ty_name_si,lt.ln_ty_inactive_type_flg,
la.ln_app_amount,
lh.ln_hd_is_active_flg,
lh.ln_hd_settled_flg,
lh.ln_hd_bal_amount,
lh.ln_hd_amount,
ls.ln_sch_cap_amt,
ls.ln_sch_inst_amount
FROM hs_ln_type lt 
INNER JOIN hs_ln_application la ON la.ln_ty_number  = lt.ln_ty_number 
INNER JOIN hs_ln_header lh ON lh.ln_app_number = la.ln_app_number
INNER JOIN hs_ln_schedule ls ON ls.ln_app_number = la.ln_app_number
WHERE (lt.ln_ty_inactive_type_flg =1 and lh.ln_hd_is_active_flg = 1) AND (lh.ln_hd_settled_flg != 3)
GROUP BY lt.ln_ty_code
ORDER BY lt.ln_ty_code ASC;


END 
