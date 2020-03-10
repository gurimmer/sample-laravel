<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" media="screen,projection">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <title>Laravel</title>
    </head>
    <body>
        <nav>
            <div class="nav-wrapper">
            <a href="{{ route('todos.index') }}" class="brand-logo"><img src="{{ asset('img/todos.png') }}" alt="todos logo" width="30"></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Register</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script>
            const init = function()
            {
                @if(session('flash_message'))
                    M.toast({html: '{{ session('flash_message') }}'})
                @endif
            }
            document.addEventListener('DOMContentLoaded', init);
        </script>
        @yield('script')
    </body>
</html>
