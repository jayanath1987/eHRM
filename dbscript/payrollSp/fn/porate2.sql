-- function definition script prorate2 for mysql
-- generated by (c) ispirer sqlways express 5.0 build 901
-- timestamp: mon oct 24 10:26:05 2011

delimiter //

drop function if exists prorate;
//
create function prorate(empno varchar(6),fromdate datetime,todate datetime,amount numeric(13,2))  returns numeric(25,12)  
begin

   declare workingdays numeric(13,8);                  
   declare joindate datetime;                   
   declare resigndate datetime;                         
   declare prtdays numeric; 
   declare notworkingdays numeric;                   
   declare prtamount numeric(25,12);                   
   declare prbase numeric(25,12);                   
   declare calcsundays numeric(1,0);   
   declare calcsaturdays numeric(1,0);                  
   declare nsundays numeric;   
   declare nsaturdays numeric;                   
   declare isconsiderholiday varchar(50);   
   declare isconsiderholidaysat varchar(50);               
   declare isrosterbasedproration numeric;   
                
                
  -- ----------------based product rule ------------------------------------                   
  -- -------------------------------    
              
   declare curcrossdate cursor for                                    
   select ifnull(terminated_date,timestampadd(year,1,todate)),emp_com_date                   
   from hs_hr_employee                    
   where emp_number =  empno;                  
      
             
               
      
   set prtamount = 0;   
                                                      
   open curcrossdate;                                    
   fetch curcrossdate
   into  resigndate,joindate;           
   close curcrossdate;  
     
                        
   set calcsundays   = 0;    
   set calcsaturdays = 0;   
   set nsundays = 0;  
   set nsaturdays = 0;   
                    
  -- ----------------calculate working days--------------------------                                 
            
--  open curprbase                                    
--  fetch curprbase into  @prbase                 
--  close curprbase   
--  deallocate curprbase    
                          
--  open curholyday                                   
--  fetch curholyday into  @isconsiderholiday  
--  close curholyday  
--  deallocate curholyday    
                  
--  open curholydaysat                                   
--  fetch curholydaysat into  @isconsiderholidaysat  
--  close curholydaysat  
--  deallocate curholydaysat    
  
  
  -- -------------- rosterbased proration ---------------------------          
         
--  open curisrosterbased               
--  fetch curisrosterbased into  @isrosterbasedproration  
--  close curisrosterbased    
--  deallocate curisrosterbased  
                        
   if (isrosterbasedproration = 1) then
  
      set prtdays = getrosterbasedworkingdays2(empno,joindate,resigndate);
      set workingdays = getrosterbasedworkingdays2(empno,fromdate,todate);
      set calcsundays =  isconsiderholiday;
   else          
        
  -- +     
      set calcsundays   =  isconsiderholiday;
      set calcsaturdays =  isconsiderholidaysat;



     
      if (prbase = 0) then
   
         if (calcsundays = 0) then
     
            set workingdays = timestampdiff(day,fromdate,todate) -nsundays+1;
         else 
            if (calcsundays = 1) then
     
               set nsundays = sundaysbetween(fromdate,todate);
               set workingdays = timestampdiff(day,fromdate,todate) -nsundays+1;
            end if;
         end if;  
     -- --------------------------------------------------------------  
       
         if (calcsaturdays = 0 ) then
     
            set workingdays = workingdays -nsaturdays;
         else 
            if (calcsaturdays = 1) then
     
               set nsaturdays = saturdaysbetween(fromdate,todate);
               set workingdays = workingdays -nsaturdays;
            end if;
         end if;
      else
         set workingdays =  prbase;
      end if;
   end if;   
            
  -- --------------- calculate prorated days ------------                  
  -- proration for both join and resign date                  
   if ((fromdate <  joindate and  (joindate <= todate)) and ( (fromdate <=  resigndate) and  (resigndate <  todate))) then
    
      if (calcsundays = 0) then
     
         if (isrosterbasedproration = 0) then
       
            set prtdays = timestampdiff(day,joindate,resigndate)+1;
         end if;
      else 
         if (calcsundays = 1)  then
     
            set nsundays = sundaysbetween(joindate,resigndate);
            if (isrosterbasedproration = 0) then
       
               set prtdays = timestampdiff(day,joindate,resigndate) -nsundays+1;
            end if;
         end if;
      end if;   
-- --------------------------------------------------------------  
  
      if (calcsaturdays = 0) then
     
         if (isrosterbasedproration = 0) then
       
            set prtdays = prtdays;
         end if;
         if (workingdays > 0 and  workingdays < 1) then  -- to capture amunts between 0 and 1 i.e 0.023            
       
            set prtamount =(amount*workingdays)*prtdays;
         else
            set prtamount  =(amount/workingdays)*prtdays;
         end if;
      else 
         if (calcsaturdays = 1) then
     
            set nsaturdays = saturdaysbetween(joindate,resigndate);
            if (isrosterbasedproration = 0)  then
       
               set prtdays = prtdays -nsaturdays;
            end if;
            if (workingdays > 0 and  workingdays < 1) then
       
               set prtamount =(amount*workingdays)*prtdays;
            else
               set prtamount =(amount/workingdays)*prtdays;
            end if;
         end if;
      end if;  
                  
  -- proration for join date                   
    
-- -------------------------------------------------------------------------------  
  
   else 
      if (((fromdate <  joindate) and  ((joindate <= todate) and (resigndate >=  todate)))) then

         if (calcsundays = 0) then
    
            if (isrosterbasedproration = 0) then
                   
			-- dinesha
             -- set @prtdays = datediff(day,@joindate,@todate) + 1   
               set notworkingdays = timestampdiff(day,fromdate,joindate);
               set prtdays =(workingdays -notworkingdays);
            end if;
         else 
            if (calcsundays = 1)  then
    
               set nsundays  = sundaysbetween(joindate,todate);
               if (isrosterbasedproration = 0) then
              
             -- set @prtdays= datediff(day,@fromdate,@joindate) -  @nsundays + 1 
                  set notworkingdays = timestampdiff(day,fromdate,joindate); 	
			 -- -dinesha
                  set prtdays =(workingdays -notworkingdays) -nsundays+1;
               else
                  set prtdays  =  prtdays -nsundays;
               end if;
            end if;
         end if;  
-- ---------------------------------------------------------------------  
         if (calcsaturdays = 0) then
    
            if (isrosterbasedproration = 0)  then
          
               set prtdays = prtdays;
            end if;
            if (workingdays > 0 and  workingdays < 1) then  -- to capture amunts between 0 and 1 i.e 0.023            
               
               begin
                  set prtamount  =(amount*workingdays)*prtdays;
               end;
            else
               
               begin
                  set prtamount  =(amount/workingdays)*prtdays;
               end;
            end if;
         else 
            if (calcsaturdays = 1) then
    
               set nsaturdays  = saturdaysbetween(joindate,todate);
               if (isrosterbasedproration = 0) then
          
                  set prtdays = prtdays -nsaturdays;
               else
                  set prtdays  =  prtdays -nsaturdays;
               end if;
               if (workingdays > 0 and  workingdays < 1) then -- to capture amunts between 0 and 1 i.e 0.023            
          
                  set prtamount =(amount*workingdays)*prtdays;
               else
                  set prtamount =(amount/workingdays)*prtdays;
               end if;
            end if;
         end if;  
-- ---------------------------------------------------------------------     
  
  -- proration for resign date                  
      else 
         if ((fromdate >=  joindate) and ((fromdate <=  resigndate) and  (resigndate <  todate))) then

            if (calcsundays = 0 ) then
          
               if (isrosterbasedproration = 0) then
            
                  set prtdays  = timestampdiff(day,fromdate,resigndate)+1;
               end if;
            else 
               if (calcsundays = 1)  then
          
                  set nsundays  = sundaysbetween(fromdate,resigndate);
                  if (isrosterbasedproration = 0)  then
              
                     set prtdays  = timestampdiff(day,fromdate,resigndate) -nsundays+1;
                  end if;
               end if;
            end if;  
  
-- ----------------------------------------------------------------------------  
  
            if (calcsaturdays = 0 ) then
          
               if (isrosterbasedproration = 0) then
             
                  set prtdays  = prtdays;
               end if;
               if ( (workingdays > 0) and  (workingdays < 1))  then
             
                  set prtamount  =(amount*workingdays)*prtdays;
               else
                  set prtamount  =(amount/workingdays)*prtdays;
               end if;
            else 
               if (calcsaturdays = 1) then
          
                  set nsaturdays  = saturdaysbetween(fromdate,resigndate);
                  if (isrosterbasedproration = 0) then
             
                     set prtdays  = prtdays -nsaturdays;
                  end if;
                  if (workingdays > 0 and  workingdays < 1)  then -- to capture amunts between 0 and 1 i.e 0.023            
             
                     set prtamount  =(amount*workingdays)*prtdays;
                  else
                     set prtamount  =(amount/workingdays)*prtdays;
                  end if;
               end if;
            end if;  
-- --------------------------------------------------------------------  
-- no proration                   
         else 
            if (fromdate >=  joindate) and (resigndate >=  todate) then

               if (calcsundays = 0)  then
          
                  if (isrosterbasedproration = 0) then
              
                     set prtdays  = timestampdiff(day,fromdate,todate)+1;
                  end if;
               else 
                  if (calcsundays = 1)  then
          
                     set nsundays  = sundaysbetween(fromdate,todate);
                     if (isrosterbasedproration = 0)  then
             
                        set prtdays  =(timestampdiff(day,fromdate,todate) -nsundays)+1;
                     end if;
                  end if;
               end if;  
  
-- -------------------------------------------------------------------------------  
               if (calcsaturdays = 0) then
          
                  if (isrosterbasedproration = 0)  then
             
                     set prtdays  = prtdays;
                     set prtamount  =  amount;
                  end if;
               else 
                  if (calcsaturdays = 1) then
          
                     set nsaturdays  = saturdaysbetween(fromdate,todate);
                     if (isrosterbasedproration = 0) then
             
                        set prtdays  =(prtdays -nsaturdays);
                     end if;
                     set prtamount  =  amount;
                  end if;
               end if;
            end if;
         end if;
      end if;
   end if;                                 
             
   if  (prtamount >  amount) then
 
      set prtamount  =  amount;
   end if;       
   return  prtamount;     
    
end;
      


-- </fndbuid>
//

delimiter ;

