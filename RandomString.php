<?php
require 'class/RandomString.php';
use PHPToolkit\RandomString;

/* Example of usage of the Random String class
 * Produces a 32 character long string, containing only symbols,
 * without quotes and backslash
 */

$r = new RandomString(32, array('symbols'), array('"', "'", '\\'));
echo '[' . $r->result . '] ' . strlen($r->result) .  "\n";