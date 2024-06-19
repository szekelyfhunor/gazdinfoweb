<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sapientia GI | Admin-Bejelentkezés</title>
    <link rel="icon" href="{{asset('img/titleicon.ico')}}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>

        html,
        body {
            height: 100%;
        }
        body{
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card{
            border: 1px solid black;
            border-radius: 50px;
            max-width: 80%;
            /*padding: 120px 100px;*/
        }

        #ad-login-span1{
            font-size: 30px;
            font-family: "Poppins", sans-serif;
        }
        #ad-login-span2{
            font-size: 16px;
            line-height: 0;
            /*text-transform: uppercase;*/
            font-family: "Poppins", sans-serif;
        }
        #ad-btn{

            background-color: #0a6c42;
            border: 1px solid black;
            border-radius: 50px;
            outline: none;
        }
        #ad-btn:hover{
            background-color: #3ac162;

        }
        #ad-btn:focus{
            border-color: #9dccb6 !important;
            box-shadow: 0 0 0 0.25rem #9dccb6;
        }
        .form-control:focus{
            border-color: #9dccb6 !important;
            box-shadow: 0 0 0 0.25rem #9dccb6;
        }
        main{
            width: 100%;
        }
        #ad-my-inside-container{
            max-width: 100%;
            max-height: 100%;
            margin: 100px;
        }
        #email, #password{
            border: 1px solid black;
            border-radius: 50px;
        }

</style>
    @livewireStyles
</head>
<body >
        <main class="py-4">
            @yield('content')
        </main>
        @livewireScripts
</body>
</html>
