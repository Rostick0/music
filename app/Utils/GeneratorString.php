<?php

namespace App\Utils;

class GeneratorString
{
    public static function randomCode($length = 15, $characters = 'ABCDE1234567890'): string
    {
        $code = '';
        $charsCount = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, $charsCount - 1);
            $code .= $characters[$randomIndex];
        }

        return $code;
    }
}
