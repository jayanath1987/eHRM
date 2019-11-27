
delimiter //

drop procedure if exists spprocesstxncontributions;
//
create  procedure spprocesstxncontributions(start_date datetime,        
end_date datetime,        
empnumber varchar(6))

begin

   
declare snatvcurrency varchar(6);


-- -------- process contributions        
   
   insert into
   hs_pr_processedtxn(emp_number,trn_dtl_code,
			trn_startdate,trn_enddate,trn_contribution,trn_proc_emp_amt,trn_proc_eyr_amt,
			trn_proc_emp_fullamt)
   select a.* ,emp_amount
           
   from(select
      emp_number,e.trn_dtl_code,start_date as pay_startdate,end_date as pay_enddate,
		  case when sum(contribution) > 0 then sum(contribution) else 0 -- check minus value and if is it put 0    
      end as contribution,(case  when  sum(contribution*tre_empcon/100) > 0  then
         sum(contribution*tre_empcon/100)
      else 0
      end) as emp_amount,
		  case 
      when sum((contribution*tre_eyrcon/100)) > 0  then
         sum((contribution*tre_eyrcon/100))
      else 0
      end as eyr_amount
		  
      from
      hs_pr_txn_eligibility e,
          hs_pr_transaction_details d,
		  
      	  (select
         trn_dtl_base_code,b.trn_dtl_code,contribution
					
         from(select
            trn_dtl_base_code,a.trn_dtl_code,sum(trn_proc_emp_amt) as contribution
            from(select      trn_dtl_base_code,c.trn_dtl_code,
               case erndedcon
               when 1 then trn_proc_emp_amt*1
               when 2 then trn_proc_emp_amt*1
               when 0 then trn_proc_emp_amt*1
               when -1 then trn_proc_emp_amt*-1
               when 8 then trn_proc_emp_amt*-1
               end as trn_proc_emp_amt
               from
               hs_pr_transaction_type t,hs_pr_transaction_details d,hs_pr_processedtxn p,hs_pr_contribution_base c
               where
               t.trn_typ_code = d.trn_typ_code and
               d.trn_dtl_code = p.trn_dtl_code and
               
               p.trn_dtl_code = c.trn_dtl_base_code and p.trn_startdate  = start_date and
               p.trn_enddate = end_date and p.emp_number = empnumber group by trn_dtl_code) a
            group by trn_dtl_code)b )c
         
      where
      e.trn_dtl_code = c.trn_dtl_code and e.emp_number = empnumber   and
      e.trn_dtl_code = d.trn_dtl_code and trn_disable_flg = 0  and       
      d.trn_dtl_code = c.trn_dtl_code  and 
       coalesce(d.trn_dtl_isbasetxn_flg,0) = 0
      
      group by
      emp_number,e.trn_dtl_code,e.trn_dtl_startdate ) a;
      

      
end;


//

delimiter ;


drop procedure if exists spprocesstxncontributions;
//
CREATE PROCEDURE `spprocesstxncontributions`(start_date datetime,        
end_date datetime,        
empnumber varchar(6))
begin

 
declare snatvcurrency varchar(6);


-- -------- process contributions        
 
  insert into
  hs_pr_processedtxn(emp_number,trn_dtl_code,
           trn_startdate,trn_enddate,trn_contribution,trn_proc_emp_amt,trn_proc_eyr_amt,
           trn_proc_emp_fullamt)
  select a.* ,emp_amount
         
  from(select
     emp_number,e.trn_dtl_code,start_date as pay_startdate,end_date as pay_enddate,
         case when sum(contribution) > 0 then sum(contribution) else 0 -- check minus value and if is it put 0    
     end as contribution,(case  when  sum(contribution*tre_empcon/100) > 0  then
        sum(contribution*tre_empcon/100)
     else 0
     end) as emp_amount,
         case
     when sum((contribution*tre_eyrcon/100)) > 0  then
        sum((contribution*tre_eyrcon/100))
     else 0
     end as eyr_amount
         
     from
     hs_pr_txn_eligibility e,
         hs_pr_transaction_details d,
         
           (select
        trn_dtl_base_code,b.trn_dtl_code,contribution
                   
        from(select
           trn_dtl_base_code,a.trn_dtl_code,sum(trn_proc_emp_amt) as contribution
           from(select      trn_dtl_base_code,c.trn_dtl_code,
              case erndedcon
              when 1 then trn_proc_emp_amt*1
              when 2 then trn_proc_emp_amt*1
              when 0 then trn_proc_emp_amt*1
              when -1 then trn_proc_emp_amt*-1
              when 8 then trn_proc_emp_amt*-1
              end as trn_proc_emp_amt
              from
              hs_pr_transaction_type t,hs_pr_transaction_details d,hs_pr_processedtxn p,hs_pr_contribution_base c
              where
              t.trn_typ_code = d.trn_typ_code and
              d.trn_dtl_code = p.trn_dtl_code and
             
              p.trn_dtl_code = c.trn_dtl_base_code and p.trn_startdate  = start_date and
              p.trn_enddate = end_date and p.emp_number = empnumber ) a
           group by trn_dtl_code)b )c
       
     where
     e.trn_dtl_code = c.trn_dtl_code and e.emp_number = empnumber   and
     e.trn_dtl_code = d.trn_dtl_code and trn_disable_flg = 0  and      
     d.trn_dtl_code = c.trn_dtl_code  and
      coalesce(d.trn_dtl_isbasetxn_flg,0) = 0
     
     group by
     emp_number,e.trn_dtl_code,e.trn_dtl_startdate ) a;
     

     
end


//

delimiter ;
