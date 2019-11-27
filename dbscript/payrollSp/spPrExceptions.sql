delimiter //

drop procedure if exists spPrException;
//
create procedure spPrException(start_date datetime,          
end_date datetime,          
empnumber varchar(6),batchId varchar(100),errortype varchar(4))

begin
	
	      
              		
		insert into
  			hs_pr_exceptions(pro_startdate,pro_enddate,
			emp_number,pro_batch_id,exception_id) 
			VALUES(start_date,end_date,empnumber,batchId,errortype);
             	
               



end;


//

delimiter ;
