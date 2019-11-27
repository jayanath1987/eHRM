
delimiter //

drop function if exists calculatevalidmaxamount;
//
create function calculatevalidmaxamount(empno varchar(6),stxncode varchar(6), todate datetime,scurrency varchar(6),nprocamount numeric(13,2))  
returns numeric(13,2)    

begin

   

   declare nreturnamount numeric(13,2);  
   declare nprocessedamt numeric(13,2);   
   declare nperiodtype numeric(13,2); 
   declare nmaxamount numeric(13,2); 
   declare nvalidperiod numeric(2,0);
   declare no_data int default 0;
   declare curmaxvalidation cursor  for
   select coalesce(trn_dtl_payperiod_flg,0),coalesce(trn_dtl_max_amount,0) 
   from hs_pr_currency_transaction
   where trn_dtl_code = stxncode and currency_id = scurrency;
   declare continue handler for sqlexception
   begin
      set no_data = -2;
   end;
   declare continue handler for not found set no_data = -1;

   set nreturnamount  = nprocamount;  
   set nprocessedamt  = 0;  
   set nperiodtype  = 0;  
   set nmaxamount = 0;



   open  curmaxvalidation;  

   set no_data = 0;
   fetch curmaxvalidation into nperiodtype,nmaxamount;

   if nmaxamount <> 0  -- -if not defined max amount should not be validated 

	
      while (no_data = 0)  
	  
         
         begin
            if nperiodtype = 0 then     -- unlimited times  
               
               begin
                  select   coalesce(sum(trn_proc_emp_amt),0) into nprocessedamt from hs_pr_processedtxn where trn_dtl_code = stxncode and currency_id = scurrency and emp_number = empno
                  and trn_enddate < todate ;
               end;
            end if;
            
            if nperiodtype = 1  then    -- reset for tax year
				
               select   coalesce(sum(trn_proc_emp_amt),0) into nprocessedamt from hs_pr_processedtxn p,hs_pr_profile s where trn_dtl_code = stxncode and p.currency_id = scurrency and emp_number = empno
               and trn_enddate < todate
               and trn_enddate between com_tax_from and com_tax_to ;
               select   count(*) into nvalidperiod from hs_pr_profile where todate between com_tax_from and com_tax_to ;
               
               if nvalidperiod = 0  then
						
                  set nreturnamount = 0;
               end if;
            end if;
            if nperiodtype = 2 then   -- reset for calender year
				
               select   coalesce(sum(trn_proc_emp_amt),0) into nprocessedamt from hs_pr_processedtxn where trn_dtl_code = stxncode and currency_id = scurrency and emp_number = empno 
               and trn_enddate < todate
               and year(trn_enddate) =(select pay_proc_year from hs_pr_profile);
            end if;
           
           
            set no_data = 0;
            fetch curmaxvalidation into nperiodtype,nmaxamount;
         end;
      end while;
      if nprocamount >(nmaxamount -nprocessedamt)  then
			
         if(nmaxamount -nprocessedamt) < 0  then
           
            begin
               set nreturnamount = 0;
            end;
         else
            
            begin
               set nreturnamount = nmaxamount -nprocessedamt;
            end;
         end if;
      end if;
   end if;	

 
   close curmaxvalidation;  
   

   return  nreturnamount;  

end;
  

//

delimiter ;

