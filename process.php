<?php

header("Cache-Control: no-store, no-cache, must-revalidate");

?>
<html>
<head>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
</head>



<div>
<b>Process Started ... </b>
</div>

<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


shell_exec("php /var/www/eSamudhiHRM/symfony/symfony payProcess:employee {$_GET['comma']} {$_GET['startDate']} {$_GET['endDate']} {$_GET['batchId']} {$_GET['empId']} {$_GET['prltype']}");
//shell_exec("php /var/www/hrmintegration/symfony/symfony payProcess:employee {$_GET['comma']} {$_GET['startDate']} {$_GET['endDate']} {$_GET['batchId']} {$_GET['empId']} {$_GET['prltype']}");


?>
<script>



function Func1(){
window.close();    
}

setTimeout("Func1()", 10000);

</script>
<html>