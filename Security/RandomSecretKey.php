<?php
function generateSecretKey() {
    $key = bin2hex(openssl_random_pseudo_bytes(32));
    return $key;
}
?>