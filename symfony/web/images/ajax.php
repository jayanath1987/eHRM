<?php

//Get Post Variables. The name is the same as
//what was in the object that was sent in the jQuery
$_POST['sendValue']=1;
if (isset($_POST['sendValue'])){
    $value = $_POST['sendValue'];
    $conn = mysql_connect('localhost', 'root' ,"hsenidsoft");

$db=mysql_select_db('hr_commonhrm');


$query="SELECT *
FROM hs_hr_employee e
LEFT JOIN hs_hr_compstructtree c ON e.work_station = c.id
WHERE e.emp_number ='$value'
LIMIT 0 , 30";


$result=mysql_query($query);

$row=mysql_fetch_assoc($result);
$currentdep=$row['title'];
$id=$row['work_station'];
$myval="";

function get_path($node) {
   // look up the parent of this node
   $result = mysql_query("SELECT parnt,title FROM hs_hr_compstructtree WHERE id='$node'");

   $row = mysql_fetch_array($result);

   // save the path in this array
   $path = array();

   // only continue if this $node isn't the root node
   // (that's the node with no parent)
   if ($row['parnt']!=0) {
       // the last part of the path to $node, is the name
       // of the parent of $node
       $path[] = $row['title'];

       // we should add the path to the parent of this node
       // to the path
       $path = array_merge(get_path($row['parnt']), $path);
   }

   // return the path
   return $path;
}

$myarry=get_path($id);


foreach ($myarry as $ar){
    $myval.=$ar."->";
}

}else{

}

//Because we want to use json, we have to place things in an array and encode it for json.
//This will give us a nice javascript object on the front side.
echo json_encode(array("returnValue"=>$currentdep,"id"=>$id,"myval"=>$myval));
//echo $_SESSION[];

?>