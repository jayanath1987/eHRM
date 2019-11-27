<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.autocomplete.js') ?>"></script>

<link href="<?php echo public_path('../../themes/orange/css/jquery/jquery.autocomplete.css') ?>" rel="stylesheet" type="text/css"/>
<div class="outerbox">
    <?php
    $adminMode = $sf_user->hasCredential('Admin');
    ?>
    <div class="maincontent">

        <div class="mainHeading"><h2><?php echo __("Company Info: Company Property") ?></h2></div>
        <?php echo message() ?>

        <div class="actionbar">
            <div class="actionbuttons">
                <?php if ($adminMode) {
 ?>
                    <input type="button" class="plainbtn" id="buttonAdd"
                           value="<?php echo __("Add") ?>" />
<?php } ?>                
                <input type="button" class="plainbtn" id="buttonSave"
                       value="<?php echo __("Save") ?>" />
<?php if ($adminMode) { ?>
                <input type="button" class="plainbtn" id="buttonRemove"
                       value="<?php echo __("Delete") ?>" />
<?php } ?>
            </div>
            <div class="noresultsbar"></div>
            <div class="pagingbar"> </div>
            <br class="clear" />
        </div>
        <br class="clear" />
        <form name="standardView" id="standardView" method="post" action="<?php echo url_for('admin/processCompanyProperty') ?>">
            <input type="hidden" name="mode" id="mode" value=""/>
            <table cellpadding="0" cellspacing="0" class="data-table">
                <thead>
                    <tr>
                        <td width="50">
<?php if ($adminMode) { ?>
                            <input type="checkbox" class="checkbox" name="allCheck" value="" id="allCheck" />
<?php } ?>
                        </td>

                        <td scope="col">
<?php echo $sorter->sortLink('prop_id', __('Property Name '), '@comproperty_list', ESC_RAW); ?>
                        </td>
                        <td scope="col">
<?php echo __('Employee') ?>

                        </td>

                    </tr>
                </thead>

                <tbody>
                    <?php
                    $row = 0;
                    foreach ($propertyList as $property) {
                        $cssClass = ($row % 2) ? 'even' : 'odd';
                        $row = $row + 1;
                    ?>
                        <tr class="<?php echo $cssClass ?>">
                            <td >
<?php if ($adminMode) { ?>
                            <input type='checkbox' class='checkbox innercheckbox' name='chkLocID[]' id="chkLoc" value='<?php echo $property->getPropId() ?>' />
<?php } ?>
                        </td>
                        <td class="">
<?php if ($adminMode) { ?>
                            <a href="<?php echo url_for('admin/updateCompanyProperty?id=' . $property->getPropId()) ?>"><?php echo $property->getPropName() ?></a>
                            <?php
                        } else {
                            echo $property->getPropName();
                        }
                            ?>
                        </td>
                        <td class="">
                            <select name="txtProperty[<?php echo $property->getPropId(); ?>]">

                                <option value="0" selected="selected">Not Assigned</option>
                                <?php
                                foreach ($employeeList as $employee) {
                                    $selected = $property->getEmpId() == $employee->getEmpNumber() ? 'selected="selected"' : '';
                                    $empName = trim($employee->getFirstName() . ' ' . $employee->getLastName());
                                ?>
                                <option value="<?php echo $employee->getEmpNumber(); ?>"
<?php echo $selected; ?>><?php echo $empName; ?></option>
<?php } ?>
                            </select>

                        </td>

                    </tr>
<?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <script type="text/javascript">

            function selectItem() {
                alert('sss');
            }

            $(document).ready(function() {

                //When click add button
                $("#buttonAdd").click(function() {
                    location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/saveCompanyProperty')) ?>";

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

        //When click remove button
        $("#buttonRemove").click(function() {
            $("#mode").attr('value', 'delete');
            $("#standardView").submit();
        });

        //When click Save Button
        $("#buttonSave").click(function() {
            $("#mode").attr('value', 'save');
            $("#standardView").submit();
        });


	  	
    });


</script>

