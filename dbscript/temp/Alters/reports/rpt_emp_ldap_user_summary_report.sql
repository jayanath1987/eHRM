delimiter //

drop procedure if exists rpt_emp_ldap_user_summary_report;
//
CREATE PROCEDURE `rpt_emp_ldap_user_summary_report`(param VARCHAR(255))
BEGIN   
SET @empNumber=param; 
SELECT * FROM `hs_hr_ldap_audit`  
ORDER BY `hs_hr_ldap_audit`.`ldap_adt_datetime` DESC;
END
//
delimiter ;
