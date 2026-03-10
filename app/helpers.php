<?php

use Carbon\Carbon;

if (!function_exists('chatTime')) {
    function chatTime($time)
    {
        $time = Carbon::parse($time);
        $now  = Carbon::now();

        if ($time->isToday()) {
            return $time->format('H:i');
        }

        if ($time->isYesterday()) {
            return 'Kemarin';
        }

        if ($time->greaterThan($now->copy()->subDays(7))) {
            return $time->translatedFormat('D'); // Sen, Sel, Rab
        }

        return $time->format('d/m/Y');
    }
}
