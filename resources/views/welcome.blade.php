<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Lindalë - The Project Manager For Everyone.</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        {{-- local icon --}}
        <link rel="icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon" />
        <link rel="bookmark" href="{{ asset('/favicon.ico') }}" type="image/x-icon" />
        <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('/favicon/apple-touch-icon.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('/favicon/apple-touch-icon.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('/favicon/apple-touch-icon.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('/favicon/apple-touch-icon.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('/favicon/apple-touch-icon.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('/favicon/apple-touch-icon.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('/favicon/apple-touch-icon.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('/favicon/apple-touch-icon.png') }}" />
        <link rel="icon" type="image/png" href="{{ asset('/favicon/apple-touch-icon.png') }}" sizes="196x196" />
        <link rel="icon" type="image/png" href="{{ asset('/favicon/apple-touch-icon.png') }}" sizes="96x96" />
        <link rel="icon" type="image/png" href="{{ asset('/favicon/apple-touch-icon.png') }}" sizes="32x32" />
        <link rel="icon" type="image/png" href="{{ asset('/favicon/apple-touch-icon.png') }}" sizes="16x16" />
        <link rel="icon" type="image/png" href="{{ asset('/favicon/apple-touch-icon.png') }}" sizes="128x128" />
        <meta name="application-name" content="&nbsp;"/>
        <meta name="msapplication-TileColor" content="#FFFFFF" />
        <meta name="msapplication-TileImage" content="{{ asset('/favicon/apple-touch-icon.png') }}" />
        <meta name="msapplication-square70x70logo" content="{{ asset('/favicon/apple-touch-icon.png') }}" />
        <meta name="msapplication-square150x150logo" content="{{ asset('/favicon/apple-touch-icon.png') }}" />
        <meta name="msapplication-wide310x150logo" content="{{ asset('/favicon/apple-touch-icon.png') }}" />
        <meta name="msapplication-square310x310logo" content="{{ asset('/favicon/apple-touch-icon.png') }}" />

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway';
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Auth::guest())
                <div class="top-right links">
                    <a href="{{ url('/login') }}">{{ trans('auth.login') }}</a>
                </div>
            @else
                <div class="top-right links">
                    <a href="{{ url('/home') }}">{{ trans('auth.home') }}</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <img alt="Logo" src="{{ asset('/img/logo.png') }}" width="30%"/>
                </div>

                <div class="links">
                    <a href="#">Documentation</a>
                    <a href="#">Blog</a>
                    <a href="#">News</a>
                    <a href="#">About</a>
                    <a href="https://github.com/lindelea/lindale">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
