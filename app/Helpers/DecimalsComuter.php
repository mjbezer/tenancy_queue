<?php

namespace AtitudeAgenda\Helpers;


class DecimalsComuter
{
    static function pointFloat($value)
    {
        return str_replace(',','.',str_replace('.','',$value));
    }

    static function formatCurrency($value)
    {
        return number_format($value,2,',','.');
    }
} 