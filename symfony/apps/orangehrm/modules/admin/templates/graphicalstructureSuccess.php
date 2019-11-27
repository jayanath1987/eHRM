<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery-ui.min.js') ?>"></script>
<link href="<?php echo public_path('../../themes/orange/css/jquery/jquery-ui.css') ?>" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<link href="../../themes/orange/css/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo public_path('../../scripts/time.js') ?>"></script>


<div style="width: 800px"class="formpage4col" >
    <div class="navigation">

        <?php echo message() ?>

    </div>
    <div id="status" align="center"  ></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Company Hierache") ?></h2></div>
        <br class="clear">
        <div id="viewstructure">
        </div>
                                    </div>
                            </div>

<script type="text/javascript">
// <![CDATA[

            $(document).ready(function() { 
    var level1="";var level2="";var level3="";var level4="";var level5="";
    var level6="";var level7="";var level8="";var level9="";var level10="";


        <?php
        foreach ($list as $row){
            if ($row->parnt == 0 && $row->def_level == 1) {
            ?>
              level1+="<label style='width: 700px; text-align:center'>"+"<?php  echo $row->title ?>"+"</label>";
        <?php } else if ($row->def_level == 2) { ?>
              level2+="<label style='width: 100px;'>"+"<?php  echo $row->title ?>"+"</label>";
                <?php } else if ($row->def_level == 3) { ?>
              level3+="<label style='width: 100px;'>"+"<?php  echo $row->title ?>"+"</label>";
                      <?php } else if ($row->def_level == 4) { ?>
              level4+="<label style='width: 100px;'>"+"<?php  echo $row->title ?>"+"</label>";
                      <?php } else if ($row->def_level == 5) { ?>
              level5+="<label style='width: 100px;'>"+"<?php  echo $row->title ?>"+"</label>";
                      <?php } else if ($row->def_level == 6) { ?>
              level6+="<label style='width: 100px;'>"+"<?php  echo $row->title ?>"+"</label>";
                      <?php } else if ($row->def_level == 7) { ?>
              level7+="<label style='width: 100px;'>"+"<?php  echo $row->title ?>"+"</label>";
                      <?php } else if ($row->def_level == 8) { ?>
              level8+="<label style='width: 100px;'>"+"<?php  echo $row->title ?>"+"</label>";
                      <?php } else if ($row->def_level == 9) { ?>
              level9+="<label style='width: 100px;'>"+"<?php  echo $row->title ?>"+"</label>";
                      <?php } else if ($row->def_level == 10) { ?>
              level10+="<label style='width: 100px;'>"+"<?php  echo $row->title ?>"+"</label>";
       
       <?php }
        
        }?>
        var view="";
            view+=level1+"<br>";
            view+="<div style='widows: 700px; border-style: dotted;' align='center' >"+level2+"</div><br>";
            view+="<div style='widows: 700px; border-style: dotted;' align='center' >"+level3+"</div><br>";
            view+="<div style='widows: 700px; border-style: dotted;' align='center'>"+level4+"</div><br>";
            view+="<div style='widows: 700px; border-style: dotted;' align='center'>"+level5+"</div><br>";
            view+="<div style='widows: 700px; border-style: dotted;' align='center'>"+level6+"</div><br>";
            view+="<div style='widows: 700px; border-style: dotted;' align='center'>"+level7+"</div><br>";
            view+="<div style='widows: 700px; border-style: dotted;' align='center'>"+level8+"</div><br>";
            view+="<div style='widows: 700px; border-style: dotted;' align='center'>"+level9+"</div><br>";
            view+="<div style='widows: 700px; border-style: dotted;' align='center'>"+level10+"</div><br>";

        $("#viewstructure").html(view);
  
                });
    // ]]>
</script>




