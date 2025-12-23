<?php
/*  
    JDF (Jalali Date Functions)
*/

function jdate($format, $timestamp = null)
{
    if ($timestamp === null) {
        $timestamp = time();
    }

    $date = explode('-', date('Y-m-d-H-i-s', $timestamp));

    list($jy, $jm, $jd) = gregorian_to_jalali(
        (int)$date[0],
        (int)$date[1],
        (int)$date[2]
    );

    $replace = array(
        'Y' => $jy,
        'm' => str_pad($jm, 2, '0', STR_PAD_LEFT),
        'd' => str_pad($jd, 2, '0', STR_PAD_LEFT),
        'H' => $date[3],
        'i' => $date[4],
        's' => $date[5],
    );

    return strtr($format, $replace);
}

function gregorian_to_jalali($gy, $gm, $gd)
{
    $g_d_m = array(0,31,59,90,120,151,181,212,243,273,304,334);
    if($gy > 1600){
        $jy = 979;
        $gy -= 1600;
    } else {
        $jy = 0;
        $gy -= 621;
    }

    $gy2 = ($gm > 2)?($gy + 1):$gy;
    $days = (365*$gy) + (int)(($gy2+3)/4) - (int)(($gy2+99)/100) +
            (int)(($gy2+399)/400) - 80 + $gd + $g_d_m[$gm-1];

    $jy += 33*(int)($days/12053);
    $days %= 12053;
    $jy += 4*(int)($days/1461);
    $days %= 1461;

    if($days > 365){
        $jy += (int)(($days-1)/365);
        $days = ($days-1)%365;
    }

    $jm = ($days < 186)?1+(int)($days/31):7+(int)(($days-186)/30);
    $jd = 1+(($days < 186)?($days%31):(($days-186)%30));

    return array($jy, $jm, $jd);
}