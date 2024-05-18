<?php
$colors = session('colors');
$url = session('url');
function expandHexColor($hex)
{
    // Check if the hex code is 3 characters long
    if (strlen($hex) == 4 && $hex[0] == '#') {
        return '#' . $hex[1] . $hex[1] . $hex[2] . $hex[2] . $hex[3] . $hex[3];
    } else {
        return $hex;
    }
}

function convertToHex($color)
{
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
        elseif (strlen($matches[0]) === 4) {
            return '#' . $matches[1] . $matches[1] . $matches[2] . $matches[2] . $matches[3] . $matches[3];
        }
    }

    // Return the color as is if it doesn't match any of the supported formats
    return $color;
}

function getContrastingTextColor($backgroundColor)
{
    // Convert RGBA to hex if necessary
    if (strpos($backgroundColor, 'rgba') !== false) {
        $backgroundColor = convertToHex($backgroundColor);
    }

    // Remove any leading hash symbol from the color
    $backgroundColor = ltrim($backgroundColor, '#');

    // Convert hex to RGB
    $r = hexdec(substr($backgroundColor, 0, 2));
    $g = hexdec(substr($backgroundColor, 2, 2));
    $b = hexdec(substr($backgroundColor, 4, 2));

    // Calculate relative luminance
    $luminance = (0.2126 * $r + 0.7152 * $g + 0.0722 * $b) / 255;

    // Choose black or white text color based on luminance
    return $luminance > 0.5 ? '#000000' : '#ffffff';
}
?>
@extends('layouts.app')

@section('title', 'ChromaCatcha | Colors')

@section('content')

<main class="p-1 relative  flex flex-col align-center sm:p-3">
    <form method="POST" class="flex flex-col-reverse" action="{{ url('/colors') }}">
        @csrf
        <div class="flex mx-auto gap-1">
            <input type="submit" name="convertToRgba" value="Convert to RGB" formaction="{{ url('/colors/rgba') }}" class="btn btn-xs mb-1 btn-accent border border-neutral border-4 sm:btn-sm" />
            <input type="submit" name="convertToHex" value="Convert to HEX" formaction="{{ url('/colors/hex') }}" class="btn btn-xs btn-secondary sm:btn-sm border border-neutral border-4" />

        </div>
        <a href="/" class="btn btn-xs text-xx mb-2 mr-auto sm:text-sm"><img alt="" src="{{ asset('storage/back.svg') }}" />Back</a>
    </form>

    <p class="my-4 text-xs sm:text-md">
        @if (isset($colors))
        Here are the extracted colors from:<br />
        @endif
        @if (isset($url))
        <a href="{{$url}}" class="link link-neutral font-bold text-xxs sm:text-xs">
            {{$url}}
        </a>
        @endif
    </p>
    <ul class="flex flex-col align-center">
        @isset($colors)
        @foreach ($colors as $color)
        @if (strlen($color) < 5) @php $color=expandHexColor($color); @endphp @endif <li style="background-color: {{ $color }}; " class="flex align-center p-[6px] m-1 border border-neutral  mx-auto min-w-[300px] text-xs sm:min-w-[600px] sm:text-md "><span class="btn btn-xs px-1 border rounded bg-neutral text-white mix-blend-luminosity hover:bg-neutral cursor-default sm:btn-sm">{{ $color }} </span><button class="ml-auto " onclick="copyToClipboard('{{ $color }}')"><img src="{{ asset('storage/copy.svg') }}" alt="Copy Icon" class="border bg-neutral p-1 rounded hover:bg-primary"></button></button></li>
            @endforeach
            @endisset
    </ul>
</main>
@endsection

<div id="alert-copied" class="hidden toast toast-bottom toast-end toast-xs z-10 sm:toast-top sm:toast-center">
    <div role="alert" class="alert text-center alert-success shadow shadow-2xl px-2 py-1 bg-green-400 font-bold border border-neutral border-4 alert-xs z-1 flex justify-center"><span>Copied to clipboard</span></div>
</div>
@section('scripts')
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text);

        document.getElementById("alert-copied").style.display = "block";
        setTimeout(() => {
            document.getElementById("alert-copied").style.display = "none";
        }, 2000)
    }
</script> @endsection
