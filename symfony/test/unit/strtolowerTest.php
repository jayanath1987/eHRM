<?php
 
include(dirname(__FILE__).'/../bootstrap/unit.php');
//require_once(dirname(__FILE__).'/../../lib/strtolower.php');
 
$t = new lime_test(1, new lime_output_color());
 
// strtolower()
$t->is('foo', 'foo',
    'strtolower() transforms empty strings into foo');