<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery-ui.min.js') ?>"></script>
<link href="<?php echo public_path('../../themes/orange/css/jquery/jquery-ui.css') ?>" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<link href="../../themes/orange/css/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo public_path('../../scripts/time.js') ?>"></script>

<div class="formpage4col">
    <div class="navigation">
        <?php
        if (strlen($lvl)) {
        ?>
            <input type="button" class="backbutton" id="btnBack"
                   value="<?php echo __("Back") ?>" tabindex="10" />
               <?php
           }
           if ($lvl == 1) {
               $action1 = "incidents";
           } elseif ($lvl == 2) {
               $action1 = "Incidentlevel2Summery";
           }
               ?>

        
       </div>
       <div id="status"></div>
       <div class="outerbox">
           <div class="mainHeading"><h2><?php echo __("Incident Reporting") ?></h2></div>
           <?php echo message() ?>
           <form name="frmSave" id="frmSave" method="post"  action="">
               <div class="leftCol">
                   &nbsp;
               </div>
               <div class="centerCol">
                   <label class="languageBar"><?php echo __("English") ?></label>
               </div>
               <div class="centerCol">
                   <label class="languageBar"><?php echo __("Sinhala") ?></label>
               </div>
               <div class="centerCol">
                   <label class="languageBar"><?php echo __("Tamil") ?></label>
               </div>
               <br class="clear"/>
               <div class="leftCol">
                   <label class="controlLabel" for="txtLocationCode"><?php echo __("Reported Date") ?><span class="required">*</span></label>
               </div>
               <div class="centerCol">
                   <input type="text" class="formInputText" name="txtIncidentReportDate" id="txtIncidentReportDate" value="" />

               </div>
               <div class="leftCol">
                   <label class="controlLabel" for="txtLocationCode"><?php echo __("Reported Time") ?> </label>
               </div>

               <div class="centerCol">
                   <select name="cmbIncidentReportHH" id="cmbIncidentReportHH" class="formSelect" style="width: 50px;" tabindex="4">

                       <option value="-1"><?php echo __("HH") ?></option>
                       <option value="00"><?php echo __("00") ?></option>
                       <option value="01"><?php echo __("01") ?></option>
                       <option value="02"><?php echo __("02") ?></option>
                       <option value="03"><?php echo __("03") ?></option>
                       <option value="04"><?php echo __("04") ?></option>
                       <option value="05"><?php echo __("05") ?></option>
                       <option value="06"><?php echo __("06") ?></option>
                       <option value="07"><?php echo __("07") ?></option>
                       <option value="08"><?php echo __("08") ?></option>
                       <option value="09"><?php echo __("09") ?></option>
                       <option value="10"><?php echo __("10") ?></option>
                       <option value="11"><?php echo __("11") ?></option>
                       <option value="12"><?php echo __("12") ?></option>
                       <option value="13"><?php echo __("13") ?></option>
                       <option value="14"><?php echo __("14") ?></option>
                       <option value="15"><?php echo __("15") ?></option>
                       <option value="16"><?php echo __("16") ?></option>
                       <option value="17"><?php echo __("17") ?></option>
                       <option value="18"><?php echo __("18") ?></option>
                       <option value="19"><?php echo __("19") ?></option>
                       <option value="20"><?php echo __("20") ?></option>
                       <option value="21"><?php echo __("21") ?></option>
                       <option value="22"><?php echo __("22") ?></option>
                       <option value="23"><?php echo __("23") ?></option>
                       <option value="24"><?php echo __("24") ?></option>


                   </select>



                   <select name="cmbIncidentReportMM" id="cmbIncidentReportMM" class="formSelect" style="width: 50px;" tabindex="4">

                       <option value="-1"><?php echo __("MM") ?></option>
                       <option value="00"><?php echo __("00") ?></option>
                       <option value="05"><?php echo __("05") ?></option>
                       <option value="10"><?php echo __("10") ?></option>
                       <option value="15"><?php echo __("15") ?></option>
                       <option value="20"><?php echo __("20") ?></option>
                       <option value="25"><?php echo __("25") ?></option>
                       <option value="30"><?php echo __("30") ?></option>
                       <option value="35"><?php echo __("35") ?></option>
                       <option value="40"><?php echo __("40") ?></option>
                       <option value="45"><?php echo __("45") ?></option>
                       <option value="50"><?php echo __("50") ?></option>
                       <option value="55"><?php echo __("55") ?></option>


                   </select>
               </div>
               <br class="clear"/>


               <div class="leftCol">
                   <label class="controlLabel" for="txtLocationCode"><?php echo __("Incident From Date") ?><span class="required">*</span></label>
               </div>
               <div class="centerCol">
                   <input type="text" class="formInputText" name="txtIncidentDate" id="txtIncidentDate" value="" />

               </div>
               <div class="leftCol">
                   <label class="controlLabel" for="txtLocationCode"><?php echo __("Incident From Time") ?> </label>
               </div>

               <div class="centerCol">
                   <select name="cmbHH" id="cmbHH" class="formSelect" style="width: 50px;" tabindex="4">

                       <option value="-1"><?php echo __("HH") ?></option>
                       <option value="00"><?php echo __("00") ?></option>
                       <option value="01"><?php echo __("01") ?></option>
                       <option value="02"><?php echo __("02") ?></option>
                       <option value="03"><?php echo __("03") ?></option>
                       <option value="04"><?php echo __("04") ?></option>
                       <option value="05"><?php echo __("05") ?></option>
                       <option value="06"><?php echo __("06") ?></option>
                       <option value="07"><?php echo __("07") ?></option>
                       <option value="08"><?php echo __("08") ?></option>
                       <option value="09"><?php echo __("09") ?></option>
                       <option value="10"><?php echo __("10") ?></option>
                       <option value="11"><?php echo __("11") ?></option>
                       <option value="12"><?php echo __("12") ?></option>
                       <option value="13"><?php echo __("13") ?></option>
                       <option value="14"><?php echo __("14") ?></option>
                       <option value="15"><?php echo __("15") ?></option>
                       <option value="16"><?php echo __("16") ?></option>
                       <option value="17"><?php echo __("17") ?></option>
                       <option value="18"><?php echo __("18") ?></option>
                       <option value="19"><?php echo __("19") ?></option>
                       <option value="20"><?php echo __("20") ?></option>
                       <option value="21"><?php echo __("21") ?></option>
                       <option value="22"><?php echo __("22") ?></option>
                       <option value="23"><?php echo __("23") ?></option>
                       <option value="24"><?php echo __("24") ?></option>


                   </select>



                   <select name="cmbMM" id="cmbMM" class="formSelect" style="width: 50px;" tabindex="4">

                       <option value="-1"><?php echo __("MM") ?></option>
                       <option value="00"><?php echo __("00") ?></option>
                       <option value="05"><?php echo __("05") ?></option>
                       <option value="10"><?php echo __("10") ?></option>
                       <option value="15"><?php echo __("15") ?></option>
                       <option value="20"><?php echo __("20") ?></option>
                       <option value="25"><?php echo __("25") ?></option>
                       <option value="30"><?php echo __("30") ?></option>
                       <option value="35"><?php echo __("35") ?></option>
                       <option value="40"><?php echo __("40") ?></option>
                       <option value="45"><?php echo __("45") ?></option>
                       <option value="50"><?php echo __("50") ?></option>
                       <option value="55"><?php echo __("55") ?></option>


                   </select>
               </div>
               <br class="clear"/>
               <div class="leftCol">
                   <label class="controlLabel" for="txtLocationCode"><?php echo __("Incident To Date") ?><span class="required">*</span></label>
               </div>
               <div class="centerCol">
                   <input type="text" class="formInputText" name="txtIncidentToDate" id="txtIncidentToDate" value="" />

               </div>
               <div class="leftCol">
                   <label class="controlLabel" for="txtLocationCode"><?php echo __("Incident To Time") ?> </label>
               </div>

               <div class="centerCol">
                   <select name="cmbIncidentToHH" id="cmbIncidentToHH" class="formSelect" style="width: 50px;" tabindex="4">

                       <option value="-1"><?php echo __("HH") ?></option>
                       <option value="00"><?php echo __("00") ?></option>
                       <option value="01"><?php echo __("01") ?></option>
                       <option value="02"><?php echo __("02") ?></option>
                       <option value="03"><?php echo __("03") ?></option>
                       <option value="04"><?php echo __("04") ?></option>
                       <option value="05"><?php echo __("05") ?></option>
                       <option value="06"><?php echo __("06") ?></option>
                       <option value="07"><?php echo __("07") ?></option>
                       <option value="08"><?php echo __("08") ?></option>
                       <option value="09"><?php echo __("09") ?></option>
                       <option value="10"><?php echo __("10") ?></option>
                       <option value="11"><?php echo __("11") ?></option>
                       <option value="12"><?php echo __("12") ?></option>
                       <option value="13"><?php echo __("13") ?></option>
                       <option value="14"><?php echo __("14") ?></option>
                       <option value="15"><?php echo __("15") ?></option>
                       <option value="16"><?php echo __("16") ?></option>
                       <option value="17"><?php echo __("17") ?></option>
                       <option value="18"><?php echo __("18") ?></option>
                       <option value="19"><?php echo __("19") ?></option>
                       <option value="20"><?php echo __("20") ?></option>
                       <option value="21"><?php echo __("21") ?></option>
                       <option value="22"><?php echo __("22") ?></option>
                       <option value="23"><?php echo __("23") ?></option>
                       <option value="24"><?php echo __("24") ?></option>


                   </select>



                   <select name="cmbIncidentToMM" id="cmbIncidentToMM" class="formSelect" style="width: 50px;" tabindex="4">

                       <option value="-1"><?php echo __("MM") ?></option>
                       <option value="00"><?php echo __("00") ?></option>
                       <option value="05"><?php echo __("05") ?></option>
                       <option value="10"><?php echo __("10") ?></option>
                       <option value="15"><?php echo __("15") ?></option>
                       <option value="20"><?php echo __("20") ?></option>
                       <option value="25"><?php echo __("25") ?></option>
                       <option value="30"><?php echo __("30") ?></option>
                       <option value="35"><?php echo __("35") ?></option>
                       <option value="40"><?php echo __("40") ?></option>
                       <option value="45"><?php echo __("45") ?></option>
                       <option value="50"><?php echo __("50") ?></option>
                       <option value="55"><?php echo __("55") ?></option>


                   </select>
               </div>
               <br class="clear"/>




               <div class="leftCol">
                   <label class="controlLabel" for="txtLocationCode"><?php echo __("Incident Type") ?> <span class="required">*</span></label>
               </div>
               <div class="centerCol">
                   


                   <select name="cmbActiontype" id="cmbActiontype" class="formSelect" style="width: 150px;" tabindex="4" onchange="LoadOffence(this.value,scriptAr);">

                       <option value=""><?php echo __("--Select--") ?></option>
                    <?php foreach ($actiontypes as $types) {
 ?>
                        <option value="<?php echo $types->getDis_acttype_id() ?>" <?php if ($types->getDis_acttype_id() == $currentIncident->dis_acttype_id)
                                echo "selected" ?>><?php
                                if ($culture == 'en') {
                                    $abc = "getDis_acttype_name";
                                } else {
                                    $abc = "getDis_acttype_name_" . $culture;
                                } if ($types->$abc() == "")
                                    echo $types->getDis_acttype_name(); else
                                    echo $types->$abc();
                    ?></option>
<?php } ?>

                        </select>
                    </div>
                    <br class="clear"/>

                    <div class="leftCol">
                        <label class="controlLabel" for="txtLocationCode"><?php echo __("Incident Sub Type") ?> <span class="required">*</span></label>
                    </div>

                    <div class="centerCol" id="masterjkjk">
                <?php
                            if (strlen($offenceList)) {

                                echo $sf_data->getRaw('offenceList');
                            }
                ?>
                        </div>
                        <br class="clear"/>
                        <div class="leftCol">
                            <label class="controlLabel" for="txtLocationCode"><?php echo __("Incident") ?> <span class="required">*</span></label>
                        </div>
                        <div class="centerCol">
                            <textarea class="formTextArea" id="txtIncident"  name="txtIncident" rows="8" cols="25"></textarea>
                        </div>
                        <div class="centerCol">
                            <textarea class="formTextArea" id="txtIncidentSi"  name="txtIncidentSi" rows="8" cols="25"></textarea>
                        </div>
                        <div class="centerCol">
                            <textarea class="formTextArea" id="txtIncidentTa"  name="txtIncidentTa" rows="8" cols="25"></textarea>
                        </div>
                        <br class="clear"/>

                        <div class="leftCol">
                            <label class="controlLabel" for="txtLocationCode"><?php echo __("Employee Involved") ?> <span class="required">*</span></label>
                        </div>
                        <div class="centerCol">

                        </div>
                        <div id="employeeGrid" class="centerCol" style="margin-left:10px; margin-top: 8px; width: 610px; border-style:  solid; border-color: #FAD163">
                            <div style="background-color:#FAD163; vertical-align: top;">

                                <label class="languageBar" style="width:610px;padding-left:2px; margin-bottom: 0px; padding-top:2px;padding-bottom: 1px; background-color:#FAD163; margin-top: 0px;  color:#444444;">




                                    <div style="width:85px; display:inline-block; vertical-align: top;"><?php echo __("Employee No") ?></div>

                                    <div style="width:100px; display:inline-block; vertical-align: top;"><?php echo __("Employee NIC") ?></div>

                                    <div style="width:140px; display:inline-block; vertical-align: top;"><?php echo __("Employee Name") ?></div>


                                    <div style="width:100px; display:inline-block; vertical-align: top;"><?php echo __("Designation") ?></div>


                                    <div style="width:110px; display:inline-block; vertical-align: top;"><?php echo __("Division") ?></div>

                                    <div style="width:95px; display:inline-block; vertical-align: top;"></div>
                                </label>


                            </div>
                            <br class="clear"/>
                            <div id="master">

                            </div>
                            <br class="clear"/>
                        </div>

                        <br class="clear"/>
                        <br class="clear"/>

                        <div class="formbuttons">
                            <input type="button" class="savebutton" id="editBtn"

                                   value="<?php echo __("Save") ?>" tabindex="8" />
                            <input type="button" class="clearbutton"  id="resetBtn"
                                   value="<?php echo __("Reset") ?>" tabindex="9" />
                            <input type="button" class="savebutton" id="empAddPopBtn" value="<?php echo __("Add Employee") ?>" tabindex="8" <?php echo $disabled; ?>/>
                        </div>
                    </form>
                </div>

            </div>
            <div class="requirednotice"><?php echo __("Fields marked with an asterisk") ?><span class="required"> * </span> <?php echo __("are required") ?></div>
<?php
                            require_once '../../lib/common/LocaleUtil.php';
                            $sysConf = OrangeConfig::getInstance()->getSysConf();
                            $sysConf = new sysConf();
                            $inputDate = $sysConf->dateInputHint;
                            $format = LocaleUtil::convertToXpDateFormat($sysConf->getDateFormat());
?>
  <?php $e = getdate();
$today = date("Y-m-d", $e[0]); 
?>                          <script type="text/javascript">
                                var scriptAr= new Array();
                                var myArray2= new Array();
                                var i=0;

                                function LoadOffence(id,offList){

                                    var atype=$('#cmbActiontype').val();


                                    if(atype!=""){
                                        $.post(

                                        "<?php echo url_for('disciplinary/Loadoffence') ?>", //Ajax file

                                        { atype : atype, offList : offList },  // create an object will all values

                                        //function that is called when server returns a value.
                                        function(data){



                                            $('#masterjkjk').html(data.List);




                                        },
                                        "json"

                                    );
                                    }
                                }
                                function SelectEmployee(data){
                                    //alert(data);

                                    myArr = data.split('|');
                                    $("#txtReportedEmpId").val(myArr[0]);
                                    $("#txtEmpname").val(myArr[1]);
                                }
                                var answer=0;
                                function deleteCRow(id,value){

                                    answer = confirm("<?php echo __("Do you really want to Delete?") ?>");

                                    if (answer !=0)
                                    {

                                        $("#row_"+id).remove();
                                        removeByValue(myArray2, value);

                                        i--;

                                    }
                                    else{
                                        return false;
                                    }

                                }
                                function removeByValue(arr, val) {
                                    for(var i=0; i<arr.length; i++) {
                                        if(arr[i] == val) {

                                            arr.splice(i, 1);

                                            break;

                                        }
                                    }
                                }

                                function SelectEmployeeAdd(data){

                                    myArr=new Array();
                                    lol=new Array();
                                    myArr = data.split('|');


                                    addtoGrid(myArr);
                                }

                                function addtoGrid(empid){


                                    var arraycp=new Array();

                                    var arraycp = $.merge([], myArray2);

                                    var items= new Array();
                                    for(i=0;i<empid.length;i++){

                                        items[i]=empid[i];
                                    }

                                    var u=1;

                                    $.each(items,function(key, value){


                                        if(jQuery.inArray(value, arraycp)!=-1)
                                        {

                                            // ie of array index find bug sloved here//
                                            if(!Array.indexOf){
                                                Array.prototype.indexOf = function(obj){
                                                    for(var i=0; i<this.length; i++){
                                                        if(this[i]==obj){
                                                            return i;
                                                        }
                                                    }
                                                    return -1;
                                                }
                                            }

                                            var idx = arraycp.indexOf(value);

                                            if(idx!=-1) arraycp.splice(idx, 1); // Remove it if really found!


                                            u=0;

                                        }
                                        else{

                                            arraycp.push(value);




                                        }


                                    }


                                );

                                    $.each(myArray2,function(key, value){
                                    

                                        if(jQuery.inArray(value, arraycp)!=-1)
                                        {

                                            // ie of array index find bug sloved here//
                                            if(!Array.indexOf){
                                                Array.prototype.indexOf = function(obj){
                                                    for(var i=0; i<this.length; i++){
                                                        if(this[i]==obj){
                                                            return i;
                                                        }
                                                    }
                                                    return -1;
                                                }
                                            }

                                            var idx = arraycp.indexOf(value); // Find the index
                                            if(idx!=-1) arraycp.splice(idx, 1); // Remove it if really found!

                                            u=0;


                                        }
                                        else{






                                        }


                                    }


                                );
                                    $.each(arraycp,function(key, value){
                                        myArray2.push(value);
                                    }


                                );

                                    if(u==0){

                                    }
                                    var courseId1=$('#courseid').val();
                                    $.post(

                                    "<?php echo url_for('disciplinary/LoadGrid') ?>", //Ajax file



                                    { 'empid[]' : arraycp },  // create an object will all values

                                    //function that is c    alled when server returns a value.
                                    function(data){

                                        var childDiv="";
                                        var testDiv="";
                                        var participated="";
                                        var testDiv="";
                                        var approved="";
                                        var comment="";
                                        var delete1="";
                                        var rowstart="";
                                        var rowend="";
                                        var childdiv="";


                                        $.each(data, function(key, value) {
                                            i=i+1;

                                            var word=value.split("|");
                                            
                                            childdiv="<div id='row_"+i+"' style='padding-top:0px; '>";
                                            childdiv+="<div class='centerCol' id='master' style='width:90px;'>";
                                            childdiv+="<div id='employeename'  style='height:35px; padding-left:5px; padding-bottom:5px;'>"+word[0]+"</div>";
                                            childdiv+="</div>";

                                            childdiv+="<div class='centerCol' id='master' style='width:100px;'>";
                                            childdiv+="<div id='employeename' style='height:35px; padding-bottom:5px;'>"+word[5]+"</div>";
                                            childdiv+="</div>";

                                            childdiv+="<div class='centerCol' id='master' style='width:150px;'>";
                                            childdiv+="<div id='employeename' style='height:35px; padding-bottom:5px;'>"+word[1]+"</div>";
                                            childdiv+="</div>";
                                            childdiv+="<div class='centerCol' id='master' style='width:100px;'>";
                                            childdiv+="<div id='employeename' style='height:35px; padding-bottom:5px;'>"+word[2]+"</div>";
                                            childdiv+="</div>";



                                            childdiv+="<div class='centerCol' id='master' style='width:110px;'>";
                                            childdiv+="<div id='employeename' style='height:35px; padding-bottom:5px;'>"+word[3]+"</div>";
                                            childdiv+="<div id='employeename' style=' padding-bottom:5px;'><input type='hidden' name='hiddenEmpNumber[]' value="+word[4]+" /></div>";

                                            childdiv+="</div>";
                                            childdiv+="<div class='centerCol' id='master' style='width:20px;'>";
                                            childdiv+="<div id='employeename' style='height:35px; padding-bottom:5px;'><a href='#'  onclick='deleteCRow("+i+","+word[4]+")'><?php echo __('Delete') ?></a></div>";
                                            childdiv+="</div>";

                                            childdiv+="</div>";

                                            $('#employeeGrid').append(childdiv);

                                            $('#hiddeni').val(i);

                                        });



                                    },

                                    //How you want the data formated when it is returned from the server.
                                    "json"

                                );


                                }


                                $(document).ready(function() {

                                    buttonSecurityCommon(null,"editBtn",null,null);


                                    $('#empAddPopBtn').click(function() {

                                        var popup=window.open('<?php echo public_path('../../symfony/web/index.php/pim/searchEmployee?type=multiple&method=SelectEmployeeAdd'); ?>','Locations','height=450,width=800,resizable=1,scrollbars=1');


                                        if(!popup.opener) popup.opener=self;
                                        popup.focus();
                                    });


                                    $("#txtIncidentDate").datepicker({ dateFormat: '<?php echo $inputDate; ?>' });
                                    $("#txtIncidentToDate").datepicker({ dateFormat: '<?php echo $inputDate; ?>' });
                                    $("#txtIncidentReportDate").datepicker({ dateFormat: '<?php echo $inputDate; ?>' });

                                    $('#empRepPopBtn').click(function() {

                                        var popup=window.open('<?php echo public_path('../../symfony/web/index.php/pim/searchEmployee?type=single&method=SelectEmployee'); ?>','Locations','height=450,width=800,resizable=1,scrollbars=1');

                                        //var popup=window.open('<?php echo public_path('../../templates/hrfunct/emppop.php?reqcode=REP&Disp=1'); ?>','Locations','height=450,width=800,resizable=1,scrollbars=1');
                                        if(!popup.opener) popup.opener=self;
                                        popup.focus();
                                    });
                                       jQuery.validator.addMethod("reportDateValidate",
                                                            function(value, element) {

                                                                
                                                                var format = '<?php echo $format; ?>';
                                                                var reportedDate = strToDate($('#txtIncidentReportDate').val(), format)
                                                                var fromdate = strToDate($('#txtIncidentDate').val(), format);
                                                                if (reportedDate && fromdate && (fromdate > reportedDate)) {
                                                                    return false;
                                                                }

                                                                return true;
                                                            }, ""
                                                        );

                                    $("#frmSave").validate({

                                        rules: {
                                            txtIncidentReportDate: {reportDateValidate:true,required: true,orange_date: function(){ return ['<?php echo $dateHint; ?>','<?php echo $format; ?>']}},
                                            txtIncidentDate: {required: true,orange_date: function(){ return ['<?php echo $dateHint; ?>','<?php echo $format; ?>']}},
                                            txtIncidentToDate: {required: true,orange_date: function(){ return ['<?php echo $dateHint; ?>','<?php echo $format; ?>']}},
                                            txtReportedEmpId: { required: true},
                                            txtIncident: {maxlength: 200,noSpecialCharsOnly: true},
                                            txtIncidentSi: {maxlength: 200,noSpecialCharsOnly: true},
                                            txtIncidentTa: {maxlength: 200,noSpecialCharsOnly: true},
                                            txtEmpname:{maxlength: 75,noSpecialCharsOnly: true}




                                        },
                                        messages: {
                                            txtIncidentReportDate: {reportDateValidate:"<?php echo __('Incident reported date should be greater than to from date') ?>",required: "<?php echo __('This field is required') ?>",orange_date: '<?php echo __("Invalid date."); ?>'},
                                            txtIncidentDate: {required: "<?php echo __('This field is required') ?>",orange_date: '<?php echo __("Invalid date."); ?>'},
                                            txtIncidentToDate: {required: "<?php echo __('This field is required') ?>",orange_date: '<?php echo __("Invalid date."); ?>'},
                                            txtReportedEmpId:{required: "<?php echo __('This field is required') ?>"},
                                            txtIncident: {noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>",maxlength: "<?php echo __('Maximum length should be 200 characters') ?>"},
                                            txtIncidentSi: {maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                                            txtIncidentTa: {maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                                            txtEmpname: {maxlength: "<?php echo __('Maximum length should be 75 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"}


                                        },
                                        errorClass: "errortd",
                                        submitHandler: function(form) {
                                            $('#editBtn').unbind('click').click(function() {return false}).val("<?php echo __('Wait..'); ?>");
                                            form.submit();
                                        }
                                    });

                                    var mode	=	'save';

                                    //Disable all fields

                                    $("#editBtn").click(function() {

                                        if( mode == 'edit')
                                        {


                                            $('#editBtn').attr('value', '<?php echo __("Save") ?>');
                                            $('#frmSave :input').removeAttr('disabled');
                                            mode = 'save';

                                        }
                                        else
                                        {
                                            
                                            if($('#txtIncidentReportDate').val()==""){
                                                alert("<?php echo __("Reported Date can not be empty.") ?>");
                                              return false;
                                            }
                                            if($('#txtIncidentDate').val()==""){
                                                alert("<?php echo __("Incident From Date can not be empty.") ?>");
                                              return false;
                                            }
                                            if($('#txtIncidentToDate').val()==""){
                                                alert("<?php echo __("Incident To Date can not be empty.") ?>");
                                              return false;
                                            }
                                            

                                            if($("#txtIncidentDate").val() > $("#txtIncidentToDate").val()){
                                                alert("<?php echo __('Invalid Incident Date Range') ?>");
                                                return false;
                                            }
                                            var n = $("input[name='checkList[]']:checked").length;


                                            if(!n>0){
                                                alert("<?php echo __("Incident type and Incident sub type should be selected.") ?>");
                                                return false;

                                            }
                                            if($("#cmbActiontype").val()==''){
                                               alert("<?php echo __("Incident type is required.") ?>");
                                                return false; 
                                            }

                                            
                                            
                                            if($('#txtIncidentReportDate').val()>'<?php echo $today; ?>'){
                                              alert("<?php echo __("Reported Date can not be future Date.") ?>");
                                              return false;
                                          }
                                          if($('#txtIncidentDate').val()>'<?php echo $today; ?>'){
                                              alert("<?php echo __("Incident From Date can not be future Date.") ?>");
                                              return false;
                                          }
                                          if($('#txtIncidentToDate').val()>'<?php echo $today; ?>'){
                                              alert("<?php echo __("Incident To Date can not be future Date.") ?>");
                                              return false;
                                          }
                                          if(!trim($('#txtIncident').val())){
                                              alert("<?php echo __("Please Enter the incident") ?>");
                                              return false;
                                          }

                                          var emp=0
                                          for(var j=0; j<1000; j++ ){
                                          if($("#row_"+j).length>0){ 
                                                
                                                emp++;
                                          }
                                          }
                                          if(emp > 0){                                           
                                                $('#frmSave').submit();
                                              }else{
                                                alert("<?php echo __('Please Select at least one employee') ?>");
                                                return false;
                                            }
                                          
                                          
                                        }
                                    });

                                    //When click reset buton
                                    $("#resetBtn").click(function() {
                                        document.forms[0].reset('');
                                    });

                                    //When Click back button
                                    $("#btnBack").click(function() {
                                        location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/' . $action1)) ?>";
        });

    });
</script>

