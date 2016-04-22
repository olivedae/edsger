<?php

namespace App\Classes;

use Image;

class Identicon_Generator
{

    // Github-styled identicon generation
    public static function createNewIcon($email)
    {
        $hash = md5($email);

        $len = strlen($hash);
        $color_bases = substr($hash, $len-6, $len);
        $golden_ratio_conjugate = 0.618033988749895;

        //Use golden-ratio conjugate to help in deciding color hue
        $h = hexdec($hash[$len-6] . $hash[$len-5])/255;
        $h = fmod($h + $golden_ratio_conjugate, 1.0);
        // Set saturation
        $s = min(0.85 + (hexdec($hash[$len-5] . $hash[$len-4]))/255, 1);
        // Set value to constant 0.89
        $v = 0.89;

        $color = self::hsv_to_rgb($h, $s, $v);

        /*
         * Trim hash to be 15 characters long, and then use to fill
         * in left 3 columns.
         */
        $hash = substr($hash, $len - 15, $len);

        // This array keeps track of which pixels are 'on'
        $base_image = array([0,0,0,0,0],
                            [0,0,0,0,0],
                            [0,0,0,0,0],
                            [0,0,0,0,0],
                            [0,0,0,0,0]);

        /*
         * Fill in the first 3 columns of $base_image based on the md5 hash.
         * If i-th character of hash is even, then the pixel is marked 'on'
         */
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

        /*
         * Upscale to larger 256x256 image
         * identicon dimensions are 200 x 200
         * image padding around identicon is 28 all around
         */
        $img = Image::Canvas(256, 256, '#f1f1f1');

        for($y = 0; $y < 200; $y++) {
            for($x = 0; $x < 200; $x++) {
                $base_x = (int) floor($x / 40);
                $base_y = (int) floor($y / 40);

                if($base_image[$base_x][$base_y] == 1) {
                    $img->pixel($color, $x + 28, $y + 28);
                }
            }
        }

        // Encode our .png identicon as a base 64 data url
        $img->encode('png');
        $type = 'png';
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);

        return $base64;
    }

    private static function hsv_to_rgb($H, $S, $V) {
        //1
        $H *= 6;
        //2
        $I = floor($H);
        $F = $H - $I;
        //3
        $M = $V * (1 - $S);
        $N = $V * (1 - $S * $F);
        $K = $V * (1 - $S * (1 - $F));
        //4
        switch ($I) {
            case 0:
                list($R,$G,$B) = array($V,$K,$M);
                break;
            case 1:
                list($R,$G,$B) = array($N,$V,$M);
                break;
            case 2:
                list($R,$G,$B) = array($M,$V,$K);
                break;
            case 3:
                list($R,$G,$B) = array($M,$N,$V);
                break;
            case 4:
                list($R,$G,$B) = array($K,$M,$V);
                break;
            case 5:
            case 6: //for when $H=1 is given
                list($R,$G,$B) = array($V,$M,$N);
                break;
        }
        // Save color in format needed by Intervention library
        return "#" . dechex($R * 255) . dechex($G * 255) . dechex($B * 255);
    }

}

