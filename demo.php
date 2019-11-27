<?php
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

	if (@$_GET['id']) {
		echo json_encode(uploadprogress_get_info($_GET['id']));
		exit();
	}
	
	$uuid = uniqid();
        
        if (@$_GET['per']!= null){
        $per=@$_GET['per'];
        }else{
            $per=100;
        }
        if (@$_GET['comma']!= null){
        $pieces = explode(",", @$_GET['comma']);
        $count=count($pieces);
        }else{
            $count=1;
        }
        
?>

<html>
	<head>


		<script type="text/javascript">
			var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
			document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
			</script>
			<script type="text/javascript">
			try {
			var pageTracker = _gat._getTracker("UA-1120774-3");
			pageTracker._trackPageview();
			} catch(err) {}
		</script>
		<script type="text/javascript" src="http://t.wits.sg/misc/js/jQuery/jquery.js"></script>
		<script type="text/javascript" src="http://t.wits.sg/misc/js/jQuery/chili/jquery.chili-2.2.js"></script>
		<script type="text/javascript"> 
			ChiliBook.recipeFolder = "../js/jQuery/chili/";  
		</script>
		<script type="text/javascript" src="js/jquery.progressbar.min.js"></script>
		<script>
			var progress_key = '<?= $uuid ?>';
                        var icount = 0;
                        var count="<?php echo $count; ?>"
                        var x=(100/count);
                        function Func(d){
                            $("#spaceused1").progressBar(d);
                            
                            
                        }
                        function doDelayLoop() {
                                        icount+=x; //increment icount

                                        if (icount < 100) {
                                                 setTimeout("Func("+icount+")",3000);
                                                 return true;
                                             //Func(icount);    
                                        }
                                        else{
                                                //$("#spaceused1").progressBar(100);
                                                return false;
                                }
                                //callback();
                        }
                        function Func1(){
                                window.close();    
                        }
                        
function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < milliseconds; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}


                        
                        
			$(document).ready(function() {

				$("#spaceused1").progressBar(0);
//                                var x=(100/count);
//                                for(var i=0; i < 100; i+=x){
//                                    setTimeout("Func("+i+")", 3000);
//
//                                }

                                });

$(this).load(function() {
                              for(var a=0; a < count; a++){
                          
                             sleep((count*3000));   
                            var d=doDelayLoop();
                            //alert(d);
                            if(d==true){
                                
                            }else{
                                 
                            }                          


                        }

                                setTimeout("Func1()", 5000); 
});
		</script>
		<style>
			table tr { vertical-align: top; }
			table td { padding: 3px; }
			div.contentblock { padding-bottom: 25px; }	
			#uploadprogressbar { display: none; }
		</style>
	</head>
	<body>
		<div id="container">
			
			<div class="contentblock">
				<table>
					<tr><td>Employee Payroll Process</td><td><span class="progressBar" id="spaceused1"><?php echo $per; ?>%</span></td></tr>
				</table>
			</div>

		<!-- http://localhost/1.2/demo.php?per=91 -->	
			
			
			
		</div>
	</body>
</html>
