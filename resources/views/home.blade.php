<?php
$errorMessage = session('errorMessage');
$colors = session('colors');
$url = session('url');
?>
@extends('layouts.app')

@section('title', 'ChromaCatcha')

@section('content')
<main class="flex flex-col flex-1 px-3 justify-center align-center relative">
    @isset($colors)
    <form id="colors-form" method="POST" action="/colors">
        @csrf
        <input type="hidden" name="url" value="{{ $url }}">
        <p id="submit-colors" class="bg-neutral py-1 text-white text-xs absolute top-0 left-0 right-0 cursor-pointer hover:bg-accent hover:text-black font-bold sm:text-sm">View colors for <br class="block sm:hidden" /><span class="text-xxs sm:text-xs">{{ $url }} </span></p>
    </form>
    @endisset
    <h1 id="welcome-text" class="text-3xl my-10 mx-auto pl-4 pr-3 font-bold upper border border-accent border-4 shadow-xl">WELCOME</h1>
    <p class="text-xs sm:text-sm">Explore vibrant color palettes from images and links with <span class="font-bold text-neutral">ChromaCatcha</span>. Effortlessly extract colors, from bold primaries to subtle pastels, to fuel your creativity. Simply enter the URL of the website you wish to extract colors from and paint your world in brilliance today!</p>
    <x-urlForm />
</main>
@endsection
@section('scripts')
<script>
    // Add an event listener to the <p> tag
    document.getElementById('submit-colors').addEventListener('click', function() {
        // Submit the form when the <p> tag is clicked
        document.getElementById('colors-form').submit();
    });
</script>

@endsection
