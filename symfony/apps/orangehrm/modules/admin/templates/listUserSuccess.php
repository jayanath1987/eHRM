<div class="outerbox">
    <div class="maincontent">

        <div class="mainHeading">
            <h2>

                <?php echo __("Users") ?>

            </h2>
        </div>
        <?php echo message() ?>
                <form name="frmSearchBox" id="frmSearchBox" method="post" action="">
                    <input type="hidden" name="mode" value="search" />
                    <div class="searchbox">
                        <label for="searchMode"><?php echo __("Search By") ?></label>
                        <select name="searchMode" id="searchMode">
                            <option value="all"><?php echo __("--Select--") ?></option>

                            <option value="user_name" <?php echo "selected"; ?> <?php if ($searchMode == 'user_name') {
                    echo "selected";
                } ?>><?php echo __("User Name") ?></option>
                        </select>

                        <label for="searchValue"><?php echo __("Search For:") ?></label>
                        <input type="text" size="20" name="searchValue" id="searchValue" value="<?php echo $searchValue ?>" />
                        <input type="submit" class="plainbtn" id="btnSearch"
                               value="<?php echo __("Search") ?>" />
                        <input id="btnReset" type="reset" class="plainbtn"
                               value="<?php echo __("Reset") ?>" />
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
                <form name="standardView" id="standardView" method="post" action="<?php echo url_for('admin/deleteUser') ?>">
                    <input type="hidden" name="mode" id="mode" value=""/>
                    <input type="hidden" name="isAdmin" id="isAdmin" value="<?php echo $userType ?>" />
                    <table cellpadding="0" cellspacing="0" class="data-table">
                        <thead>
                            <tr>
                                <td width="50">

                                    <input type="checkbox" class="checkbox" name="allCheck" value="" id="allCheck" />

                                </td>


                                <td scope="col">
<?php echo $sorter->sortLink('user_name', __('User login ID'), '@user_list', ESC_RAW); ?>

                        </td>

                    <td scope="col">
<?php echo __('Employee Name'); ?>

                        </td>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $row = 0;
                    foreach ($listUser as $user) {
                        $cssClass = ($row % 2) ? 'even' : 'odd';
                        $row = $row + 1;
                    ?>
                        <tr class="<?php echo $cssClass ?>">
                        <td >
                            <?php if ($user->getId() != 'USR001') {
 ?>
                                <input type='checkbox' class='checkbox innercheckbox' name='chkLocID[]' id="chkLoc" value='<?php echo $user->getId() ?>' />
<?php } ?>
                        </td>

                        <td class="">
                            <a href="<?php echo url_for('admin/updateUser?id=' . $user->getId()) ?>"><?php echo $user->getUserName() ?></a>
                        </td>
                        <td class="">
                            <?php //echo $user->employee->emp_display_name; 
                            $employeeNameCol = ($Culture == "en") ? "emp_display_name" : "emp_display_name_" . $Culture;
                        $employeeName = $user->employee->$employeeNameCol == "" ? $user->employee->emp_display_name : $user->employee->$employeeNameCol;
                            echo $employeeName;
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

        $(document).ready(function() {

            buttonSecurityCommon("buttonAdd",null,null,"buttonRemove");

            //When click add button
            $("#buttonAdd").click(function() {
                location.href = "<?php echo url_for("admin/saveUser?isAdmin=" . $userType) ?>";

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
            var answer=0;


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

            $("#btnReset").click(function() {
                document.forms[0].reset('');
                location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/listUser')) ?>";
            });


            //When click Search Button
            $("#btnSearch").click(function() {
                $("#mode").attr('value', 'save');

                var searchMode = $('#searchMode');

                if (searchMode.val() == 'all')  {
                    alert('<?php echo __("Please select a field to search") ?>');
                searchMode.focus();
                return false;
            } else if ($('#searchValue').val() == '')  {
                    alert('<?php echo __("Please enter search value") ?>');
                //searchMode.focus();
                return false;
            } else {
                $('#frmSearchBox').submit();
                return true;
            }
        });

	  	
    });


</script>

