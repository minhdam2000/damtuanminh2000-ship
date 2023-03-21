<?php
namespace App;

class Cripto{
    //Generate AES 256 and convert to hexa
    const VALUE_LENTH = 32;

    public static function String2Hex($string){
        $hex='';
        for ($i=0; $i < strlen($string); $i++){
            $hex .= dechex(ord($string[$i]));
        }
        return $hex;
    }

    public static function generateAESKey(){
        $ret = openssl_random_pseudo_bytes(Cripto::VALUE_LENTH);
        if(is_null($ret) || $ret == false){
            return NULL;
        }
        return bin2hex($ret);
    }
}

// openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));