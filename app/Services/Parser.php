<?php

namespace App\Services;


class Parser
{
    public static function parse($fn, $items)
    {
        return self::$fn($items);
    }

    public static function fromPostalCode($items)
    {
        $parsed = [];

        foreach ($items->postal_codes as $key => $value) {
            $parsed[] = [
                'name' => $value->city,
                "code" => $value->postal_code,
                "county" => $value->county,
            ];
        }

        return $parsed;
    }

  
}
