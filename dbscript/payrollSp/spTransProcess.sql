
delimiter //

drop procedure if exists spprocesstransactions;
//
create procedure spprocesstransactions(start_date datetime,end_date datetime,empnumber varchar(6))
 
begin

   declare snatvcurrency varchar(6);  
            
   insert into hs_pr_processedtxn             
   (emp_number,trn_dtl_code,trn_startdate,trn_enddate,trn_contribution,trn_proc_emp_amt,trn_proc_eyr_amt,
   trn_proc_emp_fullamt,trn_ytd_eyr_amount)
	select 
  emp_number,trn_dtl_code,startdate,enddate,contribution,
  emp_amount,eyr_amount,
  emp_amount as trn_proc_cur_base_emp_amt,
  eyr_amount as trn_proc_cur_base_eyr_amt
   from(select
      emp_number,e.trn_dtl_code,start_date as startdate,end_date as enddate,0 as contribution,
    (case when d.trn_dtl_isprorate_flg = 1  then(prorate(empnumber,start_date,end_date,(case t.erndedcon when 1  then prorateempincrement(empnumber,start_date,end_date,e.tre_amount)
         else e.tre_amount end))) else(case t.erndedcon when 1  then prorateempincrement(empnumber,start_date,end_date,e.tre_amount)
         else e.tre_amount end)
      end)
      as emp_amount,0 as eyr_amount   
     
      from
      hs_pr_transaction_details d,  
  hs_pr_transaction_type t,
  hs_pr_txn_eligibility e
      where
      e.trn_dtl_code = d.trn_dtl_code and
      t.trn_typ_code = d.trn_typ_code and
          
      erndedcon <> 0  and
     ((e.trn_dtl_startdate <= start_date  and end_date <= e.trn_dtl_enddate)
      or  trn_typ_type = 1) and coalesce(trn_dtl_isbasetxn_flg,0) = 0 and tre_stop_flag=0 
      and  emp_number = empnumber  ) tem ;
      
	  /*
   begin
      insert into hs_pr_bank_transfers(emp_number,bank_code,bbranch_code,ebank_acc_no,ebt_start_date,ebt_end_date,ebt_amount,currency_id,cur_natve_id,ebt_cur_base_amount)
      select e.emp_number,trdprt_bank_code,trdprt_branch_code,trdprt_bank_acc_no,start_date,end_date,trdprt_bank_amount,e.currency_id,snatvcurrency,
 convertcurrency(e.currency_id,snatvcurrency,trdprt_bank_amount,start_date,end_date)
      from hs_pr_transaction_details d,hs_pr_transaction_type t,hs_pr_txn_eligibility e,hs_pr_thirdparty_account_info p,hs_hr_emp_bank b
      where e.trn_dtl_code = d.trn_dtl_code and t.trn_typ_code = d.trn_typ_code
      and ( (e.trn_dtl_startdate <= start_date  and end_date <= e.trn_dtl_enddate )
      or trn_typ_type = 1) and coalesce(trn_dtl_isbasetxn_flg,0) = 0 
      and  e.emp_number = empnumber and trn_disable_flg = 0  and tre_stop_flag = 0  and trn_dtl_is_dynamic = 0
      and trn_dtl_is_trdprty_flg = 1 and p.emp_number = e.emp_number and e.trn_dtl_code = trdprt_dtl_code and trdprt_status = 1
      and  p.trdprt_branch_code = b.bbranch_code and p.emp_number = b.emp_number and p.trdprt_bank_acc_no = b.ebank_acc_no and coalesce(trn_dtl_proc_ext_flg,0) = 0
      and coalesce(ebank_start_date,start_date) <= start_date and  coalesce(ebank_end_date,end_date) >= end_date;
   end;   
   */
end;
     
-- -----------------------------mutiple bank for third party-------------------------------------------------------------                               
   

-- </fndbuid>
//

delimiter ;

