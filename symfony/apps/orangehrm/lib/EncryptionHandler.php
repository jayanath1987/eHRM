<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module Attachtype Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class EncryptionHandler {

    public function __construct(){

    }

    /**
     * Return encrypted data
     */
    public function encrypt($string) {
        $key = session_id();
        $encryptedString = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));

        //Remove '/' and '+'
        $encryptedString = str_replace('/', 'aDfs234',$encryptedString);
        $encryptedString = str_replace('+', 'yMH28GH',$encryptedString);

        return $encryptedString;
    }

    /**
     * Return decrypted data
     */
    public function decrypt($string) {
        $key = session_id();

        //Remove '/' and '+'
        $string = str_replace('aDfs234', '/',$string);
        $string = str_replace('yMH28GH', '+',$string);

        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    }

}
?>
