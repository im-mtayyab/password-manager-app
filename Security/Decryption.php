<?php 
    function decryption($encrypted, $key) {
        // Define the encryption method
        $method = "AES-256-CBC";

        // Decode the encrypted data
        $encrypted = base64_decode($encrypted);

        // Extract the IV and the encrypted data
        $iv = substr($encrypted, 0, openssl_cipher_iv_length($method));
        $encrypted = substr($encrypted, openssl_cipher_iv_length($method));

        // Decrypt the data
        $decrypted = openssl_decrypt($encrypted, $method, $key, 0, $iv);

        return $decrypted;
    }
?>