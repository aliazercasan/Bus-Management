<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UniRide - Available Buses</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
        <!-- Navigation -->
        <nav class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center space-x-3">
                        <div class="h-10 w-10 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">UniRide</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('driver.login') }}" class="text-gray-700 hover:text-blue-600 px-4 py-2 rounded-lg font-medium transition duration-200">
                            Staff Login
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="text-center">
                    <h1 class="text-5xl font-extrabold text-gray-900 mb-4">
                        <span class="bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">Available Buses</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                        Check real-time bus availability and routes at the terminal
                    </p>
                </div>
            </div>
        </div>

        <!-- Available Buses Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-3xl font-bold text-gray-900">Buses in Terminal</h2>
                    <div class="flex items-center space-x-2 text-green-600">
                        <div class="h-3 w-3 bg-green-600 rounded-full animate-pulse"></div>
                        <span class="font-semibold">Live Updates</span>
                    </div>
                </div>

                <!-- Bus List -->
                <div class="space-y-4">
                    <!-- Sample Bus Card 1 -->
                    <div class="border-2 border-gray-200 rounded-xl p-6 hover:border-blue-400 hover:shadow-lg transition duration-300">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex items-start space-x-4 mb-4 md:mb-0">
                                <div class="h-16 w-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-1">Bus #101</h3>
                                    <p class="text-gray-600 mb-2">Route: Campus → Downtown → Mall</p>
                                    <div class="flex items-center space-x-4 text-sm">
                                        <span class="flex items-center text-green-600 font-semibold">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            Available
                                        </span>
                                        <span class="text-gray-500">Capacity: 35 seats</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-left md:text-right">
                                <p class="text-sm text-gray-500 mb-1">Departure Time</p>
                                <p class="text-2xl font-bold text-blue-600">2:30 PM</p>
                                <p class="text-sm text-gray-500 mt-1">Platform 1</p>
                            </div>
                        </div>
                    </div>

                    <!-- Sample Bus Card 2 -->
                    <div class="border-2 border-gray-200 rounded-xl p-6 hover:border-blue-400 hover:shadow-lg transition duration-300">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex items-start space-x-4 mb-4 md:mb-0">
                                <div class="h-16 w-16 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-1">Bus #205</h3>
                                    <p class="text-gray-600 mb-2">Route: Campus → Airport → Station</p>
                                    <div class="flex items-center space-x-4 text-sm">
                                        <span class="flex items-center text-green-600 font-semibold">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            Available
                                        </span>
                                        <span class="text-gray-500">Capacity: 40 seats</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-left md:text-right">
                                <p class="text-sm text-gray-500 mb-1">Departure Time</p>
                                <p class="text-2xl font-bold text-blue-600">3:00 PM</p>
                                <p class="text-sm text-gray-500 mt-1">Platform 2</p>
                            </div>
                        </div>
                    </div>

                    <!-- Sample Bus Card 3 -->
                    <div class="border-2 border-gray-200 rounded-xl p-6 hover:border-blue-400 hover:shadow-lg transition duration-300">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex items-start space-x-4 mb-4 md:mb-0">
                                <div class="h-16 w-16 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-1">Bus #312</h3>
                                    <p class="text-gray-600 mb-2">Route: Campus → Residential Area → Park</p>
                                    <div class="flex items-center space-x-4 text-sm">
                                        <span class="flex items-center text-yellow-600 font-semibold">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                            Boarding Soon
                                        </span>
                                        <span class="text-gray-500">Capacity: 30 seats</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-left md:text-right">
                                <p class="text-sm text-gray-500 mb-1">Departure Time</p>
                                <p class="text-2xl font-bold text-blue-600">3:45 PM</p>
                                <p class="text-sm text-gray-500 mt-1">Platform 3</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                    <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Real-Time Updates</h3>
                    <p class="text-gray-600 text-sm">Live bus tracking and schedule information</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                    <div class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Safe & Reliable</h3>
                    <p class="text-gray-600 text-sm">Verified drivers and maintained buses</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                    <div class="h-12 w-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Multiple Routes</h3>
                    <p class="text-gray-600 text-sm">Convenient routes across the city</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="flex items-center space-x-3 mb-4 md:mb-0">
                        <div class="h-10 w-10 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold">UniRide</span>
                    </div>
                    <p class="text-gray-400">© {{ date('Y') }} UniRide Terminal. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
