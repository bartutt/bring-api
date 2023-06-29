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
                'city' => $value->city,
                'url' => $value->city
            ];
        }

        return $parsed;
    }

  
}
