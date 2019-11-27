<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.numeric.js') ?>"></script>


<div class="formpage4col" >
    <div class="navigation">

    </div>
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Carder Plan") ?></h2></div>


        <div id="msg">
            <?php echo message(); ?>
        </div>
        <form name="frmSave" id="frmSave" method="post"  action="">
            <div class="leftCol" id="AttNoDiv" style="width: 450px;">
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Division/Department") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <?php
                ?>
                <input type="text" name="txtDivision" id="txtDivision" class="formInputText" value="<?php echo
                $feild; ?>" readonly="readonly" />
                <input type="hidden" name="txtDivisionid" id="txtDivisionid" value=""/>&nbsp;

            </div>
            <label for="txtLocation" style="width: 50px;">
                <input class="button" type="button" onclick="returnLocDet()" value="..." id="divisionPopBtn"  />
            </label>
    </div>
            <div  id="esmdiv"  class="centerCol" style="width: 250px;">
                <label for="txtLocation" style="width: 200px;"><?php echo __("Island wide Mahaweli Authority"); ?></label>
                <input type="checkbox" name="chkAttactive" id="chkAttactive" class="formCheckbox" value="1"  width="25" />
                
            </div>
            <br class="clear"/>
            <hr style=" background-color: #FAD163; border: 0px;" />
            <div class="leftCol">
                &nbsp;
            </div>

            <div class="centerCol" style="width: 100px;">
                <label style="margin-top:0px; width: 100px;" class="languageBar"><?php echo
                       __("Actual") ?></label>
               </div>
               <div class="centerCol" style="width: 100px;">
                   <label style="margin-top:0px; width: 100px;" class="languageBar"><?php echo
                       __("Approved") ?></label>
               </div>
               <div class="centerCol" style="width: 100px;">
                   <label style="margin-top:0px; width: 100px;" class="languageBar"><?php echo
                       __("Excess") ?></label>
               </div>
               <div class="centerCol" style="width: 100px;">
                   <label style="margin-top:0px; width: 100px;" class="languageBar"><?php echo
                       __("Vacancies") ?></label>
               </div>
               <br class="clear"/>
               <div id="craderlist">
                <?php
                       if (strlen($List)) {
                           echo $sf_data->getRaw('List');
                       }
                ?>
                   </div>



                   <div class="formbuttons">
                       
                       <input type="button" class="<?php echo $editMode ?
                               'editbutton' : 'savebutton'; ?>" name="EditMain" id="editBtn"
                       value="<?php echo __("Edit"); ?>"
                       title="<?php echo _("Edit"); ?>"
                       onmouseover=""/>
                <input type="button" onclick="resetClick()"  class="clearbutton" id="btnClear" tabindex="5" onmouseover="" onmouseout="" value="<?php echo
                       __("Reset"); ?>" />
            </div>
            <div class="requirednotice"><?php echo __("Fields marked with an asterisk") ?><span class="required"> * </span> <?php echo __("are required") ?></div>
        </form>
        <input type="hidden" value=""  />
    </div>
</div>

<script type="text/javascript">
    function isFloat(value){

   if(isNaN(value) || value.indexOf(".")<0){
     return false;
   } else {
      if(parseFloat(value)) {
              return "1";
          } else {
              return "0";
          }
   }
}
    
    function validationComment(e,id){
        
        $('#'+id).numeric({decimal : false , negative : false});
                                         
    }


    function onkeyUpevent(event,id){
        $('#'+id).numeric({decimal : false , negative : false});
 
    }

    function returnLocDet(){

        // TODO: Point to converted location popup
        var popup=window.open('<?php echo public_path('../../symfony/web/index.php/admin/listCompanyStructure?mode=select_subunit&method=mymethod'); ?>','Locations','height=450,resizable=1,scrollbars=1');
        if(!popup.opener) popup.opener=self;
    }
    function mymethod($id,$name){
            
        $.post("<?php echo url_for('admin/LoadCarderPlan') ?>",
        { id:  $id },
        function(data){
            $("#craderlist").html(data.list);
                
            $('#frmSave :input').attr('disabled', true);
            $('#editBtn').removeAttr('disabled');
            $('#editBtn').val('Edit');
            $('#divisionPopBtn').removeAttr('disabled');
            $("#frmSave").data('edit', '1');
            $("label.errortd[generated='true']").css('display', 'none');
        },
        "json"
    );

        
        $("#txtDivisionid").val($id);
        $("#txtDivision").val($name);

        if($id =="1"){
             $("input[name='chkAttactive']").attr('checked','checked');
             $('#AttNoDiv').hide();
        }else{
            $('#AttNoDiv').show();
        }
          
            
    }
    
    function lockCarderPlan(divID){
        $.post("<?php echo url_for('admin/lockCarderPlan') ?>",
        { divID:divID },
        function(data){
            if (data.recordLocked==true) {
                $('#frmSave :input').removeAttr('disabled', true);
                $("#frmSave").data('edit', '0'); // In view mode
                  
                $('#editBtn').val("<?php echo __('Save') ?>");
                  
                  
            
            }else {
                alert("<?php echo __("Record Locked.") ?>");
            }
        },
        "json"
    );
    }


    function unlockCarderPlan(divID){
        $.post("<?php echo url_for('admin/unlockCarderPlan') ?>",
        { divID:divID },
        function(data){
         
            $('#frmSave :input').attr('disabled', true);
            $('#editBtn').removeAttr('disabled');
            $('#divisionPopBtn').removeAttr('disabled');
            $('#editBtn').val("<?php echo __('Edit') ?>");
            $("#frmSave").data('edit', '1');
         
        },
        "json"
    );
    }

    function resetClick(){
    
        unlockCarderPlan($('#txtDivisionid').val());
        var currentDivsionID=$('#txtDivisionid').val();

        $("#txtDivisionid").val(currentDivsionID);
        if($("#txtDivisionid").val()!=""){


            $.post("<?php echo url_for('admin/LoadCarderPlan') ?>",
            { id:  $("#txtDivisionid").val() },
            function(data){
                $("#craderlist").html(data.list);
                $("#txtDivision").val(data.divisionName);

                $('#frmSave :input').attr('disabled', true);
                $('#editBtn').removeAttr('disabled');

                $('#divisionPopBtn').removeAttr('disabled');



                $("#frmSave").data('edit', '1');

            },
            "json"
        );
        }
         if($("#txtDivisionid").val() =="1"){
             $("input[name='chkAttactive']").attr('checked','checked');
             $('#AttNoDiv').hide();
        }else{
            $('#AttNoDiv').show();
        }
    }
    $(document).ready(function() {
    
        $(':input').numeric();

        $(':input').live("cut copy paste",function(e) {            
            e.preventDefault();
            
            
        });

       
        buttonSecurityCommon(null,null,"editBtn",null);
        
        $("input[name='chkAttactive']").change(function(){
            if ($(this).attr("checked")) {
                $('#AttNoDiv').hide();
                mymethod(1);
            }
            else{
                $('#AttNoDiv').show();
               // $('input#txtAttendNo').val("");

            }

        });
        
//    if($("#txtDivisionid").val()=="1"){
//             $("input[name='chkAttactive']").attr("checked");
//             $('#AttNoDiv').hide();
//        }else{
//            $('#AttNoDiv').show();
//        }
         
        $("#frmSave").validate({
            rules: {
                txtDivisionid : {required: true}
          
            },
            messages: {
                txtDivisionid: '<?php echo __("This field is required.") ?>'
           
            },
            errorClass: "errortd",
                submitHandler: function(form) {
                $('#editBtn').unbind('click').click(function() {return false}).val("<?php echo __('Wait..'); ?>");
                form.submit();
            }
        });

        
        
        
        //when key is pressed in the textbox$("#quantity").keypress(function (e)
   

        
        var currentDivsionID="<?php echo $divId ?>";
        
        $("#txtDivisionid").val(currentDivsionID);
        if($("#txtDivisionid").val()!=""){
            
        
            $.post("<?php echo url_for('admin/LoadCarderPlan') ?>",
            { id:  $("#txtDivisionid").val() },
            function(data){
                $("#craderlist").html(data.list);
                $("#txtDivision").val(data.divisionName);
                
                $('#frmSave :input').attr('disabled', true);
                $('#editBtn').removeAttr('disabled');
                  
                $('#divisionPopBtn').removeAttr('disabled');
                 
                  
                  
                $("#frmSave").data('edit', '1');
                if($("#txtDivisionid").val() =="1"){
                     $("input[name='chkAttactive']").attr('checked','checked');
                     $('#AttNoDiv').hide();
                }else{
                    $('#AttNoDiv').show();
                }
                
            },
            "json"
        );
            
        }
        $("#editBtn").click(function() {
            $("#msg").hide("slow");
            var editMode = $("#frmSave").data('edit');
            if (editMode == 1) {
                lockCarderPlan($('#txtDivisionid').val());
            
                return false;
            }
            else {

                $('#frmSave').submit();
            }
           
        });

    });
    
        
    
    
</script>