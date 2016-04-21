<?php

namespace App\Classes;

use Image;

class Identicon_Generator
{
    public static function createNewIcon($email)
    {
        $hash = md5($email);
        $len = strlen($hash);
        $color = '#' . substr($hash, $len-6, $len);
        $hash = substr($hash, $len - 15, $len);

        $base_image = array([0,0,0,0,0],
                            [0,0,0,0,0],
                            [0,0,0,0,0],
                            [0,0,0,0,0],
                            [0,0,0,0,0]);

        // Fill in the first 3 columns
        for($y = 0; $y < 5; $y++) {
            for($x = 0; $x < 3; $x++) {
                $i = (int) ($x + $y * 3);
                $even = ((ord($hash[$i]) >> 1) % 2) == 0;
                if($even)
                    $base_image[$x][$y] = 1;
            }
        }

        // Mirror the left 2 columns to the right 2 columns
        for($y = 0; $y < 5; $y++) {
            for($x = 3; $x < 5; $x++) {
                $k = $x % 2;
                $base_image[$x][$y] = $base_image[$k][$y];
            }
        }

        // offset for x and y is 28
        $img = Image::Canvas(256, 256, '#fafafa');

        for($y = 0; $y < 200; $y++) {
            for($x = 0; $x < 200; $x++) {
                $base_x = (int) floor($x / 40);
                $base_y = (int) floor($y / 40);

                if($base_image[$base_x][$base_y] == 1) {
                    $img->pixel($color, $x + 28, $y + 28);
                }
            }
        }

        $img->encode('png');
        $type = 'png';
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);

        return $base64;
    }



}
