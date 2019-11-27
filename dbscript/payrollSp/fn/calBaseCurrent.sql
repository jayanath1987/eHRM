delimiter //

drop function if exists getBaseTransGrossPrev;
//
create function getBaseTransGrossPrev(detailCode int(6),fromdate datetime,todate datetime,empno int(6))  returns numeric(13,2)
begin


declare totPrevious numeric(13,8);
declare totCurrent numeric(13,8);       
declare totGross numeric(13,8);       

declare curcrosssumCurrent cursor for
   select coalesce(sum(tre_amount),0)
   from hs_pr_txn_eligibility e
   left join hs_pr_transaction_details d on e.trn_dtl_code=d.trn_dtl_code
   where e.trn_dtl_code in (select trn_dtl_base_code
   from hs_pr_transaction_base b
   where trn_dtl_code=detailCode and trn_base_prev_flg!=1) and e.emp_number=empno;    

 
  open curcrosssumCurrent;                                    
   fetch curcrosssumCurrent
   into  totCurrent;
   close curcrosssumCurrent;  




return totCurrent;

end;
//

delimiter ;
