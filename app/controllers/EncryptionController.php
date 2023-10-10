<?php

class EncryptionController
{
    private static $method = 'aes-256-cbc';
    private static $encryptionKey = 'F345E5CDE73AA264';

    public static function encrypt($data)
    {
        try {
            $ivSize = openssl_cipher_iv_length(self::$method);
            $iv = openssl_random_pseudo_bytes($ivSize);
            $encryptedData = openssl_encrypt($data, self::$method, self::$encryptionKey, 0, $iv);
            if ($encryptedData === false) {
                throw new Exception('Erro na criptografia: ' . openssl_error_string());
            }

            return base64_encode(bin2hex($iv) . '.' . $encryptedData);
        } catch (Exception $e) {
            // phpinfo();
            // echo '<pre>';
            // print_r($e);
            // die;
        }
    }

    public static function decrypt($encryptedData)
    {
        try {
            $decrypted = base64_decode($encryptedData);

            $crypted = explode('.', $decrypted);
            if (count($crypted) !== 2) {
                throw new Exception('Erro na descriptografia.');
            }

            $iv = hex2bin($crypted[0]);
            $data = $crypted[1];

            $decryptedData = openssl_decrypt($data, self::$method, self::$encryptionKey, 0, $iv);
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
