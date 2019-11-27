delimiter //
   
drop function if exists prorateempincrement;
//
create function prorateempincrement(empno varchar(6),fromdate datetime,todate datetime,nbsal numeric(13,2))
returns numeric(13,2)
    
begin

    
    
   declare nprtbsal numeric(13,2);    
   declare nprobase numeric(13,4);    
   declare nconsunday boolean;    
   declare nconsaturday boolean;    
   declare nconroster boolean;     
   declare nprvsalary numeric(13,2);    
   declare nnewsalary numeric(13,2);    
   declare nincamount numeric(13,2);    
   declare dinceffdate datetime;    
   declare nworkdays numeric(13,2);    
   declare nnoteffectdays numeric(13,2);
   declare no_data int default 0;

   


   declare curincdata cursor  for     
    
   select coalesce(inc_previous_salary,0),coalesce(inc_new_salary,0),inc_effective_date,coalesce(inc_amount,0)    
   from  hs_pr_increment i    
   where emp_number = empno and coalesce(i.inc_confirm_flag,0) = 1 and fromdate < i.inc_effective_date and i.inc_effective_date <= todate;

 

   declare continue handler for sqlexception
   begin
      set no_data = -2;
   end;
   declare continue handler for not found set no_data = -1;
  

   set nprtbsal  = nbsal;    
   set nprobase  = 0;    
   set nconsunday  = 1;    
   set nconsaturday = 1;    
   set nconroster  = 0;    
   set nprvsalary     = 0;    
   set nnewsalary     = 0;    
   set nincamount     = 0;    
   set nworkdays     = 0;    
   set nnoteffectdays = 0;

    -- select   par_value into nprobase from hs_pr_parameters_casualpayroll where par_name = 'proration_base';    
    
    -- select   coalesce(par_value,'0') into nconsunday from hs_pr_parameters_casualpayroll where par_name = 'is_consider_sundays';    
    
   -- select   coalesce(par_value,'0') into nconsaturday from hs_pr_parameters_casualpayroll where par_name = 'is_consider_saturdays';    
    
   -- select   coalesce(par_value,'0') into nconroster from  hs_pr_parameters_casualpayroll where  par_name = 'is_roster_based_proration';    
    
   if (nprobase = 0)  then
          
      set nprobase  = timestampdiff(day,fromdate,todate)+1;
   end if;    
  
   
   open  curincdata;    
   set no_data = 0;
   fetch curincdata into nprvsalary,nnewsalary,dinceffdate,nincamount;    
    	
         
   while (no_data = 0) do
      set nnoteffectdays = timestampdiff(day,fromdate,dinceffdate); 

	-- set @nworkdays = datediff(d,@dinceffdate,@todate) + 1    
      set nworkdays = nprobase -nnoteffectdays;
    --  if nconsunday = 1  then
    
         -- set nworkdays = nworkdays -sundaysbetween(dinceffdate,todate);
     -- end if;
     -- if nconsaturday = 1 then
         
         
      --   begin
         --   set nworkdays = nworkdays -saturdaysbetween(dinceffdate,todate);

     --    end;
     --   end if;
    --  if nconroster = 1  then
    
       --  set nworkdays = nworkdays -getrosterbasedworkingdays(empno,dinceffdate,todate);
    --  end if;
    --  if(((nincamount/nprobase)*nworkdays)+nprvsalary) > nnewsalary  then
    
         set nprtbsal = nnewsalary;
    --  else
    --     set nprtbsal =((nincamount/nprobase)*nworkdays)+nprvsalary;
    --  end if;
	
      if nprtbsal < 0  then
   
         set nprtbsal = 0;
      end if;
	if nprtbsal= 0 then
	
		set nprtbsal = nbsal;
	end if; 
     -- if nprtbsal > nbsal then
   
      --   set nprtbsal = nbsal;
    --  end if;
      set no_data = 0;
      fetch curincdata into nprvsalary,nnewsalary,dinceffdate,nincamount;
  end while;     
   close curincdata;    
 
    
     return nprtbsal;    
end;



-- </fndbuid>
//

delimiter ;
