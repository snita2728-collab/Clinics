<?php

if (!function_exists('format_price')) {
    function format_price($amount) {
        $currency = session('currency', 'USD');
        if ($currency === 'KHR') {
            return number_format($amount * 4100) . ' ៛';
        }
        return '$' . number_format($amount, 2);
    }
}
