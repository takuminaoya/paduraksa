<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? env('APP_NAME') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/images/icon.png') }}">

    @filamentStyles

    {{ filament()->getTheme()->getHtml() }}
    {{ filament()->getFontHtml() }}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Open Sans', "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            line-height: 1.618;
            color: #333333;
            background-color: #ffffff;
        }

        .w-4xl {
            width: 56rem;
        }

        .w-50 {
            width: 12.5rem;
        }

        .-mt-50 {
            margin-top: -12.5rem;
        }

        .btn-lapor {
            background-color: #D97706;
            color: white;
            font-weight: bold;
        }

        .btn-lapor:hover {
            background-color: #F59E0B;
        }
    </style>

</head>

<body>
    {{ $slot }}

    @filamentScripts(withCore: true)
</body>

</html>
