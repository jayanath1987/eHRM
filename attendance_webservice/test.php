<html>  
<head>  
</head>  
<body>  
<?php   


    $server = "192.168.0.250\SQLEXP2008";
    $link = mssql_connect($server, "sa", "password@123");

    if (!$link) {
    die("<br/><br/>Something went wrong while connecting to MSSQL");
    }
    else {
    $selected = mssql_select_db("EasyTimeSQL", $link)
    or die("Couldn’t open database databasename");
    //echo "connected to databasename<br/>";

    //$result = mssql_query("SELECT * FROM DailyPunches inner join Emp_Details on Emp_CardNo = emp_card");

$sql = "SELECT Convert(varchar(10),k.Pun_Date, 120) as Date, Convert(varchar(10),k.Pun_Time, 108) as Time,m.emp_nic as NIC,k.Emp_CardNo 
FROM DailyPunches k,Emp_Details m
where k.Emp_CardNo=m.emp_card 
AND k.Pun_Date = '2013-09-11' "; 
//AND m.emp_nic = '775642106V'";
// AND m.emp_nic != null ";
$result = mssql_query($sql); 


    while($row = mssql_fetch_array($result))
	print_r($row['Date']."|".$row['Time']."|".$row['NIC']."|".$row['Emp_CardNo']."<br/>");
    //print_r($row). "<br/>";


    }
?>
</body>
</html>