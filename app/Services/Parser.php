<?php

namespace App\Services;


class Parser
{
    public const SVG_CALENDAR = '<svg xmlns="http://www.w3.org/2000/svg" width="17.293" height="19.764" viewBox="0 0 17.293 19.764"><path id="Icon_awesome-calendar-alt" data-name="Icon awesome-calendar-alt" d="M0,17.911a1.853,1.853,0,0,0,1.853,1.853H15.44a1.853,1.853,0,0,0,1.853-1.853V7.411H0Zm12.352-7.566a.465.465,0,0,1,.463-.463H14.36a.465.465,0,0,1,.463.463v1.544a.465.465,0,0,1-.463.463H12.816a.465.465,0,0,1-.463-.463Zm0,4.941a.465.465,0,0,1,.463-.463H14.36a.465.465,0,0,1,.463.463V16.83a.465.465,0,0,1-.463.463H12.816a.465.465,0,0,1-.463-.463ZM7.411,10.345a.465.465,0,0,1,.463-.463H9.419a.465.465,0,0,1,.463.463v1.544a.465.465,0,0,1-.463.463H7.875a.465.465,0,0,1-.463-.463Zm0,4.941a.465.465,0,0,1,.463-.463H9.419a.465.465,0,0,1,.463.463V16.83a.465.465,0,0,1-.463.463H7.875a.465.465,0,0,1-.463-.463ZM2.47,10.345a.465.465,0,0,1,.463-.463H4.478a.465.465,0,0,1,.463.463v1.544a.465.465,0,0,1-.463.463H2.934a.465.465,0,0,1-.463-.463Zm0,4.941a.465.465,0,0,1,.463-.463H4.478a.465.465,0,0,1,.463.463V16.83a.465.465,0,0,1-.463.463H2.934a.465.465,0,0,1-.463-.463ZM15.44,2.47H13.588V.618A.619.619,0,0,0,12.97,0H11.735a.619.619,0,0,0-.618.618V2.47H6.176V.618A.619.619,0,0,0,5.559,0H4.323a.619.619,0,0,0-.618.618V2.47H1.853A1.853,1.853,0,0,0,0,4.323V6.176H17.293V4.323A1.853,1.853,0,0,0,15.44,2.47Z" fill="#104df5"/></svg>';
    public const SVG_GUITAR = '<svg xmlns="http://www.w3.org/2000/svg" width="21.071" height="21.072" viewBox="0 0 21.071 21.072"><path id="guitar" d="M20.7,1.606,19.465.371A1.374,1.374,0,0,0,18.518,0a1.326,1.326,0,0,0-.906.371L15.717,2.306a1.6,1.6,0,0,0-.371.577l-.494,1.483L11.722,7.5a5.563,5.563,0,0,0-1.689-.782,3.834,3.834,0,0,0-3.665.906,3.656,3.656,0,0,0-.865,1.4,2.086,2.086,0,0,1-1.73,1.4,3.977,3.977,0,0,0-2.553,1.194A4.363,4.363,0,0,0,.026,15.2,6.58,6.58,0,0,0,1.962,19.15a6.5,6.5,0,0,0,3.912,1.894A4.549,4.549,0,0,0,9.5,19.891,4.576,4.576,0,0,0,10.652,17.3a2.088,2.088,0,0,1,1.441-1.73,3.118,3.118,0,0,0,1.359-.865,3.752,3.752,0,0,0,.865-3.665,5.563,5.563,0,0,0-.782-1.689l3.13-3.13,1.524-.494a1.71,1.71,0,0,0,.535-.371l1.936-1.894a1.259,1.259,0,0,0,.412-.906A1.374,1.374,0,0,0,20.7,1.606ZM8.551,14.5a2.149,2.149,0,0,1-1.4-.577h0a2.149,2.149,0,0,1-.577-1.4,2.149,2.149,0,0,1,.577-1.4,2.149,2.149,0,0,1,1.4-.577,1.99,1.99,0,0,1,1.359.577,1.906,1.906,0,0,1,.577,1.4,1.983,1.983,0,0,1-.535,1.4A2.149,2.149,0,0,1,8.551,14.5Zm12.52,3.954" fill="#104df5"/></svg>';
    public const SVG_PLACE = '<svg xmlns="http://www.w3.org/2000/svg" width="14.117" height="19.764" viewBox="0 0 14.117 19.764"><path id="Icon_ionic-md-pin" data-name="Icon ionic-md-pin" d="M13.808,2.25A7.009,7.009,0,0,0,6.75,9.167c0,5.188,7.058,12.846,7.058,12.846s7.058-7.658,7.058-12.846A7.009,7.009,0,0,0,13.808,2.25Zm0,9.388a2.471,2.471,0,1,1,2.521-2.47A2.472,2.472,0,0,1,13.808,11.638Z" transform="translate(-6.75 -2.25)" fill="#104df5"/></svg>';
    
    public static function parse($fn, $items)
    {
        return self::$fn($items);
    }

    public static function simple($items)
    {
        $parsed = [];
        foreach ($items as $key => $value) {
            $parsed[] = [
                'id' => $value->id,
                'name' => $value->name,
                'year' =>  $value->year,
                'img_url' => $value->img_url,
                'venue_name' =>  $value->venue_name,
                'venue_id' =>  $value->venue->id ?? null,
            ];
        }

        return $parsed;
    }

    public static function venueInfoblock($items = [])
    {
        $parsed = [];
        $parsed['headings'] = [
            [
                'text' => 'Dato',
                'icon' => self::SVG_CALENDAR
            ],
            [
                'text' => 'Artist',
                'icon' => self::SVG_GUITAR
            ]
        ];

        $parsed['list'] = [];

        foreach ($items as $key => $value) {
            $parsed['list'][$value->festival_name][] = [
                'date' => $value->date,
                'event' => '<a href="/artist/' . $value->id . '">' .$value->name . '</a>'
            ];
        }

        return $parsed;
    }

    public static function eventInfoblock($item)
    {
        $parsed = [];

        $parsed['headings'] = [
            [
                'text' => 'Dato',
                'icon' => self::SVG_CALENDAR
            ],
            [
                'text' => 'Spillested',
                'icon' => self::SVG_PLACE
            ],
            [
                'text' => 'Musikere',
                'icon' => self::SVG_GUITAR
            ]
        ];

        $actorsStr = "";

        foreach ($item->actors as $key => $value) {
            if( $value->pivot->instrument){
                $actorsStr .= $value->pivot->instrument . ": ";
            }
            $actorsStr .= $value->name . '</br>';
        }

        $parsed['list'] = [];

        $parsed['list'][] = [
            'date' => $item->date,
            'venue' => '<a href="/spillested/' . $item->venue->id . '">' . $item->venue->name . '</a>',
            'actors' => $actorsStr,
        ];

        return $parsed;
    }
}
