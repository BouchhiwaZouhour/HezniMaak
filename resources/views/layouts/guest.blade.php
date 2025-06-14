<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
    /* Global body styling */
    body {
        background-color: #f8f9fa;
        font-family: 'Figtree', sans-serif;
    }

    /* Container for the form */
    .auth-container {
        max-width: 400px;
        margin: 80px auto;
        background-color: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.15);
    }

    /* Header */
    h2 {
        color: #ff8200;
        text-align: center;
        font-weight: bold;
        margin-bottom: 24px;
    }

    /* Form elements */
    .form-control {
        border-radius: 8px;
        height: 50px;
        border: 1px solid #ddd;
    }

    /* Submit Button */
    .btn-primary {
        background-color: #ff8200;
        border: none;
        height: 50px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 8px;
        width: 40%;
    }

    .btn-primary:hover {
        background-color: #cc6a00;
    }

    /* Links */
    a {
        color: #ff8200;
        font-weight: bold;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                <img src="{{ asset('/images/logo.png') }}" alt="logo" class="w-20 h-20 fill-current text-gray-500">                </a>

                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>