<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FitTrack') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex bg-white dark:bg-gray-900">
            
            <div class="hidden lg:flex lg:w-1/2 relative bg-gray-900">
                <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470&auto=format&fit=crop" 
                     class="absolute inset-0 h-full w-full object-cover opacity-80" 
                     alt="Gym Background">
                
                <div class="absolute inset-0 bg-gradient-to-t from-black via-blue-900/40 to-transparent opacity-90"></div>

                <div class="relative z-10 w-full flex flex-col justify-end p-16">
                    <div class="mb-6">
                        <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h1 class="text-5xl font-bold text-white mb-4 tracking-tight leading-tight">
                            Push Your <br>Limits.
                        </h1>
                        <p class="text-lg text-gray-300 max-w-md leading-relaxed">
                            "The only bad workout is the one that didn't happen. Track your progress, visualize your gains, and crush your goals with FitTrack."
                        </p>
                    </div>
                    
                    <div class="flex gap-8 border-t border-white/10 pt-8">
                        <div>
                            <p class="text-3xl font-bold text-white">10k+</p>
                            <p class="text-sm text-gray-400">Active Users</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-white">500+</p>
                            <p class="text-sm text-gray-400">Exercises Library</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 w-full lg:w-1/2 bg-white dark:bg-gray-900 overflow-y-auto">
                <div class="mx-auto w-full max-w-sm lg:w-[420px]">
                    <div class="lg:hidden text-center mb-8">
                        <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg shadow-blue-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">FitTrack</h2>
                    </div>

                    {{ $slot }}
                    
                    <div class="mt-10 text-center">
                        <p class="text-xs text-gray-400">
                            &copy; {{ date('Y') }} FitTrack Inc. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
            
        </div>
    </body>
</html>