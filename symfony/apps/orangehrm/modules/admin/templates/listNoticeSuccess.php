<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.autocomplete.js') ?>"></script>

<div class="outerbox">
    <div class="maincontent">

        <div class="mainHeading"><h2><?php echo __("Notice Summary") ?></h2></div>
        <?php echo message() ?>
        <form name="frmSearchBox" id="frmSearchBox" method="post" action="">
            <input type="hidden" name="mode" value="search"/>
            <div class="searchbox">
                <label for="searchMode"><?php echo __("Search By") ?></label>
                <select name="searchMode" id="searchMode">
                    <option value="all"><?php echo __("--Select--") ?></option>
                    
                    <option value="notice_name" <?php
                            if ($searchMode == 'notice_name') {
                                echo "selected";
                            }
        ?>><?php echo __("Notice Title") ?></option>

                </select>

                <label for="searchValue">Search For:</label>
                <input type="text" size="20" name="searchValue" id="searchValue" value="<?php echo $searchValue ?>" />
                <input type="submit" class="plainbtn" id="btnSearch"
                       value="<?php echo __("Search") ?>" />
                <input type="reset" class="plainbtn" id="btnreset"
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
            <div class="pagingbar"> </div>
            <br class="clear" />
        </div>
        <br class="clear" />
        <form name="standardView" id="standardView" method="post" action="<?php echo url_for('admin/deleteNotice') ?>">
            <input type="hidden" name="mode" id="mode" value=""/>
            <table cellpadding="0" cellspacing="0" class="data-table">
                <thead>
                    <tr>
                        <td width="50">

                            <input type="checkbox" class="checkbox" name="allCheck" value="" id="allCheck" />

                        </td>
                        <td scope="col">
                            <?php
                            if ($userCulture == 'en') {
                                $notice_name = 'no.notice_name';
                            } else {
                                $notice_name = 'no.notice_name_'.$userCulture;
                            }
                            ?>
                            <?php echo $sorter->sortLink($notice_name, __('Notice Title'), '@noticeAdmin', ESC_RAW); ?>
                        </td>
                        <td scope="col">
                            <?php echo $sorter->sortLink('no.from_date', __('From Date'), '@noticeAdmin', ESC_RAW); ?>
                        </td>
                        <td scope="col">
                            <?php echo $sorter->sortLink('no.to_date', __('To Date'), '@noticeAdmin', ESC_RAW); ?>

                        </td>                       
                    </tr>
                </thead>

                <tbody>
                    <?php
                            $row = 0;
                           
                            foreach ($listNotice as $Notice) {
                                $cssClass = ($row % 2) ? 'even' : 'odd';
                                $row = $row + 1;                                
                    ?>
                                <tr class="<?php echo $cssClass ?>">
                                    <td >
                                        <input type='checkbox' class='checkbox innercheckbox' name='chkLocID[]' id="chkLoc" value='<?php echo $Notice->notice_code ?>' />
                                    </td>

                                    <td class="">

                                        <a href="<?php echo url_for('admin/saveNotice?id=' . $Notice->notice_code) ?>"><?php
                                if ($userCulture == 'en') {
                                    echo $Notice->notice_name;
                                } else {
                                    
                                    $abc = 'notice_name_' . $userCulture;
                                    
                                    if (!strlen($Notice->$abc)) {
                                        echo $Notice->notice_name;
                                    }
                                    else{
                                        echo $Notice->$abc;
                                    }
                                }
                    ?></a>

                        </td>

                        <td class="">
                            <?php
                                echo $Notice->from_date;
                            ?>
                            </td>

                            <td class="">
                            <?php
                                echo $Notice->to_date;
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

                //When click add button
                $("#buttonAdd").click(function() {
                    location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/saveNotice')) ?>";
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

 //When click Search Button
        $("#btnSearch").click(function() {
            $("#mode").attr('value', 'save');

            var searchMode = $('#searchMode');
            
            if($("#searchValue").val()==""){
                    alert("<?php echo __('Please enter search value') ?>");

                    return false;
                }
            if (searchMode.val() == 'all')  {
                alert('<?php echo __("Please select a field to search") ?>');
                searchMode.focus();
                return false;
            } else {
                $('#frmSearchBox').submit();
                return true;
            }
        });


        //When click remove button
        $("#buttonRemove").click(function() {
            $("#mode").attr('value', 'delete');
            $("#standardView").submit();
        });

        //When click Save Button
        $("#buttonRemove").click(function() {
            $("#mode").attr('value', 'save');
            $("#standardView").submit();
        });


                //When click reset buton
        $("#btnreset").click(function() {
            location.href="<?php echo url_for('admin/listNotice') ?>";
        });



    });


</script>

