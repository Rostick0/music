<?php

namespace App\Utils;

use App\Models\License;

class LicenseCode
{
    public static function unic(): string
    {
        $random_code = GeneratorString::randomCode();

        for (;;) {
            if (License::where('code', $random_code)->count() > 0) {
                $random_code = GeneratorString::randomCode();
            }

            return $random_code;
        }
    }

    public static function normalize($code): string
    {
        $modified_code = substr_replace($code, '-', 4, 0);
        $modified_code = substr_replace($modified_code, '-', -4, 0);

        return $modified_code;
    }
}
