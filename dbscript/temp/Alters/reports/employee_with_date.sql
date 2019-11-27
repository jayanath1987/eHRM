delimiter //

drop procedure if exists Summary_of_total_date;
//
create procedure Summary_of_total_date(fromd VARCHAR(255),tod VARCHAR(255))
begin

SELECT date(a.audit_datetime) ,e.emp_number,e.work_station, e.hie_code_1,e.hie_code_2,e.hie_code_3,e.hie_code_4,e.hie_code_5,e.hie_code_6,
c6.id as c6id,c6.title as c6wasam,c6.title_si as c6swasam,c6.title_ta as c6twasam,
c5.id as c5id,c5.title as c5wasam,c5.title_si as c5swasam,c5.title_ta as c5twasam,
c4.id as c4id,c4.title as c4wasam,c4.title_si as c4swasam,c4.title_ta as c4twasam,
c3.id as c3id,c3.title as c3wasam,c3.title_si as c3swasam,c3.title_ta as c3twasam,
c2.id as c2id,c2.title as c2wasam,c2.title_si as c2swasam,c2.title_ta as c2twasam,



(select count(e6.emp_number) as wemp from hs_hr_employee e6 where e6.work_station = c6.id),
(select count(e5.emp_number) as zemp from hs_hr_employee e5 where e5.work_station = c5.id),
(select count(e4.emp_number) as demp from hs_hr_employee e4 where e4.work_station = c4.id),
(select count(e3.emp_number) as ddemp from hs_hr_employee e3 where e3.work_station = c3.id),
(select count(e2.emp_number) as pemp from hs_hr_employee e2 where e2.hie_code_2 = c2.id),count(*)

FROM hs_hr_audit a left join hs_hr_employee e on  a.audit_row_pk = e.emp_number

LEFT JOIN hs_hr_compstructtree c6 ON c6.id=e.hie_code_6 AND c6.def_level = 6
LEFT JOIN hs_hr_compstructtree c5 ON c5.id=e.hie_code_5 AND c5.def_level = 5
LEFT JOIN hs_hr_compstructtree c4 ON c4.id=e.hie_code_4 AND c4.def_level = 4
LEFT JOIN hs_hr_compstructtree c3 ON c3.id=e.hie_code_3 AND c3.def_level = 3
LEFT JOIN hs_hr_compstructtree c2 ON c2.id=e.hie_code_2 AND c2.def_level = 2

where a.audit_description = "new record added"
AND date(a.audit_datetime) >=  fromd
AND date(a.audit_datetime) <=  tod


-- group by a.audit_row_pk;  
group by e.work_station;

end; 
//
delimiter ;
