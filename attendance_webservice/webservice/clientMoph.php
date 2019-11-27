<html>
<head>
<meta http-equiv="Content-Type" content="text/xml;charset=utf-8" >
</head>
<body>
<?php
error_reporting(E_ALL); ini_set("display_errors", true);
include_once("source/nusoap/lib/nusoap.php");
ini_set ('soap.wsdl_cache_enabled', 0);
ini_set('memory_limit', -1);
ini_set('max_execution_time', 300);

$date=date('Y-m-d', strtotime('-1 days'));
//$date = "2013-12-31";
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
AND k.Pun_Date = '".$date."'
AND m.emp_nic IN ('885370365V'
,'842340705V'
,'846250646V'
,'855552647V'
,'867802770V'
,'850034249V'
,'860071363V'
,'818160151V'
,'878121813V'
,'828651684V'
,'840070255V'
,'855153084V'
,'867551409V'
,'808142732V'
,'847973196V'
,'850821267V'
,'877240851V'
,'820284607V'
,'886160801V'
,'897163837V'
,'907032175V'
,'653471181V'
,'857653300V'
,'727293000V'
,'628333572V'
,'841571320V'
,'836160894V'
,'651900115V'
,'812303945V'
,'795110909V'
,'830444017V'
,'775012595V'
,'836760956V'
,'797872946V'
,'831250488V'
,'813240610V'
,'732180273V'
,'827512591V'
,'747703345V'
,'680230277V'
,'836820061V'
,'836461223V'
,'622502453V'
,'827721557V'
,'788243251V'
,'802844727V'
,'846053360V'
,'787573460V'
,'848512257V'
,'867312633V'
,'866571350V'
,'823413688V'
,'868081465V'
,'825932097V'
,'837813352V'
,'803450153V'
,'848533858V'
,'855313189V'
,'846270779V'
,'875751506V'
,'847550171V'
,'856120112V'
,'878532481V'
,'838232876V'
,'788043430V'
,'875063715V'
,'555682557V'
,'735302108V'
,'828393111V'
,'622030764V'
,'895660680V'
,'757532107V'
,'815292677V'
,'847870281V'
,'805983418V'
,'823181132V'
,'757290073V'
,'745670253V'
,'712290137V'
,'788222009V'
,'766632297V'
,'775642106V'
,'540830916V'
,'713632694V'
,'865132069V'
,'782670824V'
,'681210679V'
,'861030717V'
,'593520463V'
,'561921253V'
,'573611160V'
,'590751472V'
,'847410337V'
,'710170088V'
,'713590533V'
,'752780870V'
,'777291343V'
,'635811080V'
,'820920953V'
,'811731773V'
,'760673501V'
,'571101416V'
,'710900566V'
,'668061168V'
,'747071616V'
,'671894146V'
,'823582749V'
,'561112061V'
,'595162777V'
,'545704218V'
,'636580341V'
,'808031329V'
,'782711660V'
,'861280624V'
,'853052191V'
,'723584159V'
,'856121046V'
,'811215490V'
,'866121451V'
,'812392921V'
,'650720024V'
,'777361767V'
,'803520909V'
,'741622165V'
,'601990911V'
,'808503760V'
,'652000959V'
,'686040321V'
,'861952525V'
,'643580659V'
,'687642953V'
,'900034504V'
,'846420690V'
,'885052932V'
,'641151076V'
,'670704360V'
,'662782505V'
,'681210679V'
,'797701661V'
,'862981669V'
,'787182534V'
,'843211100V'
,'885370365V'
,'867590439V'
,'856440907V'
,'846180877V'
,'802362315V'
,'875182862V'
,'840720330V'
,'812922041V'
,'867822860V'
,'846481559V'
,'857010809V'
,'857010434V'
,'867001140V'
,'816853427V'
,'847583274V'
,'855563550V'
,'820504518V'
,'852151455V'
,'826331690V'
,'850820708V'
,'856300978V'
,'858321212V'
,'858232988V'
,'855911680V'
,'683480908V'
,'640122137V'
,'660250158V'
,'613121218V'
,'543061158V'
,'707562250V'
,'726521107V'
,'571790726V'
,'676360107V'
,'635610328V'
,'792614965V'
,'821904439V'
,'673184030V'
,'840840140V'
,'780971789V'
,'777812025V'
,'770970105V'
,'916911831V'
,'810334614V'
,'690471078V'
,'685840235V'
,'867282750V'
,'742132684V'
,'613121218V'
,'848290408V'
,'876692023V'
,'740340247V'
,'660340475V'
,'631941761V'
,'760091383V'
,'773051313V'
,'636871001V'
,'552121074V'
,'832470678V'
,'591680765V'
,'721724670V'
,'903144033V'
,'901050198V'
,'873611502V'
,'823662971V'
,'840351637V'
,'815533461V'
,'817480527V'
,'838473920V'
,'816870852V'
,'835383059V'
,'851261370V'
,'845591199V'
,'846270779V'
,'822174019V'
,'821820642V')";











 
//AND m.emp_nic = '775012595V'";
//AND m.emp_nic != null ";
$result = mssql_query($sql); 


    while($row = mssql_fetch_array($result)){
	//print_r($row['Date']."|".$row['Time']."|".$row['NIC']."|".$row['Emp_CardNo']."<br/>");
    //print_r($row). "<br/>";


    
$client = new nusoap_client('http://192.168.0.117/attendance_moph/webservice/server.php?wsdl');
$client->soap_defencoding = 'UTF-8';
$client->debug_flag = false;
$soapError = $client->getError();

$clk_date=$row['Date'];
$clk_time=$row['Time'];
$clk_no=$row['NIC'];

//die(print_r($clk_no.$clk_date.$clk_time));
$response = $client->call('setInsertAttendanceRow',array("clk_no" => $clk_no, "clk_date" => $clk_date, "clk_time" => $clk_time));
//die(print_r($client));
if($response){    
    echo("<br />"."Success : ".$clk_no."|".$clk_date."|".$clk_time);
    }else{
    echo("<br />"."Error: ".$clk_no."|".$clk_date."|".$clk_time);
}
}


}



?>
</body>
</html>
