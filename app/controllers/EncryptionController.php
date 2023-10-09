<?php
class EncryptionController {
    private static $encryptionKey = 'F345E5CDE73AA264BB44C818DBD43C4B';
    private static $iv = 'e3c633b643e36ba2bfa22f444cff4741';

    public static function encrypt($data) {
        try {
            $iv = hex2bin(self::$iv);
            $encryptedData = openssl_encrypt($data, 'aes-256-cbc', self::$encryptionKey, 0, $iv);

            if ($encryptedData === false) {
                throw new Exception('Erro na criptografia: ' . openssl_error_string());
            }

            return base64_encode($iv . $encryptedData);
        } catch (Exception $e) {
            // phpinfo();
            // echo '<pre>';
            // print_r($e);
            // die;
        }
    }

    public static function decrypt($encryptedData) {
        try {
            $data = base64_decode($encryptedData);
            $iv = hex2bin(self::$iv);
            $encryptedData = substr($data, 16);
            $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', self::$encryptionKey, 0, $iv);

            if ($decryptedData === false) {
                throw new Exception('Erro na descriptografia.');
            }

            return $decryptedData;
        } catch (Exception $e) {
            // phpinfo();
            // echo '<pre>';
            // print_r($e);
            // die;
        }
    }
    
}
