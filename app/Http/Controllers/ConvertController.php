<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ConvertController extends Controller {

    public function convertColors(Request $request) {
        $colors = session('colors');
        $colors = array_values($colors);


        // Expands hex color code to 8 characters
        function expandHexColor($hex) {
            if (strlen($hex) == 4 && $hex[0] == '#') {
                return '#'.$hex[1].$hex[1].$hex[2].$hex[2].$hex[3].$hex[3];
            } else {
                return $hex;
            }
        }

            // CONVERT TO HEX 
        if ($request -> has('convertToHex')) {
            function convertToHex($color) {
                // Check if the color is in RGBA format
                if (preg_match('/rgba?\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3})(?:,\s*([\d.]+))?\)/i', $color, $matches)) {
                    $red = intval($matches[1]);
                    $green = intval($matches[2]);
                    $blue = intval($matches[3]);
                    $alpha = isset($matches[4]) ? round(floatval($matches[4]) * 255) : 255; // Convert alpha to 0-255 range

                    // Convert RGB to hex with alpha channel
                    return sprintf("#%02x%02x%02x%02x", $red, $green, $blue, $alpha);
                }

                // Check if the color is in hex format
                if (preg_match('/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i', $color, $matches)) {
                    // If the hex code has 6 digits, return it directly
                    if (strlen($matches[0]) === 7) {
                        return $matches[0];
                    }
                    // Otherwise, expand the 3-digit hex code to 6 digits
                    elseif(strlen($matches[0]) === 4) {
                        return '#'.$matches[1].$matches[1].$matches[2].$matches[2].$matches[3].$matches[3];
                    }
                }

                // Return the color as is if it doesn't match any of the supported formats
                return $color;
            }


            $colors = array_map(function($color) {
                if ($color[0] !== '#') {
                    if (strlen($color) < 5) {
                        $color = expandHexColor($color);
                    }

                    return convertToHex($color);
                } else {
                    if (strlen($color) <= 4) {
                        $color = expandHexColor($color);
                    }
                    return $color; // If color is already in rgb format, return it as is
                }
            }, $colors);
            session(['colors' => $colors]);
            return view('colors', compact('colors'));
        }

        // CONVERT TO RGBA (0, 0, 0, 0) 
        elseif($request -> has('convertToRgba')) {
            function convertToRgba($hex) {
                $hex = ltrim($hex, '#');

                // Check if the hex code is valid
                if (preg_match('/^[a-f0-9]{8}$/i', $hex)) {
                    // Extract alpha channel
                    $alphaHex = substr($hex, 6, 2);
                    $alpha = round(hexdec($alphaHex) / 255, 2); // Convert alpha to 0-1 range

                    // Convert hex to RGB
                    list($r, $g, $b) = sscanf(substr($hex, 0, 6), "%02x%02x%02x");

                    // Format RGBA with alpha channel
                    return "rgba($r, $g, $b, $alpha)";
                }
                elseif(preg_match('/^[a-f0-9]{6}$/i', $hex)) { // Check if it's a 6-digit hex code
                    // Convert hex to RGBA with default alpha (1.0)
                    return convertToRgba($hex.
                        'ff');
                } else {
                    return $hex;
                }
            }

            $colors = array_map(function($color) {
                if (strlen($color) < 5 && $color[0] == '#') {
                        $color = expandHexColor($color);
                }
                return convertToRgba($color);
            }, $colors);
            session(['colors' => $colors]);
            return view('colors', compact('colors'));
        }

    }
}
