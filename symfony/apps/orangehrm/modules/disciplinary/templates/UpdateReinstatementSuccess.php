<?php
if ($lockMode == '1') {
    $editMode = false;
    $disabled = '';
} else {
    $editMode = true;
    $disabled = 'disabled="disabled"';
}
    $sysConf = OrangeConfig::getInstance()->getSysConf();
    $inputDate = $sysConf->getDateInputHint();
    $dateDisplayHint = $sysConf->dateDisplayHint;
    $format = LocaleUtil::convertToXpDateFormat($sysConf->getDateFormat());
        $encrypt = new EncryptionHandler();
?>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery-ui.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/time.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery.placeholder.js') ?>"></script>

<div class="formpage4col" >
    <div class="navigation">
        <style type="text/css">
        div.formpage4col input[type="text"]{
            width: 180px;
        }
        </style>

    </div>
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Reinstatement") ?></h2></div>
            <?php echo message() ?>
            <?php echo $form['_csrf_token']; ?>
        <form name="frmSave" id="frmSave" method="post"  action="">
            <div class="leftCol">
                &nbsp;
            </div>
            
            <br class="clear"/>
                        <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Employee Name") ?> <span class="required">*</span>
                </label>
            </div>
            <div class="centerCol"  style="width:300px">
                <input type="text" class="formInputText" name="txtEmployeeName"  id="txtEmployee" value="" readonly="readonly"  style="color: #222222"/>&nbsp;&nbsp;

                <input type="hidden" name="txtEmpId" id="txtEmpId" value=""/>
                <?php if($update!="Update"){ ?>
                <input class="button" style="margin-top: 7px;"type="button" value="..." id="empRepPopBtn" name="empRepPopBtn" <?php //echo $disabled; ?> />
                <?php } ?>
            </div>
            <br class="clear"/>       
             <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("Employee Number") ?></label>
            </div>
            <div class="centerCol">
                <input id="txtEmployeeNumber" type="text"  name="txtEmployeeNumber" readonly="readonly" style="color: #222222; margin-top: 10px; cursor:none;"  class="formInputText" value="<?php //echo $OtherInstitute->oth_institute_name; ?>" />
            </div>
            <br class="clear"/>
            
            <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("EPF Number") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <input id="txtEPF"  name="txtEPF" type="text"  class="formInputText" value="<?php echo $Reinstatement->emp_epf_number; ?>" maxlength="25" />
            </div>
            <br class="clear"/> 
             <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("Reinstatement Date") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <input id="txtReinstatementDate"  name="txtReinstatementDate" type="text"  class="formInputText" value="<?php echo $Reinstatement->rei_date ; ?>" maxlength="200" />
            </div>
            <br class="clear"/> 
            
            <div class="leftCol"> <label class="controlLabel" for="lbldesg"><?php echo __("Designation") ?><span class="required">*</span></label></div>
                    <div class="centerCol">
                    <select id="cmbDesg" name="cmbDesg" class="formSelect" style="width: 150px;height: 17px;margin-top: 8px;" <?php echo $disabled; ?>>
                        <option value=""><?php echo __("--Select--") ?></option>
                        <?php foreach ($desgnation as $desc) {
                        ?>
                            <option value="<?php echo $desc->getJobtit_code() ?>" <?php if($desc->getJobtit_code()==$Reinstatement->job_title_code ){ echo "selected=selected"; } ?>><?php

                            if ($myCulture == 'en') {
                                $abcd = "getJobtit_name";
                            } else {
                                $abcd = "getJobtit_name_" . $myCulture;
                            }
                            if ($desc->$abcd() == "") {
                                echo $desc->getJobtit_name();
                            } else {
                                echo $desc->$abcd();
                            }
                        ?></option>
                        <?php } ?>
                    </select>
                    </div>    
                    <br class="clear"/>
            
            <div class="leftCol"> <label class="controlLabel" ><?php echo __("Grade") ?><span class="required">*</span></label></div>
                    <div class="centerCol">
                    <select name="cmbGrade" class="formSelect" style="width: 150px;height: 17px;margin-top: 8px;" onchange="LoadGradeSlot(this.value);" <?php echo $disabled; ?>>
                        <option value=""><?php echo __("--Select--") ?></option>
                        <?php foreach ($Grade as $GradeDetail) {
                        ?>
                            <option value="<?php echo $GradeDetail->grade_code ?>"<?php if($GradeDetail->grade_code==$Reinstatement->grade_code ){ echo "selected=selected"; } ?>><?php
                            if ($myCulture == 'en') {
                                $abcd = "grade_name";
                            } else {
                                $abcd = "grade_name_" . $myCulture;
                            }
                            if ($GradeDetail->$abcd == "") {
                                echo $GradeDetail->grade_name;
                            } else {
                                echo $GradeDetail->$abcd;
                            }
                        ?></option>
                        <?php } ?>
                    </select>
                    </div>    
                    <br class="clear"/>

                    <div class="leftCol"> <label class="controlLabel" ><?php echo __("Grade Slot") ?><span class="required">*</span></label></div>
                    <div class="centerCol" id="cmbGradeSlotDiv">
                    <select id="cmbGradeSlot" name="cmbGradeSlot" class="formSelect" style="width: 150px;height: 17px;margin-top: 8px;" <?php echo $disabled; ?> >
                        <option value=""><?php echo __("--Select--") ?></option>

                    </select>
                    </div>    
                    <br class="clear"/>
            
            <input type="hidden" name="txtReinstatementID" id="txtReinstatementID" value="<?php echo $Reinstatement->rei_id; ?>"/>
            

             <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("Reason") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <input id="txtReason"  name="txtReason" type="text"  class="formInputText" value="<?php echo $Reinstatement->rei_reason; ?>" maxlength="200" />
            </div>
            <br class="clear"/>            
                    <div class="leftCol"> <label class="controlLabel" for="transfertypecombo"><?php echo __("Work Station") ?><span class="required">*</span></label></div>
                    <div class="leftCol" style="padding-top: 4px">  <input class="button" type="button"  onclick="returnLocDet1()" value="..." id="divisionPopBtn" <?php echo $disabled; ?> />
                    <label for="txtLocation" style="width: 2px;">
                      <input type="hidden" value="" class="formInputText" name="txtNWorkStaion" id="txtNWorkStaion" value="<?php echo $Reinstatement->work_station; ?>" />    
                    </label>
                        </div><br class="clear">

                    <div id="Display2" style="width: 100px;">
                    </div>

            <br class="clear"/>
            <br class="clear"/>
        <div class="formbuttons">
            <input type="button" class="<?php echo $editMode ? 'editbutton' : 'savebutton'; ?>" name="EditMain" id="editBtn"
                   value="<?php echo $editMode ? __("Edit") : __("Save"); ?>"
                   title="<?php echo $editMode ? __("Edit") : __("Save"); ?>"
                   onmouseover="moverButton(this);" onmouseout="moutButton(this);"/>
            <input type="reset" class="clearbutton" id="btnClear" tabindex="5"
                   onmouseover="moverButton(this);" onmouseout="moutButton(this);"	<?php echo $disabled; ?>
                   value="<?php echo __("Reset"); ?>" />
            <input type="button" class="backbutton" id="btnBack"
                   value="<?php echo __("Back") ?>" tabindex="18"  onclick="goBack();"/>
        </div>
        </form>
    </div>
    <div class="requirednotice"><?php echo __("Fields marked with an asterisk") ?><span class="required"> * </span> <?php echo __("are required") ?></div>
    <br class="clear" />
</div>


<script type="text/javascript">
  function returnLocDet1(){

            // TODO: Point to converted location popup
            var popup=window.open('<?php echo public_path('../../symfony/web/index.php/admin/listCompanyStructure?mode=select_subunit&method=mymethod'); ?>','Locations','height=450,resizable=1,scrollbars=1');
            if(!popup.opener) popup.opener=self;
        }
        function mymethod(id,name){
            //$("#txtDivisionid").val(id);
            $("#txtNWorkStaion").val(id);
            DisplayEmpHirache(id,"Display2");
        }
  
  function SelectEmployee(data){
                                
                                myArr = data.split('|');
                                $("#txtEmpId").val(myArr[0]);
                                $("#txtEmployee").val(myArr[1]);
                                sendValue(myArr[0]);
                            }
                            
                            function sendValue(str){
                                $.post(

                                "<?php echo url_for('disciplinary/AjaxCall') ?>",  //Ajax file

                                { sendValue: str },  // create an object will all values

                                //function that is called when server returns a value.
                                function(data){ 
                                    $("#txtE").val(data.returnValue);
                                    $("#txtEPF").val(data.EPFNo);
                                    $("#txtempcdev").val(data.empcdev);
                                    $("#txtEmployeeNumber").val(data.EmpNumber);
                                    //DisplayEmpHirache(data.Workstation,"Display1");

                                },

                                //How you want the data formated when it is returned from the server.
                                "json"
                            );

                            }
                            
                            function LoadGradeSlot(id){

                                $.ajax({
                                    type: "POST",
                                    async:false,
                                    url: "<?php echo url_for('disciplinary/LoadGradeSlot') ?>",
                                    data: { id: id },
                                    dataType: "json",
                                     success: function(data){

                                     var selectbox="<select class='formSelect' id='cmbGradeSlot' name='cmbGradeSlot' style='width: 150px;'";
                                    selectbox=selectbox +'<?php echo $disabled; ?>';
                                     selectbox=selectbox +"><option value=''>"+"<?php echo __('--Select--'); ?>"+"</option>";
                                    $.each(data, function(key, value) {
                                        var word=value.split("|");
                                        var sltid="<?php echo $Reinstatement->slt_id; ?>";
                                        selectbox=selectbox +"<option value='"+word[4]+"'";
                                        if(word[4]== sltid){
                                          selectbox=selectbox +"selected=selected";  
                                        }
                                        selectbox=selectbox +">"+word[1]+" -- "+word[3]+"</option>";
                                    });
                                    selectbox=selectbox +"</select>";

                                   $('#cmbGradeSlotDiv').html(selectbox);
                                      }
                                });
                                }
                            
                            
                            function DisplayEmpHirache(wst,div){
                                                        $('#'+div).val("");
                                                        var wst;
                                                        $.ajax({
                                                            type: "POST",
                                                            async:false,
                                                            url: "<?php echo url_for('disciplinary/DisplayEmpHirache') ?>",
                                                            data: { wst: wst },
                                                            dataType: "json",
                                                            success: function(data){
                                                                var row="<table style='background-color:#FAF8CC; width:350px; boder:1'>";
                                                                var temp=0;
                                                                if(data.name10 !=null){
                                                                    row+="<tr ><td style='width:300px'>"+data.nameLevel10+"-"+data.name10+"</td></tr>";
                                                                    temp=1;}
                                                                if(data.name9 !=null){
                                                                    row+="<tr><td >";
                                                                    if(temp==1){
                                                                        row+="<label class='lbllevel' style='width:50px;'>"+data.nameLevel9+"</label>-&nbsp;<img src='<?php echo public_path('../../themes/beyondT/icons/arrow.gif') ?>' border='0' alt='add' />";
                                                                    }
                                                                    row+=data.name9+"</td></tr>";
                                                                    temp=1;
                                                                }
                                                                if(data.name8 !=null){
                                                                    row+="<tr><td >";
                                                                    if(temp==1){
                                                                        row+="<label class='lbllevel' style='width:50px;'>"+data.nameLevel8+"</label>-&nbsp;&nbsp;<img src='<?php echo public_path('../../themes/beyondT/icons/arrow.gif') ?>' border='0' alt='add' />";
                                                                    }
                                                                    row+=data.name8+"</td></tr>";
                                                                    temp=1;
                                                                }
                                                                if(data.name7 !=null){
                                                                    row+="<tr><td >";
                                                                    if(temp==1){
                                                                        row+="<label class='lbllevel' style='width:50px;'>"+data.nameLevel7+"</label>-&nbsp;&nbsp;&nbsp;<img src='<?php echo public_path('../../themes/beyondT/icons/arrow.gif') ?>' border='0' alt='add' />";
                                                                    }
                                                                    row+=data.name7+"</td></tr>";
                                                                    temp=1;
                                                                }
                                                                if(data.name6 !=null){
                                                                    row+="<tr><td >";
                                                                    if(temp==1){
                                                                        row+="<label class='lbllevel' style='width:50px;'>"+data.nameLevel6+"</label>-&nbsp;&nbsp;&nbsp;&nbsp;<img src='<?php echo public_path('../../themes/beyondT/icons/arrow.gif') ?>' border='0' alt='add' />";
                                                                    }
                                                                    row+=data.name6+"</td></tr>";
                                                                    temp=1;
                                                                }
                                                                if(data.name5 !=null){
                                                                    row+="<tr><td >";
                                                                    if(temp==1){
                                                                        row+="<label class='lbllevel' style='width:50px;'>"+data.nameLevel5+"</label>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='<?php echo public_path('../../themes/beyondT/icons/arrow.gif') ?>' border='0' alt='add' />";
                                                                    }
                                                                    row+=data.name5+"</td></tr>";
                                                                    temp=1;
                                                                }
                                                                if(data.name4 !=null){
                                                                    row+="<tr><td >";
                                                                    if(temp==1){
                                                                        row+="<label class='lbllevel' style='width:50px;'>"+data.nameLevel4+"</label>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='<?php echo public_path('../../themes/beyondT/icons/arrow.gif') ?>' border='0' alt='add' />";
                                                                    }
                                                                    row+=data.name4+"</td></tr>";
                                                                    temp=1;
                                                                }
                                                                if(data.name3 !=null){
                                                                    row+="<tr><td >";
                                                                    if(temp==1){
                                                                        row+="<label class='lbllevel' style='width:50px;'>"+data.nameLevel3+"</label>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='<?php echo public_path('../../themes/beyondT/icons/arrow.gif') ?>' border='0' alt='add' />";
                                                                    }
                                                                    row+=data.name3+"</td></tr>";
                                                                    temp=1;
                                                                }
                                                                if(data.name2 !=null){
                                                                    row+="<tr><td >";
                                                                    if(temp==1){
                                                                        row+="<label class='lbllevel' style='width:50px;'>"+data.nameLevel2+"</label>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='<?php echo public_path('../../themes/beyondT/icons/arrow.gif') ?>' border='0' alt='add' />";
                                                                    }
                                                                    row+=data.name2+"</td></tr>";
                                                                    temp=1;
                                                                }
                                                                if(data.name1 !=null){
                                                                    row+="<tr><td >";
                                                                    if(temp==1){
                                                                        row+="<label class='lbllevel' style='width:50px;'>"+data.nameLevel1+"</label>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='<?php echo public_path('../../themes/beyondT/icons/arrow.gif') ?>' border='0' alt='add' />";
                                                                    }
                                                                    row+=data.name1+"</td></tr>";
                                                                    temp=1;
                                                                }

                                                                row+="</table>";
                                                                $('#'+div).html(row);
                                                            }
                                                        });



                                                    }
                            
    $(document).ready(function() {
        buttonSecurityCommon("null","null","editBtn","null");
        
                  $("#txtReinstatementDate").datepicker({ dateFormat: '<?php echo $inputDate; ?>' });
                  
        
        var empnumber="<?php echo $Reinstatement->emp_number; ?>";
            var empname="<?php if($myCulture=="en"){ echo $Reinstatement->Employee->emp_display_name;}else if($myCulture=="si"){ echo $Reinstatement->Employee->emp_display_name_si; }else if($myCulture=="ta"){ echo $Reinstatement->Employee->emp_display_name_ta; } ?>";
            if(empname==""){
                empname="<?php echo $promotion->Employee->emp_display_name; ?>"
            }
            var data=empnumber+"|"+empname;
            SelectEmployee(data);
            var grade="<?php echo $Reinstatement->grade_code; ?>";
            LoadGradeSlot(grade);
            mymethod("<?php echo $Reinstatement->work_station; ?>","Display2");
<?php if ($editMode == true) { ?>
                              $('#frmSave :input').attr('disabled', true);
                              $('#editBtn').removeAttr('disabled');
                              $('#btnBack').removeAttr('disabled');
<?php } ?>

                       //Validate the form
                       $("#frmSave").validate({

            rules: {
                txtEmployeeName:{required: true},
                txtEPF:{required: true,noSpecialCharsOnly: true, maxlength:200},
                txtReinstatementDate: {required: true,noSpecialCharsOnly: true, maxlength:200 },
                cmbDesg:{required: true},
                cmbGrade:{required: true},
                cmbGradeSlot:{required: true},
                txtNWorkStaion:{required: true},
                txtReason: {required: true,noSpecialCharsOnly: true, maxlength:200 }

            },
            messages: {
                txtEmployeeName:{required:"<?php echo __("This field is required") ?>"},
                txtEPF:{required:"<?php echo __("This field is required") ?>",maxlength:"<?php echo __("Maximum 200 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                txtReinstatementDate:{required:"<?php echo __("This field is required") ?>",maxlength:"<?php echo __("Maximum 200 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                cmbDesg:{required:"<?php echo __("This field is required") ?>"},
                cmbGrade:{required:"<?php echo __("This field is required") ?>"},
                cmbGradeSlot:{required:"<?php echo __("This field is required") ?>"},
                txtNWorkStaion:{required:"<?php echo __("This field is required") ?>"},
                txtReason:{required:"<?php echo __("This field is required") ?>",maxlength:"<?php echo __("Maximum 200 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"}

            }
        });
        
        
                        $('#empRepPopBtn').click(function() {
                                    var popup=window.open('<?php echo public_path('../../symfony/web/index.php/disciplinary/searchEmployee?type=single&method=SelectEmployee'); ?>','Locations','height=450,width=800,resizable=1,scrollbars=1');
                                    if(!popup.opener) popup.opener=self;
                                    popup.focus();
                        });

                       // When click edit button
                       $("#frmSave").data('edit', <?php echo $editMode ? '1' : '0' ?>);

                       $("#editBtn").click(function() {

                           var editMode = $("#frmSave").data('edit');
                           if (editMode == 1) {
                               // Set lock = 1 when requesting a table lock

            location.href="<?php echo url_for('disciplinary/UpdateReinstatement?id=' . $encrypt->encrypt($Reinstatement->rei_id ) . '&lock=1') ?>";
                           }
                           else {

                               $('#frmSave').submit();
                           }


                       });

                       //When Click back button
                       $("#btnBack").click(function() {
                           location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/Reinstatement')) ?>";
                       });

                       //When click reset buton
                       $("#btnClear").click(function() {
                           // Set lock = 0 when resetting table lock
                           <?php if($Reinstatement->rei_id!= null){ ?>
                               
                               location.href="<?php echo url_for('disciplinary/UpdateReinstatement?id=' . $encrypt->encrypt($Reinstatement->rei_id ) . '&lock=0') ?>";
                           <?php }else{ ?>
                               location.href="<?php echo url_for('disciplinary/UpdateReinstatement') ?>";
                           <?php } ?>
                           
                       });
                   });
</script>
