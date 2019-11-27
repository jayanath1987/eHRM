
delimiter //

drop procedure if exists spbanktransfer;
//
create procedure spbanktransfer(start_date datetime,                                      
end_date datetime,                                      
empnumber varchar(6))                                                                                               

begin
   
   declare snatvcurrency varchar(6);    
   declare sempnatvcurrency varchar(6);    
   declare brnchcode varchar(6);    
   declare bnkcode varchar(6);    
   declare baccnumber varchar(80);    
   declare bacccurrcode varchar(6);    
   declare strncurrency varchar(6);    
    
   declare roundby numeric;                               
   declare roundtype numeric;     
   declare ipaymode numeric;    
   declare nismultinet numeric;    
   declare intstatus numeric;    
   declare inatorder numeric;    
   declare ncash_bkt numeric(13,2);    
   declare nmain_bkt numeric(13,2);    
   declare nbanktrans_bkt numeric(13,2);    
   declare nbankamount numeric(13,2);    
   declare nnatamt numeric(13,2);    
   declare ntransfering numeric(13,2);    
   declare ntotbnktrans numeric(13,2);    
   declare nbasecurrencynetsum numeric(13,2);    
   declare ncfamt numeric(13,2);    
   declare ntemppaidsal numeric(13,2);    
   declare npaidsalary numeric(13,2);    
   declare ntempcfamt numeric(13,2);    
   declare cashamount numeric(13,2);    
   declare ncftotal numeric(13,2);    
   declare nnetpay numeric(13,2);   
   declare nbasenetpay numeric(13,2);   
   declare ntempnetpay numeric(13,2);    
   declare ntempbasenetpay numeric(13,2); 
   declare nbasecfamt numeric(13,2); 
    
   declare no_data int default 0;
   
    
   declare curnetsal cursor for    
   select  pay_netpay    
   from    hs_pr_payprocess     
   where   pay_startdate = start_date and       
   pay_enddate = end_date  and     
   emp_number = empnumber;

   declare curempbankdetail cursor for                             
   select     
   eb.bbranch_code,  b.bank_code,eb.ebank_acc_no,    
                ifnull(eb.ebank_amount,0) as ebank_amount

   from                    
   hs_hr_emp_bank eb,hs_hr_bank b,hs_hr_branch  br,hs_pr_payprocess p                
   where                      
   b.bank_code = br.bank_code and                 
   br.bbranch_code = eb.bbranch_code and                   
   ebank_active_flag = 1 and    
   p.emp_number = eb.emp_number and      
   eb.emp_number = empnumber and           
   coalesce(eb.ebank_start_date,start_date) <= start_date and      
   coalesce(eb.ebank_end_date,end_date) >= end_date    
   and    
   p.pay_startdate = start_date and p.pay_enddate = end_date    
   group by eb.bbranch_code,b.bank_code,eb.ebank_acc_no,eb.ebank_amount,
   eb.ebank_order                             
   order by  eb.ebank_order;

 
  declare continue handler for sqlexception
   begin
      set no_data = -2;
   end;
   declare continue handler for not found set no_data = -1;
   set ncash_bkt = 0;    
   set nmain_bkt = 0;    
   set nnatamt = 0;    
   set nbanktrans_bkt = 0;    
   set ntransfering = 0;    
   set ntotbnktrans = 0;    
   set nbasecurrencynetsum = 0;    
   set ncfamt = 0;     
   set npaidsalary = 0;    
   set ntempcfamt = 0;     
   set cashamount = 0;    
   set intstatus = 0;    
   set inatorder = 0;    
   set ncftotal = 0;    
   set strncurrency = 0;    
   set nnetpay = 0;    
   set ntempnetpay = 0;   
   set nbasenetpay = 0;   
   set ntempbasenetpay = 0;  
   set nbasecfamt = 0;
    
    
    
      
    
    
-- -----------get net salary------------------------------------------------    
       
    

-- ---------------------------------------------------------------------------------------    
 --  check the if employee cion carry forward from  his employee native currecny     
--                             select @ncftotal= coalesce(sum(pay_cur_base_cf_amt),0)     
--                               from hs_pr_payprocess p,hs_pr_pay_schedule s    
--                            where p.pay_startdate = s.pay_sch_st_date and    
--                            p.pay_enddate = s.pay_sch_end_date and    
--                            p.emp_number = @empnumber and    
--                            s.pay_sch_id = (    
--                                        select coalesce(pay_sch_id,0)-1 from hs_pr_pay_schedule     
--                                   where pay_sch_st_date=@start_date and pay_sch_end_date=@end_date    
--                                )       
--      
--     set @ntemppaidsal =  @nbasecurrencynetsum + coalesce(@ncftotal,0)     
--     set @nmain_bkt =  @ntemppaidsal - @ncash_bkt           
-- print 'tem salary' + cast(@ncftotal as varchar)        
-- --------------------------------------------------------------------------------------------------    
    
  -- set ipaymode =select coalesce(emp_paytype_flg,1) from hs_hr_employee  where emp_number = empnumber;    
   set ipaymode=0;
   
-- ----------------------round net salary----------------------------------------------------------    
   open curnetsal;    
   set no_data = 0;
   fetch curnetsal into nnetpay;    
	
   while (no_data = 0) do      
        
      select   coalesce(sum(pay_cf_amt),0) into ncfamt from hs_pr_payprocess p,
         (select max(pay_startdate) as prev_date
         from hs_pr_payprocess
         where pay_startdate < start_date   and
         emp_number = empnumber ) a where a.prev_date = p.pay_startdate  and
      p.emp_number = empnumber;
      set ntempnetpay = nnetpay+coalesce(ncfamt,0);

      set npaidsalary =(select ntempnetpay); -- 25k

      -- set ntempbasenetpay = nbasenetpay+nbasecfamt;
      set ncftotal = ncftotal+coalesce(ncfamt,0); -- 0k

      if  ipaymode = 1  then  -- cash transfer    
                
         set ntempcfamt = ntempnetpay -npaidsalary;
	
         set cashamount =  npaidsalary;

         set nmain_bkt = 0;       
                       
         update  hs_pr_payprocess
         set pay_netpay = ntempnetpay,pay_cash_paid_amt = cashamount,
         pay_bank_paid_amt = 0,         
         pay_cf_amt = ntempcfamt,pay_bf_amt = ncfamt,
         pay_grossnet_amt =  nnetpay    
              
         where pay_startdate = start_date and pay_enddate = end_date
         and emp_number = empnumber;
      else
         update  hs_pr_payprocess
         set pay_netpay = ntempnetpay,pay_cash_paid_amt = 0,
         pay_paid_salary = npaidsalary,
         pay_cf_amt = 0,pay_bf_amt = 0,
         pay_grossnet_amt =  nnetpay
         where pay_startdate = start_date and pay_enddate = end_date
         and emp_number = empnumber;
      end if;
      set no_data = 0;
      fetch curnetsal into nnetpay;
	
   end while; -- end while    
   set ntemppaidsal =  nbasecurrencynetsum+coalesce(ncftotal,0);   

   set nmain_bkt =  ntemppaidsal -ncash_bkt;      
   	      	    	
	     
  -- print 'tem salary' + cast(@ncftotal as varchar)     
    
   close curnetsal;          
        
-- ----------------------end rounding salary-------------------------------------------------------    
 -- print cast (@ipaymode as varchar)   
    
   if  ipaymode = 0  then                  
--  begin                 
--     set @npaidsalary = (select adminuser.customrounding(((@ntemppaidsal)),@roundtype,@roundby))                  
--     set @ntempcfamt = @ntemppaidsal - @npaidsalary                   
--     set @cashamount =  @npaidsalary      
--           set @nmain_bkt = 0         
--     update  hs_pr_payprocess     
--     set pay_cash_paid_amt=@cashamount ,    
--      pay_bank_paid_amt=0,    
--      pay_paid_salary=ehrmdemov6.convertcurrency(@snatvcurrency,@sempnatvcurrency,@npaidsalary,@start_date,@end_date),     
--      --pay_netpay =ehrmdemov6.convertcurrency(@snatvcurrency,@sempnatvcurrency,@npaidsalary,@start_date,@end_date),    
--      --pay_cur_base_netpay=@npaidsalary,    
--      pay_cf_amt=ehrmdemov6.convertcurrency(@snatvcurrency,@sempnatvcurrency,@ntempcfamt,@start_date,@end_date),    
--      pay_bf_amt=ehrmdemov6.convertcurrency(@snatvcurrency,@sempnatvcurrency,@ncfamt,@start_date,@end_date),    
--      pay_cur_base_cf_amt=@ntempcfamt,    
--      pay_cur_base_bf_amt=@ncfamt       
--     where pay_startdate =@start_date and  pay_enddate=@end_date and emp_number =@empnumber  and currency_id= @sempnatvcurrency           
--  end     
-- else      
             
  -- --get banks for order    
   
      open curempbankdetail;
      set no_data = 0;
      fetch curempbankdetail into brnchcode,bnkcode,baccnumber,nbankamount;
      while (no_data = 0) do  
	  -- print 'before trans' + cast(@nbankamount as varchar)  
         set nbanktrans_bkt = 0; -- flush bank basket    
         set nbankamount = nbankamount; -- get base value 1000k
	 set ncash_bkt = (nnetpay -nbankamount);
	set nnetpay=ncash_bkt;
	 
 	
        -- print 'after trans' + cast(@nbankamount as varchar) 
       -- ----------add native earnings to the basket -----------------------------           
      -- print 'native base ' + cast(@nnatamt as varchar)    
                
          --  if (nbankamount = 0)  then
         
               -- set nbanktrans_bkt = nnatamt; -- put native earning to the bank basket first    
            --   set nmain_bkt = nmain_bkt -nnetpay;
		

           -- else
            --   set nbanktrans_bkt = nbankamount; -- now bank basket is full    1000
            --   set ncash_bkt = (nnetpay -nbankamount); -- put rest amounts to the cash basket  24  
             --  set nmain_bkt = nmain_bkt -nnetpay; -- 24
		
	--	select nmain_bkt;
          --  end if;
        
       -- ----------end adding native earnings to the basket -------------------------    
       -- ----------add non native earnings to the basket -----------------------------    
           
       -- ----------end adding non native earnings to the basket -----------------------------    

         if ncash_bkt < 0 then
        
            set ncash_bkt = ncash_bkt -abs(nbanktrans_bkt);
            set nbanktrans_bkt = 0;
         else 
            if ncash_bkt > 0 then
        	
               insert into
               hs_pr_bank_transfers(emp_number,bank_code,bbranch_code,ebank_acc_no,
          ebt_start_date,ebt_end_date,ebt_amount,ebt_cur_base_amount)
          values(empnumber,bnkcode,brnchcode,baccnumber,start_date,end_date,
           nbankamount ,nbankamount);
            end if;
         end if;
         set ntotbnktrans = ntotbnktrans+nbankamount; -- collect all bank baskets    
           
         update  hs_pr_payprocess
         set  pay_cash_paid_amt = 0,pay_bank_paid_amt = 0
         where
         pay_startdate = start_date and pay_enddate = end_date and
         emp_number = empnumber;     
  -- print '=========================================================================================================================================='    
         set no_data = 0;
         fetch curempbankdetail into  brnchcode,bnkcode,baccnumber,nbankamount;
      end while;
-- end while    
    
      set ncash_bkt = ncash_bkt;
      close curempbankdetail;
  
      set cashamount = 0;
      set ntempcfamt = 0;
      if ncash_bkt > 0  then
      
         set cashamount = ncash_bkt;
         set ntempcfamt = ncash_bkt - cashamount;
         set intstatus  = 2;
      else
         
                     set intstatus = 0;
         
      end if;
      set npaidsalary = cashamount+ntotbnktrans;      
    
     -- - assumption :-  employee has a net from his native employee currency     
      update
      hs_pr_payprocess
      set
      pay_cash_paid_amt = cashamount,pay_bank_paid_amt = ntotbnktrans,pay_paid_salary = npaidsalary,
          
      
      pay_cf_amt = ntempcfamt,pay_bf_amt = ncfamt
            where
      pay_startdate = start_date and pay_enddate = end_date  and
      emp_number = empnumber;
   end if;              
 --  set ioutput = intstatus;


end;
     

-- </fndbuid>
//

delimiter ;

