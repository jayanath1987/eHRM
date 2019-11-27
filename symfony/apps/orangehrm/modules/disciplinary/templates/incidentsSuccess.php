<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.autocomplete.js') ?>"></script>

<div class="outerbox">
    <div class="maincontent">

        <div class="mainHeading"><h2><?php echo __("Pending Inquiry Summary") ?></h2></div>
        <?php echo message() ?>
        <form name="frmSearchBox" id="frmSearchBox" method="post" action="" onsubmit="return validateform();">
            <input type="hidden" name="mode" value="search"/>

            <div class="searchbox">
                <label for="searchMode"><?php echo __("Search By") ?></label>


                <select name="searchMode" id="searchMode" onchange="isclosed();">
                    <option value="all"><?php echo __("--Select--") ?></option>


                    <option value="employee" <?php if ($searchMode == 'employee') {
            echo "selected";
        } ?>><?php echo __("Employee Name") ?></option>
                    <option value="Offencelist" <?php if ($searchMode == 'Offencelist') {
            echo "selected";
        } ?>><?php echo __("Offence List") ?></option>
                    <option value="takenby" <?php if ($searchMode == 'takenby') {
            echo "selected";
        } ?>><?php echo __("Action taken by") ?></option>
                    <option value="takendate" <?php if ($searchMode == 'takendate') {
            echo "selected";
        } ?>><?php echo __("Action taken date") ?></option>
                    <option value="isclosed" <?php if ($searchMode == 'isclosed') {
            echo "selected";
        } ?>><?php echo __("Isclosed") ?></option>


                </select>


                <label for="searchValue"><?php echo __("Search For") ?>:</label>
                <div id="searchp">
<?php if ($searchMode == 'isclosed') { ?>
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
                <input type="reset" class="plainbtn"
                       value="<?php echo __("Reset") ?>" id="resetBtn"/>
                <br class="clear"/>
            </div>
        </form>
        <div class="actionbar">
            <div class="actionbuttons">



                <input type="button" class="plainbtn" id="buttonRemove"
                       value="<?php echo __("Delete") ?>" />

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
                        <td width="50">


                        </td>


                        <td scope="col">
                            <?php echo $sorter->sortLink('e.emp_lastname', __('Employee Name'), '@summerylevel0', ESC_RAW); ?>

                        </td>
                        <td scope="col">
                            <?php echo __('Offence List'); ?>

                        </td>
                        <td scope="col">
<?php echo $sorter->sortLink('i.dis_indetail_takenby', __('Action taken by'), '@summerylevel0', ESC_RAW); ?>

                        </td>
                        <td scope="col">
<?php echo $sorter->sortLink('i.dis_indetail_takendate', __('Action taken date'), '@summerylevel0', ESC_RAW); ?>

                        </td>
                        <td scope="col">
                    <?php echo __('Case File'); ?>

                                </td>


                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $row = 0;
                            foreach ($Level0SummeryList as $list) {



                                $cssClass = ($row % 2) ? 'even' : 'odd';
                                $row = $row + 1;
                            ?>
                        <tr class="<?php echo $cssClass ?>">
                            <td>
<?php
                                if ($list->getDis_inc_level() == 2) {

                                    $disabled = "disabled";
                                } else {

                                    $disabled = "";
                                }
?>
                            <input type='checkbox' class='checkbox innercheckbox' name='chkLocID[]' id="chkLoc" value='<?php echo $list->getDis_inc_id() ?>' <?php echo $disabled ?> />
                        </td>

                        <td class="">
                                <?php if ($list->getDis_inc_level() != 2) {
 ?>
                                <a href="<?php echo url_for('disciplinary/UpdateInsident?id=' . $list->getDis_inc_id()) ?>">
                                <?php
                                    if ($culture == 'en') {
                                        $abc = "getEmp_display_name";
                                    } else {
                                        $abc = "getEmp_display_name_" . $culture;
                                    }

                                    $dd = $list->Employee->$abc();
                                    $rest = substr($list->Employee->$abc(), 0, 100);
                                    if ($list->Employee->$abc() == "") {
                                        $dd = $list->Employee->getEmp_display_name();
                                        $rest = substr($list->Employee->getEmp_display_name(), 0, 100);

                                        if (strlen($dd) > 100) {
                                            echo $rest ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a> <?php
                                        } else {
                                            echo $rest;
                                        }
                                    } else {


                                        if (strlen($dd) > 100) {
                                            echo $rest ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a> <?php
                                        } else {
                                            echo $rest;
                                        }
                                    }
                                ?>

                                </a>
                                <?php } else {
 ?>
                                <a href="<?php echo url_for('disciplinary/SummeryDis?id=' . $list->getDis_inc_id()) ?>">
                                <?php
                                    if ($culture == 'en') {
                                        $abc = "getEmp_display_name";
                                    } else {
                                        $abc = "getEmp_display_name_" . $culture;
                                    }

                                    $dd = $list->Employee->$abc();
                                    $rest = substr($list->Employee->$abc(), 0, 100);
                                    if ($list->Employee->$abc() == "") {
                                        $dd = $list->Employee->getEmp_display_name();
                                        $rest = substr($list->Employee->getEmp_display_name(), 0, 100);

                                        if (strlen($dd) > 100) {
                                            echo $rest ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a> <?php
                                        } else {
                                            echo $rest;
                                        }
                                    } else {


                                        if (strlen($dd) > 100) {
                                            echo $rest
                                ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a> <?php
                                        } else {
                                            echo $rest;
                                        }
                                    }
                                ?>
                                    </a>
                            <?php } ?>

                            </td>
                            <td class="">
                            <?php if ($list->getDis_inc_level() != 2) {
 ?>

                            <?php
                                    if ($culture == 'en') {
                                        $abc = "getDis_offence_name";
                                    } else {
                                        $abc = "getDis_offence_name_" . $culture;
                                    }
                                    foreach ($list->OffenceList as $list1) {
                                        $dd = $list1->Offence->$abc();
                                        $rest = substr($list1->Offence->$abc(), 0, 100);

                                        if ($list1->Offence->$abc() == "") {
                                            $dd = $list1->Offence->getDis_offence_name();
                                            $rest = substr($list1->Offence->getDis_offence_name(), 0, 100);
                                            if (strlen($dd) > 100) {
                                                echo $rest ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a><br/> <?php
                                            } else {
                                                echo $rest . "<br/>";
                                            }
                                        } else {
                                            // echo $list->$abc();
                                            if (strlen($dd) > 100) {
                                                echo $rest ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a><br/> <?php
                                            } else {
                                                echo $rest . "<br/>";
                                            }
                                        }
                                    } ?>


                            <?php } else {
 ?>

                            <?php
                                    if ($culture == 'en') {
                                        $abc = "getDis_offence_name";
                                    } else {
                                        $abc = "getDis_offence_name_" . $culture;
                                    }

                                    foreach ($list->OffenceList as $list1) {
                                        $dd = $list1->Offence->getDis_offence_name();
                                        $rest = substr($list1->Offence->getDis_offence_name(), 100);

                                        if ($list1->Offence->$abc() == "") {
                                            $dd = $list1->Offence->$abc();
                                            $rest = substr($list1->Offence->$abc(), 0, 100);
                                            if (strlen($dd) > 100) {
                                                echo $rest ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a><br/> <?php
                                            } else {
                                                echo $rest . "<br/>";
                                            }
                                        } else {

                                            if (strlen($dd) > 100) {
                                                echo $rest ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a><br/> <?php
                                            } else {
                                                echo $rest . "<br/>";
                                            }
                                        }
                                    }
                            ?>


                            <?php } ?>

                            </td>
                            <td class="">
                            <?php if ($list->getDis_inc_level() != 2) {
 ?>

                            <?php
                                    $names = array();
                                    foreach ($list->IncidentDetails as $list1) {


                                        if (strlen($list1->getDis_indetail_takenby())) {
                                            $names[] = $list1->getDis_indetail_takenby();
                                        }
                                    }
                                    echo implode(", ", $names);
                            ?>


                            <?php } else {
 ?>

<?php
                                    $names = array();
                                    foreach ($list->IncidentDetails as $list1) {
                                        if (strlen($list1->getDis_indetail_takenby())) {
                                            $names[] = $list1->getDis_indetail_takenby();
                                        }
                                    }
                                    echo implode(", ", $names);
?>


                            <?php } ?>

                            </td>
                            <td class="">
                            <?php if ($list->getDis_inc_level() != 2) {
 ?>

<?php
                                    $names = array();
                                    foreach ($list->IncidentDetails as $list1) {
                                        if (strlen($list1->getDis_indetail_takendate())) {
                                            $names[] = $list1->getDis_indetail_takendate();
                                        }
                                    }
                                    echo implode(", ", $names);
?>


                            <?php } else {
 ?>

                            <?php
                                    $names = array();
                                    foreach ($list->IncidentDetails as $list1) {
                                        if (strlen($list1->getDis_indetail_takendate())) {
                                            $names[] = $list1->getDis_indetail_takendate();
                                        }
                                    }
                                    echo implode(", ", $names);
                            ?>


<?php } ?>


                            </td>

                            <td class="">
<?php
                                $discDao = new DisciplinaryDao();
                                $upattach = $discDao->readAttachment($list->getDis_inc_id());
                                $encryptObj = new EncryptionHandler();
?>
                                        <a href="#" onclick="popupimage(link='<?php echo url_for('disciplinary/ImagePopup?id='); ?><?php echo $encryptObj->encrypt($upattach[0]->getDis_attach_id()) ?>')"><?php if (strlen($upattach[0]->getDis_attach_name())) {
                                    echo __("View");
                                } ?></a>
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
                    location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/SaveInsident?lvl=1')) ?>";

                });
                $("#btnBack").click(function() {
                    location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/incidents')) ?>";
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
                    document.forms[0].reset('');
                    location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/incidents')) ?>";
        });





    });


</script>


