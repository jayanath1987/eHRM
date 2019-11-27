<?php


session_start();
//print_r($_GET['id']);
//print_r($_GET['cid']);
$dbhost = "192.168.1.40"; // this will ususally be 'localhost', but can sometimes differ
$dbname = "ictahrmlive"; // the name of the database that you are going to use for this project
$dbuser = "root"; // the username that you created, or were given, to access your database
$dbpass = ""; // the password that you created, or were given, to access your database

mysql_connect($dbhost, $dbuser, $dbpass) or die("MySQL Error: " . mysql_error());
mysql_select_db($dbname) or die("MySQL Error: " . mysql_error()); ?>

<?php  $country = "SELECT a.*, b.*,e.emp_display_name
FROM  hs_hr_evl_ts_emp a
LEFT JOIN hs_hr_evl_ts_master b ON a.ts_id=b.ts_id 
LEFT JOIN hs_hr_employee e ON a.emp_number=e.emp_number 
where a.eval_id = ".$_GET['id']." AND a.emp_ts_active_flg = '1' AND a.emp_number = ".$_GET['emp']; 
        // print_r($country);       
                $result = mysql_query($country); ?>


<html>    
<head>
    <meta name="viewport" content="width=device-width, user-scalable=yes">
    <style >
        #divElement{
            position: absolute;
            top: 10%;
            left: 10%;
        }
        .content {
            width:auto;
            height:auto;
            font-family:Arial, Helvetica, sans-serif;
            font-size:12px;
            color:#666666;
            text-align:justify;
        }
    </style>
    <style type="text/css">
#star ul.star { LIST-STYLE: none; MARGIN: 0; PADDING: 0; WIDTH: 85px; HEIGHT: 20px; LEFT: 10px; TOP: -5px; POSITION: relative; FLOAT: left; BACKGROUND: url('media/stars.gif') repeat-x; CURSOR: pointer; }
#star li { PADDING: 0; MARGIN: 0; FLOAT: left; DISPLAY: block; WIDTH: 85px; HEIGHT: 20px; TEXT-DECORATION: none; text-indent: -9000px; Z-INDEX: 20; POSITION: absolute; PADDING: 0; }
#star li.curr { BACKGROUND: url('media/stars.gif') left 25px; FONT-SIZE: 1px; }
#star div.user { LEFT: 15px; POSITION: relative; FLOAT: left; FONT-SIZE: 13px; FONT-FAMILY: Arial; COLOR: #888; }
</style>
<script type="text/javascript">

/* AJAX Star Rating : v1.0.3 : 2008/05/06 */
/* http://www.nofunc.com/AJAX_Star_Rating/ */

function $(v,o) { return((typeof(o)=='object'?o:document).getElementById(v)); }
function $S(o) { return((typeof(o)=='object'?o:$(o)).style); }
function agent(v) { return(Math.max(navigator.userAgent.toLowerCase().indexOf(v),0)); }
function abPos(o) { var o=(typeof(o)=='object'?o:$(o)), z={X:0,Y:0}; while(o!=null) { z.X+=o.offsetLeft; z.Y+=o.offsetTop; o=o.offsetParent; }; return(z); }
function XY(e,v) { var o=agent('msie')?{'X':event.clientX+document.body.scrollLeft,'Y':event.clientY+document.body.scrollTop}:{'X':e.pageX,'Y':e.pageY}; return(v?o[v]:o); }

star={};

star.mouse=function(e,o) { if(star.stop || isNaN(star.stop)) { star.stop=0;
	
	document.onmousemove=function(e) { var n=star.num;
	
		var p=abPos($('star'+n)), x=XY(e), oX=x.X-p.X, oY=x.Y-p.Y; star.num=o.id.substr(4);

		if(oX<1 || oX>84 || oY<0 || oY>19) { star.stop=1; star.revert(); }
		
		else {

			$S('starCur'+n).width=oX+'px';
			$S('starUser'+n).color='#111';
			$('starUser'+n).innerHTML=Math.round(oX/84*100)+'%';
			
		}
	};
} };

star.update=function(e,o) { var n=star.num, v=parseInt($('starUser'+n).innerHTML);

	n=o.id.substr(4); $('starCur'+n).title=v;

	//req=new XMLHttpRequest(); req.open('GET','/AJAX_Star_Vote.php?vote='+(v/100),false); req.send(null);    

};

star.revert=function() { var n=star.num, v=parseInt($('starCur'+n).title);

	$S('starCur'+n).width=Math.round(v*84/100)+'px';
	$('starUser'+n).innerHTML=(v>0?Math.round(v)+'%':'');
	$('starUser'+n).style.color='#888';
	
	document.onmousemove='';

};

star.num=0;

</script>
</head>
    <body>
        <?php $field = mysql_fetch_assoc($result);  ?>
        <form id="frmSave" method="post" action="t.php">
        <div>
            <div id="divElement" style="width:80vw;height:62vh;-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;background: wheat; ">
                <div style="width:80vw;height:20vh; margin: 0 auto; " >  
                    <div style="width:10vw;height:10vh; display: inline-block; vertical-align: top;">
                    </div><div style="width:60vw;height:19vh; display: inline-block; vertical-align: top;">
                        <div style="text-align: center"><h3>360&deg; Performance Appraisal- ICTA</h3></div>
                        <div style="text-align: center" ><h4>Please spend few minutes to help improving the performance of the staff of ICTA.
                            Hope you would provide your sincere feedback by grading the performance of <?php echo $field['emp_display_name']; ?> based on the following criteria
                            </h4> </div>
                    </div><div style="width:10vw;height:10vh; display: inline-block; vertical-align: top;">
                    </div></div> 
                <div style="width:80vw;height:40vh; margin: 0 auto; background: sandybrown;" >  
                    <div style="width:60vw;height:40vh; display: inline-block; vertical-align: top; background: sandybrown; ">
                        
                       <br class="clear">    


<div id="star" style="width : 800px; vertical-align: top; margin: 0 auto;">
              <?php  
               $result1 = mysql_query($country);  
              while ( $db_field = mysql_fetch_assoc($result1)){
                  

                     ?>

    <div style="width : 300px; display: inline-block; vertical-align: top;"><?php echo $db_field['ts_title']; ?></div><div style="width : 200px; display: inline-block; vertical-align: top;">

 <ul id="star<?php echo $db_field['emp_ts_id']; ?>" class="star" onmousedown="star.update(event,this)" onmousemove="star.mouse(event,this)"  title="Rate This!">
  <li id="starCur<?php echo $db_field['emp_ts_id']; ?>" class="curr" title="0" style="width: 0px;"></li>
 </ul>
 <div style="color: rgb(136, 136, 136);" id="starUser<?php echo $db_field['emp_ts_id']; ?>" class="user" >0%</div>                 
       <input type="hidden" id="txt_<?php echo $db_field['emp_ts_id']; ?>" name="txt_<?php echo $db_field['emp_ts_id']; ?>" value="" >
    <input type="hidden" id="txt_emp_ts_id_[]" name="txt_emp_ts_id_[]" value="<?php echo $db_field['emp_ts_id']; ?>" 
     <br class="clear"> 
    
        </div>
    <br class="clear"> 
    <br class="clear"> 
<?php } ?>     
     
                      
                  
                  <input type="button" id="asubmit" value="Submit" onclick="send();">
                     <!--      -->   
                        </div> 
                    </div><div style="width:10vw;height:40vh; display: inline-block; vertical-align: top; background: sandybrown;"></div>
                <div style="width:80vw;height:14vh; margin: 0 auto; background: wheat; border-radius:0 0 19px 19px;" >  
                    <div style="width:10vw; height:10vh; display: inline-block; vertical-align: top;">
                        
                    </div><div style="width:60vw;height:10vh; display: inline-block; vertical-align: top;"><div align="center"><img src="images/logo.png" border="0"><!-- <img src="images/moduleTab_left.png" alt="ICTA" style="width:121px;height:41px; ">--></div><div align="center">Copyright 2013 Information and Communication Technology Agency of Sri Lanka. All rights reserved.</div> </div><div style="width:10vw;height:10vh; display: inline-block; vertical-align: top;"><br><img src="images/moduleTab_left.png" alt="ICTA" style="width:121px;height:41px; float:right;"></div>
                
                </div>
            </div>
            <input type="hidden" id="clientid" name="clientid" value="<?php echo $_GET['cid']; ?>" >
        </div>     
        </form>
    </body>
    
    <script type="text/javascript">

    
    function send(){
    var scriptAr = new Array();
    var error = 0;
    <?php
    $result = mysql_query($country);
    while ( $db_field = mysql_fetch_assoc($result)){ ?>
            
              var n = <?php echo $db_field['emp_ts_id']; ?>;
              
              var div1 = document.getElementById("starCur"+n);
              var align = div1.getAttribute("title");

              if(align == 0){
                  error++;
              }else{
                  document.getElementById("txt_"+n).setAttribute("value",align); 

              }
    <?php } ?>  
        if(error != 0){
            alert("Some points are missing");
        }else{
            document.getElementById('frmSave').submit();

        }

       
    }
    
    </script>
        
    
</html>

