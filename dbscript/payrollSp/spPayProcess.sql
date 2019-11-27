delimiter //
drop procedure if exists spaddpayprocess;
//
create procedure spaddpayprocess(start_date datetime,                                              
end_date datetime,                                              
empnumber varchar(6),                                              
grosssalary numeric(13,2),                                              
netpay numeric(13,2),                              
out ioutput int)
   
begin

   declare roundby numeric;                                      
   declare roundtype numeric;                                                         
   declare fixedearnamt numeric;                                  
   declare loanamt numeric;                                   
   declare totearnings numeric;                                    
   declare fixeddeductions numeric;                                  
   declare takehomeper numeric;                                  
   declare intstatus numeric;                              
   declare ipaymode numeric;                              
   declare bnkcode varchar(8);                               
   declare brnchcode varchar(6);                                 
   declare baccnumber varchar(80);                              
   declare cashamount numeric(13,2);                            
   declare bankamount numeric(13,2);                             
   declare ibankentered numeric;                                
   declare nbankamount numeric(13,2);                                
   declare nbanktotalamount numeric(13,2);                             
   declare nbanktrnamount numeric(13,2);                             
   declare nbanktrntotal numeric(13,2);                             
   declare npaidsalary numeric(13,2);                             
   declare nbfamt numeric(13,2);                            
   declare ncfamt numeric(13,2);                            
   declare npfyear numeric;                            
   declare nschid numeric;                            
   declare nnewschid numeric;                            
   declare dprevdate datetime;                            
   declare dnextdate datetime;                            
   declare nbanktempamt numeric(13,2);                            
   declare ntemppaidsal numeric(13,2);                        
   declare ntempcfamt numeric(13,2);                
                
-- -----------------------------------------------------------------                
   declare sdsgcode varchar(6);                 
   declare shiecode1 int(6);                
   declare shiecode2 int(6);                
   declare shiecode3 int(6);                
   declare shiecode4 int(6);                
   declare shiecode5 int(6);                
   declare shiecode6 int(6);                
   declare sloccode varchar(6);                
   declare sctcode varchar(6);                
   declare scatcode varchar(6);                
   declare sgpcode varchar(6);                
   declare semptype varchar(6);                
   declare sstaffcatcode varchar(6);                
   declare salgrd varchar(20);                
   declare scostcenter varchar(20);            
   declare nsalarypoint numeric;            
   declare sempepfnumber varchar(25);             
   declare snatvcurrency varchar(6);            
   declare sempnatvcurrency varchar(6);               
   declare nismultinet numeric;               
            
-- -----------------------------------------------------------------                        
                                    
  -- declare currounding cursor for                                      
   -- select ifnull(roundby,0),ifnull(roundtype,0)                                      
  -- from hs_pr_profile;                                      
                      
   declare curempdetail cursor for                                     
   select              
   hie_code_1,                
   hie_code_2,                
   hie_code_3,                
   hie_code_4,                
   hie_code_5,                
   hie_code_6,                                                      
   job_title_code,                                                  
   emp_status,                                  
   slt_scale_year                                   
   from             
   hs_hr_employee e            
   where             
   e.emp_number =  empnumber;                                   
                                    
                                    
    declare curtakehome cursor for                                     
    select takehome_ptg                         
    from hs_pr_profile;                                  
                                      
   declare curfixedearnamt cursor for                                  
   select             
   ifnull(sum(trn_proc_emp_amt),0) as trn_proc_emp_amt                           
   from                        
   hs_pr_transaction_type t,hs_pr_transaction_details d,hs_pr_processedtxn p                        
   where             
   t.trn_typ_code = d.trn_typ_code and                         
   d.trn_dtl_code = p.trn_dtl_code and                          
  (t.erndedcon = 2 or t.erndedcon = 1)  and ifnull(trn_typ_type,0) = 1 and                        
   emp_number = empnumber and trn_startdate >= start_date and trn_startdate <= end_date; 
   
  -- declare curloanamt cursor for                                  
  -- select                        
  -- ifnull(sum(capital_amt+interest_amt),0)                                  
 --  from                                  
  -- hs_pr_empshedule p                           
 --  where                                  
  -- ifnull(disable_flg,0) = 0 and d.trn_dtl_code = p.trn_dtl_code and                                  
  -- p.emp_number = empnumber  and p.process_fromdate = start_date and p.process_todate = end_date                                 
  -- and ifnull(p.issettled,0) = 0 and ifnull(p.isactive,0) = 1 and ifnull(p.isstop,0) = 0 and ifnull(p.isproccess,0) = 1;                           
                                 
   declare curfixeddeductions cursor for                                  
   select ifnull(sum(trn_proc_emp_amt),0) as trn_proc_emp_amt                  
   from                        
   hs_pr_transaction_type t,hs_pr_transaction_details d,hs_pr_processedtxn p                        
   where             
   t.trn_typ_code = d.trn_typ_code and                         
   d.trn_dtl_code = p.trn_dtl_code and                          
  (t.erndedcon = -1)  and (ifnull(trn_typ_type,0) = 1 or ifnull(trn_typ_type,0) = 0) and                        
   emp_number = empnumber and trn_startdate >= start_date  and trn_startdate <= end_date;
   
  
   set intstatus = 0;                              
   set cashamount = netpay;                             
   set bankamount = 0;                              
   set ibankentered = 0;                            
   set brnchcode = '';                            
   set baccnumber = '';                            
   set baccnumber = '';                            
   set nbanktrntotal = 0;         
   set ncfamt = 0;                            
   set nbanktrnamount =  0;                               
   set fixedearnamt  = 0;                        
   set fixeddeductions  = 0;                        
   set loanamt = 0;                 
   set ntemppaidsal = 0;                
   set ntempcfamt = 0;                
                
-- -------------------------------------------------------------------                
                
   set sdsgcode  = '';                 
--   set shiecode1  = '';                
--   set shiecode2  = '';                
--   set shiecode3 = '';                
--   set shiecode4  = '';                
--   set shiecode5  = '';                
--   set shiecode6  = '';                
   set sloccode  = '';                
   set sctcode  = '';                
   set scatcode  = '';                
   set sgpcode  = '';                
   set semptype  = '';                
   set sstaffcatcode = '';                
   set salgrd   = '';                
   set scostcenter = '';            
   set sempepfnumber = '';              
            
            
               
             
-- -------------------------------------------------------------------                       
-- --@intstatus  1: take home insuffient    2: cash transfered  3: take home insuffient & cash transfered  4 :negative salary processed                      
  -- open currounding;                                      
  -- fetch currounding into roundby,roundtype;                                      
  -- close currounding;                                      
                               
                                    
-- ------------ values from hs_hr_employee -------------------------------------------------                                    
                
   open curempdetail;                                    
   fetch curempdetail into shiecode1,shiecode2,shiecode3,shiecode4,shiecode5,shiecode6,
   sdsgcode,semptype,salgrd;
   close curempdetail;                                    
                                    
-- -----------------------------------------------------------------------------------------                                  
-- -------------------------take home percentage-----------------                                  
                              
   open curtakehome;                           
   fetch curtakehome into takehomeper;                                  
   close curtakehome;                                             
                                  
                                  
                                  
-- ----------------------fixed earn & basic salary-------------------------              
   open curfixedearnamt;                                  
   fetch curfixedearnamt into fixedearnamt;                       
   close curfixedearnamt;                                  
                                   
                         
-- ------deductions-------------------------------------------------                        
                        
-- --------loans-----------                                  
                                  
  -- open curloanamt;                                  
 -- fetch curloanamt into loanamt;                                  
 --  close curloanamt;                                  
                                      
                           
-- ----------------fixed deductions----------------                                  
            
            
            
            
   open curfixeddeductions;                                  
   fetch curfixeddeductions into fixeddeductions;                                  
   close curfixeddeductions;                                  
                        
                           
   if   ifnull(takehomeper,0) > 0 then
    
      if(fixedearnamt*(takehomeper/100)) > fixedearnamt -((fixeddeductions+loanamt)) then
            
         set  intstatus = 1;
      else
         set  intstatus=-1;
      end if;
   end if;    -- ----------end of take home---------------                        
            
-- -----------------------------chech negative salayr ------------------------------------------------------------                     
   if ifnull(netpay,0) < 0 then        
      set  intstatus = 4;
   end if;                 
-- ------------------------------ end of chech negative salayr ---------------------------------------------------                    
                    
   
         
         insert into
         hs_pr_payprocess(emp_number,pay_startdate,pay_enddate,pay_gross_salary,pay_netpay,
  pay_dsg_code, pay_hie_code_1,
        pay_hie_code_2,
        pay_hie_code_3,
        pay_hie_code_4,
        pay_hie_code_5,
        pay_hie_code_6,
        pay_emp_type,                         
 pay_processed_date,pay_proc_user)
values(empnumber,start_date,end_date,
  grosssalary,
  netpay,    
  sdsgcode,
  shiecode1,shiecode2,shiecode3, shiecode4, shiecode5, shiecode6,
  semptype,
  current_timestamp,getUser());
     
                
            
   set ioutput = intstatus;
   
end;
      
  
  //

delimiter ;
