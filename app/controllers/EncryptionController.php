<?php
class EncryptionController {
    private static $encryptionKey = '123';

    public static function encrypt($data) {
        try {
            $ivSize = openssl_cipher_iv_length('aes-256-cbc');
            $iv = openssl_random_pseudo_bytes($ivSize);
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
            $ivSize = openssl_cipher_iv_length('aes-256-cbc');
            $iv = substr($data, 0, $ivSize);
            $encryptedData = substr($data, $ivSize);
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

?>
