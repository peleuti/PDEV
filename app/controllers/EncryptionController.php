<?php
class EncryptionController {
    private static $encryptionKey = 'v3rs0t3hc';

    public static function encrypt($data) {
        $ivSize = openssl_cipher_iv_length('aes-256-cbc');
        $iv = openssl_random_pseudo_bytes($ivSize);
        $encryptedData = openssl_encrypt($data, 'aes-256-cbc', self::$encryptionKey, 0, $iv);
        return base64_encode($iv . $encryptedData);
    }

    public static function decrypt($encryptedData) {
        $data = base64_decode($encryptedData);
        $ivSize = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($data, 0, $ivSize);
        $encryptedData = substr($data, $ivSize);
        return openssl_decrypt($encryptedData, 'aes-256-cbc', self::$encryptionKey, 0, $iv);
    }
}

?>
