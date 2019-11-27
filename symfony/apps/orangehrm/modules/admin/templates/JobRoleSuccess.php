<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.autocomplete.js') ?>"></script>
<?php
$encrypt = new EncryptionHandler();
?>
<div class="outerbox">
    <div class="maincontent">

        <div class="mainHeading"><h2><?php echo __("Job Role Summary") ?></h2></div>

        <?php echo message() ?>
        <form name="frmSearchBox" id="frmSearchBox" method="post" action="" onsubmit="return validateform();">
            <input type="hidden" name="mode" value="search">
            <div class="searchbox">
                <label for="searchMode"><?php echo __("Search By") ?></label>


                <select name="searchMode" id="searchMode">
                    <option value="all"><?php echo __("--Select--") ?></option>
                    <option value="Designation" <?php
        if ($searchMode == 'Designation') {
            echo "selected";
        }
        ?>><?php echo __("Designation") ?></option>
                    <option value="Level" <?php
                            if ($searchMode == 'Level') {
                                echo "selected";
                            }
        ?>><?php echo __("Level") ?></option>
                    <option value="JobRole" <?php
                            if ($searchMode == 'JobRole') {
                                echo "selected";
                            }
        ?>><?php echo __("Job Role") ?></option>
                    <option value="Service" <?php
                            if ($searchMode == 'Service') {
                                echo "selected";
                            }
        ?>><?php echo __("Service") ?></option>
                </select>

                <label for="searchValue"><?php echo __("Search For") ?></label>
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
            <div class="pagingbar"><?php echo is_object($pglay) ? $pglay->display() : ''; ?> </div>
            <br class="clear" />
        </div>
        <br class="clear" />
        <form name="standardView" id="standardView" method="post" action="<?php echo url_for('admin/DeleteJobRole') ?>">
            <input type="hidden" name="mode" id="mode" value=""/>
            <table cellpadding="0" cellspacing="0" class="data-table">
                <thead>
                    <tr>
                        <td width="50">

                            <input type="checkbox" class="checkbox" name="allCheck" value="" id="allCheck" />

                        </td>

                        <td scope="col">
                            <?php
                            if ($Culture == 'en') {
                                $btname = 'JR.jrl_name';
                            } else {
                                $btname = 'JR.jrl_name_' . $Culture;
                            }
                            ?>
                            <?php echo $sorter->sortLink($btname, __('Job Role'), '@JobRoleSummery', ESC_RAW); ?>
                        </td>
                        <td scope="col">

                            <?php
                            if ($Culture == 'en') {
                                $btname = 'j.jobtit_name';
                            } else {
                                $btname = 'j.jobtit_name_' . $Culture;
                            }
                            ?>
                            <?php echo $sorter->sortLink($btname, __('Designation'), '@JobRoleSummery', ESC_RAW); ?>
                        </td>
                        <td scope="col">
                            <?php
                            if ($Culture == 'en') {
                                $btname = 'l.level_name';
                            } else {
                                $btname = 'l.level_name_' . $Culture;
                            }
                            ?>
                            <?php echo $sorter->sortLink($btname, __('Level'), '@JobRoleSummery', ESC_RAW); ?>
                        </td>

                        <td scope="col">
                            <?php
                            if ($Culture == 'en') {
                                $btname = 's.service_name';
                            } else {
                                $btname = 's.service_name_' . $Culture;
                            }
                            ?>
                            <?php echo $sorter->sortLink($btname, __('Service'), '@JobRoleSummery', ESC_RAW); ?>
                        </td>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $row = 0;
                    foreach ($JobRole as $reasons) {
                        $cssClass = ($row % 2) ? 'even' : 'odd';
                        $row = $row + 1;
                        ?>
                        <tr class="<?php echo $cssClass ?>">
                            <td >
                                <input type='checkbox' class='checkbox innercheckbox' name='chkLocID[]' id="chkLoc" value='<?php echo $reasons->getJrl_id() ?>' />
                            </td>
                            <td class="">
                                <?php
                                if ($Culture == 'en') {
                                    $dd = $reasons->getJrl_name();
                                    $rest = substr($reasons->getJrl_name(), 0, 100);
                                    if (strlen($dd) > 100) {
                                        echo $rest
                                        ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a> <?php
                        } else {
                            echo $rest;
                        }
                    } else {
                        $abc = 'getJrl_name_' . $Culture;
                        $dd = $reasons->$abc();
                        $rest = substr($reasons->$abc(), 0, 100);
                        if (strlen($dd) > 100) {
                            echo $rest
                                        ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a> <?php
                        } else {
                            echo $rest;
                        }

                        if ($reasons->$abc() == null) {
                            $dd = $reasons->getJrl_name();
                            $rest = substr($reasons->getJrl_name(), 0, 100);
                            if (strlen($dd) > 100) {
                                echo $rest
                                            ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a> <?php
                        } else {
                            echo $rest;
                        }
                    }
                }
                                ?>
                            </td>
                            <td class="">
                                <a href="<?php echo url_for('admin/SaveJobRole?id=' . $encrypt->encrypt($reasons->getJrl_id())) ?> "><?php
                            if ($Culture == 'en') {
                                $dd = $reasons->JobTitle->getJobtit_name();
                                $rest = substr($reasons->JobTitle->getJobtit_name(), 0, 100);
                                if (strlen($dd) > 100) {
                                    echo $rest
                                        ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a> <?php
                            } else {
                                echo $rest;
                            }
                        } else {
                            $abc = 'getJobtit_name_' . $Culture;
                            $dd = $reasons->JobTitle->$abc();
                            $rest = substr($reasons->JobTitle->$abc(), 0, 100);
                            if (strlen($dd) > 100) {
                                echo $rest
                                        ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a> <?php
                            } else {
                                echo $rest;
                            }
                            if ($reasons->JobTitle->$abc() == null) {
                                $dd = $reasons->JobTitle->getJobtit_name();
                                $rest = substr($reasons->JobTitle->getJobtit_name(), 0, 100);
                                if (strlen($dd) > 100) {
                                    echo $rest
                                            ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a> <?php
                            } else {
                                echo $rest;
                            }
                        }
                    }
                                ?></a>
                            </td>
                            <td class="">
                                <?php
                                if ($Culture == 'en') {
                                    $dd = $reasons->Level->getLevel_name();
                                    $rest = substr($reasons->Level->getLevel_name(), 0, 100);
                                    if (strlen($dd) > 100) {
                                        echo $rest
                                        ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a> <?php
                        } else {
                            echo $rest;
                        }
                    } else {
                        $abc = 'getLevel_name_' . $Culture;
                        $dd = $reasons->Level->$abc();
                        $rest = substr($reasons->Level->$abc(), 0, 100);
                        if (strlen($dd) > 100) {
                            echo $rest
                                        ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a> <?php
                        } else {
                            echo $rest;
                        }
                        if ($reasons->Level->$abc() == null) {
                            $dd = $reasons->Level->getLevel_name();
                            $rest = substr($reasons->Level->getLevel_name(), 0, 100);
                            if (strlen($dd) > 100) {
                                echo $rest
                                            ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a> <?php
                        } else {
                            echo $rest;
                        }
                    }
                }
                                ?>
                            </td>
                            <td class="">
                                <?php
                                if ($Culture == 'en') {
                                    $dd = $reasons->ServiceDetails->getService_name();
                                    $rest = substr($reasons->ServiceDetails->getService_name(), 0, 100);
                                    if (strlen($dd) > 100) {
                                        echo $rest
                                        ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a> <?php
                        } else {
                            echo $rest;
                        }
                    } else {
                        $abc = 'getService_name_' . $Culture;
                        $dd = $reasons->ServiceDetails->$abc();
                        $rest = substr($reasons->ServiceDetails->$abc(), 0, 100);
                        if (strlen($dd) > 100) {
                            echo $rest
                                        ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a> <?php
                        } else {
                            echo $rest;
                        }
                        if ($reasons->ServiceDetails->$abc() == null) {
                            $dd = $reasons->ServiceDetails->getService_name();
                            $rest = substr($reasons->ServiceDetails->getService_name(), 0, 100);
                            if (strlen($dd) > 100) {
                                echo $rest
                                            ?>.<a href="" title="<?php echo $dd ?>" onclick="javascript:disableAnchor(this, true)">...</a> <?php
                        } else {
                            echo $rest;
                        }
                    }
                }
                                ?>
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


        buttonSecurityCommon("buttonAdd","null","null","buttonRemove");
        //When click add button
        $("#buttonAdd").click(function() {
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/SaveJobRole')) ?>";

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

        //When click reset buton
        $("#resetBtn").click(function() {
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/JobRole')) ?>";
        });

        //When click Save Button
        $("#buttonRemove").click(function() {
            $("#mode").attr('value', 'save');
        });



    });


</script>
