<?php
    function encryption($key, $data) {
        // Define the encryption method
        $method = "AES-256-CBC";
        
        // Generate a random initialization vector (IV)
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));

        // Encrypt the data
        $encrypted = openssl_encrypt($data, $method, $key, 0, $iv);

        // Concatenate the IV and the encrypted data
        $encrypted = base64_encode($iv.$encrypted);

        return $encrypted;
    }
?>