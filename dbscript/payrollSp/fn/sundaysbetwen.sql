
delimiter //
  
drop function if exists sundaysbetween;
//
create  function sundaysbetween(paystartdate datetime,payenddate datetime)    
returns numeric 
begin
      
   declare dresult numeric;           
   declare curdate datetime;     
   declare dayofweek varchar(10);  
   
 
   set dresult = 0;   
   set curdate = paystartdate;  
  
   while (paystartdate <= curdate) and (curdate <= payenddate) do
      
      set dayofweek = dayname(curdate);
      if  dayofweek = 'sunday'  then
                          
         set dresult = dresult+1;
      end if;
      
      set curdate = timestampadd(day,1,curdate);
   end while;  
   return  dresult;  
end;
  

//

delimiter ;

