delimiter //

drop function if exists getBaseTransGross;
//
create function getBaseTransGross(detailCode int(6),fromdate datetime,todate datetime,empno int(6))  returns numeric(13,2)
begin


declare totPrevious numeric(13,8);
declare totCurrent numeric(13,8);       
declare totGross numeric(13,8);       

 declare curcrosssumPrvious cursor for                                    
 select   coalesce(sum(trn_proc_emp_amt),0)  
 from hs_pr_processedtxn e
 left join hs_pr_transaction_details d on e.trn_dtl_code=d.trn_dtl_code
 where e.trn_dtl_code in (select trn_dtl_base_code
 from hs_pr_transaction_base b
 where trn_dtl_code=detailCode and trn_base_prev_flg=1) and e.emp_number=empno and trn_startdate=fromdate and 		trn_enddate=todate;

 open curcrosssumPrvious;                                    
   fetch curcrosssumPrvious
   into  totPrevious;
   close curcrosssumPrvious; 




return totPrevious;

end;
      



//

delimiter ;

