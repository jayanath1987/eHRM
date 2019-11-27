<html>  
<head>  
<title>ShotDev.Com Tutorial</title>  
</head>  
<body>  
<?  
$objConnect = mssql_connect("192.168.1.169:1443","sa","1234");  
$objDB = mssql_select_db("MahaweliAttendance");  
  
//*** Add Condition ***//  
if($_POST["hdnCmd"] == "Add")  
{  
$strSQL = "INSERT INTO customer ";  
$strSQL .="(CustomerID,Name,Email,CountryCode,Budget,Used) ";  
$strSQL .="VALUES ";  
$strSQL .="('".$_POST["txtAddCustomerID"]."','".$_POST["txtAddName"]."' ";  
$strSQL .=",'".$_POST["txtAddEmail"]."' ";  
$strSQL .=",'".$_POST["txtAddCountryCode"]."','".$_POST["txtAddBudget"]."' ";  
$strSQL .=",'".$_POST["txtAddUsed"]."') ";  
$objQuery = mssql_query($strSQL);  
if(!$objQuery)  
{  
echo "Error Save [".mssql_error()."]";  
}  
//header("location:$_SERVER[PHP_SELF]");  
//exit();  
}  
  
//*** Update Condition ***//  
if($_POST["hdnCmd"] == "Update")  
{  
$strSQL = "UPDATE customer SET ";  
$strSQL .="CustomerID = '".$_POST["txtEditCustomerID"]."' ";  
$strSQL .=",Name = '".$_POST["txtEditName"]."' ";  
$strSQL .=",Email = '".$_POST["txtEditEmail"]."' ";  
$strSQL .=",CountryCode = '".$_POST["txtEditCountryCode"]."' ";  
$strSQL .=",Budget = '".$_POST["txtEditBudget"]."' ";  
$strSQL .=",Used = '".$_POST["txtEditUsed"]."' ";  
$strSQL .="WHERE CustomerID = '".$_POST["hdnEditCustomerID"]."' ";  
$objQuery = mssql_query($strSQL);  
if(!$objQuery)  
{  
echo "Error Update [".mssql_error()."]";  
}  
//header("location:$_SERVER[PHP_SELF]");  
//exit();  
}  
  
//*** Delete Condition ***//  
if($_GET["Action"] == "Del")  
{  
$strSQL = "DELETE FROM customer ";  
$strSQL .="WHERE CustomerID = '".$_GET["CusID"]."' ";  
$objQuery = mssql_query($strSQL);  
if(!$objQuery)  
{  
echo "Error Delete [".mssql_error()."]";  
}  
//header("location:$_SERVER[PHP_SELF]");  
//exit();  
}  
  
$strSQL = "SELECT * FROM atn_transaction";  
$objQuery = mssql_query($strSQL) or die ("Error Query [".$strSQL."]");  
?>  
<form name="frmMain" method="post" action="<?=$_SERVER["PHP_SELF"];?>">  
<input type="hidden" name="hdnCmd" value="">  
<table width="600" border="1">  
<tr>  
<th width="91"> <div align="center">CustomerID </div></th>  
<th width="98"> <div align="center">Name </div></th>  
<th width="198"> <div align="center">Email </div></th>  
<th width="97"> <div align="center">CountryCode </div></th>  
<th width="59"> <div align="center">Budget </div></th>  
<th width="71"> <div align="center">Used </div></th>  
<th width="30"> <div align="center">Edit </div></th>  
<th width="30"> <div align="center">Delete </div></th>  
</tr>  
<?  
while($objResult = mssql_fetch_array($objQuery))  
{  
?>  
  
<?  
if($objResult["CustomerID"] == $_GET["CusID"] and $_GET["Action"] == "Edit")  
{  
?>  
<tr>  
<td><div align="center">  
<input type="text" name="txtEditCustomerID" size="5" value="<?=$objResult["CustomerID"];?>">  
<input type="hidden" name="hdnEditCustomerID" size="5" value="<?=$objResult["CustomerID"];?>">  
</div></td>  
<td><input type="text" name="txtEditName" size="20" value="<?=$objResult["Name"];?>"></td>  
<td><input type="text" name="txtEditEmail" size="20" value="<?=$objResult["Email"];?>"></td>  
<td><div align="center"><input type="text" name="txtEditCountryCode" size="2" value="<?=$objResult["CountryCode"];?>"></div></td>  
<td align="right"><input type="text" name="txtEditBudget" size="5" value="<?=$objResult["Budget"];?>"></td>  
<td align="right"><input type="text" name="txtEditUsed" size="5" value="<?=$objResult["Used"];?>"></td>  
<td colspan="2" align="right"><div align="center">  
<input name="btnAdd" type="button" id="btnUpdate" value="Update" OnClick="frmMain.hdnCmd.value='Update';frmMain.submit();">  
<input name="btnAdd" type="button" id="btnCancel" value="Cancel" OnClick="window.location='<?=$_SERVER["PHP_SELF"];?>';">  
</div></td>  
</tr>  
<?  
}  
else  
{  
?>  
<tr>  
<td><div align="center"><?=$objResult["CustomerID"];?></div></td>  
<td><?=$objResult["Name"];?></td>  
<td><?=$objResult["Email"];?></td>  
<td><div align="center"><?=$objResult["CountryCode"];?></div></td>  
<td align="right"><?=$objResult["Budget"];?></td>  
<td align="right"><?=$objResult["Used"];?></td>  
<td align="center"><a href="<?=$_SERVER["PHP_SELF"];?>?Action=Edit&CusID=<?=$objResult["CustomerID"];?>">Edit</a></td>  
<td align="center"><a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='<?=$_SERVER["PHP_SELF"];?>?Action=Del&CusID=<?=$objResult["CustomerID"];?>';}">Delete</a></td>  
</tr>  
<?  
}  
?>  
<?  
}  
?>  
<tr>  
<td><div align="center"><input type="text" name="txtAddCustomerID" size="5"></div></td>  
<td><input type="text" name="txtAddName" size="20"></td>  
<td><input type="text" name="txtAddEmail" size="20"></td>  
<td><div align="center"><input type="text" name="txtAddCountryCode" size="2"></div></td>  
<td align="right"><input type="text" name="txtAddBudget" size="5"></td>  
<td align="right"><input type="text" name="txtAddUsed" size="5"></td>  
<td colspan="2" align="right"><div align="center">  
<input name="btnAdd" type="button" id="btnAdd" value="Add" OnClick="frmMain.hdnCmd.value='Add';frmMain.submit();">  
</div></td>  
</tr>  
</table>  
</form>  
<?  
mssql_close($objConnect);  
?>  
</body>  
</html> 
