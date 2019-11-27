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
 */
?>
<?php

/*
 * This Utility will convert old style language constants in given php file to symfony language constants.
 * eg:
 * <?php echo $lang_common_Save;?> => <?php echo __("Save");?>
 *
 * The language constants are looked up from lang_default_full.php file.
 */

if ($argc != 2) {
    showUsage();
    exit;
}

$inputFile = $argv[1];

define('ROOT_PATH', dirname(__FILE__) . '/../');

include ROOT_PATH . "/language/default/lang_default_full.php";

$arrayObj = new ArrayObject(get_defined_vars());

$patterns = array();
$replacements = array();

// 
// Get all defined language constants
//
for($iterator = $arrayObj->getIterator(); $iterator->valid(); $iterator->next()) {

    $value = $iterator->current();
    $name = $iterator->key();

    // Only replace non-array variables that start have names starting with 'lang'
    if ( !is_array($current) && (strpos($name, 'lang') === 0) ){

       $patterns[] = '/\$'. $name . '\b/';
       $replacements[] = '__("' . $value . '")';
       
       //echo '$' . $iterator->key() . ' => __("' . $iterator->current() . "\");\n";
    }
}

// open file
echo "Replacing language constants in file $inputFile....\n";
$fileContents = file($inputFile);

// replace constants
$count = 0;
$fileContents = preg_replace($patterns, $replacements, $fileContents, -1, $count);

// rewrite file
file_put_contents($inputFile, $fileContents);
echo "Replaced $count occurrences of language constants.\n";

/**
 * Usage message    
 */
 function showUsage() {

    $message = <<< ENDSTR


Usage: php convert_lang_constants.php <template_file>

eg:
   php convert_lang_constants.php 

This will convert old style language constants in given php file to symfony language constants.
eg:
echo \$lang_common_Save; => echo __("Save");

The language constants are looked up from lang_default_full.php file.


ENDSTR;
    echo $message;
}
