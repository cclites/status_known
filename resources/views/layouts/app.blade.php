<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.partials.header')

<body>

    @include('layouts.partials.header_logo', ['title'=>'TODO: Add title here'])

    <div id="app" class="d-flex h-100">
        <div class="flex-fill col-1 ">
            <menu-bar></menu-bar>
        </div>
        <div class="flex-fill col-11">
            @yield('content')
        </div>
    </div>
</body>
</html>
