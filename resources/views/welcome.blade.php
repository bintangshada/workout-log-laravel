<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'FitTrack') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans text-gray-900 bg-gray-50 dark:bg-gray-900 selection:bg-blue-500 selection:text-white overflow-x-hidden">
        
        <nav x-data="{ scrolled: false }" 
             @scroll.window="scrolled = (window.pageYOffset > 20)"
             :class="scrolled ? 'bg-white/80 dark:bg-gray-900/90 backdrop-blur-md shadow-sm' : 'bg-transparent'"
             class="fixed w-full z-50 top-0 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex-shrink-0 flex items-center gap-2">
                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <span class="font-bold text-2xl tracking-tight text-white" :class="scrolled ? 'text-gray-900 dark:text-white' : 'text-white'">FitTrack</span>
                    </div>

                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-200 hover:text-white transition-colors">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="font-medium px-4 py-2 transition-colors rounded-lg hover:bg-white/10" :class="scrolled ? 'text-gray-600 dark:text-gray-300' : 'text-gray-200'">
                                    Log in
                                </a>
                                <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-0.5">
                                    Get Started
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <div class="relative min-h-screen flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=2070&auto=format&fit=crop" 
                     class="w-full h-full object-cover" 
                     alt="Gym Background">
                <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/90 to-gray-900/60"></div>
                <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-gray-900 to-transparent"></div>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-20">
                <div class="inline-flex items-center px-4 py-2 rounded-full border border-blue-500/30 bg-blue-500/10 text-blue-300 text-sm font-medium mb-8 backdrop-blur-sm" data-aos="fade-down" data-aos-delay="100">
                    <span class="flex h-2 w-2 rounded-full bg-blue-500 mr-2"></span>
                    The #1 Workout Tracker for Athletes
                </div>
                
                <h1 data-aos="fade-up" data-aos-delay="200" class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-6 leading-tight">
                    Track Progress. <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-500">Crush Goals.</span>
                </h1>
                
                <p data-aos="fade-up" data-aos-delay="300" class="mt-4 max-w-2xl mx-auto text-xl text-gray-300 mb-10 leading-relaxed">
                    Stop guessing your lifts. Log every set, analyze your volume, and visualize your gains with the most intuitive fitness tracker built for serious lifters.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('register') }}" class="px-8 py-4 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-lg shadow-xl shadow-blue-600/20 transition-all transform hover:scale-105">
                        Start Tracking for Free
                    </a>
                    <a href="#features" class="px-8 py-4 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/10 text-white font-semibold text-lg backdrop-blur-sm transition-all flex items-center">
                        Explore Features
                        <svg class="w-5 h-5 ml-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    </a>
                </div>

                <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8 border-t border-white/10 pt-8 max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="500">
                    <div data-aos="zoom-in" data-aos-delay="600">
                        <div class="text-3xl font-bold text-white">500+</div>
                        <div class="text-sm text-gray-400">Exercises</div>
                    </div>
                    <div data-aos="zoom-in" data-aos-delay="700">
                        <div class="text-3xl font-bold text-white">Unlimited</div>
                        <div class="text-sm text-gray-400">Workout Logs</div>
                    </div>
                    <div data-aos="zoom-in" data-aos-delay="800">
                        <div class="text-3xl font-bold text-white">100%</div>
                        <div class="text-sm text-gray-400">Free to Use</div>
                    </div>
                    <div data-aos="zoom-in" data-aos-delay="900">
                        <div class="text-3xl font-bold text-white">24/7</div>
                        <div class="text-sm text-gray-400">Accessibility</div>
                    </div>
                </div>
            </div>
        </div>

        <section id="features" class="py-24 bg-gray-900 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-base text-blue-500 font-semibold tracking-wide uppercase">Why FitTrack?</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-white sm:text-4xl">
                        Everything you need to get stronger
                    </p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-400 mx-auto">
                        Forget notebooks and complex spreadsheets. We make tracking your fitness journey simple and effective.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="bg-gray-800 rounded-2xl p-8 border border-gray-700 hover:border-blue-500/50 transition-colors group" data-aos="fade-right" data-aos-delay="100">
                        <div class="w-14 h-14 bg-blue-900/30 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Smart Logging</h3>
                        <p class="text-gray-400 leading-relaxed">
                            Easily record sets, reps, and weights. Our smart interface remembers your last session to save you time in the gym.
                        </p>
                    </div>

                    <div class="bg-gray-800 rounded-2xl p-8 border border-gray-700 hover:border-purple-500/50 transition-colors group" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-14 h-14 bg-purple-900/30 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Visual Progress</h3>
                        <p class="text-gray-400 leading-relaxed">
                            Watch your strength grow with interactive charts. Track volume, frequency, and personal records automatically.
                        </p>
                    </div>

                    <div class="bg-gray-800 rounded-2xl p-8 border border-gray-700 hover:border-green-500/50 transition-colors group" data-aos="fade-right" data-aos-delay="300">
                        <div class="w-14 h-14 bg-green-900/30 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Custom Routines</h3>
                        <p class="text-gray-400 leading-relaxed">
                            Build your own workout templates or start from scratch. Organize your training splits exactly how you want.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-blue-600 relative overflow-hidden">
            <div class="absolute inset-0 bg-blue-600">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-700 to-blue-500 opacity-90"></div>
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
                <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
            </div>
            
            <div class="relative max-w-4xl mx-auto px-4 text-center" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6" data-aos="fade-up" data-aos-delay="100">Ready to transform your physique?</h2>
                <p class="text-blue-100 text-lg mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Join thousands of users who are building better habits and stronger bodies with FitTrack.
                </p>
                <a href="{{ route('register') }}" class="inline-block bg-white text-blue-600 font-bold text-lg px-10 py-4 rounded-xl shadow-xl hover:bg-gray-50 transition-colors transform hover:-translate-y-1" data-aos="zoom-in" data-aos-delay="300">
                    Create Free Account
                </a>
                <p class="mt-4 text-sm text-blue-200 opacity-80" data-aos="fade-up" data-aos-delay="400">No credit card required</p>
            </div>
        </section>

        <footer class="bg-gray-900 border-t border-gray-800 pt-12 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center" data-aos="fade-up">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="font-bold text-xl text-white">FitTrack</span>
                </div>
                <p class="text-gray-500 text-sm mb-6">&copy; {{ date('Y') }} FitTrack. Built for gains.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Terms</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Contact</a>
                </div>
            </div>
        </footer>

        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                offset: 100
            });
        </script>
    </body>
</html>