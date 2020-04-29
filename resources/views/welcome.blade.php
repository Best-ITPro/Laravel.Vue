<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title >{{ config('app.name') }}</title>
        <link rel="shortcut icon" href="/images/LaravelLogo.png" />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        {{--   Styles --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.css') }}" rel="stylesheet">

        {{--   Scripts --}}
        {{--   Атрибут defer откладывает выполнение скрипта до тех пор, пока вся страница не будет загружена полностью.--}}
        <script src="{{ asset('js/app.js') }}" defer></script>


    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content" id="app">
                <div class="title m-b-md">
                    <img src="/images/LaravelLogo.png" id="index_logo" class="img-thumbnail"><br>
                    {{ config('app.name') }} ;)
                </div>

                <center>
                    <a href="{{ route('start') }}"><h3>-> Vue.JS Components</h3></a>
                </center>

                <br>

                @include('layouts.links')

            </div>
        </div>
    </body>
</html>
