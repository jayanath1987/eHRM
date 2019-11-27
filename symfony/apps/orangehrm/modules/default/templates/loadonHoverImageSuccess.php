<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$encrypt=new EncryptionHandler();


?>
<span id="Currentimage">
                        <img id="currentImage" style="width:150px; height:150px; padding-left:5px; padding-bottom: 0px; border:none;" alt="Employee Photo"
                             src="<?php echo url_for("pim/viewPhoto?id=" . $encrypt->encrypt($_SESSION['PIM_EMPID'])); ?>" />

                   </span>