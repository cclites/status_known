<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.partials.header')

<script>
    @auth
        window.User = {!! json_encode(Auth::user()->with('business'), true) !!};
    @else
        window.User = [];
    @endauth
</script>


<body>

    @include('layouts.partials.header_logo')

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
