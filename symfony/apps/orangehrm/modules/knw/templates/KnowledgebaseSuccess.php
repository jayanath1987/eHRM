<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.autocomplete.js') ?>"></script>

<div class="outerbox">
    <div class="maincontent">

        <div class="mainHeading"><h2><?php echo __("Knowledge Base") ?></h2></div>
        <?php echo message() ?>
        <form name="frmSearchBox" id="frmSearchBox" method="post" action="" onsubmit="return validateform();">
            <input type="hidden" name="mode" value="search">
            <div class="searchbox">
                <label for="searchMode"><?php echo __("Search Within") ?></label>


                <select name="searchMode" id="searchMode">
                    <option value="all"><?php echo __("--Select--") ?></option>
                    <option value="alltime" <?php if ($searchMode == 'alltime') {
            echo "selected";
        } ?>><?php echo __("All Time") ?></option>
                    <option value="10days" <?php if ($searchMode == '10days') {
            echo "selected";
        } ?>><?php echo __("Last 10 days") ?></option>
                    <option value="30days" <?php if ($searchMode == '30days') {
            echo "selected";
        } ?>><?php echo __("Last 30 days") ?></option>
                    <option value="90days" <?php if ($searchMode == '90days') {
            echo "selected";
        } ?>><?php echo __("Last 90 days") ?></option>
                    <option value="lastyear" <?php if ($searchMode == 'lastyear') {
            echo "selected";
        } ?>><?php echo __("Last year") ?></option>
                </select>
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Search In") ?>  </label>
                <select name="searchValue1" class="searchbox" style="width: 150px;" tabindex="4" id="searchValue1">
                    <option value="" <?php if ($searchValue1 == "") {
                            echo "selected";
                        } ?>><?php echo __("--Select--") ?></option>
                    <option value="all" <?php if ($searchValue1 == "all") {
                            echo "selected";
                        } ?>><?php echo __("all") ?></option>
<?php foreach ($Doctype as $promotionftype) { ?>
                            <option value="<?php echo $promotionftype->getKnw_doc_id() ?>" <?php if ($searchValue1 == $promotionftype->getKnw_doc_id()) {
                                echo "selected";
                            } ?> ><?php
                            //echo $promotionftype->getPrm_method_comment_en()
                            if ($Culture == 'en') {
                                $abcd = "getKnw_doc_name";
                            } else {
                                $abcd = "getKnw_doc_name_" . $Culture;
                            }
                            if ($promotionftype->$abcd() == "") {
                                echo $promotionftype->getKnw_doc_name();
                            } else {
                                echo $promotionftype->$abcd();
                            }
?></option>
<?php } ?>
                    </select>

                    <label for="searchValue"><?php echo __("Search For") ?></label>
                    <input type="text" size="20" name="searchValue" id="searchValue" value="<?php echo $searchValue ?>" />
                    <br class="clear">
                </div>
                <div class="actionbar" style="width: 550px;">
                    <div class="actionbuttons" >
                        <input type="submit" class="plainbtn"
                               value="<?php echo __("Search") ?>" />
                        <input type="reset" class="plainbtn"
                               value="<?php echo __("Reset") ?>" id="resetBtn"/>
                    </div>

                </div>
            </form>
            <div class="noresultsbar"></div>
            <div class="pagingbar"><?php echo is_object($pglay) ? $pglay->display() : ''; ?> </div>
        <br class="clear" />
    </div>
    <form name="standardView" id="standardView" method="post" action="<?php echo url_for('knw/DeleteAttachment') ?>">
        <input type="hidden" name="mode" id="mode" value=""/>
        <table cellpadding="0" cellspacing="0" class="data-table">
            <thead>
                <tr>
                    <td width="50">

                    </td>


                    <td scope="col">

<?php echo __('Document Title'); ?>
                            </td>
                            <td scope="col">
<?php echo __('Posted Date'); ?>			
                            </td>
                            <td scope="col">

                        <?php echo __('Updated Date'); ?>
                    </td>
                </tr>
            </thead>

            <tbody>
                        <?php
                        $row = 0;
                        foreach ($knwdoctype as $reasons) {
                            $cssClass = ($row % 2) ? 'even' : 'odd';
                            $row = $row + 1;
                        ?>
                    <tr class="<?php echo $cssClass ?>">
                        <td >
                        </td>

                        <td class="">
<?php
                            if ($Culture == 'en') {
                                echo $reasons->getKnw_atd_title();
                            } else {
                                $abc = 'getKnw_atd_title_' . $Culture;
                                echo $reasons->$abc();
                                if ($reasons->$abc() == null) {
                                    echo $reasons->getKnw_atd_title();
                                }
                            }
?>
                        </td>
                        <td class="">
<?php echo LocaleUtil::getInstance()->formatDate($reasons->getKnw_atd_post_date()); ?>
                        </td>
                        <td class="">
                        <?php echo LocaleUtil::getInstance()->formatDate($reasons->getKnw_atd_update_date()); ?>

                        </td>
                        <td class="">

<?php
                            $kk = $knwDao->readattach($reasons->getKnw_atd_id(), $reasons->getKnw_doc_id());
                            foreach ($kk as $rowa) {
                                if ($rowa['count'] == 1) {
                                    $abc = abc;
                                    $kk2 = $knwDao->readAttachment2($reasons->getKnw_atd_id(), $reasons->getKnw_doc_id());
                                    if ($kk2[0]['count'] == 1) {
                                        $efg = 1
?>
                                                <a href="#" onclick="popupimage1(link='<?php echo url_for('knw/imagepop?id='); ?><?php echo $reasons->getKnw_atd_id() . '?did=' . $reasons->getKnw_doc_id(); ?>')"><?php echo __("Attachment"); ?></a>
<?php
                                    }
                                    $kk3 = $knwDao->readAttachment3($reasons->getKnw_atd_id(), $reasons->getKnw_doc_id());
                                    if ($kk3[0]['count'] == 1) {
?>
                                                <a href="#" onclick="popupimage(link='<?php echo url_for('knw/readArticle?id='); ?><?php echo $reasons->getKnw_atd_id() . '?did=' . $reasons->getKnw_doc_id(); ?>')"><?php echo __("view"); ?></a><?php
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
        <script type="text/javascript">
            function popupimage(link){
                window.open(link, "myWindow",
                "top=100 left=25 status = 1, height = 450, width = 950, resizable = 0" )
            }
            function popupimage1(link){
                window.open(link, "myWindow",
                " status = 1, height = 300, width = 300, resizable = 0" )
            }
            function validateform(){

                if($("#searchValue").val()=="")
                {

                    alert("<?php echo __('Please enter search value') ?>");
                    return false;

                }
                if($("#searchMode").val()=="all"){
                    alert("<?php echo __('Please select the Search Within') ?>");
                    return false;
                }
                if($("#searchValue1").val()==""){
                    alert("<?php echo __('Please select the Serach In') ?>");
                    return false;
                }
                else{
                    $("#frmSearchBox").submit();
                }

            }
            $(document).ready(function() {

                //When click add button
                $("#buttonAdd").click(function() {
                    location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/knw/SaveAttachment')) ?>";

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

                    //$("#standardView").submit();
                    answer = confirm("<?php echo __("Are you sure want to delete?") ?>");

                    if (answer !=0)
                    {
                        $("#mode").attr('value', 'delete');
                        $("#standardView").submit();
                        return true;

                    }
                    else{
                        return false;
                    }
                });
                //When click reset buton
                $("#resetBtn").click(function() {
                    location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/knw/Knowledgebase')) ?>";
        });

        //When click Save Button
        $("#buttonRemove").click(function() {
            $("#mode").attr('value', 'save');
        });



    });


</script>
