@php
/**
 * This snippet is embedded into the wbsite.
 **/
@endphp

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<frame-loader token="{{ $request->token }}" business="{{ $business }}" id="request-input"></frame-loader>

<script src="{{ asset(mix('js/app.js')) }}"></script>
