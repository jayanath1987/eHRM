 <div class="navigation">
        <input type="button" class="backbutton" id="btnBack"
               value="<?php echo __("Back") ?>" tabindex="10" />

    </div>
<div class="outerbox">
<div class="maincontent">

	<div class="mainHeading"><h2><?php echo __("Incident Summery")?></h2></div>
        <div class="formpage2col">
<?php foreach($incident as $list1){?>
             <div class="leftCol">
                 <label class="controlLabel" for="txtLocationCode"><?php echo __("Employee Name")?> <span class="required">*</span></label>
    </div>
    <div class="centerCol">
                <label class="controlLabel" for="txtLocationCode">
                <?php 

                echo $currentIncident->dis_inc_reportedby;
                 ?>
                </label>
    </div>

<br class="clear"/>

<div class="leftCol">
                 <label class="controlLabel" for="txtLocationCode"><?php echo __("Offence List")?> <span class="required">*</span></label>
    </div>
    <div class="centerCol">
                <label class="controlLabel" for="txtLocationCode">
               <?php
                 if($culture=='en'){
                          $abc = "getDis_offence_name";
                       }else{
                          $abc = "getDis_offence_name_".$culture;
                    }
                 foreach($list1->OffenceList as $list){


                     if($list->Offence->$abc()==""){
                             echo  $list->Offence->getDis_offence_name()."<br/>";} else
                                 {echo $list->Offence->$abc()."<br/>";}
                 }?>
                </label>
    </div>

<br class="clear"/>

<div class="leftCol">
                 <label class="controlLabel" for="txtLocationCode"><?php echo __("Action Details")?> <span class="required">*</span></label>
    </div>
    <div class="centerCol">
               
                    <table style="width: 500px; margin-left: 125px;">
                        <thead>
            <tr>
                        <td>
                            <b><?php echo __("Level")?></b>
                        </td>
                        <td>
                            <b><?php echo __("Action taken by")?></b>
                        </td>
                        <td>
                            <b><?php echo __("Action taken date")?></b>
                        </td>

                        <td>
                            <b><?php echo __("Comment")?></b>
                        </td>
                        <td>
                            <b><?php echo __("Case File")?></b>
                        </td>
                            </tr>
    		</thead>
                             <tr>
                             <td>
                            <?php foreach($list1->IncidentDetails as $list){?>
                           <?php echo  $list->getdis_indetail_level()."<br/>"; ?>
                                 <?php }?>
                             </td>
                           <td>
                               <?php foreach($list1->IncidentDetails as $list2){?>
                               <?php echo  $list2->getDis_indetail_takenby()."<br/>"; ?>
                               <?php }?>
                               </td>
                             <td>
                               <?php foreach($list1->IncidentDetails as $list2){?>
                               <?php echo  $list2->getDis_indetail_takendate()."<br/>"; ?>
                               <?php }?>
                               </td>
                               <td>
                               <?php foreach($list1->IncidentDetails as $list2){?>
                               <?php echo  $list2->getDis_indetail_comment()."<br/>"; ?>
                               <?php }?>
                               </td>
                               <td>
                                   <?php
                    $discDao=new DisciplinaryDao();
                    $upattach = $discDao->readAttachment($list->getDis_inc_id());
                     $encryptObj=new EncryptionHandler();
                     
                    ?>
                                   <a href="#" onclick="popupimage(link='<?php echo url_for('disciplinary/ImagePopup?id=');?><?php echo $encryptObj->encrypt($upattach[0]->getDis_attach_id()) ?>')"><?php  if(strlen($upattach[0]->getDis_attach_name())){ echo __("View");} ?></a>
                               </td>
                        </tr>
                        

                           

                       
                    </table>
                
                    </div>

<br class="clear"/>

<?php }?>
        </div>
</div>
</div>
<script type="text/javascript">
    function popupimage(link){
        
            window.open(link, "myWindow",
"status = 1, height = 300, width = 300, resizable = 0" )
        }
            <?php if($close==1){?>
            $("#btnBack").click(function() {
                    location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/ClosedIncidents')) ?>";
        });
        <?php
            }else{?>
                 $("#btnBack").click(function() {
                    location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/incidents?level=1')) ?>";
        });
          <?php  }
        ?>
        </script>