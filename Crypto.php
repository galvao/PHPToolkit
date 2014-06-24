<?php
require 'class/Crypto.php';
use PHPToolkit\Crypto;

define('CIPHER', MCRYPT_3DES);
define('MODE', MCRYPT_MODE_CFB);
define('KEY', 'ab10irhfpoer12sjkloitsaq');
define('IV', 'de2njf09');

try {
    $c = new Crypto();
    $c->encrypt('foo');
    echo $c->output() . PHP_EOL;
    $c->decrypt('RaXV');
    echo $c->output() . PHP_EOL;
} catch (\Exception $e) {
    die($e->getMessage() . PHP_EOL);
}
