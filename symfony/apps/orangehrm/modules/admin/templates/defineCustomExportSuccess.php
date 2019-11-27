<div class="formpage">
    <div class="navigation">
        <input type="button" class="backbutton" value="<?php echo __("Back") ?>" onclick="goBack();"/>
    </div>
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Define Custom Export") ?></h2></div>
        <form name="frmCustomExport" id="frmCustomExport" method="post" action="<?php echo url_for('admin/saveCustomExport') ?>">
            <input type="hidden" name="sqlState" value=""/>
            <input type="hidden" id="txtId" name="txtId" value="<?php echo $id; ?>"/>
            <input type="hidden" name="txtExportId" value="<?php echo $export_id; ?>"/>
            <label for="txtFieldName"><?php echo "Name"; ?><span class="required">*</span></label>
            <input type="text" id="txtFieldName" name="txtFieldName" tabindex="2" value="<?php echo $name; ?>"
                   onkeyup="checkName();" class="formInputText"/>
            <div id="messageCell" class="error" style="display:block; float: left; margin:10px;">&nbsp;</div>
            <br class="clear"/>
            <div class="formbuttons">
                <input type="button" class="savebutton" id="saveBtn" onclick="this.form.submit();"
                       tabindex="3" onmouseover="moverButton(this);" onmouseout="moutButton(this);"
                       value="<?php echo "Save"; ?>" />
                <input type="reset" class="clearbutton" tabindex="4"
                       onmouseover="moverButton(this);" onmouseout="moutButton(this);"
                       value="<?php echo "Reset"; ?>" />
            </div>

            <table border="0">
                <tr>
                    <th width="100" style="align:center;">Available Fields</th>
                    <th width="100"/>
                    <th width="125" style="align:center;">Assigned Fields</th>
                </tr>
                <tr><td width="100" >
                        <select size="10" id="cmbAvailableFields" name="cmbAvailableFields[]" style="width:125px;"
                                ondblclick="optionMoveFields('cmbAvailableFields', 'cmbAssignedFields');"	multiple="multiple">
                                    <?php foreach ($availableFields as $field) {
                                        if (!isset($selected[$field])) {
 ?>
                                    <option value="<?php echo $field; ?>"><?php echo $field; ?></option>
<?php }
                                    } ?>
                                </select></td>
                            <td align="center" width="100">
                                <input type="button" name="btnAssignField" id="btnAssignField" onclick="optionMoveFields('cmbAvailableFields', 'cmbAssignedFields');" value=" <?php echo "Add"; ?> &gt;"
                                       class="plainbtn" onmouseover="moverButton(this);" onmouseout="moutButton(this);" style="width:80%"/><br /><br />
                                <input type="button" name="btnRemoveField" id="btnRemoveField" onclick="optionMoveFields('cmbAssignedFields', 'cmbAvailableFields');" value="&lt; <?php echo "Remove"; ?>"
                                       class="plainbtn" onmouseover="moverButton(this);" onmouseout="moutButton(this);" style="width:80%"/>
                            </td>
                            <td>
                                <select size="10" name="cmbAssignedFields[]" id="cmbAssignedFields" style="width:125px;"
                                        ondblclick="optionMoveFields('cmbAssignedFields', 'cmbAvailableFields');"	multiple="multiple">
                            <?php foreach ($selected as $item) {
 ?>
                                        <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
<?php } ?>
                                </select></td>
                            <td><img id="btnMoveUp" onclick="moveVertical('up', 'cmbAssignedFields');" alt="<?php echo 'Move selected fields up'; ?>" title="<?php echo 'Move selected fields up'; ?>"
                                     src="<?php echo public_path('../../themes/orange/icons/up.gif'); ?>"/><br /><br />
                                <img id="btnMoveDown" onclick="moveVertical('down', 'cmbAssignedFields');" alt="<?php echo 'Move selected fields down'; ?>" title="<?php echo 'Move selected fields down'; ?>" src="<?php echo public_path('../../themes/orange/icons/down.gif'); ?>"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        //<![CDATA[
        if (document.getElementById && document.createElement) {
            roundBorder('outerbox');
        }
        //]]>
    </script>
</div>