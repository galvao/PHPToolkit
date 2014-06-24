<?php
namespace PHPToolkit;

/**
 * A wrapper for encrypting and decrypting data using mcrypt functions in PHP
 *
 * @package PHPToolkit
 * @link https://github.com/galvao/PHPToolkit
 * @author Er Galvão Abbott <galvao@galvao.eti.br>
 */

class Crypto
{
    private $result;

    /**
     * Constructor - Initializes the necessary properties and check for errors
     *
     * @return object
     *
     * @throws Exception If mcrypt is not loaded or the configuration constants aren't defined
     * or if key and vector sizes are wrong. I could have used parameters to the class, but
     * since the most common use is to define key, vector, mode and cipher as constants I've left at that.
     */

    public function __construct()
    {
        if (!extension_loaded('mcrypt')) {
            throw new \Exception('Mcrypt extension not loaded.');
        }

        if (!defined('CIPHER')) {
            throw new \Exception('Cipher not defined.');
        }

        if (!defined('KEY')) {
            throw new \Exception('Key not defined.');
        }

        if (!defined('MODE')) {
            throw new \Exception('Mode not defined.');
        }

        if (!defined('IV')) {
            throw new \Exception('Initialization Vector not defined.');
        }

        $keySize = strlen(KEY);
        $IVSize = strlen(IV);
        $requiredKeySize = mcrypt_get_key_size(CIPHER, MODE);
        $requiredIVSize = mcrypt_get_iv_size(CIPHER, MODE);

        if ($keySize != $requiredKeySize) {
            throw new \Exception('Incorrect size for Cryptographic Key. Expected: ' . $requiredKeySize . ' characters. Found: ' . $keySize);
        }

        if ($IVSize != $requiredIVSize) {
            throw new \Exception('Incorrect size for Initialization Vector. Expected: ' . $requiredIVSize . ' characters. Found: ' . $IVSize);
        }
    }

    public function encrypt($data, $baseEncode = true)
    {
        $this->result = mcrypt_encrypt(CIPHER, KEY, $data, MODE, IV);

        if ($baseEncode) {
            $this->result = base64_encode($this->result);
        }
    }

    public function decrypt($data, $baseDecode = true)
    {
        if ($baseDecode) {
            $data = base64_decode($data);
        }

        $this->result = mcrypt_decrypt(CIPHER, KEY, $data, MODE, IV);
    }

    public function output()
    {
        return $this->result;
    }
}
