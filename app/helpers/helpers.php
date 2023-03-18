<?php


const COOKIE__ONE_HOUR = 60;
const COOKIE__ONE_DAY = COOKIE__ONE_HOUR * 24;
const COOKIE__ONE_WEEK = COOKIE__ONE_DAY * 7;
const COOKIE__ONE_MONTH = COOKIE__ONE_DAY * 30;
const COOKIE__ONE_YEAR = COOKIE__ONE_DAY * 365;

const KEY_NEW_PIXEL = 'new_pixel';

const DONATION_MINIMUM = 2;


if(! function_exists('isColor')){


    function isColor(string $color) : bool {
        if(! $color) return false;

        if ($color[0] == '#')
            $color = substr($color, 1);

        if (strlen($color) == 6 || strlen($color)==3){
            for($i=0; $i< strlen($color); $i++){
                $c=$color[$i];
                if(! str_contains('ABCDEF1234567890', strtoupper($c) )){
                    return false;
                }

            }

        }else{
            return false;
        }

        return true;
    }


}

if( ! function_exists('html2rgb')){

    function html2rgb($color)
    {
        if ($color[0] == '#')
            $color = substr($color, 1);

        if (strlen($color) == 6)
            list($r, $g, $b) = array($color[0].$color[1],
                $color[2].$color[3],
                $color[4].$color[5]);
        elseif (strlen($color) == 3)
            list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
        else
            return false;

        $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
        if($r>255 || $r<0 || $g>255 || $g<0 || $b<0 || $b>255){
            return false;
        }
        return array($r, $g, $b);
    }


}

if(! function_exists('rgb2html')){

    function rgb2html($r, $g=-1, $b=-1)
    {
        if (is_array($r) && sizeof($r) == 3)
            list($r, $g, $b) = $r;

        $r = intval($r); $g = intval($g);
        $b = intval($b);

        $r = dechex($r<0?0:($r>255?255:$r));
        $g = dechex($g<0?0:($g>255?255:$g));
        $b = dechex($b<0?0:($b>255?255:$b));

        $color = (strlen($r) < 2?'0':'').$r;
        $color .= (strlen($g) < 2?'0':'').$g;
        $color .= (strlen($b) < 2?'0':'').$b;
        return '#'.$color;
    }
}

if(!function_exists('getRandomColor')) {
    /**
     * get a random color in #ffffff format
     *
     * @return string
     */
    function getRandomColor()
    {
        return "#" . sprintf("%02X%02X%02X", mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
    }
}
