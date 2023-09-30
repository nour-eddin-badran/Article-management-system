<?php

namespace App\Helpers;

class TemplateHelper
{
    public static function active_class($path, $active = 'active')
    {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }

    public static function is_active_route($path)
    {
        return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
    }

    public static function show_class($path)
    {
        return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
    }


    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}