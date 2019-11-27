<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.autocomplete.js') ?>"></script>
<?php
$encrypt = new EncryptionHandler();
?>
<div class="outerbox">
    <div class="maincontent">

        <div class="mainHeading"><h2><?php echo __("Education Subjects") ?></h2></div>
        <?php echo message(); ?>
        <form name="frmSearchBox" id="frmSearchBox" method="post" action="">
            <input type="hidden" name="mode" value="search" />
            <div class="searchbox">
                <label for="cmbSearchMode"><?php echo __("Search By") ?></label>
                <select name="cmbSearchMode" id="cmbSearchMode">
                    <option value="all"><?php echo __("--Select--") ?></option>
                    <option value="edu_type_name" <?php if ($searchMode == 'edu_type_name') {
            echo "selected";
        }
        ?>><?php echo __("Education Type") ?></option>
                    <option value="subj_name" <?php if ($searchMode == 'subj_name') {
            echo "selected";
        } ?> > <?php echo __("Education Subject") ?></option>
                </select>

                <label for="txtSearchValue"><?php echo __("Search For:") ?></label>
                <input type="text" size="20" name="txtSearchValue" id="txtSearchValue" value="<?php echo $searchValue ?>" />
                <input type="button" class="plainbtn" id="btnSearch"
                       value="<?php echo __("Search") ?>" />
                <input type="reset" class="plainbtn" id="btnReset"
                       value="<?php echo __("Reset") ?>" />
                <br class="clear"/>
            </div>
        </form>
        <div class="actionbar">
            <div class="actionbuttons">
                <input type="button" class="plainbtn" id="btnAdd"
                       value="<?php echo __("Add") ?>" />

                <input type="button" class="plainbtn" id="btnRemove"
                       value="<?php echo __("Delete") ?>" />
            </div>
            <div class="noresultsbar"></div>
            <div class="pagingbar">
                <?php
                if (is_object($pglay)) {
                    if ($pglay->getPager()->haveToPaginate() == 1) {
                        echo $pglay->display();
                    }
                }
                ?>
            </div>

            <br class="clear" />
        </div>
        <br class="clear" />
        <form name="standardView" id="standardView" method="post" action="<?php echo url_for('admin/DeleteEducationSubject') ?>">
            <input type="hidden" name="mode" id="mode" value=""/>
            <table cellpadding="0" cellspacing="0" class="data-table">
                <thead>
                    <tr>
                        <td width="50">
                            <input type="checkbox" class="checkbox" name="chkAllCheck" value="" id="chkAllCheck" />
                        </td>

                        <td scope="col">

<?php echo $sorter->sortLink("s.subj_name", __('Education Subject Name'), '@EducationSubject', ESC_RAW); ?>
                        </td>
                        <td scope="col">

<?php echo __('Education Type Name'); ?>
                        </td>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $row = 0;
                    foreach ($ListEducationSubject as $EducationSubject) {
                        $cssClass = ($row % 2) ? 'even' : 'odd';
                        $row = $row + 1;

                        //Define data columns according culture
                        $ESNameCol = ($userCulture == "en") ? "subj_name" : "subj_name_" . $userCulture;
                        $ESName = $EducationSubject->$ESNameCol == "" ? $EducationSubject->subj_name : $EducationSubject->$ESNameCol;

                        $id = $EducationSubject->subj_id;
                        
                        $ETNameCol = ($userCulture == "en") ? "edu_type_name" : "edu_type_name_" . $userCulture;
                        $ETName = $EducationSubject->EducationType->$ETNameCol == "" ? $EducationSubject->EducationType->edu_type_name : $EducationSubject->EducationType->$ETNameCol;

                        
                    ?>

                        <tr class="<?php echo $cssClass ?>">
                            <td >
                                <input type='checkbox' class='checkbox innercheckbox' name='chkID[]' id="chkID" value='<?php echo $EducationSubject->subj_id ?>' />
                            </td>

                            <td class="">
                                <a href="<?php echo url_for('admin/SaveEducationSubject?ESId=' . $encrypt->encrypt($EducationSubject->subj_id)) ?>"><?php echo $ESName ?></a>
                            </td>
                            <td class="">
                                <?php echo $ETName ?>
                            </td>
                        </tr>
<?php } ?>
                </tbody>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function() {
        buttonSecurityCommon("btnAdd",null,null,"btnRemove");
        //When click add button
        $("#btnAdd").click(function() {
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/SaveEducationSubject')) ?>";

        });

        // When Click Main Tick box
        $("#chkAllCheck").click(function() {
            if ($('#chkAllCheck').attr('checked')){
                $('.innercheckbox').attr('checked','checked');
            }else{
                $('.innercheckbox').removeAttr('checked');
            }
        });

        $(".innercheckbox").click(function() {
            if($(this).attr('checked')) {

            }else {
                $('#chkAllCheck').removeAttr('checked');
            }
        });
        var answer=0;
        //When click remove button
        $("#btnRemove").click(function() {
            $("#mode").attr('value', 'delete');
            if($('input[name=chkID[]]').is(':checked')){
                answer = confirm("<?php echo __("Do you really want to delete?") ?>");
            } else {
                alert("<?php echo __("Select at least one check box to delete") ?>");
            }

            if (answer !=0 ) {
                $("#standardView").submit();
            } else {
                return false;
            }
        });

        //When click Search Button
        $("#btnSearch").click(function() {
            $("#mode").attr('value', 'save');

            var searchMode = $('#cmbSearchMode');

            if (searchMode.val() == 'all')  {
                alert('<?php echo __("Please select a field to search") ?>');
                searchMode.focus();
                return false;
        } else if ($('#txtSearchValue').val() == '')  {
                alert('<?php echo __("Please enter search value") ?>');
                searchMode.focus();
                return false;    
        } else {
                $('#frmSearchBox').submit();
                return true;
            }
        });

        //When click Reset Button
        $("#btnReset").click(function() {
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/EducationSubject')) ?>";
        });

    });

</script>

