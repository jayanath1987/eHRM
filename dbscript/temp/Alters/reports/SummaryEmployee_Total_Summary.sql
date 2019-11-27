delimiter //

drop procedure if exists SummaryEmployee_Total_Summary;
//
CREATE  PROCEDURE `SummaryEmployee_Total_Summary`()
begin
 

SELECT c6.*, 
c5.title as c5title,c5.id as c5id,c5.parnt as c5parnt,c5.title_si as c5title_si,c5.title_ta as c5title_ta,c5.def_level as c5def_level,
c4.title as c4title,c4.id as c4id,c4.parnt as c4parnt,c4.title_si as c4title_si,c4.title_ta as c4title_ta,c4.def_level as c4def_level,
c3.title as c3title,c3.id as c3id,c3.parnt as c3parnt,c3.title_si as c3title_si,c3.title_ta as c3title_ta,c3.def_level as c3def_level,
c2.title as c2title,c2.id as c2id,c2.parnt as c2parnt,c2.title_si as c2title_si,c2.title_ta as c2title_ta,c2.def_level as c2def_level,

(select count(e6.emp_number) as wemp from hs_hr_employee e6 where e6.hie_code_6 = c6.id),
(select count(e5.emp_number) as zemp from hs_hr_employee e5 where e5.hie_code_5 = c5.id),
(select count(e4.emp_number) as demp from hs_hr_employee e4 where e4.hie_code_4 = c4.id),
(select count(e3.emp_number) as ddemp from hs_hr_employee e3 where e3.hie_code_3 = c3.id),
(select count(e2.emp_number) as pemp from hs_hr_employee e2 where e2.hie_code_2 = c2.id)
 
-- e6.emp_number as wemp_number,e6.work_station as wwork_station,

-- e5.emp_number as zemp_number, e5.work_station as zwork_station,e4.emp_number as demp_number, e4.work_station as dwork_station,e3.emp_number as ddemp_number, e3.work_station as ddwork_station


FROM hs_hr_compstructtree c6


LEFT JOIN hs_hr_compstructtree c5 ON c6.parnt=c5.id AND c5.def_level = 5
LEFT JOIN hs_hr_compstructtree c4 ON c5.parnt=c4.id AND c4.def_level = 4
LEFT JOIN hs_hr_compstructtree c3 ON c4.parnt=c3.id AND c3.def_level = 3
LEFT JOIN hs_hr_compstructtree c2 ON c3.parnt=c2.id AND c2.def_level = 2
-- LEFT JOIN hs_hr_employee e6 ON c6.id=e6.work_station AND e6.hie_code_7 IS null
-- LEFT JOIN hs_hr_employee e5 ON c5.id=e5.work_station AND e5.hie_code_6 IS null
-- LEFT JOIN hs_hr_employee e4 ON c4.id=e4.work_station AND e4.hie_code_5 IS null
-- LEFT JOIN hs_hr_employee e3 ON c3.id=e3.work_station AND e3.hie_code_4 IS null


where c6.def_level= 6;


                     



end
//
delimiter ;
