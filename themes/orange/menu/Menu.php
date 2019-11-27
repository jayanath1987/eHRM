<?php

/**
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 *
 */

require_once ROOT_PATH . '/lib/common/menu/MenuRenderer.php';

/**
 * Menu renderer for orange theme
 */
class Menu implements MenuRenderer {
	
	public function getCSS() {
?>	
	<link href="themes/orange/menu/menu.css" rel="stylesheet" type="text/css"/>
	
<?php /* Fix for the IE6 problems with :hover support etc. 
         Shouldn't really be needed for IE7, but doesn't work in that browser as well, without following CSS. */
?>
<!--[if IE]>
<link href="themes/orange/menu/IE6_menu.css" rel="stylesheet" type="text/css">
<![endif]--> 	

<!--[if lte IE 6]>
<style type="text/css">
#top-menu {
    /*width:expression(document.body.clientWidth < 1000 ? "900px" : "100%" );*/
}
</style>
<![endif]--> 	
 

<?php	 	
	}
	
	public function getJavascript($menu) {
?>
<script type="text/javaScript"><!--//--><![CDATA[//><!--
var dropdownMenuHidden = false;

function menuclicked(item) {
	var topUl = document.getElementById('nav');
	var uls = topUl.getElementsByTagName('ul');
	for(var i=0; i<uls.length; i++) {
	    ul = uls[i];
	    ul.style.left = '-999em';
	}
	dropdownMenuHidden = true;	
}

function topMenuHover() {
    if (dropdownMenuHidden) {
		var topUl = document.getElementById('nav');
		var uls = topUl.getElementsByTagName('ul');
		for(var i=0; i<uls.length; i++) {
		    ul = uls[i];
		    ul.style.left = '';
		}        
    }
}
//--><!]]></script>


	
<?php 
/* Fix for the IE6 "Background image flicker bug". (http://www.mister-pixel.com) */
?>
<!--[if lte IE 6]>
<script language="JavaScript">
try {
  document.execCommand("BackgroundImageCache", false, true);
} catch(err) {}
</script>
<![endif]--> 
	
<?php		
	}
	
	public function getMenu($menu, $optionMenu, $welcomeMessage) {
?>

<!--  show menu -->
    

<?php
// End of the get menu
	}
	
	public function getMenuHeight() {
		return 40;
	}
	
	public function getMenuWidth() {
		return 0;
	}

	
}
?>


