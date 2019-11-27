call spinitaliseemployeepaydetails('2011-12-01','2011-12-31',1);
call spprocesstransactions('2011-12-01','2011-12-31',1);
call spprocesstxncontributions('2011-12-01','2011-12-31',1);
call spprocessloans('2011-12-01','2011-12-31',1);

set @var="";
call spaddpayprocess('2011-12-01','2011-12-31',1,25000,25768,@var);

call spbanktransfer('2011-12-01','2011-12-31',1);






call spprocessgrosssalary('2011-11-01','2011-11-30',146);

source /home/hsenid/Desktop/payrollSp/fn/prorateempincrement.sql;

source /home/hsenid/Desktop/payrollSp/fn/sundaysbetwen.sql;
source /home/hsenid/Desktop/payrollSp/fn/satudaysbetwen.sql;
source /home/hsenid/Desktop/payrollSp/fn/porate.sql;
source /home/hsenid/Desktop/payrollSp/spTransProcess.sql;
source /home/hsenid/Desktop/payrollSp/spPayProcess.sql;
source /home/hsenid/Desktop/payrollSp/spLoanprocess.sql;
source /home/hsenid/Desktop/payrollSp/spInitalizeEmployeePayProcess.sql;
source /home/hsenid/Desktop/payrollSp/spGetNetSalary.sql;
source /home/hsenid/Desktop/payrollSp/spGetGrossSalary.sql;
source /home/hsenid/Desktop/payrollSp/spContributeProcess.sql;
source /home/hsenid/Desktop/payrollSp/spBankTransfer.sql;
source /home/hsenid/Desktop/payrollSp/spPrExceptions.sql;
source /home/hsenid/Desktop/payrollSp/spDefaultTransAssign.sql;


SELECT e.trn_dtl_code 
FROM hs_pr_txn_eligibility e
left join hs_pr_transaction_details d on e.trn_dtl_code=d.trn_dtl_code
where d.trn_dtl_isbasetxn_flg=1;


select * 
from hs_pr_transaction_base b
where trn_dtl_code=(SELECT e.trn_dtl_code 
FROM hs_pr_txn_eligibility e
left join hs_pr_transaction_details d on e.trn_dtl_code=d.trn_dtl_code
where d.trn_dtl_isbasetxn_flg=1);

select sum(tre_amount) as totamount,d.trn_dtl_code 
from hs_pr_txn_eligibility e
left join hs_pr_transaction_details d on e.trn_dtl_code=d.trn_dtl_code
where e.trn_dtl_code in (select trn_dtl_base_code 
from hs_pr_transaction_base b
where trn_dtl_code=(SELECT e.trn_dtl_code 
FROM hs_pr_txn_eligibility e
left join hs_pr_transaction_details d on e.trn_dtl_code=d.trn_dtl_code
where d.trn_dtl_isbasetxn_flg=1))
and e.emp_number=146 and e.trn_dtl_startdate='2011-11-01' and e.trn_dtl_enddate='2011-11-30' group by trn_dtl_code;


select sum(tre_amount) as totamount,d.trn_dtl_code 
from hs_pr_txn_eligibility e
left join hs_pr_transaction_details d on e.trn_dtl_code=d.trn_dtl_code
where e.trn_dtl_code in (select trn_dtl_base_code 
from hs_pr_transaction_base b
where trn_dtl_code=13)
and e.emp_number=146 and e.trn_dtl_startdate='2011-11-01' and e.trn_dtl_enddate='2011-11-30'; 



SELECT e.trn_dtl_code,d.trn_dtl_formula
                  FROM hs_pr_txn_eligibility e
                  left join hs_pr_transaction_details d on e.trn_dtl_code=d.trn_dtl_code
                   left join hs_pr_transaction_type t on d.trn_typ_code=t.trn_typ_code
                  where d.trn_dtl_isbasetxn_flg=1
                  and e.emp_number=146 and ((e.trn_dtl_startdate='2011-11-01' and e.trn_dtl_enddate='2011-11-30') or  t.trn_typ_type = '1')

 
+------------+-------------+--------------------------------------------------+
33 rows in set (0.00 sec)

mysql> 
SELECT u.user_name, e.employee_id, e.emp_display_name
FROM hs_hr_employee e
LEFT JOIN hs_hr_users u ON e.emp_number = u.emp_number
WHERE e.emp_active_hrm_flg =  '1'
LIMIT 0 , 30




[Thu Dec 01 03:57:26 2011] [error] [client 10.138.27.45] PHP Fatal error:  Allowed memory size of 31457280 bytes exhausted (tried to allocate 92161 bytes) in /var/www/hrmde/symfony/apps/orangehrm/modules/pim/templates/jobandSalSuccess.php on line 1217, referer: http://122.248.242.3/hrmde/index.php?lnc=yes
[Thu Dec 01 03:57:33 2011] [error] [client 10.138.27.45] PHP Fatal error:  Allowed memory size of 31457280 bytes exhausted (tried to allocate 92161 bytes) in /var/www/hrmde/symfony/apps/orangehrm/modules/pim/templates/jobandSalSuccess.php on line 1217, referer: http://122.248.242.3/hrmde/index.php?lnc=yes









pc118/













