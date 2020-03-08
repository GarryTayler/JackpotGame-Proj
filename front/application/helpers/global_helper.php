<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('generateRandomString')) {

    function generateRandomString( $length = 10 ) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;

    }   
    
}

if ( ! function_exists('getCurrentTimeStamp')) {

    function getCurrentTimeStamp( ) {

        $date = date("Y-m-d")." 00:00:00";
        $datetime = new DateTime($date);

        return $datetime->getTimestamp();        

    }   
    
}

if ( ! function_exists('or_default')) {
    function or_default ( $value, $default ) {
        if (empty($value)) return $default;
        return $value;
    }
}
