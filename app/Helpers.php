<?php

namespace App\Helpers;

use NumberFormatter;

class Helpers {
    public static function formatRupiah($amount)
    {
        $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($amount, 'IDR');
    }
}