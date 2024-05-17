<?php
$errorMessage = session('errorMessage');
?>


<form method="POST" action="/colors" onsubmit="submitForm()" class="flex align-center justify-center relative my-12 sm:my-20">
    @csrf
    @isset($errorMessage)
    <div role="alert" class="absolute top-[-110%] alert text-xxs py-1 alert-error flex justify-center max-w-[621px] mx-auto sm:text-xs">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-2 w-2 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{$errorMessage}}</span>
    </div>
    @endisset
    <input id="url" type="text" name="url" placeholder="https://www.example.com" class="input input-bordered text-xxs input-xs w-full max-w-sm sm:input-sm sm:text-xs" />
    <button id="submitBtn" class="btn ml-1  btn-primary btn-xs max-w-[125px]  w-[125px]  hover:bg-accent sm:btn-sm " type="submit">
        <span id="spinner" class="loading loading-spinner loading-xs hidden"></span>
        <span class="extract">Extract</span>
    </button>
</form>

<script>
    function submitForm() {
        document.getElementById("submitBtn").querySelector('.extract').textContent = '';
        document.getElementById("spinner").style.display = "block";
    }
</script>
