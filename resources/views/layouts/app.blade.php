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

        <!-- Prism.js CDN -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-twilight.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/prism.min.js"></script> -->

        <!-- Highlight.js CDN -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/dark.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script> -->
    </head>
    <body class="font-sans antialiased">

        @include('auth-modal')

        <script>
            const isAuthenticated = @json(auth()->check());
        </script>

        <div class="container">
            <main>
                @yield('content') <!-- This is where the content of other views will be injected -->
            </main>
        </div>

        <div class=" bg-gray-100 dark:bg-gray-900">
            

            @if (auth()->check() && (Route::is('dashboard') || Route::is('profile.*')))
                @include('layouts.navigation')
            @endif

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset
            
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script> <!-- Include ace.js directly from CDN if using a standalone version -->

        <script>
            // Initialize Highlight.js
            document.addEventListener('DOMContentLoaded', (event) => {
                document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightBlock(block);
                });
            });
        </script>

        <!-- <script src="{{ asset('/snippets.js') }}"></script> -->
    </body>
</html>