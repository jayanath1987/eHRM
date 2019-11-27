delimiter //

drop procedure if exists spDefaultTransAssign;
//
create procedure spDefaultTransAssign(empnumber varchar(6),amount numeric(13,2))

begin

 Delete e.* from hs_pr_txn_eligibility e left join hs_pr_transaction_details p on e.trn_dtl_code=p.trn_dtl_code  where emp_number=empnumber and  p.trn_dtl_isdefault_flg=1;

 insert into hs_pr_txn_eligibility             
  (emp_number,trn_dtl_code,trn_dtl_startdate,trn_dtl_enddate,tre_amount,tre_stop_flag,tre_empcon,
   tre_eyrcon,dbgroup_user_id)
	select emp_number,trn_dtl_code,NOW(),NOW(),
	(case erndedcon	when 1 then amount else 0 end) as totAmount,
	0,trn_dtl_empcont,trn_dtl_eyrcont,getuser()
	From hs_pr_employee e,hs_pr_transaction_details d,hs_pr_transaction_type t 
	where trn_dtl_isdefault_flg=1 and emp_number=empnumber and t.trn_typ_code=d.trn_typ_code;
		
  


end;


//

delimiter ;

