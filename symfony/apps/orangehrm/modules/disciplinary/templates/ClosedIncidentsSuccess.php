<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.autocomplete.js') ?>"></script>


<div class="outerbox">


    <div class="maincontent">

        <div class="mainHeading"><h2><?php echo __("Close Incident Summary") ?></h2></div>
        <?php echo message() ?>
        <form name="frmSearchBox" id="frmSearchBox" method="post" action="" onsubmit="return validateform();">
            <input type="hidden" name="mode" value="search"/>
            <div class="searchbox">
                <label for="searchMode"><?php echo __("Search By") ?></label>


                <select name="searchMode" id="searchMode" onchange="isclosed();">
                    <option value="all"><?php echo __("--Select--") ?></option>


                    <option value="employee" <?php
        if ($searchMode == 'employee') {
            echo "selected";
        }
        ?>><?php echo __("Code") ?></option>
                    <option value="incident" <?php
                    if ($searchMode == 'incident') {
                        echo "selected";
                    } ?>><?php echo __("Incident") ?></option>
                    <option value="takenby" <?php
                            if ($searchMode == 'takenby') {
                                echo "selected";
                            }
        ?>><?php echo __("Final Action taken by") ?></option>
                    <option value="takendate" <?php
                            if ($searchMode == 'takendate') {
                                echo "selected";
                            }
        ?>><?php echo __("Final Action taken date") ?></option>



                </select>


                <label for="searchValue"><?php echo __("Search For") ?>:</label>
                <div id="searchp">
                    <?php if ($searchMode == 'isclosed') {
 ?>
                                <select name='searchValue' id='searchValue'>";
                                    <option value='1' <?php if ($searchValue == "1"

                                    )echo "selected" ?>><?php echo __('Yes') ?></option>";
                                        <option value='0' <?php if ($searchValue == "0"

                                        )echo "selected" ?>><?php echo __('No') ?></option>";
                                        </select>
<?php }else { ?>
                                        <input type="text" size="20" name="searchValue" id="searchValue" value="<?php echo $searchValue ?>" />
<?php } ?>
                                </div>
                                <input type="submit" class="plainbtn"
                                       value="<?php echo __("Search") ?>" />
                                <input type="reset" class="plainbtn" id="resetBtn"
                                       value="<?php echo __("Reset") ?>" />
                                <br class="clear"/>
                            </div>
                        </form>
                        <div class="actionbar">
                            <div class="actionbuttons">






                            </div>
                            <div class="noresultsbar"></div>
                            <div class="pagingbar"><?php echo is_object($pglay) ? $pglay->display() : ''; ?></div>
                            <br class="clear" />
                        </div>
                        <br class="clear" />
                        <form name="standardView" id="standardView" method="post" action="<?php echo url_for('disciplinary/DeleteIncident') ?>">
                            <input type="hidden" name="mode" id="mode" value="">
                            <table cellpadding="0" cellspacing="0" class="data-table">
                                <thead>
                                    <tr>

                     <td scope="col">
                    <?php echo  __('Code'); ?>

                                                    </td>

<!--                                        <td scope="col">
<?php echo  __('Employee Name'); ?>

                                </td>-->
                                <td scope="col">
<?php echo __('Incident'); ?>

                                </td>
                                <td scope="col">
<?php echo $sorter->sortLink('r.dis_inc_finact_tknby', __('Final Action taken by'), '@summerydisclose', ESC_RAW); ?>

                                </td>
                                <td scope="col">
<?php echo $sorter->sortLink('r.dis_inc_finact_tkndate', __('Final Action taken date'), '@summerydisclose', ESC_RAW); ?>
                                </td>
                                <td scope="col">
                                    <?php echo __('Close Status'); ?>
                                </td>
                                <td scope="col">
                    <?php echo __('Case File'); ?>

                                        </td>

                                    </tr>
                                </thead>

                                <tbody>
<?php                               $DisciplinaryIncidentDao=new DisciplinaryIncidentDao();
                                    $row = 0;
                                    foreach ($Level0SummeryList as $list) {

                                    

                                        $cssClass = ($row % 2) ? 'even' : 'odd';
                                        $row = $row + 1;
?>
                                <tr class="<?php echo $cssClass ?>" >
                                    <td width="">
                                     <?php echo $list->dis_inc_id ; ?>
                                    </td>
<!--                                    <td width="50">
                                    <?php   $d=0;
                                    $Emp=$DisciplinaryIncidentDao->GetListedEmpids($list->dis_inc_id);
                                        foreach($Emp as $employee){
                                            if ($culture == "en") {
                                            $display_name = "emp_display_name";
                                        } else {
                                            $display_name = "emp_display_name_" . $culture;
                                        }
                                            if($d!=0){
                                            echo ",".$employee->Employee->$display_name;
                                            }else{
                                                echo $employee->Employee->$display_name;
                                            }
                                            $d++;
                                        }
                                    ?>
                                    </td>-->


                                    <td class="">

                            <?php
                                        if ($culture == "en") {
                                            $descrip = "dis_inc_incident";
                                        } else {
                                            $descrip = "dis_inc_incident_" . $culture;
                                        }
                                        if ($list->$descrip == null) {;
                                            echo $list->dis_inc_incident;
                                        } else {
                                            echo $list->$descrip;
                                        }
                            ?>

                                    </td>
                                    <td class="">


<?php
                                        echo $list->dis_inc_finact_tknby;
?>

                                    </td>
                                    <td class="">
                            <?php
                                        echo LocaleUtil::getInstance()->formatDate($list->dis_inc_finact_tkndate);
                            ?>
                                </td>
                                <td class="">
                                 <?php 
                     if($list->dis_inc_major_mionor_flg == 0) {
                                         if ($list->dis_inc_ifchargesheetissued_flg == 0) {
                                             echo __("Charge Sheet Issued");
                                         } else {
                                             echo __("Explanation");
                                         }
                                     } else {

                                         if ($list->dis_inc_intedicted_flg == 1) {
                                             echo __("Interdicted");
                                         } else {
                                             echo __("Further Action");
                                         }
                                     } ?>                                  
                                    
                                </td>
                                <td class="">
<?php
                                        //$discDao = new DisciplinaryDao();
                                        $disciplinaryIncidentDaoService=new DisciplinaryIncidentService();
                                        $upattach = $disciplinaryIncidentDaoService->readChargeSheet($list->getDis_inc_id(), "d");

                                        $encryptObj = new EncryptionHandler();
?>
                                                <a href="#" onclick="popupimage(link='<?php echo url_for('disciplinary/ImagePopup?id='); ?><?php echo $encryptObj->encrypt($upattach[0]->getDis_attach_id()) ?>')"><?php
                                        if (strlen($upattach[0]->getDis_attach_name())) {
                                            echo __("View");
                                        }
?></a>
                                            </td>


                                        </tr>
<?php } ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <script type="text/javascript">
                    function disableAnchor(obj, disable){
                        if(disable){
                            var href = obj.getAttribute("href");
                            if(href && href != "" && href != null){
                                obj.setAttribute('href_bak', href);
                            }
                            obj.removeAttribute('href');
                            obj.style.color="gray";
                        }
                        else{
                            obj.setAttribute('href', obj.attributes
                            ['href_bak'].nodeValue);
                            obj.style.color="blue";
                        }
                    }
                    function popupimage(link){
                        window.open(link, "myWindow",
                        "status = 1, height = 300, width = 300, resizable = 0" )
                    }
                    function isclosed(){

                        if($("#searchMode").val()=="isclosed"){

                            var selectBox="<select name='searchValue' id='searchValue'>";
                            selectBox+="<option value='1'><?php echo __('Yes') ?></option>";
                            selectBox+="<option value='0'><?php echo __('No') ?></option>";
                            selectBox+="</select>";
                            $("#searchp").html(selectBox);
                        }
                        else{
                            var searchtext="<input type='text' size='20' name='searchValue' id='searchValue' value='' />";
                            $("#searchp").html(searchtext);
                        }
                    }

                    function validateform(){

                        if($("#searchValue").val()=="")
                        {

                            alert("<?php echo __('Please enter search value') ?>");
                            return false;

                        }
                        if($("#searchMode").val()=="all"){
                            alert("<?php echo __('Please select the search mode') ?>");
                            return false;
                        }
                        else{
                            $("#frmSearchBox").submit();
                        }

                    }


                    $(document).ready(function() {

                        $("#buttonRemove").click(function() {
                            $("#mode").attr('value', 'delete');
                            if($('input[name=chkLocID[]]').is(':checked')){
                                answer = confirm("<?php echo __("Do you really want to Delete?") ?>");
                            }


                            else{
                                alert("<?php echo __("select at least one check box to delete") ?>");

                            }

                            if (answer !=0)
                            {

                                $("#standardView").submit();

                            }
                            else{
                                return false;
                            }

                        });

                        //When click add button
                        $("#buttonAdd").click(function() {
                            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/SaveInsident')) ?>";

                        });


                        // When Click Main Tick box
                        $("#allCheck").click(function() {
                            if ($('#allCheck').attr('checked')){

                                $('.innercheckbox').attr('checked','checked');
                            }else{
                                $('.innercheckbox').removeAttr('checked');
                            }
                        });

                        $(".innercheckbox").click(function() {
                            if($(this).attr('checked'))
                            {

                            }else
                            {
                                $('#allCheck').removeAttr('checked');
                            }
                        });

                        $("#resetBtn").click(function() {

                            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/ClosedIncidents')) ?>";
        });



    });


</script>


