<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.autocomplete.js') ?>"></script>
<?php
$encrypt = new EncryptionHandler();
?>
<div class="outerbox">
    <div class="maincontent">

        <div class="mainHeading"><h2><?php echo __("Disciplinary Sub Type Summary") ?></h2></div>
        <?php echo message() ?>
        <form name="frmSearchBox" id="frmSearchBox" method="post" action="" onsubmit="return validateform();">
            <input type="hidden" name="mode" value="search"/>
            <div class="searchbox" >
                <label for="searchMode"><?php echo __("Search By") ?></label>


                <select name="searchMode" id="searchMode">
                    <option value="all"><?php echo __("--Select--") ?></option>


                    <option value="offence" <?php if ($searchMode == 'offence') {
            echo "selected";
        } ?>><?php echo __("Sub Types") ?></option>
                    <option value="type" <?php if ($searchMode == 'type') {
            echo "selected";
        } ?>><?php echo __("Disciplinary Types") ?></option>

                </select>

                <label for="searchValue"><?php echo __("Search For") ?>:</label>
                <input type="text" size="20" name="searchValue" id="searchValue" value="<?php echo $searchValue ?>" />
                <input type="submit" class="plainbtn"
                       value="<?php echo __("Search") ?>" />
                <input type="reset" class="plainbtn"
                       value="<?php echo __("Reset") ?>" id="resetBtn"/>
                <br class="clear"/>
            </div>
        </form>
        <div class="actionbar">
            <div class="actionbuttons">

                <input type="button" class="plainbtn" id="buttonAdd"
                       value="<?php echo __("Add") ?>" />


                <input type="button" class="plainbtn" id="buttonRemove"
                       value="<?php echo __("Delete") ?>" />

            </div>
            <div class="noresultsbar"></div>
            <div class="pagingbar"><?php echo is_object($pglay) ? $pglay->display() : ''; ?></div>
            <br class="clear" />
        </div>
        <br class="clear" />
        <form name="standardView" id="standardView" method="post" action="<?php echo url_for('disciplinary/DeleteActions') ?>">
            <input type="hidden" name="mode" id="mode" value="">
            <table cellpadding="0" cellspacing="0" class="data-table">
                <thead>
                    <tr>
                        <td width="50">

                            <input type="checkbox" class="checkbox" name="allCheck" value="" id="allCheck" />

                        </td>


                        <td scope="col">
                            <?php echo $sorter->sortLink('dis_offence_name', __('Sub Types'), '@offenceName', ESC_RAW); ?>

                        </td>
                        <td scope="col">
<?php echo $sorter->sortLink('d.dis_acttype_name', __('Disciplinary Types'), '@offenceName', ESC_RAW); ?>

                        </td>

                    </tr>
                </thead>

                <tbody>
                    <?php
                            $row = 0;
                            foreach ($offenceList as $list) {
                                $cssClass = ($row % 2) ? 'even' : 'odd';
                                $row = $row + 1;
                    ?>
                                <tr class="<?php echo $cssClass ?>">
                                    <td>
                                        <input type='checkbox' class='checkbox innercheckbox' name='chkLocID[]' id="chkLoc" value='<?php echo $list->getDis_offence_id() ?>' />
                                    </td>

                                    <td class="">
                                        <a href="<?php echo url_for('disciplinary/UpdateActions?id=' . $encrypt->encrypt($list->getDis_offence_id())) ?>">
                                <?php
                                if ($culture == 'en') {
                                    $abc = "getDis_offence_name";
                                } else {
                                    $abc = "getDis_offence_name_" . $culture;
                                }
                                $dd = $list->$abc();
                                $rest = substr($list->$abc(), 0, 100);
                                if ($list->$abc() == "") {
                                    $dd = $list->getDis_offence_name();
                                    $rest = substr($list->getDis_offence_name(), 0, 100);
                                    if (strlen($dd) > 20) {
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
                        </td>
                        <td class="">
                            <a href="<?php echo url_for('disciplinary/UpdateActions?id=' . $encrypt->encrypt($list->getDis_offence_id())) ?>">
                                <?php
                                if ($culture == 'en') {
                                    $abc = "getDis_acttype_name";
                                } else {
                                    $abc = "getDis_acttype_name_" . $culture;
                                }

                                $dd = $list->DisciplinaryActionType->$abc();
                                $rest = substr($list->DisciplinaryActionType->$abc(), 0, 100);
                                if ($list->DisciplinaryActionType->$abc() == "") {

                                    $dd = $list->DisciplinaryActionType->getDis_acttype_name();
                                    $rest = substr($list->DisciplinaryActionType->getDis_acttype_name(), 0, 100);
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

                buttonSecurityCommon("buttonAdd",null,null,"buttonRemove");

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
                    location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/SaveActions')) ?>";

                });
                $("#btnBack").click(function() {
                    location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/actiontype')) ?>";
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
                    //document.forms[0].reset('');
                    location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/actions')) ?>";
        });


    });


</script>

